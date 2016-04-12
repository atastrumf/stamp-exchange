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
				
				<h1>Menjavanje</h1>

				<?php
					if (logged_in() === true && isset($_GET['id'])) {
						$query = "SELECT *, (GLength(LineStringFromWKB(LineString(lokacija, GeomFromText('POINT(" . $user_data['latitude'] . " " . $user_data['longitude'] . ")'))))) AS distance FROM album, uporabniki WHERE znamkaID= ".$_GET['id'] . " AND userID!=" . $session_user_id . " AND kolicina > 1 AND album.userID = uporabniki.uporabnikID ORDER BY distance ASC";

						$result = $con->query($query);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo $row['uporabnisko_ime'] . "<br>"; // . ", razdalja: " . $row['distance'] . "<br>";
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