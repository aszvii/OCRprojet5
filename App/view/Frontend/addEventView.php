<?php $title= 'Créer un évènement'; ?>

<?php ob_start(); ?>

<section id="addModifEventDiv">

	<div id="returnDiv">
		
		<p class="returnLink"><a href="index.php">Retour à la page d'accueil</a></p>

	</div>


    <h1>Créer un évènement</h1>


    <form method="post" action="index.php?action=addEvent" enctype="multipart/form-data">

    	<div class="formDiv">
			<label for="title">Nom de l'évènement:</label><input type="text" id="title" name="title">
	    </div>

	    <div class="formDiv">
			<label for="dateHour">Date et Heure:</label><input type="datetime-local" id="dateHour" name="dateHour">
	    </div>

	    <div class="formDiv">
			<label for="place">Lieu:</label><input type="text" id="place" name="place">
	    </div>

	    <div class="formDiv">
			<label for="city">Ville:</label><input type="text" id="city" name="city">
	    </div>



	     <div class="formDiv">
			<label for="type">Type d'évènement:</label>
			<select name="type" id="type">
				<option value="">--Choisissez un type d'évènement--</option>

<?php while ($type=$types->fetch()): ?>

					<option value="<?=$type['id']?>"><?=$type['type_name']?></option>

<?php endwhile; ?>

<?php $types->closeCursor(); ?>
    	
			</select>
	    </div>



	    <div id="formDescription">
			<label for="description">Description: </label><textarea id="description"  name="description"></textarea>
	    </div>


	    <div id="picEvent">
    
     			<input type="hidden"  name="MAX_FILE_SIZE" value="2000000">
     			<label for="eventPic">Photo (facultatif) <em>(max size: 2Mo)</em>: <input type="file" id="eventPic" name="eventPic"></p>
	
	    </div>


	   	<input id="submitInput" type="submit" name="envoyer" value="Créer évènement">
	   

    </form>

</section>


<?php $content= ob_get_clean(); ?>

<?php require ('App/view/Frontend/template2.php'); ?>