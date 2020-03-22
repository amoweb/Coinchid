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
				<a class="nav-link" href="" >...</a>
			</li>
		</ul>
	</div>
</nav>

<?php
$game = 1;
if(array_key_exists('game', $_GET) && $_GET['game']) {
	$game = intval($_GET['game']);
}
?>

<h1>Liens</h1>

<ul>
<li><a href="https://amoweb.fr/coinche/joueur.php?game=<?php echo $game; ?>&player=1">Joueur 1</a>
	<li><a href="https://amoweb.fr/coinche/joueur.php?game=<?php echo $game; ?>&player=2">Joueur 2</a></li>
	<li><a href="https://amoweb.fr/coinche/joueur.php?game=<?php echo $game; ?>&player=3">Joueur 3</a></li>
	<li><a href="https://amoweb.fr/coinche/joueur.php?game=<?php echo $game; ?>&player=4">Joueur 4</a></li>
	<li><a href="https://amoweb.fr/coinche/game.php?game=<?php echo $game; ?>&player=1">Admin</a></li>

</ul>

</body>
</html>
