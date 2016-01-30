<!DOCTYPE html>
<html>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="../functions/functions.js"></script>
	<?php
		include( '../functions/functionsUser.php');
		include( '../functions/functionsTask.php');
		//if(isset($_POST['taskcreated']) && $_POST['taskcreated'] == true) {
			if (isset($_GET['title']) && isset($_GET['datedeb']) && isset($_GET['datefin']) && isset($_GET['content'])) {
				$title = $_GET['title'];
				$datedeb = $_GET['datedeb'];
				$datefin = $_GET['datefin'];
				$content = $_GET['content'];
				$date = date("d/m/Y");
				if (date_isInf($date, $datedeb)) {
					$folder = "todo";
				}
				else {
					if (date_isInf($datefin, $date)) {
						$folder = "dead";
					}
					else {
						$folder = "wip";
					}
				}
				createTask($folder, $title, $datedeb, $content, $_SESSION['userName']);
				echo "<script>alert('La tâche a été créée avec succès !');</script>";
			}
			else {
				echo "<script>alert('Un problème est survenu lors de la création de la tache. Désolé...');</script>";
			}
		//}
	?>
	<head>
		<meta charset="UTF-8">
		<title>Tasker</title>
		<link rel="stylesheet" href="../css/tasker.css">
		<link  href="http://fonts.googleapis.com/css?family=Reenie+Beanie:regular" rel="stylesheet" type="text/css">
	</head>
	<body>
		<header>
			<p style="color: #FFF; font-size: 50px; text-align: left; padding-left: 30px; max-width: 600px; float: left;">Bienvenue <?php echo '<span style="color: #f00;">' . $_SESSION['userName'] . '</span>'; ?> !</p>
			<input class="creator" type="button" onclick="self.location.href='taskCreator.php'"></input>
		</header>
		
		<div class="container">
			
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
			<div class="postcontainer" id ="deadcontainer">
				<div class="postit" id="dead" onclick="displayCurrentTask(4);">
					<br />
					<h1 style="font-size: 40px; text-align: center; margin: 0px;">Tâches décédées</h1>
					<br />
					<br />
					<h3 style="font-size: 25px; text-align: center; margin-top: 0px;">Veuillez cliquer sur <span style="color: #f00;">Suivant</span> pour afficher la prochaine tâche</h3>
					<?php include('taskdisplayer.php'); ?>
				</div>
				<input type="button" value="SUIVANT" onclick="displayNextDead();"></input>
			</div>
		</div>
	</body>
</html>
