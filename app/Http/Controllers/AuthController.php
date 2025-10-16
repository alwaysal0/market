<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{

    public function register(request $request) {
        $request->validate([
            'username' => 'required|string|min|4|max:30',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|regex:/^(?=.*[0-9])(?=.*[\W_]).+$/|confirmed',
        ]);

        $password = Hash::make($request->input('password'));

        $new_user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
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

    public function login(request $request) {
        $data = $request->only(['username', 'password']);
        $user = User::where('username', $request->username)->first();

        if (!Auth::attempt($data)) {
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
