@extends('layouts.app')
@section('title', 'Market - Admin Panel')
@section('content')
@vite('resources/css/admin/admin-panel.css')

<div id="admin-user">
    <form id="admin-user__search" method="POST" action="{{ route("admin.searchUser") }}">
        @csrf
        <div class="admin-user-search__input">
            <input type="text" name="username" class="admin-user-search__input" placeholder="" value="{{ old('username') }}" required>
            <label for="admin-user-search__input">Username</label>

        </div>
        <button type="submit">Search</button>
    </form>
    @if(isset($user))
        <form id="admin-user__data" method="POST" action="{{ route("admin.updateUser", ['id' => $user->id]) }}">
            @csrf
            @method('PUT')
            <div class="admin-user-search__input">
                <input type="text" name="username" class="admin-search__input" placeholder="" value="{{ $user->username }}" required>
                <label for="admin-search-input">Username</label>
            </div>
            <div class="admin-user-search__input">
                <input type="email" name="email" class="admin-search__input" placeholder="" value="{{ $user->email }}" required>
                <label for="admin-search-input">Email</label>
            </div>
            <div class="admin-user-search__input">
                <input type="password" name="password" class="admin-search__input" placeholder="">
                <label for="admin-search__input">Password(Not Required)</label>
            </div>
            <button type="submit">Update</button>
        </form>
    @endif
</div>

<div id="admin-view">
    <div id="admin-view-products">
        @forelse($products as $product)
            <div class="admin-product__card">
                <img src="{{ $product->image_url }}" alt="product-image">
                <p class="admin-product__data"><span>ID:</span> {{ $product->id }}</p>
                <p class="admin-product__data"><span>Name:</span> {{ $product->name }}</p>
                <p class="admin-product__data"><span>Price:</span> {{ $product->price }}$</p>
                <p class="admin-product__data"><span>Description:</span> {{ $product->description }}$</p>
                <a class="admin-product__more" href="{{ route('product', ['id' => $product->id]) }}">View more</a>
                <div class="admin-product__options">
                    <form method="POST" class="admin-product__delete" action="{{ route('admin.deleteProduct', ['id' => $product->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                        </button>
                    </form>
                    <a href="{{ route('admin.showProduct', ['id' => $product->id]) }}" class="admin-product__edit-button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                    </a>
                </div>
            </div>
        @empty
            <div id="admin-no-product">
                <p>There are no suitable information at the moment.</p>
                <p>Select another user.</p>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5a5a5a"><path d="M620-520q25 0 42.5-17.5T680-580q0-25-17.5-42.5T620-640q-25 0-42.5 17.5T560-580q0 25 17.5 42.5T620-520Zm-280 0q25 0 42.5-17.5T400-580q0-25-17.5-42.5T340-640q-25 0-42.5 17.5T280-580q0 25 17.5 42.5T340-520Zm140 100q-68 0-123.5 38.5T276-280h66q22-37 58.5-58.5T480-360q43 0 79.5 21.5T618-280h66q-25-63-80.5-101.5T480-420Zm0 340q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Z"/></svg>
                </div>
        @endforelse
    </div>
        <div id="admin-view-logs">
            @forelse($logs as $log)
                <p><span>Log:</span> {{ $log->id }}</p>
                <p><span>Name:</span> {{ $log->log_name }}</p>
                <p><span>Description:</span> {{ $log->description }}</p>
                <p><span>Date:</span> {{ $log->created_at }}</p>
            @empty
            @endforelse
    </div>
</div>


@endsection
