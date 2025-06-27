@extends('layouts.app')

@section('title', 'Suggestion List')

@section('content')
    <h1>hi</h1>

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
                <td>{{ $suggestion->media }}</td> <!-- TO DO: change depending on suggestion type -->
                <td>{{ $suggestion->user_id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection