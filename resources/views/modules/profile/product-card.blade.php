<a class="product-card" href="{{ route('product', ['id' => $product->id]) }}">
    <img src="{{ $product->image_url }}" alt="">
    <p><span>ID:</span> {{ $product->id }}</p>
    <p><span>Name:</span> {{ $product->name }}</p>
    <p class="product-card__description"><span>Description:</span> {{ $product->description }}</p>
    <div class="product-card__price-buy">
        <p><span>Price:</span>{{ $product->price }}</p>
        <form method="POST" action="#">
            @if(request()->is('profile/your-products'))
            <button type="submit" class="disabled-buy" disabled>Buy</button>
            @else
            <button type="submit">Buy</button>
            @endif
        </form>
    </div>
    @if (request()->routeIs('profile.your-products') && Auth::user()->id === $product->user_id)
        <form method="POST" class="product-card__delete" action="{{ route('delete.product', ['id' => $product->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
            </button>
        </form>
    @endif
</a>
