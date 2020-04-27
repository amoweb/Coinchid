<?php include 'co.lib.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap.min.css" />
<link rel="stylesheet" href="style.css" />

<style>
html, body, .container {
  height: 100%;
}
</style>

</head>
<body>

<nav class="navbar navbar-expand navbar-dark bg-dark">
	<a class="navbar-brand" href="#"><div id="noteName"></div></a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarsExample02">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link " href="javascript:distribuer();" >Distribuer</a>
			</li>
		</ul>
	</div>
</nav>

<div id="display"></div>

</body>

<script type="text/javascript">

<?php
$game = null;
if(array_key_exists('game', $_GET) && $_GET['game']) {
	$game = sanitizeGameId($_GET['game']);
} else {
	return;
}

echo 'var playerId = 0;';
echo 'var gameId = "' . $game . '";';
?>

function update() {
	const Http = new XMLHttpRequest();
    const url='<?php echo $URL_BASIS; ?>reader.php?nocache=' + (new Date()).getTime() + '&game=' + gameId + '&player=' + playerId;
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
	const url="<?php echo $URL_BASIS; ?>move.php?nocache=" + (new Date()).getTime() + "&game=" + gameId + "&player=" + playerId;
	Http.open("POST", url, true);
	Http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	Http.setRequestHeader("Connection", "close");
	Http.onload = function () {
		// do something to response
		console.log(this.responseText);
	};

	Http.send(params);
}

function moveAll(src, dst) {
	var params = "src=" + src + "&dst=" + dst + "&all=1"

	const Http = new XMLHttpRequest();
	const url="<?php echo $URL_BASIS; ?>move.php?nocache=" + (new Date()).getTime() + "&game=" + gameId + "&player=" + playerId;
	Http.open("POST", url, true);
	Http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	Http.setRequestHeader("Connection", "close");
	Http.onload = function () {
		// do something to response
		console.log(this.responseText);
	};

	Http.send(params);
}
setInterval ( 'update()', 1000 );

function distribuer() {
	const Http = new XMLHttpRequest();
	const url='<?php echo $URL_BASIS; ?>distribuer.php?nocache=' + (new Date()).getTime() + '&game=' + gameId;
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

</script>

</html>
