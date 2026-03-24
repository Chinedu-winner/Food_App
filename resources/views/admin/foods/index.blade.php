@extends('admin.admin')

@section('page-title', 'Food List')

@section('content')
<h1 class="text-2xl font-bold mb-4">Food List</h1>

<table class="table-auto w-full border">
    <thead>
        <tr>
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Category</th>
            <th class="border px-4 py-2">Price</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($foods as $food)
        <tr>
            <td class="border px-4 py-2">{{ $food->id }}</td>
            <td class="border px-4 py-2">{{ $food->name }}</td>
            <td class="border px-4 py-2">{{ $food->category->name ?? 'N/A' }}</td>
            <td class="border px-4 py-2">${{ $food->price }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('admin.foods.edit', $food->id) }}" class="text-blue-500">Edit</a>
                <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $foods->links() }}
@endsection