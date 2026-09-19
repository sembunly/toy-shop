# Toy Shop file changes

This list covers source files changed by this task, including changes made before the interruption. Composer-installed vendor files and generated Laravel/PHPUnit caches are excluded.

Validation: 58 tests passed (189 assertions); Composer validation, Blade compilation, route caching, and PHP syntax checks passed.

The application database, existing models/migrations, local .env, artisan, and the independently edited README.md were not modified.

## Added (20)

- `app/Http/Controllers/Admin/StockController.php`
- `app/Http/Controllers/CartController.php`
- `app/Http/Controllers/CheckoutController.php`
- `app/Http/Controllers/HomeController.php`
- `app/Http/Controllers/ShopController.php`
- `docs/toy-shop-changes.md`
- `docs/toy-shop-setup.md`
- `phpunit.xml`
- `public/css/shop.css`
- `resources/views/admin/sales-summary.blade.php`
- `resources/views/admin/stock/index.blade.php`
- `resources/views/cart/index.blade.php`
- `resources/views/checkout/index.blade.php`
- `resources/views/checkout/success.blade.php`
- `resources/views/layouts/base.blade.php`
- `resources/views/layouts/shop.blade.php`
- `resources/views/shop/home.blade.php`
- `resources/views/shop/index.blade.php`
- `resources/views/shop/show.blade.php`
- `tests/Feature/ShopStructureTest.php`

## Modified (34)

- `.env.example`
- `app/Http/Controllers/Admin/CategoryController.php`
- `app/Http/Controllers/Admin/DashboardController.php`
- `app/Http/Controllers/Admin/OrderController.php`
- `app/Http/Controllers/Admin/ProductController.php`
- `app/Http/Requests/Auth/LoginRequest.php`
- `app/Providers/AppServiceProvider.php`
- `bootstrap/app.php`
- `composer.json`
- `composer.lock`
- `config/mail.php`
- `config/services.php`
- `database/seeders/DatabaseSeeder.php`
- `resources/views/admin/categories/index.blade.php`
- `resources/views/admin/dashboard.blade.php`
- `resources/views/admin/orders/index.blade.php`
- `resources/views/admin/products/index.blade.php`
- `resources/views/auth/confirm-password.blade.php`
- `resources/views/auth/forgot-password.blade.php`
- `resources/views/auth/login.blade.php`
- `resources/views/auth/reset-password.blade.php`
- `resources/views/auth/verify-email.blade.php`
- `resources/views/layouts/admin.blade.php`
- `resources/views/layouts/guest.blade.php`
- `resources/views/profile/edit.blade.php`
- `routes/auth.php`
- `routes/web.php`
- `tests/Feature/Auth/AuthenticationTest.php`
- `tests/Feature/Auth/EmailVerificationTest.php`
- `tests/Feature/Auth/PasswordConfirmationTest.php`
- `tests/Feature/Auth/PasswordResetTest.php`
- `tests/Feature/Auth/PasswordUpdateTest.php`
- `tests/Feature/Auth/RegistrationTest.php`
- `tests/Feature/ProfileTest.php`

## Removed (71)

