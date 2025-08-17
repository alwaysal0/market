@extends('layouts.app')

@section('title', 'Register')

@section('content')
@vite('resources/css/login.css')
    <p id="login-title">Login</p>
    <form method="POST" action="/login-auth" id="login-form">
        @csrf
        <div class="login-form-input-cont">
            <input type="text" name="username" placeholder=" " required>
            <label for="username">Username</label>
        </div>
        <div class="login-form-input-cont">
            <input type="password" name="password" placeholder=" " required>
            <label for="password">Password</label>
        </div>
        <button type="submit">Submit</button>
    </form>
    <p id="login-register-hotlink">Don't have account? <a href="/register">Register</a></p>
<script>
    
</script>
@endsection