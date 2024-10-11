@extends('layouts/main')

@section('page_title')Add Product @endsection

@section('custom-css')
@endsection

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (!session('user_id')) <!-- Check if the user is logged in -->
    <div class="alert alert-warning errors error">
        Please log in to access this page.
    </div>
@else
    <h1>Add New Product</h1>
    <div class="main-container ">

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="inner-form">
            <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        </div>
        <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" required></textarea>
        </div>
        <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required>
        </div>
        <button type="submit">Add Product</button>
        </div> 
    </form>
    </div> 
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="errors">
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
@section('custom-js')
@endsection
