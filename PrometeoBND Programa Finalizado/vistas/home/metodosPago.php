<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();

    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }
    
    // $documentoCliente = $_SESSION['documentoCliente'];

    $idCliente = $_SESSION['identificadorCliente'];


    $datosTarjeta = "SELECT numero_tarjeta, tipo_de_tarjeta FROM metodo_de_pago WHERE estado = 0 AND numero_tarjeta IN (SELECT `numero_tarjeta` FROM `posee` WHERE id_cliente = $idCliente)";
    $resultadoDatos = mysqli_query($con, $datosTarjeta);
    

    $metodosPago = "SELECT COUNT(numero_tarjeta) AS resultado FROM metodo_de_pago WHERE metodo_de_pago.estado = 0 
    AND numero_tarjeta IN (SELECT numero_tarjeta FROM posee WHERE id_cliente = $idCliente)";
    $resultadoPagos = mysqli_query($con, $metodosPago);

    // while ($registro = mysqli_fetch_array($resultadoDatos)) {
    //     $numeroTarjeta = $registro["numero_tarjeta"];
    //     $tipoTarjeta = $registro["tipo_de_tarjeta"];
    // }
    //Revisa si el cliente tiene menus personalizados a su nombre
    // // $menusPersonalizados = "SELECT COUNT(personalizado) AS resultado FROM integra WHERE personalizado = $documentoCliente";
    // $resultadoMenusPersonalizados = mysqli_query($con, $menusPersonalizados);
    
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
    <link rel="stylesheet" href ="../../recursos/css/home/styleMetodosPago.css">
    <link rel="stylesheet" href ="../../recursos/css/footercVolverArriba.css">
    <link rel="icon" href="../../recursos/img/logo.png">
    <title>Métodos de Pago</title>
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
            <?php
                if ($resultadoPagos) {
                    $row = $resultadoPagos->fetch_assoc();
                    $cantidad = $row['resultado'];
                    if( $cantidad >= 0 && $cantidad < 3 ){
                        echo "<a href='anadirMetodosPago.php' class='linkCentrado'><span>Añadir Pago</span></a>";
                    }
                } else {
                    echo "Error en la consulta";
                }
            ?>
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
    if ($resultadoDatos) {
            echo "<h1>Tus métodos registrados</h1>";
            echo "<section class='contenedorTarjetas'>";
            while ($registro = mysqli_fetch_assoc($resultadoDatos)) {
                $numeroTarjeta = $registro["numero_tarjeta"];
                $tipoTarjeta = $registro["tipo_de_tarjeta"];
                // $i = 0;
                // if ($i == 1) {
                echo "<form action='../../datos/borrarMetodoPago.php' method='post' enctype='multipart/form-data' class='tarjeta'>";
                echo "  <h1>Tarjeta</h1>";
                echo "  <div>";
                echo "  <input type='text' name='tipoTarjeta' value='" . $tipoTarjeta . "'>";
                echo "  <input type='text' name='numeroTarjeta' value='" . $numeroTarjeta . "'>";
                echo "  </div>";
                echo "  <input type='submit' value='Eliminar'>";
                echo "</form>";
            }
            echo "</section>";

    } else {
        echo "Error en la consulta";
    }
    
    ?>




    <script src="../../recursos/js/cliente/productoModal.js"></script>
</body>
</html>