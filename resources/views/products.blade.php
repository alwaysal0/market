@extends('layouts.app')

@section('title', 'Market - Products')
@section('content')
@vite('resources/css/products.css')

<p id="products-title">Products</p>
<div id="products-main-cont-wrap">
    <div id="products-filter-cont">
        <ul>
            <li>
                <a href="{{ '/products' }}">All</a>
            </li>
            @foreach ($filters as $filter)
                <li>
                    <a href="{{ url('/products/filter/' . $filter) }}">{{ $filter }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div id="products-main-cont">
        @foreach ($products as $product)
            @include('modules.profile.product-card', [
                'product' => $product,
            ])
        @endforeach
    </div>
</div>

@endsection