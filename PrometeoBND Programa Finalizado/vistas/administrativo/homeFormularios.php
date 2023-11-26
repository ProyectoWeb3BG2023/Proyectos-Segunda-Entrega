<?php
    include("../../datos/conexion/conexion.php");
    session_start();
    $con = conectar();

    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }

    $rol = $_SESSION['rolString'];
    

    $clientesAlertados = "SELECT *
    FROM cliente
    WHERE autorizacion = 0
    AND alertado = 1";

    $clientesSinAutorizacion = "SELECT *
    FROM cliente
    WHERE autorizacion = 0
    AND alertado = 0";

    
    $resultadoAlertados = mysqli_query($con, $clientesAlertados);
    $result = mysqli_query($con, $clientesSinAutorizacion);

    $filas = mysqli_fetch_array($result);
    $fil = mysqli_fetch_array($result);

    // $_SESSION['nombre'] = $row['primer_nombre'];
    // $nombre = $_SESSION['nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Diego Weble, Nathan Guerra, Bruno Bordagorry">
    <meta name="generator" content="Visual Studio Code">
    <meta http-equiv="X-UA-Compatible" content="IE=chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    <meta name="keywords" content="">
    <title>Ingreso Nuevo</title>
    <link rel="stylesheet" href="../../recursos/css/atencionCliente/styleFormularios.css">
    <link rel="icon" href="../../recursos/img/logo.png">
