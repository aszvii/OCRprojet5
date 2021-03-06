<?php $title= 'Modifier un évènement'; ?>

<?php ob_start(); ?>

<section id="addModifEventDiv">

	<div id="returnDiv">
		
		<p class="returnLink"><a href="index.php?action=showEventsInscription">Retour à "mon agenda"</a></p>

	</div>

    <h1>Modifier un évènement</h1>


    <form method="post" action="index.php?action=modifEvent&id=<?=$_GET['id']?>" enctype="multipart/form-data">

    	<div class="formDiv">
			<label for="title">Nom de l'évènement:</label><input type="text" id="title" name="title" value="<?=$resultat['evts_title']?>">
	    </div>

	    <div class="formDiv">

			<label for="dateHour">Date et Heure:</label><input type="datetime-local" id="dateHour" name="dateHour" value="<?=$resultat['date_evts_us']?>">
			
	    </div>

	    <div class="formDiv">
			<label for="place">Lieu:</label><input type="text" id="place" name="place" value="<?=$resultat['evts_place']?>">
	    </div>

	     <div class="formDiv">
			<label for="city">Ville:</label><input type="text" id="city" name="city" value="<?=$resultat['evts_city']?>">
	    </div>


	    <div class="formDiv">
			<label for="type">Type d'évènement:</label>
			<select name="type" id="type">
				<option value="">--Choisissez un type d'évènement--</option>

   			
<?php while ($type=$types->fetch()): ?>													

				<?php if($type['id']== $resultat['evts_type']):?>
					<option value="<?= $type['id']?>" selected> <?=$type['type_name']?> </option>
				<?php else:?>
					<option value="<?= $type['id']?>"> <?=$type['type_name']?> </option>

				<?php endif;?>

<?php endwhile; ?>

<?php $types->closeCursor(); ?>


			</select>
	    </div>


	    <div id="formDescription">
			<label for="description">Description</label><textarea id="description"  name="description"><?=$resultat['evts_description']?></textarea>
	    </div>

	    <div id="picEvent">
    
     			<input type="hidden"  name="MAX_FILE_SIZE" value="2000000">
     			<label for="eventPic">Photo (facultatif) <em>(max size: 2Mo)</em>:</label><input type="file" id="eventPic" name="eventPic"></p>
     				

     		<?php if($resultat['evts_img']!==""):?>

     			<p id="deleteImgLink"><a href="index.php?action=deleteImg&id=<?=$resultat['id']?>">supprimer l'image de l'évènement</a></p>

     		<?php endif;?>
	
	    </div>


	   	<input id="submitInput" type="submit" value="Modifier évènement">
	   

    </form>

</section>


<?php $content= ob_get_clean(); ?>

<?php require ('App/view/Frontend/template2.php'); ?>