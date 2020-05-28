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
    <script src="capa_canchas.js"></script>
</head>
<body class="canchass">

<div style="position: relative">

    <div class="rectangulo">
        <a href="interfaz_administrador_liga.php">
            <img class="logo" src="imagenes/logo.png">
        </a>
        <a class="ingreso" href="interfaz_administrador_liga.php" name="Opcion" value="1" style="color:#000000">
            Atrás</a>
        <a class="gen_partidos" href="partidos.php" name="Opcion" value="1" style="color:#000000">
            Generar partidos</a>
    </div>

    <div class="contenedor_partidos">

        <?php
        $usuar = $_SESSION["usuario"];
        $query_equipos = "select count(*) as numeroEquipos from equipos inner join liga on liga.idLiga=equipos.idLiga inner join
        usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
        $query_partidos = "select count(*) as partidos from partido inner join liga on partido.Liga=liga.idLiga inner join
        usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
        $ejecutar = mysqli_query($conexion, $query_equipos) or die("problems:" . mysqli_error($conexion));
        $execute = mysqli_query($conexion, $query_partidos) or die("problems:" . mysqli_error($conexion));
        $mostrar = mysqli_fetch_array($ejecutar);
        $numPartidos = mysqli_fetch_array($execute);
        $numeroEquipos = $mostrar['numeroEquipos'];
        $numeroPartidos = $numPartidos['partidos'];

        if (!$ejecutar) {
            echo "hubo algun error";
        } else {
            echo "" . $numeroPartidos;
        }

        if ($numeroEquipos >= 10 && $numeroEquipos%2==0) {
            if($numeroPartidos==0){
            ?>

            <div>¡Hay suficientes equipos!</div><br>
            <div>Oprima en generar partidos</div>

            <?php
            }
        } else {
            ?>


            <div class="a">¡No hay suficientes equipos!</div><br>
            <div class="eq">Hay <?php echo $numeroEquipos ?> equipos registrados</div>
            <div class="i"><img class="img_jugadores" src="imagenes/Football_2-61_icon-icons.com_72117.png"> </div>
            <div class="min">Deben haber mínimo 10 equipos inscritos</div>

            <?php
        }

        ?>

    </div>

    <br>
</div>
</body>


</html>