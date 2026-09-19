@extends('layouts.guest')

@section('title', 'Admin login')

@section('content')
    <h1>Admin login</h1>
    <p>Sign in with your administrator account.</p>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password">
        <label><input name="remember" type="checkbox" value="1" @checked(old('remember'))> Remember me</label>
        <button type="submit">Log in</button>
    </form>
    <a href="{{ route('password.request') }}">Forgot your password?</a>
@endsection
