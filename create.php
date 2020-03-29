<?php
include 'co.lib.php';
header("Access-Control-Allow-Origin: *");

// Read default game file
$json = readJson("default_game.json");

$json->date = time();

// Create a random ID
$gameId = sha1(microtime() . rand() . $GAME_ID_SALT);

// Fill player names
$json->players[1]->name = sanitizePlayerName($_POST['name1']);
$json->players[2]->name = sanitizePlayerName($_POST['name2']);
$json->players[3]->name = sanitizePlayerName($_POST['name3']);
$json->players[4]->name = sanitizePlayerName($_POST['name4']);

// Avoir server full
$dir = scandir('.');
if(count($dir) > 500) {
    die('Server full.');
}

// Write file
$fileName = "game" . $gameId . ".json";
writeJson($fileName, $json);

header("Location: " . $URL_BASIS . "join.php?game=" . $gameId);
exit();

?>
