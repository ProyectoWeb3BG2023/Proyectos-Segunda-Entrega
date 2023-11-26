<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    if(isset($_POST["btnEstado"])){
        $idMenu = $_POST["idmenu"];
        $idPedido = $_POST["idpedido"];
        $stockTecho = $_POST["stocktecho"];
        $idCajaMenu = $_POST["idcajamenu"];
        
    }

    if(isset($_POST["btnEstado"])){

        if($_POST["btnEstado"] == "1"){
        // Pedido pasa de Solicitado a En Preparación
        // $estado = 1;     dependiendo del estado las tablas que se afectan, cuidado
        $finalizarEstado = "UPDATE `se_encuentra` SET `fecha_fin`= CURDATE() 
                                WHERE id_pedido = $idPedido
                                AND fecha_fin IS NULL";

        $resultadoFinalizacion = mysqli_query($con, $finalizarEstado);

        $nuevoEstado = "INSERT INTO `se_encuentra`(`id_pedido`, `id_estado_pedido`, `fecha_inicio`) 
                            VALUES ($idPedido, 1, CURDATE())";

        $resultadoNuevoEstado = mysqli_query($con, $nuevoEstado);

        } else if($_POST["btnEstado"] == "7"){
            // $estado = 7;
            $finalizarEstado = "UPDATE `se_encuentra` SET `fecha_fin`= CURDATE() 
                                WHERE id_pedido = $idPedido
                                AND fecha_fin IS NULL";

            $resultadoFinalizacion = mysqli_query($con, $finalizarEstado);

            $nuevoEstado = "INSERT INTO `se_encuentra`(`id_pedido`, `id_estado_pedido`, `fecha_inicio`) 
                                VALUES ($idPedido, 7, CURDATE())";

            $resultadoNuevoEstado = mysqli_query($con, $nuevoEstado);

        } else if($_POST["btnEstado"] == "Personalizado") {
            // Es un Pedido de un Menú Personalizado, se debe cambiar 'tiene' y 'se_encuentra'
            // $estado = 3;
            $finalizarEstadoTiene = "UPDATE tiene SET fecha_fin = CURDATE()
                                        WHERE id_tipo_menu = '$idMenu'
                                        AND fecha_fin IS NULL";
            $resultadoFinalizacionTiene = mysqli_query($con, $finalizarEstadoTiene);

            $nuevoEstadoTiene = "INSERT INTO `tiene`(`id_tipo_menu`, `id_estado_tipo_menu`, `fecha_inicio`) 
                            VALUES ('$idMenu', 3, CURDATE())";
            $resultadoNuevoEstadoTiene = mysqli_query($con, $nuevoEstadoTiene);
            // Lo mismo con se_encuentra
            $finalizarEstadoSeEncuentra = "UPDATE `se_encuentra` SET `fecha_fin`= CURDATE() 
                                WHERE id_pedido = $idPedido
                                AND fecha_fin IS NULL";

            $resultadoFinalizacionSeEncuentra = mysqli_query($con, $finalizarEstadoSeEncuentra);

            $nuevoEstado = "INSERT INTO `se_encuentra`(`id_pedido`, `id_estado_pedido`, `fecha_inicio`) 
                                VALUES ($idPedido, 1, CURDATE())";

            $resultadoNuevoEstado = mysqli_query($con, $nuevoEstado);

        } else if($_POST["btnEstado"] == "3") {
            // Pedido Cancelado
            // $estado = 3;
            $finalizarEstado = "UPDATE `se_encuentra` SET `fecha_fin`= CURDATE() 
                                WHERE id_pedido = $idPedido
                                AND fecha_fin IS NULL";

            $resultadoFinalizacion = mysqli_query($con, $finalizarEstado);

            $nuevoEstado = "INSERT INTO `se_encuentra`(`id_pedido`, `id_estado_pedido`, `fecha_inicio`) 
                        VALUES ($idPedido, 3, CURDATE())";

            $resultadoNuevoEstado = mysqli_query($con, $nuevoEstado);

        } else if($_POST["btnEstado"] == "2") {
            // $estado = 2;
            $finalizarEstado = "UPDATE `se_encuentra` SET `fecha_fin`= CURDATE() 
                                WHERE id_pedido = $idPedido
                                AND fecha_fin IS NULL";

            $resultadoFinalizacion = mysqli_query($con, $finalizarEstado);

            $nuevoEstado = "INSERT INTO `se_encuentra`(`id_pedido`, `id_estado_pedido`, `fecha_inicio`) 
                        VALUES ($idPedido, 2, CURDATE())";

            $resultadoNuevoEstado = mysqli_query($con, $nuevoEstado);
            // El pedido esta listo, se genera un insert por la caja_menu que creada
            // También se contemplan sus respectivas relaciones, envasa y lleva

            $creacionCaja = "INSERT INTO `caja_menu`(`fecha_elaborado`) VALUES (CURDATE())";
            $resultadoCreacionCaja = mysqli_query($con, $creacionCaja);

            if($resultadoCreacionCaja){
                $id_caja_menu = $con->insert_id;
            }
            
            // echo "caja menu"."$id_caja_menu";

            // $guardarEnvasa = "INSERT INTO envasa(id_caja_menu, id_tipo_menu, fecha_envasado) VALUES ('$id_caja_menu','$idMenu',CURDATE())";
            $guardarEnvasa = "INSERT INTO envasa(id_caja_menu, id_tipo_menu, fecha_envasado) VALUES ('$id_caja_menu', '$idMenu', CURDATE())";
            // echo "caja menu"."$id_caja_menu";
            $resultadoGuardarEnvasa = mysqli_query($con, $guardarEnvasa);

            $guardarLleva = "INSERT INTO lleva(id_caja_menu, id_pedido) VALUES ('$id_caja_menu','$idPedido')";
            $resultadoGuardarLleva = mysqli_query($con, $guardarLleva);

            $guardarSeHalla = "INSERT INTO se_halla(id_caja_menu, id_estado_caja_menu, fecha_inicio) VALUES ('$id_caja_menu', 0, CURDATE())";
            $resultadoGuardarSeHalla = mysqli_query($con, $guardarSeHalla);


            
            if($stockTecho != 0) {
            // Se resta del Stock
                $restarStock = "UPDATE tipo_menu SET stock_real = stock_real - 1 WHERE id_tipo_menu = '$idMenu'";
                $resultadoRestarStock = mysqli_query($con, $restarStock);

                $revisarStock = "SELECT stock_piso, stock_real, stock_techo FROM tipo_menu WHERE id_tipo_menu = '$idMenu'";
                $resultadoRevisionStock = mysqli_query($con, $revisarStock);

                
                // $filaStock = $resultadoRevisionStock->fetch_assoc();
                if (!$resultadoRestarStock) {
                    die("Error en la consulta stock: " . mysqli_error($con));
                }
                if (!$resultadoGuardarEnvasa) {
                    die("Error en la consulta envasa: " . mysqli_error($con));
                }

                while($filaStock = mysqli_fetch_assoc($resultadoRevisionStock)) {
                    $stockPiso = $filaStock["stock_piso"];
                    $stockReal = $filaStock["stock_real"];
                    $stockTecho = $filaStock["stock_techo"];
                }

                if($stockReal == $stockPiso && $stockTecho != 0) {
                    // $estado = 0;
                    $finalizarEstado = "UPDATE tiene SET fecha_fin = CURDATE()
                                        WHERE id_tipo_menu = $idMenu
                                        AND fecha_fin IS NULL";

                    $resultadoFinalizacion = mysqli_query($con, $finalizarEstado);

                    $nuevoEstado = "INSERT INTO tiene(id_tipo_menu, id_estado_tipo_menu, fecha_inicio) 
                                    VALUES ($idMenu, 0, CURDATE())";
                    $resultadoNuevoEstado = mysqli_query($con, $nuevoEstado);
                }
            }
        } else if($_POST["btnEstado"] == "4") {

            $finalizarEstado = "UPDATE `se_encuentra` SET `fecha_fin`= CURDATE() 
                                WHERE id_pedido = $idPedido
                                AND fecha_fin IS NULL";

            $resultadoFinalizacion = mysqli_query($con, $finalizarEstado);

            $nuevoEstado = "INSERT INTO `se_encuentra`(`id_pedido`, `id_estado_pedido`, `fecha_inicio`) 
                        VALUES ($idPedido, 4, CURDATE())";

            $resultadoNuevoEstado = mysqli_query($con, $nuevoEstado);

            $traerIdCajaMenu = "SELECT id_caja_menu FROM lleva WHERE id_pedido = $idPedido";
            $resultadoTraerIdCajaMenu = mysqli_query($con, $traerIdCajaMenu);
            while($idCaja = mysqli_fetch_assoc($resultadoTraerIdCajaMenu)) {
                $id_caja_menu = $idCaja["id_caja_menu"];
            }

            $finalizarEstadoSeHalla = "UPDATE `se_halla` SET `fecha_fin`=CURDATE() 
                                        WHERE id_caja_menu = '$id_caja_menu'
                                        AND fecha_fin IS NULL";
            $resultadoFinalizacionSeHalla = mysqli_query($con, $finalizarEstadoSeHalla);


            $nuevoEstadoSeHalla = "INSERT INTO `se_halla`(`id_caja_menu`, `id_estado_caja_menu`, `fecha_inicio`)
                                    VALUES($id_caja_menu, 3,CURDATE())";
            $resultadoNuevoEstado = mysqli_query($con, $nuevoEstadoSeHalla);

            // $resultadoNuevoEstado = mysqli_query($con, $nuevoEstado);
        } else if($_POST["btnEstado"] == "21") {
            // Estado de la caja cambia a Devuelto

            echo "btnEstado 21";
            $finalizarEstadoSeHalla = "UPDATE `se_halla` SET `fecha_fin`= CURDATE() 
                                        WHERE id_caja_menu = '$idCajaMenu'
                                        AND fecha_fin IS NULL";
            $resultadoFinalizacionSeHalla = mysqli_query($con, $finalizarEstadoSeHalla);
            
            $nuevoEstadoSeHalla = "INSERT INTO `se_halla`(`id_caja_menu`, `id_estado_caja_menu`, `fecha_inicio`)
            VALUES($idCajaMenu, 1, CURDATE())";
            $resultadoNuevoEstado = mysqli_query($con, $nuevoEstadoSeHalla);

            $sumarStock = "UPDATE tipo_menu SET stock_real = stock_real + 1 WHERE id_tipo_menu = '$idMenu'";
            $resultadoSumarStock = mysqli_query($con, $sumarStock);

        } else if($_POST["btnEstado"] == "22") {
            // desechado


            $finalizarEstadoSeHalla = "UPDATE `se_halla` SET `fecha_fin`= CURDATE() 
                                        WHERE id_caja_menu = '$idCajaMenu'
                                        AND fecha_fin IS NULL";
            $resultadoFinalizacionSeHalla = mysqli_query($con, $finalizarEstadoSeHalla);
            
            $nuevoEstadoSeHalla = "INSERT INTO `se_halla`(`id_caja_menu`, `id_estado_caja_menu`, `fecha_inicio`)
            VALUES($idCajaMenu, 2, CURDATE())";
            $resultadoNuevoEstado = mysqli_query($con, $nuevoEstadoSeHalla);

        } else if($_POST["btnEstado"] == "5") {
            // Entregado
            // $estado = 5;

            $finalizarEstado = "UPDATE `se_encuentra` SET `fecha_fin`= CURDATE() 
                                WHERE id_pedido = $idPedido
                                AND fecha_fin IS NULL";

            $resultadoFinalizacion = mysqli_query($con, $finalizarEstado);

            $nuevoEstado = "INSERT INTO `se_encuentra`(`id_pedido`, `id_estado_pedido`, `fecha_inicio`) 
                                VALUES ($idPedido, 5, CURDATE())";

            $resultadoNuevoEstado = mysqli_query($con, $nuevoEstado);

            // Caja_menu requiere estado entregado? ?

        }  else if($_POST["btnEstado"] == "6") {
            // pedido devuelto
            $finalizarEstado = "UPDATE `se_encuentra` SET `fecha_fin`= CURDATE() 
                                WHERE id_pedido = $idPedido
                                AND fecha_fin IS NULL";
            $resultadoFinalizacion = mysqli_query($con, $finalizarEstado);
            $nuevoEstado = "INSERT INTO `se_encuentra`(`id_pedido`, `id_estado_pedido`, `fecha_inicio`) 
                                VALUES ($idPedido, 6, CURDATE())";
            $resultadoNuevoEstado = mysqli_query($con, $nuevoEstado);

        }

        
    }

    if($resultadoNuevoEstado) {
        echo "biennnn";
        mysqli_close($con);
        echo
            '<script>
                alert("Registro realizado exitosamente");
                window.location = "../vistas/home/productos.php";
            </script>';
        exit();
    } else {
        echo "maaaal";

        mysqli_close($con);
        echo
            '<script>
                alert("Registro no efectuado, intentelo de nuevo");
                window.location = "../vistas/home/productos.php";
            </script>';
        exit();
    }
?>