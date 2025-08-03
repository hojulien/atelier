@extends('layouts.app')

@section('title', 'create a new account')

@section('content')

    <div class="title-container m-auto max-w-1000 p-20">
        <h1 class="title round-20">register</h1>
    </div>
    
    <form class="form m-auto g-10 p-20" method="POST" id="register" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- reuse same form in create/edit -->
        @include('partials.userForm', ['user' => null])

        <br>

        <button type="submit" class="button w-full max-w-600 round-20 return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/add.svg') }}" alt="add icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/add_dark.svg') }}" alt="add icon dark mode">
            create account</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/forms/register.js')
@endsection