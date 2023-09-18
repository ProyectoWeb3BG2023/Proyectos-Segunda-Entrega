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
    <link rel="stylesheet" href="styleAlertas.css">
    <link rel="icon" href="src/logo.png">
</head>
<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.html">
                    <img src="src/logo.png">
                </a>
                <a href="homepage.html" class="linkCentrado">Home</a>
            </div>

            <div class="divSubContenedorDerecha">
                <a class="linkCentrado">Nombre User</a>
                <img src="src/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header>

    <!-- ---------------------- STOCK FALTANTE / METAS ---------------------- -->

    <section class="contenedorTarjetas">
        <article class="tarjeta">
            <button onclick="mostrarOpcionesAlerta('stockF')">
                Stock faltante
            </button>
        </article>

        <article class="tarjeta">
            <button onclick="mostrarOpcionesAlerta('meta')">
                Metas
            </button>
        </article>
    </section>

    <!-- ////////////////////////////////////////////////////////////////////// -->
    
    <section class="contenedorStocksFaltantes" id="opcionesStockF">
        <!-- <article class="subContenedorTitulo">
            Stock faltante
        </article> -->
        <article class="subContenedorMenusFaltantes">
            <div class="menuFaltante">
                <h2>Menu X</h2>
                <img src="src/imagen.png"/>
                <button class="botonesStockFaltante">Stock Piso!</button>
                <button class="botonesStockFaltante">+</button>
            </div>

            <div class="menuFaltante">
                <h2>Menu X</h2>
                <img src="src/imagen.png"/>
                <button class="botonesStockFaltante">Stock Piso!</button>
                <button class="botonesStockFaltante">+</button>
            </div>
            <div class="menuFaltante">
                <h2>Menu X</h2>
                <img src="src/imagen.png"/>
                <button class="botonesStockFaltante">Stock Piso!</button>
                <button class="botonesStockFaltante">+</button>
            </div>
        </article>

        <article class="subContenedorMenusFaltantes">
            <div class="menuFaltante">
                <h2>Menu X</h2>
                <img src="src/imagen.png"/>
                <button class="botonesStockFaltante">Stock Piso!</button>
                <button class="botonesStockFaltante">+</button>
            </div>
            <div class="menuFaltante">
                <h2>Menu X</h2>
                <img src="src/imagen.png"/>
                <button class="botonesStockFaltante">Stock Piso!</button>
                <button class="botonesStockFaltante">+</button>
            </div>
            <div class="menuFaltante">
                <h2>Menu X</h2>
                <img src="src/imagen.png"/>
                <button class="botonesStockFaltante">Stock Piso!</button>
                <button class="botonesStockFaltante">+</button>
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
            <a href="#hd">Volver arriba</a>
        </section>
        <p>Copyright - Prometeo BND</p>
    </footer>
    <script src="main.js"></script>
</body>
</html>