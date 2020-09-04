<?php $title= 'evènement(s) terminé(s)'; ?>



<?php ob_start(); ?>



<section id="postSection">

	<h2>Évènement(s) terminé(s)</h2>


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

<?php require ('template2.php'); ?>
