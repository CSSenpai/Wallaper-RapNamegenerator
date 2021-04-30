<?php
	include 'dbconnect.php';
	
	// Cookie Bewertung
	if (isset($_GET["wal_id"])) {
		$rate = $_GET["rate"];
		$wal_id = $_GET["wal_id"];
		
		// Cookie läuft in 30 Tagen ab
		setcookie($wal_id, $rate, time() + (86400 * 30), "/");

		echo "<meta http-equiv='refresh' content='0; URL=index.php'>";
	};
?>
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
		
		// Wallpaper hochladen
		echo "<a style='margin-left: 10px;' href='";
		if (isset($_SESSION['loggedin'])) {
			echo "add_wallpaper.php";
		}else {
			echo "login.php?add=true";
		};
		echo "'><button>";
		if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo "Wallpaper hochladen";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo "Upload Wallpaper";};
		echo "</button></a>";
		
		// Random Wallpaper
		echo "<a style='margin-left: 10px;' href='view.php?random=true'><button>Random Wallpaper</button></a>";
		
		//Filter Dropdown
		echo "<form style='float: left; margin-left: 10px;' enctype='multipart/form-data' method='POST' action=''>";
			echo "Filter: ";
			echo "<select name='wal_category' onchange='this.form.submit()' required>";
				echo "<option disabled selected value>";
				if (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'de') { echo " -- Tags hinzufügen -- ";}elseif (isset($_SESSION['lang']) AND $_SESSION['lang'] == 'en' OR !isset($_SESSION['lang'])) { echo " -- Add Tags -- ";};
				echo "</option>";
				$sql2 = "SELECT * FROM categories";
				foreach ($pdo->query($sql2) as $row2) {
					echo "<option value='$row2[cat_id]' ";
					if (isset($_POST["wal_category"])) {
						if ($row2["cat_id"] == $_POST["wal_category"]) {
							echo "selected";
						};
					};
					echo ">$row2[cat_name]</option>";		
				};			  
			echo"</select>";
		echo "</form>";
		if (isset($_POST["wal_category"])) {
			echo "<a style='margin-left: 5px; float: left;' href='index.php'>";
			if (isset($_SESSION['mode']) AND $_SESSION['mode'] == "styles_d") {
				echo "<img style='height: 10px;' src='images/icons/test_w.png' alt='entfernen'>";
			}elseif (isset($_SESSION['mode']) AND $_SESSION['mode'] == "styles" OR !isset($_SESSION['mode'])) {
				echo "<img style='height: 10px;' src='images/icons/test.png' alt='entfernen'>";
			};
			echo "</a>";
		}
		echo "<hr>";
			
		// DIV Links	
		echo "<div style='margin-left: 10px; float: left; width: 69%;'>";		
			echo "<div style='float: left;'>";
				if (isset($_POST["wal_category"])) {
					// Auswahl Filter
					$sql = "SELECT * FROM wallpapers AS wal INNER JOIN wallpaper_has_category AS has ON has.has_wal_id = wal.wal_id  WHERE has.has_kat_id = $_POST[wal_category]";
				}elseif(isset($_SESSION['usr_auth']) AND $_SESSION['usr_auth'] == 1) {
					// Auswahl Admin
					$sql = "SELECT * FROM wallpapers ORDER BY wal_status ASC";
				}else {
					// Auswahl Normal
					$sql = "SELECT * FROM wallpapers WHERE wal_status = 1";
				};
				// Ausgabe Wallpaper & Infos
				foreach ($pdo->query($sql) as $row) {
					$wal_id = $row["wal_id"];

					echo "<div class='preview_div'>";
						echo "<a href='view.php?id=$row[wal_id]'><img class='preview_img' src='images/wallpapers/$row[wal_img_id].jpg' alt='Wallpapers'></a><br>";
						echo "<div>";
							echo "<a href='view.php?id=$row[wal_id]'>$row[wal_name]</a><br><br>";
							if (isset($_SESSION['mode']) AND $_SESSION['mode'] == "styles_d") {
								// User hat Wallpaper geliked
								if (isset($_COOKIE[$wal_id]) AND $_COOKIE[$wal_id] == 'like' AND isset($_SESSION['loggedin'])) {
									echo "<a><img src='images/icons/top_w.png' style='opacity: 0.6;' class='like' alt='Like'><a style='margin-right: 10px;'>$row[wal_like]</a></a>";
									echo "<a><img src='images/icons/down_w.png' class='like' alt='Disike'><a>$row[wal_dislike]</a></a><br>";
								// User hat Wallpaper gedisliked
								}elseif (isset($_COOKIE[$wal_id]) AND $_COOKIE[$wal_id] == 'dislike' AND isset($_SESSION['loggedin'])) {
									echo "<a><img src='images/icons/top_w.png' class='like' alt='Like'><a style='margin-right: 10px;'>$row[wal_like]</a></a>";
									echo "<a><img src='images/icons/down_w.png' style='opacity: 0.6;' class='like' alt='Disike'><a>$row[wal_dislike]</a></a><br>";
								// User hat Wallpaper noch nicht bewertet
								}else {
									echo "<a href='index.php?like=$row[wal_id]'><img src='images/icons/top_w.png' class='like' alt='Like'><a style='margin-right: 10px;'>$row[wal_like]</a></a>";
									echo "<a href='index.php?dislike=$row[wal_id]'><img src='images/icons/down_w.png' class='like' alt='Disike'><a>$row[wal_dislike]</a></a><br>";
								};
							}elseif (isset($_SESSION['mode']) AND $_SESSION['mode'] == "styles" OR !isset($_SESSION['mode'])) {
								// User hat Wallpaper geliked
								if (isset($_COOKIE[$wal_id]) AND $_COOKIE[$wal_id] == 'like' AND isset($_SESSION['loggedin'])) {
									echo "<a><img src='images/icons/top.png' style='opacity: 0.6;' class='like' alt='Like'><a style='margin-right: 10px;'>$row[wal_like]</a></a>";
									echo "<a><img src='images/icons/down.png' class='like' alt='Disike'><a>$row[wal_dislike]</a></a><br>";
								// User hat Wallpaper gedisliked
								}elseif (isset($_COOKIE[$wal_id]) AND $_COOKIE[$wal_id] == 'dislike' AND isset($_SESSION['loggedin'])) {
									echo "<a><img src='images/icons/top.png' class='like' alt='Like'><a style='margin-right: 10px;'>$row[wal_like]</a></a>";
									echo "<a><img src='images/icons/down.png' style='opacity: 0.6;' class='like' alt='Disike'><a>$row[wal_dislike]</a></a><br>";
								// User hat Wallpaper noch nicht bewertet
								}else {
									echo "<a href='index.php?like=$row[wal_id]'><img src='images/icons/top.png' class='like' alt='Like'><a style='margin-right: 10px;'>$row[wal_like]</a></a>";
									echo "<a href='index.php?dislike=$row[wal_id]'><img src='images/icons/down.png' class='like' alt='Disike'><a>$row[wal_dislike]</a></a><br>";
								};
							};
							echo "<a href='images/wallpapers/$row[wal_img_id].jpg' download><img src='images/icons/download.png' style='width: 200px;' alt='Download'></a>";
						echo "</div>";
						if ($row["wal_status"] == 0) {
							echo "<a style='float: right; margin-right: 50px; margin-top: -20px;' href='index.php?delete=$row[wal_id]'>DELETE</a>";
							echo "<a style='float: right; margin-right: 10px; margin-top: -20px;' href='index.php?publish=$row[wal_id]'>OK</a>";
						};
					echo "</div>";
				};
			echo "</div>";
		echo "</div>";	

		// DIV Rechts
		echo "<div style='float: left; width: 30%;'>";
			// Rap-Name Generator
			include 'generator.php';
			// Top 5 Wallpapers
			include 'top_five.php';
		echo "</div>";
		
		// Footer
		include 'footer.php';
		
