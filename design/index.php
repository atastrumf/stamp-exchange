<!DOCTYPE html>
<html>
<?php 
	include 'core/init.php';
	include 'core/database/connect.php';
?>
<body>
	
	<div id="Holder">
		<?php include 'header.php'; ?>
		<div id="Content">
			
			<div id="ContentLeft">
				<div id="PageHeading">
				
				<h1>Moje znamke</h1>			

				</div>				
					
				<tr><td class='meni'>
				<form method='POST' action='index.php' name='leto' id='leto'>
				<br><select 'width='200px' form='leto' name='izbiraLeta'>";
				<?php
				for ($i = 1991; $i < 2017; $i++) {	
					if (isset($_POST["izbiraLeta"]) && $i == $_POST["izbiraLeta"])					
						echo "<option value=".$i." selected='selected'>".$i."</option>";
					else
						echo "<option value=".$i.">".$i."</option>";
				}
				?>
				<input id='button' type='submit' name='submit' value='Izberi'></select></td></tr><br>
				
				<?php
				if (isset($_POST["izbiraLeta"])) {
					$izbiraLeta=$_POST['izbiraLeta'];
				
					$query = "SELECT * FROM znamka WHERE YEAR(STR_TO_DATE(datumIzdaje, '%d.%m.%Y')) = ".$izbiraLeta."";
					$result = $con->query($query);
					
					if ($result->num_rows > 0) {
						echo "<table><tr>";
						$i = 5;
						while($row = $result->fetch_assoc()) {
							
							if ($i==5) {
								echo "</tr><tr>";
								$i = 0;
							}
								
							echo '<td><img src="data:image/jpeg;base64,'.base64_encode( $row['slika'] ).'"/></td>';
							$i++;
						}
						echo "</tr></table>";
					}
				}
				?>
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
