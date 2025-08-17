<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    //
    public function showProfile($current_page) {
        
        if ($current_page === 'logout') {
            Auth::logout();
            return redirect('/login')->with('success', 'You have successfully logged out of your account.');
        }

        $current_user = Auth::user();
        return view('profile')->with([
            'current_page'=> $current_page,
            'user' => $current_user,
        ]);
    }

    public function editProfile($action, Request $request) {
        $current_user = Auth::user();
        switch($action) {
            case 'username':
                User::where('id', $current_user->id)->update([
                    'username' => $request->username,
                ]);
                break;
            case 'email':
                User::where('id', $current_user->id)->update([
                    'email' => $request->email,
                ]);
                break;
        };

        return back()->with('success', 'Your ' . $action . ' has been successfully updated.');
    }
}