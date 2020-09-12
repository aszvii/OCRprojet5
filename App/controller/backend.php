<?php



require('vendor/autoload.php');

use App\model\EventsManager;
use App\model\CommentsManager;



//fonction administrateur
function admin(){
	require('App/view/Backend/adminView.php');
}





//fonction administrateur
function listPassedEvents(){

	$eventsManager = new EventsManager();   

	$req=$eventsManager->getPassedEvents();


	if($req ==false){
		echo 'Impossible d\'afficher les évènements';
	}
	else{

		require('App/view/Backend/passedEventsView.php');
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




//fonction administrateur
function showSignalComment(){

	$commentsManager= new CommentsManager();

	$req= $commentsManager->showSignalComment();

	if($req==false){
		throw new Exception('Impossible d\'afficher les commentaires signalés');		
	}
	else{
		require('App/view/Backend/signalComView.php');

	}
}


//fonction administrateur
function deleteComment(){

	$commentsManager= new CommentsManager();

	$req= $commentsManager->deleteComment($_GET['id']);

	if($req==false){
		throw new Exception('Impossible de supprimer le commentaire');
	}
	else{
		header('Location: index.php?action=showSignalComment');
	}
}





//fonction administrateur
function cancelSignalComment(){

	$commentsManager= new CommentsManager();

	$req= $commentsManager->cancelSignalComment($_GET['id']);

	if($req==false){
		throw new Exception('Impossible de retirer le signalement');
	}
	else{
		header('Location: index.php?action=showSignalComment');
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
		require('App/view//Backend/signalEventView.php');
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



//fonction administrateur
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


