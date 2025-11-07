@vite('resources/css/modules/product/same-products.css')
@vite('resources/css/modules/product/mini-product-card.css')

@if ($same_products->isNotEmpty())
<p id="same-product-title">Check out related products:</p>
<div id="same-products">
    @foreach ($same_products as $product)
        @include('modules.product.mini-product-card')
    @endforeach
        <a href="{{ route('products') }}" class="same-products__more-text">
            <span>View more Products</span>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#2563eb"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
        </a>
</div>
@endif
