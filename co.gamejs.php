<?php

/* Generate Js for card management
 * @param playerId id of the player (number)
 * @param gameId unique ID of the current game (string)
 * @param urlBasis
 */

function displayGameJsFunction($playerId, $gameId, $urlBasis) {
    $s = <<<JSSCR
var playerId = #playerId#;
var gameId = '#gameId#';
function update() {
	const Http = new XMLHttpRequest();
    const url='#URL_BASIS#reader.php?nocache=' + (new Date()).getTime() + '&game=' + gameId + '&player=' + playerId;
	Http.open("GET", url);
	Http.onreadystatechange = (e) => {
		if(Http.responseText.length == 0) {
			return;
		}
		if(document.getElementById("display").innerHTML.localeCompare(Http.responseText) != 0) {
			document.getElementById("display").innerHTML = Http.responseText;
		}
	}
	Http.send();
}

function move(item, src, dst) {
	var params = "src=" + src + "&dst=" + dst + "&item=" + item;

	const Http = new XMLHttpRequest();
    const url="#URL_BASIS#move.php?nocache=" + (new Date()).getTime() + "&game=" + gameId + "&player=" + playerId;
	Http.open("POST", url, true);
	Http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	Http.setRequestHeader("Connection", "close");
	Http.onload = function () {
		// do something to response
		console.log(this.responseText);
	};

	Http.send(params);
    update();
}

function moveAll(src, dst) {
	var params = "src=" + src + "&dst=" + dst + "&all=1"

	const Http = new XMLHttpRequest();
    const url="#URL_BASIS#move.php?nocache=" + (new Date()).getTime() + "&game=" + gameId + "&player=" + playerId;
	Http.open("POST", url, true);
	Http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	Http.setRequestHeader("Connection", "close");
	Http.onload = function () {
		// do something to response
		console.log(this.responseText);
	};

	Http.send(params);
}

function cardsAction(act) {
	const Http = new XMLHttpRequest();
	const url='#URL_BASIS#' + act + '.php?nocache=' + (new Date()).getTime() + '&game=' + gameId;
	Http.open("GET", url);
	Http.onreadystatechange = (e) => {
		if(Http.responseText.length == 0) {
			return;
		}
		if(document.getElementById("display").innerHTML.localeCompare(Http.responseText) != 0) {
			document.getElementById("display").innerHTML = Http.responseText;
		}
	}
	Http.send();
}



setInterval ( 'update()', 1000 );
JSSCR;

    $s = str_replace('#playerId#', $playerId, $s);
    $s = str_replace('#gameId#', $gameId, $s);
    $s = str_replace('#URL_BASIS#', $urlBasis, $s);

    echo $s;
}

?>

