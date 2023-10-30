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
    <title>Alertas</title>

    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">

    <link rel="stylesheet" href="../..recursos/css/jefeCocina/styleAlertas.css">
    <link rel="icon" href="../../recursos/img/logo.png">
</head>
<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="../home/homepage.html">
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

    <!-- ---------------------- STOCK FALTANTE / METAS ---------------------- -->

    <section class="contenedorTarjetas">
        <article class="tarjeta">
            <button id="btnStockFaltante" class="boton">
                Stock faltante
            </button>
        </article>

        <article class="tarjeta">
            <button id="btnMeta" class="boton">
                Metas
            </button>
        </article>
    </section>

    <!-- ////////////////////////////////////////////////////////////////////// -->
    
    <section class="contenedorStocksFaltantes" id="opcionesStockFaltante">
        <!-- <article class="subContenedorTitulo">
            Stock faltante
        </article> -->
        <article class="subContenedorMenusFaltantes">
            <div class="menuFaltante">
                <h2>Menu X</h2>
                <img src="../../recursos/img/green.png"/>
                <!-- Modal que deje cambiar estados del tipo_menu -->
                <button class="botonesStockFaltante boton">Stock Piso!</button>
                <button class="botonesStockFaltante boton">+</button>
            </div>

            <div class="menuFaltante">
                <h2>Menu X</h2>
                <img src="../../recursos/img/lightGreen.png"/>
                <button class="botonesStockFaltante boton">Stock Piso!</button>
                <button class="botonesStockFaltante boton">+</button>
            </div>
            <div class="menuFaltante">
                <h2>Menu X</h2>
                <img src="../../recursos/img/brown.png"/>
                <button class="botonesStockFaltante boton">Stock Piso!</button>
                <button class="botonesStockFaltante boton">+</button>
            </div>
        </article>

        <article class="subContenedorMenusFaltantes">
            <div class="menuFaltante">
                <h2>Menu X</h2>
                <img src="../../recursos/img/imagen.png"/>
                <button class="botonesStockFaltante boton">Stock Piso!</button>
                <button class="botonesStockFaltante boton">+</button>
            </div>
            <div class="menuFaltante">
                <h2>Menu X</h2>
                <img src="../../recursos/img/imagen.png"/>
                <button class="botonesStockFaltante boton">Stock Piso!</button>
                <button class="botonesStockFaltante boton">+</button>
            </div>
            <div class="menuFaltante">
                <h2>Menu X</h2>
                <img src="../../recursos/img/imagen.png"/>
                <button class="botonesStockFaltante boton">Stock Piso!</button>
                <button class="botonesStockFaltante boton">+</button>
            </div>
        </article>

    </section>
 
    <!-- ////////////////////////////////////////////////////////////////////// -->

    <section class="contenedorMetas" id="opcionesMeta">
        <!-- <article class="subContenedorTitulo">
            Metas
        </article> -->
        <article class="subContenedorComboMetas">
            <div class="divMeta">
                <p>Meta</p>
            </div>
            <div class="divMeta">
                <p>Meta</p>
            </div>
            <div class="divMeta">
                <p>Meta</p>
            </div>
        </article>

        <article class="subContenedorComboMetas">
            <div class="divMeta">
                <p>Meta</p>
            </div>
            <div class="divMeta">
                <p>Meta</p>
            </div>
            <div class="divMeta">
                <p>Meta</p>
            </div>
        </article>

        <article class="subContenedorComboMetas">
            <div class="divMeta">
                <p>Meta</p>
            </div>
            <div class="divMeta">
                <p>Meta</p>
            </div>
            <div class="divMeta">
                <p>Meta</p>
            </div>
        </article>
    </section>
    
    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>
        <p>Copyright - Prometeo BND</p>
    </footer>
    <script src="../../recursos/js/jefeCocina/mainAlertas.js"></script>
</body>
</html>