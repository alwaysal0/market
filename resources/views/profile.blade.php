@extends ('layouts.app')

@section('title', 'Market - Profile')
@section('content')
@vite('resources/css/profile.css')
@vite('resources/css/modules/product-card.css')
@include('modules.alerts')

<div id="profile-main-cont">
    <div id="profile-left-cont">
        <form method="GET" action="/profile/edit-profile">
            <button class="{{ $current_page === 'edit-profile' ? 'active-btn' : '' }}">Edit Profie</button>
        </form>
        <form method="GET" action="/profile/your-products">
            <button class="{{ $current_page === 'your-products' ? 'active-btn' : '' }}">Your Products</button>
        </form>
        <form method="GET" action="/profile/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    @include('modules.add-product')
    <div id="profile-right-cont">
        @if($current_page === 'edit-profile')
            <p id="profile-right-cont-title">Edit your profile</p>
            <label>Change your username:</label>
            <form method='POST' action="/profile/edit-profile/username">
                @csrf
                <input type="text" name="username" id="profile-right-cont-username" value="{{ $user['username'] }}">
                <button disabled type="submit" class="profile-right-cont-change-data-buttons disabled-btn" id="profile-right-cont-username-btn">Edit</button>
            </form>
            <label>Change your email:</label>
            <form method='POST' action="/profile/edit-profile/email">
                @csrf
                <input type="text" name="email" id="profile-right-cont-email" value="{{ $user['email'] }}">
                <button disabled type="submit" class="profile-right-cont-change-data-buttons disabled-btn" id="profile-right-cont-email-btn">Edit</button>
            </form>
            <form method='POST' action="/profile/edit-profile/change-password/send-email">
                @csrf
                <button type="submit" class="profile-right-cont-change-data-buttons">Change Password</button>
            </form>
        @elseif ($current_page === 'your-products')
            <p id="profile-right-cont-title">Your products</p>
            <button id="profile-right-cont-add-product-button">Add Product</button>
            @if ($current_page === 'your-products')
                @if ($products->isNotEmpty())
                <form method="POST" action="/profile/your-products/filter" id="profile-right-cont-filters">
                    @csrf
                    <label for="profile-right-cont-select-filter">Filter:</label>
                    <select name="select_filter" id="profile-right-cont-select-filter">
                        <option value="asc">By data(asc)</option>
                        <option value="desc">By data(desc)</option>
                        <option value="technique">Technique</option>
                        <option value="clothes">Clothes</option>
                        <option value="rofl">Rofl</option>
                    </select>
                    <button type="submit">Filter</button>
                </form>
                <div id="profile-right-cont-products">
                    @foreach ($products as $product)
                        <div class="profile-right-cont-product-card">
                            <img src="{{ $product->image_url }}" alt="">
                            <p><span>ID:</span> {{ $product->id }}</p>
                            <p><span>Name:</span> {{ $product->name }}</p>
                            <p class="description"><span>Description:</span> {{ $product->description }}</p>
                        </div>
                    @endforeach
                </div>
                @else
                    @include('modules.profile.display-no-products')
                @endif
            @endif
        @endif
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputUsername = document.getElementById('profile-right-cont-username');
        const inputUsernameBtn = document.getElementById('profile-right-cont-username-btn');
        const inputEmail = document.getElementById('profile-right-cont-email');
        const inputEmailBtn = document.getElementById('profile-right-cont-email-btn');

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

    document.addEventListener('DOMContentLoaded', ()=> {
        const addProductButton = document.getElementById('profile-right-cont-add-product-button');
        const addProductWindow = document.getElementById('profile-add-good-cont-overlay'); 
        addProductButton.addEventListener('click', function() {
            addProductWindow.style.display = 'block';
        });
    });
</script>


@endsection