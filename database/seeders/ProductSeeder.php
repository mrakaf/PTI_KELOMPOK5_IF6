<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Code Jacket',
                'description' => 'Stylish code pattern jacket perfect for developers',
                'price' => 299000,
                'stock' => 50,
                'image' => 'Codejacket.jpg',
                'category' => 'Jackets'
            ],
            [
                'name' => 'Fashion Bracelet',
                'description' => 'Elegant bracelet to complement your style',
                'price' => 49000,
                'stock' => 100,
                'image' => 'gelang.jpg',
                'category' => 'Accessories'
            ],
            [
                'name' => 'Graphic T-Shirt',
                'description' => 'Cool graphic design t-shirt',
                'price' => 149000,
                'stock' => 75,
                'image' => 'graphicshirt.jpg',
                'category' => 'T-Shirts'
            ],
            [
                'name' => 'Boxy Hoodie',
                'description' => 'Comfortable oversized boxy hoodie',
                'price' => 279000,
                'stock' => 60,
                'image' => 'hoodieboxy.jpg',
                'category' => 'Hoodies'
            ],
            [
                'name' => 'Classic Jacket',
                'description' => 'Classic style everyday jacket',
                'price' => 329000,
                'stock' => 40,
                'image' => 'jacket1.jpg',
                'category' => 'Jackets'
            ],
            [
                'name' => 'Modern Jacket',
                'description' => 'Modern cut stylish jacket',
                'price' => 359000,
                'stock' => 35,
                'image' => 'jacket2.jpg',
                'category' => 'Jackets'
            ],
            [
                'name' => 'Black Jeans',
                'description' => 'Classic black jeans for any occasion',
                'price' => 259000,
                'stock' => 80,
                'image' => 'jeansHitam.jpg',
                'category' => 'Jeans'
            ],
            [
                'name' => 'Boxy Shirt',
                'description' => 'Trendy boxy fit shirt',
                'price' => 189000,
                'stock' => 65,
                'image' => 'kemejaboxy.jpg',
                'category' => 'Shirts'
            ],
            [
                'name' => 'Linen Shirt',
                'description' => 'Comfortable linen material shirt',
                'price' => 219000,
                'stock' => 55,
                'image' => 'kemejalinen.jpg',
                'category' => 'Shirts'
            ],
            [
                'name' => 'Leather Jacket',
                'description' => 'Premium leather jacket',
                'price' => 599000,
                'stock' => 25,
                'image' => 'leatherjacket.jpg',
                'category' => 'Jackets'
            ],
            [
                'name' => 'Casual Loafers',
                'description' => 'Comfortable casual loafers',
                'price' => 329000,
                'stock' => 45,
                'image' => 'loafers.jpg',
                'category' => 'Shoes'
            ],
            [
                'name' => 'Loose Fit Jeans',
                'description' => 'Comfortable loose fit jeans',
                'price' => 279000,
                'stock' => 70,
                'image' => 'loosejeans.jpg',
                'category' => 'Jeans'
            ],
            [
                'name' => 'Loose Pants',
                'description' => 'Stylish loose fit pants',
                'price' => 249000,
                'stock' => 60,
                'image' => 'loosepants.jpg',
                'category' => 'Pants'
            ],
            [
                'name' => 'New Balance Shoes',
                'description' => 'Comfortable New Balance sneakers',
                'price' => 899000,
                'stock' => 30,
                'image' => 'nb.jpg',
                'category' => 'Shoes'
            ],
            [
                'name' => 'Oversize Boxy Shirt',
                'description' => 'Trendy oversize boxy fit shirt',
                'price' => 199000,
                'stock' => 50,
                'image' => 'oversizeboxy.jpg',
                'category' => 'Shirts'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 