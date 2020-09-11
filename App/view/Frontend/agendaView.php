<?php $title= 'Agenda'; ?>



<?php ob_start(); ?>

<div id="selectView">
    <div id="organised"><h3>J'organise</h3></div>
    <div id="participate"><h3>Je participe</h3></div>
</div>


<section id="participateSection">

<?php while ($events=$req->fetch()): ?>

    <div class="evtsPost">
        <p class="evtsPlaceDate">...à <em><?= htmlspecialchars($events['evts_place']) ?> (<?=$events['evts_city']?>), le <?= $events['date_evts_fr'] ?></em></p>
        <h3 class="evtsPostTitle"><a href="index.php?action=event&id=<?=$events['id']?>"><?= $events['evts_title'] ?></a></h3>
        <div class="postDescript"><?= $events['evts_description'] ?></div>
        <p class="seeEvtsLinkPost"><a href="index.php?action=event&id=<?=$events['id']?>">Voir les détails</a></p>
    </div>

<?php endwhile; ?>

<?php $req->closeCursor(); ?>

</section>


<section id="organisedSection">

<?php while ($events2=$req2->fetch()): ?>

    <div class="evtsPost">
        <p class="evtsPlaceDate">...à <em><?= htmlspecialchars($events2['evts_place']) ?> (<?=$events2['evts_city']?>), le <?= $events2['date_evts_fr'] ?></em></p>
        <h3 class="evtsPostTitle"><a href="index.php?action=event&id=<?=$events2['id']?>"><?= $events2['evts_title'] ?></a></h3>
        <div class="postDescript"><?= $events2['evts_description'] ?></div>
        <p class="seeEvtsLinkPost2"><a id="modifyEventLink" href="index.php?action=eventModification&id=<?=$events2['id']?>">Modifier</a><a id="seeEventLink" href="index.php?action=event&id=<?=$events2['id']?>">Voir les détails</a><a id="deleteEventLink" href="index.php?action=deleteEvent&id=<?=$events2['id']?>">Supprimer</a></p>
    </div>

<?php endwhile; ?>

<?php $req2->closeCursor(); ?>

</section>



<?php $content= ob_get_clean(); ?>

<?php require ('template2.php'); ?>