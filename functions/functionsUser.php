<?php
/*----------------------------------------------------------------------*/
/*						Register and Login Functions					*/
/*----------------------------------------------------------------------*/

//---------------------------------------------------------
// Getting User's Password Function
//---------------------------------------------------------
function getUserPasswd( $userName )
{
	$file=fopen("database/passwd", "r");
	$user=null;
	if ( $file !== false ) {
		while (!feof($file) && $user === null)
		{
			$line=fgets($file);
			$line=substr($line,0,strlen($line)-1);
			$info=explode( ':', $line);
			if( count($info) === 2 && $info[0] === $userName )
			{
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

//---------------------------------------------------------
// Checking User Existence Function
//---------------------------------------------------------
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
		if ( file_exists("database/users/$userName") ) {
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

//---------------------------------------------------------
// Registrating New User Function
//---------------------------------------------------------
function registerUser( $userName, $userMail, $userPasswd, $salt ) 
{
	$fileMail = fopen("database/email", "a+");
	if ( $fileMail != null)
	{
		$fileName = fopen("database/users/$userName/$userName.usr", "a+");
		if ( $fileName != null)
		{
			$filePasswd=fopen("database/passwd", "a+");
			if (  $filePasswd != null )
			{
				/* creating user file in database */
				mkdir("database/users/$userName", 0755);
				mkdir("database/users/$userName/tasks", 0755);
				/* registering e-mail adress in database */
				fprintf( $fileMail, "$userMail\n");
				fprintf( $fileName, "$userName:$userMail\n");
				/* registering user's password in database */
				$PasswdCrypt = sha1(sha1("$userPasswd"). $salt);
				fprintf( $filePasswd, "$userName:$PasswdCrypt\n");
				fclose($fileName);
			}
			fclose($fileMail);
		}
		fclose($filePasswd);
	}
}
