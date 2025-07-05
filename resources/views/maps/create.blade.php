@extends('layouts.app')

@section('title', 'add a new map')

@section('content')
    <h1>add a new map</h1>
    
    <form method="POST" action="{{ route('maps.store') }}" enctype="multipart/form-data">
        @csrf

        @include('partials.mapForm', ['map' => null])

        <button type="submit" style="background-color:palegreen;">add map</button>
    </form>
@endsection

<!-- TO DO LATER
@section('scripts')
    @vite('resources/js/mapsTags.js')
@endsection 
-->