<?php 
	include 'core/init.php';
?>
<!DOCTYPE html>
<html>

<body>
	
	<div id="Holder">
		<?php include 'header.php'; ?>
		<div id="Content">
			
			<div id="ContentLeft">
				

				<?php 

					if (isset($_GET['success']) === true && empty($_GET['success']) === true ) {
						?>

							<div id="PageHeading">

								<h2>Aktivacija uspešna!</h2>

							</div>

							<p>Sedaj se lahko prijaviš!</p>

						<?php
					}
					else if(isset($_GET['email'], $_GET['email_koda']) === true)
					{
						$email 			= trim($_GET['email']);
						$email_koda		= trim($_GET['email_koda']);

						if (email_exists($email) === false) {
							
							$errors[] = 'Ta email v bazi ne obstaja!';
						}
						else if (activate($email, $email_koda) === false) {
							$errors[] = 'Aktivacija ni bila uspešna!';
						}

						if(empty($errors) === false)
						{
							?>
								
								<h2>Pri aktivaciji je prišlo do napake:</h2>

							<?php

								echo output_errors($errors);
						}
						else
						{
							header("Location: aktivacija.php?success");
							exit();
						}

					}
					else
					{
						header('Location: index.php');
						exit();
					}
				?>

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