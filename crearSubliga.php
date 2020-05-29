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

/* @var $_REQUEST type */
$nombreSubliga = filter_input(INPUT_POST, "NombreSubliga");
$fechaInicio = filter_input(INPUT_POST, "fechaInicio");
$fechaFin = filter_input(INPUT_POST, "fechaFin");
$horaInicio = filter_input(INPUT_POST, "horaInicio");
$horaFin = filter_input(INPUT_POST, "horaFin");

$lunes = filter_input(INPUT_POST, "lu");
$martes = filter_input(INPUT_POST, "ma");
$miercoles = filter_input(INPUT_POST, "mi");
$jueves = filter_input(INPUT_POST, "ju");
$viernes = filter_input(INPUT_POST, "vi");
$sabado = filter_input(INPUT_POST, "sa");
$domingo = filter_input(INPUT_POST, "do");

$dias="[".$lunes.",".$martes.",".$miercoles.",".$jueves.",".$viernes.",".$sabado.",".$domingo."]";


    $usuar= $_SESSION["usuario"];

    $sql1 = "select * from liga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
    $ejecutar1 = mysqli_query($conexion, $sql1) or die("problems:" . mysqli_error($conexion));
    $mostrar = mysqli_fetch_array($ejecutar1);
    $id = $mostrar["idLiga"];
    $documento=$mostrar['documento_identidad'];


    $sql = "insert into subliga(nombreSubliga,LigaPrincipal,Administrador,fechaInicio,fechaFin,horaInicio,horaFin, dias) 
            values('$nombreSubliga','$id','$documento','$fechaInicio','$fechaFin','$horaInicio','$horaFin','$dias')";

    $ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));

    if (!$ejecutar) {
        echo "hubo algun error";
    } else {
        echo'<script type="text/javascript">
    window.location.href="subligas.php";
    </script>';
    }



mysqli_close($conexion);