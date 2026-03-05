<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Track Order #{{ $order->id }}</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-o9N1j4Eytm5bVtEQ7Pv0BvtO6i3yqYt2m+vJ6sLm0hU=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-pDlh7h58sdfkJDfghdKJHSDFG==" crossorigin=""></script>

    <style>
        #map { height: 60vh; width: 100%; }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col items-center p-6 lg:p-8 min-h-screen">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
        <nav class="flex items-center justify-end gap-4">
            <a href="{{ url('/') }}" class="text-[#1b1b18]">Home</a>
            @auth
                <a href="{{ route('dashboard') }}" class="text-[#1b1b18]">Dashboard</a>
            @endauth
        </nav>
    </header>

    <main class="w-full lg:max-w-4xl max-w-[335px]">
        <h1 class="font-medium mb-2">Real-time tracking for order #{{ $order->id }}</h1>
        <p class="mb-4 text-sm text-[#706f6c]">Current status: <span id="statusText">{{ $order->status }}</span></p>

        <div id="map"></div>
    </main>

    <script>
        const orderId = {{ $order->id }};
        let map = L.map('map');
        let marker;

        const initialLat = {{ $order->latitude ?? 'null' }};
        const initialLng = {{ $order->longitude ?? 'null' }};

        if (initialLat && initialLng) {
            map.setView([initialLat, initialLng], 13);
            marker = L.marker([initialLat, initialLng]).addTo(map);
        } else {
            map.setView([0, 0], 2);
        }

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        function refreshStatus() {
            fetch(`/orders/${orderId}/status`)
                .then(r => r.json())
                .then(data => {
                    document.getElementById('statusText').textContent = data.status;

                    if (data.latitude && data.longitude) {
                        const latLng = [data.latitude, data.longitude];
                        if (!marker) {
                            marker = L.marker(latLng).addTo(map);
                        } else {
                            marker.setLatLng(latLng);
                        }
                        map.setView(latLng);
                    }
                })
                .catch(console.error);
        }

        // poll every 5 seconds
        setInterval(refreshStatus, 5000);
    </script>
</body>
</html>
