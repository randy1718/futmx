<?php

$host = 'localhost';
$user = "root";
$password = '';
$database = 'futmx';
$conexion = mysqli_connect($host, $user, $password, $database) or die("problemas de conexion");

if (!$conexion) {
    echo"No se pudo conectar con el servidor";
} else {
    $base = mysqli_select_db($conexion, "futmx");
    if (!$base) {
        echo"No se encontro la base de datos";
    }
}

session_start();

$us = $_SESSION["usuario"];
$antiguaContraseña = filter_input(INPUT_POST, "pk");
$nuevaContraseña = filter_input(INPUT_POST, "nk");
$ConfirmContraseña = filter_input(INPUT_POST, "cnk");

$sql1 = "select Contraseña from usuario where NombreUsuario='$us'";
$ejecutar1 = mysqli_query($conexion, $sql1) or die("problems:" . mysqli_error($conexion));
$mostrar = mysqli_fetch_array($ejecutar1);
$contraseña = $mostrar["Contraseña"];

if ($contraseña == $antiguaContraseña) {

    if (strlen($nuevaContraseña) < 8) {
        echo'<script type="text/javascript">
        alert("¡La contraseña tener al menos 8 caracteres!");
        window.location.href="cuenta.php";
        </script>';  
    } else {

        if ($nuevaContraseña == $ConfirmContraseña) {

            if ($nuevaContraseña == $contraseña) {
                echo'<script type="text/javascript">
             alert("¡La contraseña nueva ya esta en uso!");
             window.location.href="cuenta.php";
             </script>';
            } else {

                $sql = "update usuario set Contraseña='$nuevaContraseña' where NombreUsuario='$us'";
                $ejecutar = mysqli_query($conexion, $sql) or die("problems:" . mysqli_error($conexion));

                if (!$ejecutar) {
                    echo'<script type="text/javascript">
                alert("¡Hubo algun error!");
                window.location.href="cuenta.php";
                </script>';
                } else {
                    echo'<script type="text/javascript">
                alert("¡Informacion actualizada!");
                window.location.href="cuenta.php";
                 </script>';
                }
            }
        } else {
            echo'<script type="text/javascript">
            alert("¡Las contraseñas no coinciden!");
            window.location.href="cuenta.php";
            </script>';
        }
    }
} else {
    echo'<script type="text/javascript">
    alert("¡Ella no es la antigua clave!");
    window.location.href="cuenta.php";
    </script>';
}

