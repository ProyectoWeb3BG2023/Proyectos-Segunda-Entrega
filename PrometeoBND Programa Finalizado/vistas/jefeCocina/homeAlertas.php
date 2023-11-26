<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();
    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }


    $menus0 = "SELECT `id_tipo_menu`, `nombre`, `precio`, `stock_techo` 
    FROM `tipo_menu` 
    WHERE id_tipo_menu 
    IN (SELECT `id_tipo_menu` 
            FROM `integra` 
            WHERE personalizado = 0 
            AND id_tipo_menu 
            IN (SELECT `id_tipo_menu` 
                FROM `tiene` 
                WHERE id_estado_tipo_menu = 0
                AND fecha_fin IS NULL) 
                GROUP BY id_tipo_menu) 
            AND autorizacion = 1";
    $menuSinStock = mysqli_query($con, $menus0);

    $menus1 = "SELECT `id_tipo_menu`, `nombre`, `precio`, `stock_techo`  
                FROM `tipo_menu` 
                WHERE id_tipo_menu 
                IN (SELECT `id_tipo_menu` 
                    FROM `integra` 
                    WHERE personalizado = 0 
                    AND id_tipo_menu 
                    IN (SELECT `id_tipo_menu` 
                        FROM `tiene` 
                        WHERE id_estado_tipo_menu = 3
                        AND fecha_fin IS NULL) 
                        GROUP BY id_tipo_menu) 
                    AND autorizacion = 1";
    $menuEnPreparacion = mysqli_query($con, $menus1);


    $menus2 = "SELECT `id_tipo_menu`, `nombre`, `precio`, `stock_techo`  
                FROM `tipo_menu` 
                WHERE id_tipo_menu 
                IN (SELECT `id_tipo_menu` 
                    FROM `integra` 
                    WHERE personalizado <> 0 
                    AND id_tipo_menu 
                    IN (SELECT `id_tipo_menu`
                        FROM `tiene` 
                        WHERE id_estado_tipo_menu = 2
                        AND fecha_fin IS NULL) 
                        GROUP BY id_tipo_menu) 
                    AND autorizacion = 1";
    $menuPersonalizadoSolicitado = mysqli_query($con, $menus2);
    
    $menusPersonalizadosId3 = "SELECT `id_tipo_menu`, `nombre`, `precio`, `stock_techo`  
                                FROM `tipo_menu` 
                                WHERE id_tipo_menu 
                                IN (SELECT `id_tipo_menu` 
                                    FROM `integra` 
                                    WHERE personalizado <> 0
                                    AND id_tipo_menu 
                                    IN (SELECT `id_tipo_menu`
                                        FROM `tiene` 
                                        WHERE id_estado_tipo_menu = 3
                                        AND fecha_fin IS NULL) 
                                        GROUP BY id_tipo_menu) 
                                    AND autorizacion = 1";
    $menuPersonalizadoEnPreparacion = mysqli_query($con, $menusPersonalizadosId3);
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
    <title>Alertas</title>
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">

    <link rel="stylesheet" href="../../recursos/css/jefeCocina/styleAlertas.css">
    <link rel="icon" href="../../recursos/img/logo.png">
