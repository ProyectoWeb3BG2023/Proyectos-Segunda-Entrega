<?php
include("../../datos/conexion/conexion.php");
$con = conectar();
$query = "SELECT nombre, stock_piso, stock_techo FROM tipo_menu";
$result = mysqli_query($con, $query);

$filas = mysqli_fetch_array($result);
$fil = mysqli_fetch_array($result);
// var_dump($fil);

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
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    
    <title>Gestión</title>
    <link rel="stylesheet" href="../../recursos/css/gerente/styleGestion.css">
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

    <!-- ---------------------- STOCK / PEDIDOS ---------------------- -->

    <section class="contenedorTarjetas">
        <article class="tarjeta">
            <button onclick="mostrarOpcionesGestion('stock')" class="boton">
                Stock
            </button>
        </article>

        <article class="tarjeta" class="centered-link">
            <button onclick="mostrarOpcionesGestion('pedido')" class="boton">
                Pedidos
            </button>
        </article>
    </section>

    <!-- ////////////////////////////////////////////////////////////////////// -->

    <section class="contenedorStock" id="opcionesStock">
        <?php
        $i = 1;
        $count = 0;
        foreach ($result as $row) {
            if( $i == 1 ){
                echo '<article class="subContenedorCombo">';
                echo '<div class="divMenu">';
                echo '<h2>Menu ' . $row['nombre'] . '</h2>';
                echo '<img src="../../recursos/img/imagen.png"/>';
                echo '<p>' . $row['stock_techo'] . '</p>';
                echo '</div>';
                $i++;
            } else if($i==3){
                echo '<div class="divMenu">';
                echo '<h2>Menu ' . $row['nombre'] . '</h2>';
                echo '<img src="../../recursos/img/imagen.png"/>';
                echo '<p>' . $row['stock_techo'] . '</p>';
                echo '</div>';
                echo '</article>';
                $i=1;
            } else {
                echo '<div class="divMenu">';
                echo '<h2>Menu ' . $row['nombre'] . '</h2>';
                echo '<img src="../../recursos/img/imagen.png"/>';
                echo '<p>' . $row['stock_techo'] . '</p>';
                echo '</div>';
                $i++;
            }
        }
        ?>
        <?php
        mysqli_close($con);
        ?>
    </section>

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
    <script src="../../recursos/js/main.js"></script>
</body>
</html>