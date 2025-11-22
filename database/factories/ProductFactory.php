<?php

namespace Database\Factories;

use App\Models\User;
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
        $user = User::all();
        $baseUrl = "https://loremflickr.com/640/480/food";
        $uniqueId = $this->faker->unique()->randomNumber(5, true);
        return [
            'user_id' => $user[rand(0, count($user) - 1)]->id,
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'image_url' => $baseUrl . "?id=" . $uniqueId,
            'image_public_id' => $this->faker->regexify('[a-z0-9]{20}'),
        ];
    }
}
