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
    $id_user_follow = $user["id_user"];
    $id_user_followed=$_POST['id_user_followed'];
    
    


    $sql = "INSERT INTO follow_users (id_user_follow,id_user_following) VALUES ('$id_user_follow','$id_user_followed')";
    if (mysqli_query($conn, $sql)) { mysqli_close($conn);
        $response = array('message' => 'Has seguido exitosamente al usuario', 'data' => $id_user_followed);
        echo json_encode($response);
      } else {
        mysqli_close($conn);
        $response = array('message' => 'no se ha podido seguir al usuario', 'data' => $like_status);
        echo json_encode($response);
      }
    
    

  } else {
      // Si no se encontró el usuario, devolver un error
      http_response_code(401);
      echo "No tiene autorización para el acceso";
  }
  
    
  }
 
  
    }