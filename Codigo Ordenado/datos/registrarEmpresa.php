<?php

include("conexion/conexion.php");
$con = conectar();
if ($_POST) {

    $nombre = $_POST['nombre'];

    $documento = $_POST['documento'];

    $mail = $_POST['mail'];

    $calle = $_POST['calle'];

    $puerta = $_POST['puerta'];

    $esquina = $_POST['esquina'];

    $contrasena_ingresada = $_POST['contrasena'];

    $salt = '$2a$10$' . substr(strtr(base64_encode(random_bytes(22)), '+', '.'), 0, 22);
    // Hashea la contraseña con el salt generado
    $contrasena_hash = crypt($contrasena_ingresada, $salt);

    $guardar = "INSERT INTO
    cliente(documento, primer_nombre, calle, numero_puerta, esquina, email, tipo_documento, pasword, salt, autorizacion) 
    VALUES
    ('$documento','$nombre','$calle','$puerta','$esquina','$mail','RUT', '$contrasena_hash', '$salt', '1')";

    $resultado = mysqli_query($con, $guardar);

     if($resultado) {
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