<?php
session_start();
include("conexion/conexion.php");
$con = conectar();


if ($_POST) {
    
    $primernombre = $_POST['primernombre'];
    $segundonombre = $_POST['segundonombre'];
    $primerapellido = $_POST['primerapellido'];
    $segundoapellido = $_POST['segundoapellido'];
    // $documento = $_POST['documento'];
    $mail = $_POST['mail'];
    $telefono = $_POST['telefono'];
    $calle = $_POST['calle'];
    $puerta = $_POST['puerta'];
    $esquina = $_POST['esquina'];

    // $_SESSION['identificadorCliente'] = $row['id_cliente'];
    // $_SESSION['identificadorCliente'];

    $_SESSION['nombre_usuarioCliente'] = $primernombre ;
    $_SESSION['segundo_nombreCliente'] = $segundonombre;
    $_SESSION['primer_apellidoCliente'] = $primerapellido;
    $_SESSION['segundo_apellidoCliente'] = $segundoapellido;
    $_SESSION['calleCliente'] = $calle;
    $_SESSION['numero_puertaCliente'] = $puerta;
    $_SESSION['esquinaCliente'] = $esquina;
    $_SESSION['emailCliente'] = $mail;
    $_SESSION['telefonoCliente'] = $telefono;
    

    // $datosUsuario = "SELECT primer_nombre FROM usuario WHERE id_usuario = '$usuario_ingresado'";
    // if id_usuario = $_SESSION["identificadorCliente"] ;

    $identificadorCliente = $_SESSION['identificadorCliente'];
    
    $cambioDatosUsuario = "UPDATE cliente
                           SET primer_nombre='$primernombre', segundo_nombre='$segundonombre', primer_apellido='$primerapellido', segundo_apellido='$segundoapellido', 
                               email='$mail', calle='$calle', numero_puerta='$puerta', esquina='$esquina' 
                           WHERE id_cliente = '$identificadorCliente' ";

    $cambioTelefonoCliente = "UPDATE cliente_telefono
    SET telefono='$telefono'
    WHERE id_cliente = '$identificadorCliente' ";                            

    
    //---------------------------------------------------------------------------------

    $resultado = mysqli_query($con, $cambioDatosUsuario);
    $resultadoTelefono = mysqli_query($con, $cambioTelefonoCliente);
   
    //---------------------------------------------------------------------------------
    // $fila = mysqli_fetch_assoc($resultado);

    if( $resultado && $resultadoTelefono ) {
        mysqli_close($con);
        echo
             '<script>
                 alert("Cambio realizado exitosamente");
                 window.location = "../vistas/cliente/perfiles/web/perfilWeb.php";
             </script>';
        exit();
    }else{
       mysqli_close($con);
        echo
            '<script>
                alert("Cambio no efectuado, intentelo de nuevo");
                window.location = "../vistas/cliente/perfiles/web/perfilWeb.php";
                
            </script>';
        exit();

        

    }
}

// mysqli_close($con);
    


?>