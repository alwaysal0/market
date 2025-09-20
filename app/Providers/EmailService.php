<?php
namespace App\Providers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\Product;
use App\Models\Filter;
use App\Models\User;
use App\Models\UserConfirmation;
use App\Models\EmailVerification;

use App\Mail\UserConfirmationMail;
use App\Mail\UserChangePasswordMail;

class EmailService {
    public function sendEmailUpdate ($request) {
        $current_user = Auth::user();
        User::find($current_user->id)->update([
            'confirmed' => false,
        ]);
        User::where('id', $current_user->id)->update([
            'email' => $request->email,
        ]);
    }
    
    public function sendPasswordUpdate ($user) {
        $code = rand(100000, 999999);

        EmailVerification::updateOrCreate([
            'email' => $user->email,
            'code' => $code,
            'expired_at' => Carbon::now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send( new UserChangePasswordMail($code));
    }

    public function sendUserConfirmation($user) {
        $token = Str::random(64);
        $link = url("/user-confirmation/{$token}");

        UserConfirmation::updateOrCreate([
            'email' => $user->email,
            'confirmation_link' => $link,
            'expired_at' => Carbon::now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send( new UserConfirmationMail($link));
    }
}
