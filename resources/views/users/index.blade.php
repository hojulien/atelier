@extends('layouts.app')

@section('title', 'user list')

@section('content')
    <h1>user list</h1>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>avatar</th>
                <th>banner</th>
                <th>type</th>
                <th colspan="3">actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('users.profile', $user->id) }}">{{ $user->username }}</a></td>
                <td><img src="{{ asset('storage/images/avatars/' . $user->avatar) }}" alt="avatar" height="128" loading="lazy"></td>
                <td><img src="{{ asset('storage/images/banners/' . $user->banner) }}" alt="banner" height="128" loading="lazy"></td>
                <td>{{ $user->type }}</td>
                <td>
                    <a href="{{ route('users.profile', $user->id) }}">view</a>
                </td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}">edit</a>
                </td>
                <td>
                    <form action="{{ route('users.delete', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('delete this user account? all informations linked to it will be deleted as well!');" id="delete">delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection