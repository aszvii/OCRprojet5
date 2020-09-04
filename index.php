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
			if(isset($_GET['id'])){
				event();
			}
			else{
				throw new Exception('Aucun identifiant de billet envoyé');
			}
		}



		elseif($_GET['action']=="searchType"){
			if(!empty($_POST['searchEventType'])){
				searchEventPerType($_POST['searchEventType']);
			}
			else{
				throw new Exception('Veuillez sélectionner un type d\'évènement à rechercher');
			}
		}



		elseif($_GET['action']=="searchCity"){
			if(!empty($_POST['searchEventCity'])){
				searchEventPerCity(strtolower($_POST['searchEventCity']));
			}
			else{
				throw new Exception('Veuillez sélectionner un lieu');
			}
		}



		elseif($_GET['action']=="eventCreation"){
			if(isset($_SESSION['id'])){
				eventCreation();
			}	
			else{
				throw new Exception('Connectez vous pour accéder à cette page !');
			}
		}



		elseif($_GET['action']=="addEvent"){
			if(isset($_SESSION['id'])){
				if(!empty($_POST['title']) && !empty($_POST['dateHour']) && !empty($_POST['place']) && !empty($_POST['type']) && !empty($_POST['description'])){
					addEvent($_SESSION['id'], htmlspecialchars($_POST['title']), $_POST['dateHour'], $_POST['place'], $_POST['type'], $_POST['description']);
				}
				else{
					throw new Exception('Veuillez remplir tous les champs');
				}
			}
			else{
				throw new Exception('Connectez vous pour créer un évènement !');
			}
		}


		elseif($_GET['action']=='eventModification'){
			if(isset($_SESSION['id'])){
				if(isset($_GET['id']) && $_GET['id']>0){
					eventModifPage();
				}
				else{
					throw new Exception('Aucun id d\'article à modifier n\'a été envoyé');	
				}
			}
			else{
				throw new Exception('Vous n\'avez pas les droits pour accéder à cette page');
				
			}
		}



		elseif($_GET['action']=='modifEvent'){
			if(isset($_SESSION['id'])){
				if(isset($_GET['id'])){
					if(!empty($_POST['title']) && !empty($_POST['dateHour']) && !empty($_POST['place']) && !empty($_POST['type']) && !empty($_POST['description'])){
						modifEvent(htmlspecialchars($_POST['title']), $_POST['dateHour'], $_POST['place'], $_POST['type'], $_POST['description']);
					}
					else{
						throw new Exception('Veuillez remplir tous les champs');
					}
				}
				else{
					throw new Exception('Aucun évènement à modifier');	
				}
			}
			else{
				throw new Exception('Connectez vous pour modifier un évènement !');
			}
		}



		elseif($_GET['action']=="deleteEvent"){
			if(isset($_SESSION['id'])){
				if(isset($_GET['id'])){
					deleteEvent();
				}
				else{
					throw new Exception('Aucun billet à supprimer')	;				
				}
			}
			else{
				throw new Exception('Vous devez être connecter pour supprimer un billet');
				
			}
		}



		elseif($_GET['action']=="signalEvent"){
			signalEvent();
		}



		elseif($_GET['action']=="showSignalEvent"){
			getSignalEvent();
		}


		elseif ($_GET['action']=="eventInscription"){
			if(isset($_SESSION['id'])){
				if(isset($_GET['id'])){
					eventInscription();
				}
				else{
					throw new Exception('L\'évènement n\'existe pas');	
				}
			}
			else{
				throw new Exception('Connectez vous pour vous inscrire à un évènement !');	
			}
		}



		elseif($_GET['action']=="deleteInscription"){
			if(isset($_SESSION['id'])){
				if(isset($_GET['id'])){
					deleteInscription();
				}
				else{
					throw new Exception('L\'évènement n\'existe pas');	
				}
			}
			else{
				throw new Exception('Connectez vous pour vous désinscrire !');	
			}
		}



		elseif($_GET['action']=="addComment"){
			if(isset($_SESSION['id'])){
				if(isset($_GET['id'])){
					if(!empty($_POST['comment'])){
						addComment($_SESSION['id'], htmlspecialchars($_POST['comment']));
					}
					else{
						throw new Exception ('Tous les champs doivent être remplis');
					}
				}
				else{
					throw new Exception ('Aucun identifiant de billet envoyé');
				}
			}
			else{
				throw new Exception('Connectez vous pour commenter');
				
			}
		}



		elseif($_GET['action']=="signalComment"){
			signalCom();
		}



		elseif($_GET['action']=="register"){
			register();
		}


		elseif($_GET['action']=='addMember'){

			if(!empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['password'])){

				if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
					
					addMember($_POST['pseudo'], $_POST['mail'], $_POST['password']);	
				}
				else{
					throw new Exception('Veuillez entrer une adresse email valide');
				}
			}
			else{
				throw new Exception('Veuillez remplir tous les champs pour créer un compte');		
			}
		}



		elseif($_GET['action']=="connect"){
			connect();
		}



		elseif($_GET['action']=='connection'){
			if (!empty($_POST['pseudo']) && !empty($_POST['password'])){
				connection($_POST['pseudo'], $_POST['password']);
			}
			else{
				throw new Exception ('Veuillez remplir tous les champs');
			}
		}


		elseif($_GET['action']=="disconnect"){
			disconnect();
		}


		elseif($_GET['action']=="showEventsInscription"){
			if(isset($_SESSION['id'])){
				showEventsInscription();
			}
			else{
				throw new Exception('Vous n\'avez pas le droit d\'accéder à cette page');
			}
		}



		elseif($_GET['action']=='admin'){
			admin();
		}



		elseif($_GET['action']=="passedEvents"){
			listPassedEvents();
		}
	}


	else{
		listEvents();
	}

}
catch(Exception $e){

	echo 'Erreur: '. $e->getMessage();
}
