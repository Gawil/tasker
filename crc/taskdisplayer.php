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
