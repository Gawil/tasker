<?php
/*----------------------------------------------------------------------*/
/*						Register and Login Functions					*/
/*----------------------------------------------------------------------*/
function getUserPasswd( $userName ) {
	$file=fopen("database/passwd", "r");
	$user=null;
	if ( $file !== false ) {
		while (!feof($file) && $user === null) {
			$line=fgets($file);
			$line=substr($line,0,strlen($line)-1);
			$info=explode( ':', $line);
			if( count($info) === 2 && $info[0] === $userName ) {
				$user=array(
					'name' => $userName,
					'hash' => $info[1]
				);
			}
		}
		fclose($file);
	}
	return $user;
}
function checkExistingUser( $userName, $userMail ) 
{
	$retour = 0;	// everything is alright
	$file = fopen("database/email", "r");
	if ( $file !== false ) {
		while (!feof($file) && $retour === 0) {
			$line=fgets($file);
			$line=substr($line,0,strlen($line)-1);
			if ( $line === $userMail ) {
				$retour = 1;	// e-mail adress already used
			}
		}
		if ( file_exists("database/$userName.usr") ) {
			if ( $retour === 1 ) {
				$retour = 2;	// e-mail adress and login already used
			}
			else {
				$retour = 3;	// login already used
			}
		}
	}
	return $retour;
}
function registerUser( $userName, $userMail, $userPasswd, $salt ) {
/* registering e-mail adress in database */
	$file = fopen("database/email", "a+");
	if ( $file != null )
	{
		fprintf( $file, "$userMail\n");
		fclose($file);
	}	
/* creating user file in database */	
	$file = fopen("database/$userName.usr", "a+");
	if ( $file != null )
	{
		fprintf( $file, "$userName:$userMail\n");
		fclose($file);
	}	
/* registering user's password in database */	
	$file=fopen("database/passwd", "a+");
	if ( $file != null )
	{
		$PasswdCrypt = sha1(sha1("$userPasswd"). $salt);
		fprintf( $file, "$userName:$PasswdCrypt\n");
		fclose($file);
	}	
}
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
	echo coucou;
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
