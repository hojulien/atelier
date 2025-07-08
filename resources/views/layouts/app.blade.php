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
                                <img width="32" height="32" class="iconLight" src="{{ asset('images/icons/playlist.svg') }}" alt="Playlist Icon">
                                <img width="32" height="32" class="iconDark" src="{{ asset('images/icons/playlist_dark.svg') }}" alt="Playlist Icon Dark">
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
                        <img width="32" height="32" class="iconLight" src="{{ asset('images/icons/login.svg') }}" alt="Login Icon">
                        <img width="32" height="32" class="iconDark" src="{{ asset('images/icons/login_dark.svg') }}" alt="Login Icon Dark">
                        <a href="{{ route('login') }}" class="no-link"><p>login</p></a>
                    </div>
                @else
                    <div class="div-style">
                        <img width="32" height="32" class="iconLight" src="{{ asset('images/icons/login.svg') }}" alt="Login Icon">
                        <img width="32" height="32" class="iconDark" src="{{ asset('images/icons/login_dark.svg') }}" alt="Login Icon Dark">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="no-button"><p>logout</p></a>
                        </form>
                    </div>
                @endguest
                    <div id="darkMode">
                        <img id="dark" src="{{ asset('images/icons/dark_mode.svg') }}" alt="Dark mode">
                        <img id="light" src="{{ asset('images/icons/light_mode.svg') }}" alt="Light mode">
                    </div>
                </div>
            </header>

    <main>
        <!-- set global session in layouts instead of individual pages -->
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

        <!-- main content -->
        <section>
            @yield('content')
        </section>

        <!-- scripts (if needed) -->
        @yield('scripts')
    </main>
</body>
</html>