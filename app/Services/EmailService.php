<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\User;
use App\Models\UserConfirmation;
use App\Models\EmailVerification;

use App\Mail\UserConfirmationMail;
use App\Mail\UserChangePasswordMail;
use App\Mail\FeedbackMail;

class EmailService {
    public function sendPasswordUpdate ($user) {
        $code = rand(100000, 999999);

        $emailVerification = EmailVerification::updateOrCreate(['email' => $user->email],
            [
            'code' => $code,
            'expired_at' => Carbon::now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send( new UserChangePasswordMail($code));

        activity('email')
            ->causedBy($user)
            ->performedOn($emailVerification)
            ->withProperties([
                'email' => $user->email,
                'code' => $code,
            ])
            ->log('Sent code for password update.');
    }

    public function sendUserConfirmation($user) {
        $token = Str::random(64);
        $link = url("/user-confirmation/{$token}");

        $userConfirmation = UserConfirmation::updateOrCreate(['email' => $user->email],
            [
            'confirmation_link' => $link,
            'expired_at' => Carbon::now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send( new UserConfirmationMail($link));

        activity('email')
            ->causedBy($user)
            ->performedOn($userConfirmation)
            ->withProperties([
                'email' => $user->email,
                'link' => $link,
            ])
            ->log('Sent link for user confirmation.');
    }
}
