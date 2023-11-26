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
    <meta name="author" content="Nathan Guerra, Bruno Bordagorry, Diego Weble">
    <meta name="generator" content="Visual Studio Code">
    <meta http-equiv="X-UA-Compatible" content="IE=chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <title>Ingreso Nuevo</title>
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    <link rel="stylesheet" href="../../recursos/css/administrativo/styleFormEmpresa.css">
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
    <section class="contenedorFormulario">
        <article class="subContenedorTitulo">                
            Cliente Empresa
        </article>
        <article class="subContenedorFormulario" id="opcionesEmpresa">
            <!-- <div> -->
                <form action="../../datos/registrarEmpresa.php" method="post" enctype="multipart/form-data" class="formRegistroClienteEmpresa">
                    <label>Formulario</label>
                    <p>
                        <input type="text" id="n1" name="nombre" required placeholder="Nombre">
                    </p>
                    <p>
                        <input type="text" name="documento" required placeholder="RUT">
                        <input type="email" name="mail" required placeholder="Mail">
                    </p>
                    <p class="pDatoDireccionEmpresa">
                        <input type="text" name="calle" required placeholder="Calle">
                        <input type="number" name="puerta" required placeholder="Puerta">
                        <input type="text" name="esquina" required placeholder="Esquina">
                    </p>
                    <input type="text" class="inputDatoComentario">
                    
                    <div class="botonesRespuestaFormulario">
                        <button type="submit" class="boton" name="opcion" value="0">Aprobado</button>
                        <button type="submit" class="boton" name="opcion" value="1">Rechazado</button>
                    </div>
                </form>
        </article>
    </section>
    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>
        
        <p>Copyright - Prometeo BND</p>
    </footer>
</body>
</html>