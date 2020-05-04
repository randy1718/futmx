<?php

$host = 'localhost';
$user = "root";
$password = '';
$database = 'futmx';
$conexion = mysqli_connect($host, $user, $password, $database) or die("problemas de conexion");

if (!$conexion) {
    echo"No se pudo conectar con el servidor";
} else {
    $base = mysqli_select_db($conexion, "futmx");
    if (!$base) {
        echo"No se encontro la base de datos";
    }
}


$use= filter_input(INPUT_POST, "user");
$pass = filter_input(INPUT_POST, "pass");

$sql = "select * from usuario where NombreUsuario='$use' and Contraseña='$pass'";
$ejecutar1 = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));
$mostrar = mysqli_num_rows($ejecutar1);

if ($mostrar == 0) {
    echo "1";
} else {
    echo"2";
    session_start();
    $_SESSION['usuario'] = $use;
}
     
    
