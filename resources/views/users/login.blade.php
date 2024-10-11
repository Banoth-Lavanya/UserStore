@extends('layouts/main')
@section('page_title')Login @endsection
@section('custom-css')
@endsection

@section('content')
   

@if (session('success'))
    <div class="alert alert-success success-msg">
        {{ session('success') }}
    </div>
@endif

@if (session('user_id')) <!-- Check if the user is logged in -->
    <div class="alert alert-warning success-msg">
        Already logged in
    </div>
@else
<h1>Login</h1>
<div class="main-container ">
    <form action="{{ url('login') }}" method="POST">
        @csrf
        <div class="inner-form">
        <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
</div>
        <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
        </div>
    </form>
    </div> 
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="errors">
            @foreach ($errors->all() as $error)
                <li>
                    <span class="error">{{ $error }}</span>
                    @if (strpos($error, 'not registered') !== false)
                        <a href="{{ route('register') }}" class="btn btn-link">Register now</a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endif
    @endsection

@section('custom-js')
@endsection

