<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();
    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }

    ///////////////////////////////////////////// Solicitados /////////////////////////////////////////////
    $idsPedidos0 = "SELECT id_pedido FROM se_encuentra WHERE id_estado_pedido = 0 AND fecha_fin IS NULL";
    $guardarIds0 = mysqli_query($con, $idsPedidos0);

    $arregloIds0 = array();
    while ($arreglo = mysqli_fetch_array($guardarIds0)) {
        $arregloIds0[] = $arreglo["id_pedido"];
    }
    $cantidad0 = count($arregloIds0);

    ///////////////////////////////////////////// En preparación /////////////////////////////////////////////
    $idsPedidos1 = "SELECT id_pedido FROM se_encuentra WHERE id_estado_pedido = 1 AND fecha_fin IS NULL";
    $guardarIds1 = mysqli_query($con, $idsPedidos1);

    $arregloIds1 = array();
    while ($arreglo = mysqli_fetch_array($guardarIds1)) {
        $arregloIds1[] = $arreglo["id_pedido"];
    }
    $cantidad1 = count($arregloIds1);

    ///////////////////////////////////////////// Preparado ///////////////////////////////////////////// 
    $idsPedidos2 = "SELECT id_pedido FROM se_encuentra WHERE id_estado_pedido = 2 AND fecha_fin IS NULL";
    $guardarIds2 = mysqli_query($con, $idsPedidos2);

    $arregloIds2 = array();
    while ($arreglo = mysqli_fetch_array($guardarIds2)) {
        $arregloIds2[] = $arreglo["id_pedido"];
    }
    $cantidad2 = count($arregloIds2);

    ///////////////////////////////////////////// Cancelado ///////////////////////////////////////////// 
    $idsPedidos3 = "SELECT id_pedido FROM se_encuentra WHERE id_estado_pedido = 3 AND fecha_fin IS NULL";
    $guardarIds3 = mysqli_query($con, $idsPedidos3);

    $arregloIds3 = array();
    while ($arreglo = mysqli_fetch_array($guardarIds3)) {
        $arregloIds3[] = $arreglo["id_pedido"];
    }
    $cantidad3 = count($arregloIds3);

    ///////////////////////////////////////////// Enviado/En camino ///////////////////////////////////////////// 
    $idsPedidos4 = "SELECT id_pedido FROM se_encuentra WHERE id_estado_pedido = 4 AND fecha_fin IS NULL";
    $guardarIds4 = mysqli_query($con, $idsPedidos4);

    $arregloIds4 = array();
    while ($arreglo = mysqli_fetch_array($guardarIds4)) {
        $arregloIds4[] = $arreglo["id_pedido"];
    }
    $cantidad4 = count($arregloIds4);

    ///////////////////////////////////////////// Entregado ///////////////////////////////////////////// 
    $idsPedidos5 = "SELECT id_pedido FROM se_encuentra WHERE id_estado_pedido = 5 AND fecha_fin IS NULL";
    $guardarIds5 = mysqli_query($con, $idsPedidos5);

    $arregloIds5 = array();
    while ($arreglo = mysqli_fetch_array($guardarIds5)) {
        $arregloIds5[] = $arreglo["id_pedido"];
    }
    $cantidad5 = count($arregloIds5);

    ///////////////////////////////////////////// Entregado ///////////////////////////////////////////// 
    $idsPedidos6 = "SELECT id_pedido FROM se_encuentra WHERE id_estado_pedido = 6 AND fecha_fin IS NULL";
    $guardarIds6 = mysqli_query($con, $idsPedidos6);

    $arregloIds6 = array();
    while ($arreglo = mysqli_fetch_array($guardarIds6)) {
        $arregloIds6[] = $arreglo["id_pedido"];
    }
    $cantidad6 = count($arregloIds6);

    ///////////////////////////////////////////// Rechazados /////////////////////////////////////////////
    $idsPedidos2 = "SELECT id_pedido FROM se_encuentra WHERE id_estado_pedido = 7 AND fecha_fin IS NULL";
    $guardarIds7 = mysqli_query($con, $idsPedidos2);

    $arregloIds7 = array();
    while ($arreglo = mysqli_fetch_array($guardarIds7)) {
        $arregloIds7[] = $arreglo["id_pedido"];
    }
    $cantidad7 = count($arregloIds7);
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    
    
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
    
    <link rel="stylesheet" href="../../recursos/css/jefeCocina/stylePedidos.css">

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

<?php
    if ($cantidad0 > 0) {
        echo "<h1>Pedidos - Solicitados - 0</h1>";
        $i = 1;
        for( $z = 0 ; $z < $cantidad0 ; $z++){
            $datosPedido = "SELECT pedido.id_pedido, pedido.costo, pedido.descripcion, cliente.primer_nombre, cliente.id_cliente 
                        FROM pedido, cliente 
                        WHERE id_pedido IN (SELECT id_pedido 
                                            FROM hace
                                            WHERE id_pedido = $arregloIds0[$z])
                        AND id_cliente IN (SELECT id_cliente
                                    FROM hace 
                                    WHERE id_pedido = $arregloIds0[$z])
                        ORDER BY `pedido`.`id_pedido` ASC";

            $guardarDatosPedido = mysqli_query($con, $datosPedido);

            while ($fila = mysqli_fetch_assoc($guardarDatosPedido)) {
                $idPedido = $fila["id_pedido"];
                $costoPedido = $fila["costo"];
                $nombreMenu = $fila["descripcion"];
                $primerNombre = $fila["primer_nombre"];
                $idCliente = $fila["id_cliente"];
            }

            $consultaStock = "SELECT id_tipo_menu, stock_real, stock_piso, stock_techo FROM tipo_menu WHERE id_tipo_menu IN (SELECT id_tipo_menu FROM contiene WHERE id_pedido = $arregloIds0[$z])";
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
                echo "                      <p>Estado: Solicitado</p>";
                // echo "                      <p>Fecha</p>";
                echo "                  </div>";
                    echo "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo "<input type='hidden' name='idpedido' value='$idPedido'>";
                    echo "<input type='hidden' name='stocktecho' value='$stockTecho'>";

                    
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
                                        echo "<input type='hidden' name='idmenu' value='$idMenu'>";
                                        echo "<input type='hidden' name='idpedido' value='$idPedido'>";
                                        echo "<input type='hidden' name='stocktecho' value='$stockTecho'>";

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
                echo "   </section>";
                $i = 1;
            }

        } if($i == 2){
            echo "   </section>";

            $i = 1;
        }
        
    } else {
        echo "<h1>No existen Pedidos Solicitados actualmente</h1>";
    }
?>
            
            <!-- c -->
            
<?php
    if ($cantidad1 > 0) {
        echo "<h1>Pedidos - En Producción - 1</h1>";
        $i = 1;
        for( $z = 0 ; $z < $cantidad1 ; $z++){
            $datosPedido = "SELECT pedido.id_pedido, pedido.costo, pedido.descripcion, cliente.primer_nombre, cliente.id_cliente 
                        FROM pedido, cliente 
                        WHERE id_pedido IN (SELECT id_pedido 
                                            FROM hace
                                            WHERE id_pedido = $arregloIds1[$z])
                        AND id_cliente IN (SELECT id_cliente
                                    FROM hace 
                                    WHERE id_pedido = $arregloIds1[$z])
                        ORDER BY `pedido`.`id_pedido` ASC";

            $guardarDatosPedido = mysqli_query($con, $datosPedido);

            while ($fila = mysqli_fetch_assoc($guardarDatosPedido)) {
                $idPedido = $fila["id_pedido"];
                $costoPedido = $fila["costo"];
                $nombreMenu = $fila["descripcion"];
                $primerNombre = $fila["primer_nombre"];
                $idCliente = $fila["id_cliente"];
            }

            $consultaStock = "SELECT id_tipo_menu, stock_real, stock_piso, stock_techo FROM tipo_menu WHERE id_tipo_menu IN (SELECT id_tipo_menu FROM contiene WHERE id_pedido = $arregloIds1[$z])";
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
                echo "                      <p>Estado: En Producción</p>";
                // echo "                      <p>Fecha</p>";
                echo "                  </div>";
                    echo "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo "<input type='hidden' name='idpedido' value='$idPedido'>";
                    echo "<input type='hidden' name='stocktecho' value='$stockTecho'>";

                   
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
                echo "                      <p>Estado: En Producción</p>";
                // echo "                      <p>Fecha</p>";
                echo "                  </div>";
                echo "                  <input type='hidden' name='idmenu' value='$idMenu'>";
                echo "                  <input type='hidden' name='idpedido' value='$idPedido'>";
                echo "                  <input type='hidden' name='stocktecho' value='$stockTecho'>";

                echo "              </div>";
                echo "              <div class='subComboMenus'>";
                echo "                   <h2>$nombreMenu</h2>";
                echo "                   <img src='../../recursos/img/greenSquare.png' alt=''>";
                echo "                   <div class='opcMenu'>";
                // // echo "                   <input type='hidden' name='idmenu' value=''>";
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
        if($i == 2){
            echo "   </section>";
            $i = 1;
        }
    } else {
        echo "<h1>No existen Pedidos En Producción actualmente</h1>";
    }
?>
            
            <!-- c -->

<?php
        if ($cantidad2 > 0) {
            echo "<h1>Pedidos - Preparados/Listos - 2</h1>";
            $i = 1;
            for( $z = 0 ; $z < $cantidad2 ; $z++){
                $datosPedido = "SELECT pedido.id_pedido, pedido.costo, pedido.descripcion, cliente.primer_nombre, cliente.id_cliente 
                            FROM pedido, cliente 
                            WHERE id_pedido IN (SELECT id_pedido 
                                                FROM hace
                                                WHERE id_pedido = $arregloIds2[$z])
                            AND id_cliente IN (SELECT id_cliente
                                        FROM hace 
                                        WHERE id_pedido = $arregloIds2[$z])
                            ORDER BY `pedido`.`id_pedido` ASC";

                $guardarDatosPedido = mysqli_query($con, $datosPedido);

                while ($fila = mysqli_fetch_assoc($guardarDatosPedido)) {
                    $idPedido = $fila["id_pedido"];
                    $costoPedido = $fila["costo"];
                    $nombreMenu = $fila["descripcion"];
                    $primerNombre = $fila["primer_nombre"];
                    $idCliente = $fila["id_cliente"];
                }

                $consultaStock = "SELECT id_tipo_menu, stock_real, stock_piso, stock_techo FROM tipo_menu WHERE id_tipo_menu IN (SELECT id_tipo_menu FROM contiene WHERE id_pedido = $arregloIds2[$z])";
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
                    echo "                      <p>Estado: Solicitado</p>";
                    // echo "                      <p>Fecha</p>";
                    echo "                  </div>";
                        echo "<input type='hidden' name='idmenu' value='$idMenu'>";
                        echo "<input type='hidden' name='idpedido' value='$idPedido'>";

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
            if($i == 2){
                echo "   </section>";
                $i = 1;
            }
        } else {
            echo "<h1>No existen Pedidos Listos/Preparados actualmente</h1>";
        }
    // echo "$cantidad2";
    if ($guardarIds0) {
        // echo "Bien";
    }
?>

<?php
    if ($cantidad3 > 0) {
        echo "<h1>Pedidos - Cancelados - 3</h1>";
        $i = 1;
        for( $z = 0 ; $z < $cantidad3 ; $z++){
            $datosPedido = "SELECT pedido.id_pedido, pedido.costo, pedido.descripcion, cliente.primer_nombre, cliente.id_cliente 
                        FROM pedido, cliente 
                        WHERE id_pedido IN (SELECT id_pedido 
                                            FROM hace
                                            WHERE id_pedido = $arregloIds3[$z])
                        AND id_cliente IN (SELECT id_cliente
                                    FROM hace 
                                    WHERE id_pedido = $arregloIds3[$z])
                        ORDER BY `pedido`.`id_pedido` ASC";

            $guardarDatosPedido = mysqli_query($con, $datosPedido);

            while ($fila = mysqli_fetch_assoc($guardarDatosPedido)) {
                $idPedido = $fila["id_pedido"];
                $costoPedido = $fila["costo"];
                $nombreMenu = $fila["descripcion"];
                $primerNombre = $fila["primer_nombre"];
                $idCliente = $fila["id_cliente"];
            }
            //  c
            $consultaStock = "SELECT id_tipo_menu, stock_real, stock_piso, stock_techo FROM tipo_menu WHERE id_tipo_menu IN (SELECT id_tipo_menu FROM contiene WHERE id_pedido = $arregloIds3[$z])";
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

            // Verificar la cantidad de estados del pedido para tomar acciones con la Caja que se envasó

            $guardarEstados = "SELECT id_estado_pedido FROM se_encuentra WHERE id_pedido = $idPedido";
            $resultadoGuardarEstados = mysqli_query($con, $guardarEstados);

            if ($resultadoGuardarEstados) {
                $cantidadFilas = mysqli_num_rows($resultadoGuardarEstados);
            } else {
                echo "Error en la consulta: " . mysqli_error($con);
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
                echo "                      <p>Estado: Cancelado</p>";
                // echo "                      <p>Fecha</p>";
                echo "                  </div>";
                                        echo "<input type='hidden' name='idmenu' value='$idMenu'>";
                                        echo "<input type='hidden' name='idpedido' value='$idPedido'>";

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
                echo "                      <p>Estado: Cancelado</p>";
                // echo "                      <p>Fecha</p>";
                echo "                  </div>";
                echo "                  <input type='hidden' name='idmenu' value='$idMenu'>";
                echo "                  <input type='hidden' name='idpedido' value='$idPedido'>";

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
        if($i == 2){
            echo "   </section>";
            $i = 1;
        }
    } else {
        echo "<h1>No existen Pedidos Cancelados actualmente</h1>";
    }
// echo "$cantidad3";

if ($guardarIds3) {
    // echo "Bien";
}

?>

<?php
    if ($cantidad4 > 0) {
        echo "<h1>Pedidos - Enviados / En viaje - 4</h1>";
        $i = 1;
        for( $z = 0 ; $z < $cantidad4 ; $z++){
            $datosPedido = "SELECT pedido.id_pedido, pedido.costo, pedido.descripcion, cliente.primer_nombre, cliente.id_cliente 
                        FROM pedido, cliente 
                        WHERE id_pedido IN (SELECT id_pedido 
                                            FROM hace
                                            WHERE id_pedido = $arregloIds4[$z])
                        AND id_cliente IN (SELECT id_cliente
                                    FROM hace 
                                    WHERE id_pedido = $arregloIds4[$z])
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
            $consultaStock = "SELECT id_tipo_menu, stock_real, stock_piso, stock_techo FROM tipo_menu WHERE id_tipo_menu IN (SELECT id_tipo_menu FROM contiene WHERE id_pedido = $arregloIds4[$z])";
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
                echo "                      <p>Estado: Solicitado</p>";
                // echo "                      <p>Fecha</p>";
                echo "                  </div>";

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
                echo "                  <input type='hidden' name='idcajamenu' value='$idCajaMenu'>";
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
        if($i == 2){
            echo "   </section>";
            $i = 1;
        }
    } else {
        echo "<h1>No existen Pedidos Enviados actualmente</h1>";
    }
    // echo "$cantidad4";

    if ($guardarIds3) {
    // echo "Bien";
    }

?>



<?php
    if ($cantidad5 > 0) {
        echo "<h1>Pedidos - Entregados - 5</h1>";
        $i = 1;
        for( $z = 0 ; $z < $cantidad5 ; $z++){
            $datosPedido = "SELECT pedido.id_pedido, pedido.costo, pedido.descripcion, cliente.primer_nombre, cliente.id_cliente 
                        FROM pedido, cliente 
                        WHERE id_pedido IN (SELECT id_pedido 
                                            FROM hace
                                            WHERE id_pedido = $arregloIds5[$z])
                        AND id_cliente IN (SELECT id_cliente
                                    FROM hace 
                                    WHERE id_pedido = $arregloIds5[$z])
                        ORDER BY `pedido`.`id_pedido` ASC";

            $guardarDatosPedido = mysqli_query($con, $datosPedido);

            while ($fila = mysqli_fetch_assoc($guardarDatosPedido)) {
                $idPedido = $fila["id_pedido"];
                $costoPedido = $fila["costo"];
                $nombreMenu = $fila["descripcion"];
                $primerNombre = $fila["primer_nombre"];
                $idCliente = $fila["id_cliente"];
            }

            $consultaStock = "SELECT id_tipo_menu, stock_real, stock_piso, stock_techo FROM tipo_menu WHERE id_tipo_menu IN (SELECT id_tipo_menu FROM contiene WHERE id_pedido = $arregloIds5[$z])";
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
                echo "                      <p>Estado: Rechazado</p>";
                // echo "                      <p>Fecha</p>";
                echo "                  </div>";
                    echo "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo "<input type='hidden' name='idpedido' value='$idPedido'>";

                    echo "<button type='text'>Pedido Entregado</button>";

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
                                        echo "<button type='text'>Pedido Entregado</button>";

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
        if($i == 2){
            echo "   </section>";
            $i = 1;
        }
    } else {
        echo "<h1>No existen Pedidos Entregados actualmente</h1>";
    }
    // echo "$cantidad7";
    if ($guardarIds7) {
        // echo "Bien";
    }
    ?>

<?php
    if ($cantidad6 > 0) {
        echo "<h1>Pedidos - Devueltos - 6</h1>";
        $i = 1;
        for( $z = 0 ; $z < $cantidad6 ; $z++){
            $datosPedido = "SELECT pedido.id_pedido, pedido.costo, pedido.descripcion, cliente.primer_nombre, cliente.id_cliente 
                        FROM pedido, cliente 
                        WHERE id_pedido IN (SELECT id_pedido 
                                            FROM hace
                                            WHERE id_pedido = $arregloIds6[$z])
                        AND id_cliente IN (SELECT id_cliente
                                    FROM hace 
                                    WHERE id_pedido = $arregloIds6[$z])
                        ORDER BY `pedido`.`id_pedido` ASC";

            $guardarDatosPedido = mysqli_query($con, $datosPedido);

            while ($fila = mysqli_fetch_assoc($guardarDatosPedido)) {
                $idPedido = $fila["id_pedido"];
                $costoPedido = $fila["costo"];
                $nombreMenu = $fila["descripcion"];
                $primerNombre = $fila["primer_nombre"];
                $idCliente = $fila["id_cliente"];
            }

            $consultaStock = "SELECT id_tipo_menu, stock_real, stock_piso, stock_techo FROM tipo_menu WHERE id_tipo_menu IN (SELECT id_tipo_menu FROM contiene WHERE id_pedido = $arregloIds6[$z])";
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
                echo "                      <p>Estado: Rechazado</p>";
                // echo "                      <p>Fecha</p>";
                echo "                  </div>";
                    echo "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo "<input type='hidden' name='idpedido' value='$idPedido'>";
                    echo "<input type='hidden' name='idcajamenu' value='$idCajaMenu'>";


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
                echo "                  <input type='hidden' name='idcajamenu' value='$idCajaMenu'>";
                echo "                  <input type='hidden' name='idcajamenu' value='$idCajaMenu'>";
                                        
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
        if($i == 2){
            echo "   </section>";
            $i = 1;
        }
    } else {
        echo "<h1>No existen Pedidos Devueltos actualmente</h1>";
    }
    // echo "$cantidad6";
    if ($guardarIds7) {
        // echo "Bien";
    }
    ?>



<?php
    if ($cantidad7 > 0) {
        echo "<h1>Pedidos - Rechazados - 7</h1>";
        $i = 1;
        for( $z = 0 ; $z < $cantidad7 ; $z++){
            $datosPedido = "SELECT pedido.id_pedido, pedido.costo, pedido.descripcion, cliente.primer_nombre, cliente.id_cliente 
                        FROM pedido, cliente 
                        WHERE id_pedido IN (SELECT id_pedido 
                                            FROM hace
                                            WHERE id_pedido = $arregloIds7[$z])
                        AND id_cliente IN (SELECT id_cliente
                                    FROM hace 
                                    WHERE id_pedido = $arregloIds7[$z])
                        ORDER BY `pedido`.`id_pedido` ASC";

            $guardarDatosPedido = mysqli_query($con, $datosPedido);

            while ($fila = mysqli_fetch_assoc($guardarDatosPedido)) {
                $idPedido = $fila["id_pedido"];
                $costoPedido = $fila["costo"];
                $nombreMenu = $fila["descripcion"];
                $primerNombre = $fila["primer_nombre"];
                $idCliente = $fila["id_cliente"];
            }

            $consultaStock = "SELECT id_tipo_menu, stock_real, stock_piso, stock_techo FROM tipo_menu WHERE id_tipo_menu IN (SELECT id_tipo_menu FROM contiene WHERE id_pedido = $arregloIds7[$z])";
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
                echo "                      <p>Estado: Rechazado</p>";
                // echo "                      <p>Fecha</p>";
                echo "                  </div>";
                    echo "<input type='hidden' name='idmenu' value='$idMenu'>";
                    echo "<input type='hidden' name='idpedido' value='$idPedido'>";

                    echo "<button type='text'>Pedido Rechazado</button>";

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
                                        echo "<button type='text'>Pedido Rechazado</button>";

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
        if($i == 2){
            echo "   </section>";
            $i = 1;
        }
    } else {
        echo "<h1>No existen Pedidos Rechazados actualmente</h1>";
    }
    // echo "$cantidad7";
    if ($guardarIds7) {
        // echo "Bien";
    }
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