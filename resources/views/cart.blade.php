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
                                <form method="POST" action="{{ route('cart.update') }}">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" value=""><input>
                                    <svg class="qty-btn inc-btn" data-id="{{ $id }}" data-action="increase" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#303030"><path d="m280-400 200-200 200 200H280Z"/></svg>
                                    <svg class="qty-btn dec-btn" data-id="{{ $id }}" data-action="decrease" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#303030"><path d="M480-360 280-560h400L480-360Z"/></svg>
                                </form>
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
        const updateQuantity = async (id, action, displayElement) => {
            console.log(id);
            try {
                const response = await fetch("{{ route('cart.update') }}", {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id, action: action })
                })
                const data = await response.json();
                console.log(data);
                if (data.success) {
                    // Обновляем число в интерфейсе из ответа сервера
                    if (data.newQuantity == null) {
                        const row = displayElement.closest('.cart-product-card');
                        row.remove();
                        recalculateTotal();
                        checkIfEmptyCart();
                    } else {
                        displayElement.innerText = data.newQuantity;
                        recalculateTotal();
                    }
                }
            } catch (error) {
                console.error('Ошибка:', error);
            }
        };

        document.querySelectorAll('.qty-btn').forEach(button => {
            button.addEventListener('click', function() {
                console.log(button);
                const id = this.dataset.id;
                const action = this.dataset.action;
                const displayElement = this.closest('.quantity-control').querySelector('.qty-display');

                updateQuantity(id, action, displayElement);
            });
        });

        function recalculateTotal() {
            let total = 0;
            document.querySelectorAll('.cart-product-card').forEach(row => {
                const price = parseFloat(row.querySelector('.col-price').innerText);
                const qty = parseInt(row.querySelector('.qty-display').innerText);
                total += price * qty;
            });
            document.getElementById('final-price').innerText = total;
        }

        function checkIfEmptyCart() {
            const remainingProducts = document.querySelectorAll('.cart-product-card');
            if (remainingProducts.length === 0) {
                // Заменяем таблицу на сообщение о пустой корзине
                document.getElementById('cart-cont').innerHTML = `
                <p id="cart-empty__title">Empty Cart</p>
                <p id="cart-empty__description">Add new products to your cart and they will appear here.</p>
                `;
            }
        }
    });
</script>

@endsection
