<!DOCTYPE html>

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

?>

<html>
    <head>
        <title>FUTMX</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="ingresoLiga.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="icon" href="imagenes/balon.png">
        <script src="operaciones.js"></script>
    </head>
    <body>
        
        <div style="position: relative">
            
        <div class="rectangulo">
            <a href="Start.html">
            <img class="logo" src="imagenes/logo.png">  
            </a> 
            <a class="ingreso" href="interfaz_administrador.php" name="Opcion" value="1" style="color:#000000"> Atrás</a>
        </div>
           
        <div class="cuadrado_ingreso">
            
                     
            <form action="ingresarLiga.php" method="POST">
                
                
                <select name="Liga" class="li">

                    <?php
                    $consulta = "select NombreUsuario from usuario where idTipoUsuario='2'";
                    $ejecutar = mysqli_query($conexion, $consulta) or die("problems:" . mysqli_error($conexion));

                    if (!$ejecutar) {
                        echo "hubo algun error";
                    } else {
                        echo"";
                    }

                    while ($mostrar = mysqli_fetch_array($ejecutar)) {
                        ?>
                        <tr>
                            <option><?php echo $mostrar['NombreUsuario'] ?></option>
                        </tr>
                        <?php
                    }
                    ?>

                </select>

              
                
                <button type="submit"  class="entrar" name="subir">Entrar</button><br>
              
            </form>
            
        </div>
            
            
                 
        </div>
        
        

    </body>
</html>

       