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
		include_once('../database/lang/fr.php'); 
	} else { // english is the default language
		include_once('../database/lang/en.php'); 
	}

	include_once('../functions/functionsTask.php');
	if (isset($_GET['fold'])) {
		$folder = $_GET['fold'];
		$userName = $_SESSION['userName'];
		if(file_exists("../database/users/$userName/tasks/$folder")) {
			$fichier = fopen("../database/users/$userName/tasks/$folder", "r");
			if (isset($_GET['cursor'])) {
				$cursor = $_GET['cursor'];
			}
			else {
				$cursor = SEEK_SET;
			}
			fseek($fichier, $cursor);
			fscanf($fichier, "%d", $task_id);
			if (!is_int($task_id)) {
				rewind($fichier);
				fscanf($fichier, "%d", $task_id);
			}
			$cursor = ftell($fichier);
			fclose($fichier);
			$fichier = fopen("../database/$folder/$task_id", "r");
			readTask($fichier);
			fclose($fichier);
		}
		else {
			echo TXT_TASKDISPLAYER_POSTIT;
			$cursor = 0;
		}
	}
	else {
		$folder ="non defini";
	}
?>

<?php
	switch ($folder) {
		case "todo":
			echo "<script>curtodo = $cursor;</script>";
			break;
		case "wip":
			echo "<script>curwip = $cursor</script>";
			break;
		case "done":
			echo "<script>curdone = $cursor</script>";
			break;
		case "dead":
			echo "<script>curdead = $cursor</script>";
			break;
		default:
	}
?>

<script>id = <?php echo $task_id; ?></script>
