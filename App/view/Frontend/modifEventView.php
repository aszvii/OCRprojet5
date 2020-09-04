<?php $title= 'Modifier un évènement'; ?>

<?php ob_start(); ?>

<section id="addModifEventDiv">

    <h1>Modifier un évènement</h1>


    <form method="post" action="index.php?action=modifEvent&id=<?=$_GET['id']?>">

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
			<label for="type">Type d'évènement:</label>
			<select name="type" id="type">
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
			<label for="description">Description</label><textarea id="description"  name="description"><?=$resultat['evts_description']?></textarea>
	    </div>

	   	<input type="submit" value="Modifier évènement">
	   

    </form>

</section>


<?php $content= ob_get_clean(); ?>

<?php require ('App/view/Frontend/template2.php'); ?>