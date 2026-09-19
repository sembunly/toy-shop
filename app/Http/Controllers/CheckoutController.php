<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View
    {
        return view('frontend.checkout.index', ['cart' => session('cart', [])]);
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('checkout.index')
            ->with('status', 'Checkout processing will be enabled in the next phase.');
    }

    public function success(): View
    {
        return view('checkout.success');
    }
}
