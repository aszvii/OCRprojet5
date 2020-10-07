<?php



require('vendor/autoload.php');

use App\model\EventsManager;
use App\model\EventsInscriptionManager;
use App\model\EventsTypeManager;
use App\model\CommentsManager;
use App\model\UserManager;




function listEventsPerPage(){


	$eventsManager = new EventsManager();

	$result=$eventsManager->getNbEvents();


	if($result==false){
		throw new Exception('Impossible d\'obtenir le nombre d\'évènements');
	}
	else{

		//On récupère la valeur du paramètre page
		if(isset($_GET['page']) && !empty($_GET['page'])){
    		$currentPage = (int) strip_tags($_GET['page']);
		}
		else{
    		$currentPage = 1;
		}




		$result2=$result->fetch();
		
		$nbEvents= (int) $result2['nb_events'];

		//Nombre d'article qu'on souhaite affiché par page
		$perPage=5;

		//Calcul du nombre total de page nécessaire
		$pages= ceil($nbEvents / $perPage);


		//Calcul du premier article de la page
		$first= ($currentPage * $perPage) - $perPage ;



		$req=$eventsManager->getEventsPerPage($first, $perPage);


		if($req ==false){
			echo 'Impossible d\'afficher les évènements';
		}	
		else{
			require('App/view/Frontend/listEventsView.php');
		}

	}

}



function event(){

	$eventsManager = new EventsManager();
	$commentsManager= new CommentsManager();
	$eventsInscriptionManager= new EventsInscriptionManager();


	$req=$eventsManager->getEvent($_GET['id']);

	$comments=$commentsManager->getComments($_GET['id']);



	$registered=$eventsInscriptionManager->getEventRegisteredMembers($_GET['id']);



	if(isset($_SESSION['id'])){
		$verif=$eventsInscriptionManager->verifMemberEventInscription($_SESSION['id'], $_GET['id']);
	}


	if($req==false || $comments===false){
		throw new Exception('Impossible d\'afficher la page');	
	}
	else if($req->rowCount()==0){
		throw new Exception('Le billet demandé n\'existe pas');
	}
	else {

		$deadLine= time() + (4*24*60*60);

		

		require('App/view/Frontend/eventView.php');
	}

}



function searchEventPerType($eventType){

	$eventsManager= new EventsManager();
	$eventsTypeManager= new EventsTypeManager();

	$req= $eventsManager->getEventPerType($eventType);

	$type=$eventsTypeManager->getType($eventType);


	if($req==false  || $type==false){
		throw new Exception('Impossible d\'afficher les évènements');
	}
	else{
			if($req->rowCount()==0){
				throw new Exception('Aucun évènement de ce type n\'a été trouvé');
			}
			else{
				require('App/view/Frontend/searchTypeEventView.php');
			}
	}

}



function searchEventPerCity($eventCity){

	$eventsManager= new EventsManager();

	$req= $eventsManager->getEventPerCity($eventCity);



	if($req==false){
		throw new Exception('Impossible d\'afficher les évènements');
	}
	else{
			if($req->rowCount()==0){
				throw new Exception('Aucun évènement n\'est organisé à cet endroit');
			}
			else{
				require('App/view/Frontend/searchCityEventView.php');
			}
			
	}

}



function eventCreation(){

	$eventsTypeManager= new EventsTypeManager();

	$types=$eventsTypeManager->getAllType();

	if($types==false){
		throw new Exception('Erreur lors de la requête');
	}
	else{
		require('App/view/Frontend/addEventView.php');
	}
}





function addEvent($eventCreator, $eventTitle, $eventDate, $eventPlace, $eventCity, $eventType, $eventDescript){

	$eventsManager= new EventsManager();



	if(isset($_FILES['eventPic']['tmp_name']) && $_FILES['eventPic']['name']!==""){

		
     	$dossier = 'upload/';

     	$fichier = basename($_FILES['eventPic']['name']);

     	$taille_maxi = 2000000;
		
		$taille = filesize($_FILES['eventPic']['tmp_name']);
		
		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
		
		$extension = strrchr($_FILES['eventPic']['name'], '.');



		if(!in_array($extension, $extensions) || !$taille){
	
			throw new Exception('Veuillez choisir un fichier au bon format (png, gif, jpg, jpeg, txt ou doc) et ne dépassant pas la taille maximum (2Mo)');
		}
		else{

			$newName= $eventCreator.$eventTitle.time().$extension;

     		$fichier= $newName;

     		$fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     		$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

     		$success=move_uploaded_file($_FILES['eventPic']['tmp_name'], $dossier . $fichier);


     		if($success){

				$req=$eventsManager->addEvent($eventCreator, $eventTitle, $eventDate, $eventPlace, $eventCity, $eventType, $fichier, $eventDescript);


				if($req==false){
					throw new Exception('Impossible d\'ajouter l\'évènement');
				}
				else{
					header('Location: index.php');
				}
     		}

		}
	}
	else{

		$req=$eventsManager->addEvent($eventCreator, $eventTitle, $eventDate, $eventPlace, $eventCity, $eventType, "", $eventDescript);


		if($req==false){
			throw new Exception('Impossible d\'ajouter l\'évènement');
		}
		else{
			header('Location: index.php');
		}
	}

}




