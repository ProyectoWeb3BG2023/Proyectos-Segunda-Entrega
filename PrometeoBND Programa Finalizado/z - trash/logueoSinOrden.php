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


    $resultado = mysqli_query($con, $consultaCliente);
    $resultadoUsuario = mysqli_query($con, $consultaUsuario);
    $resultadoRol = mysqli_query($con, $consultaRol);

    // a
    if ($resultado) {
        // Verificar si se encontró al usuario
        if (mysqli_num_rows($resultado) == 1) {
            //c
            $fila = mysqli_fetch_assoc($resultado);
            // Obtener la contrasena almacenada en la base de datos
            $contrasena_hash = $fila['pasword'];
            // Comparar la contrasena ingresada con la almacenada
            if (password_verify($contrasena_ingresada, $contrasena_hash)) {
                //Verificar si el usuario esta autorizado o no
                $consultaClienteAutorizacion = "SELECT autorizacion FROM cliente WHERE id_cliente = '$usuario_ingresado'";
                $resultadoAutorizacion = mysqli_query($con3, $consultaClienteAutorizacion);
                $resAuto = mysqli_fetch_assoc($resultadoAutorizacion);
                $resultadoAutoriz = $resAuto['autorizacion'];
                //c
                if ($resultadoAutoriz == 0) {
                //c
                mysqli_close($con3);
                echo
                    '<script>
                        alert("No estas autorizado");
                        window.location = "formularioLogin.html";
                    </script>';
                exit();
                //c
                } else {
                    //Pasaje de datos para la sesión CLIENTE
                    $datos = "SELECT primer_nombre FROM cliente WHERE id_cliente = '$usuario_ingresado'";
                    $resultadodatos = mysqli_query($con2, $datos);
                    $row = mysqli_fetch_assoc($resultadodatos);
                    //c
                    $_SESSION['nombre_usuario'] = $row['primer_nombre'];
                    $nombre = $_SESSION['nombre_usuario'];
                    //c
                    mysqli_close($con2);
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
            //c
            $fila = mysqli_fetch_assoc($resultadoUsuario);
            // Obtener la contrasena almacenada en la base de datos
            $contrasena_hash = $fila['pasword'];
            //
            $filaRol = mysqli_fetch_assoc($resultadoRol);
            //
            $rol = $filaRol['id_tipo_de_usuario'];

            // Comparar la contrasena ingresada con la almacenada
            if (password_verify($contrasena_ingresada, $contrasena_hash)) {
                //Pasaje de datos para la sesión USUARIO
                $datosUsuario = "SELECT primer_nombre FROM usuario WHERE id_usuario = '$usuario_ingresado'";
                $resultadoDatosUsuario = mysqli_query($con4, $datosUsuario);
                $row = mysqli_fetch_assoc($resultadoDatosUsuario);
                
                $_SESSION['nombre_usuario'] = $row['primer_nombre'];
                $nombre = $_SESSION['nombre_usuario'];
                //c
                
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
                //c
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
    mysqli_close($con4);
    }
?>