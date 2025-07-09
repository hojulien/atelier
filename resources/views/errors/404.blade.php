@extends('layouts.app')

@section('title', '404')

@section('content')
    <h1>you shouldn't be here.</h1>
    
    <img class="error-img" src="{{ asset('images/question-mark.gif') }}" alt="error 404">
@endsection