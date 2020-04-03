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


$usuar = filter_input(INPUT_POST, 'Liga');

$_SESSION["usuario"] = $usuar;

$sql = "select NombreUsuario from usuario where NombreUsuario='$usuar' and idTipoUsuario='2'";


$ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));

if (!$ejecutar) {
    echo "hubo algun error";
} else {
    echo"alright".$usuar;
}
$reg = mysqli_fetch_array($ejecutar);


if ($reg) {
     header("location:interfaz_administrador_liga.php");
    
}else {
    echo'<script type="text/javascript">
    alert("¡El usuario o la contraseña no coinciden!");
    window.location.href="ingresar.html";
    </script>';
}

mysqli_close($conexion);