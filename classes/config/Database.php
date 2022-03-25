<?php
    class Database {
        
        private $DB_HOST = "localhost";
        private $DB_USER = "root";
        private $DB_PASSWORD = "";
        private $DB_NAME = "phptest";
		public $conn = null;

		public function __construct() { 
			try {
			  $this->conn = new PDO('mysql:host='.$this->DB_HOST.';dbname='.$this->DB_NAME, $this->DB_USER, $this->DB_PASSWORD);
			  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
			  die('Connectionn Failed : ' . $e->getMessage());
			}
		  }

    }
