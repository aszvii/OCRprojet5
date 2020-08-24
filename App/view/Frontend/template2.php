<!DOCTYPE html>

	<html lang="fr">


		<head>

			<meta charset="utf-8" />

			<meta name="viewport" content="width=device-width, initial-scale=1" />

			<meta name="description" content="Blog">

			<link rel="stylesheet" href="public/CSS/style.css">

			<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->

			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />


			<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>



			<title><?= $title ?></title>

		</head>


		<body>

			<header>

				<div id="fixedMenu">

					<div id="listMenu">
						<a id="menuBar" href=""><i class="fas fa-bars"></i></a>

						
						<ul id="listMenuRoll">
							<a href=""><li><i class="fas fa-window-close"></i></li></a>
							<a href=""><li>Accueil</li></a>
							<a href=""><li>Évènements</li></a>
							<a href=""><li>Membres</li></a>
							<a href=""><li>Recherche</li></a>
						</ul>
						
					</div>

					<div id="brandMenu">
						<h1><a href="index.php">On The Corner</a></h2>
					</div>

					<div id="profilMenu">
						<a href=""><i class="fas fa-user-circle"></i></a>

						<ul id="profilMenuRoll">
							<a href=""><li><i class="fas fa-window-close"></i></li></a>
							<a href=""><li>Modifier mon profil</li></a>
							<a href=""><li>Créer un évènement</li></a>
							<a href=""><li>Mon agenda</li></a>
							<a href=""><li>Administration</li></a>
						</ul>
					</div>

				</div>

			</header>


			<div id="IdContent">
				<?= $content ?>
			</div>

			
			
			<footer>
			</footer>

		</body>
		
	</html>
