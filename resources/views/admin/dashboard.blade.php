<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white p-6">

        <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>

        <nav class="space-y-4">

            <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Dashboard</a>
            <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">User</a>
            <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Restaurants</a>
            <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Meals</a>
            <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Orders</a>
            <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Payments</a>
            <a href="#" class="block py-2 px-3 rounded hover:bg-red-600 mt-8">Logout</a>
        </nav>

    </aside>

    <main class="flex-1 p-8">

        <div class="flex justify-between items-center mb-8">

            <h1 class="text-3xl font-bold">Dashboard Overview</h1>

            <div class="text-gray-600">Welcome Admin </div>

        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-4 gap-6 mb-10">

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Total Users</h3>
                <p class="text-2xl font-bold">120</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Total Orders</h3>
                <p class="text-2xl font-bold">85</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Restaurants</h3>
                <p class="text-2xl font-bold">15</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Revenue</h3>
                <p class="text-2xl font-bold">₦450,000</p>
            </div>

        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded shadow p-6">

            <h2 class="text-xl font-semibold mb-4">
                Recent Orders
            </h2>

            <table class="w-full text-left border">

                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3">Order ID</th>
                        <th class="p-3">Customer</th>
                        <th class="p-3">Food</th>
                        <th class="p-3">Amount</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="border-t">
                        <td class="p-3">#101</td>
                        <td class="p-3">John Doe</td>
                        <td class="p-3">Pizza</td>
                        <td class="p-3">₦5000</td>
                        <td class="p-3 text-yellow-600">Pending</td>
                    </tr>

                    <tr class="border-t">
                        <td class="p-3">#102</td>
                        <td class="p-3">Mary Smith</td>
                        <td class="p-3">Burger</td>
                        <td class="p-3">₦3500</td>
                        <td class="p-3 text-green-600">Completed</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

</div>

</body>
</html>

<script>
let idleTime = 0;

let idleInterval = setInterval(timerIncrement, 60000);

document.onmousemove = document.onkeypress = function() {
    idleTime = 0;
};

function timerIncrement() {
    idleTime++;
    if (idleTime > 5){
        alert("You have been logged out due to inactivity.");
        window.location.href = "{{ route('login') }}";
    }
}
</script>