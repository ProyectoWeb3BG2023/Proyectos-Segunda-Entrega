<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    if(isset($_POST["btnEstado"])){
        $idMenu = $_POST["idmenu"];
        // echo "_".$idMenu."_";
        $stockTecho = $_POST["stocktecho"];
    }

    if(isset($_POST["btnEstado"])){
        if($_POST["btnEstado"] == "1"){
            // echo "_111111_";
            $estado = "1";
            $actualizarStock = "UPDATE `tipo_menu` SET `stock_real` = $stockTecho WHERE id_tipo_menu = $idMenu";
            $resultadoActualizacionStock = mysqli_query($con, $actualizarStock);
            if($resultadoActualizacionStock){
                echo "Bien resultadoActualizacionStock";
            } else {
                echo "Mal resultadoActualizacionStock";

            }
        } elseif($_POST["btnEstado"] == "3"){
            $estado = "3";
        }

        $finalizarEstado = "UPDATE tiene SET fecha_fin = CURDATE()
                                WHERE id_tipo_menu = '$idMenu'
                                AND fecha_fin IS NULL";
        $resultadoFinalizacion = mysqli_query($con, $finalizarEstado);

        $nuevoEstado = "INSERT INTO `tiene`(`id_tipo_menu`, `id_estado_tipo_menu`, `fecha_inicio`)
                        VALUES ('$idMenu','$estado', CURDATE())";
        $resultadoNuevoEstado = mysqli_query($con, $nuevoEstado);



        if($resultadoFinalizacion){
            // echo "_impeca resulNuevoEstado_";

        } else {
            // echo "_MAL resulNuevoEstado_";

        }
        if($resultadoNuevoEstado){
            // echo "_impeca resulNuevoEstado_";
        } else {
            // echo "_MAL resulNuevoEstado_";
        }
    }

    if($resultadoFinalizacion && $resultadoNuevoEstado) {
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