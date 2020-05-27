<!DOCTYPE html>
<?php
$host='localhost';
$user="root";
$password='';
$database='id13484941_futmx1';
$conexion= mysqli_connect($host, $user, $password, $database) or die("problemas de conexion");
session_start();

$usuar= $_SESSION["usuario"];
$consulta="select foto,tipo_foto, nombreSubliga from subliga inner join usuario on administrador=idUsuario where NombreUsuario='$usuar'";
$ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));

if(!$ejecutar ){
    echo "ocurrio un error";
}else{

}

while($mostrar= mysqli_fetch_array($ejecutar)){
$imagen=$mostrar["foto"];
$nombreLiga=$mostrar["nombreSubliga"];

$im=base64_decode($imagen);

?>
<html>
<head>
    <title>FUTMX</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="inter_liga.css">
    <link rel="icon" href="imagenes/balon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="deslizar.js"></script>
    <script src="capa.js"></script>
</head>
<body class="admin_liga">
<div style="position: relative">
    <div class="ad_liga">
        <div class="saludo">Bienvenido a <?php echo $_SESSION["nombreLiga"] ?> !</div>

    </div>

    <div class="rectangulo">
        <a href="interfaz_administrador_liga.php">
            <img class="logo" src="imagenes/logo.png">
        </a>
        <a class="ingreso" href="subligas.php" name="Opcion" value="1" style="color:#000000"> Atrás</a>

    </div>


    <div class="opciones">
    </div>

    <a href="canchas.php" name="Opcion" value="1" style="color:#000000" title="Canchas" onmouseover="window.status='Canchas';return true" onmouseout="window.status='';return true" >
        <div class="canchas">

            <img class="im" src="imagenes/canchas.jpg" >
            <p class="txt2">Canchas</p>

        </div>
    </a>

    <a href="tabla_posiciones.php" name="Opcion" value="1" style="color:#000000">
        <div class="tabla_posiciones">

            <img class="im" src="imagenes/01.jpg">
            <p class="txt3">Posiciones</p>

        </div>
    </a>

    <a href="partidos.php" name="Opcion" value="1" style="color:#000000">
        <div class="partidos">
            <div class="ima_dad">
                <img class="ima" src="imagenes/img_410939.png">
            </div>
            <p class="txt4">Partidos</p>

        </div>
    </a>

    <a href="equipos.php" name="Opcion" value="1" style="color:#000000">
        <div class="equipos">

            <img class="im" src="imagenes/g.jpg">
            <p class="txt5">Equipos</p>

        </div>
    </a>

    <a href="solicitudes_equipos.php" name="Opcion" value="1" style="color:#000000">
        <div class="solicitudes">

            <img class="im" src="imagenes/Grupo 10.png">
            <p class="txt6">Solicitudes</p>

        </div>
    </a>





    <div id="capa">

    </div>
    <div id="slidebar">
        <a href="interfaz_administrador_liga.php" onclick="window.open('Cambiar_foto_liga.html','popup','width=750,height=410, left=400,right=400, top=200')">
            <div class="foto">
                <?php
                echo "<img  class='fp' src='data:".$mostrar["tipo_foto"].";base64,".base64_encode($imagen)."'>";
                ?>
            </div>
        </a>

        <a href="interfaz_administrador_liga.php" class="begin" name="Opcion" value="1" >Inicio</a>
        <a href="cuenta_liga.php" class="editar" name="Opcion" value="1" >Cuenta</a>
        <a href="subligas.php" class="subliga" name="Opcion" value="1" >Subligas</a>
        <a href="Start.html" class="salir" name="Opcion" value="1" >Salir</a>
    </div>

    <?php
    }
    ?>

</div>


</body>
</html>
