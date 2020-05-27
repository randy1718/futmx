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


/* @var $_REQUEST type */
$nombreLiga = filter_input(INPUT_POST, "ligaName");
$nombreAdministrador = filter_input(INPUT_POST, "admin_liga");
$correoAdministrador = filter_input(INPUT_POST, "email_admin");
$passwordAdministrador = filter_input(INPUT_POST, "pass_admin");
$confirmPassword = filter_input(INPUT_POST, "confirm_admin");
$precioArbitraje = filter_input(INPUT_POST, "price_arbitraje");
$fechaInicio = filter_input(INPUT_POST, "fechaInicio");
$fechaFin = filter_input(INPUT_POST, "fechaFin");
$tipoDocumento = filter_input(INPUT_POST, "tipo_documento");
$Documento = filter_input(INPUT_POST, "id_doc");
if($passwordAdministrador != $confirmPassword){
   echo'<script type="text/javascript">
    alert("Las contraseñas no coinciden");
      window.location.href="crear_liga.html";
        </script>';
}else{

$sql = "insert into usuario (idTipoUsuario, NombreUsuario,tipo_documento_identidad, documento_identidad,Correo, Contraseña)values ('2','$nombreAdministrador','$tipoDocumento','$Documento','$correoAdministrador','$confirmPassword') ";
$sql2="insert into liga (Nombre,Administrador,FechaInicio, FechaFin, PrecioArbitraje) values('$nombreLiga','$Documento','$fechaInicio','$fechaFin','$precioArbitraje')";
$ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));
$ejecutar2 = mysqli_query($conexion, $sql2) or die("problems:" . mysqli_error($conexion));

if (!$ejecutar || !$ejecutar2) {
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