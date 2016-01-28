<?php
/*----------------------------------------------------------------------*/
/*								Task Functions							*/
/*----------------------------------------------------------------------*/
function readTask($fichier) {
	fscanf($fichier, "%d", $id);
	echo "<h2 style=\"font-size: 35px; margin-bottom: 0px;\">Tache n°$id</h2>";
	$title = fgets($fichier);
	echo "<h2 style=\"font-size: 30px; margin-bottom: 0px;\">$title</h2>";
	$date = fgets($fichier);
	echo "<h3 style=\"font-size: 20px; text-align: right; margin-top: 0px;\">$date</h3>";
	$ligne = fgets($fichier);
	echo "<p>";
	while(!(feof($fichier)) && (substr($ligne, 0, 2) != "##")) {
		echo "$ligne";
		echo "<br />";
		$ligne = fgets($fichier);
	}
	echo "</p>";
	return ftell($fichier);
}
function readTaskFull($nomfichier, $cur) {
	$fichier = fopen($nomfichier, "r");
	fseek($fichier, $cur);
	if ($fichier) {
		fscanf($fichier, "%d", $id);
		echo "<h2 style=\"font-size: 35px; margin-bottom: 0px;\">Tache n°$id</h2>";
		$title = fgets($fichier);
		echo "<h2 style=\"font-size: 30px; margin-bottom: 0px;\">$title</h2>";
		$date = fgets($fichier);
		echo "<h3 style=\"font-size: 20px; text-align: right; margin-top: 0px;\">$date</h3>";
		$ligne = fgets($fichier);
		echo "<p>";
		while(!(feof($fichier)) && (substr($ligne, 0, 2) != "##")) {
			echo "$ligne";
			echo "<br />";
			$ligne = fgets($fichier);
		}
		echo "</p>";
		fclose($fichier);
	}
}

function createTask($folder, $title, $date, $content) {
	$fichier = fopen("../database/$folder/42", "a+");
	fprintf($fichier, "##\n42\n");
	fprintf($fichier, "%s\n", $title);
	fprintf($fichier, "%s\n", $date);
	fprintf($fichier, "%s\n", $content);
	fclose($fichier);
}

function date_isInf($date1, $date2) {
	$day1 = substr($date1, 0, 2);
	$month1 = substr($date1, 3, 2);
	$year1 = substr($date1, 6, 4);
	$day2 = substr($date2, 0, 2);
	$month2 = substr($date2, 3, 2);
	$year2 = substr($date2, 6, 4);
	
	if ($year1 == $year2) {
		if ($month1 == $month2) {
			$bool = ($day1 < $day2);
		}
		else {
			$bool = ($month1 < $month2);
		}
	}
	else {
		$bool = ($year1 < $year2);
	}
	return $bool;
}
?>
