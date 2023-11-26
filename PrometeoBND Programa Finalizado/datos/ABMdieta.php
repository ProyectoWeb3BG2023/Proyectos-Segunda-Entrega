<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    if($_POST['opcion'] == 0){
        $dietaId = $_POST['dieta_id'];
        $nombreDieta = $_POST['nombredieta'];
        $descripcionDieta = $_POST['descripciondieta'];
        
        $cambioAprobadoDieta = "UPDATE dieta
                                SET nombre_dieta='$nombreDieta', descripcion='$descripcionDieta', autorizacion = '1'
                                WHERE id_dieta = '$dietaId' ";

        $resultadoDieta = mysqli_query($con, $cambioAprobadoDieta);

        if ($resultadoDieta) {
            mysqli_close($con);
            echo
                '<script>
                    alert("Dieta autorizada exitosamente");
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