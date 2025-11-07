<a class="mini-product-card" href="{{ route('product', ['product' => $product]) }}">
    <img src="{{ $product->image_url }}" alt="product-image">
    <p class="mini-product-card__data"><span>Name:</span> {{ $product->name }}</p>
    <p class="mini-product-card__data"><span>Price:</span> {{ $product->price }}$</p>
    <p class="mini-product-card__filters">
        <span class="mini-product-card__filter-tag">Filters:</span>
        @foreach ($filters as $filter)
            <span class="{{ $filter->filter_name }}">
                {{ $filter->filter_name }}
            </span>
        @endforeach
    </p>
    <p class="mini-product-card__more">View more</p>
</a>
