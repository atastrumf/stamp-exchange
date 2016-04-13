<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'> 
	<meta name="google-signin-client_id" content="znamke-1253">	
	<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>
	<script>
	$(document).ready(function(){			
			$('.urediAlbum').click(
			function() {
				var znamkaID;
				var className = $('#znamka'+znamkaID).attr('class');
				if ($(this).attr('id') == 'plus') {
					znamkaID = $(this).prev().prev().attr('id');					
					//alert("Znamka dodana!");
					//$('#regTitle').empty().append(newcontent);
					var kolicina = parseInt($('.kolicina#kolicina'+znamkaID).html());
					//alert(kolicina);
					kolicina =  kolicina + 1;
					
					//$('.kolicina#'+znamkaID).empty().append(kolicina);
					$('.kolicina#kolicina'+znamkaID).empty().append(kolicina);
					//alert(kolicina);
				}
				else if ($(this).attr('id') == 'minus') {
					znamkaID = $(this).prev().prev().prev().attr('id');		
					var kolicina = parseInt($('.kolicina#kolicina'+znamkaID).html());
					if ( kolicina != 0)
						kolicina =  kolicina - 1;
					$('.kolicina#kolicina'+znamkaID).empty().append(kolicina);					
					//alert("Znamka odstranjena!");
				}			

				if ( kolicina == 0 ) {
					$('#znamka'+znamkaID).removeClass('znamka');
					$('#znamka'+znamkaID).addClass('znamkaManjka');
				} else {
					$('#znamka'+znamkaID).removeClass('znamkaManjka');
					$('#znamka'+znamkaID).addClass('znamka');
				}
					
				var sendAkcija = $(this).attr('id');
				$.post( "urejanjealbuma.php", { akcija: sendAkcija, id: znamkaID });
			}
			);
		});
	</script>
</head>
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
				<form method='POST' action='album.php' name='leto' id='leto'>
				<br><select width='200px' form='leto' name='izbiraLeta' class="StyleTxtField2">";
				<?php
				for ($i = 1991; $i < 2017; $i++) {	
					if (isset($_POST["izbiraLeta"]) && $i == $_POST["izbiraLeta"])					
						echo "<option value=".$i." selected='selected'>".$i."</option>";
					else
						echo "<option value=".$i.">".$i."</option>";
				}
				?>
				<input id='button' class="StyleTxtField3" type='submit' name='submit' value='IZBERI'></select></td></tr><br>
				
				<?php
				$userID = $_SESSION['user_id'];
				//$userID = 1;
				if (isset($_POST["izbiraLeta"])) {
					$izbiraLeta=$_POST['izbiraLeta'];
				
					mysqli_query($con,"SET NAMES utf8");
					mysqli_query($con,"SET CHARACTER SET utf8");
					mysqli_query($con,"SET COLLATION_CONNECTION='utf8_general_ci'");
				
					$query = "SELECT * FROM znamka WHERE YEAR(STR_TO_DATE(datumIzdaje, '%d.%m.%Y')) = ".$izbiraLeta."";
					$result = $con->query($query);
					
					if ($result->num_rows > 0) {
						echo "<table><tr>";
						$i = 5;
						while($row = $result->fetch_assoc()) {
							$query2 = "SELECT * FROM album WHERE userID = $userID AND znamkaID = ".$row['ID_slika'];	
							$result2 = $con->query($query2);
							
							if ($i==5) {
								echo "</tr><tr>";
								$i = 0;
							}
								

							echo "<td id='znamkaSeznam'>
							<a href='znamka.php?ID_slika=" . $row['ID_slika'] . "' id='" . $row['ID_slika'] . "'>";
							
							if ($result2->num_rows > 0) {
								echo "
							<img class='znamka' id='znamka" . $row['ID_slika'] . "'src='data:image/jpeg;base64,".base64_encode( $row['slika'] )."'/>
							<figcaption>".$row['naziv']."</figcaption>
							</a>";
								$row2 = $result2->fetch_assoc();
								echo "<div class = 'kolicina' id='kolicina". $row['ID_slika'] ."'>" . $row2['kolicina'] . "</div>";
							}
							
							else {
								echo "
							<img class='znamkaManjka' id='znamka" . $row['ID_slika'] . "'src='data:image/jpeg;base64,".base64_encode( $row['slika'] )."'/>
							<figcaption>".$row['naziv']."</figcaption>
							</a>";
								echo "<div class = 'kolicina' id='kolicina". $row['ID_slika'] ."'>0</div>";
							}
							
							echo "<a id='plus' class='urediAlbum'><img src='plus.png' alt='Dodaj znamko' height='20' width='20'></img></a> <a id='minus' class='urediAlbum'><img src='minus.png' alt='Odstrani znamko' height='21' width='21'></img></a> <br><a href='menjavanje.php?id=" . $row['ID_slika'] . "'>Išči</a>
							</td>";
							$i++;
						}
						
						$result->free();
						$con->close();
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
