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
<?php
		// Session-Variabeln
		$check 		= $_SESSION['loggedin'];	
		$creator	= $_SESSION['usr_id'];
		
		// Header
		include 'header.php';
		
		echo "<div style='margin-left: 10px;'>";
		
			// Zurück-Button	
			if (!isset($_GET["wal_id"])) {
				echo "<a href='index.php' ><button type='button'>";
				if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Zurück";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Back";};
				echo "</button></a>";
			};
		
			// Titel
			if (isset($_GET["wal_id"])) {
				echo "<h2 style='color: green;'>";
				if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Upload Erfolgreich!";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Upload Successful!";};
				echo "</h2>";
			}else {
				if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "<h2>Wallpaper Hochladen</h2>";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "<h2>Upload Wallpaper</h2>";};
			}
		
			// Überprüfung ob User eingeloggt
			if (isset($check)){
				// Überprüfen ob Bild hochgeladen
				if (!isset($_GET["wal_id"])) {
					// Formular zum hinzufügen
					echo "<form enctype='multipart/form-data' method='POST' action=''>";
						echo "<b style='margin-right: 10px;'>Name: </b>";
						echo "<input style='margin-bottom: 5px;' id='inputW' type='text' name='wal_name' autocomplete='off' required>";
						if (isset($_GET["errorn"])){
							if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "<a style='margin-left: 20px;'>Es existiert bereits ein Wallpaper mit diesem Namen.</a>";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "<a style='margin-left: 20px;'>There is already a wallpaper with this name.</a>";};
						};
						echo "<br>";
						echo "<b style='margin-right: ";
						if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "25px;";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "0px;";};
						echo "'>";
						if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Bild:";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Picture:";};
						echo " </b>";
						echo "<input type='file' name='fileToUpload' id='fileToUpload' required>";
						if (isset($_GET["error"])){
							if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "<a>Das Bild muss eine JPG-Datei sein.</a>";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "<a>The image must be a JPG file.</a>";};
						};
						echo "<br><br>";
						echo "<input class='safeD' type='submit' name='submit' value='";
						if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Abspeichern";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Save";};
						echo "'>";
					echo "</form>"; 
				}else {
					// Fomluar Tag hinzufügen
					echo "<form enctype='multipart/form-data' method='POST' action=''>";
						echo "<b>";
						if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Tags hinzufügen:";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Add Tags:";};
						echo "</b> ";
						echo "<select name='wal_category' onchange='this.form.submit()' required>";
							echo "<option disabled selected value>";
							if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo " -- Tag hinzufügen -- ";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo " -- Add Tags -- ";};
							echo "</option>";
							$sql2 = "SELECT * FROM categories";
							foreach ($pdo->query($sql2) as $row2) {
								echo "<option value='$row2[cat_id]'>$row2[cat_name]</option>";		
							};			  
						echo"</select>";
					echo "</form>";
				
					// Tag-Vergabe abspeichern
					if (isset($_POST["wal_category"])) {
						$sql = "INSERT INTO wallpaper_has_category (has_wal_id, has_kat_id) VALUES ($_GET[wal_id], $_POST[wal_category])";
						$st=$pdo->prepare($sql);
						$st->execute();
						echo "<meta http-equiv='refresh' content='0; URL=add_wallpaper.php?wal_id=$_GET[wal_id]'>";
					};
					
					// Ausgabe Tags
					$sql2 = "SELECT cat.cat_id, cat.cat_name FROM wallpapers AS wal INNER JOIN wallpaper_has_category AS has ON has.has_wal_id = wal.wal_id INNER JOIN categories AS cat ON cat.cat_id = has.has_kat_id WHERE wal.wal_id = $_GET[wal_id]";
					$st=$pdo->prepare($sql2);
					$st->execute();
					$count = $st->rowCount();
					foreach ($pdo->query($sql2) as $ro2) {
						echo "- $ro2[cat_name] (<a style='color: red;' href='add_wallpaper.php?wal_id=$_GET[wal_id]&delete=$ro2[cat_id]'>";
						if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Löschen";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Delete";};
						echo "</a>)<br>";
					};
				
					// Tag entfernen
					if (isset($_GET["delete"])) {
						$sql = "DELETE FROM wallpaper_has_category WHERE has_wal_id = $_GET[wal_id] AND has_kat_id = $_GET[delete]";
						$st=$pdo->prepare($sql);
						$st->execute();
						echo "<meta http-equiv='refresh' content='0; URL=add_wallpaper.php?wal_id=$_GET[wal_id]'>";
					};
					
					// Abschicken Button
					if ($count != 0) {
						echo "<br><a href='index.php'><button>";
						if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Abschicken";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Send";};
						echo "</button></a><br><br>";
					}else {
						echo "<br><br>";
					};
				};
		echo "</div>";
		
		if (isset($_POST["submit"])) {
			
			// Übergabe Name
			$name		= $_POST["wal_name"];
			
			// Bezeichnung überprüfen
			$sql = "SELECT wal_name FROM wallpapers WHERE wal_name = '$name'";
			$st=$pdo->prepare($sql);
			$st->execute();
			$count = $st->rowCount();
			if ($count > 0) {
				header('Location: add_wallpaper.php?errorn=true');
				exit;
			};
			$st=NULL;
			
			// Namensvergabe für Bild
			$sql = "SELECT MAX(wal_img_id) AS max FROM wallpapers";
			$st=$pdo->prepare($sql);
			$st->execute();
			foreach ($pdo->query($sql) as $bow) {
				$bild = $bow["max"] + 1;
			}
			$jpg = ".jpg";
			
			// Upload vom Bild
			$target_dir = "images/wallpapers/";
			$target_file = $target_dir . $bild . $jpg;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
			// Überprüfung ob die Datei ein echtes Bild ist
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
				};
			};
			
			// Überprüfung Dateigrösse
			if ($_FILES["fileToUpload"]["size"] > 5000000) {
			  echo "Sorry, your file is too large.";
			  $uploadOk = 0;
			}

			// Überprüfung ob das Bild schon existiert
			if (file_exists($target_file)) {
				$uploadOk = 0;
			};
			
			// Überprüfung ob das Bild ein JPG ist
			if($imageFileType !== "jpg") {
				header('Location: add_wallpaper.php?error=true');
				exit;
			};
			
			// Überprüft ob $uploadOk wegen einem Error auf 0 gesetzt ist
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
				
			// wenn alles ok ist, dann wird die Datei hochgeladen
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
				};
			};
			
			$sql = "INSERT INTO wallpapers (wal_name, wal_creator_id, wal_img_id) VALUES ('$name', $creator, $bild)";
			echo "$sql";
			$st=$pdo->prepare($sql);
			$st->execute();
			$last = $pdo->lastInsertId();
			header('Location: add_wallpaper.php?wal_id='. $last . '');
			exit;		
		};	
		if (isset($_GET["wal_id"])) {
			echo "<img class='view_img' src='images/wallpapers/$_GET[wal_id].jpg' alt='Wallpapers'>";
		};
	}else {
		header('Location: index.php');
		exit;		
	};	
	
	// Footer
	include 'footer.php';
?>
	</body>
</html>