@extends('layouts.app')

@section('title', 'suggestion list')

@section('content')
    <h1>suggestion list</h1>

    <!-- for accessibility purposes, to remove later -->
    <a href="{{ route('suggestions.create') }}"><h2>send a suggestion</h2></a>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>type</th>
                <th>description</th>
                <th>media</th>
                <th>creator</th>
                <th colspan="2">actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suggestions as $suggestion)
            <tr>
                <td>{{ $suggestion->id }}</td>
                <td>{{ $suggestion->type }}</td>
                <td>{{ $suggestion->description }}</td>
                @if ($suggestion->type === "media")
                    <td><img src="{{ asset('storage/images/suggestions/' . $suggestion->media) }}" alt="suggestion media" height="128" loading="lazy"></td>
                @else
                    <td><a href="{{ $suggestion->media }}">{{ $suggestion->media }}</a></td>
                @endif
                <td>{{ $suggestion->user->username }}</td>
                <td>
                    <a href="{{ route('suggestions.show', $suggestion->id) }}">view</a>
                </td>
                <td>
                    <a href="{{ route('suggestions.edit', $suggestion->id) }}">edit</a>
                </td>
                 <td>
                    <form action="{{ route('suggestions.delete', $suggestion) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('delete this suggestion?');" id="delete">delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection