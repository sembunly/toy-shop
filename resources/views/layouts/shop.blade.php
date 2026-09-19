@extends('layouts.base')

@section('navigation')
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('products.index') }}">Products</a>
    <a href="{{ route('cart.index') }}">Cart</a>
    <a href="{{ route('checkout.index') }}">Checkout</a>
@endsection
