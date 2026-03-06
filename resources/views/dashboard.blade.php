<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<title>Food App Dashboard</title>
</head>
<body class="flex bg-gray-100 font-sans min-h-screen">

<div class="w-60 h-screen bg-white p-6 shadow-lg flex flex-col">
  <h2 class="text-2xl font-bold text-teal-500 mb-8">FoodWin</h2>
  <ul class="space-y-3 flex-1">
    <li class="px-4 py-2 rounded-lg bg-teal-500 text-white flex items-center gap-2 cursor-pointer">
      <span>🏠</span> Dashboard</li>
      <li class="px-4 py-2 rounded-lg text-gray-600 hover:bg-teal-500 hover:text-white flex items-center gap-2 cursor-pointer">
        <span>👥</span> Admin page
      </li>
    <li class="px-4 py-2 rounded-lg text-gray-600 hover:bg-teal-500 hover:text-white flex items-center gap-2 cursor-pointer">
      <a href="{{ route('order') }}" class="flex items-center gap-2"><span>🛒</span> Orders</a></li>
      <li class="px-4 py-2 rounded-lg text-gray-600 hover:bg-teal-500 hover:text-white flex items-center gap-2 cursor-pointer">
        <a href="{{ route('track') }}" class="flex items-center gap-2"><span>✉️</span> Track</a>
      </li>
    <li class="px-4 py-2 rounded-lg text-gray-600 hover:bg-teal-500 hover:text-white flex items-center gap-2 cursor-pointer">
      <span>📊</span> Analytics
    </li>
    <li class="px-4 py-2 rounded-lg text-gray-600 hover:bg-teal-500 hover:text-white flex items-center gap-2 cursor-pointer">
      <span>⚙️</span> Settings
    </li>
  </ul>
  <div class="text-sm text-gray-500 mt-auto">© 2026 Sedap</div>
</div>

<div class="flex-1 p-6">

  <div class="flex justify-between items-center mb-6">
    <input type="text" placeholder="Search..." 
      class="w-80 px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-400"/>
    <div class="flex items-center gap-4">
      <button class="relative">       🔔
        <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
      </button>
      <div class="flex items-center gap-2">
        <img src="https://i.pravatar.cc/40" alt="avatar" class="w-8 h-8 rounded-full"/>
        <span class="text-gray-700">Hello, {{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
      </div>
    </div>
  </div>


  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-xl transition-shadow">
      <h3 class="text-2xl font-bold mb-1">75</h3>
      <span class="text-gray-500">Total Orders</span>
    </div>
    <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-xl transition-shadow">
      <h3 class="text-2xl font-bold mb-1">$357</h3>
      <span class="text-gray-500">Total Revenue</span>
    </div>
    <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-xl transition-shadow">
      <h3 class="text-2xl font-bold mb-1">65</h3>
      <span class="text-gray-500">Delivered</span>
    </div>
    <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-xl transition-shadow">
      <h3 class="text-2xl font-bold mb-1">12</h3>
      <span class="text-gray-500">Pending</span>
    </div>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-5 rounded-xl w-full h-64 mx-auto shadow-md">
      <h4 class="font-medium mb-3 text-gray-700 text-center">Orders Distribution</h4>
      <canvas id="chartupdate" class=""></canvas>
    </div>
    <div class="bg-white p-5 rounded-xl  w-full h-64 mx-auto shadow-md">
      <h4 class="font-medium mb-3 text-gray-700 text-center">Revenue Distribution</h4>
      <canvas id="updatepie"></canvas>
    </div>
  </div>

  <div class="bg-white p-5 rounded-xl shadow-md mb-8">
    <h4 class="font-medium mb-3 text-gray-700 text-center">Weekly Orders Trend</h4>
    <canvas id="chartlink"></canvas>
  </div>
  <div>
    <button>
      <a href="{{ route('meal') }}" class="px-4 py-2 w-100 bg-red-500 text-white rounded hover:bg-red-600 transition">Order now </a>
    </button>
  </div>

</div>

<script>
const chart1 = document.getElementById('chartupdate');
const chart2 = document.getElementById('updatepie');
const chart3 = document.getElementById('chartlink');

const pieData = {
  labels: ['Produce', 'Order', 'Delivered'],
  datasets: [{
    data: [57, 20, 23],
    backgroundColor: ['#14b8a6', '#facc64', '#ef4444']
  }]
};

const barData = {
  labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
  datasets: [{
    label: 'Orders',
    data: [12, 19, 14, 18, 22, 16, 20],
    backgroundColor: '#14b8a6'
  }]
};

new Chart(chart1, { type: 'pie', data: pieData, options: { responsive: true, plugins: { legend: { position: 'bottom' } } }});
new Chart(chart2, { type: 'pie', data: pieData, options: { responsive: true, plugins: { legend: { position: 'bottom' } } }});
new Chart(chart3, { type: 'bar', data: barData, options: { responsive: true, plugins: { legend: { display: false } } }});
</script>