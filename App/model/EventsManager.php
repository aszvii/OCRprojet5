<?php

namespace App\model;  // La classe EventsManager est dans le namespace App\model


require_once('vendor/autoload.php');

use App\model\Manager;



class EventsManager extends Manager
{

	public function getEvents(){
		
		$db=$this->dbConnect();

		$req = $db->query('SELECT id, evts_title, DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, evts_place, evts_description FROM events ORDER BY evts_date ');

		return $req;
	}



	public function getEvent($eventId){
		
		$db=$this->dbConnect();

		/*$req = $db->prepare('SELECT id, evts_title, DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, evts_place, evts_description FROM events WHERE id=?');*/

		$req = $db->prepare('SELECT events.id, events.id_creator, events.evts_title, DATE_FORMAT(events.evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, events.evts_place, events.evts_type, events.evts_description, members.name FROM events INNER JOIN members ON events.id_creator=members.id WHERE events.id=?');
		$req->execute(array($eventId));

		return $req;      
	}



	public function addEvent($eventCreator, $eventTitle, $eventDate, $eventPlace, $eventType, $eventDescript){

		$db=$this->dbConnect();

		$req = $db->prepare('INSERT INTO events (id_creator, evts_title, evts_date, evts_place, evts_type, evts_description, creation_date) VALUES(?, ?, ?, ?, ?, ?, NOW())');
		$req->execute(array($eventCreator, $eventTitle, $eventDate, $eventPlace, $eventType, $eventDescript));

		return $req;
	}



	public function modifEvent($newEventTitle, $newEventDate, $newEventPlace, $newEventType, $newEventDescript, $eventId){

		$db=$this->dbConnect();

		$req=$db->prepare('UPDATE events SET evts_title=?, evts_date=?, evts_place=?, evts_type=?, evts_description=? WHERE id=? ');
		$req->execute(array($newEventTitle, $newEventDate, $newEventPlace, $newEventType, $newEventDescript, $eventId));


		return $req;
	}



	public function deleteEvent($eventId){

		$db=$this->dbConnect();

		$req=$db->prepare('DELETE FROM events WHERE id=?');
		$req->execute(array($eventId));

		return $req;
	}



	public function signalEvent($eventId){

		$db=$this->dbConnect();

		
		$req= $db->prepare('UPDATE events SET signalement=1 WHERE id=?');

		$req->execute(array($eventId));

		return $req;

	}



	public function cancelSignal($commentId){

		$db=$this->dbConnect();

		
		$req= $db->prepare('UPDATE events SET signalment=0 WHERE id=?');

		$req->execute(array($eventId));

		return $req;
	}



	public function eventInscription($pseudo, $eventId){

		$db=$this->dbConnect();

		$req = $db->prepare('INSERT INTO events_inscription (id_members, id_evts, inscription_date) VALUES(?, ?, NOW())');
		$req->execute(array($pseudo, $eventId));

		return $req;
	}



	public function getMemberEventsInscription($pseudo){

		$db=$this->dbConnect();

		$req = $db->prepare('SELECT events_inscription.id, events_inscription.id_members, events_inscription.id_evts, events.id, events.id_creator, events.evts_title, DATE_FORMAT(events.evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, events.evts_place, events.evts_description FROM events_inscription INNER JOIN events ON events_inscription.id_evts=events.id WHERE id_members=?');
		$req->execute(array($pseudo));

		return $req;
	}


	public function getCreateEvents($pseudo){

		$db=$this->dbConnect();

		$req = $db->prepare('SELECT id, id_creator, evts_title, DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, evts_place, evts_description FROM events WHERE id_creator=?');
		$req->execute(array($pseudo));

		return $req;
	}



	public function verifMemberEventInscription($pseudo, $event){

		$db=$this->dbConnect();

		$req = $db->prepare('SELECT events_inscription.id, events_inscription.id_members, events_inscription.id_evts, events.evts_title, DATE_FORMAT(events.evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, events.evts_place, events.evts_description FROM events_inscription INNER JOIN events ON events_inscription.id_evts=events.id WHERE id_members=? AND id_evts=? ');
		$req->execute(array($pseudo, $event));

		return $req;
	}



	public function deleteInscription($inscriptionId){

		$db=$this->dbConnect();

		$req=$db->prepare('DELETE FROM events_inscription WHERE id=?');
		$req->execute(array($inscriptionId));

		return $req;
	}

}