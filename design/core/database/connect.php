<?php 
	$connect_error = 'Pardon, samo je prišlo do neke napake.';
	mysql_connect('localhost', 'root', 'password') or die ($connect_error);
	mysql_select_db('znamke_db') or die($connect_error);

?>
