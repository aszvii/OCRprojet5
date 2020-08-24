<?php

namespace App\model;

class Manager
{

	protected function dbConnect(){

		$db = new \PDO ('mysql:host=localhost;dbname=ocr_projet5;charset=utf8', 'root', '');

		return $db;
	}
}