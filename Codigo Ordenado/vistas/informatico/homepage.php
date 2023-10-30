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
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    <link rel="stylesheet" href="../../recursos/css/tarjetas.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="icon" href="../../recursos/img/logo.png">
</head>

<body>
    <!-- Cabecera -->
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.html">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="#" class="linkCentrado">Home</a>
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
    
    <!-- Opciones del Informático -->
    <section class="contenedorTarjetas">
        <!-- Opción 1, Gestión -->
        <article class="tarjeta trio1">
            <a href="formulariosUsuario.php">Crear Usuario</a>
        </article>        
    </section>
    <!-- Opciones del Gerente -->
    <section class="contenedorTarjetas">
        <!-- Opción 1, Gestión -->
        <article class="tarjeta trio1">
            <a href="../gerente/homeGestion.php">Gestión</a>
        </article>
        <!-- Opción 2, Solicitudes -->
        <article class="tarjeta trio2">
            <a href="../gerente/homeSolicitud.php">Solicitudes</a>
        </article>
        <!-- Opción 3, Creación de Metas -->
        <article class="tarjeta trio3">
            <a href="../gerente/homeNuevo.html">+ Nuevo</a>
        </article>
    </section>
    <!-- Opciones del Jefe de Cocina -->
    <section class="contenedorTarjetas">
        <!-- Opción 1, Gestión -->
        <article class="tarjeta trio1">
            <a href="../jefeCocina/homeGestion.php">Gestión</a>
        </article>
        <!-- Opción 2, Alertas de Stock -->
        <article class="tarjeta trio2">
            <a href="../jefeCocina/homeAlertas.php">⚠</a>
        </article>
        <!-- Opción 3, Agregar Productos -->
        <article class="tarjeta trio3">
            <a href="../jefeCocina/homeNuevo.php">+ Nuevo</a>
        </article>
    </section>
    <!-- Opciones del Administrativo -->
    <section class="contenedorTarjetas">
        <article class="tarjeta par1">
            <a href="../administrativo/homeFormularios.html">Formularios</a>
        </article>
        <article class="tarjeta par2">
            <a href="../administrativo/homePedidos.php">Pedidos</a>
        </article>
    </section>
    <!-- Opciones del Atención al Cliente -->
    <section class="contenedorTarjetas">
        <article class="tarjeta par1">
            <a href="../atencionCliente/homeFormularios.php">Formularios</a>
        </article>

        <article class="tarjeta par2">
            <a href="../atencionCliente/homePedidos.php">Pedidos</a>
        </article>
    </section>
    <!-- Footer -->
    <footer>
        <p>Copyright - Prometeo BND</p>
    </footer>
</body>
