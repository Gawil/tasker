<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Tasker</title>
		<link rel="stylesheet" href="../css/taskCreator.css">
	</head>
	
	<header>
		<p style="color: #FFF; font-size: 50px; text-align: center;">Bienvenue <?php echo '<span style="color: #f00;">' . $_SESSION['userName'] . '</span>'; ?> !</p>
	</header>
	
	<body>
		<form id="sheet" action="tasker.php" method="post">
			<input name="taskCreated" value="true" style="display: none;"/>
			<input name="title" type="text" placeholder="Title" style="font-size: 35px;"/><br/><br/>
			<input name="datedeb" type="date" placeholder="jj/mm/aaaa" value="<?php echo date("d/m/Y"); ?>"/>
			<div id="date">Date début :</div><br/><br/>
			<input name="datefin" type="date" placeholder="jj/mm/aaaa" value="<?php echo date("d/m/Y"); ?>"/>
			<div id="date">Date fin :</div><br/><br/>
			<textarea name="content" maxlength="1024"></textarea><br/>
			<input type="submit" value="Confirm" style="float: right; margin-top: 10px;"/>
		</form>
	</body>
	
</html>
