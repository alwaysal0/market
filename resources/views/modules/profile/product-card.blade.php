@vite('resources/css/modules/profile/product-card.css')

<div class="profile-right-cont-product-card">
    <img src="{{ $product->image_url }}" alt="">
    <p><span>ID:</span> {{ $product->id }}</p>
    <p><span>Name:</span> {{ $product->name }}</p>
    <p class="description"><span>Description:</span> {{ $product->description }}</p>
    <div class="profile-right-cont-product-card-price-buy"">
        <p><span>Price:</span>{{ $product->price }}</p>
        <form method="POST" action="">
            @if(request()->is('profile/your-products'))
                <button type="submit" class="disabled-product-card" disabled>Buy</button>
            @else
                <button type="submit">Buy</button>
            @endif
        </form>
    </div>
</div>