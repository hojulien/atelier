@extends('layouts.app')

@section('title', 'add a new map')

@section('content')
    <!-- evolution: separate forms in a partial -->
    <h1>add a new map</h1>
    
    <form method="POST" action="{{ route('maps.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- laravel handles rules well enough, but we'll add an extra spice on top with input -->

        <label for="artist">artist</label>
        <input type="text" name="artist" max="40">

        <label for="title">title</label>
        <input type="text" name="title" max="80">

        <label for="artistUnicode">artist (unicode)</label>
        <input type="text" name="artistUnicode" max="25">

        <label for="titleUnicode">title (unicode)</label>
        <input type="text" name="titleUnicode" max="50">

        <label for="rc">theme</label>
        <input type="text" name="rc" max="20">

        <label for="creator">creator</label>
        <input type="text" name="creator" max="20">

        <!-- map metadata -->

        <label for="sr">star rating</label>
        <input type="number" name="sr" min="0" step="0.01" value="4.00">

        <label for="length">length (seconds)</label>
        <input type="number" name="length" min="0" step="1">


        <label for="cs">circle size</label>
        <input type="number" name="cs" min="0" max="10" step="0.1" value="5">

        <label for="hp">hp drain</label>
        <input type="number" name="hp" min="0" max="10" step="0.1" value="5">

        <label for="ar">approach rate</label>
        <input type="number" name="ar" min="0" max="10" step="0.1" value="5">

        <label for="od">overall difficulty</label>
        <input type="number" name="od" min="0" max="10" step="0.1" value="5">

        <label for="setId">set id</label>
        <input type="number" name="setId" min="0">
        
        <label for="mapId">map id</label>
        <input type="number" name="mapId" min="0">

        <label for="submitDate">submit date</label>
        <input type="datetime-local" name="submitDate" step="1">

        <label for="lastUpdated">last updated</label>
        <input type="datetime-local" name="lastUpdated" step="1">

        <!-- TO DO LATER: TAGS -->
         
        <label for="background">background</label>
        <input type="file" name="background">

        <button type="submit" style="background-color:palegreen;">add map</button>
    </form>
@endsection

<!-- TO DO LATER
@section('scripts')
    @vite('resources/js/mapsTags.js')
@endsection 
-->