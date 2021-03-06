<!DOCTYPE html>

	<html lang="fr">


		<head>

			<meta charset="utf-8" />

			<meta name="viewport" content="width=device-width, initial-scale=1" />

			<meta name="description" content="Blog">

			<link rel="stylesheet" href="App/public/CSS/style.css">


			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />




			<title><?= $title ?></title>

		</head>


		<body>

			<header>

				<div id="fixedMenu">

					<div id="brandMenu">
						<h1><a href="index.php">On The Corner</a></h2>
					</div>



					<div id="profilMenu">

<?php if(isset($_SESSION['id']) && isset($_SESSION['type'])): ?>

						<a id="profilMenuLink" href=""><i class="fas fa-bars"></i></a>

						<nav class="navMenu">
							<ul id="profilMenuRoll">
								<li><i id="closeMenu" class="fas fa-window-close"></i></li>
								<li><a href="index.php">Accueil</a></li>
								<li><a href="index.php?action=eventCreation">Créer un évènement</a></li>

								<?php if($_SESSION['type']==0):?>
										<li><a href="index.php?action=showEventsInscription">Mon agenda</a></li>
								<?php elseif($_SESSION['type']==1):?>
							
										<li><a href="index.php?action=admin">Administration</a></li>

								<?php endif;?>

								<li><a href="index.php?action=disconnect">Déconnexion</a></li>
							</ul>
						</nav>

<?php else: ?>

						<p><a href="index.php?action=register">s'inscrire</a></p>
						<p><a href="index.php?action=connect">se connecter</a></p>

<?php endif;?>

					</div>

				</div>


				<div id="slider">
					<div id="imgSlider">
						<img src="App/public/CSS/IMG/slider1.png">
					</div>
					<div id="sliderContent">
						<div id="textSlider">
							<h2>Il y a toujours quelque chose à faire près de chez vous.</h1>
							<p>Rejoignez la communauté "on the Corner", partagez et participez à de nombreux évènements avec les autres membres...</p>
							<div id="sliderButton">
								<button><a href="#IdContent">Voir les évènements à venir</a></button>
							</div>
						</div>
					</div>

				</div>
			</header>


			<div id="IdContent">
				<?= $content ?>
			</div>

			
			
			<footer>
			</footer>


		<?php if(isset($_SESSION['id'])): ?>

			<script src="App/javascript/menu.js"></script>
			
		<?php endif; ?>
		
		</body>
		
	</html>
