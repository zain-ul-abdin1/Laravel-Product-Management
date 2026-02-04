@extends('layout')
@section('title', 'All Products')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>All Products</h1>
        @auth
            <a href="/products/create" class="btn btn-primary">Add New Product</a>
        @endauth
    </div>
    @if (request('category'))
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <span>
                Showing products in:
                <strong>{{App\Models\Category::find(request('category'))->name ?? "Unknown Category"}}</strong>
            </span>
            <a href="/products" class="btn btn-sm btn-secondary">Show All Products</a>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Categories</th>
                        @auth
                            <th>Actions</th>
                        @endauth
                    </tr>
                </thead>
                </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>Rs {{ number_format($product->price, 2) }}</td>
                            <td>
                                @if ($product->category)
                                    <a href="/products?category={{ $product->category->id }}"
                                        class="badge bg-primary text-decoration-none">{{ $product->category->name }}</a>
                                @else
                                    <span class="badge bg-secondary">No Category</span>
                                @endif
                            </td>
                            <td>
                                @auth
                                    <a href="/products/{{ $product->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="/products/{{ $product->id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @else
                                    <span class="text-muted">Login to edit</span>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
