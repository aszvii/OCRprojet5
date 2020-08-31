<!DOCTYPE html>

	<html lang="fr">


		<head>

			<meta charset="utf-8" />

			<meta name="viewport" content="width=device-width, initial-scale=1" />

			<meta name="description" content="Blog">

			<link rel="stylesheet" href="App/public/CSS/style.css">

			<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->

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

					<!--<div id="listMenu">
						<a id="menuBar" href=""><i class="fas fa-bars"></i></a>

						
						<ul id="listMenuRoll">
							<a href=""><li><i class="fas fa-window-close"></i></li></a>
							<a href=""><li>Accueil</li></a>
							<a href=""><li>Évènements</li></a>
							<a href=""><li>Membres</li></a>
							<a href=""><li>Recherche</li></a>
						</ul>
						
					</div>-->


					<div id="brandMenu">
						<h1><a href="index.php">On The Corner</a></h1>
					</div>
				

					<div id="profilMenu">
<?php 
if (isset($_SESSION['id']) && isset($_SESSION['pseudo'])){
?>

						<a id="profilMenuLink" href=""><i class="fas fa-user-circle"></i></a>

						<ul id="profilMenuRoll">
							<li><i class="fas fa-window-close"></i></li>
							<a href=""><li>Modifier mon profil</li></a>
							<a href="index.php?action=eventCreation"><li>Créer un évènement</li></a>
							<a href="index.php?action=showEventsInscription"><li>Mon agenda</li></a>
							<a href=""><li>Administration</li></a>
						</ul>

					</div>

<?php
}
else{
?>			
					<div>

						<p><a href="index.php?action=register">s'inscrire</a></p>
						<p><a href="index.php?action=connect">se connecter</a></p>

					</div>

<?php
}
?>

				</div>

			</header>


			<div id="IdContent">
				<?= $content ?>
			</div>

			
			
			<footer>
			</footer>

		</body>
		
	</html>
