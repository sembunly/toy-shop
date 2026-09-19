<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="m-0">Category: {{ $category->name }}</h3>
  <a class="btn btn-outline-dark btn-sm" href="{{ route('categories.index') }}">All Categories</a>
</div>

@if($products->count() == 0)
  <div class="alert alert-light border">No products in this category.</div>
@else
  <div class="row g-3">
    @foreach($products as $p)
      <div class="col-md-3">
        <div class="card h-100">
          @if($p->image)
            <img src="{{ $p->image_url }}"
                 style="height:160px;object-fit:cover;"
                 class="card-img-top" alt="Product">
          @endif

          <div class="card-body">
            <h6 class="card-title">{{ $p->name }}</h6>
            <div class="text-muted">${{ number_format($p->price,2) }}</div>
            
            <div class="d-flex gap-2 mt-2">
              <a class="btn btn-sm btn-primary w-100" href="{{ route('products.show', $p->id) }}">Detail</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mt-3">
    {{ $products->links('pagination::bootstrap-5') }}
  </div>
@endif
