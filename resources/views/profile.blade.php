@extends ('layouts.app')

@section('title', 'Market - Profile')
@section('content')
@vite('resources/css/profile.css')
@vite('resources/js/profile.js')
@vite('resources/css/modules/profile/product-card.css')

<div id="profile-main-cont">
    <div id="profile-left-cont">
        <a href="{{ route('profile.edit-profile') }}" class="{{ $current_page === 'edit-profile' ? 'active-btn' : '' }}">Edit Profile</a>
        <a href="{{ route('profile.your-products') }}" class="{{ $current_page === 'your-products' ? 'active-btn' : '' }}">Your Products</a>
        <form method="POST" action="{{ route('profile.logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    @include('modules.add-product')
    <div id="profile-right-cont">
        @if($current_page === 'edit-profile')
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
                <button type="submit" class="profile-right-cont-change-data-buttons">Change Password</button>
            </form>
        @elseif ($current_page === 'your-products')
            <p id="profile-right-cont-title">Your products</p>
            <button id="profile-right-cont-add-product-button">Add Product</button>
            @if ($current_page === 'your-products')
                @if ($products->isNotEmpty())
                <form method="POST" action="{{ route('profile.your-products.filter') }}" id="profile-right-cont-filters">
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
                        @include('modules.profile.product-card', ['product' => $product])
                    @endforeach
                </div>
                @else
                    @include('modules.profile.display-no-products')
                @endif
            @endif
        @endif
    </div>
</div>

@endsection
