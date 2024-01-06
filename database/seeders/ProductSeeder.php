<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Frame Wedding',
            'slug' => Str::slug('Frame Wedding'),
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea, in quibusdam. Voluptatem ab beatae aut? Iusto accusamus pariatur odit facere dolorem non nisi, iste, quibusdam excepturi cumque neque explicabo saepe.',
            'image' => 'Gambar/p1.jpg',
            'image_asset' => 'YA',
            'stock' => 100,
            'price_before' => 35000,
            'price_after' => 25000,
            'sold' => 0,
            'status' => 'Tersedia',
        ]);


        Product::create([
            'name' => 'Plastik Single Flower',
            'slug' => Str::slug('Plastik Single Flower'),
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea, in quibusdam. Voluptatem ab beatae aut? Iusto accusamus pariatur odit facere dolorem non nisi, iste, quibusdam excepturi cumque neque explicabo saepe.',
            'image' => 'Gambar/p2.jpg',
            'image_asset' => 'YA',
            'stock' => 100,
            'price_before' => 36000,
            'price_after' => 16000,
            'sold' => 0,
            'status' => 'Tersedia',
        ]);


        Product::create([
            'name' => 'Flower Dome Light',
            'slug' => Str::slug('Flower Dome Light'),
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea, in quibusdam. Voluptatem ab beatae aut? Iusto accusamus pariatur odit facere dolorem non nisi, iste, quibusdam excepturi cumque neque explicabo saepe.',
            'image' => 'Gambar/p3.jpg',
            'image_asset' => 'YA',
            'stock' => 100,
            'price_before' => 45000,
            'price_after' => 22000,
            'sold' => 0,
            'status' => 'Tersedia',
        ]);


        Product::create([
            'name' => 'Frame Wedding',
            'slug' => Str::slug('Frame Wedding'),
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea, in quibusdam. Voluptatem ab beatae aut? Iusto accusamus pariatur odit facere dolorem non nisi, iste, quibusdam excepturi cumque neque explicabo saepe.',
            'image' => 'Gambar/p4.jpg',
            'image_asset' => 'YA',
            'stock' => 100,
            'price_before' => 32000,
            'price_after' => 20000,
            'sold' => 0,
            'status' => 'Tersedia',
        ]);


        Product::create([
            'name' => 'Gift Bucket',
            'slug' => Str::slug('Gift Bucket'),
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea, in quibusdam. Voluptatem ab beatae aut? Iusto accusamus pariatur odit facere dolorem non nisi, iste, quibusdam excepturi cumque neque explicabo saepe.',
            'image' => 'Gambar/p5.jpg',
            'image_asset' => 'YA',
            'stock' => 100,
            'price_before' => 49000,
            'price_after' => 29000,
            'sold' => 0,
            'status' => 'Tersedia',
        ]);


        Product::create([
            'name' => 'Karangan Bunga Papan',
            'slug' => Str::slug('Karangan Bunga Papan'),
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea, in quibusdam. Voluptatem ab beatae aut? Iusto accusamus pariatur odit facere dolorem non nisi, iste, quibusdam excepturi cumque neque explicabo saepe.',
            'image' => 'Gambar/p6.jpg',
            'image_asset' => 'YA',
            'stock' => 100,
            'price_before' => 26000,
            'price_after' => 14000,
            'sold' => 0,
            'status' => 'Tersedia',
        ]);


        Product::create([
            'name' => 'Akrilik Wedding Sign',
            'slug' => Str::slug('Akrilik Wedding Sign'),
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea, in quibusdam. Voluptatem ab beatae aut? Iusto accusamus pariatur odit facere dolorem non nisi, iste, quibusdam excepturi cumque neque explicabo saepe.',
            'image' => 'Gambar/p7.jpg',
            'image_asset' => 'YA',
            'stock' => 100,
            'price_before' => 30000,
            'price_after' => 23000,
            'sold' => 0,
            'status' => 'Tersedia',
        ]);


        Product::create([
            'name' => 'Balon Bucket',
            'slug' => Str::slug('Balon Bucket'),
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea, in quibusdam. Voluptatem ab beatae aut? Iusto accusamus pariatur odit facere dolorem non nisi, iste, quibusdam excepturi cumque neque explicabo saepe.',
            'image' => 'Gambar/p8.jpg',
            'image_asset' => 'YA',
            'stock' => 100,
            'price_before' => 19000,
            'price_after' => 8000,
            'sold' => 0,
            'status' => 'Tersedia',
        ]);


        Product::create([
            'name' => 'Bucket Bunga',
            'slug' => Str::slug('Bucket Bunga'),
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea, in quibusdam. Voluptatem ab beatae aut? Iusto accusamus pariatur odit facere dolorem non nisi, iste, quibusdam excepturi cumque neque explicabo saepe.',
            'image' => 'Gambar/p9.jpg',
            'image_asset' => 'YA',
            'stock' => 100,
            'price_before' => 20000,
            'price_after' => 10000,
            'sold' => 0,
            'status' => 'Tersedia',
        ]);
    }
}
