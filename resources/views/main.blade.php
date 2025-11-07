@extends('layouts.app')

@section('title', 'Market - Main Page')

@section('content')
@vite('resources/css/main.css')

@include('modules.main.last-products')
@endsection