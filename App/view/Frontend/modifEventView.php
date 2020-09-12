<?php $title= 'Modifier un évènement'; ?>

<?php ob_start(); ?>

<section id="addModifEventDiv">

    <h1>Modifier un évènement</h1>


    <form method="post" action="index.php?action=modifEvent&id=<?=$_GET['id']?>" enctype="multipart/form-data">

    	<div class="formDiv">
			<label for="title">Nom de l'évènement:</label><input type="text" id="title" name="title" value="<?=$resultat['evts_title']?>">
	    </div>

	    <div class="formDiv">
			<label for="dateHour">Date et Heure:</label><input type="datetime-local" id="dateHour" name="dateHour" value="2018-06-12T19:30">
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
    			<option value="1">Sport</option>
   				<option value="2">Musique</option>
    			<option value="3">Culture</option>
    			<option value="4">Gastronomie</option>
   	 			<option value="5">Art</option>
    			<option value="6">Commerce</option>
    			<option value="7">Autre</option>
			</select>
	    </div>

	    <div id="formDescription">
			<label for="description">Description</label><textarea id="description"  name="description"><?=$resultat['evts_description']?></textarea>
	    </div>

	    <div id="picEvent">
    
     			<input type="hidden"  name="MAX_FILE_SIZE" value="2000000">
     			<label for="eventPic">Photo (facultatif) <em>(max size: 2Mo)</em>: <input type="file" id="eventPic" name="eventPic"></p>
	
	    </div>


	   	<input type="submit" value="Modifier évènement">
	   

    </form>

</section>


<?php $content= ob_get_clean(); ?>

<?php require ('App/view/Frontend/template2.php'); ?>