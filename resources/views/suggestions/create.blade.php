@extends('layouts.app')

@section('title', 'send a suggestion')

@section('content')
    <!-- evolution: separate forms in a partial -->
    <h1>send a suggestion</h1>
    
    <form method="POST" action="{{ route('suggestions.store') }}" enctype="multipart/form-data">
        @csrf

        <label for="type">type</label>
        <select name="type" id="select-media">
            <option value="media">media</option>
            <option value="music">music</option>
        </select>

        <label for="description">description</label>
        <textarea name="description"></textarea>

        <label for="media">media</label>
        <input type="file" name="media" id="media-field">
        <input type="text" name="media" id="music-field" placeholder="music url (youtube, spotify, etc.)" style="display:none;">

        <!-- evolution: after middlewares have been set, hide this field -->
        <label for="user_id">user id</label>
        <select name="user_id">
            <option value="">(select user id)</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->username }}</option>
            @endforeach
        </select>

        <button type="submit" style="background-color:palegreen;">submit suggestion</button>
    </form>
@endsection

@section('scripts')
    <!-- shows different fields based off type selection -->
    <script>
    let selectType = document.getElementById('select-media');
    selectType.addEventListener('change', () => {
        if (selectType.value === 'media') {
            document.getElementById('media-field').style.display = 'block';
            document.getElementById('music-field').style.display = 'none';
        } else {
            document.getElementById('media-field').style.display = 'none';
            document.getElementById('music-field').style.display = 'block';
        }
    });
    </script>
@endsection