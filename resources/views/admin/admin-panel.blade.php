@extends('layouts.app')
@section('title', 'Market - Admin Panel')
@section('content')
@vite('resources/css/admin/admin-panel.css')

<form method="POST" action="{{ route('admin.searchUser') }}">
    @csrf
    <input type="text" name="username" id="admin-search-input" required>
    <label for="admin-search-input">Username</label>
    <button type="submit">Search</button>
</form>

<div id="admin-view">
    <div id="admin-view-products">
        @forelse($products as $product)
            <a class="admin-product__card" href="{{ route('product', ['id' => $product->id]) }}">
                <img src="{{ $product->image_url }}" alt="product-image">
                <p class="admin-product__data"><span>Name:</span> {{ $product->name }}</p>
                <p class="admin-product__data"><span>Price:</span> {{ $product->price }}$</p>
                <p class="admin-product__data"><span>Description:</span> {{ $product->description }}$</p>
                <p class="admin-product__more">View more</p>
            </a>
            @empty
            Empty
            @endforelse
        </div>
        <div id="admin-view-logs">
            @forelse($logs as $log)
            <p>Log: {{ $log->id }}</p>
            <p>Name: {{ $log->log_name }}</p>
            <p><span>Properties:</span> {{ $log->properties }}$</p>
            <p>Description: {{ $log->description }}</p>
            <p>Date: {{ $log->created_at }}</p>
        @empty
            The user doesn't have logs.
        @endforelse
    </div>
</div>

@endsection