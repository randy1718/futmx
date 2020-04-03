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

 $id= filter_input(INPUT_POST, "id");
 
 $sql = "delete from solicitud_liga where id_solicitud_liga='$id'";
 $ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));
 
  if (!$ejecutar1) {
      echo"algo salio mal";
    } else {
        echo"alright";
        header("location:solicitudes.php");
    }