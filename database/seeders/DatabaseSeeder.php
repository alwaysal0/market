<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users =  User::factory(5)->create();
        $newCredentials = UserFactory::getCredentials();

        $filepath = storage_path("app/public/users/users_data.json");
        $existingData = [];
        if (file_exists($filepath)) {
            $jsonContent = file_get_contents($filepath);
            $existingData = json_decode($jsonContent, true) ?? [];
        }
        $newUsersData = array_merge($existingData, $newCredentials);
        file_put_contents($filepath, json_encode($newUsersData, JSON_PRETTY_PRINT));

        $products = Product::factory(5)->make()->each(function ($product) use ($users) {
            $product->user_id = $users->random()->id;
            $product->save();
        });

        Review::factory(5)->make()->each(function ($review) use ($users, $products) {
            $review->user_id = $users->random()->id;
            $review->product_id = $products->random()->id;
            $review->save();
        });
    }
}
