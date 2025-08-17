<!-- resources/views/register.blade.php -->
@extends('layouts.app')

@section('title', 'Register')

@section('content')
@vite('resources/css/register.css')

    <p id="register-title">Registration</p>
    <form method="POST" action="/register-auth" id="register-form">
        @csrf
        <div class="register-form-input-cont">
            <input type="text" name="username" placeholder=" " required>
            <label for="usrname">Username</label>
        </div>
        <div class="register-form-input-cont">
            <input type="email" name="email" placeholder=" " required>
            <label for="email">Email</label>
        </div>
        <div class="register-form-input-cont">
            <input type="password" name="password" placeholder=" " required>
            <label for="password">Password</label>
        </div>
        <div class="register-form-input-cont">
            <input type="password" name="password_confirmation" placeholder=" " required>
            <label for="password_confirmation">Repeat the Password</label>
        </div>
        <button type="submit">Submit</button>
    </form>
    <p id="register-login-hotlink">Already have account? <a href="/login">Login</a></p>
@endsection