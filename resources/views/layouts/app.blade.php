<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&family=Glory:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    @vite(['resources/css/style.css', 'resources/js/darkMode.js'])
    <title>@yield('title')</title>
</head>
<body>
            <header>
                <div class="left">
                    <h1>BeatmapSelector</h1>
                </div>
                <div class="center">
                    <a class="no-link" href="{{ route('playlists.index') }}">
                        <div class="div-style">
                                <img width="32" height="32" class="iconLight" src="{{ asset('images/icons/playlist.svg') }}" alt="playlist icon">
                                <img width="32" height="32" class="iconDark" src="{{ asset('images/icons/playlist_dark.svg') }}" alt="playlist icon darkmode">
                                <p>view playlists</p>
                        </div>
                    </a>
            <!--    <div class="div-style">
                        <img width="32" height="32" class="iconLight" src="TBD" alt="Map Icon">
                        <img width="32" height="32" class="iconDark" src="TBD" alt="Map Icon Dark">
                        <p>view maps</p>
                    </div> -->
                </div>
                <div class="right">
                @guest
                    <div class="div-style">
                        <img width="32" height="32" class="iconLight" src="{{ asset('images/icons/login.svg') }}" alt="login icon">
                        <img width="32" height="32" class="iconDark" src="{{ asset('images/icons/login_dark.svg') }}" alt="login icon darkmode">
                        <a href="{{ route('login') }}" class="no-link"><p>login</p></a>
                    </div>
                @else
                    <div class="div-style">
                        <img width="32" height="32" class="iconLight" src="{{ asset('images/icons/user.svg') }}" alt="user icon">
                        <img width="32" height="32" class="iconDark" src="{{ asset('images/icons/user_dark.svg') }}" alt="user icon darkmode">
                        <a class="no-link" href="{{ route('users.profile', Auth::user()->id) }}"><p>hi, {{ Auth::user()->username }}</p></a>
                    </div>
                    <div class="div-style">
                        <img width="32" height="32" class="iconLight" src="{{ asset('images/icons/logout.svg') }}" alt="logout icon">
                        <img width="32" height="32" class="iconDark" src="{{ asset('images/icons/logout_dark.svg') }}" alt="logout icon darkmode">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="no-button"><p>logout</p></a>
                        </form>
                    </div>
                @endguest
                    <div id="darkMode">
                        <img id="dark" src="{{ asset('images/icons/dark_mode.svg') }}" alt="dark mode">
                        <img id="light" src="{{ asset('images/icons/light_mode.svg') }}" alt="light mode">
                    </div>
                </div>
            </header>

    <main>
        <section>
            <!-- set global session in layouts instead of individual pages -->
            <!-- success/error messages -->
            @if (session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="error">
                    {{ session('error') }}
                </div>
            @endif

            <!-- form validation errors -->
            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ strtolower($error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- main content -->
            @yield('content')
        </section>

        <!-- scripts (if needed) -->
        @yield('scripts')
    </main>
</body>
</html>