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
        <link rel="stylesheet" type="text/css" href="inter_liga.css">
        <script src="librerias/jquery.js"></script>
        <link rel="icon" href="imagenes/balon.png">
        <script src="tabla.js"></script>
        <script src="librerias/bootstrap/js/bootstrap.js"></script>
        <script src="librerias/alertifyjs/alertify.js"></script>
        <script src="capa_canchas.js"></script>
    </head>
    <body>

        <div style="position: relative">

            <div class="rectangulo">
                <a href="interfaz_administrador_liga.php">
                    <img class="logo" src="imagenes/logo.png">  
                </a> 
                <a class="ingreso" href="interfaz_administrador_liga.php" name="Opcion" value="1" style="color:#000000"> Atrás</a>
            </div>

            <br>



            <div class="box">

                <?php
                $usuar = $_SESSION["usuario"];
                $consulta = "select * from cancha inner join usuario on cancha.idUsuario=usuario.idUsuario where NombreUsuario='$usuar'";
                $ejecutar = mysqli_query($conexion, $consulta) or die("problems:" . mysqli_error($conexion));

                if (!$ejecutar) {
                    echo "hubo algun error";
                } else {
                    echo"";
                }

                while ($mostrar = mysqli_fetch_array($ejecutar)) {

                    $id = $mostrar['idCancha'];
                    $nombre = $mostrar['NombreCancha'];
                    $direccion = $mostrar['Direccion'];
                    $capacidad = $mostrar['Capacidad'];
                    $ciudad = $mostrar['Ciudad'];
                    $foto = $mostrar['fotoCancha'];
                    $imagen = base64_encode($foto);
                    $tipoFoto = $mostrar['tipoFoto'];
                    ?>
                    <button class="can" onclick="abrir('<?php echo $id ?>', '<?php echo $nombre ?>', '<?php echo $direccion ?>', '<?php echo $capacidad ?>', '<?php echo $ciudad ?>', '<?php echo $tipoFoto ?>', '<?php echo $imagen ?>')">
                        <div class="box_cancha">
                            <?php
                            echo "<img  class='img_cancha' src='data:" . $tipoFoto . ";base64," . $imagen . "'>";
                            ?>
                            <p class="n_cancha"><?php echo $mostrar['NombreCancha'] ?></p>
                        </div>
                    </button>



                    <?php
                }
                ?>

                <script type="text/javascript">
                    function abrir(id, nombre, ubicacion, capacidad, ciudad, tipoFoto, foto) {
                        document.getElementById('info').style.display = "block";
                        document.getElementById('cap').classList.toggle('cap');
                        document.getElementById('nombre').value = nombre;
                        document.getElementById('id').value = id;
                        document.getElementById('picture').setAttribute('src', 'data:"' + tipoFoto + '";base64,' + foto);


                    }
                    function cerrar() {
                        document.getElementById('info').style.display = "none";
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

                    function eliminar(id) {
                        if (confirm('¿Estas seguro que quieres eliminar la cuenta?')) {
                            cadena = "id=" + id;

                            $.ajax({
                                type: "POST",
                                url: "eliminarCancha.php",
                                data: cadena,
                                success: function (r) {
                                    if (r === 1) {
                                        alert("¡No se borro correctamente!");
                                        window.location.href = "solicitudes.php";
                                    } else {
                                        alert("¡Se borro correctamente!");
                                        window.location.href = "solicitudes.php";
                                    }
                                }

                            });


                        }
                    }

                </script>

                <button class="crear_cancha"  onclick="abrirCreacion()">
                <img class="mas" src="imagenes/mas.png">
            </button>
            </div>

            


            <div id="cap">

            </div>



            <div class="infor" id="info">
                <a href="javascript:cerrar()">
                    <img src="imagenes/5a5798809538462e5a82d431.png" class="x">
                </a>

                <a href="canchas.php" onclick="window.open('cambiarFoto.html', 'popup', 'width=750,height=410, left=400,right=400, top=200')"> 
                    <div class="fotoCancha" id="boton">
                        <?php
                        echo "<img  id='picture' class='canchaPicture'>";
                        ?>
                    </div>
                </a>

                <form action="editCancha.php" method="POST" name="canchas">

                    <input class="idCancha" type="text" id="id" name="idCancha"  required><br>
                    <input class="nombreCancha" type="text" id="nombre" name="nombreCancha"  required><br>
                    <input class="direccionCancha" type="text" id="direccion" name="direccionCancha"  required><br>      

                    <button class="delete_cancha" onclick="return confirm('¿Estas seguro que quieres eliminar esta Liga?')">Eliminar Cancha</button>

                </form>



            </div>





            <div id="crearCancha" class="form_cancha">
                <a href="javascript:cerrarForm()">
                    <img src="imagenes/5a5798809538462e5a82d431.png" class="x">
                </a>
                <form action="crearCancha.php" method="POST" name="canchas">

                </form>
            </div>
    </body>
</html>