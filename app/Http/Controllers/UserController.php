<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\User;
use App\Models\UserConfirmation;
use App\Models\EmailVerification;

use App\Services\EditProfile;
use App\Services\FilterProducts;
use App\Services\EmailService;

class UserController extends Controller
{   
    private $editProfile;
    private $filterProducts;
    private $user;
    private $EmailService;
    public function __construct(EditProfile $editProfile, FilterProducts $filterProducts, EmailService $EmailService) {
        $this->editProfile = $editProfile;
        $this->filterProducts = $filterProducts;
        $this->user = Auth::user();
        $this->EmailService = $EmailService;
    }

    public function confirmUser(request $request, $token) {
        $currentUrl = $request->fullUrl();
        $user_confirmation = UserConfirmation::where('confirmation_link', $currentUrl)->first();

        if ($this->user->confirmed) {
            return redirect('/')->with('info', 'Your account is already confirmed.');
        }

        if (!$user_confirmation || $this->user->email !== $user_confirmation->email) {
            return redirect('/')->with('error', 'The link is invalid.');
        }

        if (Carbon::now()->greaterThan($user_confirmation->expired_at)) {
            return view('auth.expired-page')->with('error', 'The link has expired.');
        }

        $current_user = User::find($this->user->id);
        $current_user->update([
            'confirmed' => true
        ]);

        $user_confirmation->delete();
        
        return redirect('/')->with('success', 'Your email has been confirmed!');
    }

    public function checkPasswordCode(request $request) {
        $request->validate([
            'code' => 'required|digits:6'
        ]);

        if (!$this->user) {
            abort(403, 'Unauthorized');
        };

        $verification = EmailVerification::where('email', $this->user->email)
            ->where('code', $request->code)
            ->where('expired_at', '>', Carbon::now())
            ->first();
        
        if ($verification) {
            $verification->delete();
            return view('user.change-password')->with([
                'success' => 'Code verified. You can change your password now.',
                'change_password_access' => true,
            ]);
        }

        return back()->withErrors(['code' => 'Invalid or expired code.']);
    }

    public function updatePassword(request $request) {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        if (!$this->user) {
            return abort(403, 'Unauthorized');
        }

        $this->editProfile->changePassword($request);

        return redirect()->route('profile.edit-profile')
            ->with('success', 'You have successfully changed your password.');
    }

    public function updateUsername(request $request) {
        $request->validate([
            'username' => 'required|min:4'
        ]);

        $update = $this->editProfile->changeUsername($request);
        if ($update === true) {
            return redirect()->route('profile.edit-profile')
                ->with('success', 'You have successfully changed your username.');
        } else {
            return redirect()->route('profile.edit-profile')
                ->with('error', 'Between the attempts should be 1 min.');
        }

    }

    public function updateEmail(request $request) {
        $request->validate([
            'email' => 'required|email',
        ]);

        $this->editProfile->changeEmail($request);
        return redirect()->route('profile.edit-profile')
            ->with('success', 'You have successfully changed your email.');
    }

    public function filterYourProducts(request $request) {
        $products = $this->filterProducts->filter($request);

        return view('profile')->with([
            'current_page' => 'your-products',
            'user' => $this->user,
            'products' => $products,
        ]);
    }

    public function sendUserConfirmation(Request $request) {
        if (!$this->user) {
            abort(403, 'Unauthorized');
        }
        $this->EmailService->sendUserConfirmation($this->user);

        return view('user.sended-confirmation-user')->with([
            'success' => 'The link has been sent.',
            'user' => $this->user,
        ]);
    }

    public function sendPasswordCode() {
        if (!$this->user) {
            abort(403, 'Unauthorized');
        }

        $this->EmailService->sendPasswordUpdate($this->user);
        
        return view('user.change-password')->with([
            'success' => 'Code sent.',
            'change_password_access' => false,
        ]);
    }

    public function sendFeedback(Request $request) {
        $request->validate([
            'name' => 'required|min: 6',
            'email' => 'required|email',
            'message' => 'required|min: 10'
        ]);
        $this->EmailService->sendFeedback($request);
        return redirect('/login')->with('success', 'You have successfully sent your feedback.');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login')->with('success', 'You have successfully logged out of your account.');
    }
}
