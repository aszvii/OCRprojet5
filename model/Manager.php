<?php

namespace OCR\Blog\Model;

class Manager
{

	protected function dbConnect(){

		$db = new \PDO ('mysql:host=localhost;dbname=ocr_projet5;charset=utf8', 'root', '');

		return $db;
	}
}