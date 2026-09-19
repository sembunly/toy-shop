@extends('layouts.admin')

@section('title', 'Your account')

@section('content')
    <h1>Your account</h1>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')
        <label for="name">Name</label>
        <input id="name" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
        <button type="submit">Save account</button>
    </form>
    <h2>Change password</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')
        <label for="current_password">Current password</label>
        <input id="current_password" name="current_password" type="password" required autocomplete="current-password">
        <label for="password">New password</label>
        <input id="password" name="password" type="password" required autocomplete="new-password">
        <label for="password_confirmation">Confirm password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
        @foreach ($errors->updatePassword->all() as $error)
            <p role="alert">{{ $error }}</p>
        @endforeach
        <button type="submit">Update password</button>
    </form>
@endsection
