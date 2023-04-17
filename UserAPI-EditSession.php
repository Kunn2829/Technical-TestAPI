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

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  

if (isset($bearer_token)){
  
     $sql = "SELECT id_user FROM users WHERE jwt_token = '$bearer_token'";
     $result = mysqli_query($conn, $sql);
    
  // Verificar si se encontró el usuario
  if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    echo json_encode($user);
    $id_user = $user["id_user"];
    $new_username=$_POST['username_user'];
    $new_mail= $_POST['mail_user'];
    $new_description=$_POST['description_user'];
    $new_cel= $_POST['cel_user'];

    $sql = "UPDATE users SET username_user = '$new_username', mail_user = '$new_mail', description_user = '$new_description', cel_user = '$new_cel' WHERE id_user = '$id_user'";
    if (mysqli_query($conn, $sql)) { mysqli_close($conn);
        $response = array('message' => 'Tu cuenta ha sido actualizada exitosamente', 'data' => $new_mail);
        echo json_encode($response);
      } else {
        mysqli_close($conn);
        $response = array('message' => 'ha habido un error interno al actualizar     el usuario', 'data' => $mail_user);
        echo json_encode($response);
      }
    

  } else {
      // Si no se encontró el usuario, devolver un error
      http_response_code(401);
      echo "No tiene autorización para el acceso";
  }
  
    
  }
 
} else {
 // Si la solicitud no es POST, devolver un error 405
 http_response_code(405);
 echo json_encode(array('error' => 'Método no permitido'));
}

?>