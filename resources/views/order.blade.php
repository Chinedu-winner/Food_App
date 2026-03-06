<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://cdn.tailwindcss.com"></script>
<title>Order Page</title>
</head>
<body class="bg-gray-100 font-sans min-h-screen p-6">

<h1 class="text-2xl font-bold mb-4">Orders Page</h1>

<form action="/order" method="POST" class="bg-white p-6 rounded-lg shadow-lg max-w-md">
@csrf

<div class="mb-4">
    <input type="text" name="name" placeholder="Your Name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400" required>
</div>

<div class="mb-4">
    <input type="text" name="food_name" placeholder="Food Name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400" required>
</div>

<div class="mb-4">
    <input type="number" name="quantity" placeholder="Quantity" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400" required>
</div>

<div class="mb-4">
    <input type="text" name="price" placeholder="Price" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400" required>
</div>

<div class="mb-4">
    <input type="text" name="address" placeholder="Address" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400" required>
</div>

<div class="mb-4">
    <input type="text" name="phone" placeholder="Phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400" required>
</div>

<button type="submit" class="w-full bg-teal-500 text-white py-2 rounded-lg hover:bg-teal-600">Order Now</button>

</form>

</body>
</html>