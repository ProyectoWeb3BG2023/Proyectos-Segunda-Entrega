<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();

    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }
    
    $documentoCliente = $_SESSION['documentoCliente'];

    $idCliente = $_SESSION['identificadorCliente'];

    // Datos para los Menus
    // $menus = "SELECT id_tipo_menu, nombre, precio, autorizacion FROM tipo_menu WHERE autorizacion = 1";

    $menus = "SELECT id_tipo_menu, nombre, precio, autorizacion, ruta_imagen FROM tipo_menu WHERE autorizacion = 1 AND id_tipo_menu IN (SELECT id_tipo_menu FROM integra WHERE personalizado = 0 GROUP BY id_tipo_menu ASC) ORDER BY `tipo_menu`.`id_tipo_menu` DESC";
    $resultadoMenus = mysqli_query($con, $menus);
    
    //Revisa si el cliente tiene menús personalizados a su nombre
    $menusPersonalizados = "SELECT COUNT(personalizado) AS resultado FROM integra WHERE personalizado = $documentoCliente";
    $resultadoMenusPersonalizados = mysqli_query($con, $menusPersonalizados);

    

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
    <link rel="stylesheet" href ="../../recursos/css/home/styleProductos.css">
    <link rel="stylesheet" href ="../../recursos/css/footercVolverArriba.css">
    <link rel="icon" href="../../recursos/img/logo.png">
    <title>Nuestros servicios</title>
