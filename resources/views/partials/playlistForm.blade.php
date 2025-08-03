        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="name">name</label>
            <input type="text" id="playlist_name" name="name" value="{{ old('name', $playlist->name ?? '') }}">
        </div>
        <div class="error" id="error_playlist_name"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="description">description</label>
            <textarea name="description" id="playlist_description">{{ old('description', $playlist->description ?? '') }}</textarea>
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="visibility">visibility</label>
            <select name="visibility" id="visibility">
                <option value="public">public</option>
                <option value="private">private</option>
            </select>
        </div>

        <!-- shows only for admin AND if a playlist parameter has been passed (edit page) -->
        @if (Auth::user()->type === 'admin' && $playlist)
            <div class="input-container flex flex-f-center g-10">
                <label class="button p-10 bold flex flex-f-center" for="user_id">user id</label>
                <select name="user_id" disabled>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id', $playlist->user_id ?? '') == $user->id)>
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif