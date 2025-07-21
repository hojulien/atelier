@extends('layouts.app')

@section('title', 'add a new map')

@section('content')
    <h1>add a new map</h1>
    
    <form class="form m-auto g-10" method="POST" action="{{ route('maps.store') }}" enctype="multipart/form-data">
        @csrf

        @include('partials.mapForm', ['map' => null])

        <button type="submit" style="background-color:palegreen;">add map</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/mapsTags.js')
@endsection 