<?php include 'dbconnect.php'; ?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
		echo "<link rel='stylesheet' type='text/css' href='";
		if (isset($_SESSION['mode']) AND $_SESSION['mode'] == "styles_d") {
			echo "$_SESSION[mode]";
		}elseif (isset($_SESSION['mode']) AND $_SESSION['mode'] == "styles" OR !isset($_SESSION['mode'])) {
			echo "styles";
		};
		echo ".css' media='screen' />";
?>
		<title>Webapplikation | Wallpapers</title>
	</head>
	<body>
<?php 	include 'header.php';

		if (isset($_GET["error"])) {
			echo "<a style='color: red;'>";
			if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Benutzername oder Passwort ist falsch.";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Username or Password is incorrect.";};
			echo "</a>";
		};
?>
		<div style='margin-left: 10px;'>
			<h2>Login</h2>
			<form action="" method="post">
				<label for="email"><b>E-Mail:</b></label>
				<input style="margin-left: 
				<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "	18px;";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "20px;";}; ?>
				margin-top: 5px;" type="email" placeholder="Enter E-Mail" name="email" required><br>
				<label for="password"><b>
				<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Passwort:";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Password:";}; ?>
				</b></label>
				<input style="margin-top: 5px;" type="password" placeholder="Enter Password" name="password" required><br>
				<button style="margin-top: 10px;" type="submit" name="submit">Login</button><br>
			</form>
			<br><a href='registrieren.php'>
			<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Registrieren";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Sign Up";}; ?>
			</a>
		</div>
<?php
		if (isset($_POST["submit"])) {
			// Übergabe Werte
			$email			= $_POST["email"];
			$password		= $_POST["password"];
			
			$sql = "SELECT * FROM users WHERE usr_email = '$email'";
			$st=$pdo->prepare($sql);
			$st->execute();
			$check=$st->rowCount();
			
			// Check ob Benutzer existiert
			if($check > 0){
				foreach ($pdo->query($sql) as $row) {
					// Passwort überprüfen
					if (password_verify($password, $row["usr_password"])) {
						// Einrichten SESSION und Weiterleitung
						session_regenerate_id();
						$_SESSION['loggedin'] = "$row[usr_email]";
						$_SESSION['usr_id'] = "$row[usr_id]";
						$_SESSION['usr_auth'] = "$row[usr_auth]";
						if (isset($_GET["add"])) {
							header('Location: add_wallpaper.php');
						}else {
							header('Location: index.php');
						}
					} else {
						header('Location: login.php?error=404');
					};
				};
			}else {
				header('Location: login.php?error=404');
			};
		};
		
		// Footer
		include 'footer.php';
?>
	</body>
</html>