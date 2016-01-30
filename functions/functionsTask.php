<?php
/*----------------------------------------------------------------------*/
/*								Task Functions							*/
/*----------------------------------------------------------------------*/
function readTask($fichier) {
	$title = fgets($fichier);
	echo "<h2 style=\"font-size: 35px; margin-bottom: 0px;\">$title</h2>";
	$date = fgets($fichier);
	echo "<h3 style=\"font-size: 20px; text-align: right; margin-top: 0px;\">$date</h3>";
	$ligne = fgets($fichier);
	echo "<p>";
	while(!(feof($fichier))) {
		echo "$ligne";
		echo "<br />";
		$ligne = fgets($fichier);
	}
	echo "</p>";
}

function readTaskFull($folder, $id) {
	$fichier = fopen("$folder/$id", "r");
	if ($fichier) {
		$title = fgets($fichier);
		echo "<h2 style=\"font-size: 35px; margin-bottom: 0px;\">$title</h2>";
		$date = fgets($fichier);
		echo "<h3 style=\"font-size: 20px; text-align: right; margin-top: 0px;\">$date</h3>";
		$ligne = fgets($fichier);
		echo "<p>";
		while(!(feof($fichier))) {
			echo "$ligne";
			echo "<br />";
			$ligne = fgets($fichier);
		}
		echo "</p>";
		fclose($fichier);
	}
}

function createTask($folder, $title, $date, $content, $user) {
	$file_id = fopen("../database/config", "r+");
		$id = fgetc($file_id);
		rewind($file_id);
		fprintf($file_id, "%d", $id+1);
	fclose($file_id);
	$file_user = fopen("../database/users/$user/tasks/$folder", "a+");
		fprintf($file_user, "%d\n", $id);
	fclose($file_user);
	$file = fopen("../database/$folder/$id", "w");
		fprintf($file, "%s\n", $title);
		fprintf($file, "%s\n", $date);
		fprintf($file, "%s\n", $content);
	fclose($file);
	
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
