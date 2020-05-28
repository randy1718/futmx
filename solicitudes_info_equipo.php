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

</div>

<div class="cuadro_actJugador" id="aj">

</div>

<div class="cuadro_detEquipo" id="de">

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
        document.getElementById('cap').classList.toggle('cap');
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
    
</script>


</html>