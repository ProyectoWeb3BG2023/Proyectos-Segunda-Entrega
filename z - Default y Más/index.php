<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <center>
        <h1>Registro de productos</h1>
        <form action="registrar.php" method="post" enctype="multipart/form-data">
            <p><input type="text" name="nombre" required placeholder="Ingresa nombre del producto"></p>
            <p><input type="file" name="imagen" required placeholder="Ingresa imagen"></p>
            <input type="submit" value="Registrar" name="registrar">
        </form>
    </center>
    <br>
    <center>
        <a href="mostrar.php"><button>Listar Productos</button></a>
    </center>

</body>
</html>