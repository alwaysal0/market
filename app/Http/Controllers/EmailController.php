<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmailVerification;
use App\Models\UserConfirmation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class EmailController extends Controller
{
    //
    public function checkAction($action, Request $request) {
        switch($action) {
            case 'send-email':
                return $this->sendCode();
            case 'verification-email':
                return $this->checkCode($request);
            case 'access-true':
                return $this->changePass($request);
            default:
                abort(404, 'Unknowned page');
        }
    }
    public function sendCode() {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $code = rand(100000, 999999);

        EmailVerification::updateOrCreate([
            'email' => $user->email,
            'code' => $code,
            'expired_at' => Carbon::now()->addMinutes(10),
        ]);

        Mail::raw("Your code: {$code}", function($message) use ($user) {
            $message->to($user->email)->subject('[NO-REPLY] Test market | Changing Password');
        });

        return view('auth.change-password')->with([
            'success' => 'Code sent.',
            'change_password_access' => false,
    ]);
    }

    public function checkCode($request) {
        $request->validate([
            'code' => 'required|digits:6'
        ]);

        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        };

        $verification = EmailVerification::where('email', $user->email)
            ->where('code', $request->code)
            ->where('expired_at', '>', Carbon::now())
            ->first();
        
        if ($verification) {
            $verification->delete();
            return view('auth.change-password')->with([
                'success' => 'Code verified. You can change your password now.',
                'change_password_access' => true,
            ]);
        }

        return back()->withErrors(['code' => 'Invalid or expired code.']);
    }

    public function changePass($request) {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $current_user = Auth::user();
        if (!$current_user) {
            return abort(403, 'Unauthorized');
        }
        $password = Hash::make($request->password);
        User::find($current_user->id)->update([
            'password' => $password,
        ]);
        return redirect('/profile/edit-profile')
            ->with('success', 'You have successfully changed your password.');
    }
    
    public function sendUserConfirmation(Request $request) {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }
        $code = rand(10000000, 99999999);
        $link = url("/user-confirmation/{$code}");

        User::updateOrCreate([
            'email' => $user->email,
            'confirmation_link' => $link,
            'expired_at' => Carbon::now()->addMinutes(10),
        ]);

        Mail::raw("To confirm your email follow the link: {$link}", function($message) use ($user) {
            $message->to($user->email)->subject('[NO-REPLY] Test market | Confirmation User');
        });

        return view('auth.sended-confirmation-user')->with([
            'success' => 'The link has been sent.',
        ]);
    }
}
