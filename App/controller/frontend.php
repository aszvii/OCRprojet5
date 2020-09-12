<?php



require('vendor/autoload.php');

use App\model\EventsManager;
use App\model\CommentsManager;
use App\model\UserManager;


function listEvents(){

	$eventsManager = new EventsManager();   

	$req=$eventsManager->getEvents();


	if($req ==false){
		echo 'Impossible d\'afficher les évènements';
	}
	else{

		require('App/view/Frontend/listEventsView.php');

	}

}


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

		var_dump($currentPage);



		$result2=$result->fetch();
		
		$nbEvents= (int) $result2['nb_events'];

		//Nombre d'article qu'on souhaite affiché par page
		$perPage=5;

		//Calcul du nombre total de page nécessaire
		$pages= ceil($nbEvents / $perPage);


		//Calcul du premier article de la page
		$first= ($currentPage * $perPage) - $perPage ;


		var_dump($first);
		var_dump($perPage);


		$req=$eventsManager->getEvents($first, $perPage);


		if($req ==false){
			echo 'Impossible d\'afficher les évènements';
		}	
		else{
			require('App/view/Frontend/listEventsView.php');
		}

	}







	//On récupère la valeur du paramètre page
	/*if(isset($_GET['page']) && !empty($_GET['page'])){
    	$currentPage = (int) strip_tags($_GET['page']);
	}
	else{
    	$currentPage = 1;
	}

	//On récupère le nombre d'évènement dans la table events
	

	if($result==false){
		throw new Exception('Impossible d\'obtenir le nombre d\'évènements');	
	}
	else{

		$result2=$result->fetch();
		
		$nbEvents= (int) $result2['nb_events'];

		//Nombre d'article qu'on souhaite affiché par page
		$perPage=5;

		//Calcul du nombre total de page nécessaire
		$pages= ceil($nbEvents / $perPage);


		//Calcul du premier article de la page
		$first= ($currentPage * $perPage) - $perPage ;



  		$req=$eventsManager->getEvents($first, $perPage);


		if($req ==false){
			echo 'Impossible d\'afficher les évènements';
		}	
		else{
			require('App/view/Frontend/listEventsView.php');
		}
  	}*/

}



function event(){

	$eventsManager = new EventsManager();
	$commentsManager= new CommentsManager();

	$req=$eventsManager->getEvent($_GET['id']);

	$comments=$commentsManager->getComments($_GET['id']);

	if(isset($_SESSION['id'])){
		$verif=$eventsManager->verifMemberEventInscription($_SESSION['id'], $_GET['id']);
	}


	if($req==false || $comments===false){
		throw new Exception('Impossible d\'afficher la page');	
	}
	else if($req->rowCount()==0){
		throw new Exception('Le billet demandé n\'existe pas');
	}
	else {
		require('App/view/Frontend/eventView.php');
	}

}



function searchEventPerType($eventType){

	$eventsManager= new EventsManager();

	$req= $eventsManager->getEventPerType($eventType);

	$type=$eventsManager->getType($eventType);


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
	require('App/view/Frontend/addEventView.php');
}


/*function addEvent($eventCreator, $eventTitle, $eventDate, $eventPlace, $eventType, $eventDescript){

	$eventsManager= new EventsManager();

	$req=$eventsManager->addEvent($eventCreator, $eventTitle, $eventDate, $eventPlace, $eventType, $eventDescript);


	if($req==false){
		throw new Exception('Impossible d\'ajouter l\'évènement');
	}
	else{
		header('Location: index.php');
	}
}*/



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

	$req= $eventsManager->getEvent($_GET['id']);


	if($req==false){
		throw new Exception('Impossible d\'ouvrir la page');	
	}
	elseif($req->rowCount()==0){
		throw new Exception('L\'évènement que vous souhaitez modifier n\'existe pas');	
	}
	else{
		$resultat=$req->fetch(); 

		if($resultat['id_creator']==$_SESSION['id']){
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
					header('Location: index.php');
				}
			}
			else{
				throw new Exception('Vous ne pouvez pas modifier un évènement que vous n\'avez pas créé');
			}
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
			showEventsInscription();
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


//fonction administrateur
function cancelSignalEvent(){
	$eventsManager= new EventsManager();

	$req= $eventsManager->cancelSignal($_GET['id']);

	if($req==false){
		throw new Exception('Impossible d\'annuler le signalement');		
	}
	else{
		header('Location: index.php?action=showSignalEvent');
	}
}



function deleteSignalEvent(){

	$eventsManager= new EventsManager();

	$req= $eventsManager->deleteEvent($_GET['id']);

	if($req==false){
		throw new Exception('Impossible de supprimer l\'évènement');		
	}
	else{
		header('Location: index.php?action=showSignalEvent');
	}
}




//fonction administrateur
function getSignalEvent(){

	$eventsManager= new EventsManager();

	$req=$eventsManager->getSignalEvent();

	if($req==false){
		throw new Exception('Impossible d\'afficher les évènements');
	}
	else{
		require('App/view//Frontend/signalEventView.php');
	}
}



function eventInscription(){

	$eventsManager= new EventsManager();

	$verif=$eventsManager->verifMemberEventInscription($_SESSION['id'], $_GET['id']);

	if ($verif->rowCount()==0){

		$req=$eventsManager->eventInscription($_SESSION['id'], $_GET['id']);

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

	$eventsManager= new EventsManager();

	$req=$eventsManager->deleteInscription($_GET['id']);

	if($req==false){
		throw new Exception('Impossible de vous désinscrire');
	}
	else {
		header('Location: index.php?action=event&id='. $_GET['event']);
	}
}




function showEventsInscription(){

	$eventsManager= new EventsManager();

	$req=$eventsManager->getMemberEventsInscription($_SESSION['id']);

	$req2=$eventsManager->getCreateEvents($_SESSION['id']);

	if($req==false || $req2==false){
		throw new Exception('Impossible de d\'afficher les évènements');
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



//fonction administrateur
function cancelSignal(){

	$commentsManager= new \OCR\Blog\Model\CommentsManager();

	$req= $commentsManager->cancelSignal($_GET['id']);

	if($req==false){
		throw new Exception('Impossible de retirer le signalement');
	}
	else{
		header('Location: index.php?action=showSignalComment');
	}
}


//fonction administrateur
function showSignal(){

	$commentsManager= new \OCR\Blog\Model\CommentsManager();

	$req= $commentsManager->showSignalComment();

	if($req==false){
		throw new Exception('Impossible d\'afficher les commentaires signalés');		
	}
	else{
		require('view/Backend/signalComView.php');

	}
}


//fonction administrateur
function deleteCom(){

	$commentsManager= new \OCR\Blog\Model\CommentsManager();

	$req= $commentsManager->deleteComment($_GET['id']);

	if($req==false){
		throw new Exception('Impossible de supprimer le commentaire');
	}
	else{
		header('Location: index.php?action=post&id='. $_GET['post']);
	}
}


//fonction administrateur
function admin(){
	require('App/view/Frontend/adminView.php');
}




//fonction administrateur
function listPassedEvents(){

	$eventsManager = new EventsManager();   

	$req=$eventsManager->getPassedEvents();


	if($req ==false){
		echo 'Impossible d\'afficher les évènements';
	}
	else{

		require('App/view/Frontend/passedEventsView.php');
	}
}

//fonction administrateur
function deletePassedEvent(){

	$eventsManager= new EventsManager();

	$req= $eventsManager->deleteEvent($_GET['id']);

	if($req==false){
		throw new Exception('Impossible de supprimer l\'évènement');		
	}
	else{
		header('Location: index.php?action=passedEvents');
	}

}