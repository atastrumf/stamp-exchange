<!DOCTYPE HTML>
<html>
	<head>
		 <meta charset="UTF-8"> 
	</head>
	
	<body>	
	<?php
	
		echo '<script language="javascript">';
		echo 'alert("message successfully sent")';
		echo '</script>';
		
		include 'core/init.php';
		include 'core/database/connect.php';		
		
		if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		}
		
		$akcija = $_POST['akcija'];
		$znamkaID = $_POST['id'];
		$userID = $_SESSION['user_id'];
		//$userID = 1;
		
		$query = "SELECT * FROM album WHERE userID = $userID AND znamkaID = $znamkaID";			
		$result = $con->query($query);
			
		if ($akcija == 'plus') {
			if ($result->num_rows > 0){			
				$row = $result->fetch_assoc();
				$kolicina = $row["kolicina"];
				$kolicina = $kolicina + 1;
				$query = "UPDATE album SET kolicina = $kolicina WHERE znamkaID = $znamkaID";
			}	
			else  {
				$query = "INSERT INTO album (userID, znamkaID, kolicina) VALUES ('$userID','$znamkaID','1')";
			}	
			$result = $con->query($query);			
		}		

		else if ($akcija == 'minus') {
			if ($result->num_rows > 0){			
				$row = $result->fetch_assoc();
				$kolicina = $row["kolicina"];
				$kolicina = $kolicina - 1;
				$query = "UPDATE album SET kolicina = $kolicina WHERE znamkaID = $znamkaID";
				$result = $con->query($query);	
			}	
			
			if ($kolicina == 0) {
				$query = "DELETE FROM album WHERE userID = $userID AND znamkaID = $znamkaID";			
				$result = $con->query($query);				
			} 			
		}
	?> 
	
	</body>
</html>