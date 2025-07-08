@extends('layouts.app')

@section('title', 'create a new account')

@section('content')
    <h1>register</h1>
    
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- reuse same form in create/edit -->
        @include('partials.userForm', ['user' => null])

        <button type="submit" style="background-color:palegreen;">create account</button>
    </form>
@endsection