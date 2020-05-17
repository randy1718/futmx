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
    $numero="select * from solicitud_liga";
    $ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));
    $ejecutar1= mysqli_query($conexion,$numero) or die ("problems:". mysqli_error($conexion));
     if(!$ejecutar || !$ejecutar1){
         echo "ocurrio un error";
     }else{

     }
      $numero_solicitudes= mysqli_num_rows($ejecutar1);
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
    <body class="central">
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
            <div class="recuadro"> </div>
            
            <div class="saludo">Hola de nuevo, Juan!</div>
            <a href="ligas.php" name="Opcion" value="1" style="color:#000000">
             <div class="liga">  

                <img class="im" src="imagenes/equipo.jpg"> 
                <p class="txt1">Ligas</p>

             </div>
            </a> 
            
             <a href="solicitudes.php" name="Opcion" value="1" style="color:#000000">
             <div class="solicitud_liga">  

                 <img class="im" src="imagenes/Grupo 10.png"> 
                <p class="txt">Solicitudes</p>
                <?php if($numero_solicitudes>0){?>
                <span class="numero" id="number"><div class="num"><?php echo"".$numero_solicitudes?></div></span>
                <?php }?>
             </div>
            </a>
            
             <a href="crear_liga.php" name="Opcion" value="1" style="color:#000000">
             <div class="creacion_liga">  

                 <img class="im" src="imagenes/b7dc8df21a11b92db73655ec928c042f.jpg"> 
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

                 <a href="interfaz_administrador.php" class="begin" name="Opcion" value="1" >Inicio</a>
                 <a href="cuenta.php" class="editar" name="Opcion" value="1" >Cuenta</a>
                 
                <a href="Start.html" class="salir" name="Opcion" value="1" >Salir</a>  
            </div>
            
        </div>
        
 <?php
        }
            ?>
        
    </body>
</html>
