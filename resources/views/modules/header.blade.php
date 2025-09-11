@vite('resources/css/modules/header.css')

<header>
    <div id="header-title-cont">
        <p>Market</p>
    </div>
    <div id="header-tools-cont">
        <a href="/main">Main</a>
        <a href="/products">Products</a>
        <a href="/support">Support</a>

        @if (!empty($user))
            <a href="/profile/edit-profile">Profile</a>
        @else
            <a href="/login">Login</a>
        @endif
    </div>
</header>