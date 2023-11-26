<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    if($_POST['opcion'] == 0){
        $comidaId = $_POST['comida_id'];
        $nombreComida = $_POST['nombrecomida'];
        $descripcionComida = $_POST['descripcioncomida'];
        $ingredientesComida = $_POST['ingredientescomida'];
        
        $cambioAprobadoComida = "UPDATE comida
                                SET nombre='$nombreComida', descripcion='$descripcionComida', ingredientes='$ingredientesComida', autorizacion = '1'
                                WHERE id_comida = '$comidaId'";

        $resultadoComida = mysqli_query($con, $cambioAprobadoComida);

        if ($resultadoComida) {
            mysqli_close($con);
            echo
                '<script>
                    alert("Comida autorizada exitosamente");
                    window.location = "../vistas/gerente/homeSolicitud.php";
                </script>';
            exit();
        } else {
            mysqli_close($con);
            echo
                '<script>
                    alert("Cambio no efectuado, intentelo de nuevo");
                    window.location = "../vistas/gerente/homeSolicitud.php";
                </script>';
            exit();
        }
        
    } else {
        mysqli_close($con);
        echo
            '<script>
                alert("Opcion actualmente indefinida");
                window.location = "../vistas/gerente/homeSolicitud.php";
            </script>';
        exit();
    }
?>