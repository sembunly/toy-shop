@extends('layouts.guest')

@section('title', 'Verify email')

@section('content')
    <h1>Verify email</h1>
    <p>Follow the verification link in your email.</p>
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Resend verification email</button>
    </form>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Log out</button>
    </form>
@endsection
