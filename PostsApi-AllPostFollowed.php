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
  
        $sql = "SELECT id_user FROM users WHERE jwt_token = '$bearer_token'";
        $result = mysqli_query($conn, $sql);
        
      
      // Verificar si se encontró el usuario
      if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $id_user_follow = $user["id_user"];
        $sql = "SELECT * FROM follow_users WHERE id_user_follow = '$id_user_follow'";
        $result2 = mysqli_query($conn, $sql);
       if (mysqli_num_rows($result2) > 0){
        
        $sql = "SELECT posts.*, users.name_user AS nombre_usuario 
        FROM posts
        INNER JOIN follow_users ON posts.id_post_user = follow_users.id_user_following 
        INNER JOIN users ON posts.id_post_user = users.id_user 
        WHERE follow_users.id_user_follow = '$id_user_follow'";
        $result3 = mysqli_query($conn, $sql);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result3)) {
            $rows[] = $row;
        }
      
        echo json_encode($rows);

       } else {
        http_response_code(401);
        echo "Lo sentimos no sigues a este usuario";
       }

       
        
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