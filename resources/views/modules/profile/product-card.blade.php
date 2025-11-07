<div class="product-card">
    <a href="{{ route('product', ['product' => $product]) }}">
        <img src="{{ $product->image_url }}" alt="">
        <p><span>Name:</span> {{ $product->name }}</p>
    </a>
    <p><span>ID:</span> {{ $product->id }}</p>
    <p class="product-card__description"><span>Description:</span> {{ $product->description }}</p>
    <div class="product-card__price-buy">
        <p><span>Price:</span>{{ $product->price }}$</p>
        <form method="POST" action="#">
            @if(request()->is('profile/your-products'))
                <button type="submit" class="disabled-buy" disabled>Buy</button>
            @else
                <button type="submit">Buy</button>
            @endif
        </form>
    </div>
    @if (request()->routeIs('profile.your-products') && Auth::user()->id === $product->user_id)
    <div class="product-card__actions">
        <form method="POST" class="product-card__delete" action="{{ route('profile.your-products.delete', ['id' => $product->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
            </button>
        </form>
        <a href="{{ route("profile.your-products.show", ['id' => $product->id]) }}" class="product-card__edit">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
        </a>
    </div>
    @endif
</div>
