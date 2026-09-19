<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ToyShopSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = [
            'Naruto Ninja' => [
                'slug' => 'naruto-ninja',
                'description' => 'Collectible ninja figures inspired by classic anime heroes.',
                'products' => [
                    ['name' => 'Naruto Ninja Figure', 'sku' => 'NAR-FIG-001', 'brand' => 'Ninja World', 'price' => 24.99, 'cost_price' => 14.00, 'stock' => 25, 'description' => 'Detailed Naruto ninja figure for collectors and fans.'],
                    ['name' => 'Sasuke Ninja Figure', 'sku' => 'NAR-FIG-002', 'brand' => 'Ninja World', 'price' => 24.99, 'cost_price' => 14.00, 'stock' => 22, 'description' => 'Sasuke figure with a durable poseable design.'],
                    ['name' => 'Kakashi Ninja Figure', 'sku' => 'NAR-FIG-003', 'brand' => 'Ninja World', 'price' => 27.50, 'cost_price' => 16.00, 'stock' => 18, 'description' => 'Kakashi collectible figure with recognizable ninja details.'],
                    ['name' => 'Itachi Ninja Figure', 'sku' => 'NAR-FIG-004', 'brand' => 'Ninja World', 'price' => 27.50, 'cost_price' => 16.00, 'stock' => 20, 'description' => 'Itachi figure made for display and imaginative play.'],
                ],
            ],
            'Spider Hero' => [
                'slug' => 'spider-hero',
                'description' => 'Action figures and play sets for young web-slinging heroes.',
                'products' => [
                    ['name' => 'Spider Hero Figure', 'sku' => 'SPH-FIG-001', 'brand' => 'Hero Play', 'price' => 22.99, 'cost_price' => 13.00, 'stock' => 30, 'description' => 'Spider hero action figure for everyday adventures.'],
                    ['name' => 'Red Spider Figure', 'sku' => 'SPH-FIG-002', 'brand' => 'Hero Play', 'price' => 19.99, 'cost_price' => 11.00, 'stock' => 28, 'description' => 'Bright red spider figure with flexible play joints.'],
                    ['name' => 'Black Spider Figure', 'sku' => 'SPH-FIG-003', 'brand' => 'Hero Play', 'price' => 19.99, 'cost_price' => 11.00, 'stock' => 24, 'description' => 'Black spider figure for creative superhero play.'],
                    ['name' => 'Spider Hero Mini Set', 'sku' => 'SPH-SET-001', 'brand' => 'Hero Play', 'price' => 34.99, 'cost_price' => 20.00, 'stock' => 15, 'description' => 'Mini set with spider hero figures and adventure accessories.'],
                ],
            ],
            'Funny Character Toys' => [
                'slug' => 'funny-character-toys',
                'description' => 'Colorful and cheerful character toys for fun playtime.',
                'products' => [
                    ['name' => 'Yellow Funny Doll', 'sku' => 'FCT-DOL-001', 'brand' => 'Happy Friends', 'price' => 15.99, 'cost_price' => 8.50, 'stock' => 35, 'description' => 'A cheerful yellow doll with a friendly smile.'],
                    ['name' => 'Cute Glasses Doll', 'sku' => 'FCT-DOL-002', 'brand' => 'Happy Friends', 'price' => 16.99, 'cost_price' => 9.00, 'stock' => 32, 'description' => 'Cute character doll wearing colorful glasses.'],
                    ['name' => 'Orange Funny Figure', 'sku' => 'FCT-FIG-001', 'brand' => 'Happy Friends', 'price' => 13.99, 'cost_price' => 7.00, 'stock' => 40, 'description' => 'Playful orange figure for imaginative adventures.'],
                    ['name' => 'Mini Funny Character', 'sku' => 'FCT-FIG-002', 'brand' => 'Happy Friends', 'price' => 9.99, 'cost_price' => 5.00, 'stock' => 45, 'description' => 'Small funny character toy that is easy to carry.'],
                ],
            ],
        ];

        foreach ($catalog as $name => $categoryData) {
            $category = Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                [
                    'name' => $name,
                    'description' => $categoryData['description'],
                    'image' => null,
                    'status' => true,
                    'is_active' => true,
                ],
            );

            foreach ($categoryData['products'] as $productData) {
                Product::updateOrCreate(
                    ['sku' => $productData['sku']],
                    array_merge($productData, [
                        'category_id' => $category->id,
                        'image' => null,
                        'status' => true,
                        'is_active' => true,
                    ]),
                );
            }
        }
    }
}
