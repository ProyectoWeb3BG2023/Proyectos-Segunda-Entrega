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
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    <link rel="stylesheet" href="../../recursos/css/tarjetas.css">
    <title>Inicio - Informático</title>
</head>

<body>
    <!-- Cabecera -->
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.php">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homepage.php" class="linkCentrado">Inicio</a>
            </div>

            <div class="divSubContenedorDerecha">
                <a href="../../datos/logout.php" class="linkCentrado">Cerrar Sesión</a>

                <a class="linkCentrado">
                    <!-- Nombre User -->
                    <?php
                        echo $_SESSION['nombre_usuario'];
                    ?>
                </a>
            </div>
        </div>
    </header>
    
    <h1>Informático</h1>
    <!-- Opciones del Informático -->
    <section class="contenedorTarjetas">
        <!-- Opción 1, Gestión -->
        <article class="tarjeta trio1">
            <a href="formulariosUsuario.php">Crear Usuario</a>
        </article>        
    </section>
    <h1>Gerencia</h1>
    <!-- Opciones del Gerente -->
    <section class="contenedorTarjetas">
        <!-- Opción 1, Gestión -->
        <article class="tarjeta trio1">
            <a href="homeStockMenus.php">Gestión</a>
        </article>
        <!-- Opción 2, Solicitudes -->
        <article class="tarjeta trio2">
            <a href="../gerente/homeSolicitud.php">Solicitudes</a>
        </article>
        <!-- Opción 3, Creación de Metas -->
        <article class="tarjeta trio3">
            <a href="../gerente/homeNuevo.php">+ Nuevo</a>
        </article>
    </section>
    <h1>Productos y Servicios</h1>
    <!-- Opciones del Jefe de Cocina -->
    <section class="contenedorTarjetas">
        <!-- Opción 1, Gestión -->
        <article class="tarjeta trio1">
            <a href="homeStockMenus.php">Stock</a>
        </article>
        <!-- Opción 2, Alertas de Stock -->
        <article class="tarjeta trio2">
            <a href="homeAlertas.php">Stock Bajos</a>
        </article>
        <!-- Opción 3, Agregar Productos -->
        <article class="tarjeta trio3">
            <a href="../jefeCocina/homeNuevo.php">+ Nuevo</a>
        </article>
    </section>
    <section class="contenedorTarjetas">
        <!-- Opción 4, Pedidos -->
        <article class="tarjeta trio2">
            <a href="homePedidos.php">Pedidos</a>
        </article>
    </section>
    <h1>Administración</h1>
    <!-- Opciones del Administrativo -->
    <section class="contenedorTarjetas">
        <article class="tarjeta par1">
            <a href="homeFormularios.php">Formularios - Aprobaciones</a>
        </article>
        <article class="tarjeta par2">
            <a href="homePedidos.php">Pedidos</a>
        </article>
    </section>

    <h1>Atención al Cliente</h1>
    <!-- Opciones del Atención al Cliente -->
    <section class="contenedorTarjetas">
        <article class="tarjeta par1">
            <a href="homeFormularios.php">Formularios - Envíos</a>
        </article>
        <article class="tarjeta par2">
            <a href="homePedidos.php">Pedidos</a>
        </article>
    </section>
    <!-- Footer -->
    <footer>
        <p>Copyright - Prometeo BND</p>
    </footer>
</body>
