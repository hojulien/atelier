@extends('layouts.app')

@section('title', 'create a new account')

@section('content')

    <div class="title-container p-20">
        <h1 class="title">register</h1>
    </div>
    
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