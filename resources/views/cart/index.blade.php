@extends('layouts.shop')

@section('title', 'Your cart')

@section('content')
    <h1>Your cart</h1>
    <p>Shopping will be available soon.</p>
    <a href="{{ route('products.index') }}">Browse toys</a>
@endsection
