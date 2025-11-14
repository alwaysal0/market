<?php
namespace App\Services;

use App\Events\User\UserChangedEmail;
use App\Events\User\UserChangedUsername;
use App\Events\User\UserError;
use App\Events\User\UserSentReport;
use App\Events\User\UserSentReview;
use App\Models\Report;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserService {
    public function changeEmail (array $validated_data, User $user) : void
    {
        $old_email = $user->email;
        $new_email = $validated_data['email'];

        $user->update([
            'email' => $new_email,
            'confirmed' => false,
        ]);

        event(new UserChangedEmail($user, $old_email, $new_email));
    }

    public function changeUsername (array $validated_data, User $user) : bool
    {
        if ($user->updated_at->diffInMinutes(now()) < 1) {
            $content = 'User change username failed: less than a minute has passed since the last update.';
            event(new UserError($user, $content));
            return false;
        }

        $old_username = $user->username;
        $new_username = $validated_data['username'];

        $user->update([
            'username' => $new_username,
        ]);

        event(new UserChangedUsername($user, $old_username, $new_username));
        return true;
    }

    public function changePassword (array $validated_data, User $user) : void
    {
        $user->update([
            'password' => Hash::make($validated_data['password']),
        ]);


    }

    public function sendReport(array $validatedData, User $user) : void
    {
        Report::create([
            'user_id' => $user->id,
            'content' => $validatedData['content'],
        ]);

        event(new UserSentReport($user, $validatedData['content']));
    }

    public function sendReview(array $validatedData, User $user, int $id) : void
    {
        Review::create([
            'user_id' => $user->id,
            'product_id' => $id,
            'message' => $validatedData['message'],
            'rating' => $validatedData['rating'],
        ]);

        event(new UserSentReview($user, $validatedData['message']));
    }
}
