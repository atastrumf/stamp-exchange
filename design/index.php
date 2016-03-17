<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'> 
	<meta name="google-signin-client_id" content="znamke-1253">	
</head>
<?php 
	include 'core/init.php';
	include 'core/database/connect.php';
?>
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
				
				<h1>Moje znamke</h1>			

				</div>				
					
				<tr><td class='meni'>
				<form method='POST' action='index.php' name='leto' id='leto'>
				<br><select 'width='200px' form='leto' name='izbiraLeta'>";
				<?php
				for ($i = 1991; $i < 2017; $i++) {	
					if (isset($_POST["izbiraLeta"]) && $i == $_POST["izbiraLeta"])					
						echo "<option value=".$i." selected='selected'>".$i."</option>";
					else
						echo "<option value=".$i.">".$i."</option>";
				}
				?>
				<input id='button' type='submit' name='submit' value='Izberi'></select></td></tr><br>
				
				<?php
				if (isset($_POST["izbiraLeta"])) {
					$izbiraLeta=$_POST['izbiraLeta'];
				
					mysqli_query($con,"SET NAMES utf8");
					mysqli_query($con,"SET CHARACTER SET utf8");
					mysqli_query($con,"SET COLLATION_CONNECTION='utf8_general_ci'");
				
					$query = "SELECT * FROM znamka WHERE YEAR(STR_TO_DATE(datumIzdaje, '%d.%m.%Y')) = ".$izbiraLeta."";
					$result = $con->query($query);
					
					if ($result->num_rows > 0) {
						echo "<table><tr>";
						$i = 5;
						while($row = $result->fetch_assoc()) {
							
							if ($i==5) {
								echo "</tr><tr>";
								$i = 0;
							}
								
							echo "<td>
							<a href='znamka.php?ID_slika=" . $row['ID_slika'] . "'>
							<img src='data:image/jpeg;base64,".base64_encode( $row['slika'] )."'/>
							<figcaption>".$row['naziv']."</figcaption>
							</a>
							</td>";
							$i++;
						}
						
						$result->free();
						$con->close();
						echo "</tr></table>";
					}
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
