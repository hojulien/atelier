@extends('layouts.app')

@section('title', 'login')

@section('content')
    <h1>login</h1>

    @error('username')
        <div class="error">{{ $message }}</div>
    @enderror

    <form action="{{ route('loginAction') }}" method="POST" id="login">
        @csrf
        <label for="username">username</label>
        <input type="text" name="username" id="username" placeholder="username" value="{{ old('username') }}">
        <div class="error" id="error_username"></div>
        
        <label for="password">password</label>
        <input type="password" name="password" id="password" placeholder="password">
        <div class="error" id="error_password"></div>

        <p style="text-align:center;">
            don't have an account? <br>
            <a href="{{ route('register') }}">create an account</a>
        </p>
        <button type="submit">login</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/forms/login.js')
@endsection