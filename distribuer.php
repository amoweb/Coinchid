<?php
$cartes = $_POST['equipe1'] . $_POST['equipe2'];

$aCartes = explode(",", $cartes);
$aCartes = array_splice($aCartes, 0, count($aCartes) - 1);

$coupe = rand(1, 30);

if($coupe < count($aCartes)) {
	$cartesCoupees = array();

	foreach (array_slice($aCartes, $coupe) as $c) {
		$cartesCoupees[] = $c;
	}
	foreach (array_slice($aCartes, 0, $coupe) as $c) {
		$cartesCoupees[] = $c;
	}

	foreach ($cartesCoupees as $c) {
		echo $c;
	}
}

?>

