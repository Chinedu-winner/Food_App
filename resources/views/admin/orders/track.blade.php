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

        <!-- Order Summary -->
        <div class="bg-white p-4 rounded-lg shadow mb-4">
            <h2 class="font-semibold mb-2">Order Summary</h2>
            <p><strong>Customer:</strong> {{ $order->name ?? 'N/A' }}</p>
            <p><strong>Food:</strong> {{ $order->food_name ?? 'N/A' }} (Qty: {{ $order->quantity ?? 'N/A' }})</p>
            <p><strong>Total Price:</strong> ${{ number_format($order->total ?? 0, 2) }}</p>
            <p><strong>Delivery Address:</strong> {{ $order->address ?? 'N/A' }}</p>
        </div>

        <!-- Status Timeline -->
        <div class="bg-white p-4 rounded-lg shadow mb-4">
            <h2 class="font-semibold mb-2">Order Status</h2>
            <div class="flex items-center justify-between mb-2">
                <span class="{{ $order->status == 'pending' ? 'text-blue-500 font-bold' : 'text-gray-500' }}">Order Placed</span>
                <span class="{{ $order->status == 'confirmed' ? 'text-blue-500 font-bold' : 'text-gray-500' }}">Confirmed</span>
                <span class="{{ $order->status == 'preparing' ? 'text-blue-500 font-bold' : 'text-gray-500' }}">Preparing</span>
                <span class="{{ $order->status == 'ready' ? 'text-blue-500 font-bold' : 'text-gray-500' }}">Ready for Dispatch</span>
                <span class="{{ $order->status == 'delivered' ? 'text-green-500 font-bold' : 'text-gray-500' }}">Delivered</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $order->status == 'pending' ? '20%' : ($order->status == 'confirmed' ? '40%' : ($order->status == 'preparing' ? '60%' : ($order->status == 'ready' ? '80%' : '100%'))) }}"></div>
            </div>
            <p class="mt-2 text-sm">Current status: <span id="statusText" class="font-bold">{{ $order->status }}</span></p>
        </div>

        <!-- Delivery Details -->
        <div class="bg-white p-4 rounded-lg shadow mb-4">
            <h2 class="font-semibold mb-2">Delivery Details</h2>
            <p><strong>Driver:</strong> John Doe</p>
            <p><strong>Estimated Delivery:</strong> 30 minutes</p>
        </div>

        <!-- GPS Map -->
        <div class="bg-white p-4 rounded-lg shadow mb-4">
            <h2 class="font-semibold mb-2">Live Location</h2>
            <div id="map"></div>
        </div>

        <!-- Notifications -->
        <div class="bg-white p-4 rounded-lg shadow mb-4">
            <h2 class="font-semibold mb-2">Updates</h2>
            <div id="notifications">
                <p>Your order is {{ $order->status }}.</p>
            </div>
        </div>

        <!-- Contact Support -->
        <div class="text-center">
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Contact Support</button>
        </div>
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

                    // Update progress bar
                    const progressBar = document.querySelector('.bg-blue-600');
                    let width = '20%';
                    if (data.status === 'confirmed') width = '40%';
                    else if (data.status === 'preparing') width = '60%';
                    else if (data.status === 'ready') width = '80%';
                    else if (data.status === 'delivered') width = '100%';
                    progressBar.style.width = width;

                    // Update status colors
                    const statuses = ['pending', 'confirmed', 'preparing', 'ready', 'delivered'];
                    statuses.forEach((status, index) => {
                        const span = document.querySelector(`span:nth-child(${index + 1})`);
                        if (status === data.status) {
                            span.className = 'text-blue-500 font-bold';
                        } else {
                            span.className = 'text-gray-500';
                        }
                    });

                    // Add notification
                    const notifications = document.getElementById('notifications');
                    const newP = document.createElement('p');
                    newP.textContent = `Update: Your order is now ${data.status}.`;
                    notifications.appendChild(newP);

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
