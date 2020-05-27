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
    <link rel="stylesheet" type="text/css" href="interface_administrador_liga_options.css">
    <script src="librerias/jquery.js"></script>
    <link rel="icon" href="imagenes/balon.png">
    <script src="tabla.js"></script>

</head>
<body class="canchass">

<div style="position: relative">

    <div class="rectangulo_sol">
        <a href="interfaz_subliga.php">
            <img class="logo" src="imagenes/logo.png">
        </a>
        <a class="ingreso" href="interfaz_subliga.php" name="Opcion" value="1" style="color:#000000"> Atrás</a>
    </div>

    <div class="contenedor">
        <div class="tabla">
            <table border="1" align="center" bgColor="FFFFFF" class="sol_equipo" id="solicitudes_Equipo">
                <thead>
                <tr>
                    <td>Documento identidad</td>
                    <td>Nombre del solicitante</td>
                    <td>Correo</td>
                    <td>Nombre del equipo</td>
                    <td> Contraseña </td>
                    <td>Aceptar</td>
                    <td>Eliminar</td>
                </tr>
                </thead>

                <?php
                $usuar= $_SESSION["usuario"];
                $consulta="select * from solicitudesadminequipo inner join liga on Liga=idLiga inner join usuario on Administrador=documento_identidad where NombreUsuario='$usuar'";
                $ejecutar= mysqli_query($conexion,$consulta) or die ("problems:". mysqli_error($conexion));

                if(!$ejecutar){
                    echo "hubo algun error";
                }else{
                    echo"";
                }

                while($mostrar= mysqli_fetch_array($ejecutar)){
                    $id=$mostrar['Cedula_Usuario'];
                    $nombre=$mostrar['Nombre_Usuario'];
                    $correo=$mostrar['Correo'];
                    $nombreEquipo=$mostrar['Nombre_Equipo'];
                    $pass=$mostrar['Contraseña'];
                    ?>
                    <tr>
                        <td><?php echo $id ?></td>
                        <td><?php echo $nombre ?></td>
                        <td><?php echo $correo ?></td>
                        <td><?php echo $nombreEquipo?></td>
                        <td><?php echo $pass ?></td>
                        <td><button class="agregarEquipo" onclick="agregar('<?php echo $id ?>','<?php echo $nombre ?>','<?php echo $correo ?>','<?php echo $nombreEquipo ?>','<?php echo $pass ?>')">

                            </button></td>
                        <td>
                            <button class="eliminar" onclick="eliminar(<?php echo $mostrar['Cedula_Usuario'] ?>)">

                            </button>
                        </td>


                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>



    <script type="text/javascript">


        function agregar(id, nombre, correo, nombreEquipo, contraseña){
            if(confirm('¿Estas seguro que quieres crear este equipo ?')){
                cadena={
                    "id":id,
                    "nombre":nombre,
                    "correo":correo,
                    "nombreEquipo":nombreEquipo,
                    "contraseña":contraseña
                };

                $.ajax({
                    type:"POST",
                    url:"agregar_equipo.php",
                    data:cadena,
                    success:function(r){
                        if(r==="1"){
                            alert("¡Hubo un error!"+r);
                            window.location.href="solicitudes_subliga.php";
                        }else{
                            alert("¡Se agrego el equipo correctamente!"+r);
                            window.location.href="solicitudes_subliga.php";
                        }
                    }

                });
            }
        }

        function eliminar(id){
            if(confirm('¿Estas seguro que quieres eliminar esta solicitud?')){
                cadena="id="+id;

                $.ajax({
                    type:"POST",
                    url:"eliminarSolicitud_equipo.php",
                    data:cadena,
                    success:function(r){
                        if(r==="1"){
                            alert("¡No se borro correctamente!"+r);
                            window.location.href="solicitudes_subliga.php";
                        }else{
                            alert("¡Se borro correctamente!"+r);
                            window.location.href="solicitudes_subliga.php";
                        }
                    }

                });
            }
        }
    </script>

    <br>
</div>
</body>



</html>