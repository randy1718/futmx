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


/* @var $_REQUEST type */
$nombre = filter_input(INPUT_POST, "uc");
$usuar = filter_input(INPUT_POST, "u");
$correo = filter_input(INPUT_POST, "c");

$us=$_SESSION["usuario"];


   $sqla = "update usuario set NombreCompleto='$nombre',NombreUsuario='$usuar',Correo='$correo' where NombreUsuario='$us'";

    $ejecutara = mysqli_query($conexion, $sqla) or die("problems:" . mysqli_error($conexion));

    if (!$ejecutara) {
       echo'<script type="text/javascript">
    alert("¡Hubo algun error!");
    window.location.href="cuenta.php";
    </script>';
    } else {
        echo'<script type="text/javascript">
    alert("¡Informacion actualizada!");
    window.location.href="cuenta.php";
    </script>';
    }

mysqli_close($conexion);
