<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register - Food App</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-purple-500 via-pink-500 to-red-500 flex items-center justify-center min-h-screen font-sans">

<div class="bg-white/90 backdrop-blur-md p-10 rounded-2xl shadow-2xl w-full max-w-md border border-white/30">

    <h2 class="text-3xl font-bold mb-2 text-center bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Create Account</h2>
    <p class="text-center text-gray-500 mb-6 text-sm">Join us and start ordering delicious meals 🍽️</p>

    <!-- Error message -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-3 mb-4 rounded-lg text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
    @csrf

    <div class="mb-4">
        <label class="block text-gray-700 mb-1 font-medium">Name</label>
        <input name="name" type="text" value="{{ old('name') }}" required
        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-1 font-medium">Email</label>
        <input name="email" type="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-1 font-medium">Password</label>
        <input name="password" type="password" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-400 focus:border-red-400 transition">
    </div>

    <div class="mb-6">
        <label class="block text-gray-700 mb-1 font-medium">Confirm Password</label>
        <input name="password_confirmation" type="password" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition">
    </div>

    <button type="submit" 
        class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 rounded-lg font-semibold hover:opacity-90 transition shadow-lg">Register</button>

    </form>

    <p class="mt-6 text-center text-gray-600 text-sm">
        Already have an account?
        <a href="{{ route('login') }}" class="text-purple-600 font-semibold hover:underline">
            Sign in
        </a>
    </p>

</div>

</body>
</html>