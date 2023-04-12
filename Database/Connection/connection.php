<?php
$host = 'localhost';
$user = 'tu_usuario';
$password = 'tu_contraseña';
$database = 'tu_base_de_datos';

$mysqli = new mysqli($host, $user, $password, $database);

// verificar la conexión
if ($mysqli->connect_errno) {
  die('Error al conectar a la base de datos: ' . $mysqli->connect_error);
}
?>