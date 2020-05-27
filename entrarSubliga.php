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

session_start();



$nombre = filter_input(INPUT_POST, 'nombre');
$_SESSION["nombreLiga"] = $nombre;



   
    $sql = "select nombreSubliga from subliga inner join usuario on administrador=idUsuario where nombreSubliga='$nombre'";


    $ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));

    if (!$ejecutar) {
        echo "hubo algun error";
    } else {
        echo"1";
    }
    
   $reg = mysqli_fetch_array($ejecutar);


    if ($reg) {
        header("location:interfaz_subliga.php");
    } else {

    }
    

mysqli_close($conexion);
