@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')

    <div class="card">
        <div class="card-body">

            <h3 class="mb-4">Edit Product</h3>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label>Brand</label>
                        <input type="text" name="brand" value="{{ $product->brand }}" class="form-control">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label>SKU</label>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label>Price</label>
                        <input type="number" step="0.01" min="0" name="price"
                            value="{{ old('price', number_format($product->price, 2, '.', '')) }}" class="form-control">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label>Cost Price</label>
                        <input type="number" step="0.01" min="0" name="cost_price"
                            value="{{ old('cost_price', number_format($product->cost_price, 2, '.', '')) }}" class="form-control">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label>Stock</label>
                        <input type="number" min="0" name="stock" value="{{ old('stock', $product->stock) }}"
                            class="form-control">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" @selected((int) old('status', $product->status) === 1)>Active</option>
                            <option value="0" @selected((int) old('status', $product->status) === 0)>Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3 col-12 display-none">
                        <label>Description</label>
                        <textarea name="description" class="form-control"
                            rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mb-3 col-12">
                        <label>Image</label><br>

                        @if($product->image)
                            <img src="{{ $product->image_url }}" width="120" class="mb-2">
                        @endif

                        <input type="file" name="image" class="form-control">
                        <input type="url" name="image_url" class="form-control mt-2" value="{{ old('image_url') }}"
                            placeholder="Or paste image URL">
                    </div>

                </div>

                <button class="btn btn-primary">Update Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>

            </form>

        </div>
    </div>

@endsection
