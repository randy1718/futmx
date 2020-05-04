<!DOCTYPE html>
<?php
$host = 'localhost';
$user = "root";
$password = '';
$database = 'futmx';
$conexion = mysqli_connect($host, $user, $password, $database) or die("problemas de conexion");
session_start();

$usuar = $_SESSION["usuario"];

$consulta = "select NombreCompleto,NombreUsuario,Correo,foto,tipo_foto from usuario where NombreUsuario='$usuar'";

$ejecutar = mysqli_query($conexion, $consulta) or die("problems:" . mysqli_error($conexion));

if (!$ejecutar) {
    echo "hubo algun error";
} else {
    echo"";
}


while ($mostrar = mysqli_fetch_array($ejecutar)) {
    $imagen = $mostrar["foto"];
    ?>
    <html>
        <head>
            <title>FUTMX</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="interfaz.css">
            <link rel="icon" href="imagenes/balon.png">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="deslizar.js"></script>
            <script src="capa.js"></script>
            <meta http-equiv="Expires" content="0">
            <meta http-equiv="Last-Modified" content="0">
            <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
            <meta http-equiv="Pragma" content="no-cache">
        </head>
        <body class="cuenta_liga">
            <div style="position: relative">



                <div class="informacion">

                    <div class="tit">Datos personales </div>
                    <a href="cuenta_liga.php" onclick="window.open('cambiarFoto.html', 'popup', 'width=750,height=410, left=400,right=400, top=200')"> 
                        <div class="account">
                            <?php
                            echo "<img  class='account_foto' src='data:" . $mostrar["tipo_foto"] . ";base64," . base64_encode($imagen) . "'>";
                            ?>
                        </div>
                    </a>

                    <form action="actualizacion.php" method="POST">

                        <label class="label_1">Nombre Completo</label>    
                        <input  class="NombreCompleto" type="text" id="1" name="uc"  value="<?php echo $mostrar['NombreCompleto'] ?>" required><br>
                        <label class="label_2">Usuario</label>
                        <input  class="NombreUsuario" type="text" id="1" name="u"  value="<?php echo $mostrar['NombreUsuario'] ?>" required><br>
                        <label class="label_3">Correo</label>
                        <input  class="Correo" type="text" id="pass" name="c" value="<?php echo $mostrar['Correo'] ?>" required><br>



                        <button type="submit"  class="entrar" name="subir" onclick="return confirm('Confirmar para modificar los datos')">Actualizar</button><br>

                    </form>


                    <div class="update_pass">
                        <button class="btn_pass" name="subir" onclick="abrir()">Cambiar contraseña</button><br>
                    </div>
                    <div class="borrar_cuenta">
                        <button class="btn_borrar" name="subir" onclick="eliminarCuenta()">Eliminar Cuenta</button><br>
                    </div>
                </div>


                <div id="capa">

                </div>

                <div id="ca" onclick="cerrar()">

                </div>

                <script type="text/javascript">
                    function abrir() {
                        document.getElementById('cambiar_pass').style.display = "block";
                        document.getElementById('ca').classList.toggle('ca');
                    }

                    function cerrar() {
                        document.getElementById('cambiar_pass').style.display = "none";
                        document.getElementById('ca').classList.toggle('ca');
                    }
                    function eliminarCuenta() {
                        if (confirm('¿Estas seguro que quieres eliminar la cuenta?')) {


                            $.ajax({
                                type: "POST",
                                url: "eliminarCuenta.php",
                                success: function (r) {
                                    if (r === "1") {
                                        alert("¡ERROR!" + r);
                                        window.location.href = "cuenta.php";
                                    } else {
                                        alert("¡Listo! BYE :C" + r);
                                        window.location.href = "ingresar.html";
                                    }
                                }

                            });


                        }
                    }
                </script>


                <div class="cambiar_contraseña" id="cambiar_pass">
                    <form action="cambiarContraseña.php" method="POST">


                        <input  class="key_past" type="password" id="1" name="pk" placeholder="Ingrese su contraseña actual" required><br>

                        <input  class="key_new" type="password" id="1" name="nk" placeholder="Ingrese su nueva contraseña"  required><br>

                        <input  class="confirm_key" type="password" id="pass" name="cnk" placeholder="Confirme la nueva contraseña"  required><br>



                        <button type="submit"  class="password_change" name="subir" onclick="return confirm('Confirmar para modificar los datos')">Realizar Cambios</button><br>

                    </form> 
                </div>

                <div id="slidebar">
                    <a href="cuenta_liga.php" onclick="window.open('cambiarFoto.html', 'popup', 'width=750,height=410, left=400,right=400, top=200')"> 
                        <div class="foto">
                            <?php
                            echo "<img  class='fp' src='data:" . $mostrar["tipo_foto"] . ";base64," . base64_encode($imagen) . "'>";
                            ?>
                        </div>
                    </a>

                    <a href="interfaz_administrador_liga.php" class="begin" name="Opcion" value="1" >Inicio</a>
                    <a href="cuenta_liga.php" class="editar" name="Opcion" value="1" >Editar Cuenta</a> 
                    <a href="Start.html" class="salir" name="Opcion" value="1" >Salir</a>  
                </div>
                <?php
            }
            ?>  
        </div>

        <div class="rectangulo">
            <a href="interfaz_administrador_liga.php">
                <img class="logo" src="imagenes/logo.png">  
            </a>
            <div class="perfil" id="boton">
                <?php
                echo "<img  class='fotoPerfil' src='data:" . $mostrar["tipo_foto"] . ";base64," . base64_encode($imagen) . "'>";
                ?>
            </div>


        </div>

    </body>
</html>
