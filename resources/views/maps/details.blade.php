@extends('layouts.app')

@section('title', 'map informations')

@section('content')
    <h1>map informations</h1>

    <div>
        <div>
            <div class="key">artist</div>
            <div>{{ $map->artist }}</div>
        </div>
        <div>
            <div class="key">title</div>
            <div>{{ $map->title }}</div>
        </div>
        <div>
            <div class="key">creator</div>
            <div>{{ $map->creator }}</div>
        </div>
        <div>
            <div class="key">length</div>
            <div>{{ gmdate('i:s', $map->length) }}</div>
        </div>
        <div>
            <div class="key">star rating</div>
            <div>{{ number_format(ceil($map->sr * 100) / 100, 2) }}★</div></div>
        </div>
        <div>
            <div class="key">settings</div>
            <div>CS{{ trim_float($map->cs) }}
                 HP{{ trim_float($map->hp) }}
                 AR{{ trim_float($map->ar) }}
                 OD{{ trim_float($map->od) }}
        </div>
        <div>
            <div class="key">submit date</div>
            <div>{{ $map->submitDate }}</div>
        </div>
        <div>
            <div class="key">last updated</div>
            <div>{{ $map->lastUpdated }}</div>
        </div>
        <div>
            <div class="key">tags</div>
            <div>
                @foreach ($map->tags as $tag) {{ $tag }} @endforeach
            </div>
        </div>
        <div>
            <div class="key">background</div>
            <div><img width="auto" height="300" src="{{ asset('storage/images/maps_background/' . $map->background) }}" alt="background"></div>
        </div>
        <div>
            <a id="edit" href="{{ route('maps.edit', $map->id) }}">edit map</a>
            <form action="{{ route('maps.delete', $map) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('delete this map? it will also be removed from associated playlists!');" id="delete">delete map</button>
            </form>
        </div>
    </div>
    <button class="return"><a href="{{ route('maps.index') }}" >back to map list</a></button>
    
@endsection