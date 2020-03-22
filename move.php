<?php

header("Access-Control-Allow-Origin: *");

$playerId = -1;
if(array_key_exists('player', $_GET) && $_GET['player']) {
	$playerId = intval($_GET['player']);
} else {
	return;
}

$game = -1;
if(array_key_exists('game', $_GET) && $_GET['game']) {
	$game = intval($_GET['game']);
} else {
	return;
}

$src = -1;
if(array_key_exists('src', $_POST) && $_POST['src']) {
	$src = intval($_POST['src']);
} else {
	return;
}

$dst = -1;
if(array_key_exists('dst', $_POST) && $_POST['dst']) {
	$dst = intval($_POST['dst']);
} else {
	return;
}

$item = -1;
if(array_key_exists('item', $_POST) && $_POST['item']) {
	$item = intval($_POST['item']);
} else {
	return;
}

// Read file
$fileName = "game" . $game . ".json";
$jsontxt = file_get_contents($fileName);

$json = json_decode($jsontxt);

var_dump($json);

// Find current player
$currPlayer = NULL;
foreach ($json->players as $value) {
	if(intval($value->id) == $playerId) {
		$currPlayer = $value;
	}
}

if($currPlayer == NULL) {
	die("Player not found.");
}

echo "<h1>" . $currPlayer->name . "</h1>";


// Check whether user can write

// Remove from source set
foreach ($json->sets as $value) {

	if($src != intval($value->id)) {
		continue;
	}

	// Check if player can write in this set
	if(!in_array($playerId, $value->reader)) {
		die("Not the right to read this set.");
	}

	// Find the item
	$itemIndex = -1;
	foreach($value->contents as $key=>$cItem) {
		if(intval($cItem) == $item) {
			$itemIndex = $key;
			break;
		}
	}

	if($itemIndex == -1) {
		die("Item not found");
	}

	var_dump($value->contents);
	array_splice($value->contents, $itemIndex, 1);
	var_dump($value->contents);
}

// Write in the destination set
foreach ($json->sets as $value) {

	if($dst != intval($value->id)) {
		continue;
	}

	// Check if player can write in this set
	if(!in_array($playerId, $value->writer)) {
		die("Not the right to write to this set.");
	}

	$value->contents[] = intval($item);
}

$jsontxt = json_encode($json);

file_put_contents ($fileName, $jsontxt );

?>
