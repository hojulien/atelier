@extends('layouts.app')

@section('title', 'map List')

@section('content')
    <h1>hi</h1>

    <!-- for accessibility purposes, to remove later -->
    <a href="{{ route('maps.create') }}"><h2>add new map</h2></a>

    <!-- TO DO: replace by artistunicode/titleunicode with a js script -->
    
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>artist</th>
                <th>title</th>
                <th>creator</th>
                <th>sr</th>
                <th>cs</th>
                <th>hp</th>
                <th>ar</th>
                <th>od</th>
                <th>length</th>
                <th>background</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maps as $map)
            <tr>
                <td>{{ $map->id }}</td>
                <td>{{ $map->artist }}</td>
                <td>{{ $map->title }}</td>
                <td>{{ $map->creator }}</td>
                <td>{{ number_format(ceil($map->sr * 100) / 100, 2) }}★</td>
                <td>{{ trim_float($map->cs) }}</td>
                <td>{{ trim_float($map->hp) }}</td>
                <td>{{ trim_float($map->ar) }}</td>
                <td>{{ trim_float($map->od) }}</td>
                <td>{{ gmdate('i:s', $map->length) }}</td>
                <td><img src="{{ asset('storage/images/maps_background/' . $map->background) }}" alt="Map Background" height="128" loading="lazy"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection