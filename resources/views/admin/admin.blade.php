<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin Dashboard - FoodWin</title>
</head>
<body class="flex h-screen bg-gray-100">

    <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
        <div class="p-6 text-xl font-bold">FoodWin Admin</div>
        <nav class="mt-6">
            <ul>
                <li class="mb-2"><a href="{{ route('admin.dashboard') }}" class="block px-6 py-2 hover:bg-gray-700">Dashboard</a></li>
                <li class="mb-2"><a href="{{ route('admin.orders') }}" class="block px-6 py-2 hover:bg-gray-700">Orders</a></li>
                <li class="mb-2"><a href="{{ route('admin.foods') }}" class="block px-6 py-2 hover:bg-gray-700">Foods</a></li>
                <li class="mb-2"><a href="{{ route('admin.categories') }}" class="block px-6 py-2 hover:bg-gray-700">Categories</a></li>
                <li class="mb-2"><a href="{{ route('admin.users') }}" class="block px-6 py-2 hover:bg-gray-700">Users</a></li>
                <li class="mb-2"><a href="{{ route('admin.logout') }}" class="block px-6 py-2 hover:bg-gray-700">Logout</a></li>
            </ul>
        </nav>
    </aside>

    <div class="flex-1 p-6 overflow-auto">

        <div class="mb-6 text-2xl font-bold">
            @yield('page-title')
        </div>
        <div>
            @yield('content')
        </div>
    </div>

</body>
</html>