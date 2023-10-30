<?php

include("conexion/conexion.php");
$con = conectar();
if ($_POST) {
    
    $primernombre = $_POST['primernombre'];

    $segundonombre = $_POST['segundonombre'];

    $primerapellido = $_POST['primerapellido'];

    $segundoapellido = $_POST['segundoapellido'];

    $documento = $_POST['documento'];

    $mail = $_POST['mail'];

    $telefono = $_POST['telefono'];

    $calle = $_POST['calle'];

    $puerta = $_POST['puerta'];

    $esquina = $_POST['esquina'];

    $contrasena_ingresada = $_POST['contrasena'];

    $salt = '$2a$10$' . substr(strtr(base64_encode(random_bytes(22)), '+', '.'), 0, 22);
    // Hashea la contraseña con el salt generado
    $contrasena_hash = crypt($contrasena_ingresada, $salt);


    $guardar = "INSERT INTO
    cliente(documento, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, calle, numero_puerta, esquina, email, tipo_documento, pasword, salt, autorizacion) 
    VALUES
    ('$documento','$primernombre','$segundonombre','$primerapellido','$segundoapellido','$calle','$puerta','$esquina','$mail','CI', '$contrasena_hash', '$salt', '0')";

    // aun no se puede guardar el telefono porq el documento no es el id
    $guardarTelefono = "INSERT INTO 
    cliente_telefono(telefono) 
    VALUES
    ('$telefono')";


    $resultado = mysqli_query($con, $guardar);
    $resultadoTelefono = mysqli_query($con, $guardarTelefono);

     if( $resultado && $resultadoTelefono ) {
         mysqli_close($con);
         echo
             '<script>
                 alert("Registro realizado exitosamente");
                window.location = "../Home/sign up/formularios.php";
             </script>';
         exit();

     }else{

        mysqli_close($con);
         echo
             '<script>
                 alert("Registro no efectuado, intentelo de nuevo");
                window.location = "../Home/sign up/formularios.php";
             </script>';
         exit();

     }

}

?>