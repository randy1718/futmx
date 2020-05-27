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
$usuar = filter_input(INPUT_POST, "u");
$contrasena = filter_input(INPUT_POST, "c");




$sql3 = "select NombreUsuario, Contraseña from usuario where NombreUsuario= ? and Contraseña= ? and idTipoUsuario='1'";

$sql2 = "select NombreUsuario, Contraseña from usuario where NombreUsuario=? and Contraseña=? and idTipoUsuario='2'";

$sentencia= mysqli_prepare($conexion,$sql3) or die("problems:" . mysqli_error($conexion));
mysqli_stmt_bind_param($sentencia,'ss', $usuar,$contrasena);
mysqli_stmt_execute($sentencia);
mysqli_stmt_store_result($sentencia);
$reg = mysqli_stmt_num_rows($sentencia);

$sentencia1= mysqli_prepare($conexion,$sql2) or die("problems:" . mysqli_error($conexion));
mysqli_stmt_bind_param($sentencia1,'ss', $usuar,$contrasena);
mysqli_stmt_execute($sentencia1);
mysqli_stmt_store_result($sentencia1);
$reg1 = mysqli_stmt_num_rows($sentencia1);

if ($reg ==1) {
    $_SESSION["usuario"] = $usuar;
    header("location:interfaz_administrador.php");
} else if($reg1==1) {
    $_SESSION["usuario"] = $usuar;
    header("location:interfaz_administrador_liga.php");
}else{
    echo'<script type="text/javascript">
    alert("¡El usuario o la contraseña no coinciden!");
    window.location.href="ingresar.html";
    </script>';
}

mysqli_close($conexion);