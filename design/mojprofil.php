<!DOCTYPE html>
<html>
<?php 
	include 'core/init.php';
?>
<body>
	
	<div id="Holder">
		<?php include 'header.php'; ?>
		<div id="Content">
			
			<div id="ContentLeft">
				<div id="PageHeading">
				
				<h1>Moj profil</h1>

				<?php
					if (logged_in()) {

							if (empty($_POST) === false && empty($errors) === true) {
							$update_data = array(
								'uporabnisko_ime' => $_POST['username'],
								'email' 	=> $_POST['email'],
								'ime' 		=> $_POST['firstname'],
								'priimek' 	=> $_POST['lastname'],
								'naslov' 	=> $_POST['address'],
								'posta' 	=> $_POST['post'],
								'telefonska'=> $_POST['phone'],
								'spol' 		=> $_POST['sex'],
								'starost' 	=> $_POST['age']
							);

							update_user($update_data);
							$user_data = common_user_data($session_user_id);

							} else if (empty($errors) === false){
								echo output_errors($errors);
							}
				?>

				<form action="" method="post" name="registerform">
					<table>
						<tr>
							<td>
								<h6>Uporabniško ime: </h6><input type="text" name="username" value="<?php echo $user_data['uporabnisko_ime']; ?>" class="StyleTxtField" readonly="readonly">
							</td>
						</tr>
						<tr>
							<td>
								<h6>E-mail: </h6><input type="email" name="email" value="<?php echo $user_data['email']; ?>" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Ime: </h6><input type="text" name="firstname" value="<?php echo $user_data['ime']; ?>" class="StyleTxtField">
							</td>
							<td>
								<h6>Priimek: </h6><input type="text" name="lastname" value="<?php echo $user_data['priimek']; ?>" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Naslov: </h6><input type="text" name="address" value="<?php echo $user_data['naslov']; ?>" class="StyleTxtField">
							</td>
							<td>
								<h6>Pošta: </h6><input type="text" name="post" value="<?php echo $user_data['posta']; ?>" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Telefonska št.: </h6><input type="text" name="phone" value="<?php echo $user_data['telefonska']; ?>" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Spol: </h6><input type="text" name="sex" value="<?php echo $user_data['spol']; ?>" class="StyleTxtField">
							</td>
							<td>
								<h6>Starost: </h6><input type="text" name="age" value="<?php echo $user_data['starost']; ?>" class="StyleTxtField">
							</td>
						</tr>
						<tr></tr>
						<tr>
							<td>
								<input type="submit" value="Posodobi" class="StyleTxtField">
							</td>
						</tr>
						
					</table>
				</form>

				<?php
					} // END IF LOGGED_IN
					else {
						echo "string";
						var_dump($_SESSION);
					}
				?>

			</div>
			</div>
			<div id="ContentRight">
				<?php
					if (logged_in() === true) {

						include 'widgets/loggedin.php';
					} else {

						include 'widgets/login.php';
					}
				?>
			</div>

		</div>
	</div>

</body>


</html>