        <label for="name">name</label>
        <input type="text" name="name" value="{{ old('name', $playlist->name ?? '') }}">

        <label for="description">description</label>
        <textarea name="description">{{ old('description', $playlist->description ?? '') }}</textarea>

        <!-- evolution: after middlewares have been set, hide this field -->
        <label for="user_id">user id</label>
        <select name="user_id">
            <option value="">(select user id)</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(old('user_id', $playlist->user_id ?? '') == $user->id)>
                    {{ $user->username }}
                </option>
            @endforeach
        </select>