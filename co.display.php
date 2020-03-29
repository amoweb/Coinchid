<?php

function cardStr($json, $cardObj) {
    if($cardObj->color % 2 == 0) {
        $colorName = 'red';
    } else {
        $colorName = 'black';
    }

    $ownerName = '&nbsp;';
    if($cardObj->owner != 0) {
        $owner = getJsonElementById($json->players, $cardObj->owner);
        $ownerName = $owner->name;
    }

    return "<span class='cards' style='color:" . $colorName . ";'>"
        . $cardObj->name
        . "<br /><span class='player'>"
        . $ownerName
        . "</span>"
        . "</span>";
}

function countStr($json, $cardsList) {
    $str = '';
    $str .= '<ul><li>Tout atout: ';
    $sum = 0;

    foreach($cardsList as $itemId) {
        $sum += intval(getJsonElementById($json->items, $itemId)->valAtout);
    }
    $str .= $sum . '</li>';

    $str .= '<li>Sans atout: ';
    $sum = 0;
    foreach($cardsList as $itemId) {
        $sum += intval(getJsonElementById($json->items, $itemId)->valNonAtout);
    }
    $str .= $sum . '</li>';

    $colorName = array('', 'pique', 'coeur', 'trefle', 'carreau');
    for($color = 1; $color <= 4; $color++) {
        $str .= '<li>Atout ' . $colorName[$color] . ' : ';
        $sum = 0;
        foreach($cardsList as $itemId) {
            $card = getJsonElementById($json->items, $itemId);
            if($card->color == $color) {
                $sum += $card->valAtout;
            } else {
                $sum += $card->valNonAtout;
            }
        }
        $str .= $sum . '</li>';
    }

    $str .= '</ul>';

    return $str;
}

function sanitizePlayerName($name) {
    return preg_replace("/[^a-zA-Z0-9éèàëç]+/", "", $name);
}

?>

