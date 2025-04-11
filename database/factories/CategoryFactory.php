<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'description' =>fake()->paragraph(1)
        ];
    }

    // public static function text($maxNbChars = 200)
    //   {
    //         if ($maxNbChars < 5) {
    //          throw new \InvalidArgumentException('text() can only generate text of at least 5 characters');
    //       }
    
    //             $type = ($maxNbChars < 25) ? 'word' : (($maxNbChars < 100) ? 'sentence' : 'paragraph');
    //             return $type ;
    //     }


}

