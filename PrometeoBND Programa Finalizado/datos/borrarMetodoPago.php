<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    if ($_POST) {
        $tipoTarjeta = $_POST['tipoTarjeta'];
        $numeroTarjeta = $_POST['numeroTarjeta'];
        $idCliente = $_SESSION['identificadorCliente'];

        $borrarTarjeta = "UPDATE `metodo_de_pago` SET `estado`='1' WHERE numero_tarjeta = $numeroTarjeta";
        $resultadoBorrar = mysqli_query($con, $borrarTarjeta);
        var_dump($resultadoBorrar);
    
        if($resultadoBorrar) {
                mysqli_close($con);
                echo
                    '<script>
                        alert("Borrado realizado exitosamente");
                        window.location = "../vistas/home/productos.php";
                    </script>';
                exit();
            } else {
                mysqli_close($con);
                echo
                    '<script>
                        alert("Borrado no efectuado, intentelo de nuevo");
                        window.location = "../vistas/home/productos.php";
                    </script>';
                exit();
            }
        }
       
    
?>