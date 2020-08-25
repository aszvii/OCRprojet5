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


function event(){

	$eventsManager = new EventsManager();
	$commentsManager= new CommentsManager();

	$req=$eventsManager->getEvent($_GET['id']);

	$comments=$commentsManager->getComments($_GET['id']);

	$verif=$eventsManager->getMemberEventsInscription($_SESSION['id']);



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



function eventInscription(){

	$eventsManager= new EventsManager();

	$verif=$eventsManager->getMemberEventsInscription($_SESSION['id']);

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




function showEventsInscription(){

	$eventsManager= new EventsManager();

	$req=$eventsManager->getMemberEventsInscription($_SESSION['id']);

	if($req==false){
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

	$resultat=$req->fetch();

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

	$commentsManager= new \OCR\Blog\Model\CommentsManager();

	$req= $commentsManager->signalComment($_GET['id']);

	if($req==false){
		throw new Exception('Impossible de signaler le commentaire');
	}
	else{
		header('Location: index.php?action=event&id='.$_GET['post']);
	}
}


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