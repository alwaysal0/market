@vite('resources/css/modules/profile/product-card.css')

<div class="profile-right-cont-product-card">
    <img src="{{ $product->image_url }}" alt="">
    <p><span>ID:</span> {{ $product->id }}</p>
    <p><span>Name:</span> {{ $product->name }}</p>
    <p class="description"><span>Description:</span> {{ $product->description }}</p>
</div>