<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    public function test_adminPanelShowAsAdmin() {
        $user = User::create([
            'username' => "TestAdmin",
            'email' => "testadmin@gmail.com",
            'password' => Hash::make('TestAdmin_2006'),
        ]);
        $admin = Admin::create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
            ->get(route('admin-panel'));

        $response->assertStatus(200);
    }

    public function test_adminPanelShowAsUser() {
        $user = User::create([
            'username' => "TestAdmin",
            'email' => "testadmin@gmail.com",
            'password' => Hash::make('TestAdmin_2006'),
        ]);

        $response = $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->get(route('admin-panel'));

        $response->assertStatus(403);
    }

    public function test_changeUserDataEngl(): void
    {
        $user = User::create([
            'username' => "TestAdmin",
            'email' => "testadmin@gmail.com",
            'password' => Hash::make('TestAdmin_2006'),
        ]);
        $admin = Admin::create([
            'user_id' => $user->id,
        ]);

        $new_data = [
            'username' => "BroskeTest1",
            'email' => "brosketest1@gmail.com",
        ];

        $testUser = User::create([
            'username' => "TestUser",
            'email' => "testuser@gmail.com",
            'password' => Hash::make("TestUser_2006"),
        ]);

        $response = $this->actingAs($user)
            ->put(route('admin.updateUser', ['user' => $testUser->id]), $new_data);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'id' => $testUser->id,
            'username' => "BroskeTest1",
            'email' => "brosketest1@gmail.com"
        ]);
    }

    public function test_changeUserDataRu() : void
    {
        $user = User::create([
            'username' => "TestAdmin",
            'email' => "testadmin@gmail.com",
            'password' => Hash::make('TestAdmin_2006'),
        ]);
        $admin = Admin::create([
            'user_id' => $user->id,
        ]);

        $new_data = [
            'username' => "БроскеТест1",
            'email' => "brosketest1@gmail.com",
        ];

        $original_name = "TestUser";
        $testUser = User::create([
            'username' => $original_name,
            'email' => "testuser@gmail.com",
            'password' => Hash::make("TestUser_2006"),
        ]);

        $response = $this->actingAs($user)
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->put(route('admin.updateUser', ['user' => $testUser->id]), $new_data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('username');

        $this->assertDatabaseHas('users', [
            'id' => $testUser->id,
            'username' => $original_name,
            'email' => $testUser->email,
        ]);
    }
}
