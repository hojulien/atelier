@extends('layouts.app')

@section('title', 'login')

@section('content')
    <h1>login</h1>

    @error('username')
        <div class="error">{{ $message }}</div>
    @enderror

    <form action="{{ route('loginAction') }}" method="POST">
        @csrf
        <label for="username">username</label>
        <input type="text" name="username" id="username" placeholder="username" value="{{ old('username') }}">
        
        <label for="password">password</label>
        <input type="password" name="password" id="password" placeholder="password">
        <p style="text-align:center;">don't have an account?</p>
        <a href="{{ route('register') }}"><p style="text-align:center;">create an account</p></a>
        <button type="submit">login</button>
    </form>
@endsection