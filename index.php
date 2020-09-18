<?php


if(!isset($_SESSION)){
	session_start();
}


require('App/controller/frontend.php');
require('App/controller/backend.php');



try{
	if(isset($_GET['action'])){

		if($_GET['action']=='listEvents'){

			listEventsPerPage();
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
				if(!empty($_POST['title']) && !empty($_POST['dateHour']) && !empty($_POST['place']) && !empty($_POST['city']) && !empty($_POST['type']) && !empty($_POST['description'])){
					addEvent($_SESSION['id'], htmlspecialchars($_POST['title']), $_POST['dateHour'], $_POST['place'], $_POST['city'], $_POST['type'], $_POST['description']);
				}
				else{
					throw new Exception('Veuillez remplir tous les champs');
				}
			}
			else{
				throw new Exception('Connectez vous pour créer un évènement !');
			}
		}



		/*elseif($_GET['action']=='addImg'){
			addImg();
		}*/



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
					if(!empty($_POST['title']) && !empty($_POST['dateHour']) && !empty($_POST['place']) && !empty($_POST['city']) && !empty($_POST['type']) && !empty($_POST['description'])){
						modifEvent(htmlspecialchars($_POST['title']), $_POST['dateHour'], $_POST['place'],  $_POST['city'], $_POST['type'], $_POST['description']);
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


		elseif($_GET['action']=="deleteImg"){
			if(isset($_SESSION['id'])){
				if(isset($_GET['id'])){
					deleteImg();
				}
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
			if(isset($_SESSION['id'])){
				if(isset($_GET['id'])){
					signalEvent();
				}
				else{
					throw new Exception('Aucun évènement à signaler');
				}
			}
			else{
				throw new Exception('Vous devez être connecté pour signaler un évènement');
			}
		}



		elseif($_GET['action']=="cancelSignalEvent"){
			if(isset($_SESSION['type']) && $_SESSION['type']==1){
				if(isset($_GET['id'])){
					cancelSignalEvent();
				}
				else{
					throw new Exception('Aucun id d\'évènement n\'a été envoyé');
				}
			}
			else{
				throw new Exception('Vous n\'avez pas les droits pour effectuer cette action');
			}
		}



		elseif($_GET['action']=="deleteSignalEvent"){
			if(isset($_SESSION['type']) && $_SESSION['type']==1){
				if(isset($_GET['id'])){
					deleteSignalEvent();
				}
				else{
					throw new Exception('Aucun évènement à supprimer');
				}
			}
			else{
				throw new Exception('Vous n\'avez pas les droits pour effectuer cette action');
			}
		}


		elseif($_GET['action']=="showSignalEvent"){
			getSignalEvent();
		}



		elseif ($_GET['action']=="eventInscription"){
			if(isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type']==0){
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
			if(isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type']==0){
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
			if(isset($_SESSION['id'])){
				signalCom();
			}
			else{
				throw new Exception('Vous ne pouvez pas effectuer cette action');
			}
		}



		elseif($_GET['action']=="showSignalComment"){
			if(isset($_SESSION['type']) && $_SESSION['type']==1){
				showSignalComment();
			}
			else{
				throw new Exception('Vous n\'avez pas les droits pour accéder à cette rubrique');
			}
		}




		elseif($_GET['action']=="cancelSignalComment"){
			if(isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type']==1){
				if(isset($_GET['id'])){
					cancelSignalComment();
				}
				else{
					throw new Exception('Aucun commentaire trouvé');
					
				}
			}
			else{
				throw new Exception('Vous n\'avez pas les droits pour effectuer cette action');	
			}
		}




		elseif($_GET['action']=="deleteComment"){
			if(isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type']==1){
				if(isset($_GET['id'])){
					deleteComment();
				}
				else{
					throw new Exception('Aucun commentaire à supprimer');
					
				}
			}
			else{
				throw new Exception('Vous n\'avez pas les droits pour effectuer cette action');	
			}
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
			if(isset($_SESSION['type']) && $_SESSION['type']==1){
				admin();
			}
			else{
				throw new Exception('Vous n\'avez pas les droits pour accéder à cette rubrique');
			}
		}



		elseif($_GET['action']=="passedEvents"){
			if(isset($_SESSION['type']) && $_SESSION['type']==1){
				listPassedEvents();
			}
			else{
				throw new Exception('Vous n\'avez pas les droits pour accéder à cette rubrique');
			}
		}


		elseif($_GET['action']=="deletePassedEvent"){
			if(isset($_SESSION['type']) && $_SESSION['type']==1){
				if(isset($_GET['id'])){
					deletePassedEvent();
				}
				else{
					throw new Exception('Aucun évènement à supprimer');
				}
			}
			else{
				throw new Exception('Vous n\'avez pas les droits pour effectuer cette action');
			}
		}
	}


	else{
		listEventsPerPage();
	}

}
catch(Exception $e){

	//echo 'Erreur: '. $e->getMessage();
	require('App/view/frontend/templateError.php');
}
