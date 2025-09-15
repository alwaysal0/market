@extends('layouts.app')

@section('title', 'Market - User Confirmation')
@section('content')
@vite('resources/css/user-confirmation.css')

<div id="confirmation-form-wrap">
    <p id="confirmation-form-title">Confirmation Email</p>
    <p id="confirmation-form-description">To confirm the current email:{{ $user->email }}. You should press the button below.</p>
    <a href="/user-confirmation/{{ $id }}">Confirm</a>
</div>
@endsection