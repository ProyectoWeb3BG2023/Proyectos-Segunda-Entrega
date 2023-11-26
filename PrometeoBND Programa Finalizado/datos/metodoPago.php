<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    if ($_POST) {
        $tipoTarjeta = $_POST['opcionTarjeta'];
        $numeroTarjeta = $_POST['numeroTarjeta'];
        $idCliente = $_SESSION['identificadorCliente'];

        $verificarTarjeta = "SELECT numero_tarjeta FROM metodo_de_pago WHERE numero_tarjeta = $numeroTarjeta";
        $resultadoVerificacion = mysqli_query($con, $verificarTarjeta);

        if (mysqli_num_rows($resultadoVerificacion) == 0) {
            $guardarTarjeta = "INSERT INTO `metodo_de_pago`(`numero_tarjeta`, `tipo_de_tarjeta`, `estado`) VALUES ('$numeroTarjeta','$tipoTarjeta', 0)";
            $resultadoDatos = mysqli_query($con, $guardarTarjeta);
            if($resultadoDatos) {
                $guardarPosee = "INSERT INTO `posee`(`numero_tarjeta`, `id_cliente`) VALUES ('$numeroTarjeta','$idCliente')";
                $resultadoPosee = mysqli_query($con, $guardarPosee);
            } else {
                mysqli_close($con);
                    echo
                        '<script>
                            alert("Registro no efectuado, intentelo de nuevo");
                            window.location = "../vistas/home/productos.php";
                        </script>';
                    exit();
            }
    } else {
        $verificarCliente = "SELECT `numero_tarjeta`, `id_cliente` FROM `posee` WHERE id_cliente = $idCliente AND numero_tarjeta = $numeroTarjeta";
        $resultadoCliente = mysqli_query($con, $verificarCliente);
        if (mysqli_num_rows($resultadoCliente) != 0) {
            $editarTarjeta = "UPDATE `metodo_de_pago` SET `estado`='0' WHERE numero_tarjeta = $numeroTarjeta";
            $resultadoEditar = mysqli_query($con, $editarTarjeta);
        } else {
            mysqli_close($con);
        echo
            '<script>
                alert("ERROR CON EL INGRESO, pruebe con otro método de pago");
                window.location = "../vistas/home/productos.php";
            </script>';
        exit();
        }
    }

    if($resultadoEditar || $resultadoPosee) {
        mysqli_close($con);
        echo
            '<script>
                alert("Registro realizado exitosamente");
                window.location = "../vistas/home/productos.php";
            </script>';
        exit();
    } else {
        mysqli_close($con);
        echo
            '<script>
                alert("Registro no efectuado, intentelo de nuevo");
                window.location = "../vistas/home/productos.php";
            </script>';
        exit();
    }
    }
    
?>