</head>
<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.php">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homepage.php" class="linkCentrado"><span>Home</span></a>
                <?php echo $rol ?>

            </div>

            <div class="divSubContenedorDerecha">
            <a href="../../datos/logout.php" class="linkCentrado">Cerrar Sesión</a>
            <a class="linkCentrado">
                <!-- Nombre User -->
                <?php
                    echo $_SESSION['nombre_usuario'];
                ?>
            </a>
                <img src="../../recursos/img/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header>

    <!-- ///////////////////////////////////////////////////// -->
    <?php
    if(mysqli_num_rows($resultadoAlertados) >= 1){
        echo "<h2>Usuarios para revisar - alertados</h2>";
        echo "<section class='contenedorFormularios'>";
            $i = 1;
            $count = 0;
            foreach( $resultadoAlertados as $row ){
            // $_SESSION['nombre'] = $row['primer_nombre'];
            $idCliente = $row['id_cliente'];
            $documento = $row['documento'];
            $tipoDocumento = $row['tipo_documento'];
            $primerNombre = $row['primer_nombre'];
            $segundoNombre = $row['segundo_nombre'];
            $primerApellido = $row['primer_apellido'];
            $segundoApellido = $row['segundo_apellido'];
            $calle = $row['calle'];
            $numeroPuerta = $row['numero_puerta'];
            $esquina = $row['esquina'];
            $email = $row['email'];
            if( $i == 1 ) {
                echo '<article class="subContenedorFormularios">';
                echo '<div class="divFormulario">';
                echo '    <h2>Formulario</h2>';
                echo '    <h3>' . $row['id_cliente'] . '</h3>';
                echo '    <h3>' . $row['tipo_documento'] . '</h3>';
                if ( $row['tipo_documento'] == 'RUT' ){
                    echo "   <form action='homeFormEmpresa.php' method='post' enctype='multipart/form-data'>";
                    echo "       <input type='hidden' name='cliente_id' value='$idCliente'>";
                    echo "       <input type='hidden' name='tipo_documento' value='$tipoDocumento'>";
                    echo "       <input type='hidden' name='cliente_documento' value='$documento'>";
                    echo "       <input type='hidden' name='primer_nombre' value='$primerNombre'>";
                    echo "       <input type='hidden' name='calle' value='$calle'>";
                    echo "       <input type='hidden' name='numeroPuerta' value='$numeroPuerta'>";
                    echo "       <input type='hidden' name='esquina' value='$esquina'>";
                    echo "       <input type='hidden' name='email' value='$email'>";
                    echo "       <button type='submit'>🛈</button>";
                    echo "   </form>";

                } else {
                    echo "   <form action='homeFormWeb.php' method='post' enctype='multipart/form-data'>";
                    echo "       <input type='hidden' name='cliente_id' value='$idCliente'>";
                    echo "       <input type='hidden' name='tipo_documento' value='$tipoDocumento'>";
                    echo "       <input type='hidden' name='cliente_documento' value='$documento'>";
                    echo "       <input type='hidden' name='primer_nombre' value='$primerNombre'>";
                    echo "       <input type='hidden' name='segundo_nombre' value='$segundoNombre'>";
                    echo "       <input type='hidden' name='primer_apellido' value='$primerApellido'>";
                    echo "       <input type='hidden' name='segundo_apellido' value='$segundoApellido'>";
                    echo "       <input type='hidden' name='calle' value='$calle'>";
                    echo "       <input type='hidden' name='numeroPuerta' value='$numeroPuerta'>";
                    echo "       <input type='hidden' name='esquina' value='$esquina'>";
                    echo "       <input type='hidden' name='email' value='$email'>";
                    echo "       <button type='submit'>🛈</button>";
                    echo "   </form>";
                }
                echo '</div>';
                $i++;
            } else if ( $i == 3 ){
                echo '<div class="divFormulario">';
                echo '    <h2>Formulario</h2>';
                echo '    <h3>' . $row['id_cliente'] . '</h3>';
                echo '    <h3>' . $row['tipo_documento'] . '</h3>';
                if ( $row['tipo_documento'] == 'RUT' ){
                    echo "   <form action='homeFormEmpresa.php' method='post' enctype='multipart/form-data'>";
                    echo "       <input type='hidden' name='cliente_id' value='$idCliente'>";
                    echo "       <input type='hidden' name='tipo_documento' value='$tipoDocumento'>";
                    echo "       <input type='hidden' name='cliente_documento' value='$documento'>";
                    echo "       <input type='hidden' name='primer_nombre' value='$primerNombre'>";
                    echo "       <input type='hidden' name='calle' value='$calle'>";
                    echo "       <input type='hidden' name='numeroPuerta' value='$numeroPuerta'>";
                    echo "       <input type='hidden' name='esquina' value='$esquina'>";
                    echo "       <input type='hidden' name='email' value='$email'>";                
                    echo "       <button type='submit'>🛈</button>";
                    echo "   </form>";
                } else {
                    echo "   <form action='homeFormWeb.php' method='post' enctype='multipart/form-data'>";
                    echo "       <input type='hidden' name='cliente_id' value='$idCliente'>";
                    echo "       <input type='hidden' name='tipo_documento' value='$tipoDocumento'>";
                    echo "       <input type='hidden' name='cliente_documento' value='$documento'>";
                    echo "       <input type='hidden' name='primer_nombre' value='$primerNombre'>";
                    echo "       <input type='hidden' name='segundo_nombre' value='$segundoNombre'>";
                    echo "       <input type='hidden' name='primer_apellido' value='$primerApellido'>";
                    echo "       <input type='hidden' name='segundo_apellido' value='$segundoApellido'>";
                    echo "       <input type='hidden' name='calle' value='$calle'>";
                    echo "       <input type='hidden' name='numeroPuerta' value='$numeroPuerta'>";
                    echo "       <input type='hidden' name='esquina' value='$esquina'>";
                    echo "       <input type='hidden' name='email' value='$email'>";
                    echo "       <button type='submit'>🛈</button>";
                    echo "   </form>";
                }
                echo '</div>';
                echo '</article>';
                $i=1;
            } else {
                echo '<div class="divFormulario">';
                echo '    <h2>Formulario</h2>';
                echo '    <h3>'. $row['id_cliente'] . '</h3>';
                echo '    <h3>' . $row['tipo_documento'] . '</h3>';
                if ( $row['tipo_documento'] == 'RUT' ){
                    echo "   <form action='homeFormEmpresa.php' method='post' enctype='multipart/form-data'>";
                    echo "       <input type='hidden' name='cliente_id' value='$idCliente'>";
                    echo "       <input type='hidden' name='tipo_documento' value='$tipoDocumento'>";
                    echo "       <input type='hidden' name='cliente_documento' value='$documento'>";
                    echo "       <input type='hidden' name='primer_nombre' value='$primerNombre'>";
                    echo "       <input type='hidden' name='calle' value='$calle'>";
                    echo "       <input type='hidden' name='numeroPuerta' value='$numeroPuerta'>";
                    echo "       <input type='hidden' name='esquina' value='$esquina'>";
                    echo "       <input type='hidden' name='email' value='$email'>";
                    echo "       <button type='submit'>🛈</button>";
                    echo "   </form>";
                } else {
                    echo "   <form action='homeFormWeb.php' method='post' enctype='multipart/form-data'>";
                    echo "       <input type='hidden' name='cliente_id' value='$idCliente'>";
                    echo "       <input type='hidden' name='tipo_documento' value='$tipoDocumento'>";
                    echo "       <input type='hidden' name='cliente_documento' value='$documento'>";
                    echo "       <input type='hidden' name='primer_nombre' value='$primerNombre'>";
                    echo "       <input type='hidden' name='segundo_nombre' value='$segundoNombre'>";
                    echo "       <input type='hidden' name='primer_apellido' value='$primerApellido'>";
                    echo "       <input type='hidden' name='segundo_apellido' value='$segundoApellido'>";
                    echo "       <input type='hidden' name='calle' value='$calle'>";
                    echo "       <input type='hidden' name='numeroPuerta' value='$numeroPuerta'>";
                    echo "       <input type='hidden' name='esquina' value='$esquina'>";
                    echo "       <input type='hidden' name='email' value='$email'>";
                    echo "       <button type='submit'>🛈</button>";
                    echo "   </form>";
                }
                echo '</div>';
                $i++;
            }
        }
        mysqli_close($con);
    echo "</section>";
    } else {
        echo "<h2>No existen usuarios alertados</h2>";
    }
    ?>

    <?php
    if(mysqli_num_rows($result) >= 1){
        echo "<section class='contenedorFormularios'>";
        echo    "<h2>Usuarios por autorizar</h2>";
                $i = 1;
                $count = 0;
                foreach( $result as $row ){
                    $idCliente = $row['id_cliente'];
                    $documento = $row['documento'];
                    $tipoDocumento = $row['tipo_documento'];
                    $primerNombre = $row['primer_nombre'];
                    $segundoNombre = $row['segundo_nombre'];
                    $primerApellido = $row['primer_apellido'];
                    $segundoApellido = $row['segundo_apellido'];
                    $calle = $row['calle'];
                    $numeroPuerta = $row['numero_puerta'];
                    $esquina = $row['esquina'];
                    $email = $row['email'];
                    if( $i == 1 ) {
                    echo '<article class="subContenedorFormularios">';
                    echo '<div class="divFormulario">';
                    echo '    <h2>Formulario</h2>';
                    echo '    <h3>' . $row['id_cliente'] . '</h3>';
                    echo '    <h3>' . $row['tipo_documento'] . '</h3>';
                    if ( $row['tipo_documento'] == 'RUT' ){
                        echo "   <form action='homeFormEmpresa.php' method='post' enctype='multipart/form-data'>";
                        echo "       <input type='hidden' name='cliente_id' value='$idCliente'>";
                        echo "       <input type='hidden' name='tipo_documento' value='$tipoDocumento'>";
                        echo "       <input type='hidden' name='cliente_documento' value='$documento'>";
                        echo "       <input type='hidden' name='primer_nombre' value='$primerNombre'>";
                        echo "       <input type='hidden' name='calle' value='$calle'>";
                        echo "       <input type='hidden' name='numeroPuerta' value='$numeroPuerta'>";
                        echo "       <input type='hidden' name='esquina' value='$esquina'>";
                        echo "       <input type='hidden' name='email' value='$email'>";
                        echo "       <button type='submit'>🛈</button>";
                        echo "   </form>";

                    } else {
                        echo "   <form action='homeFormWeb.php' method='post' enctype='multipart/form-data'>";
                        echo "       <input type='hidden' name='cliente_id' value='$idCliente'>";
                        echo "       <input type='hidden' name='tipo_documento' value='$tipoDocumento'>";
                        echo "       <input type='hidden' name='cliente_documento' value='$documento'>";
                        echo "       <input type='hidden' name='primer_nombre' value='$primerNombre'>";
                        echo "       <input type='hidden' name='segundo_nombre' value='$segundoNombre'>";
                        echo "       <input type='hidden' name='primer_apellido' value='$primerApellido'>";
                        echo "       <input type='hidden' name='segundo_apellido' value='$segundoApellido'>";
                        echo "       <input type='hidden' name='calle' value='$calle'>";
                        echo "       <input type='hidden' name='numeroPuerta' value='$numeroPuerta'>";
                        echo "       <input type='hidden' name='esquina' value='$esquina'>";
                        echo "       <input type='hidden' name='email' value='$email'>";
                        echo "       <button type='submit'>🛈</button>";
                        echo "   </form>";
                    }
                    echo '</div>';
                    $i++;
                    } else if ( $i == 3 ){
                        echo '<div class="divFormulario">';
                        echo '    <h2>Formulario</h2>';
                        echo '    <h3>' . $row['id_cliente'] . '</h3>';
                        echo '    <h3>' . $row['tipo_documento'] . '</h3>';
                        if ( $row['tipo_documento'] == 'RUT' ){
                            echo "   <form action='homeFormEmpresa.php' method='post' enctype='multipart/form-data'>";
                            echo "       <input type='hidden' name='cliente_id' value='$idCliente'>";
                            echo "       <input type='hidden' name='tipo_documento' value='$tipoDocumento'>";
                            echo "       <input type='hidden' name='cliente_documento' value='$documento'>";
                            echo "       <input type='hidden' name='primer_nombre' value='$primerNombre'>";
                            echo "       <input type='hidden' name='calle' value='$calle'>";
                            echo "       <input type='hidden' name='numeroPuerta' value='$numeroPuerta'>";
                            echo "       <input type='hidden' name='esquina' value='$esquina'>";
                            echo "       <input type='hidden' name='email' value='$email'>";                
                            echo "       <button type='submit'>🛈</button>";
                            echo "   </form>";
                        } else {
                            echo "   <form action='homeFormWeb.php' method='post' enctype='multipart/form-data'>";
                            echo "       <input type='hidden' name='cliente_id' value='$idCliente'>";
                            echo "       <input type='hidden' name='tipo_documento' value='$tipoDocumento'>";
                            echo "       <input type='hidden' name='cliente_documento' value='$documento'>";
                            echo "       <input type='hidden' name='primer_nombre' value='$primerNombre'>";
                            echo "       <input type='hidden' name='segundo_nombre' value='$segundoNombre'>";
                            echo "       <input type='hidden' name='primer_apellido' value='$primerApellido'>";
                            echo "       <input type='hidden' name='segundo_apellido' value='$segundoApellido'>";
                            echo "       <input type='hidden' name='calle' value='$calle'>";
                            echo "       <input type='hidden' name='numeroPuerta' value='$numeroPuerta'>";
                            echo "       <input type='hidden' name='esquina' value='$esquina'>";
                            echo "       <input type='hidden' name='email' value='$email'>";
                            echo "       <button type='submit'>🛈</button>";
                            echo "   </form>";
                        }
                    echo '</div>';
                    echo '</article>';
                    $i=1;
                    } else {
                        echo '<div class="divFormulario">';
                        echo '    <h2>Formulario</h2>';
                        echo '    <h3>'. $row['id_cliente'] . '</h3>';
                        echo '    <h3>' . $row['tipo_documento'] . '</h3>';
                        if ( $row['tipo_documento'] == 'RUT' ){
                            echo "   <form action='homeFormEmpresa.php' method='post' enctype='multipart/form-data'>";
                            echo "       <input type='hidden' name='cliente_id' value='$idCliente'>";
                            echo "       <input type='hidden' name='tipo_documento' value='$tipoDocumento'>";
                            echo "       <input type='hidden' name='cliente_documento' value='$documento'>";
                            echo "       <input type='hidden' name='primer_nombre' value='$primerNombre'>";
                            echo "       <input type='hidden' name='calle' value='$calle'>";
                            echo "       <input type='hidden' name='numeroPuerta' value='$numeroPuerta'>";
                            echo "       <input type='hidden' name='esquina' value='$esquina'>";
                            echo "       <input type='hidden' name='email' value='$email'>";
                            echo "       <button type='submit'>🛈</button>";
                            echo "   </form>";
                        } else {
                            echo "   <form action='homeFormWeb.php' method='post' enctype='multipart/form-data'>";
                            echo "       <input type='hidden' name='cliente_id' value='$idCliente'>";
                            echo "       <input type='hidden' name='tipo_documento' value='$tipoDocumento'>";
                            echo "       <input type='hidden' name='cliente_documento' value='$documento'>";
                            echo "       <input type='hidden' name='primer_nombre' value='$primerNombre'>";
                            echo "       <input type='hidden' name='segundo_nombre' value='$segundoNombre'>";
                            echo "       <input type='hidden' name='primer_apellido' value='$primerApellido'>";
                            echo "       <input type='hidden' name='segundo_apellido' value='$segundoApellido'>";
                            echo "       <input type='hidden' name='calle' value='$calle'>";
                            echo "       <input type='hidden' name='numeroPuerta' value='$numeroPuerta'>";
                            echo "       <input type='hidden' name='esquina' value='$esquina'>";
                            echo "       <input type='hidden' name='email' value='$email'>";
                            echo "       <button type='submit'>🛈</button>";
                            echo "   </form>";
                        }
                        echo '</div>';
                        $i++;
                    }
                }
        echo "</section>";
    } else {
        echo "<h2>No existen usuarios alertados</h2>";
    }
    ?>
    <section class="nuevoFormulario">
        <a href="../home/formularios.php">+ Nuevo</a>
    </section>
    <!-- ///////////////////////////////////////////////////// -->

    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>
        <p>Copyright - Prometeo BND</p>
        
    </footer>

</body>
</html>