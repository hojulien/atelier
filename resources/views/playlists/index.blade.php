@extends('layouts.app')

@section('title', 'playlist list')

@section('content')
    <h1>playlist list</h1>

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
                <th>creator</th>
                <th colspan="2">actions</th>
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
                <td>{{ $playlist->user->username }}</td>
                <td>
                    <a href="{{ route('playlists.show', $playlist->id) }}">view</a>
                </td>
                <td>
                    <a href="{{ route('playlists.edit', $playlist->id) }}">edit</a>
                </td>
                <td>
                    <form action="{{ route('playlists.delete', $playlist) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('delete this playlist?');" id="delete">delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection