<?php $data=$req->fetch(); ?>


<?php $title= $data['evts_title']; ?>



<?php ob_start(); ?>



<section id="postSection">

<?php if (isset($_SESSION['type']) && $_SESSION['type']==0): ?>

    <div id="inscriptionButton">

    <?php if($verif->rowCount()==0): ?>

            <p><a id="inscriptionLink" href="index.php?action=eventInscription&id=<?= $data['id'] ?>">Je souhaites participer à cet évènement</a></p>

    <?php else:?>
            <?php $inscript=$verif->fetch() ?>

            <p><a id="deleteInscriptionLink" href="index.php?action=deleteInscription&id=<?=$inscript['id']?>&event=<?=$data['id']?>">Je ne veux plus y participer</a></p>

    <?php endif;?>
    <?php $verif->closeCursor();?>

    </div>

<?php endif; ?>




	<div class="eventPost">

<?php       $eventTime= strtotime($data['evts_date']);

            $dayStart=strtotime('midnight');

            $day0= strtotime('tomorrow');

            $day1= $day0 + (24*60*60);
            $day2= $day1 + (24*60*60);
            $day3= $day2 + (24*60*60);
            $dayMax= $day3 + (24*60*60);
?>


<?php if($eventTime>$dayStart && $eventTime<$dayMax):?>

        <div id="meteo">

            <h3>Prévision météo pour l'évènement:</h3>

            <div id="imgMeteo">
                <p <?php if($eventTime>$dayStart && $eventTime<$day0 ):?>class="day0"
                    <?php elseif($eventTime>$day0 && $eventTime<$day1):?> class="day1"
                    <?php elseif($eventTime>$day1 && $eventTime<$day2):?> class="day2" 
                    <?php elseif($eventTime>$day2 && $eventTime<$day3):?> class="day3" 
                    <?php elseif($eventTime>$day3 && $eventTime<$dayMax):?> class="day4"
                    <?php endif;?> id="day"></p>

                <img id="dayImg" src=""/>

                <div id="temp">
                    <p>Max: <em id="tMax"></em></p>
                    <p >Min: <em id="tMin"></em></p>
                </div>
            </div>   
           
        </div>

<?php else:?>

    <p id="noMeteo">La météo de cet évènement n'est pas disponible</p>

<?php endif;?>



        <h3><?= $data['evts_title'] ?></h3>


<?php if($data['evts_img']!==""):?>
        
        <div id="imgEvent">
            <img src="upload/<?=$data['evts_img']?>" alt="photo de l'évènement">
        </div>

<?php endif;?>
        

        <div class="eventPostContent">
            <p>Lieu: <em><?= htmlspecialchars($data['evts_place']) ?> (<span id="City"><?=$data['evts_city']?></span>)</em></p>
            <p>Date et Heure: <em>le <?= $data['date_evts_fr'] ?></em></p>
            <p>type d'évènement: <em><?= $data['type_name'] ?></em></p>
            <p>Organisé par: <em><?= $data['name'] ?></em></p><br/>
            <p id="descriptEventPost">Description:</p><p><em><?= $data['evts_description']?></em></p>

<?php if ($registered==false):?>

            <p>Impossible d'afficher le nombre d'inscrit</p>

<?php else:?>

<?php $result=$registered->fetch(); ?>

            <p id="nbRegistered"><?=$result['nb_Registered']?> membre(s) participe(nt) à cet évènement</p>

<?php endif; ?>
		                    
	   </div>

<?php if(isset($_SESSION['id'])):?>

            <p><a id="signalLink" href="index.php?action=signalEvent&id=<?=$data['id']?>">(signaler cet évènement)</a></p>

<?php endif; ?>

    </div>





            <div id="eventCommentDiv">
        	   <h3>Commentaires</h3>

<?php if(isset($_SESSION['id'])):?>

                <form method="post" action="index.php?action=addComment&id=<?= $data['id'] ?>">

                    <div>
                        <label for="comment">Laissez votre commentaire</label><br/>
                        <textarea id="comment" name="comment"></textarea>
                    </div>

                    <div>
                        <input type="submit" value="Envoyer">
                    </div>

                </form>

<?php endif;?>



                    <div id="eventCommentsContent">

    <?php if($comments->rowCount()==0):?>
            <p>Soyez le premier à commenter cet article</p>;
        
    <?php else:?>

        	<?php while ($comment = $comments->fetch()):?>

                        <div id="commentContent">
                            <p><strong><?php echo htmlspecialchars($comment['name']); ?></strong><em class="postCommentDate"> le <?php echo $comment['date_commentaire_fr']; ?></em></p>


                <?php if(isset($_SESSION['id'])): ?>

                            <a id="signalLink" href="index.php?action=signalComment&id=<?=$comment['id']?>&event=<?=$data['id']?>">(signaler)</a>

                <?php endif;?>


                <?php if(isset($_SESSION['id']) && $_SESSION['type']==1):?>

                            <a id="deleteLink" href="index.php?action=deleteComment&id=<?=$comment['id']?>&post=<?=$post['id']?>">(Supprimer)</a>

                <?php endif;?>

            	           <p id="<?=$comment['comment']?>"><?php echo $comment['comment']; ?></p>

                        </div>

            <?php endwhile;?>         


            <?php $req->closeCursor(); 

                $comments->closeCursor();
            ?>

    <?php endif;?>


<?php if(!isset($_SESSION['id'])):?>
    
  <p id="connectToComment"><a href="index.php?action=connect">Connectez vous pour commenter</a></p>

<?php endif; ?>



   		           </div>
   		
	   </div>


<script src="App/javascript/meteo.js"></script>

</section>

<?php $content= ob_get_clean(); ?>

<?php require ('template2.php'); ?>