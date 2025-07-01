<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Glory:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    @vite(['resources/css/style.css', 'resources/js/darkMode.js'])
    <title>@yield('title')</title>
</head>
<body>
            <header>
                <div class="left">
                    <h1>BeatmapSelector</h1>
                </div>
                <div class="center">
                    <div class="div-style">
                        <img width="32" height="32" class="iconLight" src="{{ asset('images/icons/playlist_light.svg') }}" alt="Playlist Icon">
                        <img width="32" height="32" class="iconDark" src="{{ asset('images/icons/playlist_dark.svg') }}" alt="Playlist Icon Dark">
                        <p>view playlists</p>
                    </div>
            <!--    <div class="div-style">
                        <img width="32" height="32" class="iconLight" src="TBD" alt="Map Icon">
                        <img width="32" height="32" class="iconDark" src="TBD" alt="Map Icon Dark">
                        <p>view maps</p>
                    </div> -->
                </div>
                <div class="right">
                @php /* if (isset($_SESSION['user'])): */ @endphp
                    <!-- <div class="div-style">
                        <img width="32" height="32" class="iconLight" src="images/icons/login_light.svg" alt="Login Icon">
                        <img width="32" height="32" class="iconDark" src="images/icons/login_dark.svg" alt="Login Icon Dark">
                        <a href="?action=logout"><p>logout</p></a>
                    </div> -->
                @php /* else: */ @endphp
                    <div class="div-style">
                        <img width="32" height="32" class="iconLight" src="{{ asset('images/icons/login_light.svg') }}" alt="Login Icon">
                        <img width="32" height="32" class="iconDark" src="{{ asset('images/icons/login_dark.svg') }}" alt="Login Icon Dark">
                        <a href="?action=login"><p>login</p></a>
                    </div>
                @php /* endif; */ @endphp
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