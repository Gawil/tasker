<!DOCTYPE html>
<html >
	<?php
		if (!empty($_GET['mode']))
		{
			$mode = $_GET['mode'];
		}
		else
		{
			$mode = 'login';
		}
	?>
	
	
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<div class="container">
			<div id="login-form">
				
				
				<h3 id = "signin" <?php if($mode=='signin'){echo "style=\"background-color:#000\"";} ?> ><a class="choice" href="index.php?mode=signin">Sign in</a></h3>
				<h3 id = "login" <?php if($mode=='login'){echo "style=\"background-color:#000\"";} ?> ><a class="choice" href="index.php?mode=login">Login</a></h3>
				<?php
					if ($mode == 'login')
					{
						include('login.html');
					}
					else
					{
						include('signin.html');
					}
				?>
				
			</div>
		</div>
	</body>
</html>
