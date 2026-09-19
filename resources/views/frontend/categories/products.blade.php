@extends('layouts.frontend')

@section('title', $category->name)
@section('hero_title', $category->name)
@section('hero_subtitle', 'Browse toys in this category')

@section('hero_action')
    <a class="px-4 btn btn-outline-dark pill" href="{{ route('categories.index') }}">
        <i class="bi bi-grid me-1"></i> All Categories
    </a>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="mb-3">
        <h3 class="mb-1 fw-bold">Products in {{ $category->name }}</h3>
        <p class="mb-0 text-muted">{{ $category->description ?: 'Explore toys from this category.' }}</p>
    </div>

    @if($products->count())
        <div class="row g-3">
            @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <article class="card soft-card product-list-card h-100">
                        @if($product->image)
                            <img src="{{ $product->image_url }}" class="thumb product-list-card__media" alt="{{ $product->name }}">
                        @else
                            <div class="noimg product-list-card__media d-flex align-items-center justify-content-center">
                                <span class="small text-muted">No Image</span>
                            </div>
                        @endif
                        <div class="card-body product-list-card__content d-flex flex-column">
                            <h3>{{ $product->name }}</h3>
                            <p class="product-list-card__availability {{ $product->stock > 0 ? 'is-available' : 'is-unavailable' }}">
                                {{ $product->stock > 0 ? 'In stock' : 'Out of stock' }}
                            </p>
                            <dl class="product-list-card__specs">
                                @if($product->brand)<div><dt>Brand:</dt><dd>{{ $product->brand }}</dd></div>@endif
                                <div><dt>Available:</dt><dd>{{ $product->stock }}</dd></div>
                            </dl>
                            <div class="product-list-card__price-row">
                                <span class="product-list-card__price">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <div class="gap-2 mt-auto d-flex product-list-card__actions">
                                <a class="btn btn-dark btn-sm pill w-100" href="{{ route('products.show', $product->id) }}">Detail</a>
                                <button type="button" class="btn btn-primary btn-sm pill w-100 js-add-to-cart"
                                        data-url="{{ route('cart.add', $product->id) }}"
                                        data-name="{{ $product->name }}"
                                        @disabled($product->stock < 1)>Add to Cart</button>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">{{ $products->links('pagination::bootstrap-5') }}</div>
    @else
        <div class="p-4 border alert alert-light rounded-4">
            <div class="fw-bold">No products found in this category.</div>
            <div class="text-muted">Please check another category.</div>
        </div>
    @endif
@endsection
