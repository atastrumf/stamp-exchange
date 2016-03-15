<?php 

	function user_exists($username) {
		$username = spucaj($username);
		return (mysql_result(mysql_query("SELECT COUNT(`uporabnikID`) FROM `uporabniki` WHERE `uporabnisko_ime` = '$username'"), 0) == 1) ? true : false;
	}

	function user_active($username) {
		$username = spucaj($username);
		return (mysql_result(mysql_query("SELECT COUNT(`uporabnikID`) FROM `uporabniki` WHERE `uporabnisko_ime` = '$username' AND `aktiviran` = 1"), 0) == 1) ? true : false;
	}

?>
