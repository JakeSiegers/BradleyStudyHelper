<?php
	//The Mysqli Helper 2014 - Jake Siegers
	//It's simple for now, it will grow as I need it to :)

	//To do list:
	//==========================
	// *ERROR CHECKING
	// *More options for functions, util all features of PDO
	//==========================


	class pdo_helper{

		//======THESE ARE ALL REQUIRED, EITHER IN CRED FILE, OR IN ARRAY FORM!====
		public $server;	//server ip or hostname
		public $port;	//server port
		public $user;
		public $password;
		public $database;
		//========================================================================

		public $pdo;
		public $preparedStatement;

		//accepts string file location of creds, or array of creds.

		function __construct($creds){
			if(!is_array($creds)){
				require_once($creds);
				$this->server = $server;
				$this->user = $user;
				$this->password = $password;
				$this->port = $port;
				$this->database = $database;
			}else{
				$this->server = $creds['server'];
				$this->user = $creds['user'];
				$this->password = $creds['password'];
				$this->port = $creds['port'];
				$this->database = $creds['database'];
			}
			$this->pdo = new PDO('mysql:dbname='.$this->database.';host='.$this->server.';port='.$this->port,$this->user,$this->password);
		}

		//Use ? in your query, then pass values in array $params in the same order.
		function query($query,$params=null){
			$this->preparedStatement = $this->pdo->prepare($query);
			if(!is_null($params)){
				for($i=0;$i<count($params);$i++){
					$this->preparedStatement->bindParam($i+1, $params[$i]);
				}
			}
			$this->preparedStatement->execute();
		}

		function fetch_assoc(){
			return $this->preparedStatement->fetch(PDO::FETCH_ASSOC);
		}

		function fetch_all_assoc(){
			//This is the "recomonded way" to do this with pdo, but just looping over fetch assoc is easier, and what we do anyway (see below).
			//return $this->preparedStatement->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);

			//My way.
			$result = array();
			while($row = $this->preparedStatement->fetch(PDO::FETCH_ASSOC)){
				$result[] = $row;
			}
			return $result;
		}

		//I guess...
		function fetchColumn(){
			return $this->preparedStatement->fetchColumn();
		}

	}

?>