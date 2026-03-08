@extends('layout')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-orange-400 via-red-400 to-pink-500 py-12">

    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-10 text-white">
            <h1 class="text-4xl font-extrabold mb-2">
                Track Your Order
            </h1>
            <p class="text-lg opacity-90">
                Enter your order ID to see where your food is
            </p>
        </div>

        @if ($errors->any())
        <div class="max-w-md mx-auto mb-6">
            <div class="bg-white border-l-4 border-red-500 text-red-700 px-5 py-4 rounded-lg shadow-lg">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
        @endif


        <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-2xl">

            <h2 class="text-xl font-bold text-gray-700 mb-6 text-center">Enter Order ID</h2>

            <form method="POST" action="{{ route('track') }}">
                @csrf

                <label class="block text-gray-600 font-semibold mb-2">
                    Order ID
                </label>

                <input type="number" id="order_id" name="order_id" placeholder="e.g 1023" class="w-full px-4 py-3 border-2 border-orange-300 rounded-lg focus:outline-none focus:border-orange-500" required>

                <button type="submit" class="w-full mt-6 bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold py-3 rounded-lg hover:opacity-90 transition shadow-lg">    Track Order</button>

            </form>

        </div>

        @isset($order)
        <div class="mt-12">

            <div class="flex items-center justify-between mb-4 text-white">
                <h2 class="text-2xl font-bold">
                    Delivery Location
                </h2>

                <span class="bg-white text-red-500 font-bold px-4 py-1 rounded-full shadow">
                    Order #{{ $order->id }}
                </span>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div id="map" class="w-full h-[450px]"></div>
            </div>

        </div>
        @endisset

    </div>
</div>
@endsection


@section('scripts')
@isset($order)

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>

var orderLat = {{ $order->latitude ?? 6.5244 }};
var orderLng = {{ $order->longitude ?? 3.3792 }};

var map = L.map('map').setView([orderLat, orderLng], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

L.marker([orderLat, orderLng])
    .addTo(map)
    .bindPopup("<b>Your Order Location</b>")
    .openPopup();

</script>

@endisset
@endsection