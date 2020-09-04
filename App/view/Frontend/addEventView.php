<?php $title= 'Créer un évènement'; ?>

<?php ob_start(); ?>

<section id="addModifEventDiv">

    <h1>Créer un évènement</h1>


    <form method="post" action="index.php?action=addEvent">

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
			<label for="type">Type d'évènement:</label>
			<select name="type" id="type">
				<option value="">--Choisissez un type d'évènement--</option>
    			<option value="sport">Sport</option>
   				<option value="musique">Musique</option>
    			<option value="culture">Culture</option>
    			<option value="gastronomie">Gastronomie</option>
   	 			<option value="art">Art</option>
    			<option value="commerce">Commerce</option>
    			<option value="autre">Autre</option>
			</select>
	    </div>

	    <div id="formDescription">
			<label for="description">Description</label><textarea id="description"  name="description"></textarea>
	    </div>

	   	<input type="submit" value="Créer évènement">
	   

    </form>

</section>


<?php $content= ob_get_clean(); ?>

<?php require ('App/view/Frontend/template2.php'); ?>