<?php $title= 'Page d\'administration'; ?>


<?php ob_start(); ?>

<section id="adminDiv">
	<section class="adminSection">
		<a href="index.php?action=showSignalEvent">
			<h2>EVENEMENT(S) SIGNALE(S)</h2>
		</a>
	</section>

	<section class="adminSection">
		<a href="index.php?action=passedEvents">
			<h2>EVENEMENT(S) TERMINE(S)</h2>
		</a>
	</section>

	<section class="adminSection">
		<a href="index.php?action=showSignalComment">
			<h2>COMMENTAIRE(S) SIGNALE(S)</h2>
		</a>
	</section>

	<section class="adminSection">
		<a href="index.php">
			<h2>RETOUR À LA PAGE PRINCIPALE</h2>
		</a>
	</section>
</section>

<?php $content= ob_get_clean(); ?>

<?php require ('App/view/Frontend/template2.php'); ?>