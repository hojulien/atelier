@extends('layouts.app')

@section('title', 'edit account')

@section('content')
    <div class="max-w-1000 m-auto p-20">
        <h1 class="title round-20">edit profile</h1>
    </div>
    
    <form class="form m-auto g-10 p-20" id="userEditForm" method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('partials.userForm', ['user' => $user])

        <button type="submit" class="button round-20 return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/update.svg') }}" alt="update icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/update_dark.svg') }}" alt="update icon dark mode">
            update account</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/forms/userEdit.js')
@endsection