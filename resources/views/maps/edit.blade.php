@extends('layouts.app')

@section('title', 'update map')

@section('content')
    <div class="title-container p-20">
        <h1 class="title">update map</h1>
    </div>
    
    <form class="form m-auto g-10" method="POST" action="{{ route('maps.update', $map) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        @include('partials.mapForm', ['map' => $map])

        <button type="submit" class="button return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/update.svg') }}" alt="update icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/update_dark.svg') }}" alt="update icon dark mode">
            update map</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/mapsTags.js')
@endsection 
