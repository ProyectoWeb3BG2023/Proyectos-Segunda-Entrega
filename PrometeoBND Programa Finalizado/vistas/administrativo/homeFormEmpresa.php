<?php
    include("../../datos/conexion/conexion.php");
    session_start();
    $con = conectar();
    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }

    if (isset($_POST['cliente_id']) ) {
        $idEmpresa = $_POST['cliente_id'];
        $tipoDocumento = $_POST['tipo_documento'];
        $rut = $_POST['cliente_documento'];
        $nombreEmpresa = $_POST['primer_nombre'];
        $calleEmpresa = $_POST['calle'];
        $numeroPuertaEmpresa = $_POST['numeroPuerta'];
        $esquinaEmpresa = $_POST['esquina'];
        $emailEmpresa = $_POST['email'];
    } else {
        echo "El parámetro 'id' no se ha proporcionado en la URL.";
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Nathan Guerra, Bruno Bordagorry, Diego Weble">
    <meta name="generator" content="Visual Studio Code">
    <meta http-equiv="X-UA-Compatible" content="IE=chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    <title>Ingreso Nuevo</title>
    <link rel="stylesheet" href="../../recursos/css/atencionCliente/styleFormEmpresa.css">
    <link rel="icon" href="../../recursos/img/logo.png">
</head>
<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.html">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homepage.html" class="linkCentrado">Home</a>
            </div>

            <div class="divSubContenedorDerecha">
                <a class="linkCentrado">Nombre User</a>
                <img src="../../recursos/img/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header>
    <section class="contenedorFormulario">
        <article class="subContenedorTitulo">                
            Cliente Empresa
        </article>
        <article class="subContenedorFormulario" id="opcionesEmpresa">
                <form action="../../datos/ABMclientes.php" method="post" enctype="multipart/form-data" class="formRegistroClienteEmpresa">
                    <label>Formulario</label>
                    <p>
                        <input type="hidden" id="n1" name="identCliente" readonly value="<?php echo $idEmpresa ?>">
                        <input type="hidden" id="n1" name="tipoDocumentoCliente" readonly value="<?php echo $tipoDocumento ?>">
                        <input type="text" id="n1" name="nombre" required placeholder="Nombre" value="<?php echo $nombreEmpresa; ?>">
                    </p>
                    <p>
                        <input type="text" name="documento" required placeholder="RUT" value="<?php echo $rut; ?>">
                        <input type="email" name="mail" required placeholder="Mail" value="<?php echo $emailEmpresa; ?>">
                    </p>
                    <p class="pDatoDomicilioUsuario">
                        <input type="text" name="calle" required placeholder="Calle" value="<?php echo $calleEmpresa; ?>">
                        <input type="number" name="puerta" required placeholder="Puerta" value="<?php echo $numeroPuertaEmpresa; ?>">
                        <input type="text" name="esquina" required placeholder="Esquina" value="<?php echo $esquinaEmpresa; ?>">
                    </p>
                    <!-- <input type="text" class="inputDatoComentario">
                    <input type="submit" class="botonEnviarFormulario" value="Enviar" name="registrar"> -->
                    <div class="botonesRespuestaFormulario">
                        <button type="submit" class="boton" name="opcion" value="0">Aprobado</button>
                        <button type="submit" class="boton" name="opcion" value="1">Rechazado</button>
                    </div>
                </form>
        </article>
    </section>
    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>

        <p>Copyright - Prometeo BND</p>
    </footer>
</body>
</html>