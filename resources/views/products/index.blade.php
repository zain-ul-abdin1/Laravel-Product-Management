@extends('layout')
@section('title', 'All Products')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>All Products</h1>
        <a href="/products/create" class="btn btn-primary">Add New Product</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>Rs {{ number_format($product->price, 2) }}</td>
                            <td><a href="/products/{{ $product->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                                <form action="/products/{{ $product->id }} "method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are You Sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
