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

function checkExistingUser( $userMail ) {
	$bool = FALSE;
	if ( file_exists("database/$userMail.usr") )
	{
		$bool = TRUE;
	}
	return $bool;	
}

function registerUser(  $userMail, $userName, $userPasswd, $salt ) {
	$file = fopen("database/$userName.usr", "x");
	if ( $file != null )
	{
		fputs( $file, '$userName\0');
	}	
	fclose($file);
	$file=fopen("database/passwd", "a");
	if ( $file != null )
	{
		$PasswdCrypt = sha1(sha1('$userPasswd'). $salt);
		fputs( $file, '$userMail:$PasswdCrypt\0');
	}	
}
?>
