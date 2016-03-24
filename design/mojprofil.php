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
								'starost' 	=> $_POST['age'],
								'lng'		=> $_POST['longitude'],
								'lat'		=> $_POST['latitude']
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
						<tr>
							<td>
								<h6>Zemljepisna dolžina: </h6><input type="text" name="longitude" value="<?php echo $user_data['longitude']; ?>" id="longitudeInput" class="StyleTxtField">
							</td>
							<td>
								<h6>Zemljepisna širina: </h6><input type="text" name="latitude" value="<?php echo $user_data['latitude']; ?>" id="latitudeInput" class="StyleTxtField">
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

	<div id="map" style="height: 300px;"></div>
    <script>
		// Note: This example requires that you consent to location sharing when
		// prompted by your browser. If you see the error "The Geolocation service
		// failed.", it means you probably did not give permission for the browser to
		// locate you.

		function initMap() {
			var map = new google.maps.Map(document.getElementById('map'), {
			  center: {lat: -34.397, lng: 150.644},
			  zoom: 6
			});
			var infoWindow = new google.maps.InfoWindow({map: map});

			// Try HTML5 geolocation.
			if (navigator.geolocation) {
			  navigator.geolocation.getCurrentPosition(function(position) {
			    var pos = {
			      lat: <?php if (isset($user_data['latitude'])) {echo $user_data['latitude'];} else {echo "position.coords.latitude";} ?>,
			      lng: <?php if (isset($user_data['longitude'])) {echo $user_data['longitude'];} else {echo "position.coords.longitude";} ?>
			    };

			    //infoWindow.setPosition(pos);
			    //infoWindow.setContent('Location found.');
			    map.setCenter(pos);

			    // add marker
				marker = new google.maps.Marker({
					position: pos,
					map: map,
					draggable:true,
					animation: google.maps.Animation.DROP,
					title:"Vaša lokacija"
				});

				setInputs(pos.lat, pos.lng);
				// catch that user moved marker
				google.maps.event.addListener(marker, 'dragend', function(event) {
					setInputs(event.latLng.lat(), event.latLng.lng());
				});

			  }, function() {
			    handleLocationError(true, infoWindow, map.getCenter());
			  });
			} else {
			  // Browser doesn't support Geolocation
			  handleLocationError(false, infoWindow, map.getCenter());
			}
		}

      	function setInputs(latitude, longitude)
		{
			$("#latitudeInput").val(latitude);
			$("#longitudeInput").val(longitude);
		}

		function handleLocationError(browserHasGeolocation, infoWindow, pos) {
			infoWindow.setPosition(pos);
			infoWindow.setContent(browserHasGeolocation ?
			                      'Error: The Geolocation service failed.' :
			                      'Error: Your browser doesn\'t support geolocation.');
		}
    </script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxQUC0Q_5j5yJPUIbhvhSochIEh0VZpLg&callback=initMap"
    async defer></script>
</body>


</html>