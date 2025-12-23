@extends('layouts.app')
@vite('resources/css/cart.css')
@section('title', 'Market - cart')
@section('content')

<div id="cart-cont">
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
                    <td class="col-price">{{ $product['price'] }}$</td>
                    <td class="col-quantity">
                        <div class="quantity-control">
                            <span class="qty-display">{{ $product['quantity'] }}</span>
                            <div class="qty-buttons">
                                <a href="{{ route('cart.increase', ['id_product' => $product['id_product']]) }}" class="btn-qty increase">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#303030"><path d="m280-400 200-200 200 200H280Z"/></svg>
                                </a>
                                <a href="{{ route('cart.decrease', ['id_product' => $product['id_product']]) }}" class="btn-qty decrease">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#303030"><path d="M480-360 280-560h400L480-360Z"/></svg>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">Total price: <span id="final-price">0</span>$</td>
            </tr>
        </tbody>
    </table>
    <form action="#">
        <button type="submit" id="cart-to-order__button">To Order</button>
    </form>
@else
    <p id="cart-empty__title">Empty Cart</p>
    <p id="cart-empty__description">Add new products to your cart and they will appear here.</p>
@endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const FINAL_FIELD = document.getElementById('final-price');
        let products = document.querySelectorAll('.cart-product-card');
        let final_cost = 0;
        products.forEach(product => {
            let current_price = parseInt(product.querySelector('.col-price').innerText);
            let current_quantity = parseInt(product.querySelector('.qty-display').innerText);
            final_cost += current_price * current_quantity;
        })

        FINAL_FIELD.innerHTML = final_cost;
    })
</script>

@endsection
