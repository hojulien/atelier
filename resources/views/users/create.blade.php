@extends('layouts.app')

@section('title', 'create a new account')

@section('content')
    <!-- evolution: separate forms in a partial -->
    <h1>register</h1>
    
    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf

        <label for="username">username</label>
        <input type="text" name="username">

        <label for="email">email</label>
        <input type="email" name="email">

        <label for="password">password</label>
        <input type="password" name="password">

        <label for="password">confirm password</label>
        <input type="password" name="password_confirmation">

        <label for="avatar">avatar (max 500x500)</label>
        <input type="file" name="avatar">

        <label for="banner">banner (min 1200x500)</label>
        <input type="file" name="banner">

        <button type="submit" style="background-color:palegreen;">create account</button>
    </form>
@endsection