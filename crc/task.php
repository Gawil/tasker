<!DOCTYPE html>
<html>
<?php 
	include( '../functions/functionsTask.php');
	
	if (isset($_GET['fold'])) {
		$folder = $_GET['fold'];
	}
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
?>
	<head>
		<meta charset="UTF-8">
		<title>Tasker</title>
		<link rel="stylesheet" href="../css/task.css">
	</head>
	
	<header>
		<p style="color: #FFF; font-size: 50px; text-align: left; padding-left: 30px; max-width: 600px; float: left;">Bienvenue <?php echo '<span style="color: #f00;">' . $_SESSION['userName'] . '</span>'; ?> !</p>
		<div id="menu">
			<input class="deco" type="button" value="Déconnexion" onclick="self.location.href='../index.php'"></input>
		</div>
	</header>
	
	<body>
		<div id="sheet">
			<?php readTaskFull("../database/$folder", $id); ?>
		</div>
	</body>
	
</html>
	
