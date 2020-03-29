<?php
include 'co.lib.php';

header("Access-Control-Allow-Origin: *");

$playerId = -1;
if(array_key_exists('player', $_GET) ) {
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

// Read file
$fileName = "game" . $game . ".json";
$json = readJson($fileName);

// Find current player
$currPlayer = getJsonElementById($json->players, $playerId);

if($currPlayer == NULL) {
	die("Player not found.");
}

echo "<h1>" . $currPlayer->name . "</h1>";

// List all sets this player can write
$setsWritable = array();
$setsWritableName = array();
foreach ($json->sets as $value) {
	if(in_array($playerId, $value->writer)) {
		$setsWritable[] = $value->id;
		$setsWritableName[] = $value->name;
	}
}

echo '<p><b>' . $json->status . '</b></p>';

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
			//echo "<ul>";
			
			$sortedContents = $value->contents;

			if(intval($value->sortedDisplay) != 0) {
				sort($sortedContents);
			}

			foreach($sortedContents as $itemId) {
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

                    // The default link is not displayed here
                    if(in_array($dstSetId, $value->defaultMoveDest)) {
                        continue;
                    }

					$dstSetName = $setsWritableName[$key];
					$dstLink .= '<a href="javascript:move(' . $itemId . ',' . $currentSetId . ',' . $dstSetId . ');">' . $dstSetName . '</a>&nbsp;';
				}

				if(strlen($dstLink) > 0) {
					$dstLink = '&nbsp;&rarr;' . $dstLink;
				}

                $card = getJsonElementById($json->items, $itemId);
                $cardHTML = cardStr($json, $card);

                if(count($value->defaultMoveDest) == 0) {
                    echo $cardHTML . "\n";
                } else if(count($value->defaultMoveDest) == 1) {
                    echo '<a href="javascript:move(' . $itemId . ',' . $currentSetId . ',' . $value->defaultMoveDest[0] . ');">' . $cardHTML . $dstLink . '</a>';
                } else {
                    foreach($value->defaultMoveDest as $d) {
                        if(in_array($d, $setsWritable)) {
                            echo '<a href="javascript:move(' . $itemId . ',' . $currentSetId . ',' . $d . ');">' . $cardHTML . $dstLink . '</a>';
                            break;
                        }
                    }
                    
                }
			}

			echo "<br />";
		}
	}
}

if($playerId == 0) {
    echo '<h2>Comptage</h2>';

    // Team 1 count
    $team1set = getJsonElementById($json->sets, 6);
    echo $team1set->name;
    echo countStr($json, $team1set->contents);

    // Team 2 count
    $team2set = getJsonElementById($json->sets, 7);
    echo $team2set->name;
    echo countStr($json, $team2set->contents);

}

echo '<h2>Ordre du tour</h2><p>';

$indexPlayer = $json->firstPlayer;
for($i = 0; $i < 4; ++$i) {
    echo getJsonElementById($json->players, $indexPlayer)->name;

	$indexPlayer = $indexPlayer + 1;
	if($indexPlayer > 4) {
		$indexPlayer = 1;
	}

	if($i < 3) {
		echo '&nbsp;&rarr;&nbsp;';
	}
}

echo '</p>';

?>
