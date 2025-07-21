@extends('layouts.app')

@section('title', 'create a new account')

@section('content')

    <h1>register</h1>
    
    <form class="form m-auto g-10" method="POST" id="register" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- reuse same form in create/edit -->
        @include('partials.userForm', ['user' => null])

        <button type="submit" style="background-color:palegreen;">create account</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/forms/register.js')
@endsection