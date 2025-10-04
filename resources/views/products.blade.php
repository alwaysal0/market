@extends('layouts.app')

@section('title', 'Market - Products')
@section('content')
@vite('resources/css/products.css')
@vite('resources/css/modules/profile/product-card.css')

<p id="products-title">Products</p>
<div id="products-main-cont-wrap">
    <div id="products-filter-cont">
        <p id="products-filter-cont-title">Filters</p>
        <ul>
            <li>
                <a href="{{ '/products' }}">All</a>
            </li>
            @foreach ($filters as $filter)
                <li>
                    <a class="products-filter-cont-filters" href="{{ url('/products/filter/' . $filter) }}">{{ $filter }}</a>
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

<script>
    function toTitleCase(str) {
        return str.replace(
            /\w\S*/g,
            text => text.charAt(0).toUpperCase() + text.substring(1).toLowerCase()
        );
    }
    document.addEventListener('DOMContentLoaded', function () {
        let filters = document.getElementsByClassName('products-filter-cont-filters');
        let filtersArray = Array.from(filters);
        filtersArray.forEach(filter => {
            filter.textContent = toTitleCase(filter.textContent);
        });
    });
</script>

@endsection