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
    <script src="capa_solicitudes.js"></script>
</head>
<body class="canchass">

<div style="position: relative">

    <div class="rectangulo">
        <a href="interfaz_administrador_liga.php">
            <img class="logo" src="imagenes/logo.png">
        </a>
        <a class="ingreso" href="equipos.php" name="Opcion" value="1" style="color:#000000">
            Atrás</a>
    </div>


    <button class="act_equipo" onclick="abrir1()">
        <img class="registro" src="imagenes/registro.png">
        Actualización equipo
    </button>
    <button class="del_equipo" onclick="abrir3()">
        <img class="bote_basura" src="imagenes/bote.png">
        Eliminacion<br> equipo
    </button>
    <button class="act_jugador" onclick="abrir2()">
        <img class="identidad" src="imagenes/identidad.png">
        Actualizacion jugador
    </button>


    <br>
</div>

<div id="capa">

</div>

<div class="cuadro_actEquipo" id="ae">
    <a href="javascript:cerrar1()">
        <img class="mini_x" src="imagenes/5a5798809538462e5a82d431.png">
    </a>
    <div class="tabla_soli">
        <table border="1" align="center" bgColor="FFFFFF" class="tabla_act" id="solicitudes_Equipo">
            <thead>
            <tr>
                <td>Equipo</td>
                <td>Nuevo nombre</td>
                <td>Aceptar</td>

            </tr>
            </thead>

            <?php
            $usuar= $_SESSION["usuario"];
            $consulta="select * from solicitudesactualizacionequipo inner join equipos on equipos.idEquipo=solicitudesactualizacionequipo.idEquipo inner join liga on liga.idLiga=equipos.idLiga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
            $ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));

            if(!$ejecutar){
                echo "hubo algun error";
            }else{
                echo"";
            }

            while($mostrar= mysqli_fetch_array($ejecutar)){
            $id=$mostrar['idEquipo'];
            $nombre=$mostrar['NombreEquipo'];
            $dato=$mostrar['NombreNuevo'];
            ?>
                <tr>
                    <td><?php echo $nombre ?></td>
                    <td><?php echo $dato ?></td>
                    <td>
                        <button class="eliminar" onclick="aceptarCambio('<?php echo $id?>','<?php echo $dato?>')">

                        </button>
                    </td>


                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    </div>

    <div class="cuadro_actJugador" id="aj">
        <a href="javascript:cerrar2()">
            <img class="mini_x" src="imagenes/5a5798809538462e5a82d431.png">
        </a>
        <div class="tabla_soli">
            <table border="1" align="center" bgColor="FFFFFF" class="tabla_act2" id="solicitudes_Equipo">
                <thead>
                <tr>
                    <td>Persona</td>
                    <td>Dato a cambiar</td>
                    <td>Nuevo dato</td>
                    <td>Aceptar</td>


                </tr>
                </thead>

                <?php
                $usuar= $_SESSION["usuario"];
                $consulta="select * from solicitudesactualizacion inner join usuarios on usuarios.idUsuario=solicitudesactualizacion.idUsuario  inner join liga on liga.idLiga=solicitudesactualizacion.liga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
                $ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));

                if(!$ejecutar){
                    echo "hubo algun error";
                }else{
                    echo"";
                }

                while($mostrar= mysqli_fetch_array($ejecutar)){
                    $idSolicitud=$mostrar['idSolicitud'];
                    $id=$mostrar['idUsuario'];
                    $nombre=$mostrar['Nombre'];
                    $dato=$mostrar['nombreCampo'];
                    $datoNuevo=$mostrar['nuevoDato'];
                    ?>
                    <tr>
                        <td><?php echo $nombre ?></td>
                        <td><?php echo $dato ?></td>
                        <td><?php echo $datoNuevo ?></td>

                        <td>
                            <button class="eliminar" onclick="aceptarModificacion('<?php echo $idSolicitud?>','<?php echo $id?>','<?php echo $dato?>','<?php echo $datoNuevo?>')">

                            </button>
                        </td>


                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>

    </div>

    <div class="cuadro_delEquipo" id="de">
        <a href="javascript:cerrar3()">
            <img class="mini_x" src="imagenes/5a5798809538462e5a82d431.png">
        </a>
        <div class="tabla_soli">
            <table border="1" align="center" bgColor="FFFFFF" class="tabla_act3" id="solicitudes_Equipo">
                <thead>
                <tr>
                    <td>Equipo</td>
                    <td>Aceptar Eliminacion</td>

                </tr>
                </thead>

                <?php
                $usuar= $_SESSION["usuario"];
                $consulta="select * from solicitudeseliminacionequipo  inner join equipos on solicitudeseliminacionequipo.idEquipo=equipos.idEquipo  inner join liga on liga.idLiga=equipos.idLiga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
                $ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));

                if(!$ejecutar){
                    echo "hubo algun error";
                }else{
                    echo"";
                }

                while($mostrar= mysqli_fetch_array($ejecutar)){

                    $id=$mostrar['idEquipo'];
                    $nombre=$mostrar['NombreEquipo'];
                    ?>
                    <tr>
                        <td><?php echo $nombre ?></td>
                        <td>
                            <button class="eliminar" onclick="aceptarEliminacion('<?php echo $id?>')">

                            </button>
                        </td>


                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>


</body>

<script type="text/javascript">

    function abrir1() {
        document.getElementById('ae').style.display = "block";
        document.getElementById('capa').classList.toggle('capa');
    }

    function abrir2() {
        document.getElementById('aj').style.display = "block";
        document.getElementById('capa').classList.toggle('capa');
    }

    function abrir3() {
        document.getElementById('de').style.display = "block";
        document.getElementById('capa').classList.toggle('capa');
    }

    function cerrar1() {
        document.getElementById('ae').style.display = "none";
        document.getElementById('capa').classList.toggle('capa');
    }

    function cerrar2() {
        document.getElementById('aj').style.display = "none";
        document.getElementById('capa').classList.toggle('capa');
    }

    function cerrar3() {
        document.getElementById('de').style.display = "none";
        document.getElementById('capa').classList.toggle('capa');
    }

    function aceptarCambio(id, dato) {
        if(confirm('¿Estas seguro que quieres modificar este equipo?')){
            cadena={
                "id":id,
                "nombreNuevo":dato,
            };

            $.ajax({
                type:"POST",
                url:"cambiarNombreEquipo.php",
                data:cadena,
                success:function(r){
                    if(r==1){
                        alert("¡Hubo un error!");
                        window.location.href="solicitudes_info_equipo.php";
                    }else{
                        alert("¡Se modifico correctamente!");
                        window.location.href="solicitudes_info_equipo.php";
                    }
                }

            });
        }
    }

    function aceptarEliminacion(id) {
        if(confirm('¿Estás seguro que quieres eliminar este equipo?')){
            cadena={
                "id":id,
            };

            $.ajax({
                type:"POST",
                url:"EliminarEquipo.php",
                data:cadena,
                success:function(r){
                    if(r==1){
                        alert("¡Hubo un error!");
                        window.location.href="solicitudes_info_equipo.php";
                    }else{
                        alert("¡Se elimino correctamente!");
                        window.location.href="solicitudes_info_equipo.php";
                    }
                }

            });
        }
    }

    function aceptarModificacion(idSolicitud,id,dato,nuevoDato) {
        if(confirm('¿Estás seguro que quieres cambiar este dato?')){
            cadena={
                "idSolicitud":idSolicitud,
                "id":id,
                "dato":dato,
                "nuevo":nuevoDato
            };

            $.ajax({
                type:"POST",
                url:"modificarInformacion.php",
                data:cadena,
                success:function(r){
                    if(r==1){
                        alert("¡Hubo un error!");
                        window.location.href="solicitudes_info_equipo.php";
                    }else{
                        alert("¡Se modifico correctamente!");
                        window.location.href="solicitudes_info_equipo.php";
                    }
                }

            });
        }
    }

</script>


</html>