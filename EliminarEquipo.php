<?php
$host = 'localhost';
$user = "root";
$password = '';
$database = 'id13484941_futmx1';
$conexion = mysqli_connect($host, $user, $password, $database) or die("problemas de conexion");

if (!$conexion) {
    echo"No se pudo conectar con el servidor";
} else {
    $base = mysqli_select_db($conexion, "id13484941_futmx1");
    if (!$base) {
        echo"No se encontro la base de datos";
    }
}

session_start();

$id= filter_input(INPUT_POST, "id");

$sql = "delete from equipos where idEquipo='$id'";
$sql1 = "delete from solicitudeseliminacionequipo where idEquipo='$id'";
$ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));
$ejecutar1 = mysqli_query($conexion, $sql1) or die("problems:" . mysqli_error($conexion));
if (!$ejecutar) {
    echo"1";
} else {
    echo"alright";
}