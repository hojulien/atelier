        <label for="type">type</label>
        <select name="type" id="select-media">
            <option value="media" @selected(old('type', $suggestion->type ?? '') === 'media')>media</option>
            <option value="music" @selected(old('type', $suggestion->type ?? '') === 'music')>music</option>
        </select>

        <label for="description">description</label>
        <textarea name="description">{{ old('description', $suggestion->description ?? '') }}</textarea>

        <label>media</label>
        <input type="file" name="media_file" id="media-field">
            @if(isset($suggestion) && $suggestion->type === "media")
            <img src="{{ asset('storage/images/suggestions/' . $suggestion->media) }}" alt="current suggestion media" height="128">
            @endif
        <input type="text" name="media_url" id="music-field" placeholder="music url (youtube, spotify, etc.)" value="{{ old('media_url', $suggestion->media ?? '') }}">

        <!-- evolution: after middlewares have been set, hide this field -->
        <label for="user_id">user id</label>
        <select name="user_id">
            <option value="">(select user id)</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(old('user_id', $suggestion->user_id ?? '') == $user->id)>
                    {{ $user->username }}
                </option>
            @endforeach
        </select>