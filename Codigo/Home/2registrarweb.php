<?php

include("2conexion.php");
$con = conectar();
if ($_POST) {
    
    $primernombre = $_POST['primernombre'];

    $segundonombre = $_POST['segundonombre'];

    $primerapellido = $_POST['primerapellido'];

    $segundoapellido = $_POST['segundoapellido'];

    $documento = $_POST['documento'];


    $mail = $_POST['mail'];

    $calle = $_POST['calle'];

    $puerta = $_POST['puerta'];

    $esquina = $_POST['esquina'];

    $guardar = "INSERT INTO 
    cliente(documento, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, calle, numero_puerta, esquina, email, tipo_documento) 
    VALUES
    ('$documento','$primernombre','$segundonombre','$primerapellido','$segundoapellido','$calle','$puerta','$esquina','$mail','CI')";

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