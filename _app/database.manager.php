<?php

/*
	fPot
	Version: 1.0
	Author: Forms [github.com/LucasFormiga]
	> Database Manager
*/

class DatabaseManager
{

	private $conn;

	public function __construct()
	{
		$this->conn = new PDO(DB_DRIVER . ':host=' . DB_IP . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR, DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}

	public function getDatabaseConnection()
	{
		return $this->conn;
	}

}