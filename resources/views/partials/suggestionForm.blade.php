        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="type">type</label>
            <select name="type" id="select-media">
                <option value="media" @selected(old('type', $suggestion->type ?? '') === 'media')>media</option>
                <option value="music" @selected(old('type', $suggestion->type ?? '') === 'music')>music</option>
            </select>
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="description">description</label>
            <textarea name="description" id="suggestion_description">{{ old('description', $suggestion->description ?? '') }}</textarea>
            <div class="error" id="error_suggestion_description"></div>
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center">media</label>
            <input type="file" name="media_file" id="media-field">
                @if(isset($suggestion) && $suggestion->type === "media")
                <img src="{{ asset('storage/images/suggestions/' . $suggestion->media) }}" alt="current suggestion media" height="128">
                @endif
            <!-- evolution: restrict to specific trusted music websites for safety -->
            <input type="text" name="media_url" id="music-field" placeholder="music url (youtube, spotify, etc.)" value="{{ old('media_url', $suggestion->media ?? '') }}">
        </div>

        <!-- shows only for admin AND if a suggestion parameter has been passed (edit page) -->
        <div class="input-container flex flex-f-center g-10">
            @if (Auth::user()->type === 'admin' && $suggestion)
                <label class="button p-10 bold flex flex-f-center" for="user_id">user id</label>
                <select name="user_id" disabled>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id', $suggestion->user_id ?? '') == $user->id)>
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
            @endif
        </div>