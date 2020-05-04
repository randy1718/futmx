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
        <link rel="stylesheet" type="text/css" href="ligas.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="icon" href="imagenes/balon.png">
        <script src="operaciones.js"></script>
    </head>
    <body id="ligas">
        
        <div style="position: relative">
            
        <div class="rectangulo">
            <a href="interfaz_administrador.php">
            <img class="logo" src="imagenes/logo.png">  
            </a> 
            <a class="ingreso" href="interfaz_administrador.php" name="Opcion" value="1" style="color:#000000"> Atrás</a>
        </div>
           
        <div class="cuadrado_ingreso">
            
            <div class="league">
                Ligas
            </div>
            
                     
            <form action="ingresarLiga.php" method="POST" name="ligas">
                
                <select name="Liga" class="li">
                       <option class="li" value="a">- Seleccione una liga -</option>
                    <?php
                    $consulta = "select NombreUsuario, Nombre from usuario inner join liga on administrador=documento_identidad where idTipoUsuario='2'";
                    $ejecutar = mysqli_query($conexion, $consulta) or die("problems:" . mysqli_error($conexion));

                    if (!$ejecutar) {
                        echo "hubo algun error";
                    } else {
                        echo"";
                    }

                    while ($mostrar = mysqli_fetch_array($ejecutar)) {
                        ?>
                        <tr>
                            <option class="li" value="<?php echo $mostrar['NombreUsuario'] ?>"><?php echo $mostrar['NombreUsuario'] ?>-<?php echo $mostrar['Nombre'] ?></option>
                        </tr>
                        <?php
                    }
                    ?>

                </select>

              
                
                <input type="submit"  class="entrar" name="Entrar" value="Entrar" /><br>
                <input type="submit"  class="bo" onclick="return confirm('¿Estas seguro que quieres eliminar esta Liga?') " name="Eliminar" value="Eliminar"/><br>
                
               <script type="text/javascript">
        function preguntar(){
            var con=confirm('¿Estas seguro que quieres eliminar esta Liga?');
            if(con!==true){
                return false;
            }else{
               return true;
            }
            
        }    
        </script>
            </form>
            
                 
            
        </div>
            
            
                 
        </div>
        
       
        
        

    </body>
</html>

       