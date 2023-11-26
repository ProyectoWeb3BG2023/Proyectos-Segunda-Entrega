<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    $idCliente = $_SESSION['identificadorCliente'];

    if(isset($_POST["btnCompra"])){

    if($_POST["btnCompra"] == 0) {
        echo "LA PERSONA SI TIENE METODOS DE PAGO GUARDADOS";
        $menuId = $_POST["idmenu"];
        if(isset($_POST["r"])){
            $tipoTarjeta = $_POST["r"];
        }

    } else if($_POST["btnCompra"] == 1) {
        $menuId = $_POST["idmenu"];

        if(isset($_POST["tipotarjeta"])){
            $tipoTarjeta = $_POST["tipotarjeta"];
        }
        if(isset($_POST["numerotarjeta"])){
            $numeroTarjeta = $_POST["numerotarjeta"];
        }
    }

    if($_POST['personalizado'] == '0'){
        $estado = 0;
    }  else {
        $estado = 2;
    
        $nuevoEstado = "INSERT INTO `tiene`(`id_tipo_menu`, `id_estado_tipo_menu`, `fecha_inicio`) 
                        VALUES ('$menuId','$estado', CURDATE())";
        $resultadoNuevoEstado = mysqli_query($con, $nuevoEstado);
        // if($resultadoNuevoEstado){
        //     echo "_-_-_-mui bien";
        // }
    }

    $datosMenus = "SELECT nombre, descripcion, precio FROM tipo_menu WHERE id_tipo_menu = '$menuId'";
    $guardarMenu = mysqli_query($con, $datosMenus);

    while($datosDelMenu = mysqli_fetch_array($guardarMenu)){
        $nombreMenu = $datosDelMenu["nombre"];
        $descripcionMenu = $datosDelMenu["descripcion"];
        $precioMenu = $datosDelMenu["precio"];
    }

    $pedido = "INSERT INTO pedido(costo, descripcion) VALUES ('$precioMenu','$nombreMenu')";
    $guardarPedido = mysqli_query($con, $pedido);

    if($guardarPedido){
        $id_pedido = $con->insert_id;
        // echo "_";
        // echo "$id_pedido";
        // echo "_";

        $hace = "INSERT INTO hace (id_cliente, id_pedido, fecha)
                    VALUES ($idCliente, $id_pedido, CURDATE())";
        $guardarHace = mysqli_query($con, $hace);


        if($guardarHace){
            // echo "bien de bien guardarHace";

            $seEncuentra = "INSERT INTO `se_encuentra`(`id_pedido`, `id_estado_pedido`, `fecha_inicio`)
                            VALUES ('$id_pedido','0', CURDATE())";
            $guardarSeEncuentra = mysqli_query($con, $seEncuentra);

            // if($guardarSeEncuentra){
            //     echo "_bien de bien guardarSeEncuentra_";
            // } else {
            //     echo "_error guardarSeEncuentra_";
            // }

        }else {
            // echo "error guardarHace";
        }

    } else {
        // echo "error guardarPedido";
    }

    // guardar contiene
    $comidasMenu = "SELECT `id_comida` FROM `integra` WHERE id_tipo_menu = $menuId";
    $guardarComidas = mysqli_query($con, $comidasMenu);

    $arregloComidas = array();
    // $k = 0;
    while($comidas = mysqli_fetch_array($guardarComidas)){
        $arregloComidas[] = $comidas['id_comida'];
        // echo $arregloComidas[$k]."_";
        // $k++;
    }

    if(mysqli_num_rows($guardarComidas) == 5){
        // echo "5columns";

        for($i = 0; $i < 5; $i++){
            $contiene = "INSERT INTO contiene(id_pedido, id_comida, id_tipo_menu) 
                        VALUES ($id_pedido, $arregloComidas[$i], $menuId)";
            $guardarContiene = mysqli_query($con, $contiene);
        }

    } else if(mysqli_num_rows($guardarComidas) == 10){
        // echo "10columns";
        for($i = 0; $i < 10; $i++){
            $contiene = "INSERT INTO contiene(id_pedido, id_comida, id_tipo_menu) 
                        VALUES ($id_pedido, $arregloComidas[$i], $menuId)";
            $guardarContiene = mysqli_query($con, $contiene);
        }
    } else if(mysqli_num_rows($guardarComidas) == 20){
        // echo "20 columns";
        for($i = 0; $i < 20; $i++){
            $contiene = "INSERT INTO contiene(id_pedido, id_comida, id_tipo_menu) 
                        VALUES ($id_pedido, $arregloComidas[$i], $menuId)";
            $guardarContiene = mysqli_query($con, $contiene);
        }
    }

    // if($guardarContiene){
    //     echo "FUNCIONA ARRAYS";
    // } else {
    //     echo "NNOONONONO FUNCIONA ARRAYS";
    // }
    
    }


    // c consulta para generar alerta
    // $ff = "SELECT id_comida FROM comida WHERE id_comida = 13";
    // $guardar = mysqli_query($con, $ff);

    if($guardarContiene) {
        mysqli_close($con);
        echo
            '<script>
                alert("Compra realizada exitosamente");
                window.location = "../vistas/home/homeUL.php";
            </script>';
        exit();
    } else {
        mysqli_close($con);
        echo
            '<script>
                alert("Compra no efectuada, inténtelo de nuevo");
                window.location = "../vistas/home/homeUL.php";
            </script>';
        exit();
    }
?>