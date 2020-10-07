<?php

namespace App\model;  


require_once('vendor/autoload.php');

use App\model\Manager;




class EventsInscriptionManager extends Manager{

	public function getEventRegisteredMembers($eventId){

		$db=$this->dbConnect();

		$req= $db->prepare(' SELECT COUNT(*) AS nb_Registered FROM events_inscription WHERE id_evts=?');
		$req->execute(array($eventId));

		return $req;

	}



	public function verifMemberEventInscription($pseudo, $event){

		$db=$this->dbConnect();

		$req = $db->prepare('SELECT events_inscription.id, events_inscription.id_members, events_inscription.id_evts, events.evts_title, DATE_FORMAT(events.evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, events.evts_place, events.evts_city, events.evts_description FROM events_inscription INNER JOIN events ON events_inscription.id_evts=events.id WHERE id_members=? AND id_evts=? ');
		$req->execute(array($pseudo, $event));

		return $req;
	}



	public function getMemberEventsInscription($pseudo){

		$db=$this->dbConnect();

		$req = $db->prepare('SELECT events_inscription.id, events_inscription.id_members, events_inscription.id_evts, events.id, events.id_creator, events.evts_title, DATE_FORMAT(events.evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, events.evts_place, events.evts_city, events.evts_description FROM events_inscription INNER JOIN events ON events_inscription.id_evts=events.id WHERE id_members=? ORDER BY evts_date');
		$req->execute(array($pseudo));

		return $req;
	}




	public function eventInscription($pseudo, $eventId){

		$db=$this->dbConnect();

		$req = $db->prepare('INSERT INTO events_inscription (id_members, id_evts, inscription_date) VALUES(?, ?, NOW())');
		$req->execute(array($pseudo, $eventId));

		return $req;
	}



	public function deleteInscription($inscriptionId){

		$db=$this->dbConnect();

		$req=$db->prepare('DELETE FROM events_inscription WHERE id=?');
		$req->execute(array($inscriptionId));

		return $req;
	}

}
