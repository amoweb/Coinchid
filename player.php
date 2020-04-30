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
			<li class="nav-item">
			</li>
		</ul>
	</div>
</nav>

<div id="display"></div>

</body>

<script type="text/javascript">

<?php
$playerId = -1;
if(array_key_exists('player', $_GET) && $_GET['player']) {
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

displayGameJsFunction($playerId, $game, $URL_BASIS);

?>

</script>

</html>
