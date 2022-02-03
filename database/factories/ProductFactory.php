<?php

namespace Database\Factories;

use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->realText,
            'price' => random_int(1, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
