<?php $data=$req->fetch() ?>


<?php $title= $data['evts_title']; ?>



<?php ob_start(); ?>



<section id="postSection">

<?php if (isset($_SESSION['id'])): ?>

    <div id="inscriptionButton">

<?php if($verif->rowCount()==0){ ?>
        <p><a href="index.php?action=eventInscription&id=<?= $data['id'] ?>">Je serais présent à cet évènement</a></p>
<?php }
      else{ ?>

        <p>Vous participez à cet évènement</p>   <!--Mettre bouton pour se désinscrire-->
<?php
      }
?>

    </div>

<?php endif; ?>


	<div class="evtsPost">
		<p id="evtsPlaceDate">...à <em><?= htmlspecialchars($data['evts_place']) ?>, le <?= $data['date_evts_fr'] ?></em></p>
		<h3 id="evtsPostTitle"><?= htmlspecialchars($data['evts_title']) ?></h3>
		<p id="postDescript"><?= htmlspecialchars($data['evts_description']) ?></p>
		<p id="seeEvtsLinkPost"><a href=""></a></p>
	</div>


<?php $req->closeCursor(); ?> 



            <div id="eventCommentDiv">
        	   <h3>Commentaires</h3>

            <?php 
            if(isset($_SESSION['id'])){
            ?>

                <form method="post" action="index.php?action=addComment&id=<?= $data['id'] ?>">

                    <div>
                        <label for="comment">Laissez votre commentaire</label><br/>
                        <textarea id="comment" name="comment"></textarea>
                    </div>

                    <div>
                        <input type="submit" value="Envoyer">
                    </div>

                </form>
           <?php
           }
           ?> 



                    <div id="eventCommentsContent">
    <?php
        if($comments->rowCount()==0){
            echo 'Soyez le premier à commenter cet article';
        }
        else{

        	while ($comment = $comments->fetch())
        	{

    ?>

            	    
                        <div id="commentContent">
                            <p><strong><?php echo htmlspecialchars($comment['name']); ?></strong> le <?php echo $comment['date_commentaire_fr']; ?>
    <?php 
        if(isset($_SESSION['id'])){
    ?>
                            <a id="signalLink" href="index.php?action=signalComment&id=<?=$comment['id']?>&post=<?=$post['id']?>">(signaler)</a>
    <?php
        }
    ?>


    <?php
        if(isset($_SESSION['id']) && $_SESSION['type']==1){
    ?>
                            <a id="deleteLink" href="index.php?action=deleteComment&id=<?=$comment['id']?>&post=<?=$post['id']?>">(Supprimer)</a>
    <?php
        }
    ?>

            	           <p id="<?=$comment['comment']?>"><?php echo htmlspecialchars($comment['comment']); ?></p></p>

                        </div>

                
   	<?php


        	}
        }

        $comments->closeCursor();

   	?>


<?php if (!isset($_SESSION['id'])): ?>

    <p id="connectToComment">Connectez vous pour commenter</p>

<?php endif; ?>


   		</div>
   		
	</div>



</section>

<?php $content= ob_get_clean(); ?>

<?php require ('template2.php'); ?>