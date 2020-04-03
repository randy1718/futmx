<!DOCTYPE html>
<?php
        $host='localhost';
        $user="root";
        $password='';
        $database='futmx';
        $conexion= mysqli_connect($host, $user, $password, $database) or die("problemas de conexion");
        session_start();
        
        $usuar= $_SESSION["usuario"];
$consulta="select foto,tipo_foto from usuario where NombreUsuario='$usuar'";
    $ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));
     if(!$ejecutar){
         echo "ocurrio un error";
     }else{

     }
     
      while($mostrar= mysqli_fetch_array($ejecutar)){  
        $imagen=$mostrar["foto"];
            
            $im=base64_decode($imagen);
?>
<html>
    <head>
        <title>FUTMX</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="interfaz.css">
        <link rel="icon" href="imagenes/balon.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="deslizar.js"></script>
        <script src="capa.js"></script>
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
    </head>
    <body>
        <div style="position: relative">
            
        <div class="rectangulo">
            <a href="interfaz_administrador.php">
            <img class="logo" src="imagenes/logo.png">  
            </a>
            <div class="perfil" id="boton">
                <?php
                echo "<img  class='fotoPerfil' src='data:".$mostrar["tipo_foto"].";base64,".base64_encode($imagen)."'>";
                ?>
            </div>
           

        </div>
            
            <div class="saludo">Hola de nuevo, Juan!</div>
            <a href="ligas.php" name="Opcion" value="1" style="color:#000000">
             <div class="liga">  

                <img class="im" src="imagenes/equipo.jpg"> 
                <p class="txt1">Ligas</p>

             </div>
            </a> 
            
             <a href="solicitudes.php" name="Opcion" value="1" style="color:#000000">
             <div class="solicitud_liga">  

                <img class="im" src="imagenes/equipo.jpg"> 
                <p class="txt">Solicitudes</p>

             </div>
            </a>
            
             <a href="crear_liga.html" name="Opcion" value="1" style="color:#000000">
             <div class="creacion_liga">  

                <img class="im" src="imagenes/equipo.jpg"> 
                <p class="txt">Crear liga</p>

             </div>
            </a>
            <div id="capa">
                
            </div>
            
             <div id="slidebar">
                 <a href="interfaz_administrador.php" onclick="window.open('cambiarFoto.html','popup','width=750,height=410, left=400,right=400, top=200')"> 
                 <div class="foto">
                     <?php
                echo "<img  class='fp' src='data:".$mostrar["tipo_foto"].";base64,".base64_encode($imagen)."'>";
                ?>
                </div>
                 </a>

                 
                <a href="cuenta.php" class="editar" name="Opcion" value="1" >Editar Cuenta</a> 
                <a href="Start.html" class="salir" name="Opcion" value="1" >Salir</a>  
            </div>
            
        </div>
        
 <?php
        }
            ?>
        
    </body>
</html>
