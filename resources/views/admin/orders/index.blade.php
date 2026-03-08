@extend ('admin.layout')

@section ('page-title', 'Orders Management')

@section ('content')
<table>
    <thead>
        <tr>        
                <th>ID</th>
                <th>Customer</th>
                <th>Food</th> 
                <th>Qty</th> 
                <th>Price</th>
                <th>status</th>
                <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach(order as $order)
        <tr class="border-t">
            <td>{{$orders->id}}</td>
            <td>{{$orders->custmoer_name}}</td>
            <td>{{$orders->food_name}}</td>
            <td>{{$orders->quality}}</td>
            <td>{{$orders-> price}}</td>
            <td>{{$orders-> status}}</td>

            <form action="{{route('admin.order.edit', $order->id)}}" method="POST">
                @csrf
                <select name="status">
                    <option value="pending"{{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing"{{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="delivered"{{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled"{{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="btn btn-primary">Update Status</button>
            </form>
            <form action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection