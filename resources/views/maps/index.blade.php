@extends('layouts.app')

@section('title', 'Map List')

@section('content')
    <h1>hi</h1>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <!-- TO DO: replace by artistunicode/titleunicode with a js script -->
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
                <td>{{ $map->cs }}</td>
                <td>{{ $map->hp }}</td>
                <td>{{ $map->ar }}</td>
                <td>{{ $map->od }}</td>
                <td>{{ gmdate('i:s', $map->length) }}</td>
                <td><img src="{{ $map->background }}" alt="Map Background" height="128"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection