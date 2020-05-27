<!DOCTYPE html>

<?php
$host = 'localhost';
$user = "root";
$password = '';
$database = 'id13484941_futmx1';
$conexion = mysqli_connect($host, $user, $password, $database) or die("problemas de conexion");

if (!$conexion) {
    echo "No se pudo conectar con el servidor";
} else {
    $base = mysqli_select_db($conexion, "id13484941_futmx1");
    if (!$base) {
        echo "No se encontro la base de datos";
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
    <script src="capa_equipos.js"></script>
</head>
<body class="canchass">

<div style="position: relative">

    <div class="rectangulo">
        <a href="interfaz_subliga.php">
            <img class="logo" src="imagenes/logo.png">
        </a>
        <a class="ingreso" href="interfaz_subliga.php" name="Opcion" value="1" style="color:#000000">
            Atrás</a>
    </div>

    <div class="recuadro">
        <div class="groups">

            <?php
            $usuar = $_SESSION['nombreLiga'];
            $consulta = "select * from equipos inner join liga on equipos.idLiga=liga.idLiga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
            $ejecutar = mysqli_query($conexion, $consulta) or die("problems:" . mysqli_error($conexion));

            if (!$ejecutar) {
                echo "hubo algun error";
            } else {
                echo "";
            }

            while ($mostrar = mysqli_fetch_array($ejecutar)) {

                $id = $mostrar['idEquipo'];
                $nombre = $mostrar['NombreEquipo'];
                $dirFoto = $mostrar['dirFoto'];

                ?>
                <button class="balls" onclick="abrir(<?php echo $id ?>)">
                    <div class="box_equipo">
                        <?php
                        /**echo "<img  class='img_equipo' src='data:" . $tipoFoto . ";base64," . $imagen . "'>";*/
                        echo "<img  class='img_equipo' src='imagenes/" . $dirFoto . "'>";
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
                    document.getElementById('cap_equipos').classList.toggle('cap_equipos');
                    document.getElementById('idEquipo').value = id;
                    document.getElementById('idE').value = id;


                }

                function cerrar() {
                    document.getElementById('info_equipo').style.display = "none";
                    document.getElementById('cap_equipos').classList.toggle('cap_equipos');
                    document.getElementById('idE').value = 0;
                    document.forms['jugadores'].submit();
                }


                function eliminarJugador(id) {
                    if(confirm('¿Estas seguro que quieres eliminar a este jugador?')){
                        cadena={
                            "id":id,
                        };

                        $.ajax({
                            type:"POST",
                            url:"eliminarJugador.php",
                            data:cadena,
                            success:function(r){
                                if(r==="1"){
                                    alert("¡Hubo un error!"+r);
                                    window.location.href="equipos.php";
                                }else{
                                    alert("¡Se elimino correctament!"+r);
                                    window.location.href="equipos.php";
                                }
                            }

                        });
                    }
                }


            </script>
        </div>
    </div>

    <div class="equipo_t">
        Equipos
    </div>

    <br>

    <div id="cap_equipos">

    </div>

    <?php
    $usuar1 = $_SESSION["usuario"];
    $consulta1 = "select * from equipos inner join liga on equipos.idLiga=liga.idLiga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
    $ejecutar1 = mysqli_query($conexion, $consulta1) or die("problems:" . mysqli_error($conexion));

    if (!$ejecutar1) {
        echo "hubo algun error";
    } else {
        echo "";
    }

    while ($mostrar = mysqli_fetch_array($ejecutar1)) {

    ?>


    <div class="infor_equipo" id="info_equipo">
        <a href="javascript:cerrar()">
            <img src="imagenes/5a5798809538462e5a82d431.png" class="x_equipo">
        </a>

        <div class="contenedor_jugadores">

            <table border="1" align="center" bgColor="FFFFFF" class="jugadores" id="solicitudes_Equipo">
                <thead
                <tr>
                    <td>Numero</td>
                    <td>Nombre Jugador</td>
                    <td>Eliminar</td>

                </tr>
                </thead>
                <?php
                $usuar1 = $_SESSION["usuario"];
                $id= filter_input(INPUT_POST, "idEqu");
                $consulta1 = "select * from usuarios inner join jugadores on Cedula=idUsuario inner join equipos on id_Equipo=idEquipo where idEquipo='$id'";
                $ejecutar2 = mysqli_query($conexion, $consulta1) or die("problems:" . mysqli_error($conexion));

                if (!$ejecutar1) {
                    echo "hubo algun error";
                } else {

                }

                while ($mostrar = mysqli_fetch_array($ejecutar2)) {
                    $idJugador=$mostrar['Cedula'];
                    $numero=$mostrar['Numero'];
                    $nombre=$mostrar['Nombre'];
                    ?>
                    <tr>
                        <td><?php echo $numero ?></td>
                        <td><?php echo $nombre ?></td>

                        <td><button class="agregarEquipo" onclick="eliminarJugador('<?php echo $idJugador ?>')">

                            </button></td>

                    </tr>
                    <?php
                }
                ?>
            </table>

        </div>


        <form action="equipos.php" method="POST" id="jugadores">
            <input type="hidden" id="idE" name="idEqu" required><br>
            <button class="mostrar_jugadores"> Mostrar jugadores</button>
        </form>

        <form action="eliminar_equipo.php" method="POST" name="canchas">

            <input class="idCancha" type="text" id="idEquipo" name="idEquipo" placeholder="" required><br>
            <button class="delete_equipo" onclick="return confirm('¿Estas seguro que quieres eliminar este equipo?')"> Eliminar Equipo</button>
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