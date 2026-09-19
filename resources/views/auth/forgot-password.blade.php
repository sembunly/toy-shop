@extends('layouts.guest')

@section('title', 'Forgot password')

@section('content')
    <h1>Forgot password</h1>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username">
        <button type="submit">Email password reset link</button>
    </form>
@endsection