function eventModifPage(){

	$eventsManager= new EventsManager();
	$eventsTypeManager= new EventsTypeManager();


	$req= $eventsManager->getEvent($_GET['id']);


	
                                                          //POURQUOI LA FONCTION NE FONCTIONNE PAS. NE RENVOI JAMAIS FALSE !!!!!!!
			//echo $fichier;

			/*if(file_exists($dossier.$verif['evts_img'])){
				//unlink($dossier.$verif['evts_img']);
				echo'il y IMG';
			}
			else{
				//throw new Exception('pas d\'img');
				echo 'Pas d\'img';
			}*/



	if($req==false){
		throw new Exception('Impossible d\'ouvrir la page');	
	}
	elseif($req->rowCount()==0){
		throw new Exception('L\'évènement que vous souhaitez modifier n\'existe pas');	
	}
	else{
		$resultat=$req->fetch(); 

		if($resultat['id_creator']==$_SESSION['id']){

			$types= $eventsTypeManager->getAllType();
			
			require('App/view/Frontend/modifEventView.php');
		}
		else{
			throw new Exception('Vous ne pouvez pas modifier un évènement que vous n\'avez pas créé');	
		}
	}

}




function modifEvent($newEventTitle, $newEventDate, $newEventPlace, $newEventCity, $newEventType, $newEventDescript){

	$eventsManager= new EventsManager();



	if(isset($_FILES['eventPic']['tmp_name']) && $_FILES['eventPic']['name']!==""){

		
     	$dossier = 'upload/';

     	$fichier = basename($_FILES['eventPic']['name']);

     	$taille_maxi = 2000000;
		
		$taille = filesize($_FILES['eventPic']['tmp_name']);
		
		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
		
		$extension = strrchr($_FILES['eventPic']['name'], '.');



		if(!in_array($extension, $extensions) || !$taille){
	
			throw new Exception('Veuillez choisir un fichier au bon format (png, gif, jpg, jpeg, txt ou doc) et ne dépassant pas la taille maximum (2Mo)');
		}
		else{

			$newName= $_SESSION['id'].$newEventTitle.time().$extension;


     		$fichier= $newName;

     		$fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     		$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);



     		//Suppression de l'ancienne image si il y en a une
     		$img=$eventsManager->verifyImg($_GET['id']);

			$verif=$img->fetch();


			if($verif['evts_img']!==""){                            //PK LA FONCTION file_exists() NE FONCTIONNE PAS ????
				unlink($dossier.$verif['evts_img']);
			}
			



     		$success=move_uploaded_file($_FILES['eventPic']['tmp_name'], $dossier . $fichier);


     		if($success){

				$event= $eventsManager->getEvent($_GET['id']);

				if($event==false){
					throw new Exception('Impossible de trouver l\'évènement à modifier');
				}
				else{
					$resultats=$event->fetch();

					if($resultats['id_creator']==$_SESSION['id']){

						$req= $eventsManager->modifEventWithImg($newEventTitle, $newEventDate, $newEventPlace, $newEventCity, $newEventType, $fichier, $newEventDescript, $_GET['id']);

						if($req==false){
							throw new Exception('Impossible de modifier le billet');	
						}
						else{

							header('Location: index.php');
						}
					}
					else{
						throw new Exception('Vous ne pouvez pas modifier un évènement que vous n\'avez pas créé');
					}
				}

			}
		}
	}

	else{

		$event= $eventsManager->getEvent($_GET['id']);

		if($event==false){
			throw new Exception('Impossible de trouver l\'évènement à modifier');
		}
		else{
			$resultats=$event->fetch();

			if($resultats['id_creator']==$_SESSION['id']){

				$req= $eventsManager->modifEvent($newEventTitle, $newEventDate, $newEventPlace, $newEventCity, $newEventType, $newEventDescript, $_GET['id']);

				if($req==false){
					throw new Exception('Impossible de modifier le billet');	
				}
				else{
					header('Location: index.php?action=showEventsInscription');
				}
			}
			else{
				throw new Exception('Vous ne pouvez pas modifier un évènement que vous n\'avez pas créé');
			}
		}
	}

}



function deleteImg(){

	$eventsManager= new EventsManager();

	$req= $eventsManager->getEvent($_GET['id']);


	if($req==false){

		throw new Exception('Impossible d\'effectuer la requête');
	}
	else{

		$event=$req->fetch();

		$dossier = 'upload/';

     	$fichier = $event['evts_img'];



		if($event['id_creator']==$_SESSION['id']){

			if($fichier!==""){ 

				$del=$eventsManager->deleteImage($_GET['id']);

				if($del==false){
					throw new Exception('Impossible de supprimer l\'image');
				}  
				else{
					unlink($dossier.$event['evts_img']);
				} 
			}
			else{

				throw new Exception('Ce évènement n\'a pas d\'image');
				
			}

			header("Location: index.php?action=eventModification&id=".$_GET['id']);
		}
		else{
			throw new Exception('Vous n\'avez pas le droit d\'effecture cette action');
		}
		
	}

}




