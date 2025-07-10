        <label for="username">username</label>
        <input type="text" id="username" name="username" value="{{ old('username', $user->username ?? '') }}">
        <div class="error" id="error_username"></div>

        <label for="email">email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}">
        <div class="error" id="error_email"></div>

        <label for="password">password</label>
        <input type="password" id="password" name="password">
        <div class="error" id="error_password"></div>

        <label for="password_confirmation">confirm password</label>
        <input type="password" id="password_confirmation" name="password_confirmation">
        <div class="error" id="error_password_confirmation"></div>

        <label for="avatar">avatar (max 500x500)</label>
        <input type="file" name="avatar">
        @if(isset($user) && $user->avatar)
        <img src="{{ asset('storage/images/avatars/' . $user->avatar) }}" alt="current avatar" height="128">
        @endif

        <label for="banner">banner (min 1200x500)</label>
        <input type="file" name="banner">
        @if(isset($user) && $user->banner)
        <img src="{{ asset('storage/images/banners/' . $user->banner) }}" alt="current banner" height="128">
        @endif