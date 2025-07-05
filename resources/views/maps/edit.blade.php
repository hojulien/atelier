@extends('layouts.app')

@section('title', 'update map')

@section('content')
    <h1>update map</h1>
    
    <form method="POST" action="{{ route('maps.update', $map) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        @include('partials.mapForm', ['map' => $map])

        <button type="submit" style="background-color:palegreen;">update map</button>
    </form>
@endsection

<!-- TO DO LATER
@section('scripts')
    @vite('resources/js/mapsTags.js')
@endsection 
-->