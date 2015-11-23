<!DOCTYPE html>
<html >
<?php

	include( 'functions/functions.php');

<<<<<<< HEAD
	$validIDs = null;
	$errorSignin = null;
=======
	$validIDs = NULL;
	$validSuscription1 = NULL;
	$validSuscription2 = NULL;
>>>>>>> db832305e63806698a159ab65c9f7b9cafe534d4
	$salt = "@68s?qed";

	if ( !empty($_GET['mode']) ) 
	{
		$mode = $_GET['mode'];
	} else {
		$mode ='login';
	}

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
	if ( $mode === 'login' ) 
	{		
		if ( isset($_POST['userName']) AND isset($_POST['passwd']) ) 
		{			
			if ( !empty($_POST['userName']) AND !empty($_POST['passwd']) ) 
			{				
				$userInfo=getUserPasswd($_POST['userName']);
				if( $userInfo && sha1(sha1($_POST['passwd']). $salt) === $userInfo['hash'] ) 
				{
					$validIDs = 1;
				} else {
					$validIDs = 2;
>>>>>>> db832305e63806698a159ab65c9f7b9cafe534d4
				}
			} else {
				if ( empty($_POST['userName']) ) 
				{
					$validIDs = 3;
				} else {
					$validIDs = 4;
				}			
			}
		}
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
		
	} else {	
		if (isset($_POST['newUserMail']) AND isset($_POST['newUserName']) AND isset($_POST['newUserPasswd']))	{
			if (!empty($_POST['newUserMail']) AND !empty($_POST['newUserName']) AND !empty($_POST['newUserPasswd']) AND !empty($_POST['newUserPasswdBis']) AND ($_POST['newUserPasswd']==$_POST['newUserPasswdBis']) ) {
				if (!checkExistingUser( $_POST['newUserName'] ) ) {
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
	<body>
		<div class="container">
			<div id="login-form">
				<h3 id = "signin" <?php if($mode=='signin'){echo "style=\"background-color:#000\"";} ?> ><a class="choice" href="index.php?mode=signin">Sign in</a></h3>
				<h3 id = "login" <?php if($mode=='login'){echo "style=\"background-color:#000\"";} ?> ><a class="choice" href="index.php?mode=login">Login</a></h3>
				<?php
					if ( $mode === 'login' ) {
						include('html/login.html');
						if ($validIDs === 1) {
							$_SESSION['userName'] = $_POST['userName'];
							header('Location: crc/cible.php');
						} elseif ($validIDs === 2) {
							echo "Combinaison nom d'utilisateur/mot de passe incorrecte";
						}
						if ($validIDs === 3) {
							echo "Veuillez entrer un nom d'utilisateur";
						} elseif ( $validIDs === 4 ) {
							echo "Veuillez entrer un mot de passe";
						}
					} else {
						include('html/signin.html');
<<<<<<< HEAD
						if ( $error == 1 ) {
							echo "Les mots de passe doivent correspondre !";
						}
						if ( $error == 2 ) {
							echo "Votre nom d'utilisateur est déjà utilisé.";
=======
						if ( $validSuscription1 === FALSE ) {
							echo "Ce nom d'utilisateur est déjà utilisé";
>>>>>>> db832305e63806698a159ab65c9f7b9cafe534d4
						}
						if ( $error === 3 ) {
							echo "Veuillez renseigner TOUS les champs.";
						}
					}
				?>
			</div>
		</div>
	</body>
</html>
