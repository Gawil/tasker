<!DOCTYPE html>
<html >
<?php
	include( 'functions/functionsUser.php');
	$file_id = fopen("database/config", "w");
		fprintf($file_id, "1\n");
	fclose($file_id);
	unlink("database/users/root/tasks/wip");
	unlink("database/wip/3");
	unlink("database/wip/4");
	unlink("database/wip/5");
	$errorLogin = NULL;
	$errorSubscription = NULL;
	$salt = "@68s?qed";
	//Mode Login/Sign In Test
	if ( !empty($_GET['mode']) ) {
		$mode = $_GET['mode'];
	}
	else {
		$mode ='login';
	}
	//Login Page Tests
	if ( $mode === 'login' ) {		
		if ( isset($_POST['userName']) AND isset($_POST['passwd']) ) {			
			if ( !empty($_POST['userName']) AND !empty($_POST['passwd']) ) {				
				$userInfo=getUserPasswd($_POST['userName']);
				if( $userInfo && sha1(sha1($_POST['passwd']). $salt) === $userInfo['hash'] ) {
					$errorLogin = 1;
				}
				else {
					$errorLogin = 2;
				}
			}
			else {
				if ( empty($_POST['userName']) ) {
					$errorLogin = 3;
				} else {
					$errorLogin = 4;
				}
			}
		}
	
	//Sign In Page Tests	
	}
	else {	
		if (isset($_POST['newUserMail']) AND isset($_POST['newUserName']) AND isset($_POST['newUserPasswd']))	{
			if (!empty($_POST['newUserMail']) AND !empty($_POST['newUserName']) AND !empty($_POST['newUserPasswd']) AND !empty($_POST['newUserPasswdBis']) AND ($_POST['newUserPasswd']==$_POST['newUserPasswdBis']) ) {
				$errorSubscription = checkExistingUser( $_POST['newUserName'], $_POST['newUserMail'] );
				if ($errorSubscription === 0) {
					registerUser( $_POST['newUserName'], $_POST['newUserMail'], $_POST['newUserPasswd'], $salt );
					$_SESSION['userName'] = $_POST['newUserName'];
					header('Location: crc/tasker.php');
				}
			}
			else {
				$errorSubscription = 4;
			}
		}
	}		
?>
	
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" href="css/index.css">
	</head>
	<body>
		<div class="container">
			<div id="login-form">
				<h3 id = "signin" <?php if($mode=='signin'){echo "style=\"background-color:#000\"";} ?> ><a class="choice" href="index.php?mode=signin">Sign in</a></h3>
				<h3 id = "login" <?php if($mode=='login'){echo "style=\"background-color:#000\"";} ?> ><a class="choice" href="index.php?mode=login">Login</a></h3>
				<?php
					if ( $mode === 'login' ) {
						include('html/login.php');
					}
					else {
						include('html/signin.php');
					}
				?>
			</div>
		</div>
	</body>
</html>
