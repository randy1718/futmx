
<?php
$host='localhost';
$user="root";
$password='';
$database='id13484941_futmx1';
$conexion= mysqli_connect($host, $user, $password, $database) or die("problemas de conexion");
session_start();

$usuar= $_SESSION["usuario"];
$consulta="select foto,tipo_foto, nombreSubliga from subliga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
$numero="select * from solicitudesadminequipo inner join liga on Liga=idLiga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
$ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));
$ejecutar1= mysqli_query($conexion,$numero) or die ("problems:". mysqli_error($conexion));
if(!$ejecutar ){
    echo "ocurrio un error";
}else{

}
$numero_solicitudes= mysqli_num_rows($ejecutar1);
while($mostrar= mysqli_fetch_array($ejecutar)){
$nombreLiga=$mostrar["nombreSubliga"];

$imagen=$mostrar["foto"];

$im=base64_decode($imagen);

?>
<!DOCTYPE html>
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

<div class="rectangulo">
    <a href="interfaz_administrador_liga.php">
        <img class="logo" src="imagenes/logo.png">
    </a>
    <a class="ingreso" href="subligas.php" name="Opcion" value="1" style="color:#000000"> Atrás</a>

</div>


<div class="ad_subliga">
    <div class="saludo_subliga">Bienvenido de nuevo, <?php echo $_SESSION['nombreLiga']?> !</div>

</div>

<div class="opciones_1">
    <a href="canchas_subliga.php" name="Opcion" value="1" style="color:#000000" title="Canchas" onmouseover="window.status='Canchas';return true" onmouseout="window.status='';return true" >
        <div class="canchas">

            <div class="im_cac">
                <img class="im_c" src="imagenes/Football_2-36_icon-icons.com_72119.png" >
            </div>
            <div class="txt2">Canchas</div>

        </div>
    </a>

    <a href="solicitudes_subliga.php" name="Opcion" value="1" style="color:#000000">
        <div class="solicitudes">

            <div class="im_sas">
                <img class="im_s" src="imagenes/1486164749-120_79719.png">
            </div>
            <div class="txt2">Solicitudes</div>

            <?php if($numero_solicitudes>0){?>
                <span class="numero" id="number"><div class="num"><?php echo"".$numero_solicitudes?></div></span>
            <?php }?>


        </div>
    </a>

</div>



<div class="opciones">




    <a href="posiciones_subliga.php" name="Opcion" value="1" style="color:#000000">
        <div class="tabla_posiciones">

            <div class="im_pap">
                <img class="im_p" src="imagenes/Football_2-20_icon-icons.com_72099.png">
            </div>
            <div class="txt2">Posiciones</div>

        </div>
    </a>

    <a href="partidos_subliga.php" name="Opcion" value="1" style="color:#000000">
        <div class="partidos">
            <div class="ima_dad">
                <img class="ima" src="imagenes/Football_2-30_icon-icons.com_72093.png">
            </div>
            <div class="txt2">Partidos</div>

        </div>
    </a>

    <a href="equipos_subliga.php" name="Opcion" value="1" style="color:#000000">
        <div class="equipos">

            <div class="im_ede">
                <img class="im_e" src="imagenes/Football_2-62_icon-icons.com_72096.png">
            </div>
            <div class="txt2">Equipos</div>

        </div>
    </a>

</div>





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
    <a href="pago_arbitraje.php" class="pagos" name="Opcion" value="1" >Pagos</a>
    <a href="Start.html" class="salir" name="Opcion" value="1" >Salir</a>
</div>

<?php
}
?>

</div>


</body>
</html>
