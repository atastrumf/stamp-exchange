<!DOCTYPE html>
<html>
<?php 
	include 'core/init.php';
	include 'core/database/connect.php';
	include 'head.php';
?>

<body>
	
	<div id="Holder">
		<?php include 'header.php'; ?>
		<div id="Content">
			
			<div id="ContentLeft">
				<div id="PageHeading">
				
				<?php
				$id_slika = $_GET["ID_slika"];
				
				mysqli_query($con,"SET NAMES utf8");
				mysqli_query($con,"SET CHARACTER SET utf8");
				mysqli_query($con,"SET COLLATION_CONNECTION='utf8_general_ci'");

				$query = "SELECT * FROM `znamka` WHERE ID_slika = '$id_slika'";
				$result = $con->query($query);
				$row = $result->fetch_assoc();
		
				echo "<h1>".$row["naziv"]."</h1>";
		
							
				?>
				</div>				
					
				
				<table id="znamkaPodrobnosti">	
					<?php 
					
					if (isset($row['slika']) && $row['slika'] != NULL)
						echo "<td rowspan='14' id='znamkaPodrobno'><img src='data:image/jpeg;base64,".base64_encode( $row['slika'] )."'/></td>";
					
					$polja = array($row["naziv"], $row["datumIzdaje"], $row["risba"], $row["oblikovanje"], $row["motiv"], $row["tisk"], $row["izvedba"], $row["pola"], $row["papir"], $row["velikost"], $row["zobci"], $row["zobcanje"], $row["foto"], $row["opomba"]);
					$poljaText = array("Naziv", "Datum izdaje", "Risba", "Oblikovanje", "Motiv", "Tisk", "Izvedba", "Pola", "Papir", "Velikost", "Zobci", "Zobcanje", "Foto", "Opomba");
					
					for ($i = 0; $i < 14; $i++) {
					if (isset($polja[$i]) && $polja[$i] != NULL) {
						echo "
							<tr>
							<td>".$poljaText[$i].":</td>
							<td>".$polja[$i]."</td>
						</tr>";
						}
					}
					?>
				
					
				</table>
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