</head>
<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homeUL.php">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homeUL.php" class="linkCentrado"><span>Home</span></a>
                <a href="solicitudPersonalizado.php" class="linkCentrado"><span>Solicitar Menú</span></a>
                <a href='metodosPago.php' class='linkCentrado'><span>Métodos de Pago</span></a>
                <a href='pedidosCliente.php' class='linkCentrado'><span>Pedidos</span></a>

                <?php
                    if ($resultadoMenusPersonalizados) {
                        $row = $resultadoMenusPersonalizados->fetch_assoc();
                        $cantidad = $row['resultado'];
                        if ($cantidad >= 1) {
                            echo "<a href='misMenus.php' class='linkCentrado'><span>Mis Menús</span></a>";
                        }
                    } else {
                        echo "Error en la consulta";
                    }
                ?>

            </div>

            <div class="divSubContenedorDerecha">
                <a href="../../datos/logout.php" class="linkCentrado">Cerrar Sesión</a>
                <a class="linkCentrado">
                    <?php
                        if(isset($_SESSION['nombre_usuarioCliente'])) {
                            if($_SESSION['tipoDocumentoCliente'] == "RUT"){
                                echo "<a href='../cliente/perfiles/empresa/perfilEmpresa.php'>" . $_SESSION['nombre_usuarioCliente'] ." </a>";
                            } else {
                                echo "<a href='../cliente/perfiles/web/perfilWeb.php'>" . $_SESSION['nombre_usuarioCliente'] ." </a>";
                            }
                        }
                    ?>
                </a>
            </div>
        </div>
    </header>

    <?php
    $i = 1;
    if ($resultadoMenus) {
        if($resultadoMenus->num_rows > 0) {
            echo "<h1>Pensado al detalle, porque no mereces menos</h1>";
            while ($fila = mysqli_fetch_assoc($resultadoMenus)) {
                $idMenu = $fila['id_tipo_menu'];
                $nombreMenu = $fila['nombre'];
                $precioMenu = $fila['precio'];

                $palabras = array("greenSquare.png", "tupper.png", "logoSquare.png", "logo.png", "lightGreenSquareAlt.png", "lightGreenSquare.png", "redSquare.png", "tupperVaporwave.png", "logoCristalic.png");
                $palabraAleatoria = $palabras[array_rand($palabras)];
                if(isset($fila['ruta_imagen'])){
                    $ruta = $fila['ruta_imagen'];
                } else {
                    $ruta = "../../recursos/img/" . $palabraAleatoria;
                }
            
                if ($i == 1) {
                    echo "<section class='comboMenus'>";
                    echo    "<article class='subComboMenus'>";
                    echo        "<h2>" . $nombreMenu . "</h2>";
                    echo        "<img src='" . $ruta . "' alt=''>";
                    echo        "<div class='opcMenu'>";
                    echo            "<p>$" . $precioMenu . "</p>";
                    echo            "<!-- <a href='#' class='modalOpen data-menu-id=''>🛈</a> -->";
                    echo            "<button class='modalOpen' data-menu-id='$idMenu''>🛈</button>";
                    echo        "</div>";
                    echo    "</article>";

                    $i++;
                } else if ($i == 3) {
                    echo    "<article class='subComboMenus'>";
                    echo        "<h2>" . $nombreMenu . "</h2>";
                    echo        "<img src='".$ruta."' alt=''>";
                    echo        "<div class='opcMenu'>";
                    echo            "<p>$" . $precioMenu . "</p>";
                    echo            "<!-- <a href='#' class='modalOpen data-menu-id='''>🛈</a> -->";
                    echo            "<button class='modalOpen' data-menu-id='$idMenu''>🛈</button>";
                    echo        "</div>";
                    echo    "</article>";
                    echo    "</section>";
                    $i = 1;
                } else {
                    echo    "<article class='subComboMenus'>";
                    echo        "<h2>" . $nombreMenu . "</h2>";
                    echo        "<img src='" . $ruta . "' alt=''>";
                    echo        "<div class='opcMenu'>";
                    echo            "<p>$" . $precioMenu . "</p>";
                    echo            "<!-- <a href='#' class='modalOpen data-menu-id='''>🛈</a> -->";
                    echo            "<button class='modalOpen' data-menu-id='$idMenu''>🛈</button>";
                    echo        "</div>";
                    echo    "</article>";
                    $i++;
                }
            }
            if ($i == 2 || $i == 1) {
                echo    "</section>";
            }
        } else {
            echo "<h2>Estamos trabajando en nuestros menus momentáneamente!</h2>";
        }
    } else {
        echo "Error en la consulta";
    }
    
    ?>



    <!-- MODAL -->

    <section class="modal ">
        <div class="modal__container">
            <article class="modal__subContainer">
                <img src="../../recursos/img/Green.png" class="modal__img">
                <p class="modal__price">$$</p>
            </article>
            <article class="modal__subContainer2">
                <div>
                    <h3 class="modal__title">Nombre</h3>
                    <p class="modal__paragraph">Lorem ipsum dolor sit amet consectetur, 
                    adipisicing elit. Id, perspiciatis. Nemo, eius. Voluptates perspiciatis 
                    illo ullam quibusdam omnis tenetur voluptas.</p>
                </div>
                    <h4>Platos del Menu</h4>
                    <div class="modal__datos1 ">
                        <div>
                            <p>Pizza</p>
                            <p>Hamburguesa</p>
                            <p>Cazuela de pollo con arroz</p>
                            <p>Apio</p>
                            <p>Empanadas</p>
                        </div>
                    </div>
            </article>
            <article class="modal__subContainer3">
                <h3 class="modal__title">Pago</h3>
                <form action="../../datos/compra.php" enctype="multipart/form-data" class="modal__form modal__datos2">
                    <label for="a">Tipo de Tarjeta:</label>
                    <!-- <br> -->
                    <input type="text" name="tipotarjeta" id="a" placeholder="Tipo/Tarjeta">
                    <!-- <br> -->
                    <label for="b">Número de la Tarjeta:</label>
                    <!-- <br> -->
                    <input type="number" name="numerotarjeta" id="b" placeholder="Número...">
                    <input type="submit" name="" id="" value="Comprar">

                </form>

            </article>
            <a class='modal__close'>&times;</a>
        </div>
    </section>

    <script src="../../recursos/js/cliente/productoModal.js"></script>
</body>
</html>