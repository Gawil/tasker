<!DOCTYPE html>
<html >
<?php
//---------------------------------------------------------
// Cookie for the language
//---------------------------------------------------------
	if(isset($_COOKIE['lang']))
	{
		$lang = $_COOKIE['lang'];
	} else { // If no language is declared, attempts to recognize the default language of the browser 
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2); 
	}
// cookie's expiration time (1 year)
	$expire = 365*24*3600; 

//---------------------------------------------------------
// Include of the right language file
//---------------------------------------------------------	
$lang='fr';
	if ($lang=='fr')
	{           
		include('database/lang/fr.php'); 
	} else { // english is the default language
		include('database/lang/en.php'); 
	}

/*----------------------------------------------------------------------*/
/*							Page Main Code								*/
/*----------------------------------------------------------------------*/
	include( 'functions/functionsUser.php');
	$errorLogin = NULL;
	$errorSubscription = NULL;
	$salt = "@68s?qed";
	
//---------------------------------------------------------
// Mode Sign in/Login Test
//---------------------------------------------------------	
	if ( !empty($_GET['mode']) ) 
	{
		$mode = $_GET['mode'];
	}
	else {
		$mode ='login';
	}
	
//---------------------------------------------------------
// Login Page Tests
//---------------------------------------------------------	
	if ( $mode === 'login' ) 
	{		
		if ( isset($_POST['userName']) AND isset($_POST['passwd']) ) 
		{			
			$userInfo=getUserPasswd($_POST['userName']);
			if( $userInfo && sha1(sha1($_POST['passwd']). $salt) === $userInfo['hash'] ) 
			{
				$errorLogin = 1;
			}
			else {
				$errorLogin = 2;
			}
		}
	}
	
//---------------------------------------------------------
// Sign in Page Tests
//---------------------------------------------------------	
	else 
	{	
		if (isset($_POST['newUserMail']) AND isset($_POST['newUserName']) AND isset($_POST['newUserPasswd']))	
		{
			if (!empty($_POST['newUserMail']) AND !empty($_POST['newUserName']) AND !empty($_POST['newUserPasswd']) AND !empty($_POST['newUserPasswdBis']) AND ($_POST['newUserPasswd']==$_POST['newUserPasswdBis']) )
			{
				$errorSubscription = checkExistingUser( $_POST['newUserName'], $_POST['newUserMail'] );
				if ($errorSubscription === 0) 
				{
					registerUser( $_POST['newUserName'], $_POST['newUserMail'], $_POST['newUserPasswd'], $salt );
					$_SESSION['userName'] = $_POST['newUserName'];
					header('Location: crc/tasker.php');
				}
			} else {
				$errorSubscription = 4;
			}
		}
	}
//---------------------------------------------------------
// End
//---------------------------------------------------------			
?>
	
	<head>
		<meta charset="UTF-8">
		<title><?php echo TXT_INDEX_LOGIN2; ?></title>
		<link rel="stylesheet" href="css/index.css">
	</head>
	<body>
		<div class="container">
			<div id="login-form">
				<h3 id = "signin" <?php if($mode=='signin'){echo "style=\"background-color:#000\"";} ?> ><a class="choice" href="index.php?mode=signin"><?php echo TXT_INDEX_SIGNIN1; ?></a></h3>
				<h3 id = "login" <?php if($mode=='login'){echo "style=\"background-color:#000\"";} ?> ><a class="choice" href="index.php?mode=login"><?php echo TXT_INDEX_LOGIN1; ?></a></h3>
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
