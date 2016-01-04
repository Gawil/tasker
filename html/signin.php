<fieldset>
	<form action="" method="post">
		<?php
			if ($errorSubscription === 4) {
				echo "<p style=\"color: #900; font-size: 13px;\">Veuillez renseigner tous les champs correctement</p>";
			}
		?>
		<input class="signin" type="text" name="newUserName" placeholder="Username">
		<?php
			if ($errorSubscription != 4 && ($errorSubscription === 2 || $errorSubscription === 3)) {
				echo "<p style=\"color: #900; font-size: 12px;\">Ce nom est déjà utilisé</p>";
			}
		?>
		<input class="signin" type="email" name="newUserMail" placeholder="Email">
		<?php
			if ($errorSubscription != 4 && ($errorSubscription === 2 || $errorSubscription === 1)) {
				echo "<p style=\"color: #900; font-size: 12px;\">Cette adresse est déjà utilisée</p>";
			}
		?>
		<input class="signin" type="password" name="newUserPasswd" placeholder="Password">
		<input class="signin" type="password" name="newUserPasswdBis" style="float: right;" placeholder="Confirm password">
		<br/>
		<input class="signin" type="checkbox" name="lu"><span class="condutil">J'ai lu et j'accepte les <a id="condutil" href="http://www.padrepio.catholicwebservices.com/FRANCAISE/Les_dix_command.htm" target="_blank">conditions generales d'utilisation</a></span>
		<input class="signin" type="submit" value="Sign In">
	</form>
</fieldset>
