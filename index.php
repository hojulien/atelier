<?php

require_once __DIR__ . '/models/repositories/MapsRepository.php';

// "test" de vérification de la connexion entre la DB et le projet.

echo "<h1> Test de vérification de la connexion avec la DB </h1>";
$mapsRepo = new MapsRepository();
$getAllMaps = $mapsRepo->getMaps();
 
var_dump($getAllMaps);