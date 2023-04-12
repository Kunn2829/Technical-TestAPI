<?php

require_once "vendor\autoload.php";
USE Firebase\JWT\JWT;
class Conexion {
    private $host = "localhost";
    private $user = "usuario";
    private $password = "contraseña";
    private $dbname = "basedatos";
    private $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        if ($this->mysqli->connect_error) {
            die("Error de conexión: " . $this->mysqli->connect_error);
        }
    }

    public function query($sql) {
        return $this->mysqli->query($sql);
    }

    public function close() {
        $this->mysqli->close();
    }

    public static function jwt($id,$email) {
    
        $time = time();
        $token = array(

         "beginTime" => $time,
         "ExpTime"  => $time + (60*60*24),
         "data" =>  [

            "id" => $id,
            "email" => $email

         ] 
        
        );

       $jwt = JWT::encode($token, "1231asdasjd1231ya71623ygsd","HS512");
       return $jwt;

    }  

}
?>