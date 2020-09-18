<?php require('App/public/PHP/cut.php'); ?>

<?php $title= 'Commentaire(s) Signalé(s)'; ?>


<?php ob_start(); ?>

<section id="signalComViewDiv">


	<div id="returnDiv">
		
		<p class="returnLink"><a href="index.php?action=admin">Retour à la page d'administration</a></p>

	</div>

	

<h1> Commentaires signalés</h1>


<table>
	<tr id="titleTr">
		<th id="dateTh">Date</th>
		<th id="titleTh">Auteur</th>
		<th>Commentaire</th>
		<th id="actionTh">Action</th>
	</tr>
<?php 

while($data=$req->fetch()):?>
	<tr>
		<td id="dateTable"><?php echo htmlspecialchars($data['date_commentaire_fr']); ?></td>
		<td id="authorTable"><?php echo htmlspecialchars($data['name']); ?></td>
		<td><?php echo cutComment($data['comment'], $data['id_evts'], $data['comment']);?></td>

		<td id="actionSignalButton"><button id="deleteSignalCom"><a href="index.php?action=deleteComment&id=<?=$data['id']?>">Supprimer</a></button>
									<button id="cancelSignalCom"><a href="index.php?action=cancelSignalComment&id=<?=$data['id']?>">Annuler</a></button>
									<a id="signalCommentLink" href="index.php?action=event&id=<?=$data['id_evts']?>#<?=$data['comment']?>">Voir</a>
		</td> 
	</tr>
	
<?php endwhile;?>

<?php $req->closeCursor();?>

</table>

</section>

<?php $content= ob_get_clean(); ?>

<?php require ('App/view/Frontend/template2.php'); ?>
