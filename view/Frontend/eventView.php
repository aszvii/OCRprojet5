<?php $data=$req->fetch() ?>


<?php $title= $data['evts_title']; ?>



<?php ob_start(); ?>



<section id="postSection">


	<div class="evtsPost">
		<p id="evtsPlaceDate">...à <em><?= htmlspecialchars($data['evts_place']) ?>, le <?= $data['date_evts_fr'] ?></em></p>
		<h3 id="evtsPostTitle"><?= htmlspecialchars($data['evts_title']) ?></h3>
		<p id="postDescript"><?= htmlspecialchars($data['evts_description']) ?></p>
		<p id="seeEvtsLinkPost"><a href=""></a></p>
	</div>


<?php $req->closeCursor(); ?> 


</section>

<?php $content= ob_get_clean(); ?>

<?php require ('template2.php'); ?>