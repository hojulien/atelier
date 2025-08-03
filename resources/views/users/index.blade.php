@extends('layouts.app')

@section('title', 'user list')

@section('content')
    <div class="max-w-1200 m-auto p-20">
        <h1 class="title round-20">user list</h1>
    </div>

    <div class="table-container m-auto p-20">
        <table class="w-full">
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
                    <td><img id="avatar" src="{{ asset('storage/images/avatars/' . $user->avatar) }}" alt="avatar" loading="lazy"></td>
                    <td><img id="banner" class="w-full" src="{{ asset('storage/images/banners/' . $user->banner) }}" alt="banner" loading="lazy"></td>
                    <td>{{ $user->type }}</td>
                    <td>
                        <div class="flex flex-f-center g-10">
                            <a class="map-actions-card flex flex-f-center p-10 g-5 view no-link" href="{{ route('users.profile', $user->id) }}">
                                <img class="iconLight icon-24" src="{{ asset('images/icons/view.svg') }}" alt="view icon">
                                <img class="iconDark icon-24" src="{{ asset('images/icons/view_dark.svg') }}" alt="view icon dark mode">
                                <span class="action">view</span>
                            </a>

                            <a class="map-actions-card flex flex-f-center p-10 g-5 edit no-link" href="{{ route('users.edit', $user->id) }}">
                                <img class="iconLight icon-24" src="{{ asset('images/icons/edit.svg') }}" alt="edit icon">
                                <img class="iconDark icon-24" src="{{ asset('images/icons/edit_dark.svg') }}" alt="edit icon dark mode">
                                <span class="action">edit</span>
                            </a>

                            <form class="map-actions-card flex flex-f-center p-10 g-5 delete" action="{{ route('users.delete', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="no-button flex flex-f-center g-5" onclick="return confirm('delete this suggestion? it cannot be recovered!');">
                                    <img class="iconLight icon-24" src="{{ asset('images/icons/delete.svg') }}" alt="delete icon">
                                    <img class="iconDark icon-24" src="{{ asset('images/icons/delete_dark.svg') }}" alt="delete icon dark mode">
                                    <span class="action">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection