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
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|regex:/^(?=.*[0-9])(?=.*[\W_]).+$/|confirmed',
        ]);

        $password = Hash::make($request->input('password'));

        User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $password,
        ]);

        return redirect('/login')->with('success', 'Registartion successful!');

    }
    
    public function login(request $request) {
        $data = $request->only(['username', 'password']);

        if (Auth::attempt($data)) {
            $user = $request['username'];
            return redirect('/main')->with('success', "Welcome '$user'!");
        } else {
            return back()->withErrors([
                'wrong-data' => 'The password or email is incorrect.'
            ]);
        }
    }
}
