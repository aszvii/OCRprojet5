<!DOCTYPE html>

	<html lang="fr">


		<head>

			<meta charset="utf-8" />

			<meta name="viewport" content="width=device-width, initial-scale=1" />

			<meta name="description" content="Blog">

			<link rel="stylesheet" href="App/public/CSS/style.css">


			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />


			<script src="https://cdn.tiny.cloud/1/0al1tvd4e2rul6yt09879uk1sftomgyp2i79g6hches2u177/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
			<script>
      			tinymce.init({
        			selector: 'textarea#description',
        			language : "fr_FR"
      			});
			</script>



			<title><?= $title ?></title>

		</head>


		<body>

			<header>

				<div id="fixedMenu">


					<div id="brandMenu">
						<h1><a href="index.php">On The Corner</a></h1>
					</div>
				

					<div id="profilMenu">

<?php if (isset($_SESSION['id']) && isset($_SESSION['pseudo'])):?>

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

					</div>

<?php else:?>			
						

						<p><a href="index.php?action=register">s'inscrire</a></p>
						<p><a href="index.php?action=connect">se connecter</a></p>


<?php endif;?>

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
