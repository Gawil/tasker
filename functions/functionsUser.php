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
