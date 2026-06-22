<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Corrente Cuban Link Prata 925',
                'description' => 'Corrente Cuban Link em prata 925 com acabamento polido. Elo largo e robusto, ideal para uso masculino e feminino.',
                'price' => 349.90, 'category' => 'correntes', 'color' => 'Prata',
                'size' => '60cm', 'weight' => 0.045, 'stock' => 12,
                'image' => 'https://images.unsplash.com/photo-1611085583191-a3b181a88401?w=400',
            ],
            [
                'name' => 'Corrente Cartier Banhada a Ouro 18K',
                'description' => 'Corrente estilo Cartier com banho de ouro 18K. Design elegante e sofisticado para qualquer ocasião.',
                'price' => 289.90, 'category' => 'correntes', 'color' => 'Dourado',
                'size' => '50cm', 'weight' => 0.038, 'stock' => 18,
                'image' => 'https://images.unsplash.com/photo-1601121141418-f5cba10b9ea7?w=400',
            ],
            [
                'name' => 'Cordão Veneziana Masculino Ouro 18K',
                'description' => 'Cordão veneziana em ouro 18K maciço. Textura diamantada que realça o brilho natural do ouro.',
                'price' => 1290.00, 'category' => 'cordoes', 'color' => 'Ouro 18K',
                'size' => '70cm', 'weight' => 0.06, 'stock' => 5,
                'image' => 'https://images.unsplash.com/photo-1617038220319-276d3cfab638?w=400',
            ],
            [
                'name' => 'Cordão Grumet Prata Feminino',
                'description' => 'Cordão grumet em prata 925 com fecho lagosta. Leve e delicado, perfeito para uso diário.',
                'price' => 219.90, 'category' => 'cordoes', 'color' => 'Prata',
                'size' => '45cm', 'weight' => 0.022, 'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=400',
            ],
            [
                'name' => 'Relógio Masculino Quartz Preto',
                'description' => 'Relógio masculino com caixa em aço inox, mostrador preto e pulseira em couro genuíno. Resistente à água 50m.',
                'price' => 599.90, 'category' => 'relogios', 'color' => 'Preto/Prata',
                'size' => '42mm', 'weight' => 0.12, 'stock' => 8,
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400',
            ],
            [
                'name' => 'Relógio Feminino Rose Gold',
                'description' => 'Relógio feminino elegante com caixa e pulseira em aço rose gold. Mostrador branco com índices dourados.',
                'price' => 479.90, 'category' => 'relogios', 'color' => 'Rose Gold',
                'size' => '36mm', 'weight' => 0.09, 'stock' => 10,
                'image' => 'https://images.unsplash.com/photo-1548169874-53e85f753f1e?w=400',
            ],
            [
                'name' => 'Pulseira Bracelete Banhada a Ouro',
                'description' => 'Bracelete rígido banhado a ouro 18K com acabamento polido. Modelo clássico e versátil.',
                'price' => 169.90, 'category' => 'pulseiras', 'color' => 'Dourado',
                'size' => '18cm', 'weight' => 0.028, 'stock' => 22,
                'image' => 'https://images.unsplash.com/photo-1573408301185-9519f94816b5?w=400',
            ],
            [
                'name' => 'Pulseira Elo Cartier Prata',
                'description' => 'Pulseira estilo elo cartier em prata 925 com fecho borboleta. Delicada e sofisticada.',
                'price' => 139.90, 'category' => 'pulseiras', 'color' => 'Prata',
                'size' => '19cm', 'weight' => 0.02, 'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1611591437281-460bfbe1220a?w=400',
            ],
            [
                'name' => 'Pingente Cruz Cravejado Prata',
                'description' => 'Pingente cruz cravejado com zircônias brancas em prata 925. Acabamento rhodiado para maior durabilidade.',
                'price' => 119.90, 'category' => 'pingentes', 'color' => 'Prata',
                'size' => '3cm', 'weight' => 0.01, 'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1602173574767-37ac01994b2a?w=400',
            ],
            [
                'name' => 'Pingente Leão Banhado a Ouro',
                'description' => 'Pingente cabeça de leão detalhado, banhado a ouro 18K. Peça de destaque para qualquer corrente.',
                'price' => 189.90, 'category' => 'pingentes', 'color' => 'Dourado',
                'size' => '4cm', 'weight' => 0.015, 'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1535632787350-4e68ef0ac584?w=400',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
