@extends('admin.admin')

@section('page-title', 'Dashboard Overview')

@section('content')
    <div class="flex justify-between items-center mb-8">

        <h1 class="text-3xl font-bold">Dashboard Overview</h1>

        <div class="text-gray-600">Welcome {{ Auth::user()->name }}</div>

    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-4 gap-6 mb-10">
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

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-500">Users</h3>
            <p class="text-2xl font-bold">120</p>
        </div>
    </div>

    <!-- Recent Admin Logins -->
    <div class="bg-white rounded shadow p-6 mb-10">
        <h2 class="text-xl font-semibold mb-4">Recent Admin Logins</h2>
        @if(isset($recentLogins) && $recentLogins->count())
            <ul class="divide-y divide-gray-200">
                @foreach($recentLogins as $log)
                    <li class="py-2">Admin: <strong>{{ $log->admin->name ?? 'N/A' }}</strong> logged in from {{ $log->ip_address }} - <span class="text-gray-500 text-sm">{{ $log->created_at->diffForHumans() }}</span></li>
                @endforeach
            </ul>
        @else
            <p>No recent admin logins found.</p>
        @endif
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
@endsection

@push('scripts')
<script>
    let idleTime = 0;

    let idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    document.onmousemove = document.onkeypress = function() {
        idleTime = 0;
    };

    function timerIncrement() {
        idleTime++;
        if (idleTime > 5) { // 5 minutes
            alert("You have been logged out due to inactivity.");
            window.location.href = "{{ route('admin.login') }}";
        }
    }
</script>
@endpush