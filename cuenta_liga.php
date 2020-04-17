<!DOCTYPE html>
<?php
        $host='localhost';
        $user="root";
        $password='';
        $database='futmx';
        $conexion= mysqli_connect($host, $user, $password, $database) or die("problemas de conexion");
        session_start();
        
         $usuar= $_SESSION["usuario"];
        
        $consulta="select NombreUsuario, Correo,foto,tipo_foto from usuario where NombreUsuario='$usuar'";
        $ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));
        
        if(!$ejecutar){
            echo "hubo algun error";
        }else{
            echo"";
        }
              
       while($mostrar= mysqli_fetch_array($ejecutar)){  
        $imagen=$mostrar["foto"];
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
            <a href="interfaz_administrador_liga.php">
            <img class="logo" src="imagenes/logo.png">  
            </a>
            <div class="perfil" id="boton">
                <?php
                echo "<img  class='fotoPerfil' src='data:".$mostrar["tipo_foto"].";base64,".base64_encode($imagen)."'>";
                ?>
            </div>
           

        </div>
            
            <div class="informacion">
                
                <div class="tit">Datos personales </div>
                <form action="ingresar.php" method="POST">
         
                <input  class="usuario" type="text" id="1" name="u"  value="<?php echo $mostrar['NombreUsuario']  ?>" required><br>
                 <input  class="password" type="text" id="pass" name="c" value="<?php echo $mostrar['Correo']  ?>" required><br>
           

                
                <button type="submit"  class="entrar" name="subir">Actualizar</button><br>
              
            </form>
                
            </div>
            
            
            <div id="capa">
                
            </div>
            
             <div id="slidebar">
                 <a href="cuenta_liga.php" onclick="window.open('cambiarFoto.html','popup','width=750,height=410, left=400,right=400, top=200')"> 
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
