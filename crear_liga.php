<!DOCTYPE html>
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
            
            <div class="titulo_form">
                <div class="cr">
                Creacion liga
                </div>
            </div>
            
            
            <div class="create_liga">
                <form action="crearLiga.php" method="POST" name="canchas" enctype="multipart/form-data">
                    <div class="entradas">
                <input type="text" class="z" placeholder="Nombre Liga" name="ligaName" required><br>
               <input type="password" class="z" placeholder="Contraseña Administrador" name="pass_admin" required><br>
                <input type="email" class="z" placeholder="Correo administrador" name="email_admin" required><br>
                <select type="text" class="z" name="tipo_documento" required>
                     <option class="doc" value="">- Tipo de documento -</option>
                     <?php
                    $consulta = "select id_tipo_documento, tipo_documento from tipo_documento";
                    $ejecutar = mysqli_query($conexion, $consulta) or die("problems:" . mysqli_error($conexion));

                    if (!$ejecutar) {
                        echo "hubo algun error";
                    } else {
                        echo"";
                    }

                    while ($mostrar = mysqli_fetch_array($ejecutar)) {
                        ?>
                        <tr>
                        <option class="doc" value="<?php echo $mostrar['id_tipo_documento']?>"><?php echo $mostrar['tipo_documento']?></option>
                        </tr>
                        <?php
                    }
                    ?>
                </select><br>
                <label class="lab">Fecha de Inicio:</label>
                <input type="date" class="z"  placeholder="fecha de inicio" name="fechaInicio" required><br>              
                 </div>
                    <div class="entradas_2">
                <input type="text" class="z" placeholder="Nombre del Administrador" name="admin_liga" required><br>
                <input type="password" class="z" placeholder="Confirmar contraseña" name="confirm_admin" required><br>
                <input type="number" class="z" placeholder="Precio arbitraje" name="price_arbitraje" required><br>
                <input type="text" class="z" placeholder="Documento de identidad" name="id_doc" required><br>
                <label class="lab">Fecha de Culminacion:</label>
                <input type="date" class="z" placeholder="fecha de fin" name="fechaFin" required><br>
                
                    </div>
                <button class="m">Crear Liga</button>
                </form>
                
            </div>
            <script type="text/javascript">
                
               function EnviarDatos(){
                   var nombreLiga=document.getElementsByName("ligaName").value;
                   var nombreAdministrador=document.getElementsByName("admin_liga").value;
                   var correoAdministrador=document.getElementsByName("email_admin").value;
                   var contraseña=document.getElementsByName("pass_admin").value;
                   var confirmContraseña=document.getElementsByName("confirm_admin").value;
                   var tipoDocumento=document.getElementsByName("tipo_documento").value;
                   var documento=document.getElementsByName("id_doc").value;
                   var precioArbitraje=document.getElementsByName("price_arbitraje").value;
                   var fechaInicio=document.getElementsByName("fechaInicio").value;
                   var fechaFin=document.getElementsByName("fechaFin").value;
                   cadena={
                       "ligaName":nombreLiga,
                       "admin_liga":nombreAdministrador,
                       "email_admin":correoAdministrador,
                       "pass_admin":contraseña,
                       "confirm_admin":confirmContraseña,
                       "tipo_documento":tipoDocumento,
                       "id_doc":documento,
                       "price_arbitraje":precioArbitraje,
                       "fechaInicio":fechaInicio,
                       "fechaFin":fechaFin
                   };
                   
                    $.ajax({
                     type:"POST",
                     url:"crearLiga.php",
                     data:cadena,
                     success:function(r){
                     if(r==="1"){
                       alert("¡Hubo un error!"+r);
                       window.location.href="crear_liga.php";
                     }else{
                      alert("¡Liga creada exitosamente!"+r);
                      window.location.href="crear_liga.php";
                       }
                      }
                   });
               }
            </script>
            

        </div>
    </body>
</html>

       
            