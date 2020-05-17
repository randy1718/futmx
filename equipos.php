
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
        <link rel="stylesheet" type="text/css" href="interface_administrador_liga_options.css">
        <script src="librerias/jquery.js"></script>
        <link rel="icon" href="imagenes/balon.png">
        <script src="tabla.js"></script>
        <script src="librerias/bootstrap/js/bootstrap.js"></script>
        <script src="librerias/alertifyjs/alertify.js"></script>
     
    </head>
    <body class="canchass">

        <div style="position: relative">

            <div class="rectangulo">
                <a href="interfaz_administrador_liga.php">
                    <img class="logo" src="imagenes/logo.png">  
                </a> 
                <a class="ingreso" href="interfaz_administrador_liga.php" name="Opcion" value="1" style="color:#000000"> Atrás</a>
            </div>
            
            <div class="recuadro">
                 <div class="groups">

                    <?php
                    $usuar = $_SESSION["usuario"];
                    $consulta = "select * from equipos inner join li ga on equipos.idLiga=liga.idLiga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
                    $ejecutar = mysqli_query($conexion, $consulta) or die("problems:" . mysqli_error($conexion));

                    if (!$ejecutar) {
                        echo "hubo algun error";
                    } else {
                        echo"";
                    }

                    while ($mostrar = mysqli_fetch_array($ejecutar)) {

                        $id=$mostrar['idEquipo'];
                        $nombre = $mostrar['NombreEquipo'];
                        $foto = $mostrar['imagenEquipo'];
                        $imagen =base64_encode($foto);
                        $tipoFoto=$mostrar['tipoImagen'];

                        ?>
                     <button class="balls" onclick="abrir(<?php echo $id ?>)">
                            <div class="box_equipo">
                                <?php
                                echo "<img  class='img_equipo' src='data:" . $tipoFoto . ";base64," . $imagen . "'>";
                                ?>
                                <div class="n_equipo"><?php echo $nombre ?></div>
                            </div>
                        </button>



                        <?php
                    }
                    ?>
                     

                    <script type="text/javascript">
                        function abrir(id) {
                            document.getElementById('info_equipo').style.display = "block";
                            /**document.getElementById('cap').classList.toggle('cap');
                            document.getElementById('nombre').value = nombre;
                            document.getElementById('capacidadCancha').value = capacidad;
                            document.getElementById('direccionCancha').value = ubicacion;
                            document.getElementById('ciudadCancha').value = ciudad;
                            document.getElementById('nc').value = nombre;
                            
                            document.getElementById('picture').setAttribute('src', 'data:"' + tipoFoto + '";base64,' + foto);*/
                            document.getElementById('idEquipo').value = id;

                        }
                        function cerrar() {
                            document.getElementById('info_equipo').style.display = "none";
                            document.getElementById('cap').classList.toggle('cap');
                        }
                        function cerrarForm() {
                            document.getElementById('crearCancha').style.display = "none";
                            document.getElementById('cap').classList.toggle('cap');
                        }

                        function abrirCreacion() {
                            document.getElementById('crearCancha').style.display = "block";
                            document.getElementById('cap').classList.toggle('cap');
                        }

                        
                        
                        function abrir_cambio(){
                            document.getElementById('cambiar_foto').style.display = "block";
                        }


                    </script>
                </div>
            </div>
            
            <div class="equipo_t">
                Equipos
            </div>

            <br>
            
            <?php
                    $usuar1 = $_SESSION["usuario"];
                    $consulta1 = "select * from equipos inner join liga on equipos.idLiga=liga.idLiga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
                    $ejecutar1 = mysqli_query($conexion, $consulta1) or die("problems:" . mysqli_error($conexion));

                    if (!$ejecutar1) {
                        echo "hubo algun error";
                    } else {
                        echo"";
                    }

                    while ($mostrar = mysqli_fetch_array($ejecutar1)) {
                        
?>

            
            <div class="infor" id="info_equipo">
                <a href="javascript:cerrar()">
                    <img src="imagenes/5a5798809538462e5a82d431.png" class="x">
                </a>
      

                
                <div class="fotoCancha" id="boton" onclick="abrir_cambio()">
                        <?php
                        echo "<img  id='picture' class='canchaPicture'>";
                        ?>
                    </div>
                


                <form action="eliminar_equipo.php" method="POST" name="canchas">

                    <input class="idCancha" type="text" id="idEquipo" name="idEquipo"  placeholder="" required><br>
                    

                    <button class="update_cancha" onclick="return confirm('¿Estas seguro que quieres eliminar esta Liga?')">Actualizar</button>
                    <button class="delete_cancha" > Eliminar Equipo </button>
                </form>
                
                    
<?php 
        }
?>


            </div>
            <script type="text/javascript">
            
           
      
        </script>
        </div>
    </body>


        
</html>