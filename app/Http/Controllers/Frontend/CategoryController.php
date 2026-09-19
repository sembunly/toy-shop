<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', true)->where('is_active', true)->withCount(['products' => function ($query) {
            $query->where('status', true)->where('is_active', true);
        }])->get();

        return view('frontend.categories.index', compact('categories'));
    }

    public function show(Category $category, Request $request)
    {
        abort_unless($category->status && $category->is_active, 404);
        $query = $category->products()->where('status', true)->where('is_active', true)->with('category');

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        switch ($request->sort) {
            case 'latest':
                $query->latest();
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12);

        return view('frontend.product.index', compact('category', 'products'));
    }

        public function products($id)
        {
            $category = Category::findOrFail($id);
            abort_unless($category->status && $category->is_active, 404);

            $products = $category->products()->where('status', true)->where('is_active', true)->latest()->paginate(12);

            return view('frontend.categories.products', compact('category', 'products'));
        }
    }
