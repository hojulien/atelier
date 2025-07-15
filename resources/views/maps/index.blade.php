@extends('layouts.app')

@section('title', 'map list')

@section('content')
    <h1>map list</h1>

    <!-- for accessibility purposes, to remove later -->
    @if (Auth::check() && Auth::user()->type === 'admin')
        <a href="{{ route('maps.create') }}"><h2>add new map</h2></a> <br>
        <label for="admin-actions">dev mode</label>
        <input type="checkbox" name="admin-actions" id="admin-actions">
    @endif

    <!-- TO DO: replace by artistunicode/titleunicode with a js script -->
    @include('partials.mapList', ['maps' => $maps, 'devMode' => true])
@endsection

@section('scripts')
    @vite('resources/js/devModeMap.js')
@endsection 