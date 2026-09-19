@extends('layouts.guest')

@section('title', 'Confirm password')

@section('content')
    <h1>Confirm password</h1>
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password">
        <button type="submit">Confirm</button>
    </form>
@endsection
