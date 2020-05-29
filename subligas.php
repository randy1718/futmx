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
    <link rel="stylesheet" type="text/css" href="inter_liga.css">
    <script src="librerias/jquery.js"></script>
    <link rel="icon" href="imagenes/balon.png">
    <script src="tabla.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.js"></script>
    <script src="librerias/alertifyjs/alertify.js"></script>
    <script src="capa_subliga.js"></script>
</head>
<body class="canchass">

<div style="position: relative">

    <div class="rectangulo">
        <a href="interfaz_administrador_liga.php">
            <img class="logo" src="imagenes/logo.png">
        </a>
        <a class="ingreso" href="interfaz_administrador_liga.php" name="Opcion" value="1" style="color:#000000">
            Atrás</a>
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
            echo "";
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
        <button class="crear_cancha" onclick="abrirCreacion()">
            <img class="mas" src="imagenes/mas.png">
        </button>
    </div>
</div>

<div id="cap">
</div>

<div id="crearSubliga" class="form_subliga">
    <a href="javascript:cerrarForm()">
        <img src="imagenes/5a5798809538462e5a82d431.png" class="x">
    </a>

    <form action="crearSubliga.php" method="POST">

        <input class="NameSubliga" type="text" id="nombreCancha" name="NombreCancha" placeholder="Nombre subliga" required><br>
        <div class="lbel_f1">Fecha de inicio</div>
        <input class="FechaInicio" type="date" id="capacidad" name="CapacidadCancha" placeholder="Fecha de inicio" required><br>
        <div class="lbel_f2">Fecha de fin</div>
        <input class="FechaFin" type="date"  <input classid="ubicacion" name="UbicacionCancha" placeholder="Fecha de fin" required><br>

        <div class="opciones_dias">
            <div class="dias_semana">Escoge los dias de la semana:</div>
            <br><input type="checkbox" class="cb"><div class="dias">Lunes</div>
            <br><input type="checkbox" class="cb"><div class="dias">Martes</div>
            <br><input type="checkbox" class="cb"><div class="dias">Miercoles</div>
            <br><input type="checkbox" class="cb"><div class="dias">Jueves</div>
            <br><input type="checkbox" class="cb"><div class="dias">Viernes</div>
            <br><input type="checkbox" class="cb"><div class="dias">Sabado</div>
            <br><input type="checkbox" class="cb"><div class="dias">Domingo</div>
        </div>

        <div class="horario">
            <div class="lbel_h1">Hora de inicio</div>
            <input type="time" class="inicio">
            <div class="lbel_h2">Hora de fin</div>
            <input type="time" class="fin">
        </div>

        <button class="agregarSubliga" >Crear subliga</button>



    </form>
</div>



</body>

<script type="text/javascript">


    function abrir(nombre) {

        cadena = "nombre=" + nombre;

        $.ajax({
            type: "POST",
            url: "entrarSubliga.php",
            data: cadena,
            success: function (r) {
                if (r === "1") {

                    window.location.href = "interfaz_subliga.php";

                } else {

                    window.location.href = "interfaz_subliga.php";

                }
            }
        });
    }

    function abrirCreacion() {
        document.getElementById('crearSubliga').style.display = "block";
        document.getElementById('cap').classList.toggle('cap');
    }

    function cerrarForm() {
        document.getElementById('crearSubliga').style.display = "none";
        document.getElementById('cap').classList.toggle('cap');
    }
</script>


</html>