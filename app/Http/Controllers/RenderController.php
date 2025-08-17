<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RenderController extends Controller
{
    public function showRegister() {
        if (Auth::user()) {
            return redirect('/main');
        } else {
            return view('auth.register');
        }
    }

    public function showLogin() {
        if (Auth::check()) {
            return redirect('/main');
        } else {
            return view('auth.login');
        }
    }
    
    public function showMain() {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $user = Auth::user();
        return view('main')->with('user', $user);
    }

    public function showProfile() {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('profile');
    }

    public function showSendCode() {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('auth.change-password')->with('change_password_access', false);
    }

    public function showChangePass() {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('auth.change-password')->with('change_password_access', true);
    }

}
