@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card card-rounded shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <h3 class="mb-0">Add Product</h3>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light">
                        Back
                    </a>
                </div>

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($categories->isEmpty())
                        <div class="alert alert-warning">
                            Add a category before creating a product.
                            <a href="{{ route('admin.categories.create') }}" class="alert-link">Create category</a>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter product name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control" placeholder="Enter brand">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" class="form-control" placeholder="Enter SKU">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" min="0" name="price" class="form-control" placeholder="Enter price">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cost Price</label>
                            <input type="number" step="0.01" min="0" name="cost_price" class="form-control" placeholder="Enter cost price">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" min="0" name="stock" class="form-control" placeholder="Enter stock quantity">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" @selected(old('status', '1') == '1')>Active</option>
                                <option value="0" @selected(old('status') === '0')>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="4" class="form-control" placeholder="Enter product description"></textarea>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                            <input type="url" name="image_url" class="form-control mt-2" value="{{ old('image_url') }}"
                                placeholder="Or paste image URL">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Save Product
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
