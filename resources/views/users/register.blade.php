<!-- resources/views/users/register.blade.php -->
@extends('layouts/main')
@section('page_title')Registration @endsection
@section('custom-css')
@endsection
@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="errors">
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('user_id')) <!-- Check if the user is logged in -->
    <div class="alert alert-warning errors error">
       Already logged in
    </div>
@else
<h1>Register</h1>
<div class="main-container">
    <form action="{{ url('register') }}" method="POST">
        @csrf
        <div class="inner-form">
        <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        </div>
        <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        </div>
        <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        </div>
        <div class="form-group">
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" required>
        </div>
        <div class="form-group">
        <label for="role">Role:</label>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="customer">Customer</option>
        </select>
        </div>
        <button type="submit">Register</button>
</div>
    </form>
</div>
@endif
@endsection

@section('custom-js')



@endsection
