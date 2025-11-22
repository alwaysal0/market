<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class UserFactory extends Factory
{
    protected static $credentials = [];
    public function definition(): array
    {
        $password = $this->faker->password(8, 15, true, true, '!@#$%^&*');
        $username = $this->faker->unique()->userName();
        $email = $this->faker->unique()->safeEmail();
        self::$credentials[] = [
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'created_at' => now()->toDateString(),
        ];

        return [
            'username' => $username,
            'email' => $email,
            'password' => bcrypt($password),
        ];
    }

    public static function getCredentials() : array
    {
        $data = self::$credentials;
        self::$credentials = [];
        return $data;
    }
}
