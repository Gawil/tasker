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
	$retour = 0;
	$file=fopen("database/email", "r");
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
?>
