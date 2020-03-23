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
$itemValAtout = array();
$itemNonValAtout = array();
$itemColor = array();
foreach ($json->items as $value) {
	$itemName[intval($value->id)] = $value->name;
	$itemValAtout[intval($value->id)] = intval($value->valAtout);
	$itemValNonAtout[intval($value->id)] = intval($value->valNonAtout);
	$itemColor[intval($value->id)] = intval($value->color);
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
			//echo "<ul>";
			
			$sortedContents = $value->contents;

			if(intval($value->sortedDisplay) != 0) {
				sort($value->contents);
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

                if(count($value->defaultMoveDest) == 0) {
                    echo $itemName[intval($itemId)] . $dstLink . "\n";
                } else if(count($value->defaultMoveDest) == 1) {
                    echo '<a href="javascript:move(' . $itemId . ',' . $currentSetId . ',' . $value->defaultMoveDest[0] . ');">' . $itemName[intval($itemId)] . $dstLink . '</a>';
                } else {
                    die('defaultMoveDest can contain 0 or 1 element.');
                }
			}

			//echo "</ul>";
		}
	}
}

if($playerId == 0) {
    echo '<h2>Compatage</h2>';

    // Display all sets this player can read
    foreach ($json->sets as $value) {
        $currentSetId = intval($value->id);

        if($currentSetId != 6 && $currentSetId != 7) {
            continue;
        }

        echo $value->name;

        echo '<ul><li>Tout atout: ';
        $sum = 0;
        foreach($value->contents as $itemId) {
            $sum += intval($itemValAtout[$itemId]);
        }
        echo $sum . '</li>';

        echo '<li>Sans atout: ';
        $sum = 0;
        foreach($value->contents as $itemId) {
            $sum += intval($itemValNonAtout[$itemId]);
        }
        echo $sum . '</li>';

        $colorName = array('', 'pique', 'coeur', 'trefle', 'carreau');
        for($color = 1; $color <= 4; $color++) {
            echo '<li>Atout ' . $colorName[$color] . ' : ';
            $sum = 0;
            foreach($value->contents as $itemId) {
                if($itemColor[$itemId] == $color) {
                    $sum += $itemValAtout[$itemId];
                } else {
                    $sum += $itemValNonAtout[$itemId];
                }
            }
            echo $sum . '</li>';
        }

        echo '</ul>';
    }
}

echo '<h2>Ordre du tour</h2><p>';

$indexPlayer = $json->firstPlayer;
for($i = 0; $i < 4; ++$i) {
	$indexPlayer = $indexPlayer + 1;
	if($indexPlayer > 4) {
		$indexPlayer = 1;
	}

	echo $json->players[$indexPlayer]->name;

	if($i < 3) {
		echo '&nbsp;&rarr;&nbsp;';
	}
}

echo '<p><b>' . $json->status . '</b></p>';

echo '</p>';

?>
