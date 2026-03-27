<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $products = [
            'Notebook Dell Inspiron 15',
            'iPhone 13 128GB',
            'Smart TV Samsung 50" 4K',
            'Mouse Logitech MX Master 3',
            'Teclado Mecânico Redragon Kumara',
            'Fone de Ouvido Sony WH-1000XM4',
            'Cadeira Gamer ThunderX3',
            'Monitor LG Ultrawide 29"',
            'SSD Kingston 1TB NVMe',
            'Placa de Vídeo RTX 3060'
        ];

        return [
            'name' => fake()->randomElement($products),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'cover' => Product::DEFAULT_COVER,
            'category_id' => 1
        ];
    }
}
