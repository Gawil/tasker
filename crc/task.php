<!DOCTYPE html>
<html>
<?php 
	include( '../functions/functionsTask.php');
	
	if (isset($_GET['nomfichier'])) {
		$nomfichier = $_GET['nomfichier'];
	}
	if (isset($_GET['cur'])) {
		$cursor = $_GET['cur'];
	}
?>
	<head>
		<meta charset="UTF-8">
		<title>Tasker</title>
		<link rel="stylesheet" href="../css/task.css">
	</head>
	
	<header>
		<p style="color: #FFF; font-size: 50px; text-align: center;">Bienvenue <?php echo '<span style="color: #f00;">' . $_SESSION['userName'] . '</span>'; ?> !</p>
	</header>
	
	<body>
		<div id="menu">
			<input type="button" value="YOUPI"></input>
			<input type="button" value="CECI"></input>
			<input type="button" value="EST"></input>
			<input type="button" value="UN TEST"></input>
		</div>
		<div id="sheet">
			<?php readTaskFull("../database/$nomfichier", $cursor); ?>
		</div>
	</body>
	
</html>
	
