<!DOCTYPE html>
<html >
<?php

	include( 'functions/functions.php');

	$validIDs = null;
	$validSuscription1 = null;
	$validSuscription2 = null;
	$salt = "@68s?qed";

	if ( !empty($_GET['mode']) ) {
		$mode = $_GET['mode'];
	} else {
		$mode ='login';
	}

	if ( $mode === 'login' ) { 
		if (isset($_POST['userName']) AND isset($_POST['passwd'])) {
			if (!empty($_POST['userName']) AND !empty($_POST['passwd'])) {
				$userInfo=getUserPasswd($_POST['userName']);
			
				if( $userInfo && sha1(sha1($_POST['passwd']). $salt) === $userInfo['hash'] ) {
					$validIDs = TRUE;
				} else {
					$validIDs = FALSE;
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
						if ($validIDs === TRUE) {
							$_SESSION['userName'] = $_POST['userName'];
							header('Location: crc/cible.php');
						} elseif ($validIDs === FALSE) {
							echo "Veuillez entrer vos identifiants correctement";
						}
					} else {
						include('html/signin.html');
						if ( $validSuscription1 === FALSE ) {
							echo "Cette adresse mail est déjà utilisée";
						}
						if ( $validSuscription2 === FALSE ) {
							echo "Veuillez renseigner les champs correctement";
						}
					}
				?>
			</div>
		</div>
	</body>
</html>
