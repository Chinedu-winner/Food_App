<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - Food App</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-teal-400 via-blue-400 to-indigo-500 font-sans">

<div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Sign in to your account</h2>

    @if($errors->any())
    <div class="text-red-600 text-sm mb-4 px-3 py-2 bg-red-100 rounded">
        {{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
    @csrf
    <div>
        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
        <input id="email" name="email" type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400"value="{{ old('email') }}" required autofocus>
    </div>

    <div>
        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
        <input id="password" name="password" type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400"required>
    </div>

    <div class="flex justify-between items-center text-sm text-gray-600">
        <label class="flex items-center gap-2">
        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300">Remember me
        </label>
        <a href="#" class="hover:text-teal-500">Forgot?</a>
    </div>

    <button type="submit" 
        class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 rounded-lg transition-colors duration-200">Sign In</button>

    <a href="/" class="block text-center mt-2 text-gray-500 hover:text-gray-700">Cancel</a>
    </form>

    <p class="mt-6 text-center text-gray-600 text-sm">Don't have an account? 
    <a href="{{ route('register') }}" class="text-teal-500 hover:text-teal-600 font-medium">Register</a>
    <a href="{{ url('login/google') }}" class="bg-red-500 text-white py-2 px-4 rounded">Sign in with Google</a>
    </p>
</div>

</body>
</html>