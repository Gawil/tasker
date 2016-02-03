<?php
/*----------------------------------------------------------------------*/
/*								Task Functions							*/
/*----------------------------------------------------------------------*/
function readTask($fichier) {
	$title = fgets($fichier);
	echo "<h2 style=\"font-size: 35px; margin-bottom: 0px;\">$title</h2>";
	$datedeb = fgets($fichier);
	$datefin = fgets($fichier);
	if ($datedeb != $datefin) {
		echo "<h3 style=\"font-size: 20px; text-align: right; margin-top: 0px;\">$datedeb - $datefin</h3>";
	}
	else {
		echo "<h3 style=\"font-size: 20px; text-align: right; margin-top: 0px;\">$datedeb</h3>";
	}
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
		echo "<h2 style=\"font-size: 40px; margin-bottom: 0px;\">$title</h2>";
		echo "<br/>";
		$datedeb = fgets($fichier);
		$datefin = fgets($fichier);
		if ($datedeb != $datefin) {
			echo "<h3 style=\"font-size: 20px; text-align: right; margin-top: 0px;\">Date de début : $datedeb</h3>";
			echo "<h3 style=\"font-size: 20px; text-align: right; margin-top: 0px;\">Date de fin : $datefin</h3>";
		}
		else {
			echo "<h3 style=\"font-size: 20px; text-align: right; margin-top: 0px;\">Date : $datedeb</h3>";
		}
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

function createTask($folder, $title, $datedeb, $datefin, $content, $user, $id) {
	$file_user = fopen("database/users/$user/tasks/$folder", "a+");
		fprintf($file_user, "%d\n", $id);
	fclose($file_user);
	$file = fopen("database/$folder/$id", "w");
		fprintf($file, "%s\n", $title);
		fprintf($file, "%s\n", $datedeb);
		fprintf($file, "%s\n", $datefin);
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

function deleteTask($user, $folder, $id) {
	if (file_exists("database/users/$user/tasks/$folder")) {
		$file = fopen("database/users/$user/tasks/$folder", "r");
		if ($file) {
			$found = 0;
			$line = 0;
			while (!feof($file) && $found === 0) {
				fscanf($file, "%d", $id_read);
				if ($id_read == $id) {
					$found = 1;		//line found
				}
				else {
					$line++;
				}
			}
			if ($id_read == $id) {
				rewind($file);
				$content = fread($file, filesize("database/users/$user/tasks/$folder"));
				fclose($file);
				unlink("database/users/$user/tasks/$folder");
				$content = explode(PHP_EOL, $content);
				unset($content[$line]);
				$content = array_values($content);
				$content = implode(PHP_EOL, $content);
				if ($content != "") {
					$file = fopen("database/users/$user/tasks/$folder", "w");
						fwrite($file, $content);
					fclose($file);
				}
				if (file_exists("database/$folder/$id")) {
					unlink("database/$folder/$id");
				}
			}
		}
	}
}

/*
* Insert arbitrary text into any place inside a text file
*
* $file_path - absolute path to the file
* $insert_marker - a marker inside the file to look for as a pattern match
* $text - text to be inserted
* $after - whether to insert text after (true) or before (false) the marker.
* By default, the text is inserted after the marker.
* return the number of bytes written to the file
*/
function insert_into_file($file_path, $insert_marker, $text, $after = true) {
	$contents = file_get_contents($file_path);
	$new_contents = preg_replace($insert_marker, ($after) ? '$0' . $text : $text . '$0', $contents);
	return file_put_contents($file_path, $new_contents);
}

function rmdir_and_contents($path) {
	if (is_dir($path) === true) {
		$files = array_diff(scandir($path), array('.', '..'));
		foreach ($files as $file) {
			rmdir_and_contents(realpath($path) . '/' . $file);
        }
		return rmdir($path);
	}
	else if (is_file($path) === true) {
		return unlink($path);
	}
	return false;
}

function clear_database() {
	$folds = array_diff(scandir("database/users"), array('.', '..'));
	foreach ($folds as $item) {
		rmdir_and_contents("database/users/$item");
	}
	$tasks = array_diff(scandir("database/done"), array('.', '..'));
	foreach ($tasks as $item) {
		unlink("database/done/$item");
	}
	$tasks = array_diff(scandir("database/wip"), array('.', '..'));
	foreach ($tasks as $item) {
		unlink("database/wip/$item");
	}
	$tasks = array_diff(scandir("database/dead"), array('.', '..'));
	foreach ($tasks as $item) {
		unlink("database/dead/$item");
	}
	$tasks = array_diff(scandir("database/todo"), array('.', '..'));
	foreach ($tasks as $item) {
		unlink("database/todo/$item");
	}
	unlink("database/email");
	unlink("database/passwd");
	touch("database/email");
	touch("database/passwd");
	unlink("database/config");
	$file = fopen("database/config", "w");
		fprintf($file, "1\n");
	fclose($file);
	registerUser("root", "root@admin", "azertyuiop", "@68s?qed" );
}
?>
