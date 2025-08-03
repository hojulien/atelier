@extends('layouts.app')

@section('title', 'add a new map')

@section('content')
    <div class="max-w-1000 m-auto p-20">
        <h1 class="title round-20">add a new map</h1>
    </div>
    
    <form class="form m-auto g-10 p-20" id="mapForm" method="POST" action="{{ route('maps.store') }}" enctype="multipart/form-data">
        @csrf

        @include('partials.mapForm', ['map' => null])

        <button type="submit" class="button round-20 w-full max-w-300 return bold flex flex-f-center p-10  g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/edit.svg') }}" alt="create icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/edit_dark.svg') }}" alt="create icon dark mode">
            add map</button>
    </form>
@endsection

@section('scripts')
    @vite(['resources/js/mapsTags.js', 'resources/js/forms/map.js'])
@endsection 