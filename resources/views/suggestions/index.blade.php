@extends('layouts.app')

@section('title', 'suggestion List')

@section('content')
    <h1>hi</h1>

    <!-- for accessibility purposes, to remove later -->
    <a href="{{ route('suggestions.create') }}"><h2>send a suggestion</h2></a>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>type</th>
                <th>description</th>
                <th>media</th>
                <th>user_id</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suggestions as $suggestion)
            <tr>
                <td>{{ $suggestion->id }}</td>
                <td>{{ $suggestion->type }}</td>
                <td>{{ $suggestion->description }}</td>
                @if ($suggestion->type == "media")
                    <td><img src="{{ asset('storage/images/suggestions/' . $suggestion->media) }}" alt="suggestion media" height="128" loading="lazy"></td>
                @else
                    <td><a href="{{ $suggestion->media }}">{{ $suggestion->media }}</a></td>
                @endif
                <td>{{ $suggestion->user_id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection