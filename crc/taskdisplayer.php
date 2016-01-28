<?php
	include('../functions/functions.php');
	if (isset($_GET['file'])) {
		$nomfichier = $_GET['file'];
		$fichier = fopen("../database/$nomfichier", "r");
		if (isset($_GET['cursor'])) {
			$cursor = $_GET['cursor'];
		}
		else {
			$cursor = SEEK_SET;
		}
		fseek($fichier, $cursor);
		$cursor = readTask($fichier);
		if (feof($fichier)) {
			$cursor = 0;
		}
		fclose($fichier);
	}
	else {
		$nomfichier ="non defini";
	}
?>

<?php
	switch ($nomfichier) {
		case "todo.task":
			echo "<script>curTodo = $cursor;</script>";
			break;
		case "wip.task":
			echo "<script>curWIP = $cursor</script>";
			break;
		case "done.task":
			echo "<script>curDone = $cursor</script>";
			break;
		case "toolate.task":
			echo "<script>curTooLate = $cursor</script>";
			break;
		default:
	}
?>
