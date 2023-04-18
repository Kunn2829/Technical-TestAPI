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
    $id_user = $user["id_user"];
    $title_post=$_POST['title_post'];
    $description_post= $_POST['description_post'];
    $likes_user=0;


    $sql = "INSERT INTO posts (id_post_user,title_post, description_post, likes_users) VALUES ('$id_user','$title_post','$description_post','$likes_user')";
    if (mysqli_query($conn, $sql)) { mysqli_close($conn);
      http_response_code(201);
        $response = array('message' => 'Tu post ha sido creado exitosamente', 'data' => $title_post);
        echo json_encode($response);
      } else {
        mysqli_close($conn);
        $response = array('message' => 'ha habido un error interno al crear el post', 'data' => $mail_user);
        echo json_encode($response);
      }
    
    

  } else {
      // Si no se encontró el usuario, devolver un error
      http_response_code(401);
      echo "No tiene autorización para el acceso";
  }
  
    
  }
 
  
    }
    elseif($_SERVER['REQUEST_METHOD'] == 'GET') {

  
      if (isset($bearer_token)){
  
        $sql = "SELECT id_user FROM users WHERE jwt_token = '$bearer_token'";
        $result = mysqli_query($conn, $sql);
        
      
      // Verificar si se encontró el usuario
      if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $id_user = $user["id_user"];
        
        $sql = "SELECT * FROM posts WHERE id_post_user = '$id_user'";
        $result2 = mysqli_query($conn, $sql);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result2)) {
            $rows[] = $row;
        }
      
        echo json_encode($rows);
        
      } else {
          // Si no se encontró el usuario, devolver un error
          http_response_code(401);
          echo "No tiene autorización para el acceso";
      }
      
      // Cerrar la conexión a la base de datos
      mysqli_close($conn);
      
        
      }

} else {
 // Si la solicitud no es POST, devolver un error 405
 http_response_code(405);
 echo json_encode(array('error' => 'Método no permitido'));
}

?>