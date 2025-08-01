@extends('layouts.app')

@section('title', 'suggestion list')

@section('content')
    <div class="max-w-1200 m-auto p-20">
        <h1 class="title round-20">suggestion list</h1>
    </div>

    <form class="form m-auto p-20 g-10" method="GET" action="{{ route('suggestions.index') }}">
        <!-- search options -->
        <select name="filter" id="filter">
            <option value="default">search by...</option>
            <option value="active" {{ request('filter') == 'active' ? 'selected' : '' }}>active suggestions</option>
            <option value="archived" {{ request('filter') == 'archived' ? 'selected' : '' }}>archived suggestions</option>
        </select>

        <input type="hidden" name="maps_per_page" value="{{ request('per_page', 10) }}">
        <br>

        <button type="submit" class="button round-20 return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/search.svg') }}" alt="search icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/search_dark.svg') }}" alt="search icon dark mode">
            <span>search</span>
        </button>
    </form>

    @php
        $isArchivedFilter = request('filter') === 'archived'; // rearranges table if showing archived suggestions
    @endphp

    <div class="table-container p-20">
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>type</th>
                    <th>description</th>
                    <th>media</th>
                    <th>submitted by</th>
                    <th colspan="{{ $isArchivedFilter ? 3 : 4 }}">actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $suggestion)
                <tr>
                    <td>{{ $suggestion->id }}</td>
                    <td>
                        @if ($suggestion->type === "media")
                            <img class="iconLight icon-32" src="{{ asset('images/icons/image.svg') }}" alt="image icon">
                            <img class="iconDark icon-32" src="{{ asset('images/icons/image_dark.svg') }}" alt="image icon darkmode">
                        @else
                            <img class="iconLight icon-32" src="{{ asset('images/icons/music.svg') }}" alt="music icon">
                            <img class="iconDark icon-32" src="{{ asset('images/icons/music_dark.svg') }}" alt="music icon darkmode">
                        @endif
                    </td>
                    <td>{{ $suggestion->description }}</td>
                    @if ($suggestion->type === "media")
                        <td><img src="{{ asset('storage/images/suggestions/' . $suggestion->media) }}" alt="suggestion media" loading="lazy"></td>
                    @else
                        <td><a href="{{ $suggestion->media }}">{{ $suggestion->media }}</a></td>
                    @endif
                    <td><a href="{{ route('users.profile', $suggestion->user->id) }}">{{ $suggestion->user->username }}</a></td>
                    <td>
                        <div class="flex flex-f-center g-10">

                            <a class="map-actions-card flex flex-f-center p-10 g-5 view no-link" href="{{ route('suggestions.show', $suggestion->id) }}">
                                <img class="iconLight icon-24" src="{{ asset('images/icons/view.svg') }}" alt="view icon">
                                <img class="iconDark icon-24" src="{{ asset('images/icons/view_dark.svg') }}" alt="view icon dark mode">
                                <span class="action">view</span>
                            </a>

                            <a class="map-actions-card flex flex-f-center p-10 g-5 edit no-link" href="{{ route('suggestions.edit', $suggestion->id) }}">
                                <img class="iconLight icon-24" src="{{ asset('images/icons/edit.svg') }}" alt="edit icon">
                                <img class="iconDark icon-24" src="{{ asset('images/icons/edit_dark.svg') }}" alt="edit icon dark mode">
                                <span class="action">edit</span>
                            </a>

                            @if($isArchivedFilter)
                                <form class="map-actions-card flex flex-f-center p-10 g-5 archive" action="{{ route('suggestions.restore', $suggestion->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="no-button flex flex-f-center g-5" onclick="return confirm('restore this suggestion to active?');">
                                        <img class="iconLight icon-24" src="{{ asset('images/icons/restore.svg') }}" alt="restore icon">
                                        <img class="iconDark icon-24" src="{{ asset('images/icons/restore_dark.svg') }}" alt="restore icon dark mode">
                                        <span class="action">restore</span>
                                    </button>
                                </form>
                            @else
                                <form class="map-actions-card flex flex-f-center p-10 g-5 archive" action="{{ route('suggestions.archive', $suggestion->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="no-button flex flex-f-center g-5" onclick="return confirm('archive this suggestion?');">
                                        <img class="iconLight icon-24" src="{{ asset('images/icons/archive.svg') }}" alt="archive icon">
                                        <img class="iconDark icon-24" src="{{ asset('images/icons/archive_dark.svg') }}" alt="archive icon dark mode">
                                        <span class="action">archive</span>
                                    </button>
                                </form>
                            @endif

                            <form class="map-actions-card flex flex-f-center p-10 g-5 delete" action="{{ route('suggestions.delete', $suggestion->id) }}" method="POST">
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