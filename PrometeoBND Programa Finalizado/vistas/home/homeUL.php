<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();
    if(!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }
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
    <title>Homepage</title>
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    <link rel="stylesheet" href="../../recursos/css/home/styleUL.css">
    <link rel="icon" href="../../recursos/img/logo.png">
</head>
<body>
    <!--  -->
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homeUL.php">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homeUL.php" class="linkCentrado"><span>Home</span></a>
                <a href="productos.php" class="linkCentrado"><span>Productos</span></a>

            </div>

            <div class="divSubContenedorDerecha">
                <a href="../../datos/logout.php" class="linkCentrado">Cerrar Sesión</a>

                <a class="linkCentrado">
                    <!-- Nombre User -->
                    <?php
                        if(isset($_SESSION['nombre_usuarioCliente'])) {
                            if($_SESSION['tipoDocumentoCliente'] == "RUT"){
                                echo "<a href='../cliente/perfiles/empresa/perfilEmpresa.php'>" . $_SESSION['nombre_usuarioCliente'] ." </a>";
                            } else {
                                echo "<a href='../cliente/perfiles/web/perfilWeb.php'>" . $_SESSION['nombre_usuarioCliente'] ." </a>";
                            }
                        }
                    ?>
                </a>
                <?php
                ?>
            </div>
        </div>
    </header>
    <!--  -->
    <section>
        <article>
            <h2 class="h2Oracion">Te estabamos esperando...</h2>
        </article>
        <!-- <article>

        </article> -->
    </section>
    <!--  -->
        <div class="galeria">
            <img src="../../recursos/img/plato1.jpg" alt="Galeria de imagenes">
            <img src="../../recursos/img/plato2.jpg" alt="Galeria de imagenes">
            <img src="../../recursos/img/plato3.jpg" alt="Galeria de imagenes">
            <img src="../../recursos/img/plato4.jpg" alt="Galeria de imagenes">
            <img src="../../recursos/img/plato5.jpg" alt="Galeria de imagenes">
        </div>
    <!--  -->
    <section class="contenedorTextoImagen">
        <article class="subContenedorTexto">
            <h2 class="h2Oracion">Diversidad en cada plato</h2>
        </article>

        <article class="subContenedorImagen">
            <img class="bordesImagen" src="../../recursos/img/platoderecha.jpg" alt="">
        </article>
    </section>
    <!--  -->
        <!--  -->
        <div class="galeria">
            <img src="../../recursos/img/plato6.jpg" alt="Galeria de imagenes">
            <img src="../../recursos/img/plato7.jpg" alt="Galeria de imagenes">
            <img src="../../recursos/img/plato8.jpg" alt="Galeria de imagenes">
            <img src="../../recursos/img/plato9.jpg" alt="Galeria de imagenes">
            <img src="../../recursos/img/plato10.jpg" alt="Galeria de imagenes">
        </div>
        <!--  -->
    <!--  -->
    <section class="contenedorTextoImagen">
        <article class="subContenedorImagen">
            <img class="bordesImagen2" src="../../recursos/img/platoizquierda.jpg" alt="">
        </article>

        <article class="subContenedorTexto">
            <h2 class="h2Oracion">Delicias para todos los paladares</h2>
        </article>
    </section>
    <!--  -->
    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>

        <p>Copyright - Prometeo BND</p>
    </footer>
    <!--  -->
</body>
</html>