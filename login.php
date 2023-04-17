<?php
use Firebase\JWT\JWT;
require "Database\Connection\Connection.php";

header('Content-Type: application/json');

function getUserByUsername($username) {
     
    //Instaciamiento instancia de singleton DB
     $db = Conexion::getInstance();
     $conn = $db->getConnection();

    // Preparar la consulta SQL
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username_user = ?");

    // Asociar parámetros y ejecutar la consulta
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    // Obtener el resultado de la consulta
    $result = mysqli_stmt_get_result($stmt);

    // Obtener el usuario de la consulta
    $user = mysqli_fetch_assoc($result);



    
// Devolver el usuario

    return $user;
    
}

function password_verify_user($passwordSendUser,$password){

    if($password == $passwordSendUser){
        return true;
    } else {
       return false;
    }

}
function login($username, $password) {
    // Verificar las credenciales del usuario en la base de datos
    $user = getUserByUsername($username);
    if (!$user || !password_verify_user($password, $user["password_user"])) {
        return false;
    }


    // Generar un JWT con una duración de 1 hora
    $payload = array(
        "sub" => $user["id_user"],
        "name" => $user["name_user"],
        "username" => $user["username_user"],
        "exp" => time() + (60 * 60)
    );
    $jwt = JWT::encode($payload, "abc213sjdioa213108", 'HS256');

    return $jwt;
}



if($_SERVER['REQUEST_METHOD'] == 'POST') {
  
     //Instaciamiento instancia de singleton DB
  $db = Conexion::getInstance();
  $conn = $db->getConnection();
    // Obtener las credenciales del usuario de la consulta POST
$username = $_POST["username"];
$password = $_POST["password"];

// Verificar las credenciales del usuario y generar un JWT
$jwt = login($username, $password);


$clave_secreta = 'abc213sjdioa213108';

// Devolver el JWT en formato JSON
if ($jwt) {
    header('Content-Type: application/json');
    $sql = "UPDATE users SET jwt_token='$jwt' WHERE username_user='$username'";
    $result = mysqli_query($conn, $sql);
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
    echo json_encode(array("token" => $jwt));
} else {
    http_response_code(401);
    echo "Credenciales incorrectas";
}
    
} else {
    // Si la solicitud no es GET ni POST, devolver un error 405
    http_response_code(405);
    echo json_encode(array('error' => 'Método no permitido'));
  }

?>