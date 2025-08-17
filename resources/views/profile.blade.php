@extends ('layouts.app')

@section('title', 'Market - Profile')
@section('content')
@vite('resources/css/profile.css')
@include('modules.alerts')

<div id="profile-main-cont">
    <div id="profile-left-cont">
        <form method="GET" action="/profile/edit-profile">
            <button class="{{ $current_page === 'edit-profile' ? 'active-btn' : '' }}">Edit Profie</button>
        </form>
        <form method="GET" action="/profile/upload-good">
            <button class="{{ $current_page === 'upload-good' ? 'active-btn' : '' }}">Upload Good</button>
        </form>
        <form method="GET" action="/profile/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    <div id="profile-right-cont">
        @if($current_page === 'edit-profile')
            <p id="profile-right-cont-title">Edit your profile</p>
            <label>Change your username:</label>
            <form method='POST' action="/profile/edit-profile/username">
                @csrf
                <input type="text" name="username" id="profile-right-cont-username" value="{{ $user['username'] }}">
                <button disabled type="submit" class="disabled-btn" id="profile-right-cont-username-btn">Edit</button>
            </form>
            <label>Change your email:</label>
            <form method='POST' action="/profile/edit-profile/email">
                @csrf
                <input type="text" name="email" id="profile-right-cont-email" value="{{ $user['email'] }}">
                <button disabled type="submit" class="disabled-btn" id="profile-right-cont-email-btn">Edit</button>
            </form>
            <form method='POST' action="/profile/edit-profile/change-password/send-email">
                @csrf
                <button type="submit">Change Password</button>
            </form>
        @elseif ($current_page === 'upload-good')
            <p id="profile-right-cont-title">Your goods</p>
        @endif
    </div>
    @if ($current_page === 'upload-good')
    <div id="profile-upload-good-cont-overlay">
        <div id="profile-upload-good-cont">
            <div id="profile-upload-good-cont-close">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5A5A5A"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            </div>
            <p id="profile-upload-good-cont-title">Add good</p>
            <form method="POST" action="/profile/upload-good-auth" enctype="multipart/form-data">
                @csrf
                <label>Choose the photo:</label>
                <input type="file" name="image">
                <div class="profile-upload-good-cont-input">
                    <input type="text" name="name" id="profile-upload-good-cont-form-name" placeholder=" ">
                    <label for="profile-upload-good-cont-form-name">Name of the good:</label>
                </div>
                <div class="profile-upload-good-cont-input">
                    <textarea name="description" id="profile-upload-good-cont-form-description" placeholder=" "></textarea>
                    <label for="profile-upload-good-cont-form-description">Description</label>
                </div>
                <div class="profile-upload-good-cont-input">
                    <input type="float" name="price" id="profile-upload-good-cont-form-price" placeholder=" ">
                    <label for="profile-upload-good-cont-form-price">Price</label>
                </div>
                <button type="submit">Add</button>
            </form>
        </div>
    </div>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeBtn = document.getElementById('profile-upload-good-cont-close');
        const addGoodCont = document.getElementById('profile-upload-good-cont-overlay');
        const inputUsername = document.getElementById('profile-right-cont-username');
        const inputUsernameBtn = document.getElementById('profile-right-cont-username-btn');
        const inputEmail = document.getElementById('profile-right-cont-email');
        const inputEmailBtn = document.getElementById('profile-right-cont-email-btn');

        closeBtn.addEventListener('click', function() {
            addGoodCont.style.display = 'none';
        });

        inputUsername.addEventListener('input', (event) => {
            console.log(event.target.value);
            if (event.target.value.trim() !== '') {
                inputUsernameBtn.disabled = false;
                inputUsernameBtn.classList = '';
            } else {
                inputUsernameBtn.disabled = true;
                inputUsernameBtn.classList = 'disabled-btn';
            }
        });

        inputEmail.addEventListener('input', (event) => {
            if (event.target.value.trim() !== '') {
                inputEmailBtn.disabled = false;
                inputEmailBtn.classList = '';
            } else {
                inputEmailBtn.disabled = true;
                inputEmailBtn.classList = 'disabled-btn';
            }
        });

    });
</script>


@endsection