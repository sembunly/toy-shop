# Toy Shop scaffold

This is the first preparation phase: Laravel Blade pages, web routes, and existing Breeze session authentication. No React, Vue, REST API, JavaScript build, or npm installation is needed.

## Pages

| Area | URL | Route name |
| --- | --- | --- |
| Home | `/` | `home` |
| Product list | `/products` | `products.index` |
| Product detail placeholder | `/products/{product}` (numeric ID) | `products.show` |
| Cart | `/cart` | `cart.index` |
| Guest checkout | `/checkout` | `checkout.index` |
| Order success placeholder | `/checkout/success` | `checkout.success` |
| Admin login | `/admin/login` or `/login` | `admin.login` / `login` |
| Dashboard | `/admin/dashboard` | `admin.dashboard` |
| Categories | `/admin/categories` | `admin.categories.index` |
| Products | `/admin/products` | `admin.products.index` |
| Orders | `/admin/orders` | `admin.orders.index` |
| Stock | `/admin/stock` | `admin.stock.index` |
| Sales summary | `/admin/sales-summary` | `admin.sales-summary` |
| Admin account | `/admin/profile` | `profile.edit` |

Every admin page except login requires both `auth` and `admin` middleware. Login uses the existing users table, session guard, password hashing, session regeneration, remember-me support, and throttling; only users with `role = admin` may log in. Password reset, password confirmation, email verification, and account management remain available. Any existing authenticated session can log out.

Public registration and Google sign-in are removed. Customers do not need an account to visit the storefront or checkout page.

## Local setup

Dependencies have been installed with `composer install`. On another checkout, run that command first.

Keep an existing `.env`; the scaffold did not change it. For a fresh environment, copy `.env.example` to `.env`, then run `php artisan key:generate`. The example defaults to SQLite, local URLs, and log mail. If using an existing environment, set local session cookie/domain options and application URL appropriately. Use `MAIL_MAILER=log` locally or Laravel's SMTP transport with your mail provider; the old custom SendGrid transport was removed.

For a new SQLite database, create an empty `database/database.sqlite` file before migrating. Alternatively, configure MySQL in `.env`. Run `php artisan migrate` only against your intended database, then `php artisan serve`. No migrations or seeders were run against your configured database during this work.

Existing administrators can use their current credentials. No shared demo account or default password is installed. If the database has no administrator, create one explicitly through `php artisan tinker`, for example:

```php
\App\Models\User::create([
    'name' => 'Shop Administrator',
    'email' => 'your-admin@example.com',
    'password' => \Laravel\Prompts\password('Choose an admin password', required: true),
    'role' => 'admin',
]);
```

The existing User model hashes the password. Use your own administrator email. The old seeders for laptop products, fake orders, customer accounts, and shared admin credentials were removed; `DatabaseSeeder` now does nothing.

## Scope and next phase

All shop and admin business pages are placeholders. Product detail accepts a numeric ID only to demonstrate the page route; it does not fetch or validate a product record. There are no cart mutations, order submissions, payment requests, stock updates, CRUD actions, or sales calculations. The success page clearly states that no order was placed and exposes no order data.

Existing models, factories, migration history, SQL files, and remaining uploaded/theme assets have been left in place. Before implementing real guest orders, add a forward migration allowing orders without a user account (`orders.user_id` is currently required), replace laptop-specific product fields, and define guest order access/confirmation rules. No existing database tables were dropped or rewritten.

The old REST controllers, Swagger configuration and generated documentation, API testing endpoints, Postman collection, duplicated frontend routes/views, custom group-permission code, payment integrations, invoice/export code, and customer social authentication have been removed. Their unused Composer dependencies were removed with Composer while preserving the remaining locked versions.

## Validation

```sh
composer validate --no-check-publish
php artisan test --compact
php artisan route:list --except-vendor
php artisan view:cache
php artisan view:clear
php artisan route:cache
php artisan route:clear
```

Tests use an isolated in-memory SQLite database, array sessions/cache/mail, and a test-only application key from `phpunit.xml`. They do not use your configured application database.

See [the complete file-change list](toy-shop-changes.md) for every source file added, modified, or removed by this task.
