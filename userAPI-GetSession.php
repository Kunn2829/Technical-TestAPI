<?php
use Firebase\JWT\JWT;
require "Database\Connection\Connection.php";

header('Content-Type: application/json');
  //Instaciamiento instancia de singleton DB
  $db = Conexion::getInstance();
  $conn = $db->getConnection();
$headers = getallheaders();

if (isset($headers['Authorization'])) {
    $auth_header = $headers['Authorization'];
    $auth_header_parts = explode(' ', $auth_header);
    if (count($auth_header_parts) == 2 && $auth_header_parts[0] == 'Bearer') {
        $bearer_token = $auth_header_parts[1];
        
    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {

  
if (isset($bearer_token)){
  
  $sql = "SELECT name_user,mail_user,username_user,description_user,cel_user FROM users WHERE jwt_token = '$bearer_token'";

$result = mysqli_query($conn, $sql);

// Verificar si se encontró el usuario
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Devolver los resultados en formato JSON
    header('Content-Type: application/json');
    echo json_encode($row);
} else {
    // Si no se encontró el usuario, devolver un error
    http_response_code(401);
    echo "No tiene autorización para el acceso";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);

  
}
} else {
  // Si la solicitud no es GET, devolver un error 405
  http_response_code(405);
  echo json_encode(array('error' => 'Método no permitido'));
}


?>