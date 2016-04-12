<?php 
	include 'core/init.php';

	if (empty($_POST) === false) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username) || empty($password)) {
			$errors[] = 'vnesti moras uporabnisko ime IN geslo!';
		}
		else if (user_exists($username) === false) {
			$errors[] = 'uporabnisko ime ne obstaja!';
		}
		else if (user_active($username) === false) {
			$errors[] = 'račun se ni aktiviran. Preveri mail!';
		} else {

			if (strlen($password) > 50) {
				$errors[] = 'geslo je predolgo!';
			}

			$login = login($username, $password);

			if ($login === false) {
				$errors[] = 'uporabnisko ime / geslo ni pravilno. Poskusi znova.';
			} else {
				$_SESSION['user_id'] = $login;
				header('Location: index.php');
				exit();
			}
		}
	} else {
		$errors[] = 'podatki niso bili posredovani.';
	}

	include 'header.php';

	if (empty($errors) === false) {
		?>

		<h1>Pri poskusu prijave je prišlo do napake: </h1>

		<?php

		echo output_errors($errors);
	}
?>

<a href="index.php">Domov</a>
