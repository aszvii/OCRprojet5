<?php

namespace App\model;  // La classe EventsManager est dans le namespace App\model


require_once('vendor/autoload.php');

use App\model\Manager;



class EventsManager extends Manager
{

	public function getEvents(){
		
		$db=$this->dbConnect();

		$req = $db->query('SELECT id, evts_title, DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, evts_place, evts_description FROM events ORDER BY evts_date DESC LIMIT 0,5');

		return $req;
	}



	public function getEvent($eventId){
		
		$db=$this->dbConnect();

		$req = $db->prepare('SELECT id, evts_title, DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, evts_place, evts_description FROM events WHERE  id=?');
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

		$req = $db->prepare('SELECT events_inscription.id_members, events_inscription.id_evts, events.id, events.evts_title, DATE_FORMAT(events.evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, events.evts_place, events.evts_description FROM events_inscription INNER JOIN events ON events_inscription.id_evts=events.id WHERE id_members=? ');
		$req->execute(array($pseudo));

		return $req;
	}

}