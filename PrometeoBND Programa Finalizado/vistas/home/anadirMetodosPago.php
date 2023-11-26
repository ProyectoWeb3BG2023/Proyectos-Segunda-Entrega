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
    $menus = "SELECT id_tipo_menu, nombre, precio, autorizacion FROM tipo_menu WHERE autorizacion = 1";
    $resultadoMenus = mysqli_query($con, $menus);
    
    //Revisa si el cliente tiene menús personalizados a su nombre
    $menusPersonalizados = "SELECT COUNT(personalizado) AS resultado FROM integra WHERE personalizado = $documentoCliente";
    $resultadoMenusPersonalizados = mysqli_query($con, $menusPersonalizados);

    //Revisa si el cliente tiene métodos de pago con su id
    $metodosPago = "SELECT COUNT(id_cliente) AS resultado FROM posee WHERE id_cliente = $idCliente";
    $resultadoPagos = mysqli_query($con, $metodosPago);

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
    <link rel="stylesheet" href="../../recursos/css/home/styleRegistroTarjeta.css">
    <link rel="stylesheet" href ="../../recursos/css/footercVolverArriba.css">
    <link rel="icon" href="../../recursos/img/logo.png">
    <title>Añadir Tipo de Pago</title>
</head>
<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homeUL.php">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homeUL.php" class="linkCentrado"><span>Home</span></a>
            </div>
            <div class="divSubContenedorDerecha">
                <a href="../../datos/logout.php" class="linkCentrado">Cerrar Sesión</a>
                <a class="linkCentrado">
                    <?php
                        if(isset($_SESSION['nombre_usuarioCliente'])) {
                            echo $_SESSION['nombre_usuarioCliente'];
                        }
                    ?>
                </a>
                <img src="../../recursos/img/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header>

    <section class="contenedorRegistroTarjeta">
        <form action="../../datos/metodoPago.php" method="post" enctype="multipart/form-data" class="formulario">
        <h1 class="form__title">Añadir Tarjeta</h1>
        <label for="tipoTarjeta">Tipo de Tarjeta:</label>
        <select id="tipoTarjeta" name="opcionTarjeta">
            <option value="Visa">Visa</option>
            <option value="MasterCard">MasterCard</option>
            <option value="American Express">American Express</option>
            <option value="Discover">Discover</option>
            <option value="Diners Club">Diners Club</option>
            <option value="JCB">JCB</option>
            <option value="Maestro">Maestro</option>
        </select>
        <!-- <br> -->
        <label for="tipoTarjeta">Número de la Tarjeta:</label>
        <input type="text" name="numeroTarjeta" id="" placeholder="Introduzca el número aquí...">
        <input type="submit" value="Agregar">            
        </form>
    </section>


</body>
</html>