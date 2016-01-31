<!DOCTYPE html>
<html>
<?php
// cookie's expiration time (1 year)
	$expire = 365*24*3600; 

//---------------------------------------------------------
// Cookie for the language
//---------------------------------------------------------
	if(isset($_COOKIE['lang']))
	{
		$lang = $_COOKIE['lang'];
	} else { // If no language is declared, attempts to recognize the default language of the browser 
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2); 
	}
	setcookie('lang', $lang, time() + $expire);  

//---------------------------------------------------------
// Include of the right language file
//---------------------------------------------------------	
	if ($lang=='fr')
	{           
		include('../database/lang/fr.php'); 
	} else { // english is the default language
		include('../database/lang/en.php'); 
	}
		
/*----------------------------------------------------------------------*/
/*							Page Main Code								*/
/*----------------------------------------------------------------------*/
	include( '../functions/functionsTask.php');
	
	if (isset($_GET['fold'])) {
		$folder = $_GET['fold'];
	}
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
?>
	<head>
		<meta charset="UTF-8">
		<title>Tasker</title>
		<link rel="stylesheet" href="../css/task.css">
	</head>
	
	<header>
		<p style="color: #FFF; font-size: 50px; text-align: left; padding-left: 30px; max-width: 600px; float: left;"><?php echo TXT_BANNER_WELCOME; echo '<span style="color: #f00;">' . $_SESSION['userName'] . '</span>'; ?> !</p>
		<div id="menu">	
			<input class="creator" type="button" value="<?php echo TXT_BANNER_RETURN; ?>" onclick="self.location.href='tasker.php'"></input>
			<input class="deco" type="button" value="<?php echo TXT_BANNER_DISCONNECTION; ?>" onclick="self.location.href='../index.php'"></input>
		</div>
	</header>
	
	<body>
		<div id="sheet">
			<?php readTaskFull("../database/$folder", $id); ?>
		</div>
	</body>
	
</html>
	
