@extends('layouts.app')

@section('title', 'send a suggestion')

@section('content')
    <div class="max-w-1000 m-auto p-20">
        <h1 class="title round-20">send a suggestion</h1>
    </div>
    
    <form class="form m-auto g-10 p-20" id="suggestionForm" method="POST" action="{{ route('suggestions.store') }}" enctype="multipart/form-data">
        @csrf

        @include('partials.suggestionForm', ['suggestion' => null])

        <button type="submit" class="button round-20 return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/edit.svg') }}" alt="create icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/edit_dark.svg') }}" alt="create icon dark mode">
            submit suggestion</button>
    </form>
@endsection

@section('scripts')
    <!-- suggestionType.js shows different fields based off type selection -->
    @vite(['resources/js/suggestionType.js', 'resources/js/forms/suggestion.js'])
@endsection