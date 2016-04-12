<!DOCTYPE html>
<html>
<?php 
	include 'core/init.php';
?>
<body>
	
	<div id="Holder">
		<?php include 'header.php'; ?>
		<div id="Content">
			
			<div id="ContentLeft">
				<div id="PageHeading">
				
				<h1>Zbiratelji, s katerimi lahko zamenjate največ</h1>

				<?php
					if (logged_in() === true && isset($_GET['id'])) {
						$query = "SELECT *, 111.045*DEGREES(ACOS(COS(RADIANS(X(lokacija))) * COS(RADIANS(" . $user_data['latitude'] . ")) *
             COS(RADIANS(Y(lokacija)) - RADIANS(" . $user_data['longitude'] . ")) +
             SIN(RADIANS(X(lokacija))) * SIN(RADIANS(" . $user_data['latitude'] . ")))) AS distance FROM album, uporabniki WHERE znamkaID= ".$_GET['id'] . " AND userID!=" . $session_user_id . " AND kolicina > 1 AND album.userID = uporabniki.uporabnikID ORDER BY distance ASC";

						$result = $con->query($query);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								//var_dump($row);
								echo "<hr>";
								echo '<div class="menjava-row">';
								echo "<span>";
								echo $row['uporabnisko_ime'];
								echo "</span>";
								echo '<span style="color: gray;">';
								echo " (" . round($row['distance']) . " km)";
								echo "</span>";
								echo "<br>";
								echo '<span style="color: gray;">Uporabnik ima za menjavo na voljo <span style="weight: bold;">' . (intval($row['kolicina']) - 1) . '</span> znamk.</span>';
								echo '</div>';
							}
						}
					}
				?>
			</div>
			</div>
			<div id="ContentRight">
				<?php
					if (logged_in() === true) {

						include 'widgets/loggedin.php';
					} else {

						include 'widgets/login.php';
					}
				?>
			</div>

		</div>
	</div>

</body>


</html>