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

$imagen=$_FILES['fotografia'];
$nombre= filter_input(INPUT_POST, "cancha_name");

if(!isset($imagen) || $_FILES['fotografia']['error']>0){
 echo'<script type="text/javascript">
        
alert("Seleccione una imagen");
window.location.href="canchas.php";
     </script>'; 
}else{
   


$permitidos=array("image/jpg","image/jpeg","image/gif","image/png");
    
    $imagen_temporal=$_FILES['fotografia']['tmp_name'];
    
    $tipo=$_FILES['fotografia']['type'];
    
    $fp= fopen($imagen_temporal, 'r+b');
    $data= fread($fp, filesize($imagen_temporal));
    fclose($fp);
    
    
    
    $d= mysqli_real_escape_string($conexion, $data);
    $usuar= $_SESSION["usuario"];
    
    $consulta="update cancha set fotoCancha='$d' where NombreCancha='$nombre' ";
    $consulta2="update cancha set tipoFoto='$tipo' where NombreCancha='$nombre' ";
    $ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));
    $ejecutar2= mysqli_query($conexion,$consulta2) or die ("problems:". mysqli_error($conexion));
     if(!$ejecutar || !$ejecutar2 ){
         echo "1";
     }else{
        echo'<script type="text/javascript">
        
        window.location.href="canchas.php";
         </script>';
         
     }
}

/*
$imagen = filter_input(INPUT_POST, "fileOutput");
        $target_path="imagenes/";
        $target_path=$target_path. basename($_FILES['uploadedfile']['name']);
        
        if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)){
            echo "El archivo". basename($_FILES['uploadedfile']['name'])."ha sido subido";
        }else{
            echo "Ha ocurrido un error, trate de nuevo!";
        }

 */
        
