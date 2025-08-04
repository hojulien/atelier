@extends('layouts.app')

@section('title', 'map informations')

@section('content')
    <div class="max-w-1200 m-auto p-20">
        <h1 class="title round-20">map informations</h1>
    </div>

    <div class="details-bg round-20 max-w-1200 m-auto p-20">
        <img class="round-20" src="{{ asset('storage/images/maps_background/' . $map->background) }}" alt="background">
    </div>

    <div class="max-w-1200 m-auto flex flex-col flex-f-center p-20 g-10">
        <div class="details-data flex g-20">
            <div class="details-key button round-20 flex flex-f-center g-5 m-auto">
                <img class="iconLight icon-32" src="{{ asset('images/icons/artist.svg') }}" alt="artist icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/artist_dark.svg') }}" alt="artist icon darkmode">
                <span class="bold">artist</span>
            </div>
            <div class="details-value button round-20 flex flex-f-center">
                <span>{{ $map->artist }}</span>
            </div>
        </div>

        <div class="details-data flex g-20">
            <div class="details-key button round-20 flex flex-f-center g-5 m-auto">
                <img class="iconLight icon-32" src="{{ asset('images/icons/title.svg') }}" alt="title icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/title_dark.svg') }}" alt="title icon darkmode">
                <span class="bold">title</span>
            </div>
            <div class="details-value button round-20 flex flex-f-center">
                <span>{{ $map->title }}</span>
            </div>
        </div>

        <div class="details-data flex g-20">
            <div class="details-key button round-20 flex flex-f-center g-5 m-auto">
                <img class="iconLight icon-32" src="{{ asset('images/icons/user.svg') }}" alt="user icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/user_dark.svg') }}" alt="user icon darkmode">
                <span class="bold">creator</span>
            </div>
            <div class="details-value button round-20 flex flex-f-center">
                <span>{{ $map->creator }}</span>
            </div>
        </div>

        <div class="details-data flex g-20">
            <div class="details-key button round-20 flex flex-f-center g-5 m-auto">
                <img class="iconLight icon-32" src="{{ asset('images/icons/length.svg') }}" alt="length icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/length_dark.svg') }}" alt="length icon darkmode">
                <span class="bold">length</span>
            </div>
            <div class="details-value button round-20 flex flex-f-center">
                <span>{{ gmdate('i:s', $map->length) }}</span>
            </div>
        </div>

        <div class="details-data flex g-20">
            <div class="details-key button round-20 flex flex-f-center g-5 m-auto">
                <img class="iconLight icon-32" src="{{ asset('images/icons/star.svg') }}" alt="star icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/star_dark.svg') }}" alt="star icon darkmode">
                <span class="bold">star rating</span>
            </div>
            <div class="details-value button round-20 flex flex-f-center">
                <span>{{ number_format(ceil($map->sr * 100) / 100, 2) }}★</span>
            </div>
        </div>

        <div class="details-data flex g-20">
            <div class="details-key button round-20 flex flex-f-center g-5 m-auto">
                <img class="iconLight icon-32" src="{{ asset('images/icons/settings.svg') }}" alt="settings icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/settings_dark.svg') }}" alt="settings icon darkmode">
                <span class="bold">settings</span>
            </div>
            <div class="details-value settings button round-20 flex flex-f-center g-10">
                <div class="button-mini round-10 flex flex-f-center" id="cs">
                    <span>
                        CS {{ trim_float($map->cs) }}
                    </span>
                </div>
                <div class="button-mini round-10 flex flex-f-center" id="hp">
                    <span>
                        HP {{ trim_float($map->hp) }}
                    </span>
                </div>
                <div class="button-mini round-10 flex flex-f-center" id="ar">
                    <span>
                        AR {{ trim_float($map->ar) }}
                    </span>
                </div>
                <div class="button-mini round-10 flex flex-f-center" id="od">
                    <span>
                        OD {{ trim_float($map->od) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="details-data flex g-20">
            <div class="details-key button round-20 flex flex-f-center g-5 m-auto">
                <img class="iconLight icon-32" src="{{ asset('images/icons/calendar.svg') }}" alt="calendar icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/calendar_dark.svg') }}" alt="calendar icon darkmode">
                <span class="bold">submit date</span>
            </div>
            <div class="details-value button round-20 flex flex-f-center">
                <span>{{ $map->submitDate }}</span>
            </div>
        </div>

        <div class="details-data flex g-20">
            <div class="details-key button round-20 flex flex-f-center g-5 m-auto">
                <img class="iconLight icon-32" src="{{ asset('images/icons/update.svg') }}" alt="update icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/update_dark.svg') }}" alt="update icon darkmode">
                <span class="bold">last updated</span>
            </div>
            <div class="details-value button round-20 flex flex-f-center">
                <span>{{ $map->lastUpdated }}</span>
            </div>
        </div>

        <div class="details-data flex g-20">
            <div class="details-key button round-20 flex flex-f-center g-5 m-auto">
                <img class="iconLight icon-32" src="{{ asset('images/icons/tags.svg') }}" alt="tags icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/tags_dark.svg') }}" alt="tags icon darkmode">
                <span class="bold">tags</span>
            </div>
            <div class="details-value button round-20 flex flex-f-center">
                <span>@foreach ($map->tags as $tag) {{ $tag }} @endforeach</span>
            </div>
        </div>
    </div>

    <div class="details-data flex flex-f-center g-20">
        @if (Auth::check() && Auth::user()->type === 'admin')
            <a id="edit" class="button round-20 p-10 no-link bold edit flex flex-f-center g-5" href="{{ route('maps.edit', $map->id) }}">
                <img class="iconLight icon-24" src="{{ asset('images/icons/edit.svg') }}" alt="edit icon">
                <img class="iconDark icon-24" src="{{ asset('images/icons/edit_dark.svg') }}" alt="edit icon dark mode">
                edit map
            </a>
            <form class="button round-20 p-10 delete" action="{{ route('maps.delete', $map) }}" method="POST">
                @csrf
                @method('DELETE')
                <button 
                    onclick="return confirm('delete this map? it will also be removed from associated playlists!');" 
                    id="delete"
                    class="no-button bold flex flex-f-center g-5">
                    <img class="iconLight icon-24" src="{{ asset('images/icons/delete.svg') }}" alt="delete icon">
                    <img class="iconDark icon-24" src="{{ asset('images/icons/delete_dark.svg') }}" alt="delete icon dark mode">
                    delete map
                </button>
            </form>
        @endif
        <a href="{{ route('maps.index') }}" class="no-link button round-20 return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/return.svg') }}" alt="return icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/return_dark.svg') }}" alt="return icon dark mode">
            back to map list
        </a>
    </div>
    
@endsection