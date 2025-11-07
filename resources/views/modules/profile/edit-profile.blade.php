@vite('resources/css/modules/profile/edit-profile.css')

<p id="profile-right-cont-title">Edit your profile</p>
@if ($user->confirmed)
    <p class="profile-right-cont-confirmed-status">Your account is <span style="color: #155724;">confirmed</span>.</p>
@else
    <p class="profile-right-cont-confirmed-status">Your account is <span style="color: #721c24;">not confirmed</span>.</p>
    <form method='POST' action="/user-confirmation">
        @csrf
        <p>To confirm it, follow the button <button class="profile-right-cont-change-data-buttons" type="submit">Confirm</button></p>
    </form>
@endif
<label>Change your username:</label>
<form method='POST' action="{{ route('username.update') }}">
    @csrf
    <input type="text" name="username" id="profile-right-cont-username" value="{{ $user['username'] }}">
    <button disabled type="submit" class="profile-right-cont-change-data-buttons disabled-btn" id="profile-right-cont-username-btn">Edit</button>
</form>
<label>Change your email:</label>
<form method='POST' action="{{ route('email.update') }}">
    @csrf
    <input type="text" name="email" id="profile-right-cont-email" value="{{ $user['email'] }}">
    <button disabled type="submit" class="profile-right-cont-change-data-buttons disabled-btn" id="profile-right-cont-email-btn">Edit</button>
</form>
<form method='POST' action="{{ route('password.email') }}">
    @csrf
    <button type="submit" class="profile-right-cont-change-data-buttons profile-change-password">Change Password</button>
</form>
