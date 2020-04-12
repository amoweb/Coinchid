<?php

include 'co.lib.php';

header("Access-Control-Allow-Origin: *");

$playerId = -1;
if(array_key_exists('player', $_GET)) {
	$playerId = intval($_GET['player']);
} else {
	return;
}

$game = null;
if(array_key_exists('game', $_GET) && $_GET['game']) {
	$game = sanitizeGameId($_GET['game']);
} else {
	return;
}

$src = -1;
if(array_key_exists('src', $_POST)) {
	$src = intval($_POST['src']);
} else {
	return;
}

$dst = -1;
if(array_key_exists('dst', $_POST)) {
	$dst = intval($_POST['dst']);
} else {
	return;
}


$moveAll = false;
if(array_key_exists('all', $_POST)) {
	if(intval($_POST['all']) != 0) {
		$moveAll = true;
	}
}

if(!$moveAll) {
	$item = -1;
	if(array_key_exists('item', $_POST)) {
		$item = intval($_POST['item']);
	} else {
		return;
	}
}

// Read file
$fileName = "game" . $game . ".json";
$jsontxt = file_get_contents($fileName);

$json = json_decode($jsontxt);

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

if($moveAll) {
	echo "move all";

	// Move from source set
	$items = array();
	foreach ($json->sets as $value) {

		if($src != intval($value->id)) {
			continue;
		}

		// Check if player can write in this set
		if(!in_array($playerId, $value->reader)) {
			die("Not the right to read this set.");
		}

		$items = $value->contents;
		$value->contents = [];
	}

	// Write in the destination set
	foreach ($json->sets as $value) {

		if($dst != intval($value->id)) {
			continue;
		}

        $value->owner = 0;

		// Check if player can write in this set
		if(!in_array($playerId, $value->writer)) {
			die("Not the right to write to this set.");
		}

		$value->contents = array_merge($value->contents, $items);
	}

    $json->status = $currPlayer->name . ' vient de bouger un paquet.';
	
} else {
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

		array_splice($value->contents, $itemIndex, 1);
	}

    // Change owner
    foreach($json->items as $card) {
        if(intval($card->id) == $item) {
            $card->owner = $playerId;
            break;
        }
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

    $json->status = $currPlayer->name . ' vient de jouer.';
}

$json->lastMoveDestination = $dst;

$jsontxt = json_encode($json);

file_put_contents ($fileName, $jsontxt );

?>