//----- SQL Statements -----------------------------------------------------------------------------------------------------------------
		
		// Vergabe +1 Like
		if (isset($_GET["like"]) AND isset($_SESSION['loggedin'])) {
				
			$sql = "SELECT wal_like FROM wallpapers WHERE wal_id = $_GET[like]";
			foreach ($pdo->query($sql) as $row) {
				$like = $row["wal_like"];
				$new_like = $like + 1;
			};
			
			$sql = "UPDATE wallpapers SET wal_like = '$new_like' WHERE wal_id = $_GET[like];";
			$st=$pdo->prepare($sql);
			$st->execute();
			
			$wal_id = $_GET["like"];
			echo "<meta http-equiv='refresh' content='0; URL=index.php?wal_id=$wal_id&rate=like'>";
			
		// Vergabe +1 Dislike
		}elseif (isset($_GET["dislike"]) AND isset($_SESSION['loggedin'])) {
				
			$sql = "SELECT wal_dislike FROM wallpapers WHERE wal_id = $_GET[dislike]";
			foreach ($pdo->query($sql) as $row) {
				$dislike = $row["wal_dislike"];
				$new_dislike = $dislike + 1;
			};
			
			$sql = "UPDATE wallpapers SET wal_dislike = '$new_dislike' WHERE wal_id = $_GET[dislike];";
			$st=$pdo->prepare($sql);
			$st->execute();
			
			$wal_id = $_GET["dislike"];
			echo "<meta http-equiv='refresh' content='0; URL=index.php?wal_id=$wal_id&rate=dislike'>";
		
		// User nicht eingeloggt
		}elseif (isset($_GET["like"]) AND !isset($_SESSION['loggedin']) OR isset($_GET["dislike"]) AND !isset($_SESSION['loggedin'])) {
				echo "<meta http-equiv='refresh' content='0; URL=login.php'>";
		};
		
		// Wallpaper Löschen
		if (isset($_GET["delete"])) {
			$sql = "DELETE FROM wallpapers WHERE wal_id = $_GET[delete]";
			$st=$pdo->prepare($sql);
			$st->execute();
			$pdo->exec("DELETE FROM wallpaper_has_category WHERE has_wal_id = $_GET[delete]");
			$pdo->exec("ALTER TABLE wallpapers AUTO_INCREMENT = 1");
			
			$img_id = $_GET["delete"];
			$target = "images/wallpapers/";
			
			// Bild wird aus dem Ordner gelöscht
			$myFile = "$target" . "" . "$img_id" . ".jpg";
			unlink($myFile) or die("Couldn't delete file");
			
			echo "<meta http-equiv='refresh' content='0; URL=index.php'>";
		};
		
		// Wallpaper Veröffentlichen
		if (isset($_GET["publish"])) {
			$sql = "UPDATE wallpapers SET wal_status = 1 WHERE wal_id = $_GET[publish];";
			$st=$pdo->prepare($sql);
			$st->execute();
			echo "<meta http-equiv='refresh' content='0; URL=index.php'>";
		};
?>
	</body>
</html>