<!DOCTYPE html>

<html>
<head>
    <title>FUTMX</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="design.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="icon" href="imagenes/balon.png">
    <script src="operaciones.js"></script>
    <script src="capa_ingreso.js"></script>
</head>
<body>

<div style="position: relative">

    <div class="rectangulo">
        <a href="Start.html">
            <img class="logo" src="imagenes/logo.png">
        </a>
        <a class="ingreso" href="Start.html" name="Opcion" value="1" style="color:#000000"> Atrás</a>
    </div>

    <div class="cuadrado_ingreso">

        <div class="rojo"></div>
        <div class="verde"></div>
        <div class="blanco"></div>

        <img  class="escudo" src="imagenes/escudo.png">

        <div class="bienvenido">
            Bienvenido
        </div>

        <form action="ingresar.php" method="POST">

            <input  class="usuario" type="text" id="1" name="u" placeholder="Usuario"required><br>

            <input  class="password" type="password" id="pass" name="c" placeholder="Contraseña"required><br>
            <img class="candado" src="imagenes/candado.png" id="show">

            <buttom  class="recuperar" onclick="abrir()" name="Opcion" value="1" style="color:#000000"> Olvidé mi contraseña</buttom>

            <button type="submit"  class="entrar" name="subir">Entrar</button><br>

        </form>

    </div>

    <div id="cap">
    </div>

    <div  class="enviarCorreo "id="enviarCorreo">
        <form action="ingreso.php" method="POST">
            <?php $randomnumber = rand(1000, 9999); ?>
            <label class="label_contraseña">Te enviaremos un correo con un link para cambiar la contraseña</label>
            <input  class="correoInput" type="text" id="1" name="email" placeholder="Ingresa un email"required><br>
            <input name="active" id="active" type="hidden" value="false">
            <?php echo "<input name='code' id='code' value='".$randomnumber."' type='hidden'  required>"; ?>
            <button type="submit"  class="enviarCodigo" name="subir">Enviar</button><br>
        </form>

        <?php

        $email=filter_input(INPUT_POST, "email");
        $code=filter_input(INPUT_POST, "code");

        $joining_date = date('Y-m-d H:i:s');
        $fecha=$joining_date;

        $to= $email;
        $subject = "Correo de Confirmacion";
        $message = 'Hola '."\r\n"." Sigue este vinculo para activar tu cuenta"."\r\n\r\n"." http://tupagina.com/confirm.php?"."&code=".$code."\r\n";
        $headers = 'From:rrandymiller@gmail.com';

        ?>

    </div>

    <script>

        function abrir() {
            document.getElementById('cap').classList.toggle('cap');
            document.getElementById('enviarCorreo').style.display = "block";

        }

    </script>



</div>



</body>
</html>



































