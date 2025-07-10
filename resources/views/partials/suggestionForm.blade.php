        <label for="type">type</label>
        <select name="type" id="select-media">
            <option value="media" @selected(old('type', $suggestion->type ?? '') === 'media')>media</option>
            <option value="music" @selected(old('type', $suggestion->type ?? '') === 'music')>music</option>
        </select>

        <label for="description">description</label>
        <textarea name="description" id="suggestion_description">{{ old('description', $suggestion->description ?? '') }}</textarea>
        <div class="error" id="error_suggestion_description"></div>

        <label>media</label>
        <input type="file" name="media_file" id="media-field">
            @if(isset($suggestion) && $suggestion->type === "media")
            <img src="{{ asset('storage/images/suggestions/' . $suggestion->media) }}" alt="current suggestion media" height="128">
            @endif
        <!-- evolution: restrict to specific trusted music websites for safety -->
        <input type="text" name="media_url" id="music-field" placeholder="music url (youtube, spotify, etc.)" value="{{ old('media_url', $suggestion->media ?? '') }}">

        <!-- shows only for admin AND if a suggestion parameter has been passed (edit page) -->
        @if (Auth::user()->type === 'admin' && $suggestion)
            <label for="user_id">user id</label>
            <select name="user_id" disabled>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @selected(old('user_id', $suggestion->user_id ?? '') == $user->id)>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
        @endif