function deleteEvent(){

	$eventsManager= new EventsManager();

	$event= $eventsManager->getEvent($_GET['id']);

	$req=$eventsManager->deleteEvent($_GET['id']);


	if($req==false){
		throw new Exception('Impossible de supprimer l\'évènement');
	}
	else{
		$resultats=$event->fetch();

		if($resultats['id_creator']==$_SESSION['id']){

			header('Location: index.php?action=showEventsInscription');
		}
		else{
			throw new Exception('Vous n\'avez pas le droit de supprimer cet évènement');
			
		}	
	}
}



function signalEvent(){

	$eventsManager= new EventsManager();

	$req= $eventsManager->signalEvent($_GET['id']);

	if($req==false){
		throw new Exception('Impossible de signaler le commentaire');
	}
	else{
		header('Location: index.php?action=event&id='.$_GET['id']);
	}
}





function eventInscription(){

	$eventsInscriptionManager= new EventsInscriptionManager();

	$verif=$eventsInscriptionManager->verifMemberEventInscription($_SESSION['id'], $_GET['id']);

	if ($verif->rowCount()==0){

		$req=$eventsInscriptionManager->eventInscription($_SESSION['id'], $_GET['id']);

		if($req==false){
			throw new Exception('Impossible de s\'inscrire à cet évènement');
		}
		else {
			header('Location: index.php?action=event&id='. $_GET['id']);
		}
	}
	else{
		throw new Exception('Vous êtes déjà inscrit à cet évènement');	
	}
}




function deleteInscription(){

	$eventsInscriptionManager= new EventsInscriptionManager();

	$req=$eventsInscriptionManager->deleteInscription($_GET['id']);

	if($req==false){
		throw new Exception('Impossible de vous désinscrire');
	}
	else {
		header('Location: index.php?action=event&id='. $_GET['event']);
	}
}




function showEventsInscription(){

	$eventsManager= new EventsManager();
	$eventsInscriptionManager= new EventsInscriptionManager();

	$req=$eventsInscriptionManager->getMemberEventsInscription($_SESSION['id']);

	$req2=$eventsManager->getCreateEvents($_SESSION['id']);

	if($req==false || $req2==false){
		throw new Exception('Impossible de d\'afficher la page');
	}
	else {
		require('App/view/Frontend/agendaView.php');
	}
}



// INSCRIPTION & CONNEXION

function register(){
	require('App/view/Frontend/registerView.php');
}



function addMember($registerName, $registerMail, $registerPassword){

	$userManager= new UserManager();

	$verif=$userManager->verify($registerName, $registerMail);

	if($verif==false){
		throw new Exception('Impossible de créer le compte');
	}

	elseif($verif->rowCount()==0){

		$req= $userManager->register($registerName, $registerMail, password_hash($registerPassword, PASSWORD_DEFAULT));

		if($req==false){
			throw new Exception('Impossible de créer le compte');
		}
		else{
			header('Location: index.php?action=connect');
		}
	}

	else{
		throw new Exception('Un compte à déjà été créé avec ce pseudo ou cette adresse mail');
	}
	
}



function connect(){
	require('App/view/Frontend/connectionView.php');
}




function connection($pseudo, $pass){

	$userManager= new UserManager();

	$req=$userManager->connect($pseudo);

	if($req==false){
		throw new Exception('Connexion impossible');
	}
	else{
		if($req->rowCount()==0){
			throw new Exception('Ce compte n\'existe pas');
		}
		else{
			$resultat=$req->fetch();
		}
		
	}
	

	$isPasswordCorrect= password_verify($_POST['password'], $resultat['password']);

	if(!$resultat){
		throw new Exception("Mauvais identifiants");
	}
	
	else{

		if($isPasswordCorrect){

			session_start();
			$_SESSION['id']=$resultat['id'];
			$_SESSION['pseudo']= $pseudo;
			$_SESSION['type']=$resultat['type'];
		
			header ('Location: index.php?action=listEvents');	
		}
		else{
			throw new Exception("Mot de passe incorrect");
		}
	}

}



function disconnect(){
	session_destroy();						

	header('Location: index.php');
}





//COMMENTAIRES


function addComment($author, $comment){

	$commentsManager= new CommentsManager();

	$req = $commentsManager->postComment($_GET['id'], $author, $comment);

	if($req === false){
		throw new Exception ('Impossible d\'ajouter le commentaire !');
	}
	else{
		header('Location: index.php?action=event&id='. $_GET['id']);
	}
}



function signalCom(){

	$commentsManager= new CommentsManager();

	$req= $commentsManager->signalComment($_GET['id']);

	if($req==false){
		throw new Exception('Impossible de signaler le commentaire');
	}
	else{
		header('Location: index.php?action=event&id='.$_GET['event']);
	}
}















