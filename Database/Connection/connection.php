<?php

require_once "vendor\autoload.php";
USE Firebase\JWT\JWT;
class Conexion {
    private static $instance = null;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "socialnetwork";
    private $conn = null;
 
    private function __construct() {
       $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }
 
    public static function getInstance() {
       if(!self::$instance) {
          self::$instance = new self();
       }
       return self::$instance;
    }
 
    public function getConnection() {
       return $this->conn;
    }
 }
?>