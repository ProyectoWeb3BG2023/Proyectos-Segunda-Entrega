<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();
    $con2 = conectar();
    $con3 = conectar();
    $con4 = conectar();


if ($_POST) {
    
    $usuario_ingresado = $_POST['identificador'];
    $contrasena_ingresada = $_POST['contrasena'];

    $consultaCliente = "SELECT * FROM cliente WHERE id_cliente = '$usuario_ingresado'";

    $consultaUsuario = "SELECT * FROM usuario WHERE id_usuario = '$usuario_ingresado'";

    $consultaRol = "SELECT * FROM pertenece WHERE id_usuario = '$usuario_ingresado'";

    $consultaClienteAutorizacion = "SELECT autorizacion FROM cliente WHERE id_cliente = '$usuario_ingresado'";

    $datos = "SELECT primer_nombre FROM cliente WHERE id_cliente = '$usuario_ingresado'";

    $datosUsuario = "SELECT primer_nombre FROM usuario WHERE id_usuario = '$usuario_ingresado'";

    $telefonoCliente = "SELECT telefono FROM cliente_telefono WHERE id_cliente = '$usuario_ingresado'";
    //---------------------------------------------------------------------------------
    $resultado = mysqli_query($con, $consultaCliente);
    $resultadoUsuario = mysqli_query($con, $consultaUsuario);
    $resultadoRol = mysqli_query($con, $consultaRol);
    $resultadoAutorizacion = mysqli_query($con, $consultaClienteAutorizacion);
    $resultadodatos = mysqli_query($con, $consultaCliente);
    $resultadoDatosUsuario = mysqli_query($con, $datosUsuario);

    $resultadoTelefonoCliente = mysqli_query($con, $telefonoCliente);


    
    //---------------------------------------------------------------------------------
    $fila = mysqli_fetch_assoc($resultado);
    $resAuto = mysqli_fetch_assoc($resultadoAutorizacion);
    $row = mysqli_fetch_assoc($resultadodatos);
    $filaRU = mysqli_fetch_assoc($resultadoUsuario);
    $filaRol = mysqli_fetch_assoc($resultadoRol);
    $rowUsuario = mysqli_fetch_assoc($resultadoDatosUsuario);
    $rowResultadoTelefonoCliente = mysqli_fetch_assoc($resultadoTelefonoCliente);



    //---------------------------------------------------------------------------------
    $contrasena_hash = $fila['pasword'];
    $resultadoAutoriz = $resAuto['autorizacion'];
    //Pasaje de datos para la sesión CLIENTE
    $_SESSION['identificadorCliente'] = $row['id_cliente'];
    $_SESSION['nombre_usuarioCliente'] = $row['primer_nombre'];
    $_SESSION['segundo_nombreCliente'] = $row['segundo_nombre'];
    $_SESSION['primer_apellidoCliente'] = $row['primer_apellido'];
    $_SESSION['segundo_apellidoCliente'] = $row['segundo_apellido'];
    $_SESSION['calleCliente'] = $row['calle'];
    $_SESSION['numero_puertaCliente'] = $row['numero_puerta'];
    $_SESSION['esquinaCliente'] = $row['esquina'];
    $_SESSION['emailCliente'] = $row['email'];

    $_SESSION['telefonoCliente'] = $rowResultadoTelefonoCliente['telefono'];


    $contrasena_hashUsuario = $filaRU['pasword'];
    $rol = $filaRol['id_tipo_de_usuario'];


    //Pasaje de datos para la sesión USUARIO
    $_SESSION['nombre_usuario'] = $rowUsuario['primer_nombre'];

    //---------------------------------------------------------------------------------
    
    // a
    if ($resultado) {
        // Verificar si se encontró al usuario
        if (mysqli_num_rows($resultado) == 1) {
            // Comparar la contrasena ingresada con la almacenada
            if (password_verify($contrasena_ingresada, $contrasena_hash)) {
                if ($resultadoAutoriz == 0) {
                //c
                mysqli_close($con);
                echo
                    '<script>
                        alert("No estas autorizado");
                        window.location = "formularioLogin.html";
                    </script>';
                exit();
                //c
                } else {
                    
                    // Las credenciales son válidas, iniciar sesión y redirigir al usuario
                    header('Location: ../vistas/home/homeUL.php');
                    exit();
                    //c
                }
            } else {
                // Contrasena incorrecta
                echo "Contrasena incorrecta. Por favor, inténtalo de nuevo.";
            }
        // Verifica en tabla USUARIO
        } else if (mysqli_num_rows($resultadoUsuario) == 1){
            // Comparar la contrasena ingresada con la almacenada
            if (password_verify($contrasena_ingresada, $contrasena_hashUsuario)) {
                // Las credenciales son válidas, iniciar sesión y redirigir al usuario
                if($rol == 0 ) {
                    // informático
                    header('Location: ../vistas/informatico/homepage.php');    
                } else if($rol == 1 ) {
                    // gerente
                    header('Location: ../vistas/gerente/homepage.php');
                } else if ($rol == 2 ) {
                    // jefeCocina
                    header('Location: ../vistas/jefeCocina/homepage.php');
                } else if ($rol == 3 ) {
                    // administrativo
                    header('Location: ../vistas/administrativo/homepage.php');
                } else {
                    // atencionCliente
                    header('Location: ../vistas/atencionCliente/homepage.php');
                }
                exit();
            }
        } else {
            echo "Usuario no encontrado.";
        }
    } else {
        // Error en la consulta SQL
        echo "Error en la consulta.";
    }
    // Cierra la conexión a la base de datos si es necesario
    mysqli_close($con);
    // mysqli_close($con4);
    }
?>