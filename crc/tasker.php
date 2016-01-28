<!DOCTYPE html>
<html>
	<?php
		include( '../functions/functions.php');
		if(isset($_POST['taskcreated']) && $_POST['taskcreated'] == true) {
			if (isset($_GET['title']) && isset($_GET['datedeb']) && isset($_GET['datefin']) && isset($_GET['content'])) {
				$title = $_GET['title'];
				$datedeb = $_GET['datedeb'];
				$datefin = $_GET['datefin'];
				$content = $_GET['content'];
				$date = date("d/m/Y");
				if (date_isInf($date, $datedeb)) {
					$filename = "todo.task";
				}
				else {
					if (date_isInf($datefin, $date)) {
						$filename = "toolate.task";
					}
					else {
						$filename = "wip.task";
					}
				}
				createTask($filename, $title, $datedeb, $content);
				echo "<script>alert('La tâche a été créée avec succès !');</script>";
			}
			else {
				echo "<script>alert('Un problème est survenu lors de la création de la tache. Désolé...');</script>";
			}
		}
		//createTask("../database/done.task", "Youpi", "99/55/4123", "Ceci est un test\nyoupi youpi\nligne 3 !!");
	?>
	<head>
		<script type="text/javascript">var curTodo = 0; var curWIP = 0; var curDone = 0; var curTooLate = 0;</script>
		<script type="text/javascript">var curTodoAvant = 0; var curWIPAvant = 0; var curDoneAvant = 0; var curTooLateAvant = 0;</script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script>
			function displayNextTodo() {
				$(document).ready(
					function() {
						curTodoAvant = curTodo;
						$("#todo").load("taskdisplayer.php?cursor="+curTodo+"&file=todo.task");
						$.ajaxSetup({ cache: false });
					}
				);
			}
			function displayNextWIP() {
				$(document).ready(
					function() {
						curWIPAvant = curWIP;
						$("#wip").load("taskdisplayer.php?cursor="+curWIP+"&file=wip.task");
						$.ajaxSetup({ cache: false });
					}
				);
			}
			function displayNextDone() {
				$(document).ready(
					function() {
						curDoneAvant = curDone;
						$("#done").load("taskdisplayer.php?cursor="+curDone+"&file=done.task");
						$.ajaxSetup({ cache: false });
					}
				);
			}
			function displayNextTooLate() {
				$(document).ready(
					function() {
						curTooLateAvant = curTooLate;
						$("#toolate").load("taskdisplayer.php?cursor="+curTooLate+"&file=toolate.task");
						$.ajaxSetup({ cache: false });
					}
				);
			}
			function displayCurrentTask(i) {
				switch(i) {
					case 1:
						document.location.href = "task.php?nomfichier=todo.task&cur="+curTodoAvant;
						break;
					case 2:
						document.location.href = "task.php?nomfichier=wip.task&cur="+curWIPAvant;
						break;
					case 3:
						document.location.href = "task.php?nomfichier=done.task&cur="+curDoneAvant;
						break;
					case 4:
						document.location.href = "task.php?nomfichier=toolate.task&cur="+curTooLateAvant;
						break;
					default:
				} 
			}
		</script>
		
		<meta charset="UTF-8">
		<title>Tasker</title>
		<link rel="stylesheet" href="../css/tasker.css">
		<link  href="http://fonts.googleapis.com/css?family=Reenie+Beanie:regular" rel="stylesheet" type="text/css">
	</head>
	<body>
		<header>
			<p style="color: #FFF; font-size: 50px; text-align: left; padding-left: 30px;">Bienvenue <?php echo '<span style="color: #f00;">' . $_SESSION['userName'] . '</span>'; ?> !</p>
			
		</header>
		
		<div class="container">
			<input type="button" onclick="self.location.href='taskCreator.php'"></input>
			<div class="postcontainer" id ="todocontainer">
				<div class="postit" id="todo" onclick="displayCurrentTask(1);">
					<br />
					<h1 style="font-size: 40px; text-align: center; margin: 0px;">Tâches à venir</h1>
					<br />
					<br />
					<h3 style="font-size: 25px; text-align: center; margin-top: 0px;">Veuillez cliquer sur <span style="color: #f00;">Suivant</span> pour afficher la prochaine tâche</h3>
					<?php include('taskdisplayer.php'); ?>
				</div>
				<input type="button" value="SUIVANT" onclick="displayNextTodo();"></input>
			</div>
			<div class="postcontainer" id ="wipcontainer">
				<div class="postit" id="wip" onclick="displayCurrentTask(2);">
					<br />
					<h1 style="font-size: 40px; text-align: center; margin: 0px;">Tâches en cours</h1>
					<br />
					<br />
					<h3 style="font-size: 25px; text-align: center; margin-top: 0px;">Veuillez cliquer sur <span style="color: #f00;">Suivant</span> pour afficher la prochaine tâche</h3>
					<?php include('taskdisplayer.php'); ?>
				</div>
				<input type="button" value="SUIVANT" onclick="displayNextWIP();"></input>
			</div>
			<div class="postcontainer" id ="donecontainer">
				<div class="postit" id="done" onclick="displayCurrentTask(3);">
					<br />
					<h1 style="font-size: 40px; text-align: center; margin: 0px;">Tâches terminées</h1>
					<br />
					<br />
					<h3 style="font-size: 25px; text-align: center; margin-top: 0px;">Veuillez cliquer sur <span style="color: #f00;">Suivant</span> pour afficher la prochaine tâche</h3>
					<?php include('taskdisplayer.php'); ?>
				</div>
				<input type="button" value="SUIVANT" onclick="displayNextDone();"></input>
			</div>
			<div class="postcontainer" id ="toolatecontainer">
				<div class="postit" id="toolate" onclick="displayCurrentTask(4);">
					<br />
					<h1 style="font-size: 40px; text-align: center; margin: 0px;">Tâches décédées</h1>
					<br />
					<br />
					<h3 style="font-size: 25px; text-align: center; margin-top: 0px;">Veuillez cliquer sur <span style="color: #f00;">Suivant</span> pour afficher la prochaine tâche</h3>
					<?php include('taskdisplayer.php'); ?>
				</div>
				<input type="button" value="SUIVANT" onclick="displayNextTooLate();"></input>
			</div>
		</div>
	</body>
</html>
