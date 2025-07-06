@extends('layouts.app')

@section('title', 'suggestion informations')

@section('content')
    <!-- div will be filled up with css later -->
    
    <h1>view suggestion n°{{ $suggestion->id }}</h1>

    <div>
        <div>
            <div class="key">description</div>
            <div>{{ $suggestion->description }}</div>
        </div>
        <div>
            <div class="key">media</div>
            @if ($suggestion->type === "media")
                <div><img height="300" src="{{ asset('storage/images/suggestions/' . $suggestion->media) }}" alt="suggestion media"></div>
            @else
                <div><a href="{{ $suggestion->media }}">{{ $suggestion->media }}</a></div>
            @endif
        </div>
        <div>
            <div class="key">submitted by <span class="value">{{ $suggestion->user->username }} </span></div>
        </div>
        <div>
            <a id="edit" href="{{ route('suggestions.edit', $suggestion->id) }}">edit suggestion</a>
            <form action="{{ route('suggestions.delete', $suggestion) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('delete this suggestion?');" id="delete">delete suggestion</button>
            </form>
        </div>
    </div>
    <button class="return"><a href="{{ route('suggestions.index') }}" >back to suggestion list</a></button>
    
@endsection