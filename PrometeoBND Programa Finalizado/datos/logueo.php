<!-- Datos provenientes de 'formularioLogin.html' -->
<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    if($con) {
    if (isset($_POST['identificador'])) {
        $usuario_ingresado = $_POST['identificador'];
        $contrasena_ingresada = $_POST['contrasena'];
        // Datos de Cliente
        $consultaCliente = "SELECT * FROM cliente WHERE email = '$usuario_ingresado' OR documento = '$usuario_ingresado'";
        $consultaClienteAutorizacion = "SELECT autorizacion FROM cliente WHERE documento = '$usuario_ingresado' OR email = '$usuario_ingresado'";
        // $datos = "SELECT primer_nombre FROM cliente WHERE id_cliente = '$usuario_ingresado'";

        // Datos de Usuario
        $consultaUsuario = "SELECT * FROM usuario WHERE id_usuario = '$usuario_ingresado'";
        $consultaRol = "SELECT * FROM pertenece WHERE id_usuario = '$usuario_ingresado'";
        $datosUsuario = "SELECT primer_nombre FROM usuario WHERE id_usuario = '$usuario_ingresado'";
        
        //----------------------------------------------------------------------------------------------------------
        $resultado = mysqli_query($con, $consultaCliente);
        $resultadodatos = mysqli_query($con, $consultaCliente);
        $resultadoAutorizacion = mysqli_query($con, $consultaClienteAutorizacion);

        $resultadoUsuario = mysqli_query($con, $consultaUsuario);
        $resultadoRol = mysqli_query($con, $consultaRol);
        $resultadoDatosUsuario = mysqli_query($con, $datosUsuario);
        //----------------------------------------------------------------------------------------------------------
        // $fila = mysqli_fetch_assoc($resultado);
        $row = mysqli_fetch_assoc($resultadodatos);
        $resAuto = mysqli_fetch_assoc($resultadoAutorizacion);
        $filaRU = mysqli_fetch_assoc($resultadoUsuario);
        $filaRol = mysqli_fetch_assoc($resultadoRol);
        $rowUsuario = mysqli_fetch_assoc($resultadoDatosUsuario);
        //----------------------------------------------------------------------------------------------------------

        if (mysqli_num_rows($resultado) == 1) {
            //Pasaje de datos para la sesión CLIENTE
            $resultadoAutoriz = $resAuto['autorizacion'];
            $contrasena_hash = $row['pasword'];
            $idClie = $row['id_cliente'];
            $_SESSION['identificadorCliente'] = $row['id_cliente'];
            $_SESSION['documentoCliente'] = $row['documento'];
            $_SESSION['nombre_usuarioCliente'] = $row['primer_nombre'];
            $_SESSION['segundo_nombreCliente'] = $row['segundo_nombre'];
            $_SESSION['primer_apellidoCliente'] = $row['primer_apellido'];
            $_SESSION['segundo_apellidoCliente'] = $row['segundo_apellido'];
            $_SESSION['calleCliente'] = $row['calle'];
            $_SESSION['numero_puertaCliente'] = $row['numero_puerta'];
            $_SESSION['esquinaCliente'] = $row['esquina'];
            $_SESSION['emailCliente'] = $row['email'];
            $_SESSION['tipoDocumentoCliente'] = $row['tipo_documento'];

            $telefonoCliente = "SELECT telefono FROM cliente_telefono WHERE id_cliente = '$idClie'";
            $resultadoTelefonoCliente = mysqli_query($con, $telefonoCliente);
            $rowResultadoTelefonoCliente = mysqli_fetch_assoc($resultadoTelefonoCliente);
            $_SESSION['telefonoCliente'] = $rowResultadoTelefonoCliente['telefono'];
            
        } else if(mysqli_num_rows($resultadoUsuario) == 1){
            //Pasaje de datos para la sesión USUARIO
            $_SESSION['identificadorCliente'] = $filaRol['id_usuario'];
            $contrasena_hashUsuario = $filaRU['pasword'];
            $rol = $filaRol['id_tipo_de_usuario'];
            $_SESSION['rolString'] = $filaRol['rol'];
            $_SESSION['nombre_usuario'] = $rowUsuario['primer_nombre'];
        }

        // -
        if($resultado || $resultadoUsuario){
            // Verificar si se encontró al usuario
            if(mysqli_num_rows($resultado) == 1) {
                // Comparar la contrasena ingresada con la almacenada
                if(password_verify($contrasena_ingresada, $contrasena_hash)) {
                    if($resultadoAutoriz == 0) {
                    //c
                    mysqli_close($con);
                    echo
                        '<script>
                            alert("No estas autorizado");
                            window.location = "../vistas/home/formularioLogin.html";
                        </script>';
                    exit();
                    //c
                    } else {
                        // Las credenciales son válidas, iniciar sesión y redirigir al usuario
                        header('Location: ../vistas/home/homeUL.php');
                        exit();
                    }
                } else {
                    // Contrasena incorrecta
                    echo "Contrasena incorrecta. Por favor, inténtalo de nuevo.";
                }
            // Verifica en tabla USUARIO
            } else if(mysqli_num_rows($resultadoUsuario) == 1){
                // Comparar la contrasena ingresada con la almacenada
                if(password_verify($contrasena_ingresada, $contrasena_hashUsuario)) {
                    // Las credenciales son válidas, iniciar sesión y redirigir al usuario
                    if($rol == 0) {
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
                } else {
                    echo "Contrasena incorrecta. Por favor, inténtalo de nuevo.";
                }
            } else {
                echo "Usuario no encontrado.";
            }
        } else {
            echo "Error en la consulta.";
        }
        mysqli_close($con);
        }
    } else {
        echo "Conexion fallida";
    }
?>