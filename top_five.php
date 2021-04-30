<br><hr><h2>Top 5 Wallpapers</h2>
<?php
	//Auswahl der Top 5
	$sql_g = "SELECT * FROM wallpapers ORDER BY wal_like DESC, wal_dislike ASC LIMIT 5";
	$stg=$pdo->prepare($sql_g);
	$stg->execute();
	
	//Ausgabe der Top 5
	echo "<ol style='padding-left: 20px;'>";
		foreach ($pdo->query($sql_g) as $rog) {
			echo "<a href='view.php?id=$rog[wal_id]'><li>$rog[wal_name]</a> ($rog[wal_like] Likes)</li>";
		};
	echo "</ol>";
?>
