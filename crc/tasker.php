<!DOCTYPE html>
<html>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="../functions/functions.js"></script>
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
	include( '../functions/functionsUser.php');
	include( '../functions/functionsTask.php');
	if( isset($_POST['taskCreated']) AND $_POST['taskCreated'] == true ) 
	{
		if ( isset($_POST['title']) AND isset($_POST['datedeb']) AND isset($_POST['datefin']) AND isset($_POST['content']) ) 
		{
			$title = $_POST['title'];
			$datedeb = $_POST['datedeb'];
			$datefin = $_POST['datefin'];
			$content = $_POST['content'];
			$date = date("d/m/Y");
			if (date_isInf($date, $datedeb)) 
			{
				$folder = "todo";
			} else {
				if (date_isInf($datefin, $date)) 
				{
					$folder = "dead";
				} else {
					$folder = "wip";
				}
			}
			createTask($folder, $title, $datedeb, $content, $_SESSION['userName']);
			echo '<script>alert(\''.TXT_TASKER_NEWTASKSUCCESS.'\');</script>';
		} else {
			echo '<script>alert(\''.TXT_TASKER_NEWTASKFAIL.'\');</script>';
		}
	}
?>
	<head>
		<meta charset="UTF-8">
		<title>Tasker</title>
		<link rel="stylesheet" href="../css/tasker.css">
		<link  href="http://fonts.googleapis.com/css?family=Reenie+Beanie:regular" rel="stylesheet" type="text/css">
	</head>
	<body>
		<header>
			<p style="color: #FFF; font-size: 50px; text-align: left; padding-left: 30px; max-width: 600px; float: left;"><?php echo TXT_TASKER_WELCOME; echo '<span style="color: #f00;">' . $_SESSION['userName'] . '</span>'; ?> !</p>
			<div id="menu">	
				<input class="creator" type="button" value="<?php echo TXT_TASKER_CREATETASK; ?>" onclick="self.location.href='taskCreator.php'"></input>
				<input class="deco" type="button" value="<?php echo TXT_TASKER_DISCONNECTION; ?>" onclick="self.location.href='../index.php'"></input>
			</div>
		</header>
		
		<div class="container">
			
			<div class="postcontainer" id ="todocontainer">
				<div class="postit" id="todo" onclick="displayCurrentTask(1);">
					<br />
					<h1 style="font-size: 40px; text-align: center; margin: 0px;"><?php echo TXT_TASKER_TODO; ?></h1>
					<br />
					<br />
					<h3 style="font-size: 25px; text-align: center; margin-top: 0px;"><?php echo TXT_TASKER_NEXTMESSAGE; ?></h3>
					<?php include('taskdisplayer.php'); ?>
				</div>
				<input type="button" value="<?php echo TXT_TASKER_NEXT; ?>" onclick="displayNextTodo();"></input>
			</div>
			<div class="postcontainer" id ="wipcontainer">
				<div class="postit" id="wip" onclick="displayCurrentTask(2);">
					<br />
					<h1 style="font-size: 40px; text-align: center; margin: 0px;"><?php echo TXT_TASKER_WIP; ?></h1>
					<br />
					<br />
					<h3 style="font-size: 25px; text-align: center; margin-top: 0px;"><?php echo TXT_TASKER_NEXTMESSAGE; ?></h3>
					<?php include('taskdisplayer.php'); ?>
				</div>
				<input type="button" value="<?php echo TXT_TASKER_NEXT; ?>" onclick="displayNextWIP();"></input>
			</div>
			<div class="postcontainer" id ="donecontainer">
				<div class="postit" id="done" onclick="displayCurrentTask(3);">
					<br />
					<h1 style="font-size: 40px; text-align: center; margin: 0px;"><?php echo TXT_TASKER_DONE; ?></h1>
					<br />
					<br />
					<h3 style="font-size: 25px; text-align: center; margin-top: 0px;"><?php echo TXT_TASKER_NEXTMESSAGE; ?></h3>
					<?php include('taskdisplayer.php'); ?>
				</div>
				<input type="button" value="<?php echo TXT_TASKER_NEXT; ?>" onclick="displayNextDone();"></input>
			</div>
			<div class="postcontainer" id ="deadcontainer">
				<div class="postit" id="dead" onclick="displayCurrentTask(4);">
					<br />
					<h1 style="font-size: 40px; text-align: center; margin: 0px;"><?php echo TXT_TASKER_DEAD; ?></h1>
					<br />
					<br />
					<h3 style="font-size: 25px; text-align: center; margin-top: 0px;"><?php echo TXT_TASKER_NEXTMESSAGE; ?></h3>
					<?php include('taskdisplayer.php'); ?>
				</div>
				<input type="button" value="<?php echo TXT_TASKER_NEXT; ?>" onclick="displayNextDead();"></input>
			</div>
		</div>
	</body>
</html>
