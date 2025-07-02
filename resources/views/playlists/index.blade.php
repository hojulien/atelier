@extends('layouts.app')

@section('title', 'playlist List')

@section('content')
    <h1>hi</h1>

    <!-- for accessibility purposes, to remove later -->
    <a href="{{ route('playlists.create') }}"><h2>create a playlist</h2></a>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>number of levels</th>
                <th>description</th>
                <th>type</th>
                <th>user_id</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($playlists as $playlist)
            <tr>
                <td>{{ $playlist->id }}</td>
                <td>{{ $playlist->name }}</td>
                <td>{{ $playlist->number_levels }}</td>
                <td>{{ $playlist->description }}</td>
                <td>{{ $playlist->type }}</td>
                <td>{{ $playlist->user_id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection