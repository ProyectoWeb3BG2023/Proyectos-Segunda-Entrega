<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();

    $menuId = $_GET['id'];
    $idCliente = $_SESSION['identificadorCliente'];
    // echo $menuId;

    $datosMenu = "SELECT nombre, precio, autorizacion, descripcion FROM tipo_menu WHERE id_tipo_menu = $menuId";
    $resultadoDatosMenu = mysqli_query($con, $datosMenu);

    $platos = "SELECT comida.nombre FROM comida WHERE comida.id_comida IN (SELECT `id_comida` FROM `integra` WHERE id_tipo_menu = $menuId)";
    $resultadoPlatos = mysqli_query($con, $platos);

    $cantidadComida = "SELECT cantidad_comida, personalizado FROM integra WHERE id_tipo_menu = $menuId GROUP BY cantidad_comida";
    $resultadoCantidad = mysqli_query($con, $cantidadComida);

    $guardarTarjetas = "SELECT tipo_de_tarjeta FROM metodo_de_pago WHERE numero_tarjeta 
                        IN (SELECT numero_tarjeta 
                                FROM posee 
                                WHERE id_cliente = $idCliente ) 
                                AND estado = 0";
    $resultadoTarjetas = mysqli_query($con, $guardarTarjetas);


    $tipo = array();
    if(mysqli_num_rows($resultadoTarjetas) > 0){
        while($row = mysqli_fetch_array($resultadoTarjetas)){
            $tipo[] = $row["tipo_de_tarjeta"];
        }
        $pago = 1;
    } else {
        $pago = 0;
    }

    if ($resultadoDatosMenu) {
        while ($fila = mysqli_fetch_assoc($resultadoDatosMenu)) {
            $nombreMenu = $fila['nombre'];
            $precioMenu = $fila['precio'];
            $autorizacionMenu = $fila['autorizacion'];
            if(isset($fila['descripcion'])){
                $descripcionMenu = $fila['descripcion'];
            }
            var_dump($autorizacionMenu);
        }
    } else {
        echo "Error en la consulta";
    }

    $platos = array();
    if ($resultadoPlatos) {
        while ($fila = mysqli_fetch_assoc($resultadoPlatos)) {
            $platos[] = $fila['nombre'];
        }
    } else {
        echo "Error en la consulta";
    }

    if ($resultadoCantidad) {
        while ($fila = mysqli_fetch_assoc($resultadoCantidad)) {
            $cantidad = $fila['cantidad_comida'];
            $personalizado = $fila['personalizado'];
            var_dump($personalizado);
        }
    } else {
        echo "Error en la consulta";
    }

    var_dump($cantidad);

    if($autorizacionMenu == 1 ) {
        if ($cantidad == 5) {
            echo "<section class='modal modal--show'>";
            echo    "<div class='modal__container'>";
            echo       "<article class='modal__subContainer'>";
            echo          "<img src='../../recursos/img/Green.png' class='modal__img'>";
            echo          "<p class='modal__price'>$" . $precioMenu . "</p>";
            echo       "</article>";
            echo       "<article class='modal__subContainer2'>";
            echo         "<div>";
            echo            "<h3 class='modal__title'>" . $nombreMenu . "</h3>";
                            if(isset($descripcionMenu)){
                                echo "<p class='modal__paragraph'>" . $descripcionMenu . "</p>";
                            }
            echo         "</div>";
            echo         "<h4 class='modal__platos'>Platos del Menu:</h4>";
            echo         "<div class='modal__datos1 '>";
            echo            "<ul>";
            echo                "<li>" . $platos[0] . "</li>";
            echo                "<li>" . $platos[1] . "</li>";
            echo                "<li>" . $platos[2] . "</li>";
            echo                "<li>" . $platos[3] . "</li>";
            echo                "<li>" . $platos[4] . "</li>";
            echo            "</ul>";
            echo         "</div>";
            echo       "</article>";
            echo       "<article class='modal__subContainer3'>";
            echo         "<div>";
            echo            "<a href='' class='modal__close'>&times;</a>";
            echo            "<h3 class='modal__title'>Pago</h3>";
            echo         "</div>";                                    
            echo         "<div class='modal__datos2'>";
                            if($pago == 1) {
            echo                "<form action='../../datos/compra.php' class='form'  method='post' enctype='multipart/form-data'>";
            echo                    "<input type='hidden' name='idmenu' id='a' value='$menuId'>";
            echo                    "<input type='hidden' name='personalizado' id='a' value='$personalizado'>";
                                    $p = 0;
                                    foreach($tipo as $tarjeta) {
            echo                        "<label for='$p'>" . $tarjeta . "</label>";
            echo                        "<input id='$p' type='radio' name='r' value='$p' checked=''>";
                                        $p++;
                                    }
            echo                    "<button class='Btn' type='submit' name='btnCompra' value='0'>
                                        Pagar
                                        <svg class='svgIcon' viewBox='0 0 576 512'><path d='M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z'></path></svg>
                                    </button>";
            echo                "</form>";
                            } else {
            echo                "<form action='../../datos/compra.php' class='modal__form'  method='post' enctype='multipart/form-data'>";
            echo                    "<input type='hidden' name='idmenu' id='a' value='$menuId'>";
            echo                    "<input type='hidden' name='personalizado' id='bb' value='$personalizado'>";
            echo                    "<label for='tipoTarjeta'>Tipo de Tarjeta:</label>";
            echo                    "<select id='tipoTarjeta' name='opcionTarjeta'>";
            echo                        "<option value='Visa'>Visa</option>";
            echo                        "<option value='MasterCard'>MasterCard</option>";
            echo                        "<option value='American Express'>American Express</option>";
            echo                        "<option value='Discover'>Discover</option>";
            echo                        "<option value='Diners Club'>Diners Club</option>";
            echo                        "<option value='JCB'>JCB</option>";
            echo                        "<option value='Maestro'>Maestro</option>";
            echo                    "</select>";
            echo                    "<label for=''>Número de la Tarjeta:</label>";
            echo                    "<input type='number' class='input' name='numerotarjeta' id='b' placeholder='Número...' required>";
            echo                    "<button type='submit' name='btnCompra' value='1'>Comprar</button>";
            echo                "</form>";
                            }
            echo            "</div>";
            echo        "</article>";
            echo   "</div>";
            echo "</section>";
        } elseif( $cantidad == 10 ) {
            echo "<section class='modal modal--show'>";
            echo    "<div class='modal__container'>";
            echo        "<article class='modal__subContainer'>";
            echo            "<img src='../../recursos/img/Green.png' class='modal__img'>";
            echo            "<p class='modal__price'>$" . $precioMenu . "</p>";
            echo       "</article>";
            echo        "<article class='modal__subContainer2'>";
            echo          "<div>";
            echo                "<h3 class='modal__title'>" . $nombreMenu . "</h3>";
                                if(isset($descripcionMenu)){
                                    echo "<p class='modal__paragraph'>" . $descripcionMenu . "</p>";
                                }
            echo          "</div>";
            echo              "<h4 class='modal__platos'>Platos del Menu:</h4>";
            echo                "<div class='modal__datos1 '>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[0] . "</li>";
            echo                        "<li>" . $platos[1] . "</li>";
            echo                        "<li>" . $platos[2] . "</li>";
            echo                        "<li>" . $platos[3] . "</li>";
            echo                        "<li>" . $platos[4] . "</li>";
            echo                    "</ul>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[5] . "</li>";
            echo                        "<li>" . $platos[6] . "</li>";
            echo                        "<li>" . $platos[7] . "</li>";
            echo                        "<li>" . $platos[8] . "</li>";
            echo                        "<li>" . $platos[9] . "</li>";
            echo                    "</ul>";
            echo                  "</div>";
            echo      "</article>";
            echo        "<article class='modal__subContainer3'>";
            echo        "<a href='' class='modal__close'>&times;</a>";
            echo            "<h3 class='modal__title'>Pago</h3>";
            echo            "<div class='modal__datos2'>";
                                if($pago == 1) {
            echo                    "<form action='../../datos/compra.php' class='form'  method='post' enctype='multipart/form-data'>";
            echo                        "<input type='hidden' name='idmenu' id='a' value='$menuId'>";
            echo                        "<input type='hidden' name='personalizado' id='a' value='$personalizado'>";

                                        $p = 0;
                                        foreach($tipo as $tarjeta) {
            echo                            "<label for='$p'>" . $tarjeta . "</label>";
            echo                            "<input id='$p' type='radio' name='r' value='$p' checked=''>";
                                            $p++;
                                        }
            echo                        "<button class='Btn' type='submit' name='btnCompra' value='0'>
                                            Pagar
                                            <svg class='svgIcon' viewBox='0 0 576 512'><path d='M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z'></path></svg>
                                        </button>";
            echo                            "</form>";
                                    } else {
            echo                        "<form action='../../datos/compra.php' class='modal__form'  method='post' enctype='multipart/form-data'>";
            echo                            "<input type='hidden' name='idmenu' id='a' value='$menuId'>";
            echo                            "<input type='hidden' name='personalizado' id='bb' value='$personalizado'>";
            echo                            "<label for='tipoTarjeta'>Tipo de Tarjeta:</label>";
            echo                            "<select id='tipoTarjeta' name='opcionTarjeta'>";
            echo                                "<option value='Visa'>Visa</option>";
            echo                                "<option value='MasterCard'>MasterCard</option>";
            echo                                "<option value='American Express'>American Express</option>";
            echo                                "<option value='Discover'>Discover</option>";
            echo                                "<option value='Diners Club'>Diners Club</option>";
            echo                                "<option value='JCB'>JCB</option>";
            echo                                "<option value='Maestro'>Maestro</option>";
            echo                            "</select>";
            echo                        "   <label for=''>Número de la Tarjeta:</label>";
            echo                        "   <input type='number' class='input' name='numerotarjeta' id='b' placeholder='Número...' required>";
            echo                        "   <button type='submit' name='btnCompra' value='1'>Comprar</button>";
            echo                        "</form>";
                                    }
            echo          "</div>";
            echo      "</article>";
            echo   "</div>";
            echo "</section>";
        } else {
            echo    "<section class='modal modal--show'>";
            echo   "<div class='modal__container'>";
            echo        "<article class='modal__subContainer'>";
            echo            "<img src='../../recursos/img/Green.png' class='modal__img'>";
            echo            "<p class='modal__price'>$" . $precioMenu . "</p>";
            echo       "</article>";
            echo        "<article class='modal__subContainer2'>";
            echo          "<div>";
            echo                "<h3 class='modal__title'>" . $nombreMenu . "</h3>";
                                if(isset($descripcionMenu)){
                                    echo "<p class='modal__paragraph'>" . $descripcionMenu . "</p>";
                                }
            echo            "</div>";
            echo              "<h4 class='modal__platos'>Platos del Menu:</h4>";
            echo                "<div class='modal__datos1'>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[0] . "</li>";
            echo                        "<li>" . $platos[1] . "</li>";
            echo                        "<li>" . $platos[2] . "</li>";
            echo                        "<li>" . $platos[3] . "</li>";
            echo                        "<li>" . $platos[4] . "</li>";
            echo                    "</ul>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[5] . "</li>";
            echo                        "<li>" . $platos[6] . "</li>";
            echo                        "<li>" . $platos[7] . "</li>";
            echo                        "<li>" . $platos[8] . "</li>";
            echo                        "<li>" . $platos[9] . "</li>";
            echo                    "</ul>";
            echo                  "</div>";
            echo                "<div class='modal__datos1'>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[10] . "</li>";
            echo                        "<li>" . $platos[11] . "</li>";
            echo                        "<li>" . $platos[12] . "</li>";
            echo                        "<li>" . $platos[13] . "</li>";
            echo                        "<li>" . $platos[14] . "</li>";
            echo                    "</ul>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[15] . "</li>";
            echo                        "<li>" . $platos[16] . "</li>";
            echo                        "<li>" . $platos[17] . "</li>";
            echo                        "<li>" . $platos[18] . "</li>";
            echo                        "<li>" . $platos[19] . "</li>";
            echo                    "</ul>";
            echo                  "</div>";
            echo      "</article>";
            echo        "<article class='modal__subContainer3'>";
            echo           "<div>";
            echo            "<a href='' class='modal__close'>&times;</a>";
            echo            "<h3 class='modal__title'>Pago</h3>";
            echo           "</div>";

            echo            "<div class='modal__datos2'>";
                                if($pago == 1) {
            echo                    "<form action='../../datos/compra.php' class='form'  method='post' enctype='multipart/form-data'>";
            echo                        "<input type='hidden' name='idmenu' id='a' value='$menuId'>";
            echo                        "<input type='hidden' name='personalizado' id='bb' value='$personalizado'>";
                                        $p = 0;
                                        foreach($tipo as $tarjeta) {
            echo                            "<label for='$p'>" . $tarjeta . "</label>";
            echo                            "<input id='$p' type='radio' name='r' value='$p' checked=''>";
                                            $p++;
                                        }
            echo                        "<button class='Btn' type='submit' name='btnCompra' value='0'>
                                            Pagar
                                            <svg class='svgIcon' viewBox='0 0 576 512'><path d='M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z'></path></svg>
                                        </button>";
            echo                            "</form>";
                                    } else {
            echo                        "<form action='../../datos/compra.php' class='modal__form'  method='post' enctype='multipart/form-data'>";
            echo                            "<input type='hidden' name='idmenu' id='a' value='$menuId'>";
            echo                            "<input type='hidden' name='personalizado' id='bb' value='$personalizado'>";
            echo                            "<label for='tipoTarjeta'>Tipo de Tarjeta:</label>";
            echo                            "<select id='tipoTarjeta' name='opcionTarjeta'>";
            echo                                "<option value='Visa'>Visa</option>";
            echo                                "<option value='MasterCard'>MasterCard</option>";
            echo                                "<option value='American Express'>American Express</option>";
            echo                                "<option value='Discover'>Discover</option>";
            echo                                "<option value='Diners Club'>Diners Club</option>";
            echo                                "<option value='JCB'>JCB</option>";
            echo                                "<option value='Maestro'>Maestro</option>";
            echo                            "</select>";
            echo                        "   <label for=''>Número de la Tarjeta:</label>";
            echo                        "   <input type='number' class='input' name='numerotarjeta' id='b' placeholder='Número...' required>";
            echo                        "   <button type='submit' name='btnCompra' value='1'>Comprar</button>";
            echo                        "</form>";
                                    }
            echo          "</div>";
            echo      "</article>";
            echo   "</div>";
            echo "</section>";
        }
    } else if($autorizacionMenu == 0){
        if ($cantidad == 5) {
            echo    "<section class='modal modal--show'>";
            echo   "<div class='modal__container'>";
            echo        "<article class='modal__subContainer'>";
            echo            "<img src='../../recursos/img/Green.png' class='modal__img'>";
            echo            "<p class='modal__price'>$" . $precioMenu . "</p>";
            echo       "</article>";
            echo        "<article class='modal__subContainer2'>";
            echo        "<a href='' class='modal__close'>&times;</a>";
            echo          "<div>";
            echo                "<h3 class='modal__title'>" . $nombreMenu . "</h3>";
                                if(isset($descripcionMenu)){
                                    echo "<p class='modal__paragraph'>" . $descripcionMenu . "</p>";
                                }
            echo          "</div>";
            echo              "<h4 class='modal__platos'>Platos del Menu:</h4>";
            echo                "<div class='modal__datos1'>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[0] . "</li>";
            echo                        "<li>" . $platos[1] . "</li>";
            echo                        "<li>" . $platos[2] . "</li>";
            echo                        "<li>" . $platos[3] . "</li>";
            echo                        "<li>" . $platos[4] . "</li>";
            echo                    "</ul>";
            echo                  "</div>";
            echo      "</article>";
            echo   "</div>";
            echo "</section>";

        } elseif( $cantidad == 10 ) {
            echo    "<section class='modal modal--show'>";
            echo   "<div class='modal__container'>";
            echo        "<article class='modal__subContainer'>";
            echo            "<img src='../../recursos/img/Green.png' class='modal__img'>";
            echo            "<p class='modal__price'>$" . $precioMenu . "</p>";
            echo       "</article>";
            echo        "<article class='modal__subContainer2'>";
            echo        "<a href='' class='modal__close'>&times;</a>";
            echo          "<div>";
            echo                "<h3 class='modal__title'>" . $nombreMenu . "</h3>";
                                if(isset($descripcionMenu)){
                                    echo "<p class='modal__paragraph'>" . $descripcionMenu . "</p>";
                                }
            echo          "</div>";
            echo              "<h4 class='modal__platos'>Platos del Menu:</h4>";
            echo                "<div class='modal__datos1'>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[0] . "</li>";
            echo                        "<li>" . $platos[1] . "</li>";
            echo                        "<li>" . $platos[2] . "</li>";
            echo                        "<li>" . $platos[3] . "</li>";
            echo                        "<li>" . $platos[4] . "</li>";
            echo                    "</ul>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[5] . "</li>";
            echo                        "<li>" . $platos[6] . "</li>";
            echo                        "<li>" . $platos[7] . "</li>";
            echo                        "<li>" . $platos[8] . "</li>";
            echo                        "<li>" . $platos[9] . "</li>";
            echo                    "</ul>";
            echo                "</div>";
            echo      "</article>";
            
            echo   "</div>";
            echo "</section>";
        } else {
            echo    "<section class='modal modal--show'>";
            echo   "<div class='modal__container'>";
            echo        "<article class='modal__subContainer'>";
            echo            "<img src='../../recursos/img/Green.png' class='modal__img'>";
            echo            "<p class='modal__price'>$" . $precioMenu . "</p>";
            echo       "</article>";
            echo        "<article class='modal__subContainer2'>";
            echo        "<a href='' class='modal__close'>&times;</a>";
            echo          "<div>";
            echo                "<h3 class='modal__title'>" . $nombreMenu . "</h3>";
                                if(isset($descripcionMenu)){
                                    echo "<p class='modal__paragraph'>" . $descripcionMenu . "</p>";
                                }
            echo          "</div>";
            echo                "<h4 class='modal__platos'>Platos del Menu:</h4>";
            echo                "<div class='modal__datos1'>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[0] . "</li>";
            echo                        "<li>" . $platos[1] . "</li>";
            echo                        "<li>" . $platos[2] . "</li>";
            echo                        "<li>" . $platos[3] . "</li>";
            echo                        "<li>" . $platos[4] . "</li>";
            echo                    "</ul>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[5] . "</li>";
            echo                        "<li>" . $platos[6] . "</li>";
            echo                        "<li>" . $platos[7] . "</li>";
            echo                        "<li>" . $platos[8] . "</li>";
            echo                        "<li>" . $platos[9] . "</li>";
            echo                    "</ul>";
            echo                  "</div>";
            echo                "<div class='modal__datos1'>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[10] . "</li>";
            echo                        "<li>" . $platos[11] . "</li>";
            echo                        "<li>" . $platos[12] . "</li>";
            echo                        "<li>" . $platos[13] . "</li>";
            echo                        "<li>" . $platos[14] . "</li>";
            echo                    "</ul>";
            echo                    "<ul>";
            echo                        "<li>" . $platos[15] . "</li>";
            echo                        "<li>" . $platos[16] . "</li>";
            echo                        "<li>" . $platos[17] . "</li>";
            echo                        "<li>" . $platos[18] . "</li>";
            echo                        "<li>" . $platos[19] . "</li>";
            echo                    "</ul>";
            echo                  "</div>";
            echo      "</article>";
            echo   "</div>";
            echo "</section>";
    }
}
?>
