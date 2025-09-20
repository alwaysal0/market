@extends('layouts.app')

@section('title', 'Market - User Confirmation')
@section('content')
@vite('resources/css/user/user-confirmation.css')

<form method="POST" action="/user-confirmation/{{ $token }}" id="confirmation-main-cont">
    @csrf
    <p id="confirmation-main-cont-title">Confirmation Email</p>
    <p id="confirmation-main-cont-description">To confirm the current email: <span>{{ $user->email }}</span>. You should press the button below.</p>
    <button type="submit" id="confirmation-main-cont-hotlink">Continue</a>
</form>
@endsection