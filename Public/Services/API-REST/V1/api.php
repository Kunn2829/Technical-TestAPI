<?php
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Aquí puedes escribir el código que maneje las solicitudes GET de la API
  $response = array('message' => 'Esta es una respuesta GET de la API');
  echo json_encode($response);
} elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Aquí puedes escribir el código que maneje las solicitudes POST de la API
  $data = json_decode(file_get_contents('php://input'), true);
  $response = array('message' => 'Esta es una respuesta POST de la API', 'data' => $data);
  echo json_encode($response);
} else {
  // Si la solicitud no es GET ni POST, devolver un error 405
  http_response_code(405);
  echo json_encode(array('error' => 'Método no permitido'));
}
?>