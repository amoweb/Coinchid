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

// Read item list
$itemName = array();
foreach ($json->items as $value) {
	$itemName[intval($value->id)] = $value->name;
}

// List all sets this player can write
$setsWritable = array();
$setsWritableName = array();
foreach ($json->sets as $value) {
	foreach($value->writer as $id) {
		if($id == $playerId) {
			$setsWritable[] = $value->id;
			$setsWritableName[] = $value->name;
		}
	}
}

// Display all sets this player can read
foreach ($json->sets as $value) {
	foreach($value->reader as $id) {
		if($id == $playerId) {
			echo "<h2>" . $value->name . "<h2>\n";
			echo "<ul>";
			
			foreach($value->contents as $itemId) {
				$dstLink = '&nbsp;&rarr;';
				foreach($setsWritable as $key => $dstSetId) {
					if($dstSetId == $value->id) {
						continue;
					}
					$dstSetName = $setsWritableName[$key];
					$dstLink .= '<a href="javascript:move(' . $itemId . ',' . $value->id . ',' . $dstSetId . ');">' . $dstSetName . '</a>&nbsp;';
				}


				echo "<li>" . $itemName[intval($itemId)] . $dstLink . "</li>\n";
			}

			echo "</ul>";
		}
	}
}

?>
