@extends('layouts.app')
@section('title', 'Market - Support Page')
@section('content')
@vite('resources/css/support.css')

    <p class="support-title" id="support-main-title">Support</p>
    <ul id="support-list">
        <li><span>About us:</span> Test Message</li>
        <li><span>Support email:</span> <a href="mailto:supportemailr@gmail.com">supportemail@gmail.com</a></li>
        <li><span>Hotline:</span> +380666666666</li>
    </ul>
    <p class="support-title">Report Form</p>
    <form id="support-report-form" method="POST" action="{{ route('support.send') }}">
        @csrf

        <input type="hidden" name="user_id" value="@auth {{ $user->id }} @endauth">
        <div class="support-report-form-input">
            <input type="text" id="support-report__name" name="name" value="@auth {{ $user->username }} @endauth" placeholder=" " required>
            <label for="support-report__name">Ваше имя</label>
        </div>


        <div class="support-report-form-input">
            <textarea name="content" id="support-report__content" placeholder=" " required>{{ old('message') }}</textarea>
            <label for="support-report__content">Сообщение</label>
        </div>

        <button type="submit">Отправить</button>
    </form>
@endsection
