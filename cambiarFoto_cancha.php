<!DOCTYPE html>
<?php
        $host='localhost';
        $user="root";
        $password='';
        $database='futmx';
        $conexion= mysqli_connect($host, $user, $password, $database) or die("problemas de conexion");
        session_start();
        
         $nombre_cancha= filter_input(INPUT_POST, "nombre");
         
         echo "1".$nombre_cancha;
?>
<html>
    <head>
        <title>Cambiar foto</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body onresize="self.resizeTo(770,490);">

        <style>
            .subir{
                margin-top: 30px;
                border: 1px solid;
                padding: 5px;
                width: 300px;
                height: 300px;
                background: lightyellow;
                background-size: 100%;
                background-repeat: no-repeat;
                text-align: center;
                position: absolute;
            }

            .mostrar{
                margin-top: 30px;
                border: 1px solid;
                padding: 5px;
                width: 300px;
                height: 300px;
                left:400px;
                background: lightyellow;
                background-size: 100%;
                background-repeat: no-repeat;
                text-align: center;
                position: absolute;
            }

            .entrar{
                top:380px;
                position: absolute;
            }

            body{
                position: fixed;
                resize: none;

            }
        </style>

        <form action="subirPhoto_Cancha.php" method="POST" enctype="multipart/form-data">

            <div class="subir">  
                <input type="file"  name="fotografia" onchange="processFiles(this.files)" />
                <input class="nombreCancha" type="text" value="<?php echo $nombre_cancha ?>" name="cancha_name"><br>
            </div>

            <div id="fileOutput" class="mostrar" accept="image/*">

            </div>

            <button type="submit"  class="actualizar" name="subir">Guardar</button><br>
        </form>    
        <script>
            function processFiles(files) {
                var file = files[0];


                var reader = new FileReader();
                reader.onload = function (e) {
                    var output = document.getElementById("fileOutput");
                    output.style.backgroundImage = "url(" + e.target.result + ")";
                };
                reader.readAsDataURL(file);
            }

            
        </script>

    </body>
</html>
