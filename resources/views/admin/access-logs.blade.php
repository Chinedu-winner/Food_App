@extends('admin.layouts.app') <!-- or your admin layout -->

@section('content')
<h1>Admin Access Logs</h1>

<table class="table-auto border-collapse border border-gray-300 w-full">
    <thead>
        <tr>
            <th class="border px-4 py-2">Admin Name</th>
            <th class="border px-4 py-2">IP Address</th>
            <th class="border px-4 py-2">User Agent</th>
            <th class="border px-4 py-2">Login Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
            <tr>
                <td class="border px-4 py-2">{{ $log->admin->name ?? 'N/A' }}</td>
                <td class="border px-4 py-2">{{ $log->ip_address }}</td>
                <td class="border px-4 py-2">{{ $log->user_agent }}</td>
                <td class="border px-4 py-2">{{ $log->logged_in_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $logs->links() }} 
</div>
@endsection