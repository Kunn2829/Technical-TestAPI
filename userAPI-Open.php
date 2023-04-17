<?php
use Firebase\JWT\JWT;
require "Database\Connection\Connection.php";

header('Content-Type: application/json');

$headers = getallheaders();

if (isset($headers['Authorization'])) {
    $auth_header = $headers['Authorization'];
    $auth_header_parts = explode(' ', $auth_header);
    if (count($auth_header_parts) == 2 && $auth_header_parts[0] == 'Bearer') {
        $bearer_token = $auth_header_parts[1];
        
    }
}

if  ($bearer_token === "Abc81391723Xd2141"){

if($_SERVER['REQUEST_METHOD'] == 'GET') {
  //Instaciamiento instancia de singleton DB
  $db = Conexion::getInstance();
  $conn = $db->getConnection();
  
if (isset($_GET["id_user"])){
  $id_user = $_GET["id_user"];
  $sql = "SELECT * FROM users WHERE id_user = $id_user";
$result = mysqli_query($conn, $sql);

// Verificar si se encontró el usuario
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Devolver los resultados en formato JSON
    header('Content-Type: application/json');
    echo json_encode($row);
} else {
    // Si no se encontró el usuario, devolver un error
    http_response_code(404);
    echo "Usuario no encontrado";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);

  
} else {

  $sql = "SELECT * FROM users";
  $result = mysqli_query($conn, $sql);
  
  // Obtener resultados como array asociativo
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
  }
  
  // Imprimir resultados
  header('Content-Type: application/json');
  $respuesta = json_encode($rows);
  echo $respuesta;
  // Cerrar la conexión a la base de datos
  mysqli_close($conn);

}
} elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  
  //Instaciamiento instancia de singleton DB
  $db = Conexion::getInstance();
  $conn = $db->getConnection();
  
//POST de los parametros
  $name_user = $_POST['name_user'];
  $mail_user = $_POST['mail_user'];
  $username_user = $_POST['username_user'];
  $description_user = $_POST['description_user'];
  $cel_user = $_POST['cel_user'];
  $password_user = $_POST['password'];
  
  $sql = "SELECT * FROM users WHERE mail_user = '$mail_user' OR username_user = '$username_user'";
  $result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Si el correo electrónico o nombre de usuario ya existe, enviar una respuesta de error
    http_response_code(409); // Código de estado HTTP 409 Conflict
    echo "El correo electrónico o nombre de usuario ya está en uso.";
} else {
  // Consulta SQL INSERT
  $sql = "INSERT INTO users (name_user, mail_user, username_user, description_user, cel_user, password_user) VALUES ( '$name_user', '$mail_user', '$username_user', '$description_user', '$cel_user', '$password_user')";
  
  if (mysqli_query($conn, $sql)) { mysqli_close($conn);
    $response = array('message' => 'El usuario ha sido agregado correctamente', 'data' => $mail_user);
    echo json_encode($response);
  } else {
    mysqli_close($conn);
    $response = array('message' => 'ha habido un error interno al crear el usuario', 'data' => $mail_user);
    echo json_encode($response);
  }}
  
} else {
  // Si la solicitud no es GET ni POST, devolver un error 405
  http_response_code(405);
  echo json_encode(array('error' => 'Método no permitido'));
}
} else {
  header('HTTP/1.1 401 Unauthorized');
  header('Content-Type: application/json');
  $error = array('message' => 'Token de autorización inválido');
  echo json_encode($error);
  exit();
}
?>