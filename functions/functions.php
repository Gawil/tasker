<?php
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
	$retour = 0;	// tout va bien
	$file = fopen("database/email", "r");
	if ( $file !== false ) {
		while (!feof($file) && $retour === 0) {
			$line=fgets($file);
			$line=substr($line,0,strlen($line)-1);
			if ( $line === $userMail ) {
				$retour = 1;	// adresse mail déjà utilisée
			}
		}
		if ( file_exists("database/$userName.usr") ) {
			if ( $retour === 1 ) {
				$retour = 2;	// adresse mail ET login déjà utilisés
			}
			else {
				$retour = 3;	// juste login déjà utilisé
			}
		}
	}
	return $retour;
}

function registerUser( $userName, $userMail, $userPasswd, $salt ) {
	$file = fopen("database/email", "a+");
	if ( $file != null )
	{
		fprintf( $file, "$userMail\n");
		fclose($file);
	}	
	
	$file = fopen("database/$userName.usr", "a+");
	if ( $file != null )
	{
		fprintf( $file, "$userName:$userMail\n");
		fclose($file);
	}	
	
	$file=fopen("database/passwd", "a+");
	if ( $file != null )
	{
		$PasswdCrypt = sha1(sha1("$userPasswd"). $salt);
		fprintf( $file, "$userName:$PasswdCrypt\n");
		fclose($file);
	}	
}

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

function createTask($filename, $title, $date, $content) {
	$fichier = fopen($filename, "a+");
	fprintf($fichier, "##\n42\n");
	fprintf($fichier, "%s\n", $title);
	fprintf($fichier, "%s\n", $date);
	fprintf($fichier, "%s\n", $content);
	fclose($fichier);
}
?>
