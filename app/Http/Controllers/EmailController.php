<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Carbon\Carbon;

use App\Mail\UserConfirmationMail;
use App\Mail\UserChangePasswordMail;

use App\Models\EmailVerification;
use App\Models\UserConfirmation;
use App\Models\User;

use App\Providers\EmailService;

class EmailController extends Controller
{
    //
    private $EmailService;
    public function __construct(EmailService $EmailService) {
        $this->EmailService = $EmailService;
    }
    public function sendPasswordCode() {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $this->EmailService->sendPasswordUpdate($user);
        
        return view('user.change-password')->with([
            'success' => 'Code sent.',
            'change_password_access' => false,
    ]);
    }

    public function sendUsernameLink() {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $this->EmailService->sendPasswordUpdate($user);
        
        return view('user.change-password')->with([
            'success' => 'Code sent.',
            'change_password_access' => false,
    ]);
    }
    
    public function sendUserConfirmation(Request $request) {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }
        $this->EmailService->sendUserConfirmation($user);

        return view('user.sended-confirmation-user')->with([
            'success' => 'The link has been sent.',
            'user' => $user,
        ]);
    }
}
