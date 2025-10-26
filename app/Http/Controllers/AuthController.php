<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\authUser\RegisterUserRequest;
use App\Http\Requests\authUser\LoginUserRequest;

use App\Models\User;

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

        activity('auth')
            ->causedBy($new_user)
            ->withProperties([
                'username' => $new_user->username,
                'email' => $new_user->email,
            ])
        ->log('New user has been registered');

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

        activity('auth')
            ->causedBy($user)
            ->withProperties([
                'username' => $user->username,
                'email' => $user->email,
            ])
        ->log('The user has loggined');
        return redirect('/main')->with('success', "Welcome $user->username!");
    }
}
