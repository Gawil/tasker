<!DOCTYPE html>
<html>
	<?php
		include( '../functions/functions.php');
		$cursor=0;
	?>
	<head>
		<script type="text/javascript">var curTodo = 0; var curWIP = 0;</script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script>
			function displayNextTodo() {
				$(document).ready(
					function() {
						$("#todo").load("taskdisplayer.php?cursor="+curTodo+"&file=todo.task");
						$.ajaxSetup({ cache: false });
					}
				);
			}
			function displayNextWIP() {
				$(document).ready(
					function() {
						$("#wip").load("taskdisplayer.php?cursor="+curWIP+"&file=wip.task");
						$.ajaxSetup({ cache: false });
					}
				);
			}
		</script>
		
		<meta charset="UTF-8">
		<title>Tasker</title>
		<link rel="stylesheet" href="../css/tasker.css">
		<link  href="http://fonts.googleapis.com/css?family=Reenie+Beanie:regular" rel="stylesheet" type="text/css">
	</head>
	<body>
		<header>
			<p style="color: #FFF; font-size: 50px;">Bienvenuuue <?php echo $_SESSION['userName'];  ?> !!</p>
		</header>
		
		<div class="container">
			<div class="postit" id="todo" onclick="displayNextTodo();">
				<br />
				<h1 style="font-size: 40px; text-align: center; margin: 0px;">Tâches en à faire</h1>
				<br />
				<br />
				<h3 style="font-size: 25px; text-align: center; margin-top: 0px;">Veuillez cliquer pour afficher la prochaine tâche</h3>
				<?php include('taskdisplayer.php'); ?>
			</div>
			<div class="postit" id="wip" onclick="displayNextWIP();">
				<br />
				<h1 style="font-size: 40px; text-align: center; margin: 0px;">Tâches en cours</h1>
				<br />
				<br />
				<h3 style="font-size: 25px; text-align: center; margin-top: 0px;">Veuillez cliquer pour afficher la prochaine tâche</h3>
				<?php include('taskdisplayer.php'); ?>
			</div>
		</div>
	</body>
</html>
