<?php $data=$req->fetch(); ?>


<?php $title= $data['evts_title']; ?>



<?php ob_start(); ?>



<section id="postSection">

<?php if (isset($_SESSION['type']) && $_SESSION['type']==0): ?>

    <div id="inscriptionButton">

<?php   if($verif->rowCount()==0){ ?>
            <p><a id="inscriptionLink" href="index.php?action=eventInscription&id=<?= $data['id'] ?>">Je souhaites participer à cet évènement</a></p>
<?php   }
        else{ $inscript=$verif->fetch() ?>

            <p><a id="deleteInscriptionLink" href="index.php?action=deleteInscription&id=<?=$inscript['id']?>&event=<?=$data['id']?>">Je ne veux plus y participer</a></p>
<?php
        }
      $verif->closeCursor();
?>

    </div>

<?php endif; ?>


	<div class="eventPost">
        <h3><?= $data['evts_title'] ?></h3>


<?php if($data['evts_img']!==""){
?>
        
        <div id="imgEvent">
            <img src="upload/<?=$data['evts_img']?>" alt="photo de l'évènement">
        </div>
<?php
}
?>
        

        <div class="eventPostContent">
            <p>Lieu: <em><?= htmlspecialchars($data['evts_place']) ?> (<?=$data['evts_city']?>)</em></p>
            <p>Date et Heure: <em>le <?= $data['date_evts_fr'] ?></em></p>
             <p>type d'évènement: <em><?= $data['type_name'] ?></em></p>
            <p>Organisé par: <em><?= $data['name'] ?></em></p><br/>
            <p id="descriptEventPost">Description:</p><p><em><?= $data['evts_description']?></em></p>
		
		  <p id="eventPostLink"><a href=""></a></p>
	   </div>

       <?php 
        if(isset($_SESSION['id'])){
    ?>
            <p><a id="signalLink" href="index.php?action=signalEvent&id=<?=$data['id']?>">(signaler cet évènement)</a></p>
    <?php
        }
    ?>

    </div>






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
                            <a id="signalLink" href="index.php?action=signalComment&id=<?=$comment['id']?>&event=<?=$data['id']?>">(signaler)</a>
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

            	           <p id="<?=$comment['comment']?>"><?php echo $comment['comment']; ?></p></p>

                        </div>

                
   	<?php


        	}
        }

        $req->closeCursor(); 

        $comments->closeCursor();

   	?>


<?php if (!isset($_SESSION['id'])): ?>

    <p id="connectToComment"><a href="index.php?action=connect">Connectez vous pour commenter</a></p>

<?php endif; ?>


   		</div>
   		
	</div>



</section>

<?php $content= ob_get_clean(); ?>

<?php require ('template2.php'); ?>