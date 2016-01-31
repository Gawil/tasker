<fieldset>
	<form action="" method="post">
		<?php
			// Champ Username + erreur
			echo "<input class=\"signin\" type=\"text\" name=\"newUserName\" placeholder=\"".TXT_INDEX_USERNAME."\" required>";
			
			if ( $errorSubscription === 2 OR $errorSubscription === 3 )
			{ echo "<p style=\"color: #900; font-size: 12px;\">".TXT_INDEX_ERROR2."</p>"; }
			
			if ($errorSubscription === 20 OR $errorSubscription === 30 OR $errorSubscription === 60 OR $errorSubscription === 70)
			{ echo "<p style=\"color: #900; font-size: 12px;\">".TXT_INDEX_ERROR6."</p>"; }
			
			// Champ Email + erreur
			echo "<input class=\"signin\" type=\"email\" name=\"newUserMail\" placeholder=\"".TXT_INDEX_MAIL."\" required>";
			
			if ($errorSubscription === 2 OR $errorSubscription === 1)
			{ echo "<p style=\"color: #900; font-size: 12px;\">".TXT_INDEX_ERROR3."</p>"; }
			
			if ($errorSubscription === 10 OR $errorSubscription === 30 OR $errorSubscription === 50 OR $errorSubscription === 70)
			{ echo "<p style=\"color: #900; font-size: 12px;\">".TXT_INDEX_ERROR5."</p>"; }
			
			// Mots de passe + erreur
			echo "<input class=\"signin\" type=\"password\" name=\"newUserPasswd\" placeholder=\"".TXT_INDEX_PASSWORD."\" required>";
			echo "<input class=\"signin\" type=\"password\" name=\"newUserPasswdBis\" style=\"float: right;\" placeholder=\"".TXT_INDEX_CONFPASSWORD."\" required>";
			if (isset($_POST['newUserPasswd']) && isset($_POST['newUserPasswdBis']) && ($_POST['newUserPasswd'] !== $_POST['newUserPasswdBis']))
			{ echo "<p style=\"color: #900; font-size: 12px;\">".TXT_INDEX_ERROR4."</p>"; }
			
			if ($errorSubscription === 40 OR $errorSubscription === 50 OR $errorSubscription === 60 OR $errorSubscription === 70)
			{ echo "<p style=\"color: #900; font-size: 12px;\">".TXT_INDEX_ERROR7."</p>"; }
		?>
		<br/>
		<input class="signin" type="checkbox" name="lu"><span class="condutil"><?php echo TXT_INDEX_CONDITIONS1; ?> <a id="condutil" href="http://www.padrepio.catholicwebservices.com/FRANCAISE/Les_dix_command.htm" target="_blank"><?php echo TXT_INDEX_CONDITIONS2; ?></a></span>
		<input class="signin" type="submit" value="<?php echo TXT_INDEX_SIGNIN2; ?>">
	</form>
</fieldset>
