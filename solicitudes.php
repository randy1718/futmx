<!DOCTYPE html>

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

?>

<html>
    <head>
        <title>FUTMX</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="ingresoLiga.css">
        <script src="librerias/jquery.js"></script>
        <link rel="icon" href="imagenes/balon.png">
        <script src="tabla.js"></script>
        <script src="librerias/bootstrap/js/bootstrap.js"></script>
        <script src="librerias/alertifyjs/alertify.js"></script>
    </head>
    <body id="ligas">

        <div style="position: relative">

        <div class="rectangulo">
            <a href="Start.html">
            <img class="logo" src="imagenes/logo.png">
            </a>
            <a class="ingreso" href="interfaz_administrador.php" name="Opcion" value="1" style="color:#000000"> Atrás</a>
        </div>

        <br>
      
        <div class="espacio"> 
        <div class="tabla">
            
        <table border="1" align="center" bgColor="FFFFFF" class="sol" id="solicitudes">
            <thead
                 <tr>
                     <td>id Solicitud</td>
                     <td>Nombre solicitante</td>
                     <td>Celular</td>
                     <td>Email</td>
                     <td>Eliminar</td>
                 </tr>
            </thead>

                 <?php

        $consulta="select id_solicitud_liga,nombre_completo,celular,email from solicitud_liga";
        $ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));

        if(!$ejecutar){
            echo "hubo algun error";
        }else{
            echo"";
        }

        while($mostrar= mysqli_fetch_array($ejecutar)){
        ?>
            <tr>
                <td><?php echo $mostrar['id_solicitud_liga'] ?></td>
                <td><?php echo $mostrar['nombre_completo'] ?></td>
                <td><?php echo $mostrar['celular'] ?></td>
                <td><?php echo $mostrar['email'] ?></td>
                <td>
                    <button class="eliminar" onclick="eliminar(<?php echo $mostrar['id_solicitud_liga'] ?>)">
                        <img class="x" src="imagenes/x-emoji-png-5.png" >
                    </button>
                     </td>


            </tr>
            <?php
        }
            ?>
            </table>
        </div>
        </div>
        
        <div class="titulo">
            Solicitudes liga
        </div>

        <script type="text/javascript">
        function eliminar(id){
            if(confirm('¿Estas seguro que quieres eliminar la cuenta?')){
            cadena="id="+id;

           $.ajax({
               type:"POST",
               url:"eliminarSolicitud.php",
               data:cadena,
               success:function(r){
                   if(r===1){
                       alert("¡No se borro correctamente!");
                   window.location.href="solicitudes.php";
               }else{
                   alert("¡Se borro correctamente!");
                   window.location.href="solicitudes.php";
               }
                   }

           });


        }
    }
        </script>

    </body>
</html>



























