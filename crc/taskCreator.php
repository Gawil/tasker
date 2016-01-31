<?php
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
	if ($lang=='fr')
	{           
		include_once('../database/lang/fr.php'); 
	} else { // english is the default language
		include_once('../database/lang/en.php'); 
	}
	setcookie("lang", $lang, time()+$expire,'/');
?>
<!DOCTYPE html>
<html>
<?php
/*----------------------------------------------------------------------*/
/*							Page Main Code								*/
/*----------------------------------------------------------------------*/
	?>
	<head>
		<meta charset="UTF-8">
		<title>Tasker</title>
		<link rel="stylesheet" href="../css/taskCreator.css">
	</head>
	
	<header>
		<p style="color: #FFF; font-size: 50px; text-align: left; padding-left: 30px; max-width: 600px; float: left;"><?php echo TXT_BANNER_WELCOME; echo '<span style="color: #f00;">' . $_SESSION['userName'] . '</span>'; ?> !</p>
		<div id="menu">	
			<input class="test" type="button" value="<?php echo TXT_BANNER_RETURN; ?>" onclick="self.location.href='tasker.php'"></input>
			<input class="test" type="button" value="<?php echo TXT_BANNER_DISCONNECTION; ?>" onclick="self.location.href='../index.php'"></input>
		</div>
	</header>
	
	<body>
		<form id="sheet" action="tasker.php" method="post">
			<input name="taskCreated" value="true" style="display: none;"/>
			<input name="title" type="text" placeholder="<?php echo TXT_TASKCREATOR_TITLE; ?>" style="font-size: 35px; border: none;"/><br/><br/>
			<input name="datedeb" type="date" placeholder="jj/mm/aaaa" value="<?php echo date("d/m/Y"); ?>"/>
			<div id="date"><?php echo TXT_TASKCREATOR_DATEBEGIN; ?> :</div><br/><br/>
			<input name="datefin" type="date" placeholder="jj/mm/aaaa" value="<?php echo date("d/m/Y"); ?>"/>
			<div id="date"><?php echo TXT_TASKCREATOR_DATEEND; ?> :</div><br/><br/>
			<textarea name="content" maxlength="1024"></textarea><br/>
			<input type="submit" value="<?php echo TXT_TASKCREATOR_SEND; ?>" style="float: right; margin-top: 10px;"/>
		</form>
	</body>
	
</html>
