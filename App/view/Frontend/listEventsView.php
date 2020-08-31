<?php $title= 'On the Corner Club'; ?>



<?php ob_start(); ?>



<section id="postSection">

	<h2>Évènements à venir...</h2>


	<div id="postSectionFormDiv">


		<form id="searchTypeForm" action="" method="post">

			<label for="searchType">Rechercher par type d'évènement:</label>

				<select name="searchType" size="1">
					<option>Sport</option>
					<option>Culture</option>
					<option>Musique</option>
					<option>Gastronome</option>
				</select>

			<input type="submit" value="Rechercher">

		</form>


		<form id="searchCityForm">

			<label for="searchCity">Rechercher par ville:</label>

			<input type="text" name="searchCity" id="searchCity">
	
			<input type="submit" value="Rechercher">

		</form>

	</div>

<?php while ($data=$req->fetch()): ?>

	<div class="evtsPost" id="cible">
		<p class="evtsPlaceDate">...à <em><?= htmlspecialchars($data['evts_place']) ?>, le <?= $data['date_evts_fr'] ?></em></p>
		<h3 class="evtsPostTitle"><a href="index.php?action=event&id=<?=$data['id']?>"><?= $data['evts_title'] ?></a></h3>
		<div class="postDescript"><?= $data['evts_description'] ?></div>
		<p class="seeEvtsLinkPost"><a href="index.php?action=event&id=<?=$data['id']?>">Voir l'évènement</a></p>
	</div>


<?php endwhile; ?>

<?php $req->closeCursor(); ?> 


</section>


<?php $content= ob_get_clean(); ?>

<?php require ('template.php'); ?>


