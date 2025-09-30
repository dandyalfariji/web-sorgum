<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data produk diperbarui dengan stok spesifik dari daftar
        $products = [
            // Snacks
            ['name' => 'Almond Crispy (Toples) Keju', 'price' => 50000, 'category' => 'Snack Ringan', 'stock' => 4],
            ['name' => 'Almond Crispy (Toples) Original', 'price' => 50000, 'category' => 'Snack Ringan', 'stock' => 3],
            ['name' => 'Bayam Krispi', 'price' => 15000, 'category' => 'Snack Ringan', 'stock' => 7],
            ['name' => 'Brownies Kering', 'price' => 25000, 'category' => 'Kue Kering', 'stock' => 10],
            ['name' => 'Keripik Bawang', 'price' => 21000, 'category' => 'Snack Ringan', 'stock' => 16],
            ['name' => 'Pop Sorgum', 'price' => 15000, 'category' => 'Snack Ringan', 'stock' => rand(15, 50)],
            ['name' => 'Rempeyek', 'price' => 21000, 'category' => 'Snack Ringan', 'stock' => 2],
            ['name' => 'Rempeyek Logo', 'price' => 30000, 'category' => 'Snack Ringan', 'stock' => 9],
            ['name' => 'Saroja Sorgum (plastik)', 'price' => 18000, 'category' => 'Snack Ringan', 'stock' => rand(15, 50)],
            ['name' => 'Saroja Sorgum (pouch)', 'price' => 18000, 'category' => 'Snack Ringan', 'stock' => rand(15, 50)],
            ['name' => 'Sistik Sorgum', 'price' => 21000, 'category' => 'Snack Ringan', 'stock' => 21],
            ['name' => 'Snack bar', 'price' => 18000, 'category' => 'Snack Sehat', 'stock' => rand(15, 50)],
            ['name' => 'Cookies Coklat', 'price' => 50000, 'category' => 'Kue Kering', 'stock' => 1],
            ['name' => 'Roti Manina', 'price' => 8000, 'category' => 'Roti', 'stock' => rand(15, 50)],

            // Bahan Pokok & Bumbu
            ['name' => 'Beras Sorgum 350 Gram', 'price' => 20000, 'category' => 'Bahan Pokok', 'stock' => 9],
            ['name' => 'Gula 250 gram', 'price' => 22000, 'category' => 'Bahan Pokok', 'stock' => rand(15, 50)],
            ['name' => 'Kecap', 'price' => 35000, 'category' => 'Bumbu Masak', 'stock' => 3],
            ['name' => 'Tepung Sorgum', 'price' => 24000, 'category' => 'Bahan Pokok', 'stock' => 9],

            // Minuman
            ['name' => '(pcs) Sorgummi Coklat', 'price' => 25000, 'category' => 'Minuman Sereal', 'stock' => 51],
            ['name' => '(pouch) Sorgummi Coklat isi 3', 'price' => 75000, 'category' => 'Minuman Sereal', 'stock' => rand(15, 50)],
            ['name' => '(pcs) Sorgummi Choco Almond', 'price' => 25000, 'category' => 'Minuman Sereal', 'stock' => 39],
            ['name' => '(pouch) Sorgummi Choco Almond isi 3', 'price' => 75000, 'category' => 'Minuman Sereal', 'stock' => rand(15, 50)],
            ['name' => '(pcs) Sorgummi Matcha', 'price' => 25000, 'category' => 'Minuman Sereal', 'stock' => rand(15, 50)],
            ['name' => '(pouch) Sorgummi Almond isi 3', 'price' => 75000, 'category' => 'Minuman Sereal', 'stock' => rand(15, 50)],
            ['name' => 'Sorgummi Pouch Besar', 'price' => 150000, 'category' => 'Minuman Sereal', 'stock' => rand(15, 50)],
            ['name' => 'Sorgummi Pouch Kecil Mix', 'price' => 75000, 'category' => 'Minuman Sereal', 'stock' => rand(15, 50)],
            ['name' => 'Sirup', 'price' => 40000, 'category' => 'Minuman Sirup', 'stock' => 2],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']], // Kunci untuk mengecek duplikasi
                [
                    'slug' => Str::slug($product['name']), // Slug dibuat otomatis dari nama produk
                    'description' => 'Ini adalah deskripsi placeholder untuk ' . $product['name'] . '. Dibuat dari sorgum pilihan berkualitas tinggi, produk ini menawarkan rasa yang lezat dan manfaat kesehatan. Cocok dinikmati kapan saja dan di mana saja.',
                    'price' => $product['price'],
                    'stock' => $product['stock'], // Menggunakan stok dari data array
                    'image' => 'placeholders/product-image.png', // Gambar placeholder default
                    'images' => [
                        'placeholders/gallery-1.png',
                        'placeholders/gallery-2.png',
                        'placeholders/gallery-3.png',
                    ],
                    'rating' => round(rand(40, 50) / 10, 1), // Rating acak antara 4.0 - 5.0
                    'category' => $product['category'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
