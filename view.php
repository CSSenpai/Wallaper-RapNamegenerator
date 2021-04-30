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
		// Header
		include 'header.php';
		
		echo "<div style='margin-left: 10px;'>";
		
			// Zurück-Button
			echo "<a href='index.php'><button>";
			if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Zurück";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Back";};
			echo "</button><hr></a>";
			
			if (isset($_GET["random"])) {
				// Random Wallpaper
				$sql = "SELECT * FROM wallpapers ORDER BY RAND() LIMIT 1";
			}else {
				// Bestimmtes Wallpaper
				$sql = "SELECT * FROM wallpapers WHERE wal_id = $_GET[id]";
			};
			
			foreach ($pdo->query($sql) as $row) {
				// Ausgabe Bild
				echo "<a style='font-size: 30px;'><u>$row[wal_name]</u></a>";
				echo "<a> (";
				$sql2 = "SELECT cat.cat_id, cat.cat_name FROM wallpapers AS wal INNER JOIN wallpaper_has_category AS has ON has.has_wal_id = wal.wal_id INNER JOIN categories AS cat ON cat.cat_id = has.has_kat_id WHERE wal.wal_id = $row[wal_id]";
				$st=$pdo->prepare($sql2);
				$st->execute();
				$count = $st->rowCount();
				$c_check = 0;
				foreach ($pdo->query($sql2) as $ro2) {
					$c_check = $c_check + 1;
					echo "$ro2[cat_name]";
					if ($count != $c_check) {
						echo ", ";
					};
				};
				echo ")</a><br>";
				echo "<img class='view_img' src='images/wallpapers/$row[wal_img_id].jpg' alt='Wallpapers'><br>";
				echo "<a href='images/wallpapers/$row[wal_img_id].jpg' download><img src='images/icons/download.png' style='width: 200px;' alt='Download'></a>";
				$id 		= $row["wal_id"];
				$creator 	= $row["wal_creator_id"];
			};
			
		echo "</div>";
		
		// Footer
		include 'footer.php';
?>
	</body>
</html>