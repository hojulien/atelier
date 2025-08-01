@extends('layouts.app')

@section('title', 'suggestion informations')

@section('content')
    <div class="max-w-1200 m-auto p-20">
        <h1 class="title round-20">view suggestion n°{{ $suggestion->id }}</h1>
    </div>

    <div>
        <div class="max-w-1200 m-auto flex flex-col flex-f-center p-20 g-10">

            <div class="details-data flex g-20">
                <div class="details-key button round-20 flex flex-f-center g-5 m-auto">
                    <img class="iconLight icon-32" src="{{ asset('images/icons/description.svg') }}" alt="description icon">
                    <img class="iconDark icon-32" src="{{ asset('images/icons/description_dark.svg') }}" alt="description icon darkmode">
                    <span class="bold">description</span>
                </div>
                <div class="details-value button round-20 flex flex-f-center">
                    <span class="description">{{ $suggestion->description }}</span>
                </div>
            </div>

            <div class="details-data flex g-20">
                <div class="details-key button round-20  flex flex-f-center g-5 m-auto">
                    <img class="iconLight icon-32" src="{{ asset('images/icons/media.svg') }}" alt="media icon">
                    <img class="iconDark icon-32" src="{{ asset('images/icons/media.svg') }}" alt="media icon darkmode">
                    <span class="bold">media</span>
                </div>
                <div class="details-value button round-20 flex flex-f-center">
                    @if ($suggestion->type === "media")
                        <a href="{{ asset('storage/images/suggestions/' . $suggestion->media) }}" target="_blank">
                            <img class="round-15" src="{{ asset('storage/images/suggestions/' . $suggestion->media) }}" alt="suggestion media">
                        </a>
                    @else
                        <a href="{{ $suggestion->media }}" target="_blank">{{ $suggestion->media }}</a>
                    @endif
                </div>
            </div>

            <div class="details-data flex g-20">
                <div class="details-key button round-20  flex flex-f-center g-5 m-auto">
                    <img class="iconLight icon-32" src="{{ asset('images/icons/user.svg') }}" alt="user icon">
                    <img class="iconDark icon-32" src="{{ asset('images/icons/user.svg') }}" alt="user icon darkmode">
                    <span class="bold">submitted by</span>
                </div>
                <div class="details-value button round-20 flex flex-f-center">
                    <a href="{{ route('users.profile', $suggestion->user->id) }}"><span>{{ $suggestion->user->username }}</span></a>
                </div>
            </div>

        </div>
    </div>

    <div class="details-data flex flex-f-center g-20">
            
            <a id="edit" class="button p-10 no-link bold edit flex flex-f-center g-5 round-20" href="{{ route('suggestions.edit', $suggestion->id) }}">
                <img class="iconLight icon-24" src="{{ asset('images/icons/edit.svg') }}" alt="edit icon">
                <img class="iconDark icon-24" src="{{ asset('images/icons/edit_dark.svg') }}" alt="edit icon dark mode">
                edit suggestion
            </a>

            @if($suggestion->trashed())
                <form class="button p-10 archive round-20" action="{{ route('suggestions.restore', $suggestion->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="no-button bold flex flex-f-center g-5" onclick="return confirm('restore this suggestion to active?');">
                        <img class="iconLight icon-24" src="{{ asset('images/icons/restore.svg') }}" alt="restore icon">
                        <img class="iconDark icon-24" src="{{ asset('images/icons/restore_dark.svg') }}" alt="restore icon dark mode">
                        restore
                    </button>
                </form>
            @else
                <form class="button p-10 archive round-20" action="{{ route('suggestions.archive', $suggestion->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="no-button bold flex flex-f-center g-5" onclick="return confirm('archive this suggestion?');">
                        <img class="iconLight icon-24" src="{{ asset('images/icons/archive.svg') }}" alt="archive icon">
                        <img class="iconDark icon-24" src="{{ asset('images/icons/archive_dark.svg') }}" alt="archive icon dark mode">
                        archive
                    </button>
                </form>
            @endif

            <form class="button p-10 delete round-20" action="{{ route('suggestions.delete', $suggestion->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button 
                    onclick="return confirm('delete this suggestion? it cannot be recovered!');" 
                    id="delete"
                    class="no-button bold flex flex-f-center g-5">
                    <img class="iconLight icon-24" src="{{ asset('images/icons/delete.svg') }}" alt="delete icon">
                    <img class="iconDark icon-24" src="{{ asset('images/icons/delete_dark.svg') }}" alt="delete icon dark mode">
                    delete suggestion
                </button>
            </form>

            <a href="{{ route('suggestions.index') }}" class="no-link button return p-10 bold flex flex-f-center g-5 round-20">
                <img class="iconLight icon-24" src="{{ asset('images/icons/return.svg') }}" alt="return icon">
                <img class="iconDark icon-24" src="{{ asset('images/icons/return_dark.svg') }}" alt="return icon dark mode">
                back to suggestion list
            </a>
        </div>
    
@endsection