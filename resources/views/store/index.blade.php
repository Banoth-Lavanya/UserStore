@extends('layouts/main')

@section('page_title') Add Product @endsection

@section('custom-css')
@endsection

@section('content')
@if (!session('user_id')) <!-- Check if the user is logged in -->
    <div class="alert alert-warning errors error">
        Please log in to access this page.
    </div>
@else
    @if (session('success'))
        <div class="alert alert-success success-msg">
            {{ session('success') }}
        </div>
    @endif
    <div class="products-container">
    <h1>Product List</h1>
    
    @if ($products->isEmpty())
        <div class="alert alert-warning">You have no products yet. <a href="{{ route('products.create') }}">Add one now!</a></div>
    @else
  <div class="container">
    <table class="table dataTable display table table-striped table-bordered dt-responsive" id="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>${{ $product->price }}</td>
                    <td class="actions">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
</div>
@endif
@endif
@endsection

@section('custom-js')
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            "responsive": true,
                    "bDestroy": true

        });
    });
</script>
@endsection

