<?php
    session_start();
    // include("../sign in/logueo.php");
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
    <meta name="author" content=" Diego Weble, Bruno Bordagorry, Nathan Guerra">
    <meta name="generator" content="Visual Studio Code">
    <meta http-equiv="X-UA-Compatible" content="IE=chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <title>Formularios pendientes</title>
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    <link rel="stylesheet" href="../../recursos/css/administrativo/styleFormularios.css">
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

    <!-- ///////////////////////////////////////////////////// -->

    <section class="contenedorFormularios">
        <article class="subContenedorFormularios">
            <div class="divFormulario">
                <h2>Formulario</h2>
                <h3>ID Cliente</h3>
                <h3>Fecha</h3>
                <a href="homeFormEmpresa.html"><p>🛈</p></a>
            </div>
            <div class="divFormulario">
                <h2>Formulario</h2>
                <h3>ID Cliente</h3>
                <h3>Fecha</h3>
                <a href="homeFormWeb.html"><p>🛈</p></a>
            </div>
            <div class="divFormulario">
                <h2>Formulario</h2>
                <h3>ID Cliente</h3>
                <h3>Fecha</h3>
                <a href="homeFormEmpresa.html"><p>🛈</p></a>
            </div>
            <div class="divFormulario">
                <h2>Formulario</h2>
                <h3>ID Cliente</h3>
                <h3>Fecha</h3>
                <a href="homeFormWeb.html"><p>🛈</p></a>
            </div>
        </article>

        <article class="subContenedorFormularios">
            <div class="divFormulario">
                <h2>Formulario</h2>
                <h3>ID Cliente</h3>
                <h3>Fecha</h3>
                <a href="homeFormWeb.html"><p>🛈</p></a>
            </div>
            <div class="divFormulario">
                <h2>Formulario</h2>
                <h3>ID Cliente</h3>
                <h3>Fecha</h3>
                <p>🛈</p>
            </div>
            <div class="divFormulario">
                <h2>Formulario</h2>
                <h3>ID Cliente</h3>
                <h3>Fecha</h3>
                <a href="homeFormEmpresa.html"><p>🛈</p></a>
            </div>
            <div class="divFormulario">
                <h2>Formulario</h2>
                <h3>ID Cliente</h3>
                <h3>Fecha</h3>
                <a href="homeFormWeb.html" target="_blank"><p>🛈</p></a>
            </div>
        </article>
    </section>

    <!-- ///////////////////////////////////////////////////// -->

    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>
        <p>Copyright - Prometeo BND</p>
        
    </footer>

</body>
</html>