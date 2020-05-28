<html DOCTYPE!>
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
<head>
    <title>FUTMX</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="inter_posiciones.css">
    <script src="librerias/jquery.js"></script>
    <link rel="icon" href="imagenes/balon.png">
    <script src="tabla.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.js"></script>
    <script src="librerias/alertifyjs/alertify.js"></script>
    <script src="capa_canchas.js"></script>
</head>

<body class="posiciones">

<div class="rectangulo">
    <a href="interfaz_administrador_liga.php">
        <img class="logo" src="imagenes/logo.png">
    </a>
    <a class="ingreso" href="interfaz_administrador_liga.php" name="Opcion" value="1" style="color:#000000"> Atrás</a>
</div>


<div class="d1">
    <div class="contenedor_posiciones">
        <br>
        <table class="table_posiciones">
            <thead>
            <tr>
                <th>Posición</th>

                <th>Equipo</th>
                <th>PJ</th>
                <th>PG</th>
                <th>PE</th>
                <th>PP</th>

                <th>GF</th>
                <th>GC</th>
                <th>DG</th>
                <th>Puntos</th>


            </tr>
            </thead>

            <?php
            $contador = 1;

            $total = 0;

            $usuar = $_SESSION["usuario"];
            $consultaconv = "select (equipos.dirFoto) ,(equipos.NombreEquipo), Puntos,GolesFavor,GolesContra,DiferenciaGoles,Ganados,Empatados,Perdidos,Jugados
                from posiciones inner join equipos on posiciones.Equipo=equipos.idEquipo inner join liga on liga.idLiga=posiciones.Liga inner join usuario on Administrador=documento_identidad
                where NombreUsuario='$usuar' order by Puntos desc, GolesFavor desc, GolesContra asc";
            $ejecutar = mysqli_query($conexion, $consultaconv) or die("problems:" . mysqli_error($conexion));

            $clasifica = "class='td2'";

            while ($rows = mysqli_fetch_array($ejecutar)) {

                if ($contador <= 8) {
                    //Condición mejores 8
                    echo "<tr class='tr1' >";

                } else {
                    echo "<tr class='tr2'>";
                }

                echo "<td " . $clasifica . " >" . $contador . "</td><td class='td1'>";
                echo "<img class='imagenEquipo' src='imagenes/" . $rows[0] . "'> &nbsp&nbsp " . $rows[1] . "</td><td " . $clasifica . ">";

                echo $rows[9] . "</td><td " . $clasifica . ">"; //Jugados
                echo $rows[6] . "</td><td " . $clasifica . ">"; //Ganados
                echo $rows[7] . "</td><td " . $clasifica . ">"; //Empatados
                echo $rows[8] . "</td><td " . $clasifica . ">"; //Perdidos
                echo $rows[3] . "</td><td " . $clasifica . ">"; //Favor
                echo $rows[4] . "</td><td " . $clasifica . ">"; //Contra
                echo $rows[5] . "</td><td " . $clasifica . ">"; //Diferencia


                echo $rows[2]; //Jugados

                $contador = $contador + 1;


            }


            ?>
        </table>
    </div>
</div>

</body>
</html>
