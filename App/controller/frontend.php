<?php


/*require_once('model/EventsManager.php');
require_once('model/CommentsManager.php');*/

require('vendor/autoload.php');

use App\model\EventsManager;


function listEvents(){

	$eventsManager = new EventsManager();    //$eventsManager=new EventsManager();

	$req=$eventsManager->getEvents();


	if($req ==false){
		echo 'Impossible d\'afficher les évènements';
	}
	else{

		require('App/view/Frontend/listEventsView.php');
	}

}


function event(){

	$eventsManager = new \OCR\Blog\Model\EventsManager();
	$commentsManager= new \OCR\Blog\Model\CommentsManager();

	$req=$eventsManager->getEvent($_GET['id']);

	$comments=$commentsManager->getComments($_GET['id']);



	if($req==false || $comments===false){
		throw new Exception('Impossible d\'afficher la page');	
	}
	else if($req->rowCount()==0){
		throw new Exception('Le billet demandé n\'existe pas');
	}
	else {
		require('view/Frontend/eventView.php');
	}

}



// INSCRIPTION & CONNEXION

function register(){
	require('view/Frontend/registerView.php');
}



function addMember($registerName, $registerMail, $registerPassword){

	$registerManager= new \OCR\Blog\Model\RegisterManager();

	$verif=$registerManager->verify($registerName, $registerMail);

	if($verif==false){
		throw new Exception('Impossible de créer le compte');
	}

	elseif($verif->rowCount()==0){

		$req= $registerManager->register($registerName, $registerMail, password_hash($registerPassword, PASSWORD_DEFAULT));

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
	require('view/Frontend/connectionView.php');
}



/*function connection($pseudo, $pass){

	$connectionManager= new \OCR\Blog\Model\ConnectionManager();

	$req=$connectionManager->connect($pseudo, $pass);

	if($req==false){
		throw new Exception("Impossible de vous connecter");
	}
	
	else{
		$resultats=$req->fetch();

		if($req->rowCount()==0){
			throw new Exception('pseudo ou mot de passe incorrect');	
		}
		else{
		
			session_start();
			$_SESSION['id']=$resultats['id'];
			$_SESSION['pseudo']= $pseudo;
			$_SESSION['type']=$resultats['type'];
		
			header ('Location: index.php?action=listEvents');
		}
	}

}*/


function connection($pseudo, $pass){

	$connectionManager= new \OCR\Blog\Model\ConnectionManager();

	$req=$connectionManager->connect($pseudo);

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
		
			header ('Location: index.php?action=listPosts');	
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

	$commentsManager=new  \OCR\Blog\Model\CommentsManager();

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