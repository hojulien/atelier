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

        <p> don't have an account?</p>
            <a href="{{ route('register') }}" class="no-link button w-full max-w-600 round-20 return p-10 bold flex flex-f-center g-5 ">
                    <img class="iconLight icon-24" src="{{ asset('images/icons/add.svg') }}" alt="add icon">
                    <img class="iconDark icon-24" src="{{ asset('images/icons/add_dark.svg') }}" alt="add icon dark mode">
                    create account
                </a>

        <button type="submit" class="button w-full max-w-600 round-20 return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/login.svg') }}" alt="login icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/login_dark.svg') }}" alt="login icon dark mode">
            login</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/forms/login.js')
@endsection