<?php


if(!isset($_SESSION)){
	session_start();
}


require('App/controller/frontend.php');



try{
	if(isset($_GET['action'])){

		if($_GET['action']=='listEvents'){

			listEvents();
		}

		elseif($_GET['action']=="event"){
			event();
		}

		elseif ($_GET['action']=="eventInscription"){
			eventInscription();
		}

		elseif($_GET['action']=="addComment"){
			addComment($_SESSION['id'], htmlspecialchars($_POST['comment']));
		}

		elseif($_GET['action']=="register"){
			register();
		}

		elseif($_GET['action']=="addMember"){
			addMember($_POST['pseudo'], $_POST['mail'], $_POST['password']);
		}

		elseif($_GET['action']=="connect"){
			connect();
		}

		elseif($_GET['action']=="connection"){
			connection($_POST['pseudo'], $_POST['password']);
		}

		elseif($_GET['action']=="showEventsInscription"){
			showEventsInscription();
		}
	}


	else{
		listEvents();
	}

}
catch(Exception $e){

	echo 'Erreur: '. $e->getMessage();
}
