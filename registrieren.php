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
<?php	include 'header.php';?>
		<div style='margin-left: 10px;'>
			<h2>
			<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Registierung";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Registration";}; ?>
			</h2>
			<form action="" method="post">
				<label style='margin-right: 
				<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "48px;";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "60px;";}; ?>
				' for="benutzer"><b>
				<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Benutzername:";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Username:";}; ?>
				</b></label>
				<input style='margin-bottom: 5px;' type="text" placeholder="Enter Name" name="benutzer" required><br>
				<label style='margin-right: 
				<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "105px;";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "85px;";}; ?>
				' for="email"><b>E-Mail:</b></label>
				<input style='margin-bottom: 5px;' type="email" placeholder="Enter E-Mail" name="email" required><br>
				<label style='margin-right: 
				<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "87px;";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "66px;";}; ?>
				' for="password"><b>
				<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Passwort:";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Password:";}; ?>
				</b></label>
				<input style='margin-bottom: 5px;' type="password" placeholder="Enter Password" minlength="8" name="password" required><br>
				<label for="passwordtwo"><b>
				<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Passwort bestätigen:";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Confirm Password:";}; ?>
				</b></label>
				<input style='margin-bottom: 5px;' type="password" placeholder="Enter Password again" minlength="8" name="passwordtwo" required><br>
				<button type="submit" name="submit">
				<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "registieren";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Sign Up";}; ?>
				</button><br>
			</form>
			<br><a href='login.php'>Login</a>
		</div>
<?php
		if (isset($_POST["submit"])) {
			
			// Übergabe Werte
			$benutzer		= $_POST["benutzer"];
			$email			= $_POST["email"];
			$password		= $_POST["password"];
			$passwordtwo	= $_POST["passwordtwo"];
			
			// Überprüfung ob Passwort gleich
			if ($password === $passwordtwo) {
				// Abspeichern User
				$sql = "INSERT INTO users (usr_name, usr_email, usr_password, usr_auth) VALUES ('$benutzer', '$email', '".password_hash($password, PASSWORD_DEFAULT)."', 0)";
				$st=$pdo->prepare($sql);
				$st->execute();
				if ($st) {
					
				}else {
					if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Benutzername oder E-Mail ist bereits vergeben.";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Username or E-Mail is already taken.";};
				};
				header('Location: login.php?reg=true');
			}else {
				if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Die Passwörter stimmen nicht überein.";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "The Passwords do not match.";};
			};
		};
		
		// Footer
		include 'footer.php';
?>
	</body>
</html>