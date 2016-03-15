<?php include 'head.php' ?>

<?php 
	include 'core/init.php';

	if (empty($_POST) === false) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username) || empty($password)) {
			$errors[] = 'Vnesti moraš uporabniško ime in geslo!';
		}
		else if (user_exists($username) === false) {
			$errors[] = 'Uporabniško ime ne obstaja!';
		}
		else if (user_active($username) === false) {
			$errors[] = 'Račun še ni aktiviran. Preveri mail!';
		} else {

		}

		print_r($errors);
	}

?>