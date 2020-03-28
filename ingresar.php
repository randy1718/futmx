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
$usuar = filter_input(INPUT_POST, "u");
$contrasena = filter_input(INPUT_POST, "c");

$_SESSION["usuario"] = $usuar;

$sql = "select NombreUsuario, Contraseña from usuario where NombreUsuario='$usuar' and Contraseña='$contrasena' and idTipoUsuario='1'";
$sql2 = "select NombreUsuario, Contraseña from usuario where NombreUsuario='$usuar' and Contraseña='$contrasena' and idTipoUsuario='2'";

$ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));
$ejecutar2 = mysqli_query($conexion, $sql2) or die("problems:" . mysqli_error($conexion));

if (!$ejecutar) {
    echo "hubo algun error";
} else {
    echo"alright";
}
$reg = mysqli_fetch_array($ejecutar);
$reg2 = mysqli_fetch_array($ejecutar2);

if ($reg) {
    header("location:interfaz_administrador.php");
} else if ($reg2) {
    header("location:interfaz_administrador_liga.php");
}else {
    echo'<script type="text/javascript">
    alert("¡El usuario o la contraseña no coinciden!");
    window.location.href="ingresar.html";
    </script>';
}

mysqli_close($conexion);