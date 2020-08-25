<?php $title= 'Agenda'; ?>



<?php ob_start(); ?>



<section id="postSection">


<?php while ($events=$req->fetch()): ?>

  <p>  <?php echo $events['evts_title'] ?> </p>

<?php endwhile; ?>



</section>

<?php $content= ob_get_clean(); ?>

<?php require ('template2.php'); ?>