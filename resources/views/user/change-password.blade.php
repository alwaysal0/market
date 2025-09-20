@extends('layouts.app')

@section('title', 'Market - Change Password')
@vite('resources/css/user/change-password.css')
@section('content')
@if($change_password_access === true)
    <p id="change-password-title">Change Password</p>
    <p id="change-password-description">Write your new password and confirmed it.</p>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="change-password-cont">
            <input type="password" name="password" placeholder=" ">
            <label for="password">Password</label>
        </div>
        <div class="change-password-cont">
            <input type="password" name="password_confirmation" placeholder=" ">
            <label for="password_confirmation">Password Confirmation</label>
        </div>
        <button type="submit">Submit</button>
    </form>
@else
    <p id="change-password-title">Change Password</p>
    <p id="change-password-description">We have sent a letter with the code to your email.</p>
    <form method="POST" action="{{ route('password.code') }}">
        @csrf
        <div class="change-password-cont">
            <input type="text" name="code" placeholder=" ">
            <label>Code</label>
        </div>
        <button type="submit">Submit</button>
    </form>
@endif
@endsection