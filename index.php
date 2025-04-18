<?php

require_once __DIR__ . '/models/repositories/MapsRepository.php';
require_once __DIR__ . '/models/repositories/UserRepository.php';
require_once __DIR__ . '/models/repositories/PlaylistRepository.php';
require_once __DIR__ . '/models/repositories/SuggestionRepository.php';

echo "<h2> Map </h2> <br> <br>";
$mapsRepo = new MapsRepository();
$getMap = $mapsRepo->getMap(1);
var_dump($getMap);
 
?>

<img src="<?= $getMap->getBackgroundPath() ?>" alt="Test Background ID 1">