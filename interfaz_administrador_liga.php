<!DOCTYPE html>
<?php
        $host='localhost';
        $user="root";
        $password='';
        $database='proyect';
        $conexion= mysqli_connect($host, $user, $password, $database) or die("problemas de conexion");
        session_start();
        
?>
<html>
    <head>
        <title>FUTMX</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="inter_liga.css">
        <link rel="icon" href="imagenes/balon.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="deslizar.js"></script>
        <script src="capa.js"></script>
    </head>
    <body>
        <div style="position: relative">
            <div class="ad_liga">
              <div class="saludo">Hola de nuevo, <?php echo $_SESSION["usuario"] ?> !</div>   
            </div>    
           
        <div class="rectangulo">
            <a href="interfaz_administrador_liga.php">
            <img class="logo" src="imagenes/logo.png">  
            </a>
            <div class="perfil" id="boton">
                
            </div>

        </div>
            
            
            
            <a href="ligas.html" name="Opcion" value="1" style="color:#000000">
             <div class="canchas">  

                 <img class="im" src="imagenes/canchas.jpg"> 
                <p class="txt2">Canchas</p>

             </div>
            </a> 
            
             <a href="solicitudes.html" name="Opcion" value="1" style="color:#000000">
             <div class="tabla_posiciones">  

                 <img class="im" src="imagenes/posiciones.png"> 
                <p class="txt3">Posiciones</p>

             </div>
            </a>
            
             <a href="crear_liga.html" name="Opcion" value="1" style="color:#000000">
             <div class="partidos">  

                 <img class="im" src="imagenes/vs.jfif"> 
                <p class="txt4">Partidos</p>

             </div>
            </a>
            <div id="capa">
                
            </div>
            <div id="slidebar">
                <a href="Start.html" class="salir">Salir</a>   
            </div>
            
        </div>
    </body>
</html>
