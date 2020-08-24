<?php $title= 'On the Corner Club'; ?>



<?php ob_start(); ?>


<?php while ($data=$req->fetch()): ?>

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



	<div class="evtsPost">
		<p id="evtsPlaceDate">...à <em><?= htmlspecialchars($data['evts_place']) ?>, le <?= $data['date_evts_fr'] ?></em></p>
		<h3 id="evtsPostTitle"><a href="index.php?action=event&id=<?=$data['id']?>"><?= htmlspecialchars($data['evts_title']) ?></a></h3>
		<p id="postDescript"><?= htmlspecialchars($data['evts_description']) ?></p>
		<p id="seeEvtsLinkPost"><a href="index.php?action=event&id=<?=$data['id']?>">Voir l'évènement</a></p>
	</div>


<?php $req->closeCursor(); ?> 

<?php endwhile; ?>

</section>

<?php $content= ob_get_clean(); ?>

<?php require ('template.php'); ?>


