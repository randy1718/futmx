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



$usuar = filter_input(INPUT_POST, 'Liga');
$entrar=filter_input(INPUT_POST, 'Entrar');
$eliminar=filter_input(INPUT_POST, 'Eliminar');

$_SESSION["usuario"] = $usuar;

if (isset($entrar)) {
    if($usuar==="a"){
        echo'<script type="text/javascript">
    alert("¡Seleccione una liga!");
    window.location.href="ligas.php";
    </script>';
    }
    
    
    $sql = "select NombreUsuario from usuario where NombreUsuario='$usuar' and idTipoUsuario='2'";


    $ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));

    if (!$ejecutar) {
        echo "hubo algun error";
    } else {
        echo"alright" . $usuar;
    }
    $reg = mysqli_fetch_array($ejecutar);


    if ($reg) {
        header("location:inter_admin_liga.php");
    } else {

    }
    
}else 
if (isset($eliminar)) {

    $sql1 = "delete from usuario where NombreUsuario='$usuar'";
    


    $ejecutar1 = mysqli_query($conexion, $sql1) or die("problems:" . mysqli_error($conexion));

    if (!$ejecutar1) {
        echo "hubo algun error";
    } else {
        echo'<script type="text/javascript">
    alert("¡Se elimino correctamente!");
    window.location.href="ligas.php";
    </script>';
    }
    
}
mysqli_close($conexion);
