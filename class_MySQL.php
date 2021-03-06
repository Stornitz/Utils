<?php
class MySQL {
	private $host = '____';
	private $dbname = '____';
	private $user = '____';
	private $password = '____';

	private $pdo = null;

	public function __construct() {
		try
		{
			$pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user, $this->password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$this->pdo = $pdo;
		}
		catch(PDOException $e)
		{
			die('SQL Errror: '.$e->getMessage());
		}
	}

	public function query($query, $params = array()) {
		if(empty($this->pdo)) die('SQL Error : Not connected');

		$req = $this->pdo->prepare($query);
		$req->execute($params);
		$data = $req->fetchAll();
		$req->closeCursor();
		return $data;
	}

	public function insert($query, $params = array()) {
		if(empty($this->pdo)) die('SQL Error : Not connected');

		$req = $this->pdo->prepare($query);
		$req->execute($params);
		$req->closeCursor();
	}
}
