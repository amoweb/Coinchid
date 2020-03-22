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

<div id="display"></div>

</body>

<script type="text/javascript">

function update() {
	const Http = new XMLHttpRequest();
	const url='http://localhost/coinche/reader.php?game=1&player=' + noteName;
	Http.open("GET", url);
	Http.onreadystatechange = (e) => {
		document.getElementById("display").innerHTML = Http.responseText;
	}
	Http.send();
}

</script>

</html>
