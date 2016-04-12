<?php

	include 'core/init.php';
	$con = mysqli_connect('localhost', 'root', 'password', 'znamke_db');
	
	if (empty($_POST) === false) {
	
		$required_fields = array('username', 'password', 'confirmpassword', 'email', 'firstname');

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
<meta name="google-signin-client_id" content="znamke-1253">
<body>
	<div id="fb-root"></div>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/sl_SI/sdk.js#xfbml=1&version=v2.5&appId=1022279284499794";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1022279284499794',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>
	<div id="Holder">
		<?php include 'header.php'; ?>
		<div id="Content">
			
			<div id="ContentLeft">
				<div id="PageHeading">
				
					<h1>Registriraj se</h1>
				</div>
					<?php 

						if (isset($_GET['success']) && empty($_GET['success'])) {
							echo "Uspešno si se registriral! Preveri email, da aktiviraš svoj račun!";
						} else {

							if (empty($_POST) === false && empty($errors) === true) {
							$register_data = array(
								'uporabnisko_ime' 	=> $_POST['username'],
								'geslo' 	=> $_POST['password'],
								'email' 	=> $_POST['email'],
								'email_koda'=> md5($_POST['username'] + microtime()),
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
								<h6>Ime: *</h6><input type="text" name="firstname" class="StyleTxtField">
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
