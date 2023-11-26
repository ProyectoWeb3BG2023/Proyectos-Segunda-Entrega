<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();
    if (!isset($_SESSION['identificadorCliente'])) {
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
    <meta name="keywords" content="inicio, receta, vianda, comida, menu, comida saludable, formulario">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footer.css">
    <link rel="stylesheet" href="../../recursos/css/tarjetas.css">
    <link rel="icon" href="../../recursos/img/logo.png">
</head>

<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.html">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homepage.php" class="linkCentrado">
                    <span>Home</span>
                </a>
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

    <section class="contenedorTarjetas">
        <article class="tarjeta par1">
            <a href="homeFormularios.php">Formularios</a>
        </article>

        <article class="tarjeta par2">
            <a href="homePedidos.php">Pedidos</a>
        </article>
    </section>

    <footer>
        <p>Copyright - Prometeo BND</p>
    </footer>
</body>
