<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('is_active', 1)
            ->latest()
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);

        $data['is_active'] = 1;
        $data['image'] = $this->storeImage($request);
        unset($data['image_url']);

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        abort_if(!$category->is_active, 404);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        abort_if(!$category->is_active, 404);

        $data = $this->validated($request);

        if ($request->hasFile('image') || $request->filled('image_url')) {
            if ($request->hasFile('image') && $category->image && File::exists(public_path($category->image))) {
                File::delete(public_path($category->image));
            }

            $data['image'] = $this->storeImage($request);
        }
        unset($data['image_url']);

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        abort_if(!$category->is_active, 404);

        if ($category->products()->where('is_active', 1)->exists()) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'This category cannot be deleted while it has products.');
        }

        $category->update([
            'is_active' => 0,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    private function validated(Request $request, bool $requireImage = false): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:categories,slug,' . $request->route('category')?->id,
            ],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_url' => ['nullable', 'url', 'max:255'],
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
        $directory = public_path('images/categories');

        File::ensureDirectoryExists($directory);

        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move($directory, $filename);

        return 'images/categories/' . $filename;
    }
}
