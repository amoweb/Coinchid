<?php

header("Access-Control-Allow-Origin: *");

$playerId = -1;
if(array_key_exists('player', $_GET) ) {
	$playerId = intval($_GET['player']);
} else {
	return;
}

$game = -1;
if(array_key_exists('game', $_GET) ) {
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
	if(in_array($playerId, $value->writer)) {
		$setsWritable[] = $value->id;
		$setsWritableName[] = $value->name;
	}
}

// Display all sets this player can read
foreach ($json->sets as $value) {
	
	$currentSetId = $value->id;

	foreach($value->reader as $id) {
		if($id == $playerId) {
			
			// Display flush-all-set link
			$flushDstLink = '';

			foreach($setsWritable as $key => $dstSetId) {
				if($dstSetId == $currentSetId) {
					continue;
				}

				// Display only some links
				if(!in_array($dstSetId, $value->displayedFlushDest)) {
					continue;
				}


				$dstSetName = $setsWritableName[$key];
				$flushDstLink .= '<a href="javascript:moveAll(' . $currentSetId . ',' . $dstSetId . ');">' . $dstSetName . '</a>&nbsp;';
			}

			if(strlen($flushDstLink) > 0) {
				$flushDstLink = '&nbsp;&rarr;' . $flushDstLink;
			}


			echo "<h2>" . $value->name . $flushDstLink . "<h2>\n";
			echo "<ul>";
			
			foreach($value->contents as $itemId) {

				// Display move links
				$dstLink = '';
				foreach($setsWritable as $key => $dstSetId) {
					if($dstSetId == $currentSetId) {
						continue;
					}

					// Display only some links
					if(!in_array($dstSetId, $value->displayedMoveDest)) {
						continue;
					}


					$dstSetName = $setsWritableName[$key];
					$dstLink .= '<a href="javascript:move(' . $itemId . ',' . $currentSetId . ',' . $dstSetId . ');">' . $dstSetName . '</a>&nbsp;';
				}

				if(strlen($dstLink) > 0) {
					$dstLink = '&nbsp;&rarr;' . $dstLink;
				}

				echo "<li>" . $itemName[intval($itemId)] . $dstLink . "</li>\n";
			}

			echo "</ul>";
		}
	}
}

?>
