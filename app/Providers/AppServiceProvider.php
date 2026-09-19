<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['admin.*', 'layouts.admin', 'partials.side-bar'], function ($view): void {
            $view->with('canAccessAdmin', static function (string $controller, string $action): bool {
                return match ($controller.'.'.$action) {
                    'dashboard.index',
                    'categories.index',
                    'categories.create',
                    'categories.edit',
                    'categories.destroy',
                    'products.index',
                    'products.create',
                    'products.edit',
                    'products.destroy',
                    'reports.index' => true,
                    default => false,
                };
            });
        });
    }
}
