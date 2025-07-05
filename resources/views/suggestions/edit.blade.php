@extends('layouts.app')

@section('title', 'update suggestion')

@section('content')
    <h1>update suggestion</h1>
    
    <form method="POST" action="{{ route('suggestions.update', $suggestion) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('partials.suggestionForm', ['suggestion' => $suggestion])

        <button type="submit" style="background-color:palegreen;">update suggestion</button>
    </form>
@endsection

@section('scripts')
    <!-- shows different fields based off type selection -->
    @vite('resources/js/suggestionType.js')
@endsection