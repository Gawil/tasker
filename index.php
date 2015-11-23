<!DOCTYPE html>
<html >
<?php
	include( 'functions/functions.php');

<<<<<<< HEAD
<<<<<<< HEAD
	$validIDs = null;
	$errorSignin = null;
=======
	$validIDs = NULL;
=======
	$errorLogin = NULL;
>>>>>>> b19317e5a6c9d2cb3825131219287fe214732036
	$validSuscription1 = NULL;
	$validSuscription2 = NULL;
>>>>>>> db832305e63806698a159ab65c9f7b9cafe534d4
	$salt = "@68s?qed";
	
	//Mode Login/Sign In Test
	if ( !empty($_GET['mode']) ) 
	{
		$mode = $_GET['mode'];
	} 
	else 
	{
		$mode ='login';
	}

<<<<<<< HEAD
<<<<<<< HEAD
	if ( $mode === 'login' ) { 
		if (isset($_POST['userName']) AND isset($_POST['passwd']))
		{
			if (!empty($_POST['userName']) AND !empty($_POST['passwd']))
			{
				$userInfo=getUserPasswd($_POST['userName']);
			
				if( $userInfo && sha1(sha1($_POST['passwd']). $salt) === $userInfo['hash'] )
				{
					$validIDs = TRUE;
				}
				else
				{
					$validIDs = FALSE;
=======
=======
	//Login Page Tests
>>>>>>> b19317e5a6c9d2cb3825131219287fe214732036
	if ( $mode === 'login' ) 
	{		
		if ( isset($_POST['userName']) AND isset($_POST['passwd']) ) 
		{			
			if ( !empty($_POST['userName']) AND !empty($_POST['passwd']) ) 
			{				
				$userInfo=getUserPasswd($_POST['userName']);
				if( $userInfo && sha1(sha1($_POST['passwd']). $salt) === $userInfo['hash'] ) 
				{
<<<<<<< HEAD
					$validIDs = 1;
				} else {
					$validIDs = 2;
>>>>>>> db832305e63806698a159ab65c9f7b9cafe534d4
=======
					$errorLogin = 1;
				} 
				else 
				{
					$errorLogin = 2;
>>>>>>> b19317e5a6c9d2cb3825131219287fe214732036
				}
			} 
			else 
			{
				if ( empty($_POST['userName']) ) 
				{
					$errorLogin = 3;
				} 
				else 
				{
					$errorLogin = 4;
				}			
			}
		}
<<<<<<< HEAD
<<<<<<< HEAD
	}
	else
	{	
		if (isset($_POST['newUserMail']) AND isset($_POST['newUserName']) AND isset($_POST['newUserPasswd']))
		{
			if (!empty($_POST['newUserMail']) AND !empty($_POST['newUserName']) AND !empty($_POST['newUserPasswd']) AND !empty($_POST['newUserPasswdBis']))
			{
				if (!checkExistingUser( $_POST['newUserName'] ) )
				{
					if ($_POST['newUserPasswd'] == $_POST['newUserPasswdBis'])
					{
						registerUser( $_POST['newUserMail'], $_POST['newUserName'], $_POST['newUserPasswd'], $salt );
					}
					else
					{
						$errorSignin = 1;
					}
=======
		
=======
	
	//Sign In Page Tests	
>>>>>>> b19317e5a6c9d2cb3825131219287fe214732036
	} else {	
		if (isset($_POST['newUserMail']) AND isset($_POST['newUserName']) AND isset($_POST['newUserPasswd']))	{
			if (!empty($_POST['newUserMail']) AND !empty($_POST['newUserName']) AND !empty($_POST['newUserPasswd']) AND !empty($_POST['newUserPasswdBis']) AND ($_POST['newUserPasswd']==$_POST['newUserPasswdBis']) ) {
				if (!checkExistingUser( $_POST['newUserName'], $_POST['newUserName'] ) ) {
					registerUser( $_POST['newUserMail'], $_POST['newUserName'], $_POST['newUserPasswd'], $salt );
				} else {
					$validSuscription1 = FALSE;
>>>>>>> db832305e63806698a159ab65c9f7b9cafe534d4
				}
				else
				{
					$errorSignin = 2;
				}
			}
			else
			{
				$errorSignin = 3;
			}
		}
	}		
?>
	
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>pondre !";
						}
						if ( $error == 2 ) {
							echo "Votre nom d'utilisateur est déjà utilisé.";
=======
						if ( $validSuscription1 === FALSE ) {
=======
						if ( $validSuscription1 === FALSE )
						{
>>>>>>> b19317e5a6c9d2cb3825131219287fe214732036
							echo "Ce nom d'utilisateur est déjà utilisé";
>>>>>>> db832305e63806698a159ab65c9f7b9cafe534d4
						}
<<<<<<< HEAD
						if ( $error === 3 ) {
							echo "Veuillez renseigner TOUS les champs.";
=======
						if ( $validSuscription2 === FALSE )
						{
							echo "Veuillez renseigner les champs correctement";
>>>>>>> b19317e5a6c9d2cb3825131219287fe214732036
						}
					}
				?>
			</div>
		</div>
	</body>
</html>
