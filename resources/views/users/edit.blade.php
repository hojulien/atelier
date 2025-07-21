@extends('layouts.app')

@section('title', 'edit account')

@section('content')
    <h1>edit profile</h1>
    
    <form class="form m-auto g-10" id="userEditForm" method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('partials.userForm', ['user' => $user])

        <button type="submit" class="button return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/update.svg') }}" alt="update icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/update_dark.svg') }}" alt="update icon dark mode">
            update account</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/forms/userEdit.js')
@endsection