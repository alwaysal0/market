<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'user_id' => 6,
            'name' => $this->faker->word(3, true),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'image_url' => "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fstatic.vecteezy.com%2Fsystem%2Fresources%2Fpreviews%2F014%2F731%2F356%2Foriginal%2Fcool-mango-fruit-cartoon-illustration-vector.jpg&f=1&nofb=1&ipt=107d3b11c76cd2db674d02b852bf9b6c18e06992b20b55e4bcb4204725f7acb8",
            'image_public_id' => $this->faker->regexify('[a-z0-9]{20}'),
        ];
    }
}
