<?php
include "Database\Connection\Connection.php";

$conexion = new Conexion();

$sql = "SELECT * FROM tabla";
$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    echo $fila["columna1"] . " " . $fila["columna2"];
}

$conexion->close();
?>