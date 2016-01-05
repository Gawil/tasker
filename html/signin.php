<fieldset>
	<form action="" method="post">
		<?php
			// Champs non remplis
			if ($errorSubscription === 4) {
				echo '<p style="color: #900; font-size: 13px;">Veuillez renseigner tous les champs correctement</p>';
			}
			
			// Champ Username + erreur
			if (isset($_POST['newUserName'])) {
				echo '<input class="signin" value="' . $_POST['newUserName'] . '"type="text" name="newUserName" placeholder="Username">';
			}
			else {
				echo '<input class="signin" type="text" name="newUserName" placeholder="Username">';
			}
			if ($errorSubscription != 4 && ($errorSubscription === 2 || $errorSubscription === 3)) {
				echo '<p style="color: #900; font-size: 12px;">Ce nom est déjà utilisé</p>';
			}
			
			// Champ Email + erreur
			if (isset($_POST['newUserMail'])) {
				echo '<input class="signin" value="' . $_POST['newUserMail'] . '"type="text" name="newUserMail" placeholder="Email">';
			}
			
			else {
				echo '<input class="signin" type="email" name="newUserMail" placeholder="Email">';
			}
			if ($errorSubscription != 4 && ($errorSubscription === 2 || $errorSubscription === 1)) {
				echo '<p style="color: #900; font-size: 12px;">Cette adresse est déjà utilisée</p>';
			}
			
			// Mots de passe + erreur
			if (isset($_POST['newUserPasswd']) && isset($_POST['newUserPasswdBis']) && ($_POST['newUserPasswd'] === $_POST['newUserPasswdBis'])) {
				echo '<input class="signin" value="' . $_POST['newUserPasswd'] . '" type="password" name="newUserPasswd" placeholder="Password">';
				echo '<input class="signin" value="' . $_POST['newUserPasswdBis'] . '" type="password" name="newUserPasswdBis" style="float: right;" placeholder="Confirm password">';
			}
			else {
				echo '<input class="signin" type="password" name="newUserPasswd" placeholder="Password">';
				echo '<input class="signin" type="password" name="newUserPasswdBis" style="float: right;" placeholder="Confirm password">';
				if (isset($_POST['newUserPasswd'])) {
					echo '<p style="color: #900; font-size: 12px;">Les deux champs doivent correspondre !</p>';
				}
			}
		?>
		<br/>
		<input class="signin" type="checkbox" name="lu"><span class="condutil">J'ai lu et j'accepte les <a id="condutil" href="http://www.padrepio.catholicwebservices.com/FRANCAISE/Les_dix_command.htm" target="_blank">conditions generales d'utilisation</a></span>
		<input class="signin" type="submit" value="Sign In">
	</form>
</fieldset>
