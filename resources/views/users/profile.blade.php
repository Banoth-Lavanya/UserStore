@extends('layouts/main')
@section('page_title')User Profile @endsection

@section('content')


    @if (session('success'))
        <div class="alert alert-success success-msg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning success-msg">
            {{ session('warning') }}
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
    <div class="main-container">
        
    <h1>User Profile</h1>
    <div class="profile-details">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p> <!-- Show User Role -->
        <p><strong>User ID:</strong> {{ $user->id }}</p> <!-- Optional: Show User ID -->
    </div>
</div>
@endsection

@section('custom-js')
@endsection
