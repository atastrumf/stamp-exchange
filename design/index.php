<!DOCTYPE html>
<html>
<?php
  include 'core/init.php';
  include 'head.php';
  $con = mysqli_connect('localhost', 'root', 'password', 'znamke_db');
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
        <div id="Letnice">
        
             <?php
                  for ($i = 1991; $i < 2017; $i++) {  
                    echo "<a class='leto' href='#" . $i . "'>" . $i . "</a>";
                  }
             ?>

        </div>

        <script type="text/javascript">
          
          $(".leto").on("click", function( e ) {
    
              e.preventDefault();

              $("html, body").animate({ 
                  scrollTop: $( $(this).attr('href') ).offset().top 
              }, 800);
              
          });

        </script>

          <?php

          mysqli_query($con,"SET NAMES utf8");
          mysqli_query($con,"SET CHARACTER SET utf8");
          mysqli_query($con,"SET COLLATION_CONNECTION='utf8_general_ci'");


          for ($i = 1991; $i < 2017; $i++) {  
            
            echo "<div class='letoZnamke' id='" . $i . "'<h2>" . $i . "</h2><br><a href='#' class='back-to-top'>Na vrh</a><hr><br></div><div class='znamke'>";
          
            $query = "SELECT * FROM znamka WHERE YEAR(STR_TO_DATE(datumIzdaje, '%d.%m.%Y')) = ".$i."";
            $result = $con->query($query);

            echo "<table><tr>";
            $j = 5;
            while($row = $result->fetch_assoc()) {
              
              if ($j==5) {
                echo "</tr><tr>";
                $j = 0;
              }
                
              echo "<td id='znamkaSeznam'>
              <a href='znamka.php?ID_slika=" . $row['ID_slika'] . "'>
              <img class='znamka' src='data:image/jpeg;base64,".base64_encode( $row['slika'] )."'/>
              <figcaption>".$row['naziv']."</figcaption>
              </a>
              </td>";
              $j++;
            }

            echo "</tr></table></div>";
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

<script type="text/javascript">
  $('body').prepend('<a href="#" class="back-to-top">Na vrh</a>');

  var amountScrolled = 300;

  $(window).scroll(function() {
    if ( $(window).scrollTop() > amountScrolled ) {
      $('a.back-to-top').fadeIn('slow');
    } else {
      $('a.back-to-top').fadeOut('slow');
    }
  });

  $('a.back-to-top').click(function() {
    $('html, body').animate({
      scrollTop: 0
    }, 800);
    return false;
  });
</script>

</body>


</html>
