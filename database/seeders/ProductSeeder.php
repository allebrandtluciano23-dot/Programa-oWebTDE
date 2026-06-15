<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Tênis Runner X', 'description' => 'Tênis leve para corrida, ideal para longas distâncias.', 'price' => 299.90, 'category' => 'corrida', 'color' => 'preto', 'size' => '42', 'weight' => 0.8, 'image' => 'runner-x.jpg', 'stock' => 15],
            ['name' => 'Tênis Street Walk', 'description' => 'Conforto e estilo para o dia a dia urbano.', 'price' => 189.90, 'category' => 'casual', 'color' => 'branco', 'size' => '40', 'weight' => 0.7, 'image' => 'street-walk.jpg', 'stock' => 20],
            ['name' => 'Tênis Trail Pro', 'description' => 'Resistente para trilhas e terrenos irregulares.', 'price' => 349.90, 'category' => 'trilha', 'color' => 'verde', 'size' => '43', 'weight' => 1.0, 'image' => 'trail-pro.jpg', 'stock' => 10],
            ['name' => 'Tênis Classic White', 'description' => 'Visual clássico que combina com tudo.', 'price' => 159.90, 'category' => 'casual', 'color' => 'branco', 'size' => '39', 'weight' => 0.65, 'image' => 'classic-white.jpg', 'stock' => 25],
            ['name' => 'Tênis Boost Energy', 'description' => 'Amortecimento responsivo para alta performance.', 'price' => 399.90, 'category' => 'corrida', 'color' => 'azul', 'size' => '41', 'weight' => 0.75, 'image' => 'boost-energy.jpg', 'stock' => 12],
            ['name' => 'Tênis Skate Flow', 'description' => 'Base resistente e aderência para manobras.', 'price' => 219.90, 'category' => 'skate', 'color' => 'cinza', 'size' => '42', 'weight' => 0.9, 'image' => 'skate-flow.jpg', 'stock' => 18],
            ['name' => 'Tênis Lightweight Air', 'description' => 'Extremamente leve, ventilação superior.', 'price' => 259.90, 'category' => 'corrida', 'color' => 'vermelho', 'size' => '40', 'weight' => 0.6, 'image' => 'lightweight-air.jpg', 'stock' => 14],
            ['name' => 'Tênis Urban Black', 'description' => 'Estilo urbano sofisticado em preto total.', 'price' => 229.90, 'category' => 'casual', 'color' => 'preto', 'size' => '41', 'weight' => 0.8, 'image' => 'urban-black.jpg', 'stock' => 16],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}