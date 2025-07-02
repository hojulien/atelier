@extends('layouts.app')

@section('title', 'user list')

@section('content')
    <h1>hi</h1>

    <!-- for accessibility purposes, to remove later -->
    <a href="{{ route('users.create') }}"><h2>create new user</h2></a>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>avatar</th>
                <th>banner</th>
                <th>type</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td><img src="{{ asset('storage/images/avatars/' . $user->avatar) }}" alt="Avatar" height="128" loading="lazy"></td>
                <td><img src="{{ asset('storage/images/banners/' . $user->banner) }}" alt="Banner" height="128" loading="lazy"></td>
                <td>{{ $user->type }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}">edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection