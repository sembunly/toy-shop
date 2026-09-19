@extends('layouts.shop')

@section('title', 'Welcome to Toy Shop')

@section('content')
    <h1>Welcome to Toy Shop</h1>
    <p>A little imagination, a lot of play. Our toy collection is coming soon.</p>
    <a class="button" href="{{ route('products.index') }}">Browse toys</a>
@endsection
