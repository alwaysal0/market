@vite('resources/css/modules/main/last-products.css')
@vite('resources/css/modules/profile/product-card.css')

<p id="last-products-title">Last 10 Products</p>
<div id="last-products-cont">
    @foreach ($products as $product)
        @include('modules.profile.product-card', ['product' => $product])
    @endforeach
</div>
<a id="last-products-view-more" href="/products">View More<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#2563eb"><path d="M440-800v487L216-537l-56 57 320 320 320-320-56-57-224 224v-487h-80Z"/></svg></a>