<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Model #' . $this->faker->word(),
            'description' => $this->faker->sentences(3, true),
            'price' => $this->faker->randomFloat(3, 0, 100),
            'photo' => $this->faker->imageUrl(),
        ];
    }
}
