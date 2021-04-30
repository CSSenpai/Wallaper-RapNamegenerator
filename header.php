<!-- Header -->
<?php
echo "<div class='header'>";
	//  Titel
	echo "<a href='index.php' class='title'>Cool Wallpapers & more</a><a class='scuffed'>(scuffed)</a>";
	
	// Login & Logout
	if (isset($_SESSION['loggedin'])) {
		echo "<a href='logout.php' ><button class='logout' type='button'>Logout</button></a>";
	}else {
		echo "<a href='login.php' ><button class='logout' type='button'>Login</button></a>";
	};
	
	echo "<a href='header.php?lang=en'><img class='lang' style='margin-left: 5px; height: 20px;' src='images/icons/en.png' alt='englisch'></a>";
	echo "<a href='header.php?lang=de'><img class='lang' style='height: 20px;' src='images/icons/de.png' alt='deutsch'></a>";
	
	// Darkmode
	echo "<span class='logout'>Darkmode: <a href='header.php?mode=dark'>On</a> / <a href='header.php?mode=light'>Off</a></span>";
	if (isset($_GET["mode"])) {
		session_start();
		if ($_GET["mode"] == 'dark') {
			$_SESSION['mode'] = "styles_d";
		}elseif ($_GET["mode"] == 'light') {
			$_SESSION['mode'] = "styles";
		};
		$previous = "javascript:history.go(-1)";
		if(isset($_SERVER['HTTP_REFERER'])) {
			$previous = $_SERVER['HTTP_REFERER'];
		}
		header('Location: ' . $previous . '');
	}
	if (isset($_GET["lang"])) {
		session_start();
		if ($_GET["lang"] == 'en') {
			$_SESSION['lang'] = "en";
		}elseif ($_GET["lang"] == 'de') {
			$_SESSION['lang'] = "de";
		};
		$previous = "javascript:history.go(-1)";
		if(isset($_SERVER['HTTP_REFERER'])) {
			$previous = $_SERVER['HTTP_REFERER'];
		}
		header('Location: ' . $previous . '');
	};
echo "</div>";
echo "<br><br><br><br>";
?>