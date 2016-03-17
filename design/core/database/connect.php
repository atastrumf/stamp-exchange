<?php 
	$connect_error = 'Pardon, samo je prišlo do neke napake.';
	$con = mysqli_connect('localhost', 'root', 'password') or die ($connect_error);
	mysqli_select_db($con, 'znamke_db') or die($connect_error);
?>
