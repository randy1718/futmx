<!DOCTYPE html>
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


/* @var $_REQUEST type */
$nombre = filter_input(INPUT_POST, "u");
$celular = filter_input(INPUT_POST, "c");
$email = filter_input(INPUT_POST, "e");



$sql = "insert into solicitud_liga(nombre_completo, celular, email) values ('$nombre','$celular','$email')";


$ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));

if (!$ejecutar) {
    echo "hubo algun error";
} else {
echo'<script type="text/javascript">
    alert("¡Gracias!");
    window.location.href="solicitud.html";
    </script>';
}

mysqli_close($conexion);