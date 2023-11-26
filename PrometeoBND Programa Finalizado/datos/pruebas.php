<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    $consulta = "SELECT integra.id_tipo_menu FROM `integra` GROUP BY `integra`.`id_tipo_menu` ASC";
    $resultado = mysqli_query($con, $consulta);

    foreach ($resultado as $row) {
        $nombrePrecio = "SELECT tipo_menu.nombre, tipo_menu.precio 
                         FROM tipo_menu 
                         WHERE id_tipo_menu = " . $row['id_tipo_menu'] . " ";

        $resultadoNombrePrecio = mysqli_query($con, $nombrePrecio);

        while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
            $nombre = $fila['nombre'];
            $precio = $fila['precio'];
            echo "Nombre: $nombre, Precio: $precio<br>";
        }
        
        $consult = "SELECT comida.nombre
                    FROM comida 
                    WHERE comida.id_comida 
                    IN (SELECT id_comida 
                        FROM integra
                        WHERE id_tipo_menu = " . $row['id_tipo_menu'] . ")";
        
        $result = mysqli_query($con, $consult);


        while ($fila = mysqli_fetch_assoc($result)) {
            $comida = $fila['nombre'];
            echo "<input type='text' value='$comida'>";
        }

        echo "<br>";
        echo "<br>";
    }
    mysqli_close($con);
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Nathan Guerra, Bruno Bordagorry, Diego Weble">
    <meta name="generator" content="Visual Studio Code">
    <meta http-equiv="X-UA-Compatible" content="IE=chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <title>Gestión</title>
    <link rel="stylesheet" href="../recursos/css/fonts.css">
    <link rel="stylesheet" href="../recursos/css/header.css">
    <link rel="stylesheet" href="../recursos/css/footercVolverArriba.css">
    <link rel="stylesheet" href="../recursos/css/atencionCliente/styleFormularios.css">
    <link rel="icon" href="../recursos/img/logo.png">
</head>
<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.html">
                    <img src="../recursos/img/logo.png">
                </a>
                <a href="homepage.html" class="linkCentrado">Home</a>
            </div>

            <div class="divSubContenedorDerecha">
                <a class="linkCentrado">Vista de Pruebas</a>
                
                <img src="../recursos/img/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header>

    <!-- ////////////////////////////////////////////////////////////////////// -->

    
    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>
        <p>Copyright - Prometeo BND</p>
    </footer>
</body>
</html>