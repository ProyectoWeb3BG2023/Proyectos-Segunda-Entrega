<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();
    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }

    $query = "SELECT nombre, stock_piso, stock_techo FROM tipo_menu";
    $result = mysqli_query($con, $query);

    $filas = mysqli_fetch_array($result);
    $fil = mysqli_fetch_array($result);


    $menus1 = "SELECT `id_tipo_menu`, `nombre`, `precio`, `stock_real` 
    FROM `tipo_menu` 
    WHERE id_tipo_menu 
    IN (SELECT `id_tipo_menu` 
            FROM `integra` 
            WHERE personalizado = 0 
            AND id_tipo_menu 
            IN (SELECT `id_tipo_menu` 
                FROM `tiene` 
                WHERE id_estado_tipo_menu = 1
                AND fecha_fin IS NULL) 
                GROUP BY id_tipo_menu) 
            AND autorizacion = 1";
    $menuSinStock = mysqli_query($con, $menus1);

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
    
    <link rel="stylesheet" href="../../recursos/css/jefeCocina/styleStockMenus.css">



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

    <!-- ////////////////////////////////////////////////////////////////////// -->

    <section class="contenedorTrio">
    <?php
    $i = 1;
    if ($menuSinStock) {
        if($menuSinStock->num_rows > 0) {
            echo "<h1>Menus con Stock</h1>";
            while ($fila = mysqli_fetch_assoc($menuSinStock)) {
                $idMenu = $fila['id_tipo_menu'];
                $nombreMenu = $fila['nombre'];
                $precioMenu = $fila['precio'];
                $stockReal = $fila['stock_real'];

                $palabras = array("greenSquare.png", "tupper.png", "logoSquare.png", "logo.png", "lightGreenSquareAlt.png", "lightGreenSquare.png", "redSquare.png", "tupperVaporwave.png", "logoCristalic.png");
                $palabraAleatoria = $palabras[array_rand($palabras)];
                if(isset($fila['ruta_imagen'])){
                    $ruta = $fila['ruta_imagen'];
                } else {
                    $ruta = "../../recursos/img/" . $palabraAleatoria;
                }

                if ($i == 1) {
                    echo "<article class='comboMenus'>";
                    echo    "<form action='../../datos/modificacionEstadoMenu.php' class='subComboMenus' method='post' enctype='multipart/form-data'>";
                    echo        "<h2>" . $nombreMenu . "&nbsp;-&nbsp;" . $precioMenu . "</h2>";
                    echo        "<img src='" . $ruta . "' alt=''>";
                    echo        "<div class='opcMenu'>";
                    echo            "<input type='hidden' name='idmenu' value='$idMenu'>";

                    echo            "<p>" . $stockReal . "</p>";
                    // echo            "<button type='submit' name='btnEstado' value='3'>Iniciar producción</button>";
                    echo        "</div>";
                    echo    "</form>";
                    $i++;
                } else if ($i == 3) {
                    echo    "<form action='../../datos/modificacionEstadoMenu.php' class='subComboMenus' method='post' enctype='multipart/form-data' class='formDieta'>";
                    echo        "<h2>" . $nombreMenu ."&nbsp;-&nbsp;". $precioMenu . "</h2>";
                    echo        "<img src='".$ruta."' alt=''>";
                    echo        "<div class='opcMenu'>";
                    echo            "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo            "<p>" . $stockReal . "</p>";
                    // echo            "<button type='submit' name='btnEstado' value='3'>Iniciar producción</button>";
                    echo        "</div>";
                    echo    "</form>";
                    echo    "</article>";
                    $i = 1;
                } else {
                    echo    "<form action='../../datos/modificacionEstadoMenu.php' class='subComboMenus' method='post' enctype='multipart/form-data' class='formDieta'>";
                    echo        "<h2>" . $nombreMenu ."&nbsp;-&nbsp;". $precioMenu . "</h2>";
                    echo        "<img src='" . $ruta . "' alt=''>";
                    echo        "<div class='opcMenu'>";
                    echo            "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo            "<p>" . $stockReal . "</p>";
                    // echo            "<button type='submit' name='btnEstado' value='3'>Iniciar producción</button>";
                    echo        "</div>";
                    echo    "</form>";
                    $i++;
                }
            }
            if ($i != 1 && $i != 3) {
                echo    "</article>";
            }
        } else {
            echo "<h1>Estamos trabajando en nuestros menus momentáneamente!</h1>";
        }
    } else {
        echo "Error en la consulta";
    }
    mysqli_close($con);

    ?>
    </section>



    
    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>
        <p>Copyright - Prometeo BND</p>
    </footer>

</body>
</html>