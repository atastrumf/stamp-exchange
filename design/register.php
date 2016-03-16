<?php 
	include 'core/init.php';
	if (empty($_POST) === false) {
	
		$required_fields = array('username', 'password', 'confirmpassword', 'email');

		foreach ($_POST as $key => $value) {
			
			if (empty($value) && in_array($key, $required_fields) === true) {
				$errors[] = 'niso izpolnjena vsa zahtevana polja, označena z zvezdico (*).';
				break 1;
			}
		}
	}

	if (empty($errors) === true) {
		if (user_exists($_POST['username']) === true) {
			$errors[] = 'uporabniško ime \'' . $_POST['username'] . '\'  je že zasedeno.';
		}
		if (preg_match("/\\s/", $_POST['username']) == true) {
			$errors[] = 'uporabniško ime ne sme vsebovati presledkov.';
		}
		if (strlen($_POST['password']) < 6 || strlen($_POST['password']) > 35) {
			$errors[] = 'geslo more vsebovati minimalno 6 znakov in ne sme vsebovati več kot 35 znakov.';
		}
		if ($_POST['password'] !== $_POST['confirmpassword']) {
			$errors[] = 'gesli se ne ujemata.';
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'vnesti moraš pravilen email.';
		}
		if (email_exists($_POST['email']) === true) {
			$errors[] = 'email \'' . $_POST['email'] . '\'  je že v uporabi.';
		}
	}
?>
<!DOCTYPE html>
<html>
<body>
	
	<div id="Holder">
		<?php include 'header.php'; ?>
		<div id="Content">
			
			<div id="ContentLeft">
				<div id="PageHeading">
				
					<h1>Registriraj se</h1>
				</div>
					<?php 

						if (isset($_GET['success']) && empty($_GET['success'])) {
							echo "Uspešno si se registriral!";
						} else {

							if (empty($_POST) === false && empty($errors) === true) {
							$register_data = array(
								'uporabnisko_ime' 	=> $_POST['username'],
								'geslo' 	=> $_POST['password'],
								'email' 	=> $_POST['email'],
								'ime' 		=> $_POST['firstname'],
								'priimek' 	=> $_POST['lastname'],
								'naslov' 	=> $_POST['address'],
								'posta' 	=> $_POST['post'],
								'telefonska'=> $_POST['phone'],
								'spol' 		=> $_POST['sex'],
								'starost' 	=> $_POST['age']
							);

							register_user($register_data);
							header('Location: register.php?success');
							exit();

							} else if (empty($errors) === false){
								echo output_errors($errors);
							}
						

					?>

				
				
				<form action="" method="post" name="registerform">
					<table>
						<tr>
							<td>
								<h6>Uporabniško ime: *</h6><input type="text" name="username" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Geslo: *</h6><input type="password" name="password" class="StyleTxtField">
							</td>
							<td>
								<h6>Potrdi geslo: *</h6><input type="password" name="confirmpassword" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>E-mail: *</h6><input type="email" name="email" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Ime: </h6><input type="text" name="firstname" class="StyleTxtField">
							</td>
							<td>
								<h6>Priimek: </h6><input type="text" name="lastname" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Naslov: </h6><input type="text" name="address" class="StyleTxtField">
							</td>
							<td>
								<h6>Pošta: </h6><input type="text" name="post" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Telefonska št.: </h6><input type="text" name="phone" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Spol: </h6><input type="text" name="sex" class="StyleTxtField">
							</td>
							<td>
								<h6>Starost: </h6><input type="text" name="age" class="StyleTxtField">
							</td>
						</tr>
						<tr></tr>
						<tr>
							<td>
								<input type="submit" value="Registriraj" class="StyleTxtField">
							</td>
						</tr>
						
					</table>
				</form>
				<?php } ?>
			</div>
			<div id="ContentRight">
				<?php include 'widgets/login.php' ?>
			</div>

		</div>
	</div>

</body>
</html>
