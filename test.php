<!DOCTYPE html>
<html>
<?php
	include( 'functions/functions.php');
?>
	<head>
		<meta charset="UTF-8">
		<title>Tasker</title>
	</head>
	<body>
		<?php
			$fichier = fopen("database/todo.task", "r");
			readTask($fichier);
		?>
	</body>
</html>
