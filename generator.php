<h2>Rap-Name Generator</h2>
<form action="" method="post">
	<label for="firstname"><b>
	<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Vorname:";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Firstname:";}; ?>
	</b></label>
	<input style="margin-left: 
	<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "	28px;";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "	5px;";}; ?>
	margin-top: 5px;" type="text" placeholder="z.B. Bob" name="firstname" required><br>
	<label style='margin-right: 15px' for="surname"><b>
	<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Nachname:";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Surname:";}; ?>
	</b></label>
	<input style="margin-top: 5px;" type="text" placeholder="z.B. Marley" name="surname" required><br>
	<button style="margin-top: 10px;" type="submit" name="submit">
	<?php if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Generieren";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Generate";}; ?>
	</button><br>
</form>
<?php
if (isset($_POST["submit"])) {
	
	//Übergabe der Namen
	$firstname_n	= $_POST["firstname"];
	$surname_n		= $_POST["surname"];
	
	//Auswahl erster Buchstabe
	$firstname 	= $firstname_n[0];
	$surname 	= $surname_n[0];
	
	//Ausgabe des Rap-Namens
	$sql_g = "SELECT * FROM `name` WHERE nam_letter = '$firstname' AND nam_type = 1 OR nam_letter = '$surname' AND nam_type = 0";
	$stg=$pdo->prepare($sql_g);
	$stg->execute();
	echo "<br><a style='color: green;'>$firstname_n $surname_n a.k.a ";
	foreach ($pdo->query($sql_g) as $rog) {
		echo "<b>$rog[nam_name] </b>";
	};
	echo "</a>";
};
?>
