<fieldset>
	<form action="" method="post">				
		<input class="login" type="text" name="userName" value="<?php echo $lastUserName ?>" placeholder="<?php echo TXT_INDEX_USERNAME; ?>" required>
		<input class="login" type="password" name="passwd" placeholder="<?php echo TXT_INDEX_PASSWORD; ?>" required>
		<?php
			if ($errorLogin === 1) {
				$_SESSION['userName'] = $_POST['userName'];
				setcookie('lastUserName', $_POST['userName'], time() + $expire);  
				header('Location: crc/tasker.php');
			} 
			elseif ($errorLogin === 2) {
				echo "<p style=\"color: #900; font-size: 13px;\">".TXT_INDEX_ERROR1."</p>";
			}
		?>
		<input class="login" type="submit" value="<?php echo TXT_INDEX_LOGIN2; ?>">			
		<footer>
			<p><span class="info">?</span><a id="forgotten" href="#"><?php echo TXT_INDEX_FORGOTPASSWD; ?></a></p>
		</footer>				
	</form>
</fieldset>
