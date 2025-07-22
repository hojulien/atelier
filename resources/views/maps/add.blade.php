@extends('layouts.app')

@section('title', 'add a new map')

@section('content')
    <div class="title-container p-20">
        <h1 class="title">add a new map</h1>
    </div>
    
    <form class="form m-auto g-10" method="POST" action="{{ route('maps.store') }}" enctype="multipart/form-data">
        @csrf

        @include('partials.mapForm', ['map' => null])

        <button type="submit" class="button return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/edit.svg') }}" alt="create icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/edit_dark.svg') }}" alt="create icon dark mode">
            add map</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/mapsTags.js')
@endsection 