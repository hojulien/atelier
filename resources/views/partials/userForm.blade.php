        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="username">username</label>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username ?? '') }}">
            <div class="error" id="error_username"></div>
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="email">email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}">
            <div class="error" id="error_email"></div>
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="password">password</label>
            <input type="password" id="password" name="password">
            <div class="error" id="error_password"></div>
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="password_confirmation">confirm password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
            <div class="error" id="error_password_confirmation"></div>
        </div>

        <div class="input-container input-media flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="avatar">avatar (max 500x500)</label>
            @if(isset($user) && $user->avatar)
            <div class="input-media-container">
                <img class="w-full round-10" src="{{ asset('storage/images/avatars/' . $user->avatar) }}" alt="current avatar">
            </div>
            @endif
            <input type="file" name="avatar">
        </div>

        <div class="input-container input-media flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="banner">banner (min 1200x500)</label>
            @if(isset($user) && $user->banner)
            <div class="input-media-container">
                <img class="w-full round-10" src="{{ asset('storage/images/banners/' . $user->banner) }}" alt="current banner">
            </div>    
            @endif
            <input type="file" name="banner">
        </div>