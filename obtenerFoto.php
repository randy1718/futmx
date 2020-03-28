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

$nom=filter_input(INPUT_POST, "NombreUsuario");

if($nom>0){

$usuar= $_SESSION["usuario"];
$consulta="select foto,tipo_foto from usuario where NombreUsuario={$nom}";
    $ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));
     if(!$ejecutar){
         echo "ocurrio un error";
     }else{
         echo "el archivo se subio correctamente";
     }
     
      while($mostrar= mysqli_fetch_array($ejecutar)){  

     
     header("Content-type:".$mostrar['tipo_foto']);
     echo $mostrar['tipo_foto'];
      }
}
