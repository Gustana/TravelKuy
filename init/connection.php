<?php
    class Connection{
        private $host = "localhost";
        private $user = "root";
        private $pass = "gustana";
        private $db = "db_travel";

        protected $conn;

        public function __construct(){
            if(!isset($this->con)){
                $this->conn = new mysqli(
                    $this->host, 
                    $this->user, 
                    $this->pass, 
                    $this->db
                );

                if(!$this->conn){
                    die('Connection error');
                }
            }

            return $this->conn;
        }
    }

    $c = new Connection();

?>