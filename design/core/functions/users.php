<?php

	function register_user($register_data) {

		array_walk($register_data, 'spucaj_array');
		$register_data['geslo'] = md5($register_data['geslo']);

		$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
		$data = '\'' . implode('\', \'', $register_data) . '\'';

		mysqli_query(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), "INSERT INTO `uporabniki` ($fields) VALUES ($data)");
	}

	function update_user($update_data) {

		array_walk($update_data, 'spucaj_array');

		mysqli_query(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), "UPDATE `uporabniki` SET "
			. "email='" . $update_data['email'] . "', "
			. "ime='" . $update_data['ime'] . "', "
			. "priimek='" . $update_data['priimek'] . "', "
			. "naslov='" . $update_data['naslov'] . "', "
			. "posta='" . $update_data['posta'] . "', "
			. "telefonska='" . $update_data['telefonska'] . "', "
			. "spol='" . $update_data['spol'] . "', "
			. "starost='" . $update_data['starost'] . "'"
			. "WHERE uporabnisko_ime='" . $update_data['uporabnisko_ime'] . "'");
	}

	function common_user_data($session_user_id) {
		return user_data($session_user_id, 'uporabnikID', 'uporabnisko_ime', 'geslo', 'email', 'ime', 'priimek', 'naslov', 'posta', 'telefonska', 'spol', 'starost');
	}

	function user_data($user_id) {
		$data = array();
		$user_id = (int)$user_id;

		$func_num_args = func_num_args();
		$func_get_args = func_get_args();

		if ($func_num_args > 0) {
			unset($func_get_args[0]);

			$fields = '`' . implode('`, `', $func_get_args) . '`';

			$query = "SELECT $fields FROM `uporabniki` WHERE `uporabnikID` = $user_id";
			$result = mysqli_query(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $query);
			$data = mysqli_fetch_assoc($result);

			echo mysqli_fetch_assoc($result);

			return $data;
		}
	}

	function logged_in() {
		return (isset($_SESSION['user_id'])) ? true : false;
	}

	function user_exists($username) {

		$username = mysqli_real_escape_string(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $username);

		$query = "SELECT * FROM `uporabniki` WHERE `uporabnisko_ime` = '$username'";
		$result = mysqli_query(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $query);

		if($result->num_rows)
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}

	function email_exists($email) {

		$email = mysqli_real_escape_string(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $email);

		$query = "SELECT * FROM `uporabniki` WHERE `email` = '$email'";
		$result = mysqli_query(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $query);

		if($result->num_rows)
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}

	function user_active($username) {

		$username = mysqli_real_escape_string(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $username);

		$query = "SELECT * FROM `uporabniki` WHERE `uporabnisko_ime` = '$username' AND `aktiviran` = 1";
		$result = mysqli_query(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $query);

		if($result->num_rows)
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}

	function user_id_from_username($username) {

		$username = mysqli_real_escape_string(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $username);

		$query = "SELECT `uporabnikID` FROM `uporabniki` WHERE `uporabnisko_ime` = '$username'";
		$result = mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $query));

		$userID = $result['uporabnikID'];

		return $userID;
	}

	function login($username, $password) {
		$user_id = user_id_from_username($username);

		$username = mysqli_real_escape_string(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $username);

		$password = md5($password);

		$query = "SELECT * FROM `uporabniki` WHERE `uporabnisko_ime` = '$username' AND `geslo` = '$password'";
		$result = mysqli_query(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $query);

		if($result->num_rows) 
		{
			return $user_id;
		}
		else
		{
			return false;
		}
	}

?>
