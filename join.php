<?php include 'co.lib.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap.min.css" />

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
				<a class="nav-link" href="" ></a>
			</li>
		</ul>
	</div>
</nav>

<?php
$game = null;
if(array_key_exists('game', $_GET) && $_GET['game']) {
	$game = sanitizeGameId($_GET['game']);
}

$game = null;
if(array_key_exists('game', $_GET) && $_GET['game']) {
	$game = sanitizeGameId($_GET['game']);
}
?>

<h1>Coinche</h1>

<h2>Sélectionnez votre nom</h2>

<ul>
<?php 
    $fileName = "game" . $game . ".json";
    $json = readJson($fileName);

    echo '<li><a href="' . $URL_BASIS . 'game.php?game=' . $game . '&player=0">Gestion du jeu</a>';

    for($i = 1; $i <= 4; $i++) {
        $p = getJsonElementById($json->players, $i);
        echo '<li><a href="' . $URL_BASIS . 'player.php?game=' . $game . '&player=' . $i . '">';
        echo $p->name;
        echo '</a></li>';
    }
?>
</ul>

</body>
</html>
