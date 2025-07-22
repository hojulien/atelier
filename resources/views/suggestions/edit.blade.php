@extends('layouts.app')

@section('title', 'update suggestion')

@section('content')
    <h1>update suggestion</h1>
    
    <form class="form m-auto g-10" id="suggestionForm" method="POST" action="{{ route('suggestions.update', $suggestion) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('partials.suggestionForm', ['suggestion' => $suggestion])

        <button type="submit" class="button return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/update.svg') }}" alt="update icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/update_dark.svg') }}" alt="update icon dark mode">
            update suggestion</button>
    </form>
@endsection

@section('scripts')
    <!-- shows different fields based off type selection -->
    @vite(['resources/js/suggestionType.js', 'resources/js/forms/suggestion.js'])
@endsection