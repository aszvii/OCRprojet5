<?php

namespace App\model;  

require_once('vendor/autoload.php');

use App\model\Manager;




class EventsTypeManager extends Manager{


	public function getType($eventType){

		$db=$this->dbConnect();

		$req=$db->prepare('SELECT type_name FROM events_type WHERE id=?');
		$req->execute(array($eventType));

		return $req;
	}




	public function getAllType(){

		$db=$this->dbConnect();

		$req=$db->query('SELECT id, type_name FROM events_type ORDER BY id');

		return $req;
	}

}
