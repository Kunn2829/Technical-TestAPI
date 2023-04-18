<?php

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
    

    $sql = "Update users SET jwt_token = 'close_session' WHERE jwt_token = '$bearer_token'";
    if (mysqli_query($conn, $sql)) { mysqli_close($conn);
        http_response_code(201);
        $response = array('message' => 'Has cerrado sesion exitosamente el usuario', 'data' => $bearer_token);
        echo json_encode($response);
      } else {
        mysqli_close($conn);
        $response = array('message' => 'no se ha podido cerrar la sesión del usuario', 'data' => $bearer_token);
        echo json_encode($response);
      }
    
    

  } else {
      // Si no se encontró el usuario, devolver un error
      http_response_code(401);
      echo "El usuario no ha iniciado sesión";
  }
  
    
  }
 
  
    }