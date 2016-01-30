<?php
	include('../functions/functionsTask.php');
	include('../functions/functionsTask.php');
	if (isset($_GET['fold'])) {
		$folder = $_GET['fold'];
		$userName = $_SESSION['userName'];
		$fichier = fopen("../database/users/$userName/tasks/$folder", "r");
		if (isset($_GET['cursor'])) {
			$cursor = $_GET['cursor'];
		}
		else {
			$cursor = SEEK_SET;
		}
		echo "$cursor";
		fseek($fichier, $cursor);
		fscanf($fichier, "%d", $task_id);
		echo "$task_id";
		fclose($fichier);
		$fichier = fopen("../database/$folder/$task_id", "r");
		readTask($fichier);
		fclose($fichier);
	}
	else {
		$folder ="non defini";
	}
?>

<?php
	switch ($folder) {
		case "todo":
			echo "<script>curTodo = $cursor;</script>";
			break;
		case "wip":
			echo "<script>curWIP = $cursor</script>";
			break;
		case "done":
			echo "<script>curDone = $cursor</script>";
			break;
		case "dead":
			echo "<script>curTooLate = $cursor</script>";
			break;
		default:
	}
?>
