        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="username">username</label>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username ?? '') }}">
        </div>
        <div class="error hidden" id="error_username"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="email">email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}">
        </div>
        <div class="error hidden" id="error_email"></div>

        @if(isset($user))
            <div class="input-container flex flex-f-center g-10">
                <label class="button p-10 bold flex flex-f-center" for="current_password">current password</label>
                <input type="password" id="current_password" name="current_password">
            </div>
        @endif
        <div class="error hidden" id="error_current_password"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="password">@if(isset($user)) new @endif password</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="error hidden" id="error_password"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button p-10 bold flex flex-f-center" for="password_confirmation">confirm @if(isset($user)) new @endif password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
        <div class="error hidden" id="error_password_confirmation"></div>

        <div class="input-container flex stretch g-10">
            <label class="button p-10 bold flex flex-f-center input-media" for="avatar">avatar (max 500x500)</label>
            <div class="flex flex-col flex-f-center w-full max-w-600">
                <input type="file" name="avatar">
                @if(isset($user) && $user->banner)
                    <img class="round-10" src="{{ asset('storage/images/avatars/' . $user->avatar) }}" alt="current avatar">
                @endif
            </div>
        </div>

        <div class="input-container flex stretch g-10">
            <label class="button p-10 bold flex flex-f-center input-media" for="banner">banner (min 1200x500)</label>
            <div class="flex flex-col flex-f-center w-full max-w-600">
                <input type="file" name="banner">
                @if(isset($user) && $user->banner)
                    <img class="round-10" src="{{ asset('storage/images/banners/' . $user->banner) }}" alt="current banner">
                @endif
            </div>    
        </div>