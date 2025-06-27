@extends('layouts.app')

@section('title', 'User List')

@section('content')
    <h1>hi</h1>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>avatar</th>
                <th>banner</th>
                <th>type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td><img src="{{ $user->avatarPath }}" alt="Avatar" height="128"></td>
                <td><img src="{{ $user->bannerPath }}" alt="Banner" height="128"></td>
                <td>{{ $user->type }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection