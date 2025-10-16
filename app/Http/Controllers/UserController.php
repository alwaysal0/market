<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\actionsUser\SendReportRequest;
use App\Http\Requests\actionsUser\SendReviewRequest;
use App\Http\Requests\updateUser\CheckPasswordCodeRequest;
use App\Http\Requests\updateUser\UpdateEmailRequest;
use App\Http\Requests\updateUser\UpdatePasswordRequest;
use App\Http\Requests\updateUser\UpdateUsernameRequest;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\EmailVerification;
use App\Models\UserConfirmation;

use App\Services\EmailService;
use App\Services\FilterProducts;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService,
        private FilterProducts $filterProducts,
        private EmailService $emailService
    ){
    }

    public function confirmUser(Request $request, $token) {
        $currentUrl = $request->fullUrl();
        $user_confirmation = UserConfirmation::where('confirmation_link', $currentUrl)->first();
        $user = $request->user();

        if ($user->confirmed) {
            return redirect('/')->with('info', 'Your account is already confirmed.');
        }

        if (!$user_confirmation || $user->email !== $user_confirmation->email) {
            return redirect('/')->with('error', 'The link is invalid.');
        }

        $user->update([
            'confirmed' => true
        ]);

        $user_confirmation->delete();

        activity('auth')
            ->causedBy($user)
        ->log('The user has confirmed his account successfully.');

        return redirect('/')->with('success', 'Your email has been confirmed!');
    }

    public function checkPasswordCode(CheckPasswordCodeRequest $request) {
        $user = $request->user();
        $request->validated();

        $verification = EmailVerification::where('email', $user->email)
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

    public function updatePassword(UpdatePasswordRequest $request) {
        $user = $request->user();
        $validated_data = $request->validated();

        $this->userService->changePassword($validated_data, $user);

        return redirect()->route('profile.edit-profile')
            ->with('success', 'You have successfully changed your password.');
    }

    public function updateUsername(UpdateUsernameRequest $request) {
        $user = $request->user();
        $validated_data = $request->validated();

        $update = $this->userService->changeUsername($validated_data, $user);
        if ($update === true) {
            return redirect()->route('profile.edit-profile')
                ->with('success', 'You have successfully changed your username.');
        } else {
            return redirect()->route('profile.edit-profile')
                ->with('error', 'Between the attempts should be 1 min.');
        }

    }

    public function updateEmail(UpdateEmailRequest $request) {
        $user = $request->user();
        $validated_data = $request->validated();

        $this->userService->changeEmail($validated_data, $user);

        return redirect()->route('profile.edit-profile')
            ->with('success', 'You have successfully changed your email.');
    }

    public function filterYourProducts(Request $request) {
        $user = $request->user();

        $products = $this->filterProducts->filter($request);

        return view('profile')->with([
            'current_page' => 'your-products',
            'user' => $user,
            'products' => $products,
        ]);
    }

    public function sendUserConfirmation(Request $request) {
        $user = $request->user();

        $this->emailService->sendUserConfirmation($user);

        return view('user.sended-confirmation-user')->with([
            'success' => 'The link has been sent.',
            'user' => $user,
        ]);
    }

    public function sendPasswordCode(Request $request) {
        $user = $request->user();

        $this->emailService->sendPasswordUpdate($user);

        return view('user.change-password')->with([
            'success' => 'Code sent.',
            'change_password_access' => false,
            'user' => $user,
        ]);
    }

    public function sendReport(SendReportRequest $request) {
        $user = $request->user();
        $validatedData = $request->validated();

        $this->userService->sendReport($validatedData, $user);

        return redirect()->route('support')->with('success', "You have successfully sent your feedback.");
    }

    public function sendReview(SendReviewRequest $request, int $id) {
        $user = $request->user();
        $validatedData = $request->validated();

        $this->userService->sendReview($validatedData, $user, $id);

        return back()->with('success', "You have successfully posted your review.");
    }

    public function logout(Request $request) {
        $user = $request->user();

        activity('auth')
            ->causedBy($user)
        ->log('The user has been successfully logged out.');

        Auth::logout();

        return redirect('/login')->with('success', 'You have successfully logged out of your account.');
    }
}
