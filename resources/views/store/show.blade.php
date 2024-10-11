@extends('layouts/main')
@section('page_title')Product Details @endsection

@section('custom-css')
@endsection

@section('content')

@if (!session('user_id')) <!-- Check if the user is logged in -->
    <div class="alert alert-warning error errors">
        Please log in to access this page.
    </div>
@else
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="main-container">
    <div class="container profile-details prod-details">
        <h1>{{ $product->name }}</h1>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> ${{ $product->price }}</p>
        <p><strong>User ID:</strong> {{ $product->userId }}</p>
        <!-- <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a> -->
    </div>
    </div>
@endif

@endsection

@section('custom-js')
@endsection
