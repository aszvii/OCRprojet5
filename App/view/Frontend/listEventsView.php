<?php $title= 'On the Corner Club'; ?>



<?php ob_start(); ?>



<section id="postSection">

	<h2>Évènements à venir...</h2>


	<div id="postSectionFormDiv">


		<form id="searchTypeForm" action="index.php?action=searchType" method="post">

			<label for="searchEventType">Rechercher par type d'évènement:</label>

				<select name="searchEventType" id="searchEventType">
					<option value="">--Choisissez un type d'évènement--</option>
					<option value="1">Sport</option>
   					<option value="2">Musique</option>
    				<option value="3">Culture</option>
    				<option value="4">Gastronomie</option>
   	 				<option value="5">Art</option>
    				<option value="6">Commerce</option>
    				<option value="7">Autre</option>
				</select>

			<input type="submit" value="Rechercher">

		</form>


		<form id="searchCityForm" action="index.php?action=searchCity" method="post">

			<label for="searchEventCity">Rechercher par lieu:</label>

			<input type="text" name="searchEventCity" id="searchEventCity">
	
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


