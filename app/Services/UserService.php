<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Report;
use App\Models\Review;


class UserService {
    public function changeEmail (array $validated_data, User $user) : void
    {
        $old_email = $user->email;
        $new_email = $validated_data['email'];

        $user->update([
            'email' => $new_email,
            'confirmed' => false,
        ]);

        activity('user')
            ->causedBy($user)
            ->withProperties([
                'old_email' => $old_email,
                'new_email' => $new_email,
            ])
        ->log('User has changed his email.');
    }

    public function changeUsername (array $validated_data, User $user) : bool
    {
        if ($user->updated_at->diffInMinutes(now()) < 1) {
            activity('user-error')
                ->causedBy($user)
            ->log('User change username failed: less than a minute has passed since the last update.');
            return false;
        }

        $old_username = $user->username;
        $new_username = $validated_data['username'];

        $user->update([
            'username' => $new_username,
        ]);

        activity('user')
            ->causedBy($user)
            ->withProperties([
                'old_username' => $old_username,
                'new_username' => $new_username,
            ])
        ->log('User has changed his username.');
        return true;
    }

    public function changePassword (array $validated_data, User $user) : void
    {
        $user->update([
            'password' => Hash::make($validated_data['password']),
        ]);

        activity('user')
            ->causedBy($user)
        ->log('User has changed his password.');
    }

    public function sendReport(array $validatedData, User $user) : void
    {
        Report::create([
            'user_id' => $user->id,
            'content' => $validatedData['content'],
        ]);

        activity('user')
            ->causedBy($user)
            ->withProperties([
                'username' => $user->username,
                'content' => $validatedData['content'],
            ])
        ->log('Sent the report.');
    }

    public function sendReview(array $validatedData, User $user, int $id) : void
    {
        Review::create([
            'user_id' => $user->id,
            'product_id' => $id,
            'message' => $validatedData['message'],
            'rating' => $validatedData['rating'],
        ]);

        activity('user')
            ->causedBy($user)
            ->withProperties([
                'username' => $user->username,
                'message' => $validatedData['message'],
            ])
        ->log('Sent the review.');
    }
}
