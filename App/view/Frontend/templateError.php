<!DOCTYPE html>

	<html id="errorHtml" lang="fr">


		<head>

			<meta charset="utf-8" />

			<meta name="viewport" content="width=device-width, initial-scale=1" />

			<meta name="description" content="Blog">

			<link rel="stylesheet" href="app/public/CSS/style.css">




			<title>Erreur</title>

		</head>


		<body id="errorBody">

		<header id="bodyHeader">

			<div id="returnDiv">

			<?php 	if(isset($_SERVER['HTTP_REFERER'])){
			?>
						<p class="returnLink"><a href="<?= $_SERVER['HTTP_REFERER']; ?>">Retour à la page précédente</a></p>
			<?php 
					}
			?>
				<p class="returnLink"><a href="index.php">Retour à l'accueil</a></p>

			</div>

		</header>	
		
		<div id="errorContent">

			<p><em><?= 'ERREUR: '?></em><?= $e->getMessage(); ?></p>

		</div>

		</body>
		
	</html>