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
