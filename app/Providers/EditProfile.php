<?php
namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Product;
use App\Models\Filter;
use App\Models\User;

class EditProfile {

    private $user;

    public function __construct() {
        $this->user = Auth::user();
    }
    public function changeEmail ($request) {
        User::find($this->user->id)->update([
            'confirmed' => false,
        ]);
        User::where('id', $this->user->id)->update([
            'email' => $request->email,
        ]);
    }

    public function changeUsername ($request) {
        $user = User::where('id', $this->user->id)->first();
        if ($user->updated_at->diffInMinutes(now()) >= 1) {
            $user->update([
                'username' => $request->username
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function changePassword ($request) {
        $password = Hash::make($request->password);
        User::find($this->user->id)->update([
            'password' => $password,
        ]);
    }
}
