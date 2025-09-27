@extends('layouts.app')
@section('title', 'Market - Support Page')
@section('content')
@vite('resources/css/support.css')
    
    <p class="support-title">Support</p>
    <ul id="support-list">
        <li><span>About us:</span> Test Message</li>
        <li><span>Support email:</span> <a href="mailto:supportemailr@gmail.com">supportemail@gmail.com</a></li>
        <li><span>Hot line:</span> +380666666666</li>
    </ul>
    <p class="support-title">Feedback Form</p>
    <form id="support-feedback-form" method="POST" action="{{ route('support.send') }}">
        @csrf

        <div class="support-feedback-form-input">
            <input type="text" name="name" value="{{ old('name') }}" placeholder=" " required>
            <label for="name" value=""">Ваше имя</label>
        </div>

        <div class="support-feedback-form-input">
            <input type="email" name="email" value="{{ old('email') }}" placeholder=" " required>
            <label for="email">Ваш email</label>
        </div>

        <div class="support-feedback-form-input">
            <textarea name="message" placeholder=" " required>{{ old('message') }}</textarea>
            <label for="message">Сообщение</label>
        </div>

        <button type="submit">Отправить</button>
    </form>
@endsection