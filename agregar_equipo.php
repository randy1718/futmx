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

 $id= filter_input(INPUT_POST, "id");
 $nombre=filter_input(INPUT_POST, "nombre");
 $correo=filter_input(INPUT_POST, "correo");
 $nombreEquipo=filter_input(INPUT_POST, "nombreEquipo");
 $contrase=filter_input(INPUT_POST, "contraseña");
 $usuar= $_SESSION["usuario"];
 
$sql3 = "select idUsuario from usuario where NombreUsuario='$usuar'";
$ejecutar3 = mysqli_query($conexion, $sql3) or die("problems:" . mysqli_error($conexion));
$mostrar2 = mysqli_fetch_array($ejecutar3);
$idUsuario = $mostrar2["idUsuario"];
  
$sql0 = "select idLiga from liga inner join usuario on administrador=documento_identidad where idUsuario='$idUsuario' ";
$ejecutar1 = mysqli_query($conexion, $sql0) or die("problems:" . mysqli_error($conexion));
$mostrar = mysqli_fetch_array($ejecutar1);
$idLiga = $mostrar["idLiga"];
  
 $sql = "insert into equipos(admin_equipo,NombreEquipo,idLiga) values  ('$id','$nombreEquipo','$idLiga') ";
 $sql1="insert into usuario(idTipoUsuario, NombreUsuario, documento_identidad,Correo,Contraseña) values('3','$nombre','$id','$correo','$contrase')";
 $sql5="delete from solicitudesadminequipo where Cedula_Usuario='$id'";
 
 $ejecutar2 = mysqli_query($conexion, $sql1) or die("problems:" . mysqli_error($conexion));
 $ejecutar4 = mysqli_query($conexion, $sql5) or die("problems:" . mysqli_error($conexion));
 $ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));
 
  if (!$ejecutar || !$ejecutar2 || !$ejecutar4) {
      echo "1".$idLiga;
    } else {
        echo"alright".$idLiga;
    }