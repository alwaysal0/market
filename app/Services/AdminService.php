<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Product;

class AdminService {
    private $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    public function changeEmail ($request, $id) {
        $user = User::find($id);
        $old_email = $user->email;
        $new_email = $request->email;

        $user->update([
            'email' => $new_email,
            'confirmed' => false,
        ]);

        activity('admin')
            ->causedBy($this->user)
            ->performedOn($user)
            ->withProperties([
                'old_email' => $old_email,
                'new_email' => $new_email,
            ])
            ->log("Admin has changed user's email.");

    }

    public function changeUsername ($request, $id) {
        $user = User::find($id);
        $old_username = $user->username;
        $new_username = $request->username;

        $user->update([
            'username' => $new_username,
        ]);

        activity('admin')
            ->causedBy($this->user)
            ->performedOn($user)
            ->withProperties([
                'old_username' => $old_username,
                'new_username' => $new_username,
            ])
        ->log("Admin has changed user's username.");
    }

    public function changePassword ($request, $id) {
        $user = User::find($id);
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        activity('admin')
            ->causedBy($this->user)
            ->performedOn($user)
        ->log("Admin has changed user's password.");
    }

    public function updateProduct($request, $id) {
        $product= Product::find($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        activity('admin')
            ->causedBy($this->user)
            ->performedOn($product)
        ->log("Admin has changed product's data.");
    }

    public function deleteProduct($id) {
        $product = Product::find($id);
        $product->delete();

        activity('admin')
            ->causedBy($this->user)
            ->perfomedOn($product)
        ->log("Admin has deleted product.");
    }
}
