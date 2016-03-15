
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body>
	
	<div id="Holder">
		<?php include 'header.php'; ?>
		<div id="Content">
			<div id="PageHeading">
				
				<h1>Registriraj se</h1>

			</div>
			<div id="ContentLeft">
				
				<form action="" method="post" id="registerform">
					<table>
						<tr>
							<td>
								<h6>Uporabniško ime: *</h6><input type="text" id="username" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Geslo: *</h6><input type="password" id="password" class="StyleTxtField">
							</td>
							<td>
								<h6>Potrdi geslo: *</h6><input type="password" id="confirmpassword" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>E-mail: *</h6><input type="email" id="email" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Ime: </h6><input type="text" id="firstname" class="StyleTxtField">
							</td>
							<td>
								<h6>Priimek: </h6><input type="text" id="lastname" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Naslov: </h6><input type="text" id="address" class="StyleTxtField">
							</td>
							<td>
								<h6>Pošta: </h6><input type="text" id="post" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Telefonska št.: </h6><input type="text" id="phone" class="StyleTxtField">
							</td>
						</tr>
						<tr>
							<td>
								<h6>Spol: </h6><input type="text" id="sex" class="StyleTxtField">
							</td>
							<td>
								<h6>Starost: </h6><input type="id" id="age" class="StyleTxtField">
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

			</div>
			<div id="ContentRight">
				<?php include 'widgets/loginwidget.php' ?>
			</div>

		</div>
	</div>

</body>
</html>
