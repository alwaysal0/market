<?php

namespace App\Http\Controllers;

use App\Events\User\UserLoggedIn;
use App\Events\User\UserRegistered;
use App\Http\Requests\authUser\LoginUserRequest;
use App\Http\Requests\authUser\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request) {
        $validated_data = $request->validated();

        $password = Hash::make($validated_data['password']);

        $new_user = User::create([
            'username' => $validated_data['username'],
            'email' => $validated_data['email'],
            'password' => $password,
        ]);

        event(new UserRegistered($new_user));

        return redirect('/login')->with('success', 'Registartion successful!');
    }

    public function login(LoginUserRequest $request) {
        $validated_data = $request->validated();

        $user = User::where('username', $validated_data['username'])->first();

        if (!Auth::attempt($validated_data)) {
            if ($user) {
                activity('auth-error')
                    ->causedBy($user)
                ->log('Failed login attempt.');
            }
            return back()->withErrors([
                'wrong-data' => 'The password or email is incorrect.'
            ]);
        }

        event(new UserLoggedIn($user));

        return redirect('/main')->with('success', "Welcome $user->username!");
    }
}
