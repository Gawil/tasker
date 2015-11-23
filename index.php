<!DOCTYPE html>
<html >
<?php

	include( 'functions/functions.php');

	$errorLogin = NULL;
	$validSuscription1 = NULL;
	$validSuscription2 = NULL;
	$salt = "@68s?qed";

	if ( !empty($_GET['mode']) ) 
	{
		$mode = $_GET['mode'];
	} 
	else 
	{
		$mode ='login';
	}

	if ( $mode === 'login' ) 
	{		
		if ( isset($_POST['userName']) AND isset($_POST['passwd']) ) 
		{			
			if ( !empty($_POST['userName']) AND !empty($_POST['passwd']) ) 
			{				
				$userInfo=getUserPasswd($_POST['userName']);
				if( $userInfo && sha1(sha1($_POST['passwd']). $salt) === $userInfo['hash'] ) 
				{
					$errorLogin = 1;
				} 
				else 
				{
					$errorLogin = 2;
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
		
	} else {	
		if (isset($_POST['newUserMail']) AND isset($_POST['newUserName']) AND isset($_POST['newUserPasswd']))	{
			if (!empty($_POST['newUserMail']) AND !empty($_POST['newUserName']) AND !empty($_POST['newUserPasswd']) AND !empty($_POST['newUserPasswdBis']) AND ($_POST['newUserPasswd']==$_POST['newUserPasswdBis']) ) {
				if (!checkExistingUser( $_POST['newUserName'] ) ) {
					registerUser( $_POST['newUserMail'], $_POST['newUserName'], $_POST['newUserPasswd'], $salt );
				} else {
					$validSuscription1 = FALSE;
				}
			} else {
				$validSuscription2 = FALSE;
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
						if ($errorLogin === 1) {
							$_SESSION['userName'] = $_POST['userName'];
							header('Location: crc/cible.php');
						} 
						elseif ($errorLogin === 2) 
						{
							echo "Combinaison nom d'utilisateur/mot de passe incorrecte";
						}
						if ($errorLogin === 3) 
						{
							echo "Veuillez entrer un nom d'utilisateur";
						} 
						elseif ( $errorLogin === 4 ) 
						{
							echo "Veuillez entrer un mot de passe";
						}
					} 
					else 
					{
						include('html/signin.html');
						if ( $validSuscription1 === FALSE )
						{
							echo "Ce nom d'utilisateur est déjà utilisé";
						}
						if ( $validSuscription2 === FALSE )
						{
							echo "Veuillez renseigner les champs correctement";
						}
					}
				?>
			</div>
		</div>
	</body>
</html>
