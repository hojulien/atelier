<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Glory:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./assets/styles/style.css">
        <script src="./assets/scripts/darkMode.js" defer></script>
        <title>Map Selector</title>
    </head>
    <body>
        <main>
            <header>
                <div class="left">
                    <h1>MapSelector</h1>
                </div>
                <div class="center">
                    <div class="div-style">
                        <img width="32" height="32" class="iconLight" src="assets/images/playlist_light.svg" alt="Playlist Icon">
                        <img width="32" height="32" class="iconDark" src="assets/images/playlist_dark.svg" alt="Playlist Icon Dark">
                        <p>view playlists</p>
                    </div>
                </div>
                <div class="right">
                    <div class="div-style">
                        <img width="32" height="32" class="iconLight" src="assets/images/login_light.svg" alt="Login Icon">
                        <img width="32" height="32" class="iconDark" src="assets/images/login_dark.svg" alt="Login Icon Dark">
                        <p>login</p>
                    </div>
                    <div id="darkMode">
                        <img id="dark" src="assets/images/dark_mode.svg" alt="Dark mode">
                        <img id="light" src="assets/images/light_mode.svg" alt="Light mode">
                    </div>
                </div>
            </header>
