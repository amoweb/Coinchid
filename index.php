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
				<a class="nav-link" href="javascript:distribuer();" >Distribuer</a>
			</li>
		</ul>
	</div>
</nav>

<h2>Equipe 1</h2>
<a href='javascript:peuplerTas(1, "V♠ ");'>V♠ </a>
&nbsp;<a href='javascript:peuplerTas(1, "9♠ ");'>9♠ </a>
&nbsp;<a href='javascript:peuplerTas(1, "A♠ ");'>A♠ </a>
&nbsp;<a href='javascript:peuplerTas(1, "10♠ ");'>10♠ </a>
&nbsp;<a href='javascript:peuplerTas(1, "R♠ ");'>R♠ </a>
&nbsp;<a href='javascript:peuplerTas(1, "D♠ ");'>D♠ </a>
&nbsp;<a href='javascript:peuplerTas(1, "8♠ ");'>8♠ </a>
&nbsp;<a href='javascript:peuplerTas(1, "7♠ ");'>7♠ </a>
<br />
<a href='javascript:peuplerTas(1, "V♥ ");'>V♥ </a>
&nbsp;<a href='javascript:peuplerTas(1, "9♥ ");'>9♥ </a>
&nbsp;<a href='javascript:peuplerTas(1, "A♥ ");'>A♥ </a>
&nbsp;<a href='javascript:peuplerTas(1, "10♥ ");'>10♥ </a>
&nbsp;<a href='javascript:peuplerTas(1, "R♥ ");'>R♥ </a>
&nbsp;<a href='javascript:peuplerTas(1, "D♥ ");'>D♥ </a>
&nbsp;<a href='javascript:peuplerTas(1, "8♥ ");'>8♥ </a>
&nbsp;<a href='javascript:peuplerTas(1, "7♥ ");'>7♥ </a>
<br />
<a href='javascript:peuplerTas(1, "V♦");'>V♥ </a>
&nbsp;<a href='javascript:peuplerTas(1, "9♦");'>9♦</a>
&nbsp;<a href='javascript:peuplerTas(1, "A♦");'>A♦</a>
&nbsp;<a href='javascript:peuplerTas(1, "10♦");'>10♦</a>
&nbsp;<a href='javascript:peuplerTas(1, "R♦");'>R♦</a>
&nbsp;<a href='javascript:peuplerTas(1, "D♦");'>D♦</a>
&nbsp;<a href='javascript:peuplerTas(1, "8♦");'>8♦</a>
&nbsp;<a href='javascript:peuplerTas(1, "7♦");'>7♦</a>
<br />
<a href='javascript:peuplerTas(1, "V♣ ");'>V♥ </a>
&nbsp;<a href='javascript:peuplerTas(1, "9♣ ");'>9♣ </a>
&nbsp;<a href='javascript:peuplerTas(1, "A♣ ");'>A♣ </a>
&nbsp;<a href='javascript:peuplerTas(1, "10♣ ");'>10♣ </a>
&nbsp;<a href='javascript:peuplerTas(1, "R♣ ");'>R♣ </a>
&nbsp;<a href='javascript:peuplerTas(1, "D♣ ");'>D♣ </a>
&nbsp;<a href='javascript:peuplerTas(1, "8♣ ");'>8♣ </a>
&nbsp;<a href='javascript:peuplerTas(1, "7♣ ");'>7♣ </a>
<br />

Tas : <div id="equipe1cartes"></div>

<a href="javascript:effacerTas(1);">&larr;Effacer</a>
<br />

