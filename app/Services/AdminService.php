<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Product;

class AdminService {

    public function changeEmail (array $validated_data, User $admin, User $user_to_change) : void
    {
        $old_email = $user_to_change->email;
        $new_email = $validated_data['email'];

        $user_to_change->update([
            'email' => $new_email,
            'confirmed' => false,
        ]);

        activity('admin')
            ->causedBy($admin)
            ->performedOn($user_to_change)
            ->withProperties([
                'old_email' => $old_email,
                'new_email' => $new_email,
            ])
        ->log("Admin has changed user's email.");
    }

    public function changeUsername (array $validated_data, User $admin, User $user_to_change) : void
    {
        $old_username = $user_to_change->username;
        $new_username = $validated_data['username'];

        $user_to_change->update([
            'username' => $new_username,
        ]);

        activity('admin')
            ->causedBy($admin)
            ->performedOn($user_to_change)
            ->withProperties([
                'old_username' => $old_username,
                'new_username' => $new_username,
            ])
        ->log("Admin has changed user's username.");
    }

    public function changePassword (array $validated_data, User $admin, User $user_to_change) : void
    {
        $user_to_change->update([
            'password' => Hash::make($validated_data['password']),
        ]);

        activity('admin')
            ->causedBy($admin)
            ->performedOn($user_to_change)
        ->log("Admin has changed user's password.");
    }

    public function updateProduct(array $validated_data, User $admin, Product $product) : void
    {

        $product->update([
            'name' => $validated_data['name'],
            'price' => $validated_data['price'],
            'description' => $validated_data['description'],
        ]);

        activity('admin')
            ->causedBy($admin)
            ->performedOn($product)
            ->withProperties([
                'actual_name' => $product->name,
                'actual_description' => $product->description,
                'actual_price' => $product->price,
            ])
        ->log("Admin has changed product's data.");
    }

    public function deleteProduct($user, $product) : void
    {
        $product->delete();

        activity('admin')
            ->causedBy($this->user)
            ->perfomedOn($product)
        ->log("Admin has deleted product.");
    }
}
