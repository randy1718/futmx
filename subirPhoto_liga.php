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

if(!isset($imagen) || $_FILES['fotografia']['error']>0){
  echo "Ha ocurrido un error";  
}else{
   


$permitidos=array("image/jpg","image/jpeg","image/gif","image/png");
    
    $imagen_temporal=$_FILES['fotografia']['tmp_name'];
    
    $tipo=$_FILES['fotografia']['type'];
    
    $fp= fopen($imagen_temporal, 'r+b');
    $data= fread($fp, filesize($imagen_temporal));
    fclose($fp);
    
    
    
    $d= mysqli_real_escape_string($conexion, $data);
    $usuar= $_SESSION["usuario"];
    
    $consulta="update usuario set foto='$d' where NombreUsuario='$usuar' ";
    $consulta2="update usuario set tipo_foto='$tipo' where NombreUsuario='$usuar' ";
    $ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));
    $ejecutar2= mysqli_query($conexion,$consulta2) or die ("problems:". mysqli_error($conexion));
     if(!$ejecutar || !$ejecutar2 ){
         echo "ocurrio un error";
     }else{
         echo "el archivo se subio correctamente";
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
        
