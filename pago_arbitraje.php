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
    </div>

    <br>

    <div class="cuadro_pagos">
        <div class="contenedor_pagos">

            <?php
            $usuar = $_SESSION["usuario"];
            $sqlFecha = "select curdate() as fecha";
            $sql = "select * from partido  inner join equipos on idEquipoA=idEquipo inner join  liga on Liga=liga.idLiga inner join usuario 
               on Administrador=documento_identidad where NombreUsuario='$usuar  '";
            $sql2 = "select * from partido  inner join equipos on idEquipoB=idEquipo inner join  liga on Liga=liga.idLiga inner join usuario 
               on Administrador=documento_identidad where NombreUsuario='$usuar  '";
            $ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));
            $ejecutar2 = mysqli_query($conexion, $sql2) or die("problems:" . mysqli_error($conexion));
            $ejecutar3 = mysqli_query($conexion, $sqlFecha) or die("problems:" . mysqli_error($conexion));

            $show = mysqli_fetch_array($ejecutar3);

            $fechaActual = $show['fecha'];

            if (!$ejecutar) {
                echo "hubo algun error";
            } else {

            }

            while ($mostrar = mysqli_fetch_array($ejecutar)) {


                $IDA = $mostrar['idEquipoA'];
                $IDB = $mostrar['idEquipoB'];
                $pagoA = $mostrar['PagoA'];
                $pagoB = $mostrar['PagoB'];

                $EA = "select * from equipos where idEquipo='$IDA'";
                $ejecutarA = mysqli_query($conexion, $EA) or die("problems:" . mysqli_error($conexion));
                $showEquipoA = mysqli_fetch_array($ejecutarA);
                $EQUIPOA = $showEquipoA['NombreEquipo'];

                $EB = "select * from equipos where idEquipo='$IDB'";
                $ejecutarB = mysqli_query($conexion, $EB) or die("problems:" . mysqli_error($conexion));
                $showEquipoB = mysqli_fetch_array($ejecutarB);
                $EQUIPOB = $showEquipoB['NombreEquipo'];

                $fecha = $mostrar['Fecha'];

                if ($fecha == $fechaActual) {
                    if ($pagoA == 0 && $pagoB == 0) {
                        ?>
                        <div class="ambosPierden"><?php echo $EQUIPOA . "y" . $EQUIPOB ?> pierden por default por no pagar</div>
                        <?php

                    } else if ($pagoA == 0) {
                        ?>
                        <div class="pierdeA"><?php echo $EQUIPOB ?> pierde por default por no pagar</div>
                        <?php
                    } else if ($pagoB == 0) {
                        ?>
                        <div class="pierdeB"><?php echo $EQUIPOB ?> pierde por default por no pagar</div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="diaPartido"><?php echo"El partido del dia:"?><br><?php echo $fecha?></div>
                    <?php

                    if ($pagoA == 0) {
                        ?>
                        <div class="nopagoA"><?php echo $EQUIPOA ?> aun no ha pagado</div>
                        <?php
                    } else if ($pagoA == 1) {
                        ?>
                        <div class="pagoA"><?php echo $EQUIPOA ?> ya pagó</div>
                        <?php
                    }

                    if ($pagoB == 0) {
                        ?>
                        <div class="nopagoB"><?php echo $EQUIPOB ?> aun no ha pagado</div><br><br>
                        <?php
                    } else if ($pagoB == 1) {
                        ?>
                        <div class="pagoB"><?php echo $EQUIPOB ?> ya pagó</div><br><br>
                        <?php
                    }

                }
            }


            ?>


        </div>
    </div>

</div>
</body>


</html>