<?php

	function register_user($register_data) {

		array_walk($register_data, 'spucaj_array');
		$register_data['geslo'] = md5($register_data['geslo']);

		$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
		$data = '\'' . implode('\', \'', $register_data) . '\'';

		mysqli_query(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), "INSERT INTO `uporabniki` ($fields) VALUES ($data)");
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
		$result = mysqli_query(mysqli_connect('localhost', 'root', 'password', 'znamke_db'), $query);

		return $result->fetch_assoc();
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
