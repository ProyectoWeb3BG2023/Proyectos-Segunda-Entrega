<?php
    include("../../datos/conexion/conexion.php");
    session_start();
    $con = conectar();

    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }

    if (isset($_POST['cliente_id']) ) {
        $clid = $_POST['cliente_id'];
        $document = $_POST['cliente_documento'];
        $tipoDocumento = $_POST['tipo_documento'];
        $primerNombre = $_POST['primer_nombre'];
        $segundoNombre = $_POST['segundo_nombre'];
        $primerApellido = $_POST['primer_apellido'];
        $segundoApellido = $_POST['segundo_apellido'];
        $calle = $_POST['calle'];
        $numeroPuerta = $_POST['numeroPuerta'];
        $esquina = $_POST['esquina'];
        $email = $_POST['email'];
    } else {
        echo "El parámetro 'id' no se ha proporcionado en la URL.";
    }
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
    <meta name="keywords" content="">
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    <title>Ingreso Nuevo</title>
    <link rel="stylesheet" href="../../recursos/css/AtencionCliente/styleFormWeb.css">
    <link rel="icon" href="../../recursos/img/logo.png">
</head>

<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.html">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homepage.html" class="linkCentrado"><span>Home</span></a>
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

    <section class="contenedorFormulario">
        <article class="subContenedorTitulo">
            Cliente Web
        </article>
        <article class="subContenedorFormulario" id="opcionesWeb">
                <form action="../../datos/alertClientes.php" method="post" enctype="multipart/form-data" class="formRegistroClienteWeb">
                    <label>Formulario</label>
                    <p>
                        <input type="hidden" id="n1" name="identCliente" readonly value="<?php echo $clid ?>">
                        <input type="hidden" id="n1" name="tipoDocumentoCliente" readonly value="<?php echo $tipoDocumento ?>">
                        <input type="text" id="n1" name="primernombre" readonly value="<?php echo $primerNombre; ?>" placeholder="Primer nombre">
                        <input type="text" name="segundonombre" value="<?php echo $segundoNombre; ?>" placeholder="Segundo nombre">
                    </p>
                    <p>
                        <input type="text" name="primerapellido" value="<?php echo $primerApellido ?>" required placeholder="Primer Apellido">
                        <input type="text" name="segundoapellido" value="<?php echo $segundoApellido ?>" placeholder="Segundo apellido">
                    </p>
                    <p>
                        <input type="text" name="documento" value="<?php echo $document ?>" required placeholder="Documento">
                        <input type="email" name="mail" value="<?php echo $email ?>" required placeholder="Mail">
                    </p>
                    <p class="pDatoDomicilioUsuario">
                        <input type="text" name="calle" value="<?php echo $calle ?>" required placeholder="Calle">
                        <input type="number" name="puerta" value="<?php echo $numeroPuerta ?>" required placeholder="Puerta">
                        <input type="text" name="esquina" value="<?php echo $esquina ?>" required placeholder="Esquina">
                    </p>
                    <input type="text" class="inputDatoComentario">
                    <input type="submit" class="botonEnviarFormulario" name="registrar">
                </form>
        </article>
    </section>
    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>
        <p>Copyright - Prometeo BND</p>
        
    </footer>
    <?php
    mysqli_close($con);
        ?>
</body>
</html>