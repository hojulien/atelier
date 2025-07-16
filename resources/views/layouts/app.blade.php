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
                <!-- left side: website name -->
                <div class="h-left flex flex-y-center">
                    <a class="no-link" href="{{ route('home') }}"><h1>BeatmapSelector</h1></a>
                </div>

                <!-- middle side: playlists/maps/suggestions -->
                <div class="h-center flex flex-y-center g-10">
                    <a class="no-link" href="{{ route('playlists.index') }}">
                        <div class="h-button flex flex-f-center g-5">
                                <img class="iconLight icon-32" src="{{ asset('images/icons/playlist.svg') }}" alt="playlist icon">
                                <img class="iconDark icon-32" src="{{ asset('images/icons/playlist_dark.svg') }}" alt="playlist icon darkmode">
                                <span class="h-action">playlists</span>
                        </div>
                    </a>
                    <a class="no-link" href="{{ route('maps.index') }}">
                        <div class="h-button flex flex-f-center g-5">
                            <img class="iconLight icon-32" src="{{ asset('images/icons/map.svg') }}" alt="map icon">
                            <img class="iconDark icon-32" src="{{ asset('images/icons/map_dark.svg') }}" alt="map icon darkmode">
                            <span class="h-action">maps</span>
                        </div>
                    </a>
                    <a class="no-link" href="{{ route('suggestions.create') }}">
                        <div class="h-button flex flex-f-center g-5">
                            <img class="iconLight icon-32" src="{{ asset('images/icons/suggestion.svg') }}" alt="suggestion icon">
                            <img class="iconDark icon-32" src="{{ asset('images/icons/suggestion_dark.svg') }}" alt="suggestion icon darkmode">
                            <span class="h-action">suggestion</span>
                        </div>
                    </a>
                    <!-- dashboard for admins -->
                    @if (Auth::check() && Auth::user()->type === "admin")
                        <!-- replace by dashboard when ready -->
                        <a class="no-link" href="{{ route('home') }}">
                            <div class="h-button flex flex-f-center g-5">
                                <img class="iconLight icon-32" src="{{ asset('images/icons/admin.svg') }}" alt="admin icon">
                                <img class="iconDark icon-32" src="{{ asset('images/icons/admin_dark.svg') }}" alt="admin icon darkmode">
                                <span class="h-action">dashboard</span>
                            </div>
                        </a>
                    @endif
                </div>

                <!-- right side: login/profile -->
                <div class="h-right flex flex-y-center g-10">
                @guest
                    <a href="{{ route('login') }}" class="no-link">
                        <div class="h-button flex flex-f-center g-5">
                            <img class="iconLight icon-32" src="{{ asset('images/icons/login.svg') }}" alt="login icon">
                            <img class="iconDark icon-32" src="{{ asset('images/icons/login_dark.svg') }}" alt="login icon darkmode">
                            <span class="h-action">login</span>
                        </div>
                    </a>
                @else
                    <a class="no-link" href="{{ route('users.profile', Auth::user()->id) }}">
                        <div class="h-button flex flex-f-center g-5">
                            <img class="iconLight icon-32" src="{{ asset('images/icons/user.svg') }}" alt="user icon">
                            <img class="iconDark icon-32" src="{{ asset('images/icons/user_dark.svg') }}" alt="user icon darkmode">
                            <span class="h-action">hi, {{ Auth::user()->username }}</span>
                        </div>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        <div class="h-button flex flex-f-center g-5">
                            @csrf
                            <img class="iconLight icon-32" src="{{ asset('images/icons/logout.svg') }}" alt="logout icon">
                            <img class="iconDark icon-32" src="{{ asset('images/icons/logout_dark.svg') }}" alt="logout icon darkmode">
                            <button type="submit" class="no-button"><span class="h-action">logout</span></button>
                        </div>
                    </form>
                @endguest
                    <div id="darkMode" class="h-button flex flex-f-center">
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
    <footer>
        <p id="copyright">© atelierprism, 2025</p>
    </footer>
</body>
</html>