</head>
<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.php">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homepage.php" class="linkCentrado"><span>Home</span></a>
            </div>
            <div class="divSubContenedorDerecha">
                <a class="linkCentrado">
                    <?php
                        echo $_SESSION['nombre_usuario'];
                    ?>
                </a>
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
    
    <section class="" id="opcionesStockFaltante">
        
    <?php
    $i = 1;
    if ($menuSinStock) {
        if($menuSinStock->num_rows > 0) {
            echo "<h1>Menus actualmente sin stock</h1>";
            while ($fila = mysqli_fetch_assoc($menuSinStock)) {
                $idMenu = $fila['id_tipo_menu'];
                $nombreMenu = $fila['nombre'];
                $precioMenu = $fila['precio'];
                $stockTecho = $fila['stock_techo'];

                $palabras = array("greenSquare.png", "tupper.png", "logoSquare.png", "logo.png", "lightGreenSquareAlt.png", "lightGreenSquare.png", "redSquare.png", "tupperVaporwave.png", "logoCristalic.png");
                $palabraAleatoria = $palabras[array_rand($palabras)];
                if(isset($fila['ruta_imagen'])){
                    $ruta = $fila['ruta_imagen'];
                } else {
                    $ruta = "../../recursos/img/" . $palabraAleatoria;
                }

                if ($i == 1) {
                    echo "<section class='comboMenus'>";
                    echo    "<form action='../../datos/modificacionEstadoMenu.php' class='subComboMenus' method='post' enctype='multipart/form-data'>";
                    echo        "<h2>" . $nombreMenu . "&nbsp;-&nbsp;" . $precioMenu . "</h2>";
                    echo        "<img src='" . $ruta . "' alt=''>";
                    echo        "<div class='opcMenu'>";
                    echo            "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo            "<input type='hidden' name='stocktecho' value='$stockTecho'>";
                    echo            "<button type='submit' name='btnEstado' value='3'>Iniciar producción</button>";
                    echo        "</div>";
                    echo    "</form>";
                    $i++;
                } else if ($i == 3) {
                    echo    "<form action='../../datos/modificacionEstadoMenu.php' class='subComboMenus' method='post' enctype='multipart/form-data' class='formDieta'>";
                    echo        "<h2>" . $nombreMenu ."&nbsp;-&nbsp;". $precioMenu . "</h2>";
                    echo        "<img src='".$ruta."' alt=''>";
                    echo        "<div class='opcMenu'>";
                    echo            "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo            "<input type='hidden' name='stocktecho' value='$stockTecho'>";
                    echo            "<button type='submit' name='btnEstado' value='3'>Iniciar producción</button>";
                    echo        "</div>";
                    echo    "</form>";
                    echo    "</section>";
                    $i = 1;
                } else {
                    echo    "<form action='../../datos/modificacionEstadoMenu.php' class='subComboMenus' method='post' enctype='multipart/form-data' class='formDieta'>";
                    echo        "<h2>" . $nombreMenu ."&nbsp;-&nbsp;". $precioMenu . "</h2>";
                    echo        "<img src='" . $ruta . "' alt=''>";
                    echo        "<div class='opcMenu'>";
                    echo            "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo            "<input type='hidden' name='stocktecho' value='$stockTecho'>";

                    echo            "<button type='submit' name='btnEstado' value='3'>Iniciar producción</button>";

                    echo        "</div>";
                    echo    "</form>";
                    $i++;
                }
            }
            if ($i != 3 || $i != 1) {
                echo    "</section>";
                $i = 1;
            }
        } else {
            echo "<h1>Estamos trabajando en nuestros menus momentáneamente!</h1>";
        }
    } else {
        echo "Error en la consulta";
    }
    // c
    $i = 1;
    if ($menuEnPreparacion) {
        if($menuEnPreparacion->num_rows > 0) {
            echo "<h1>Menus en Producción</h1>";
            while ($fila = mysqli_fetch_assoc($menuEnPreparacion)) {
                $idMenu = $fila['id_tipo_menu'];
                $nombreMenu = $fila['nombre'];
                $precioMenu = $fila['precio'];
                $stockTecho = $fila['stock_techo'];

                $palabras = array("greenSquare.png", "tupper.png", "logoSquare.png", "logo.png", "lightGreenSquareAlt.png", "lightGreenSquare.png", "redSquare.png", "tupperVaporwave.png", "logoCristalic.png");
                $palabraAleatoria = $palabras[array_rand($palabras)];
                if(isset($fila['ruta_imagen'])){
                    $ruta = $fila['ruta_imagen'];
                } else {
                    $ruta = "../../recursos/img/" . $palabraAleatoria;
                }
            
                if ($i == 1) {
                    echo "<section class='comboMenus'>";
                    echo    "<form action='../../datos/modificacionEstadoMenu.php' class='subComboMenus' method='post' enctype='multipart/form-data' class='formDieta'>";
                    echo        "<h2>" . $nombreMenu . "&nbsp;-&nbsp;" . $precioMenu . "</h2>";
                    echo        "<img src='" . $ruta . "' alt=''>";
                    echo        "<div class='opcMenu'>";
                    
                    echo            "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo            "<input type='hidden' name='stocktecho' value='$stockTecho'>";
                    echo            "<button type='submit' name='btnEstado' value='1'>Finalizar preparacion</button>";


                    echo        "</div>";
                    echo    "</form>";

                    $i++;
                } else if ($i == 3) {
                    echo    "<form action='../../datos/modificacionEstadoMenu.php' class='subComboMenus' method='post' enctype='multipart/form-data' class='formDieta'>";
                    echo        "<h2>" . $nombreMenu ."&nbsp;-&nbsp;". $precioMenu . "</h2>";
                    echo        "<img src='".$ruta."' alt=''>";
                    echo        "<div class='opcMenu'>";
                    echo            "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo            "<input type='hidden' name='stocktecho' value='$stockTecho'>";

                    echo            "<button type='submit' name='btnEstado' value='1'>Finalizar preparacion</button>";


                    echo        "</div>";
                    echo    "</form>";
                    echo    "</section>";
                    $i = 1;
                } else {
                    echo    "<form action='../../datos/modificacionEstadoMenu.php' class='subComboMenus' method='post' enctype='multipart/form-data' class='formDieta'>";
                    echo        "<h2>" . $nombreMenu ."&nbsp;-&nbsp;". $precioMenu . "</h2>";
                    echo        "<img src='" . $ruta . "' alt=''>";
                    echo        "<div class='opcMenu'>";
                    echo            "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo            "<input type='hidden' name='stocktecho' value='$stockTecho'>";
                    echo            "<button type='submit' name='btnEstado' value='1'>Finalizar preparacion</button>";

                    echo        "</div>";
                    echo    "</form>";
                    $i++;
                }
                
            }
            if ($i != 3 && $i != 1) {
                echo    "</section>";
                $i = 1;
            }
        } else {
            echo "<h1>No existen Menús en Producción actualmente!</h1>";
        }
    } else {
        echo "Error en la consulta";
    }


// ?>
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