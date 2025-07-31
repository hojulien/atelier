@extends('layouts.app')

@section('title', 'login')

@section('content')
    <div class="max-w-1200 m-auto p-20">
        <h1 class="title max-w-600 m-auto round-20">login</h1>
    </div>

    <form class="form m-auto g-10" action="{{ route('loginAction') }}" method="POST" id="login">
        @csrf
        <label class="max-w-600 p-10" for="username">username</label>
        <input type="text" name="username" id="username" placeholder="username" value="{{ old('username') }}">
        <div class="error" id="error_username"></div>
        
        <label class="max-w-600 p-10" for="password">password</label>
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