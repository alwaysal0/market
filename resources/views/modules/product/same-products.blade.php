@vite('resources/css/modules/product/same-products.css')

@if ($same_products->isNotEmpty())
<p id="same-product-title">Check out related products:</p>
<div id="same-products">
    @foreach ($same_products as $same_product)
        <a class="same-product__card" href="{{ route('product', ['id' => $same_product->id]) }}">
            <img src="{{ $same_product->image_url }}" alt="product-image">
            <p class="same-product__data"><span>Name:</span> {{ $same_product->name }}</p>
            <p class="same-product__data"><span>Price:</span> {{ $same_product->price }}$</p>
            <p class="same-product__filters">
                <span class="same-product__filter-tag">Filters:</span>
                @foreach ($filters as $filter)
                    <span class="{{ $filter->filter_name }}">
                        {{ $filter->filter_name }}
                    </span>
                @endforeach
            </p>
            <p class="same-product__more">View more</p>
        </a>
    @endforeach
        <a href="{{ route('products') }}" class="same-products__more-text">
            <span>View more Products</span>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#2563eb"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
        </a>
</div>
@endif
