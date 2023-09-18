<?php

include("2conexion.php");
$con = conectar();
if ($_POST) {

    $nombre = $_POST['nombre'];

    $documento = $_POST['documento'];

    $mail = $_POST['mail'];

    $calle = $_POST['calle'];

    $puerta = $_POST['puerta'];

    $esquina = $_POST['esquina'];

    $guardar = "INSERT INTO 
    cliente(documento, primer_nombre, calle, numero_puerta, esquina, email, tipo_documento) 
    VALUES
    ('$documento','$nombre','$calle','$puerta','$esquina','$mail','RUT')";

    $resultado = mysqli_query($con, $guardar);

     if($resultado) {
         mysqli_close($con);
         echo
             '<script>
                 alert("Registro realizado exitosamente");
                 window.location = "./formularios.php";
             </script>';

             
         exit();

     }else{

        mysqli_close($con);
         echo
             '<script>
                 alert("Registro no efectuado, intentelo de nuevo");
                 window.location = "./formularios.php";
             </script>';
         exit();

     }

}

?>