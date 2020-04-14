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

 $id= filter_input(INPUT_POST, "idCancha");
 
 $sql = "delete from cancha where idCancha='$id'";
 $ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));
 
  if (!$ejecutar) {
      echo"algo salio mal";
    } else {
        echo"alright";
        header("location:canchas.php");
    }