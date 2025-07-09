@extends('layouts.app')

@section('title', 'access denied')

@section('content')
    <h1>access denied. turn back.</h1>
    
    <img class="error-img" src="{{ asset('images/access-denied.jpg') }}" alt="error 403">
@endsection