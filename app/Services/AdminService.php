<?php
namespace App\Services;

use App\Events\Admin\AdminChangedEmail;
use App\Events\Admin\AdminChangedPassword;
use App\Events\Admin\AdminChangedProduct;
use App\Events\Admin\AdminChangedUsername;
use App\Events\Admin\AdminDeletedProduct;
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

        event(new AdminChangedEmail($admin, $user_to_change, $old_email, $new_email));
    }

    public function changeUsername (array $validated_data, User $admin, User $user_to_change) : void
    {
        $old_username = $user_to_change->username;
        $new_username = $validated_data['username'];

        $user_to_change->update([
            'username' => $new_username,
        ]);

        event(new AdminChangedUsername($admin, $user_to_change, $old_username, $new_username));
    }

    public function changePassword (array $validated_data, User $admin, User $user_to_change) : void
    {
        $user_to_change->update([
            'password' => Hash::make($validated_data['password']),
        ]);

        event(new AdminChangedPassword($admin, $user_to_change));
    }

    public function updateProduct(array $validated_data, User $admin, Product $product) : void
    {

        $product->update([
            'name' => $validated_data['name'],
            'price' => $validated_data['price'],
            'description' => $validated_data['description'],
        ]);

        event(new AdminChangedProduct($admin, $product));
    }

    public function deleteProduct($user, $product) : void
    {
        $product_data = [$product->id, $product->name];
        $product->delete();

        event(new AdminDeletedProduct($user, $product_data));
    }
}
