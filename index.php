<?php



require('App/controller/frontend.php');


try{
	if(isset($_GET['action'])){

		if($_GET['action']=='listEvents'){

			listEvents();
		}

		elseif($_GET['action']=="event"){
			event();
		}

		elseif($_GET['action']=="register"){
			register();
		}
	}


	else{
		listEvents();
	}

}
catch(Exception $e){

	echo 'Erreur: '. $e->getMessage();
}
