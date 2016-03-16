<?php 

	function register_user($register_data) {

		array_walk($register_data, 'spucaj_array');
		$register_data['geslo'] = md5($register_data['geslo']);

		$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
		$data = '\'' . implode('\', \'', $register_data) . '\'';

		mysql_query("INSERT INTO `uporabniki` ($fields) VALUES ($data)");
	}

	function user_data($user_id) {
		$data = array();
		$user_id = (int)$user_id;

		$func_num_args = func_num_args();
		$func_get_args = func_get_args();

		if ($func_num_args > 0) {
			unset($func_get_args[0]);

			$fields = '`' . implode('`, `', $func_get_args) . '`';
			$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `uporabniki` WHERE `uporabnikID` = $user_id"));

			return $data;
		}
	}

	function logged_in() {
		return (isset($_SESSION['user_id'])) ? true : false;
	}

	function user_exists($username) {
		$username = spucaj($username);
		return (mysql_result(mysql_query("SELECT COUNT(`uporabnikID`) FROM `uporabniki` WHERE `uporabnisko_ime` = '$username'"), 0) == 1) ? true : false;
	}

	function email_exists($email) {
		$email = spucaj($email);
		return (mysql_result(mysql_query("SELECT COUNT(`uporabnikID`) FROM `uporabniki` WHERE `email` = '$email'"), 0) == 1) ? true : false;
	}

	function user_active($username) {
		$username = spucaj($username);
		return (mysql_result(mysql_query("SELECT COUNT(`uporabnikID`) FROM `uporabniki` WHERE `uporabnisko_ime` = '$username' AND `aktiviran` = 1"), 0) == 1) ? true : false;
	}

	function user_id_from_username($username) {
		$username = spucaj($username);
		return mysql_result(mysql_query("SELECT `uporabnikID` FROM `uporabniki` WHERE `uporabnisko_ime` = '$username'"), 0, 'uporabnikID');
	}

	function login($username, $password) {
		$user_id = user_id_from_username($username);

		$username = spucaj($username);
		$password = md5($password);

		return (mysql_result(mysql_query("SELECT COUNT(`uporabnikID`) FROM `uporabniki` WHERE `uporabnisko_ime` = '$username' AND `geslo` = '$password'"), 0) == 1) ? $user_id : false;
	}

?>
