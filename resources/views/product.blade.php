@extends('layouts.app')

@section('title')
    Market - {{ $product->name }}
@endsection

@section('content')
@vite('resources/css/product.css')

<a href="{{ url()->previous() }}" id="product-back"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#2563eb"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>Back</a>
<p id="product-title">Product {{ $product->id }} | {{ $product->name }}</p>
<div id="product-cont">
    <img src="{{ $product->image_url }}" alt="product_image">
    <form method="POST" action="{{ $admin ? route('admin.editProduct') : '#' }}" id="product-cont-form">
        <p class="product-info"><span>ID:</span> {{ $product->id }}</p>
        @if ($admin)
            <input type="text" name="name" required>
            <input type="text" name="description">
            <!-- ДОДЕЛАТЬ -->
        @else
            <p class="product-info"><span>Name:</span> {{ $product->name }}</p>
            <p class="product-info"><span>Description:</span> {{ $product->description }}</p>
        @endif
        <div id="product-filters">
            <p id="product-filters-title">Filters:</p>
            @foreach ($filters as $filter)
                <div>
                    <p class="product-tags {{ $filter->filter_name }}">{{ $filter->filter_name }}</p>
                </div>
            @endforeach
        </div>
        <p id="product-price"><span>Price:</span> {{ $product->price }}$</p>
        <div id="product-input-cont-wrap">
            @if(isset($user))
                <div class="product-input-cont">
                    <input name="email" type="text" value="{{ $user->email }}" placeholder="" disabled>
                    <label>Email</label>
                </div>
                @else
                <div class="product-input-cont">
                    <input name="email" type="text" placeholder="">
                    <label>Email</label>
                </div>
            @endif
            @include('modules.input.selectCountries')
            <div class="product-input-cont">
                <input name="address" type="text" placeholder="">
                <label>Full Address</label>
            </div>
        </div>
        <button type="submit">{{ $admin ? "Update" : "Add to card" }}</button>
        <p id="product-remark">When you click this button, the product will appear and be available in your shopping cart.</p>
    </form>
</div>
@include('modules.product.same-products')
@include('modules.product.reviews')
@endsection
