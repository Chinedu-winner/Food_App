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
                <a href="{{ route('admin.food.edit', $food->id) }}" class="text-blue-500">Edit</a>
                <form action="{{ route('admin.food.destroy', $food->id) }}" method="POST" style="display:inline;">
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

    @foreach($foodsByCategory as $categoryName => $foods)
    <h2>{{ $categoryName }}</h2>
    <div class="foods">
        @foreach($foods as $food)
            <div class="food-item">
                <h3>{{ $food->name }}</h3>
                <p>{{ $food->description }}</p>
                <p>Price: ${{ $food->price }}</p>
                @if($food->image)
                    <img src="{{ asset('images/' . $food->image) }}" alt="{{ $food->name }}">
                @endif
            </div>
        @endforeach
    </div>
@endforeach 