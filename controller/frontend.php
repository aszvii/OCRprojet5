<?php


require_once('model/EventsManager.php');


function listEvents(){

	$eventsManager = new \OCR\Blog\Model\EventsManager();

	$req=$eventsManager->getEvents();


	if($req ==false){
		echo 'Impossible d\'afficher les évènements';
	}
	else{

		require('view/Frontend/listEventsView.php');
	}

}


function event(){

	$eventsManager = new \OCR\Blog\Model\EventsManager();

	$req=$eventsManager->getEvent($_GET['id']);


	if($req ==false){
		echo 'Impossible d\'afficher l\'évènement';
	}
	else{

		require('view/Frontend/eventView.php');
	}

}