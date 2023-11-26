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
    $telefono = $_POST['telefono'];

    $contrasena_ingresada = $_POST['contrasena'];
    $salt = '$2a$10$' . substr(strtr(base64_encode(random_bytes(22)), '+', '.'), 0, 22);
    $contrasena_hash = crypt($contrasena_ingresada, $salt);

    $consultaCliente = "SELECT * FROM cliente WHERE email = '$mail' OR documento = '$documento'";
    $resultadoDatos = mysqli_query($con, $consultaCliente);
    
    if(mysqli_num_rows($resultadoDatos) == 1) {
        mysqli_close($con);
                echo
                    '<script>
                        alert("ERROR, documento o correo electronico ingresados ya han sido ingresados previamente");
                        window.location = "registrarWeb.php";
                    </script>';
                exit();
    } else {
        $guardar = "INSERT INTO
        cliente(documento, primer_nombre, calle, numero_puerta, esquina, email, tipo_documento, pasword, salt, autorizacion) 
        VALUES
        ('$documento','$nombre','$calle','$puerta','$esquina','$mail','RUT', '$contrasena_hash', '$salt', '0')";

        $guardarTelefono = "INSERT INTO 
        cliente_telefono(telefono) 
        VALUES
        ('$telefono')";

        $resultado = mysqli_query($con, $guardar);
        $resultadoTelefono = mysqli_query($con, $guardarTelefono);

        if($resultado && $resultadoTelefono) {
            mysqli_close($con);
            echo
                '<script>
                    alert("Registro realizado exitosamente");
                    window.location = "../vistas/home/homepage.html";
                </script>';
            exit();
        } else {
            mysqli_close($con);
            echo
                '<script>
                    alert("Registro no efectuado, intentelo de nuevo");
                    window.location = "../vistas/home/homepage.html";
                </script>';
            exit();
        }
    }
}
?>