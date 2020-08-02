<?php

namespace OCR\Blog\Model;

require_once('model/Manager.php');


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

}