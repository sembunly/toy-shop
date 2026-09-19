<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ShopStructureTest extends TestCase
{
    use RefreshDatabase;

    public static function storefrontPages(): array
    {
        return [
            ['/', 'frontend.home'],
            ['/products', 'frontend.product.index'],
            ['/cart', 'frontend.cart.index'],
            ['/checkout', 'frontend.checkout.index'],
            ['/checkout/success', 'checkout.success'],
        ];
    }

    public static function adminPages(): array
    {
        return [
            ['/admin/dashboard'],
            ['/admin/categories'],
            ['/admin/products'],
            ['/admin/orders'],
            ['/admin/stock'],
            ['/admin/sales-summary'],
            ['/admin/profile'],
        ];
    }

    #[DataProvider('storefrontPages')]
    public function test_storefront_pages_are_accessible_without_login(string $url, string $view): void
    {
        $this->get($url)->assertOk()->assertViewIs($view);
        $this->assertGuest();
    }

    #[DataProvider('adminPages')]
    public function test_guests_must_login_before_accessing_admin_pages(string $url): void
    {
        $this->get($url)->assertRedirect(route('login'));
    }

    #[DataProvider('adminPages')]
    public function test_existing_customers_cannot_access_admin_pages(string $url): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        $this->actingAs($customer)->get($url)->assertForbidden();
    }

    #[DataProvider('adminPages')]
    public function test_admins_can_render_all_admin_pages(string $url): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get($url)->assertOk();
    }

    public function test_existing_customers_cannot_login_through_either_admin_login_url(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        foreach (['/login', '/admin/login'] as $url) {
            $this->post($url, [
                'email' => $customer->email,
                'password' => 'password',
            ])->assertSessionHasErrors('email');
            $this->assertGuest();
        }
    }

    public function test_admin_login_preserves_the_intended_destination(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->get('/admin/orders')->assertRedirect(route('login'));
        $this->get('/admin/login')->assertOk();

        $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'password',
        ])->assertRedirect('/admin/orders');

        $this->assertAuthenticatedAs($admin);
    }

    public function test_existing_customer_sessions_can_still_logout(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        $this->actingAs($customer)->post('/logout')->assertRedirect('/');

        $this->assertGuest();
    }

    public function test_login_attempts_are_rate_limited(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post('/login', [
                'email' => $admin->email,
                'password' => 'incorrect-password',
            ])->assertSessionHasErrors('email');
        }

        $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_legacy_api_and_google_routes_are_removed(): void
    {
        foreach ([
            '/api/sales-data', '/api/api-products', '/api/api-categories',
            '/api/api-orders', '/api/api-orderitems', '/api/api-users',
            '/api/csrf-token', '/api/documentation', '/docs',
            '/auth/google', '/auth/google-callback',
        ] as $url) {
            $this->get($url)->assertNotFound();
        }

        $this->post('/api/test-email')->assertNotFound();
        $this->post('/api/test-invoice-email')->assertNotFound();

        foreach (Route::getRoutes() as $route) {
            $this->assertFalse(str_starts_with($route->uri(), 'api/'));
        }
    }

    public function test_checkout_scaffold_cannot_create_orders(): void
    {
        $this->post('/checkout', ['full_name' => 'Guest'])->assertRedirect(route('checkout.index'));
        $this->get('/checkout/success')->assertSee('No order has been placed.');
        $this->assertDatabaseCount('orders', 0);
    }

    public function test_web_forms_still_require_csrf_tokens(): void
    {
        // Laravel normally skips CSRF validation under the testing environment.
        $this->app->instance('env', 'local');

        $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ])->assertStatus(419);
    }
}
