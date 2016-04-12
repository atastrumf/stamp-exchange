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

				<?php
					if (logged_in() === true && isset($_GET['id']) && isset($_GET['withUser'])) {
						$znamkaID = $_GET['id'];
						$otherUserID = $_GET['withUser'];

						$otherUser = common_user_data($otherUserID);
				?>
					<div>
						<h1>Pogovarjate se z uporabnikom: <?php echo $otherUser['uporabnisko_ime']; ?></h1>
						<div id="chatwindow">
						 <div id="messagewindow">
						    <p><?php echo $user_data['uporabnisko_ime']; ?>: Zdravo, bi bil zainteresiran za menjavo?</p>
						    <p><?php echo $otherUser['uporabnisko_ime']; ?>: Seveda, imam tako prevec teh znamk.</p>
						    <p><?php echo $user_data['uporabnisko_ime']; ?>: Super!</p>
						 </div>
						</div>
     
						<form name="message" action="index.php">
						    <input name="usermsg" type="text" id="usermsg" size="63" />
						    <input name="submitmsg" type="submit"  id="submitmsg" value="Pošlji" />
						    <input name="submitmsg" type="submit"  id="submitmsg" value="Zaključi menjavo" />
						</form>
					</div>
				<?php
					}
					else if (logged_in() === true && isset($_GET['id'])) {
						echo "<h1>Zbiratelji, s katerimi lahko zamenjate največ</h1>";

						$query = "SELECT *, 111.045*DEGREES(ACOS(COS(RADIANS(X(lokacija))) * COS(RADIANS(" . $user_data['latitude'] . ")) *
             COS(RADIANS(Y(lokacija)) - RADIANS(" . $user_data['longitude'] . ")) +
             SIN(RADIANS(X(lokacija))) * SIN(RADIANS(" . $user_data['latitude'] . ")))) AS distance FROM album, uporabniki WHERE znamkaID= ".$_GET['id'] . " AND userID!=" . $session_user_id . " AND kolicina > 1 AND album.userID = uporabniki.uporabnikID ORDER BY distance ASC";

						$result = $con->query($query);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								//var_dump($row);
								echo "<hr>";
								echo '<div class="menjava-row"><a href="menjavanje.php?id=' . $_GET['id'] . '&withUser=' . $row['userID'] . '">';
								echo "<span>";
								echo $row['uporabnisko_ime'];
								echo "</span>";
								echo '<span style="color: gray;">';
								echo " (" . round($row['distance']) . " km)";
								echo "</span></a>";
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