<h2>Equipe 2</h2>
<a href='javascript:peuplerTas(2, "V♠ ");'>V♠ </a>
&nbsp;<a href='javascript:peuplerTas(2, "9♠ ");'>9♠ </a>
&nbsp;<a href='javascript:peuplerTas(2, "A♠ ");'>A♠ </a>
&nbsp;<a href='javascript:peuplerTas(2, "10♠ ");'>10♠ </a>
&nbsp;<a href='javascript:peuplerTas(2, "R♠ ");'>R♠ </a>
&nbsp;<a href='javascript:peuplerTas(2, "D♠ ");'>D♠ </a>
&nbsp;<a href='javascript:peuplerTas(2, "8♠ ");'>8♠ </a>
&nbsp;<a href='javascript:peuplerTas(2, "7♠ ");'>7♠ </a>
<br />
<a href='javascript:peuplerTas(2, "V♥ ");'>V♥ </a>
&nbsp;<a href='javascript:peuplerTas(2, "9♥ ");'>9♥ </a>
&nbsp;<a href='javascript:peuplerTas(2, "A♥ ");'>A♥ </a>
&nbsp;<a href='javascript:peuplerTas(2, "10♥ ");'>10♥ </a>
&nbsp;<a href='javascript:peuplerTas(2, "R♥ ");'>R♥ </a>
&nbsp;<a href='javascript:peuplerTas(2, "D♥ ");'>D♥ </a>
&nbsp;<a href='javascript:peuplerTas(2, "8♥ ");'>8♥ </a>
&nbsp;<a href='javascript:peuplerTas(2, "7♥ ");'>7♥ </a>
<br />
<a href='javascript:peuplerTas(2, "V♦");'>V♥ </a>
&nbsp;<a href='javascript:peuplerTas(2, "9♦");'>9♦</a>
&nbsp;<a href='javascript:peuplerTas(2, "A♦");'>A♦</a>
&nbsp;<a href='javascript:peuplerTas(2, "10♦");'>10♦</a>
&nbsp;<a href='javascript:peuplerTas(2, "R♦");'>R♦</a>
&nbsp;<a href='javascript:peuplerTas(2, "D♦");'>D♦</a>
&nbsp;<a href='javascript:peuplerTas(2, "8♦");'>8♦</a>
&nbsp;<a href='javascript:peuplerTas(2, "7♦");'>7♦</a>
<br />
<a href='javascript:peuplerTas(2, "V♣ ");'>V♥ </a>
&nbsp;<a href='javascript:peuplerTas(2, "9♣ ");'>9♣ </a>
&nbsp;<a href='javascript:peuplerTas(2, "A♣ ");'>A♣ </a>
&nbsp;<a href='javascript:peuplerTas(2, "10♣ ");'>10♣ </a>
&nbsp;<a href='javascript:peuplerTas(2, "R♣ ");'>R♣ </a>
&nbsp;<a href='javascript:peuplerTas(2, "D♣ ");'>D♣ </a>
&nbsp;<a href='javascript:peuplerTas(2, "8♣ ");'>8♣ </a>
&nbsp;<a href='javascript:peuplerTas(2, "7♣ ");'>7♣ </a>
<br />

Tas : <div id="equipe2cartes"></div>

<a href="javascript:effacerTas(2);">&larr;Effacer</a>
<br />

</body>

<script type="text/javascript">

function distribuer() {
	var equipe1tas = document.getElementById("equipe1cartes").innerHTML;
	var equipe2tas = document.getElementById("equipe2cartes").innerHTML;
	var params = "equipe1=" + equipe1tas + "&equipe2=" + equipe2tas;

	const Http = new XMLHttpRequest();
	const url="http://localhost/coinche/distribuer.php";
	Http.open("POST", url, true);
	Http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	Http.setRequestHeader("Content-length", params.length);
	Http.setRequestHeader("Connection", "close");
	Http.onload = function () {
		// do something to response
		console.log(this.responseText);
	};

	Http.send(params);
}

function peuplerTas(equipe, carte) {
	document.getElementById("equipe" + equipe + "cartes").innerHTML =
		document.getElementById("equipe" + equipe + "cartes").innerHTML + 
		carte + ",";
}

function effacerTas(equipe, carte) {
	var tas = document.getElementById("equipe" + equipe + "cartes").innerHTML;

	var newTas = tas.substring(0, tas.substring(0, tas.length - 1).lastIndexOf(","));

	document.getElementById("equipe" + equipe + "cartes").innerHTML = newTas;
}

</script>

</html>
