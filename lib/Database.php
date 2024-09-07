<?php

Class Database {
	private $dbhost = DB_HOST;
	private $dbname = DB_NAME;
	private $dbuser = DB_USER;
	private $dbpass = DB_PASS;
	
	public $pdo;
	public $link;
	
	public function __construct() {
		$this->connectDB();
		$this->mysqliConnectDB();
	}
	
	private function connectDB() {
		if(!isset($this->pdo)) {
			try {
				$link = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
				$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$link->exec("SET CHARACTER SET utf8");
				$this->pdo = $link;
			} catch(PDOException $e) {
				die("Database connection error: ".$e->getMessage());
			}
		}
	}
	
	private function mysqliConnectDB() {
		$this->link = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if(!$this->link){
			$this->error ="Connection fail".$this->link->connect_error;
			return false;
		}
	}
	
	// Select or Read data
	
	public function select($query){
		$result = $this->link->query($query) or die($this->link->error.__LINE__);
		if($result->num_rows > 0){
			return $result;
		} else {
			return false;
		}
	}
}


?>