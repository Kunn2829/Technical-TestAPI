<?php
// datos de conexión a la base de datos
$host = 'localhost';
$user = 'usuario';
$password = 'contraseña';
$database = 'nombre_base_de_datos';

// crear la conexión
$conn = mysqli_connect($host, $user, $password, $database);

// verificar si la conexión fue exitosa
if (!$conn) {
  die('No se pudo conectar a la base de datos: ' . mysqli_connect_error());
}

echo 'Conexión exitosa a la base de datos';
?>