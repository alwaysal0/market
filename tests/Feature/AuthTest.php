<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    public function testRegistration(): void
    {
        $password = Hash::make('TestPassword_2006');
        $user_data = [
            'username' => 'TestUser',
            'email' => 'testuser@gmail.com',
            'password' => $password,
            'password_confirmation' => $password,
        ];

        $response = $this->post(route('register.auth'), $user_data);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', [
            'username' => 'TestUser',
            'email' => 'testuser@gmail.com'
        ]);
    }

    public function testLogin(): void
    {
        $user_data = [
            'username' => 'TestUser',
            'email' => 'testuser@gmail.com',
            'password' => Hash::make('TestPassword_2006')
        ];
        $user = User::create($user_data);

        $response = $this->post(route('login.auth'), [
            'username' => $user->username,
            'password' => 'TestPassword_2006'
        ]);

        $response->assertRedirect(route('MainPage'));
        $response->assertStatus(302);
    }
}
