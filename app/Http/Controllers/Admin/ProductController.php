<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')
            ->where('is_active', 1)
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::where('is_active', 1)
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);

        $data['is_active'] = 1;
        $data['image'] = $this->storeImage($request);
        unset($data['image_url']);

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        abort_if(!$product->is_active, 404);

        $categories = Category::where('is_active', 1)
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        abort_if(!$product->is_active, 404);

        $data = $this->validated($request);

        if ($request->hasFile('image') || $request->filled('image_url')) {
            if ($request->hasFile('image') && $product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            $data['image'] = $this->storeImage($request);
        }
        unset($data['image_url']);

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        abort_if(!$product->is_active, 404);

        $product->update([
            'is_active' => 0,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    private function validated(Request $request, bool $requireImage = false): array
    {
        $rules = [
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
                    ->where('is_active', 1),
            ],
            'name' => ['required', 'string', 'max:255'],
            'sku' => [
                'required',
                'string',
                'max:100',
                Rule::unique('products', 'sku')
                    ->ignore($request->route('product')?->id),
            ],
            'brand' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_url' => ['nullable', 'url', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ];

        if ($requireImage) {
            $rules['image_url'][] = 'required_without:image';
            $rules['image'][] = 'required_without:image_url';
        }

        return $request->validate($rules);
    }

    private function storeImage(Request $request): ?string
    {
        if (!$request->hasFile('image')) {
            return $request->input('image_url');
        }

        $file = $request->file('image');
        $directory = public_path('images/products');

        File::ensureDirectoryExists($directory);

        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move($directory, $filename);

        return 'images/products/' . $filename;
    }
}
