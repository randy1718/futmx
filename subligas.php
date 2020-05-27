<!DOCTYPE html>

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
?>

<html>
    <head>
        <title>FUTMX</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="inter_liga.css">
        <script src="librerias/jquery.js"></script>
        <link rel="icon" href="imagenes/balon.png">
        <script src="tabla.js"></script>
        <script src="librerias/bootstrap/js/bootstrap.js"></script>
        <script src="librerias/alertifyjs/alertify.js"></script>
        <script src="capa_canchas.js"></script>
    </head>
    <body class="canchass">

        <div style="position: relative">

            <div class="rectangulo">
                <a href="interfaz_administrador_liga.php">
                    <img class="logo" src="imagenes/logo.png">  
                </a> 
                <a class="ingreso" href="interfaz_administrador_liga.php" name="Opcion" value="1" style="color:#000000"> Atrás</a>
            </div>
            <br>
            
        </div>
        
         <div class="box">
                <div class="box_inf">

                    <?php
                    $usuar = $_SESSION["usuario"];
                    $consulta = "select nombreSubliga from subliga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
                    $ejecutar = mysqli_query($conexion, $consulta) or die("problems:" . mysqli_error($conexion));

                    if (!$ejecutar) {
                        echo "hubo algun error";
                    } else {
                        echo"";
                    }

                    while ($mostrar = mysqli_fetch_array($ejecutar)) {

                        $nombre = $mostrar['nombreSubliga'];

                        ?>
                        <button class="can" onclick="abrir('<?php echo $nombre ?>')">
                            <div class="box_cancha">
                                <?php
                                
                                ?>
                                <p class="n_cancha"><?php echo $nombre ?></p>
                            </div>
                        </button>



                        <?php
                    }
                    ?>

                    
                </div>
                <div class="boton_crear_cancha">
                    <button class="crear_cancha"  onclick="abrirCreacion()">
                        <img class="mas" src="imagenes/mas.png">
                    </button>
                </div>


            </div>
    </body>
    
    <script type="text/javascript">
            
           
        function abrir(nombre){
            
            cadena="nombre="+nombre;

           $.ajax({
               type:"POST",
               url:"entrarSubliga.php",
               data:cadena,
               success:function(r){
                   if(r==="1"){
                       
                   window.location.href="interfaz_subliga.php";
                       
               }else{
                   
                   window.location.href="interfaz_subliga.php";

               }
                   }

           });


        
    }
        </script>


        
</html>