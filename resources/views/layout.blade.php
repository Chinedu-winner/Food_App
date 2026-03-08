<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food App - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    @yield('styles')
</head>
<body class="min-h-screen bg-gradient-to-r from-orange-400 via-red-400 to-pink-500">
    
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto">
            <a href="{{ url('/') }}" class="font-bold text-lg">Food App</a>
        </div>
    </nav>

    <main class="container mx-auto mt-6">
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>