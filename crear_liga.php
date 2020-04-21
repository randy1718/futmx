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


/* @var $_REQUEST type */
$nombreLiga = filter_input(INPUT_POST, "ligaName");
$nombreAdministrador = filter_input(INPUT_POST, "admin_liga");
$correoAdministrador = filter_input(INPUT_POST, "email_admin");
$passwordAdministrador = filter_input(INPUT_POST, "pass_admin");
$confirmPassword = filter_input(INPUT_POST, "confirm_admin");

if($passwordAdministrador != $confirmPassword){
   echo'<script type="text/javascript">
    alert("Las contraseñas no coinciden");
      window.location.href="crear_liga.html";
        </script>';
}else{

$sql = "insert into usuario (idTipoUsuario, NombreUsuario, NombreLiga, Correo, Contraseña)values ('2','$nombreAdministrador','$nombreLiga','$correoAdministrador','$confirmPassword') ";
$ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));

if (!$ejecutar) {
   echo'<script type="text/javascript">
    alert("¡Hubo un error!");
    window.location.href="crear_liga.html";
    </script>';
} else {
echo'<script type="text/javascript">
    alert("¡Liga Creada!");
    window.location.href="interfaz_administrador.php";
    </script>';
}

}
mysqli_close($conexion);