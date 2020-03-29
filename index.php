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

<h1>Coinche</h1>

<h2>Créer une nouvelle partie</h2>

<form action="create.php" method="post">
Nom 1 : <input type="text" id="name1" name="name1" size="10" value="Joueur 1"><br />
Nom 2 : <input type="text" id="name2" name="name2" size="10" value="Joueur 2"><br />
Nom 3 : <input type="text" id="name3" name="name3" size="10" value="Joueur 3"><br />
Nom 4 : <input type="text" id="name4" name="name4" size="10" value="Joueur 4"><br />
<input type="submit" value="Créer la partie">
</form>

<br />
<h2>Rejoindre une partie existante</h2>

<form action="join.php" method="get">
Id : <input type="text" name="game" id="game" size="10"> <input type="submit" value="Rejoindre">
</form>
<br />

</body>
</html>
