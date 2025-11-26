<?php
namespace App\Services;

use App\Events\Admin\AdminChangedEmail;
use App\Events\Admin\AdminChangedPassword;
use App\Events\Admin\AdminChangedProduct;
use App\Events\Admin\AdminChangedUsername;
use App\Events\Admin\AdminDeletedProduct;
use App\Events\Admin\AdminRepliedReport;
use App\Models\Report;
use App\Models\Response;
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

    public function replyReport(User $user, Report $report, Array $validatedData) : void
    {
        $response = Response::create([
            "user_id" => $report->user_id,
            "report_id" => $report->id,
            "content" => $validatedData['response'],
        ]);

        $report->update([
            'status' => 0,
        ]);

        event(new AdminRepliedReport($report->user_id, $user, $report->id, $response->id));
    }
}
