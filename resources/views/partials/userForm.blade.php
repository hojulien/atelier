        <label for="username">username</label>
        <input type="text" name="username" value="{{ old('username', $user->username ?? '') }}">

        <label for="email">email</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}">

        <label for="password">password</label>
        <input type="password" name="password">

        <label for="password_confirmation">confirm password</label>
        <input type="password" name="password_confirmation">

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