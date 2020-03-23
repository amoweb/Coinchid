<?php

header("Access-Control-Allow-Origin: *");

$game = -1;
if(array_key_exists('game', $_GET)) {
	$game = intval($_GET['game']);
} else {
	return;
}

if($game > 1000 || $game < 0) {
	$game = 1;
}

// Read file
$fileName = "game" . $game . ".json";
$jsontxt = file_get_contents($fileName);

$json = json_decode($jsontxt);

echo "<h1>Distribuer</h1>";

// Source set
$src = intval($json->distributeSource); // Paquet

// Compute distribution order
$dst = array();
$indexPlayer = $json->firstPlayer;
for($i = 0; $i < 4; ++$i) {
	$indexPlayer = $indexPlayer + 1;
	if($indexPlayer > 4) {
		$indexPlayer = 1;
	}
	$dst[] = $indexPlayer;
}

// Change first player
$json->firstPlayer += 1;
if($json->firstPlayer > 4) {
	$json->firstPlayer = 1;
}

// Read item list
$nbItems = count($json->items);

// Move from source set
$items = array();
foreach ($json->sets as $value) {

	if($src != intval($value->id)) {
		continue;
	}

	$items = $value->contents;
	$value->contents = [];
}

if(count($items) < $nbItems) {
	die('No all items in the source set.');
}

$coupe = rand(1, $nbItems-2);

$cartesCoupees = array();

foreach (array_slice($items, $coupe) as $c) {
	$cartesCoupees[] = $c;
}
foreach (array_slice($items, 0, $coupe) as $c) {
	$cartesCoupees[] = $c;
}

if(count($dst) != 4) {
	die('Need four players in the destination.');
}

if($nbItems != 32) {
	die('Only works with 32 cards.');
}

$i = 0;
$p1 = [];
$p2 = [];
$p3 = [];
$p4 = [];

$p1[] = $cartesCoupees[$i++];
$p1[] = $cartesCoupees[$i++];
$p1[] = $cartesCoupees[$i++];
$p2[] = $cartesCoupees[$i++];
$p2[] = $cartesCoupees[$i++];
$p2[] = $cartesCoupees[$i++];
$p3[] = $cartesCoupees[$i++];
$p3[] = $cartesCoupees[$i++];
$p3[] = $cartesCoupees[$i++];
$p4[] = $cartesCoupees[$i++];
$p4[] = $cartesCoupees[$i++];
$p4[] = $cartesCoupees[$i++];

$p1[] = $cartesCoupees[$i++];
$p1[] = $cartesCoupees[$i++];
$p2[] = $cartesCoupees[$i++];
$p2[] = $cartesCoupees[$i++];
$p3[] = $cartesCoupees[$i++];
$p3[] = $cartesCoupees[$i++];
$p4[] = $cartesCoupees[$i++];
$p4[] = $cartesCoupees[$i++];

$p1[] = $cartesCoupees[$i++];
$p1[] = $cartesCoupees[$i++];
$p1[] = $cartesCoupees[$i++];
$p2[] = $cartesCoupees[$i++];
$p2[] = $cartesCoupees[$i++];
$p2[] = $cartesCoupees[$i++];
$p3[] = $cartesCoupees[$i++];
$p3[] = $cartesCoupees[$i++];
$p3[] = $cartesCoupees[$i++];
$p4[] = $cartesCoupees[$i++];
$p4[] = $cartesCoupees[$i++];
$p4[] = $cartesCoupees[$i++];

// Write in the destination set
foreach ($json->sets as $value) {
	switch(intval($value->id)) {
		case $dst[0]:
			$value->contents = $p1;
			break;
		case $dst[1]:
			$value->contents = $p2;
			break;
		case $dst[2]:
			$value->contents = $p3;
			break;
		case $dst[3]:
			$value->contents = $p4;
			break;

	}
}

// Find first player player name
$player = NULL;
foreach ($json->players as $value) {
	if(intval($value->id) == intval($json->firstPlayer)) {
		$player = $value;
	}
}
$json->status = 'Nouvelle partie: ' . $player->name . ' annoncez!';

$jsontxt = json_encode($json);

file_put_contents ( $fileName, $jsontxt );

?>

