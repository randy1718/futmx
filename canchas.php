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



            <div class="box">
                <div class="box_inf">

                    <?php
                    $usuar = $_SESSION["usuario"];
                    $consulta = "select * from cancha inner join liga on liga.idLiga=cancha.liga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
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
                            document.getElementById('capacidadCancha').value = capacidad;
                            document.getElementById('direccionCancha').value = ubicacion;
                            document.getElementById('ciudadCancha').value = ciudad;
                            document.getElementById('nc').value = nombre;
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
                        function cerrarFormFoto() {
                            document.getElementById('cambiar_foto').style.display = "none";

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
                        
                        function abrir_cambio(){
                            document.getElementById('cambiar_foto').style.display = "block";
                        }


                    </script>
                </div>
                <div class="boton_crear_cancha">
                    <button class="crear_cancha"  onclick="abrirCreacion()">
                        <img class="mas" src="imagenes/mas.png">
                    </button>
                </div>


            </div>
            <div class="tittle_cancha">Canchas</div>

            <div id="cap">
            </div>



            <div class="infor" id="info">
                <a href="javascript:cerrar()">
                    <img src="imagenes/5a5798809538462e5a82d431.png" class="x">
                </a>

                

                
                <div class="fotoCancha" id="boton" onclick="abrir_cambio()">
                        <?php
                        echo "<img  id='picture' class='canchaPicture'>";
                        ?>
                    </div>
                


                <form action="editCancha.php" method="POST" name="canchas">

                    <input class="idCancha" type="text" id="id" name="idCancha"  placeholder="" required><br>
                    <label class="lbel_nombre">Nombre:</label>
                    <input class="nombreCancha" type="text" id="nombre" name="nombreCancha"  required><br>
                    <label class="lbel_capacidad">Capacidad:</label>
                    <input class="capacidadCancha" type="text" id="capacidadCancha" name="CapacidadCancha" placeholder="Capacidad" required><br>
                    <label class="lbel_ciudad">Ciudad:</label>
                    <input class="CiudadCancha" type="text" id="ciudadCancha" name="CiudadCancha" placeholder="Ciudad" required><br>
                    <label class="lbel_direccion">Dirección:</label>
                    <input class="direccionCancha" type="text" id="direccionCancha" name="direccionCancha"  required><br> 
                    

                    <button class="update_cancha" onclick="return confirm('¿Estas seguro que quieres eliminar esta Liga?')">Actualizar</button>
                    <button class="delete_cancha" onclick="return confirm('¿Estas seguro que quieres eliminar esta Liga?')">Eliminar Cancha</button>

                </form>



            </div>
            

            



            <div id="crearCancha" class="form_cancha">
                <a href="javascript:cerrarForm()">
                    <img src="imagenes/5a5798809538462e5a82d431.png" class="x">
                </a>
                <form action="crear_cancha.php" method="POST" name="canchas" enctype="multipart/form-data">

                    <input class="NameCancha" type="text" id="nombreCancha" name="NombreCancha" placeholder="Nombre de la cancha" required><br>
                    <input class="Capacidad" type="text" id="capacidad" name="CapacidadCancha" placeholder="Capacidad" required><br>
                    <input class="Ubicacion" type="text"  <input classid="ubicacion" name="UbicacionCancha" placeholder="Ubicacion (Direccion)" required><br>
                    <input class="Ciudad" type="text" id="ciudad" name="CiudadCancha" placeholder="Ciudad" required><br>
                    <label class="lbel">Imagen de la cancha:</label>
                    <input type="file" class="PictureCancha"  name="fot_cancha"  required>
                    <div class="opciones_dias">
                        <div class="dias_semana">Escoge los dias de la semana:</div>
                        <br><input type="checkbox" class="cb" value="lunes" name="lu"><div class="dias">Lunes</div>
                        <br><input type="checkbox" class="cb" value="martes" name="ma"><div class="dias">Martes</div>
                        <br><input type="checkbox" class="cb" value="miercoles" name="mi"><div class="dias">Miercoles</div>
                        <br><input type="checkbox" class="cb" value="jueves" name="ju"><div class="dias">Jueves</div>
                        <br><input type="checkbox" class="cb" value="viernes" name="vi"><div class="dias">Viernes</div>
                        <br><input type="checkbox" class="cb" value="sabado" name="sa"><div class="dias">Sabado</div>
                        <br><input type="checkbox" class="cb" value="domingo" name="do"><div class="dias">Domingo</div>
                    </div>

                    <div class="horario_1">
                        <div class="lbel_h1">Hora de inicio</div>
                        <input type="time" class="inicio" value="00:00" name="horaInicio" required>
                        <div class="lbel_h2">Hora de fin</div>
                        <input type="time" class="fin" value="23:59" name="horaFin" required>
                    </div>

                    <button class="agregarCancha" >Agregar Cancha</button>

                </form>
            </div>
            
            
            <div id="cambiar_foto" class="act_foto">
                <a href="javascript:cerrarFormFoto()">
                    <img src="imagenes/5a5798809538462e5a82d431.png" class="x">
                </a>
                
                
                <form action="subirPhoto_Cancha.php" method="POST" enctype="multipart/form-data">

                    <div class="subir">  
                        <input type="file"  name="fotografia" onchange="processFiles(this.files)" />
                        <input class="nomb_ca" type="text"  id="nc" name="cancha_name"><br>
                    </div>

                    <div id="fileOutput" class="mostrar" accept="image/*">

                    </div>

                    <button type="submit"  class="actualizar" name="subir">Guardar</button><br>
                </form>    
                <script>
                    function processFiles(files) {
                        var file = files[0];


                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var output = document.getElementById("fileOutput");
                            output.style.backgroundImage = "url(" + e.target.result + ")";
                        };
                        reader.readAsDataURL(file);
                    }


                </script>
            </div>

    </body>



    <script type="text/javascript">
        function RecogerNombre() {

            var Nombre = document.getElementById("nc").value;


            cadena = {"nombre": Nombre};

            $.ajax({
                type: "POST",
                url: "subirPhoto_cancha.php",
                data: cadena,
                success: function (r) {
                 alert("La foto se actualizo correctamente");
                }

            });


        }
    </script>

</html>