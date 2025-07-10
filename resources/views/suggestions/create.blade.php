@extends('layouts.app')

@section('title', 'send a suggestion')

@section('content')
    <h1>send a suggestion</h1>
    
    <form id="suggestionForm" method="POST" action="{{ route('suggestions.store') }}" enctype="multipart/form-data">
        @csrf

        @include('partials.suggestionForm', ['suggestion' => null])

        <button type="submit" style="background-color:palegreen;">submit suggestion</button>
    </form>
@endsection

@section('scripts')
    <!-- suggestionType.js shows different fields based off type selection -->
    @vite(['resources/js/suggestionType.js', 'resources/js/forms/suggestion.js'])
@endsection