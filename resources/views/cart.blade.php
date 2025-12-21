@extends('layouts.app')
@vite('resources/css/cart.css')
@section('title', 'Market - cart')
@section('content')

@if(session('cart'))
    <table id="cart-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>

        <tbody>
            @foreach(session('cart') as $id => $product)
                <tr class="cart-product-card" id="{{ $id }}">
                    <td class="col-image"><img src="{{ $product['image'] }}" alt="image-{{ $id }}"></td>
                    <td class="col-name">{{ $product['name'] }}</td>
                    <td class="col-price">{{ $product['price'] }}</td>
                    <td class="col-quantity">{{ $product['quantity'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">Total price:<span id="final-price">0</span></td>
            </tr>
        </tbody>
    </table>
@else
    Empty cart.
@endif
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const FINAL_FIELD = document.getElementById('final-price');
        let products = document.querySelectorAll('.cart-product-card');
        let final_cost = 0;
        products.forEach(product => {
            final_cost += parseInt(product.querySelector(".col-price").innerText);
        })

        FINAL_FIELD.innerHTML = final_cost;
    })
</script>
@endsection
