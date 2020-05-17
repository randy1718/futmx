<!DOCTYPE html>

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

session_start();
?>

<html>
<head>
    <title>FUTMX</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="inter_liga.css">
    <script src="librerias/jquery.js"></script>
    <link rel="icon" href="imagenes/balon.png">
    <script src="tabla.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.js"></script>
    <script src="librerias/alertifyjs/alertify.js"></script>
    <script src="capa_canchas.js"></script>
</head>
<body class="canchass">

<div style="position: relative">

    <div class="rectangulo">
        <a href="interfaz_administrador_liga.php">
            <img class="logo" src="imagenes/logo.png">
        </a>
        <a class="ingreso" href="interfaz_administrador_liga.php" name="Opcion" value="1" style="color:#000000"> Atrás</a>
    </div>

    <br>
</div>
</body>



</html>