<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body>
    <center>
        <h1>Formulario</h1>
        <form action="2registrarweb.php" method="post" enctype="multipart/form-data">

            <p>
               
                <input type="text" id="n1" name="primernombre" required placeholder="Primer nombre">

                <input type="text" name="segundonombre" placeholder="Segundo nombre">
            </p>

            <p>
                <input type="text" name="primerapellido" required placeholder="Primer Apellido">

                <input type="text" name="segundoapellido" placeholder="Segundo apellido">
            </p>

            <p>
                <input type="text" name="documento" required placeholder="Documento">

               <!-- <input type="number" name="telefono" required placeholder="Teléfono">-->
            </p>

            <p>
                <input type="email" name="mail" required placeholder="Mail"></p>

            <p>
                <input type="text" name="calle" required placeholder="Calle">

                <input type="number" name="puerta" required placeholder="Número de Puerta">

                <input type="text" name="esquina" required placeholder="Esquina">
            </p>

            <!-- <p>
                <input type="password" name="contrasena" required value="************">
            </p> -->

            <input type="submit" value="Registrar" name="registrar">
        </form>
    </center>
    <br>
    <center>
        <a href="2mostrar.php"><button>Listar Productos</button></a>
    </center>

</body>

</html>