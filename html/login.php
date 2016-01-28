<fieldset>
	<form action="" method="post">				
		<input class="login" type="text" name="userName" placeholder="Username" required>
		<input class="login" type="password" name="passwd" placeholder="Password" required>
		<?php
			if ($errorLogin === 1) {
				$_SESSION['userName'] = $_POST['userName'];
				header('Location: crc/tasker.php');
			} 
			elseif ($errorLogin === 2) {
				echo '<p style="color: #900; font-size: 13px;">Combinaison nom d\'utilisateur/mot de passe incorrecte</p>';
			}
			if ($errorLogin === 3) {
				echo '<p style="color: #900; font-size: 13px;">Veuillez entrer un nom d\'utilisateur</p>';
			} 
			elseif ( $errorLogin === 4 ) {
				echo '<p style="color: #900; font-size: 13px;">Veuillez entrer un mot de passe</p>';
			}
		?>
		<input class="login" type="submit" value="Login">			
		<footer>
			<p><span class="info">?</span><a id="forgotten" href="#">Forgot Password</a></p>
		</footer>				
	</form>
</fieldset>
