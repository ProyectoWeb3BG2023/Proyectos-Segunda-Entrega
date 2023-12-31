<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();

    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }

    $query = "SELECT nombre, stock_piso, stock_techo 
                FROM tipo_menu";
    $result = mysqli_query($con, $query);

    $filas = mysqli_fetch_array($result);
    $fil = mysqli_fetch_array($result);
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
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    <link rel="stylesheet" href="../../recursos/css/administrativo/stylePedidos.css">
    <link rel="icon" href="../../recursos/img/logo.png">
</head>
<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.html">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homepage.html" class="linkCentrado">Home</a>
            </div>

            <div class="divSubContenedorDerecha">
                <a class="linkCentrado">Nombre User</a>
                
                <img src="../../recursos/img/usr.png" class="linkCentrado" alt="">
               
            </div>
        </div>
    </header>

    <!-- ////////////////////////////////////////////////////////////////////// -->

    <section class="contenedorPedidos" id="opcionesPedido">
        <!--  -->
        <!-- <article class="subContenedorTitulo">
            Pedidos
        </article> -->
        <!--  -->
        <article class="subContenedorPedidos">
            <div class="subContenedorTitulo">
                #Pedido
            </div>
            <div class="divPedido">
                <div class="divDatosPedido">
                    <p>Nombre User</p>
                    <p>Estado</p>
                    <p>Fecha</p>
                </div>
                <div class="divMenuPedido">
                    <h2>Menu X</h2>
                    <img src="../../recursos/img/imagen.png"/>
                    <p>Cantidad</p>
                </div>
                <div class="divMenuPedido">
                    <h2>Menu X</h2>
                    <img src="../../recursos/img/imagen.png"/>
                    <p>Cantidad</p>
                </div>
                <div class="divMenuPedido">
                    <h2>Menu X</h2>
                    <img src="../../recursos/img/imagen.png"/>
                    <p>Cantidad</p>
                </div>
            </div>
        </article>
        <!--  -->
        <article class="subContenedorPedidos">
            <div class="subContenedorTitulo">
                #Pedido
            </div>
            <!--  -->
            <div class="divPedido">
                <div class="divDatosPedido">
                    <p>Nombre User</p>
                    <p>Estado</p>
                    <p>Fecha</p>
                </div>
                <div class="divMenuPedido">
                    <h2>Menu X</h2>
                    <img src="../../recursos/img/imagen.png"/>
                    <p>Cantidad</p>
                </div>
                <div class="divMenuPedido">
                    <h2>Menu X</h2>
                    <img src="../../recursos/img/imagen.png"/>
                    <p>Cantidad</p>
                </div>
                <div class="divMenuPedido">
                    <h2>Menu X</h2>
                    <img src="../../recursos/img/imagen.png"/>
                    <p>Cantidad</p>
                </div>
            </div>
        </article>
        <!--  -->
    </section>

    <!-- ////////////////////////////////////////////////////////////////////// -->

    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>
        <p>Copyright - Prometeo BND</p>
    </footer>
</body>
</html>