# Toy Shop

A small Laravel 12 e-commerce toy shop built with Laravel Blade and MySQL.

Customers can browse toys, view details, add items to a cart, and check out as guests. Administrators must log in before managing categories, products, stock, orders, and sales information.

## Features

### Customer storefront

- Home page
- Product list and product details
- Category browsing
- Guest cart and checkout
- Order success page
- Responsive Blade UI

### Admin panel

- Admin authentication
- Dashboard
- Category management
- Product management
- Stock and order pages
- Sales summary
- Product/category status controls

`status` controls whether a record is active:

- `1` = Active
- `0` = Inactive

`is_active` controls visibility/deletion:

- `1` = Shown
- `0` = Hidden/deleted

Hidden products and categories are excluded from the storefront.

## Requirements

- PHP 8.2 or newer
- Composer
- MySQL
- Node.js and npm if frontend assets need to be rebuilt

## Installation

```bash
cd /Users/macbook/Documents/Project/toy-shop
composer install
cp .env.example .env
php artisan key:generate
```

Configure the database connection in `.env`, then run:

```bash
php artisan migrate
php artisan db:seed
php artisan serve
```

Open `http://127.0.0.1:8000`.

## Admin user

Set these values in `.env`:

```ini
ADMIN_NAME=Administrator
ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=change-this-password
```

Create or update the administrator:

```bash
php artisan db:seed --class=AdminUserSeeder
```

The admin login page is `/login`. Admin pages are under `/admin`.

## Sample toy data

The default database seeder creates three toy categories and twelve sample products:

```bash
php artisan db:seed --class=ToyShopSeeder
```

The sample products do not include images.

## Images

Product uploads are saved in:

```text
public/images/products
```

Category uploads are saved in:

```text
public/images/categories
```

Admin forms accept either an uploaded image or an image URL.

## Development checks

```bash
php artisan view:cache
php artisan test
```
