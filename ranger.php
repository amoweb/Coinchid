<?php
include 'co.lib.php';
header("Access-Control-Allow-Origin: *");

$game = null;
if(array_key_exists('game', $_GET) && $_GET['game']) {
	$game = sanitizeGameId($_GET['game']);
} else {
	return;
}

// Read file
$fileName = "game" . $game . ".json";
$json = readJson($fileName);

echo "<h1>Ranger</h1>";

$dstSet = getJsonElementById($json->sets, intval($json->distributeSource));

foreach ($json->sets as $s) {
    if(intval($s->id) != intval($dstSet->id)) {
        $dstSet->contents = array_merge($dstSet->contents, $s->contents);
        $s->contents = [];
    }
}

writeJson($fileName, $json);

?>

