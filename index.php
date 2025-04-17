<?php

require_once __DIR__ . '/models/repositories/MapsRepository.php';
require_once __DIR__ . '/models/repositories/UserRepository.php';
require_once __DIR__ . '/models/repositories/PlaylistRepository.php';
require_once __DIR__ . '/models/repositories/SuggestionRepository.php';


// "test" de vérification de la connexion entre la DB et le projet.

echo "<h1> Test de vérification de la connexion avec la DB </h1> <br>";

// users

echo "<h2> Users </h2> <br> <br>";
$userRepo = new UserRepository();
$getAllUsers = $userRepo->getUsers();
 
var_dump($getAllUsers);
echo "<br><br>";

// playlists

echo "<h2> Playlists </h2> <br> <br>";
$playRepo = new PlaylistRepository();
$getAllPlaylists = $playRepo->getPlaylists();
 
var_dump($getAllPlaylists);
echo "<br><br>";

// suggestions

echo "<h2> Suggestions </h2> <br> <br>";
$suggestionRepo = new SuggestionRepository();
$getAllSuggestions = $suggestionRepo->getSuggestions();
 
var_dump($getAllSuggestions);
echo "<br><br>";