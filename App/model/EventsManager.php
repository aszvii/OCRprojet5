<?php

namespace App\model;  


require_once('vendor/autoload.php');

use App\model\Manager;



class EventsManager extends Manager
{

	public function getEvents(){
		
		$db=$this->dbConnect();

		$req = $db->query('SELECT id, evts_title, DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, evts_place, evts_city, evts_description FROM events WHERE evts_date > NOW() ORDER BY evts_date ');

		return $req;
	}


	public function getNbEvents(){

		$db=$this->dbConnect();

		$req = $db->query('SELECT COUNT(*) AS nb_events FROM events WHERE evts_date> NOW()');

		return $req;
	}



	public function getEventsPerPage($firstEvent, $eventsPerPage){
		
		$db=$this->dbConnect();

		$req = $db->prepare('SELECT id, evts_title, DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, evts_place, evts_city, evts_description FROM events WHERE evts_date > NOW() ORDER BY evts_date LIMIT :firstEvent, :eventsPerPage');
		$req->bindValue(':firstEvent', $firstEvent, \PDO::PARAM_INT);
		$req->bindValue(':eventsPerPage', $eventsPerPage, \PDO::PARAM_INT);
		$req->execute();

		return $req;
	}



	public function getEvent($eventId){
		
		$db=$this->dbConnect();


		$req = $db->prepare('SELECT events.id, events.id_creator, events.evts_title, events.evts_date, DATE_FORMAT(events.evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, DATE_FORMAT(events.evts_date, \'%Y-%m-%dT%H:%i\') AS date_evts_us, events.evts_place, events.evts_city, events.evts_type, events.evts_img, events.evts_description, members.name, events_type.type_name FROM events INNER JOIN members ON events.id_creator=members.id INNER JOIN events_type ON events.evts_type=events_type.id WHERE events.id=?');
		$req->execute(array($eventId));

		return $req;      
	}





	public function getEventPerType($eventType){

		$db=$this->dbConnect();

		$req=$db->prepare('SELECT id, evts_title, DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, evts_place, evts_city, evts_description FROM events WHERE evts_type=? && evts_date>NOW() ORDER BY evts_date');
		$req->execute(array($eventType));

		return $req;
	}




	public function getEventPerCity($eventCity){

		$db=$this->dbConnect();

		$req=$db->prepare('SELECT id, evts_title, DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, evts_place, evts_city, evts_description FROM events WHERE evts_date>NOW() && evts_city LIKE ? ORDER BY evts_date');
		
		$req->execute(array('%'.$eventCity.'%'));

		return $req;
	}



	public function getPassedEvents(){

		$db=$this->dbConnect();

		$req = $db->query('SELECT id, evts_title, DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, evts_place, evts_city, evts_description FROM events WHERE evts_date < NOW() ORDER BY evts_date ');

		return $req;
	}



	public function addEvent($eventCreator, $eventTitle, $eventDate, $eventPlace, $eventCity, $eventType, $eventImg, $eventDescript){

		$db=$this->dbConnect();

		$req = $db->prepare('INSERT INTO events (id_creator, evts_title, evts_date, evts_place, evts_city, evts_type, evts_img, evts_description, creation_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, NOW())');
		$req->execute(array($eventCreator, $eventTitle, $eventDate, $eventPlace, $eventCity, $eventType, $eventImg, $eventDescript));

		return $req;
	}



	public function modifEvent($newEventTitle, $newEventDate, $newEventPlace, $newEventCity, $newEventType, $newEventDescript, $eventId){

		$db=$this->dbConnect();

		$req=$db->prepare('UPDATE events SET evts_title=?, evts_date=?, evts_place=?, evts_city=?, evts_type=?, evts_description=? WHERE id=? ');
		$req->execute(array($newEventTitle, $newEventDate, $newEventPlace, $newEventCity, $newEventType, $newEventDescript, $eventId));


		return $req;
	}



	public function modifEventWithImg($newEventTitle, $newEventDate, $newEventPlace, $newEventCity, $newEventType, $newEventImg, $newEventDescript, $eventId){

		$db=$this->dbConnect();

		$req=$db->prepare('UPDATE events SET evts_title=?, evts_date=?, evts_place=?, evts_city=?, evts_type=?, evts_img=?, evts_description=? WHERE id=? ');
		$req->execute(array($newEventTitle, $newEventDate, $newEventPlace, $newEventCity, $newEventType, $newEventImg, $newEventDescript, $eventId));


		return $req;
	}



	public function verifyImg($eventId){

		$db=$this->dbConnect();

		$req=$db->prepare('SELECT evts_img FROM events WHERE id=?');
		$req->execute(array($eventId));

		return $req;
	}



	public function deleteImage($eventId){

		$db=$this->dbConnect();

		$req=$db->prepare('UPDATE events SET evts_img="" WHERE id=?');
		$req->execute(array($eventId));

		return $req;
	}



	public function getEventDate($eventId){

		$db=$this->dbConnect();


		$req=$db->prepare('SELECT DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr FROM events WHERE id=? ');//yyyy-MM-ddThh:mm
		$req->execute(array($eventId));


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



	public function getSignalEvent(){

		$db=$this->dbConnect();


		$req=$db->query('SELECT id, evts_title, DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, evts_place, evts_city, evts_description FROM events WHERE signalement=1');

		return $req;
	}




	public function cancelSignal($eventId){

		$db=$this->dbConnect();

		
		$req= $db->prepare('UPDATE events SET signalement=0 WHERE id=?');

		$req->execute(array($eventId));

		return $req;
	}




	public function getCreateEvents($pseudo){

		$db=$this->dbConnect();

		$req = $db->prepare('SELECT id, id_creator, evts_title, DATE_FORMAT(evts_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_evts_fr, evts_place, evts_city, evts_description FROM events WHERE id_creator=? ORDER BY evts_date');
		$req->execute(array($pseudo));

		return $req;
	}



}