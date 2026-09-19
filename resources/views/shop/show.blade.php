@extends('layouts.shop')

@section('title', 'Product detail')

@section('content')
    <h1>Product detail</h1>
    {{-- Route placeholder only; no product or price is loaded yet. --}}
    <p>Details for toy #{{ $productId }} will be available when the catalogue opens.</p>
    <a href="{{ route('products.index') }}">Back to toys</a>
@endsection
