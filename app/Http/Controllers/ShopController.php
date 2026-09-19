<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        return view('shop.index');
    }

    public function show(string $product): View
    {
        return view('shop.show', ['productId' => $product]);
    }
}
