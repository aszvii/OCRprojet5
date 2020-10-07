<?php $title= 'evènement(s) signalé(s)'; ?>



<?php ob_start(); ?>



<section id="postSection">


	<div id="returnDiv">
		
		<p class="returnLink"><a href="index.php?action=admin">Retour à la page d'administration</a></p>

	</div>

	

	<h2>Évènement(s) signalé(s)</h2>


<?php while ($data=$req->fetch()): ?>

	<div class="evtsPost" id="cible">
		<p class="evtsPlaceDate">...à <em><?= $data['evts_place'] ?> (<?=$data['evts_city']?>), le <?= $data['date_evts_fr'] ?></em></p>
		<h3 class="evtsPostTitle"><a href="index.php?action=event&id=<?=$data['id']?>"><?= $data['evts_title'] ?></a></h3>
		<div class="postDescript"><?= $data['evts_description'] ?></div>
		<p class="seeEvtsLinkPost2"><a  id="modifyEventLink" href="index.php?action=cancelSignalEvent&id=<?=$data['id']?>">Annuler</a><a id="seeEventLink" href="index.php?action=event&id=<?=$data['id']?>">Voir l'évènement</a><a id="deleteEventLink" href="index.php?action=deleteSignalEvent&id=<?=$data['id']?>">Supprimer</a></p> 
	</div>


<?php endwhile; ?>

<?php $req->closeCursor(); ?> 


</section>


<?php $content= ob_get_clean(); ?>

<?php require ('App/view/Frontend/template2.php'); ?>


