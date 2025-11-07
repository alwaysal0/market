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
            @include('modules.profile.edit-profile')
        @elseif ($current_page === 'your-products')
            <p id="profile-right-cont-title">Your products</p>
            <button id="profile-right-cont-add-product-button">Add Product</button>
            @if ($current_page === 'your-products')
                @if ($products->isNotEmpty())
                    @include('modules.profile.your-products')
                @else
                    @include('modules.profile.display-no-products')
                @endif
            @endif
        @endif
    </div>
</div>

@endsection
