<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;

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
        return [
            
            'name' =>fake()->word(),
            'description' =>fake()->paragraph(1),
            'quantity' =>fake()->numberBetween(1,10),
            'status' =>fake()->randomElement([Product::AVILABLE_PRODUCT ,Product::UNAVILABLE_PRODUCT]),
            'image' =>fake()->randomElement(['1.jpg','2.jpg','3.jpg']),
            'seller_id' => User::all()->random()->id,

            // Wrong statements ---- Using String Element Must be in Array 
            //'status' =>fake()->randomElement(Product::AVILABLE_PRODUCT ,Product::UNAVILABLE_PRODUCT),
            
        ];
    }
}
