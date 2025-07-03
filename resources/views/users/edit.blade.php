@extends('layouts.app')

@section('title', 'edit account')

@section('content')
    <!-- evolution: separate forms in a partial -->
    <h1>register</h1>
    
    <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('partials.userForm', ['user' => $user])

        <button type="submit" style="background-color:palegreen;">update account</button>
    </form>
@endsection