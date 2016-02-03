<!DOCTYPE html>
<html >
<?php
//---------------------------------------------------------
// Initialization
//---------------------------------------------------------

	if(isset($_SESSION['userName'])) {
		session_destroy();
	}
		
//---------------------------------------------------------
// Cookie for the last username used
//---------------------------------------------------------
	if(isset($_COOKIE['lastUserName']))
	{
		$lastUserName = $_COOKIE['lastUserName'];
	} else {
		$lastUserName = "";
	}
	
// cookie's expiration time (1 year)
	$expire = 365*24*3600; 

//---------------------------------------------------------
// Cookie for the language
//---------------------------------------------------------
	$lang = 'en';
	if( isset($_COOKIE['lang']) )
	{
		$lang = $_COOKIE['lang'];
	} else { // If no language is declared, attempts to recognize the default language of the browser 
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
	}
	if( isset($_GET['lang']) )
	{
		$lang = $_GET['lang'];
	}
	
	
//---------------------------------------------------------
// Include of the right language file
//---------------------------------------------------------	
	if ($lang =='fr') {
		if (!defined('INCLUDED'))
			include_once('database/lang/fr.php'); 
	} else { // english is the default language
		if (!defined('INCLUDED'))
			include_once('database/lang/en.php'); 
	}
	setcookie("lang", $lang, time()+$expire);

/*----------------------------------------------------------------------*/
/*							Page Main Code								*/
/*----------------------------------------------------------------------*/
	include_once( 'functions/functionsUser.php');
	$errorLogin = NULL;
	$errorSubscription = 0;
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
			if ( strlen($_POST['userName'])>=3 AND strlen($_POST['userName'])<=20 AND strlen($_POST['passwd'])>=5 AND strlen($_POST['passwd'])<=20 ) 
			{		
				$userInfo=getUserPasswd($_POST['userName']);
				if( $userInfo && sha1(sha1($_POST['passwd']). $salt) === $userInfo['hash'] ) 
				{
					$errorLogin = 1;
				}
				else {
					$errorLogin = 2;
				}
			} else {
				$errorLogin = 2;
			}
		}
	}
	
//---------------------------------------------------------
// Sign in Page Tests
//---------------------------------------------------------	
	else 
	{	
		if ( isset($_POST['newUserMail']) AND isset($_POST['newUserName']) AND isset($_POST['newUserPasswd']) )	
		{
			if ( strlen($_POST['newUserMail'])<5 OR strlen($_POST['newUserMail'])>50 )
			{
				$errorSubscription = $errorSubscription+10;
			}
			if ( strlen($_POST['newUserName'])<3 OR strlen($_POST['newUserName'])>20 )
			{
				$errorSubscription = $errorSubscription+20;
			}
			if ( strlen($_POST['newUserPasswd'])<5 OR strlen($_POST['newUserPasswd'])>20 OR strlen($_POST['newUserPasswdBis'])<5 OR strlen($_POST['newUserPasswdBis'])>20 )	
			{
				$errorSubscription = $errorSubscription+40;
			}
			if ( $errorSubscription === 0 )
			{			
				$errorSubscription = checkExistingUser( $_POST['newUserName'], $_POST['newUserMail'] );
				if ($errorSubscription === 0) 
				{
					registerUser( $_POST['newUserName'], $_POST['newUserMail'], $_POST['newUserPasswd'], $salt );
					$_SESSION['userName'] = $_POST['newUserName'];
					setcookie('lastUserName', $_POST['newUserName'], time() + $expire);
					session_start();
					header('Location: tasker.php');
				} 
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
	
	<header>
			<div id="menu">	
				<input class="flag" type="button" onclick="self.location.href='index.php?lang=fr'" style='background-image: url("img/fr.jpeg");'/>
				<input class="flag" type="button" onclick="self.location.href='index.php?lang=en'" style='background-image: url("img/en.jpeg");'/>
			</div>
	</header>
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
		<input class="test" type="button" value="<?php echo TXT_BANNER_GENERATEDB; ?>" onclick="self.location.href='init.php'"/>
	</body>
</html>