- `app/Exports/OrdersExport.php`
- `app/Http/Controllers/Admin/PermissionController.php`
- `app/Http/Controllers/Admin/UserController.php`
- `app/Http/Controllers/Api/v1/CategoryApiController.php`
- `app/Http/Controllers/Api/v1/OrderApiController.php`
- `app/Http/Controllers/Api/v1/OrderItemApiController.php`
- `app/Http/Controllers/Api/v1/ProductApiController.php`
- `app/Http/Controllers/Api/v1/UserApiController.php`
- `app/Http/Controllers/Auth/OAuthLogoutController.php`
- `app/Http/Controllers/Auth/RegisteredUserController.php`
- `app/Http/Controllers/Auth/SocialAuthController.php`
- `app/Http/Controllers/Frontend/AboutController.php`
- `app/Http/Controllers/Frontend/CartController.php`
- `app/Http/Controllers/Frontend/CategoryController.php`
- `app/Http/Controllers/Frontend/CheckoutController.php`
- `app/Http/Controllers/Frontend/HomeController.php`
- `app/Http/Controllers/Frontend/ProductController.php`
- `app/Http/Controllers/Frontend/ProfileController.php`
- `app/Http/Controllers/TestEmailController.php`
- `app/Http/Middleware/CheckGroupPermission.php`
- `app/Mail/OrderInvoiceMail.php`
- `app/OpenApi.php`
- `app/View/Components/AppLayout.php`
- `app/View/Components/GuestLayout.php`
- `config/l5-swagger.php`
- `database/seeders/CategorySeeder.php`
- `database/seeders/OrderSeeder.php`
- `database/seeders/ProductSeeder.php`
- `database/seeders/UserSeeder.php`
- `docs/Google_Auth.doc`
- `laptop_store_postman_collection.json`
- `plans/google_auth_implementation_plan.md`
- `postcss.config.js`
- `resources/css/app.css`
- `resources/js/app.js`
- `resources/js/bootstrap.js`
- `resources/views/admin/categories/create.blade.php`
- `resources/views/admin/categories/edit.blade.php`
- `resources/views/admin/orders/edit.blade.php`
- `resources/views/admin/permissions/index.blade.php`
- `resources/views/admin/products/create.blade.php`
- `resources/views/admin/products/edit.blade.php`
- `resources/views/admin/users/create.blade.php`
- `resources/views/admin/users/edit.blade.php`
- `resources/views/admin/users/index.blade.php`
- `resources/views/auth/register.blade.php`
- `resources/views/emails/orders/invoice.blade.php`
- `resources/views/frontend/about/index.blade.php`
- `resources/views/frontend/cart/index.blade.php`
- `resources/views/frontend/categories/index.blade.php`
- `resources/views/frontend/categories/products.blade.php`
- `resources/views/frontend/category_products/index.blade.php`
- `resources/views/frontend/checkout/index.blade.php`
- `resources/views/frontend/checkout/qr-payment.blade.php`
- `resources/views/frontend/checkout/success.blade.php`
- `resources/views/frontend/home.blade.php`
- `resources/views/frontend/product/index.blade.php`
- `resources/views/frontend/product/show.blade.php`
- `resources/views/frontend/profile/edit.blade.php`
- `resources/views/frontend/profile/index.blade.php`
- `resources/views/layouts/frontend.blade.php`
- `resources/views/partials/footer.blade.php`
- `resources/views/partials/nav-bar.blade.php`
- `resources/views/partials/side-bar.blade.php`
- `resources/views/vendor/l5-swagger/.gitkeep`
- `resources/views/vendor/l5-swagger/index.blade.php`
- `resources/views/welcome.blade.php`
- `routes/api.php`
- `routes/frontend/web.php`
- `storage/api-docs/api-docs.json`
- `tailwind.config.js`

## Other workspace changes

These deletions were present initially or occurred independently while this task ran; this task did not delete or restore them:

- `MYSQL/Bunly/002-04-06-2026.sql` (already deleted at the first inspection)
- `public/images/Laptops/gaming/gaming_(1).jpeg`
- `public/images/Laptops/mac/mac_(1).jpeg`
- `public/images/Laptops/mac/mac_(54).jpg`
- `public/images/Laptops/windows/yG5LaiLZhedGtaAuTxtC68.jpg`
- `public/images/products/1774007828_MacBook Pro.jpeg`
- `public/images/team_members/by.jpg`
- `public/images/team_members/daro.jpg`
- `public/images/team_members/khit.jpg`
- `public/images/team_members/lean.jpg`

The Git directory was also replaced externally during the task. Some early edits are therefore already part of the current Git baseline; the list above includes them regardless.
