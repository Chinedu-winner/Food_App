<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://cdn.tailwindcss.com"></script>
<title>Track Order</title>
</head>
<body class="bg-gray-100 font-sans min-h-screen p-6">

<h1 class="text-2xl font-bold mb-4">Track Your Order</h1>

<form action="/track" method="POST" class="bg-white p-6 rounded-lg shadow-lg max-w-md">
@csrf

<div class="mb-4">
    <input type="text" name="order_id" placeholder="Enter Order ID" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400" required>
</div>

<button type="submit" class="w-full bg-teal-500 text-white py-2 rounded-lg hover:bg-teal-600">Track Order</button>

</form>

</body>
</html>

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
