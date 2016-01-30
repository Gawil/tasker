<?php
	include('../functions/functionsTask.php');
	include('../functions/functionsTask.php');
	if (isset($_GET['fold'])) {
		$folder = $_GET['fold'];
		$fichier = fopen("../database/users/$_SESSION['userName']/tasks/$folder", "r");
		if (isset($_GET['cursor'])) {
			$cursor = $_GET['cursor'];
		}
		else {
			$cursor = SEEK_SET;
		}
		fseek($fichier, $cursor);
		fscanf($fichier, "%d", $task_id);
		fclose($fichier);
		$fichier = fopen("../database/$folder/$task_id", "r");
		$cursor = readTask($fichier);
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
