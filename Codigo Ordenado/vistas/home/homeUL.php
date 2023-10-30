<?php
    session_start();
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
                <a href="productos.html" class="linkCentrado"><span>Productos</span></a>

            </div>

            <div class="divSubContenedorDerecha">
                <a href="../../datos/logout.php" class="linkCentrado">Cerrar Sesión</a>

                <a class="linkCentrado">
                    <!-- Nombre User -->
                    <?php
                        if(isset($_SESSION['nombre_usuarioCliente'])) {
                            echo $_SESSION['nombre_usuarioCliente'];
                        }
                    ?>
                </a>
                <a href="../cliente/perfiles/web/perfilWeb.php"><img src="../../recursos/img/usr.png" class="linkCentrado" alt=""></a>
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
    <section class="contenedorMenues" id="opcionesStock">
        <article class="subContenedorMenues">
            <div class="contenedorMenu">
                <h2>Menu X</h2>
                <img src="../../recursos/img/imagen.png"/>
                <p>Cantidad</p>
            </div>

            <div class="contenedorMenu">
                <h2>Menu Y</h2>
                <img src="../../recursos/img/imagen.png"/>
                <p>Cantidad</p>
            </div>

            <div class="contenedorMenu">
                <h2>Menu Z</h2>
                <img src="../../recursos/img/imagen.png"/>
                <p>Cantidad</p>
            </div>
        </article>
    </section> 
    <!--  -->
    <section class="contenedorTextoImagen">
        <article class="subContenedorTexto">
            <h2 class="h2Oracion">Para vos querido cliente</h2>
        </article>
        
        <article class="subContenedorImagen">
            <img src="../../recursos/img/imagen.png" alt="">
        </article>
    </section>
    <!--  -->
    <section class="contenedorMenues" id="opcionesStock">
        <!--  -->
        <article class="subContenedorMenues">
            <div class="contenedorMenu">
                <h2>Menu H</h2>
                <img src="../../recursos/img/imagen.png"/>
                <p>Cantidad</p>
            </div>

            <div class="contenedorMenu">
                <h2>Menu J</h2>
                <img src="../../recursos/img/imagen.png"/>
                <p>Cantidad</p>
            </div>

            <div class="contenedorMenu">
                <h2>Menu K</h2>
                <img src="../../recursos/img/imagen.png"/>
                <p>Cantidad</p>
            </div>
        </article>
        <!--  -->
    </section>
    <!--  -->
    <section class="contenedorTextoImagen">    
        <article class="subContenedorImagen">
            <img src="../../recursos/img/imagen.png" alt="">
        </article>
        
        <article class="subContenedorTexto">
            <h2 class="h2Oracion">La mejor calidad☺</h2>
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