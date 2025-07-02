@extends('layouts.app')

@section('title', 'create a new playlist')

@section('content')
    <!-- evolution: separate forms in a partial -->
    <h1>create a new playlist</h1>
    
    <form method="POST" action="{{ route('playlists.store') }}">
        @csrf

        <label for="name">name</label>
        <input type="text" name="name">

        <label for="description">description</label>
        <textarea name="description"></textarea>

        <!-- evolution: after middlewares have been set, hide this field -->
        <label for="user_id">user id</label>
        <select name="user_id">
            <option value="">(select user id)</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->username }}</option>
            @endforeach
        </select>

        <button type="submit" style="background-color:palegreen;">create playlist</button>
    </form>
@endsection