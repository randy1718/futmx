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
$nombreCancha = filter_input(INPUT_POST, "NombreCancha");
$capacidad=filter_input(INPUT_POST, "CapacidadCancha");
$ubicacion=filter_input(INPUT_POST, "UbicacionCancha");
$ciudad=filter_input(INPUT_POST, "CiudadCancha");

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

if(!isset($_FILES['fot_cancha']) || $_FILES['fot_cancha']['error']>0){
  echo "Ha ocurrido un error";  
}else{

$permitidos=array("image/jpg","image/jpeg","image/gif","image/png");
    
    $imagen_temporal=$_FILES['fot_cancha']['tmp_name'];
    
    $tipo=$_FILES['fot_cancha']['type'];
    
    $fp= fopen($imagen_temporal, 'r+b');
    $data= fread($fp, filesize($imagen_temporal));
    fclose($fp);
    
    
    
    $d= mysqli_real_escape_string($conexion, $data);
    $usuar= $_SESSION["usuario"];

$sql1 = "select * from liga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
$ejecutar1 = mysqli_query($conexion, $sql1) or die("problems:" . mysqli_error($conexion));
$mostrar = mysqli_fetch_array($ejecutar1);
$id = $mostrar["idLiga"];

$sql = "insert into cancha(NombreCancha,liga, Capacidad, Ciudad, Direccion, fotoCancha, tipoFoto,horaInicio, horaFin, dias) 
        values ('$nombreCancha','$id','$capacidad','$ubicacion','$ciudad','$d','$tipo','$horaInicio','$horaFin','$dias')";

$ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));

if (!$ejecutar) {
    echo "hubo algun error";
} else {
echo'<script type="text/javascript">
    window.location.href="canchas.php";
    </script>';
}

}

mysqli_close($conexion);