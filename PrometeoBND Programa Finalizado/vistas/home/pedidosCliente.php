<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();

    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }
    
    $idCliente = $_SESSION['identificadorCliente'];

    $documentoCliente = $_SESSION['documentoCliente'];

    $idsPedidos = "SELECT id_pedido, id_estado_pedido FROM se_encuentra WHERE id_pedido IN (SELECT id_pedido FROM hace WHERE id_cliente = '$idCliente') AND fecha_fin IS NULL";
    $guardarIds = mysqli_query($con, $idsPedidos);
    $arregloIds = array();
    while ($arreglo = mysqli_fetch_array($guardarIds)) {
        $arregloIds[] = $arreglo["id_pedido"];
        $arregloEstados[] = $arreglo["id_estado_pedido"];
    }
    $cantidad = count($arregloIds);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Diego Weble, Bruno Bordagorry, Nathan Guerra">
    <meta name="generator" content="Visual Studio Code">
    <meta http-equiv="X-UA-Compatible" content="IE=chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="pedido, menus, estados, perfil">
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    
    <link rel="stylesheet" href ="../../recursos/css/jefeCocina/stylePedidos.css">

    <link rel="stylesheet" href ="../../recursos/css/footercVolverArriba.css">
    <link rel="icon" href="../../recursos/img/logo.png">
    <title>Mis Menús</title>
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
            </div>
        </div>
    </header>

    
    <?php
    if ($cantidad > 0) {
        echo "<h1>Pedidos - Enviados / En viaje - 4</h1>";
        $i = 1;
        for( $z = 0 ; $z < $cantidad ; $z++){
            $datosPedido = "SELECT pedido.id_pedido, pedido.costo, pedido.descripcion, cliente.primer_nombre, cliente.id_cliente 
                        FROM pedido, cliente 
                        WHERE id_pedido IN (SELECT id_pedido 
                                            FROM hace
                                            WHERE id_pedido = $arregloIds[$z])
                        AND id_cliente IN (SELECT id_cliente
                                    FROM hace 
                                    WHERE id_pedido = $arregloIds[$z])
                        ORDER BY `pedido`.`id_pedido` ASC";

            $guardarDatosPedido = mysqli_query($con, $datosPedido);

            while ($fila = mysqli_fetch_assoc($guardarDatosPedido)) {
                $idPedido = $fila["id_pedido"];
                $costoPedido = $fila["costo"];
                $nombreMenu = $fila["descripcion"];
                $primerNombre = $fila["primer_nombre"];
                $idCliente = $fila["id_cliente"];
            }
            // c
            $consultaStock = "SELECT id_tipo_menu, stock_real, stock_piso, stock_techo FROM tipo_menu WHERE id_tipo_menu IN (SELECT id_tipo_menu FROM contiene WHERE id_pedido = $arregloIds[$z])";
            $guardarDatosStock = mysqli_query($con, $consultaStock);

            $filaStock = $guardarDatosStock->fetch_assoc();

            if ($filaStock === null) {
                $stockPiso = 0;
                $stockTecho = 0;
                $stockReal = 0;
            } else {
                $idMenu = $filaStock["id_tipo_menu"];
                $stockPiso = $filaStock["stock_piso"];
                $stockTecho = $filaStock["stock_techo"];
                $stockReal = $filaStock["stock_real"];
            }

            $guardarEstadoCajaMenu = "SELECT id_estado_caja_menu, id_caja_menu FROM se_halla WHERE id_caja_menu IN (SELECT id_caja_menu FROM lleva WHERE id_pedido = $idPedido) AND fecha_fin IS NULL";
            $resultadoEstadoCajaMenu = mysqli_query($con, $guardarEstadoCajaMenu);

            if ($resultadoEstadoCajaMenu) {
                while ($fila = mysqli_fetch_assoc($resultadoEstadoCajaMenu)) {
                    $idEstadoCajaMenu = $fila['id_estado_caja_menu'];
                    $idCajaMenu = $fila['id_caja_menu'];
                    // echo "ID de Estado Caja Menú: " . $idEstadoCajaMenu . "<br>";
                }
            } else {
                echo "Error en la consulta: " . mysqli_error($con);
            }

            if($arregloEstados[$z] == 0) {
                $estado = "Solicitado";
                $boton = "<button type='submit' name='btnEstado' value='3'>Cancelar Pedido</button>";

            } else if($arregloEstados[$z] == 1) {
                $estado = "En preparación";
                $boton = "<button type='submit' name='btnEstado' value='3'>Cancelar Pedido</button>";
            } else if($arregloEstados[$z] == 2) {
                $estado = "Preparado";
                $boton = "<button type='submit' name='btnEstado' value='3'>Cancelar Pedido</button>";

            } else if($arregloEstados[$z] == 3) {
                $estado = "Cancelado";
                $boton = "<button type='text'>Pedido Cancelado</button>";

            } else if($arregloEstados[$z] == 4) {
                $estado = "En camino";
                $boton = "<button type='submit' name='btnEstado' value='3'>Cancelar Pedido</button>";

            } else if($arregloEstados[$z] == 5) {
                $estado = "Entregado";
                $boton = "<button type='text'>Pedido Entregado</button>";

            } else if($arregloEstados[$z] == 6) {
                $estado = "Devuelto";
                $boton = "<button type='text'>Pedido Devuelto</button>";

            } else if($arregloEstados[$z] == 7) {
                $estado = "Rechazado";
                $boton = "<button type='text'>Pedido Rechazado</button>";

            }

            if ($i == 1) {
                echo "  <section class='contenedorPedidos'>";
                echo "   <article class='subContenedorPedidos'>";
                echo "       <div class='subContenedorTitulo'>";
                echo "          #$idPedido";
                echo "       </div>";
                echo "           <form action='../../datos/pedidos.php' class='formContainer' method='post' enctype='multipart/form-data' class='formDieta'>";
                echo "              <div class='divContainerDatos'>";
                echo "                   <h2>Cliente</h2>";
                echo "                   <div class='divDatosPedido'>";
                echo "                      <p>$primerNombre - $idCliente</p>";
                echo "                      <p>Estado: $estado</p>";
                // echo "                      <p>Fecha</p>";
                echo "                  </div>";

                    echo "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo "<input type='hidden' name='idpedido' value='$idPedido'>";
                    echo "<input type='hidden' name='stocktecho' value='$stockTecho'>";
                        echo "$boton";
                    
                echo "              </div>";
                echo "              <div class='subComboMenus'>";
                echo "                   <h2>$nombreMenu</h2>";
                echo "                   <img src='../../recursos/img/greenSquare.png' alt=''>";
                echo "                   <div class='opcMenu'>";
                // echo "                   <input type='hidden' name='idmenu' value=''>";
                echo "                   <p>Real $stockReal Piso $stockPiso Techo $stockTecho</p>";
                echo "               </div>";
                echo "           </form>";
                echo "   </article>";
                $i++;
            } else if($i == 2) {
                echo "   <article class='subContenedorPedidos'>";
                echo "       <div class='subContenedorTitulo'>";
                echo "          #$idPedido";
                echo "       </div>";
                echo "           <form action='../../datos/pedidos.php' class='formContainer'  method='post' enctype='multipart/form-data' class='formDieta'>";
                echo "              <div class='divContainerDatos'>";
                echo "                   <h2>Cliente</h2>";
                echo "                   <div class='divDatosPedido'>";
                echo "                      <p>$primerNombre - $idCliente</p>";
                echo "                      <p>Estado: Solicitado</p>";
                // echo "                      <p>Fecha</p>";
                echo "                  </div>";
                echo "                  <input type='hidden' name='idmenu' value='$idMenu'>";
                echo "                  <input type='hidden' name='idpedido' value='$idPedido'>";
                echo "                  <input type='hidden' name='stocktecho' value='$stockTecho'>";

                echo "$boton";

                echo "              </div>";
                echo "              <div class='subComboMenus'>";
                echo "                   <h2>$nombreMenu</h2>";
                echo "                   <img src='../../recursos/img/greenSquare.png' alt=''>";
                echo "                   <div class='opcMenu'>";
                // echo "                   <input type='hidden' name='idmenu' value=''>";
                    echo "                   <p>Real $stockReal Piso $stockPiso Techo $stockTecho</p>";
                echo "               </div>";
                echo "           </form>";
                echo "   </article>";
                echo "   </section>";
                $i = 1;
            } else {
                $i = 1;
            }
        }
        if($i != 1 || $i != 3){
            echo "   </section>";
            $i = 1;
        }
    } else {
        echo "<h1>No existen Pedidos</h1>";
    }
    // echo "$cantidad4";

   

?>
    <script src="../../recursos/js/cliente/productoModal.js"></script>
</body>
</html>