<?php
session_start();
include("conexion/conexion.php");
$con = conectar();

if($_POST['opcion'] == 0){
    if ( $_POST['tipoDocumentoCliente'] == "RUT" ) {

        $clienteId = $_POST['identCliente'];
        $document = $_POST['documento'];
        $primerNombre = $_POST['nombre'];
        $calle = $_POST['calle'];
        $numeroPuerta = $_POST['puerta'];
        $esquina = $_POST['esquina'];
        $email = $_POST['mail'];
        
        $cambioAlertaUsuarioEmpresa = "UPDATE cliente
                                SET documento='$document', primer_nombre='$primerNombre', email='$email', calle='$calle', 
                                numero_puerta='$numeroPuerta', esquina='$esquina', alertado = '1', autorizacion = '1'
                                WHERE id_cliente = '$clienteId' ";

        $resultadoEmpresa = mysqli_query($con, $cambioAlertaUsuarioEmpresa);

        if ( $resultadoEmpresa ) {
            mysqli_close($con);
            echo
                '<script>
                    alert("Empresa autorizada exitosamente");
                    window.location = "../vistas/administrativo/homeFormularios.php";
                </script>';
            exit();
        } else {
        mysqli_close($con);
            echo
                '<script>
                    alert("Cambio no efectuado, intentelo de nuevo");
                    window.location = "../vistas/administrativo/homeFormularios.php";
                </script>';
            exit();
        }
    } else {
        $clienteId = $_POST['identCliente'];
        $document = $_POST['documento'];
        $primerNombre = $_POST['primernombre'];
        $segundoNombre = $_POST['segundonombre'];
        $primerApellido = $_POST['primerapellido'];
        $segundoApellido = $_POST['segundoapellido'];
        $calle = $_POST['calle'];
        $numeroPuerta = $_POST['puerta'];
        $esquina = $_POST['esquina'];
        $email = $_POST['mail'];

        $cambioAlertaUsuarioWeb = "UPDATE cliente
                                SET documento='$document', primer_nombre='$primerNombre', segundo_nombre='$segundoNombre', 
                                primer_apellido='$primerApellido', segundo_apellido='$segundoApellido', 
                                email='$email', calle='$calle', numero_puerta='$numeroPuerta', esquina='$esquina', 
                                alertado = '1', autorizacion = '1'
                                WHERE id_cliente = '$clienteId' ";
                        
        //---------------------------------------------------------------------------------
        $resultadoWeb = mysqli_query($con, $cambioAlertaUsuarioWeb);
        
        if ( $resultadoWeb ) {
                mysqli_close($con);
                echo
                    '<script>
                        alert("Cliente autorizado exitosamente");
                        window.location = "../vistas/administrativo/homeFormularios.php";
                    </script>';
                exit();
        } else {
            mysqli_close($con);
            echo
                '<script>
                    alert("Cambio no efectuado, intentelo de nuevo");
                    window.location = "../vistas/administrativo/homeFormularios.php";
                </script>';
            exit();
        }

    }
} else {
    mysqli_close($con);
            echo
                '<script>
                    alert("Opcion actualmente indefinida");
                    window.location = "../vistas/administrativo/homeFormularios.php";
                </script>';
            exit();
}
?>