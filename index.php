<?php

require_once __DIR__ . '/models/repositories/MapsRepository.php';
 
// "test" de vérification de la connexion entre la DB et le projet.

$mapsRepo = new MapsRepository();
$getAllMaps = $mapsRepo->getMaps();
 
var_dump($getAllMaps);