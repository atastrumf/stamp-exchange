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
		            
		            echo "<div class='letoZnamke' id='" . $i . "'<h2>" . $i . "</h2><br><a href='#' class='back-to-top'>Na vrh</a><hr></div><div class='znamke'>";
		          
		            $query = "SELECT * FROM znamka WHERE YEAR(STR_TO_DATE(datumIzdaje, '%d.%m.%Y')) = ".$i."";
		            $result = $con->query($query);

		            echo "<table><tr>";
		            $j = 18;
		            while($row = $result->fetch_assoc()) {
		              
		              if ($j==18) {
		                echo "</tr><tr>";
		                $j = 0;
		              }
		                
		              echo "<td id='ZnamkaSeznam'>
		              <a href='znamka.php?ID_slika=" . $row['ID_slika'] . "'>
		              <img class='malaznamka' src='data:image/jpeg;base64,".base64_encode( $row['slika'] )."'/>
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