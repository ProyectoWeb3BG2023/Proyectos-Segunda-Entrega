<?php

include("conexion/conexion.php");
$con = conectar();
if ($_POST) {
    $primernombre = $_POST['primernombre'];
    $segundonombre = $_POST['segundonombre'];
    $primerapellido = $_POST['primerapellido'];
    $segundoapellido = $_POST['segundoapellido'];
    $documento = $_POST['documento'];
    $idTipoDeUsuario = $_POST['idTipoDeUsuario'];
    $contrasena_ingresada = $_POST['contrasena'];

    $salt = '$2a$10$' . substr(strtr(base64_encode(random_bytes(22)), '+', '.'), 0, 22);
    $contrasena_hash = crypt($contrasena_ingresada, $salt);

    $guardar = "INSERT INTO 
    usuario(id_usuario, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, pasword, salt)
    VALUES
    ('$documento','$primernombre','$segundonombre','$primerapellido','$segundoapellido','$contrasena_hash','$salt')";

    $guardarPertenece = "INSERT INTO 
    pertenece(id_usuario, id_tipo_de_usuario)
    VALUES
    ('$documento','$idTipoDeUsuario')";

    $resultado = mysqli_query($con, $guardar);
    $resultadoPertenece = mysqli_query($con, $guardarPertenece);

     if( $resultado && $resultadoPertenece ) {
         mysqli_close($con);
         echo
             '<script>
                 alert("Registro realizado exitosamente USUARIO");
                window.location = "../vistas/home/formularios.php";
             </script>';
         exit();

     }else{

        mysqli_close($con);
         echo
             '<script>
                 alert("Registro no efectuado, intentelo de nuevo USUARIO");
                window.location = "../vistas/home/formularios.php";
             </script>';
         exit();

     }

}

?>