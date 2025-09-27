<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class EditProfile {

    private $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    public function changeEmail ($request) {
        $old_email = $this->user->email;
        $new_email = $request->email;
        
        $this->user->update([
            'email' => $new_email,
            'confirmed' => false,
        ]);

        activity('user')
            ->causedBy($this->user)
            ->withProperties([
                'old_email' => $old_email,
                'new_email' => $new_email,
            ])
            ->log('User has changed his email.');
    }

    public function changeUsername ($request) {
        if ($this->user->updated_at->diffInMinutes(now()) < 1) {
            activity('user-error')
                ->causedBy($this->user)
            ->log('User change username failed: less than a minute has passed since the last update.');
            return false;
        }
        $old_username = $this->user->username;
        $new_username = $request->username;
        $this->user->update([
            'username' => $new_username,
        ]);

        activity('user')
            ->causedBy($this->user)
            ->withProperties([
                'old_username' => $old_username,
                'new_username' => $new_username,
            ])
        ->log('User has changed his username.');
        return true;
    }

    public function changePassword ($request) {
        $this->user->update([
            'password' => Hash::make($request->password),
        ]);
        
        activity('user')
            ->causedBy($this->user)
        ->log('User has changed his password.');
    }
}
