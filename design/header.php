<?php 
	require_once 'core/init.php';
	include 'head.php';
?>

<header>
	<nav>
		<ul>
			<li><a href="index.php">Znamke</a></li>

			<?php
				if (logged_in()) { ?>
					<li><a href="album.php">Moj album</a></li>
					<li><a href="statistika.php">Statistika</a></li>
					<li><a href="dosezki.php">Dosežki</a></li>
					<li><a href="mojprofil.php">Moj profil</a></li>
					<li><a href="logout.php">Odjavi se</a></li>
				<?php }
			?>
			
		</ul>
	</nav>
</header>
