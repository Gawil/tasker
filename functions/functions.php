<?php
function getUserPasswd( $userName ) {
	$file=fopen("database/passwd", "r");
	$user=null;
	if ( $file !== false ) {
		while (!feof($file) && $user===null) {
			$line=fgets($file);
			$line=substr($line,0,strlen($line)-1);
			$info=explode( ':', $line);
			if( count($info) === 2 && $info[0]===$userName ) {
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
	$file=fopen("database/mail", "r");
	if ( $file !== false ) 
	{
		while (!feof($file) && $retour===0) 
		{
			$line=fgets($file);
			$line=substr($line,0,strlen($line)-1);
			if ( $line === $userMail )
			{
				$retour = 1;
			}
		}
		if ( $retour===1 ) 
		{
			if ( file_exists("database/$userName.usr") )
			{
				$retour = 2;
			}
		}
		else
		{
			$retour = 3;
		}
	}
	return $retour;	
}

function registerUser( $userMail, $userName, $userPasswd, $salt ) {
	$file = fopen("database/mail", "a+");
	if ( $file != null )
	{
		fputs( $file, "$userMail\0");
		fclose($file);
	}	
	
	$file = fopen("database/$userName.usr", "a+");
	if ( $file != null )
	{
		fputs( $file, "$userName:$userMail\0");
		fclose($file);
	}	
	
	$file=fopen("database/passwd", "a+");
	if ( $file != null )
	{
		$PasswdCrypt = sha1(sha1("$userPasswd"). $salt);
		fputs( $file, "$userName:$PasswdCrypt\0" );
		fclose($file);
	}	
}
?>
