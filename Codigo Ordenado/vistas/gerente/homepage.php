<?php
    session_start();
    // include("../sign in/logueo.php");
    include("../../datos/conexion/conexion.php");
    $con = conectar();
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
    <meta name="keywords" content="inicio, receta, vianda, comida, menu, comida saludable, formulario">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footer.css">
    <link rel="stylesheet" href="../../recursos/css/tarjetas.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="icon" href="../../recursos/img/logo.png">
</head>

<body>
    <!-- Cabecera -->
    <header id="cabecera">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.html">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homepage.html" class="linkCentrado">Home</a>
            </div>
            <div class="divSubContenedorDerecha">
            <a href="../../datos/logout.php" class="linkCentrado">Cerrar Sesión</a>
            <a class="linkCentrado">
                <!-- Nombre User -->
                <?php
                    echo $_SESSION['nombre_usuario'];
                ?>
            </a>
                <img src="../../recursos/img/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header>
    <!-- Opciones del Gerente -->
    <section class="contenedorTarjetas">
        <!-- Opción 1, Gestión -->
        <article class="tarjeta trio1">
            <a href="homeGestion.php">Gestión</a>
        </article>
        <!-- Opción 2, Solicitudes -->
        <article class="tarjeta trio2">
            <a href="homeSolicitud.php">Solicitudes</a>
        </article>
        <!-- Opción 3, Creación de Metas -->
        <article class="tarjeta trio3">
            <a href="homeNuevo.html">+ Nuevo</a>
        </article>
    </section>
    <!-- Pie de Página -->
    <footer>
        <!-- <section>
            <a href="#cabecera">Volver arriba</a>
        </section> -->
        <p>Copyright - Prometeo BND</p>
    </footer>
</body>
</html>