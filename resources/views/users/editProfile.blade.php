@extends('layouts/main')

@section('page_title') Edit Profile @endsection

@section('content')
<div class="container">
    <h1>Edit Profile</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="main-container ">
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="inner-form">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
</div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="errors">
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
