<?php $title= 'Connexion'; ?>

<?php ob_start(); ?>

<section id="connectionDiv">

	<div id="imgConnectionSlider">
		<img src="App/public/CSS/IMG/Slider1.png">
	</div>

	
		<div id="textConnectionSlider">

			<div id="connectionSpace">
				<div>
					<h1>Saisissez vos identifiants de connexion</h1>
				</div>

				<form method="post" action="index.php?action=connection">
					<div id="connectionId">
						<p><label for="pseudo">Pseudo</label><input type="text" id="pseudo" name="pseudo"></p>
						<p><label for="password">Mot de passe</label><input type="password" id="password" name="password"></p>
					</div>
					<div id="connectionButton">
						<input type="submit" value="Se connecter">
					</div>
				</form>
			</div>

		</div>
	</div>

</section>

<?php $content= ob_get_clean(); ?>

<?php require ('App/view/Frontend/template2.php'); ?>