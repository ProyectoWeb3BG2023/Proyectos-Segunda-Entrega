<?php
    session_start();
    include("../../../../datos/conexion/conexion.php");
    $con = conectar();
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
    <title>Perfil personal</title>
    <link rel="stylesheet" href="../../../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../../../recursos/css/header.css">
    <link rel="stylesheet" href="../../../../recursos/css/footer.css">
    <link rel="stylesheet" href="../../../../recursos/css/cliente/stylePerfilWeb.css">

    <link rel="icon" href="../../../../recursos/img/logo.png">
</head>
<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="../../../home/homeUL.php">
                    <img src="../../../../recursos/img/logo.png">
                </a>
                <a href="#au" class="linkCentrado">Home</a>
            </div>

            <div class="divSubContenedorDerecha">
            <a href="../../../../datos/logout.php" class="linkCentrado">Cerrar Sesión</a>
            <a class="linkCentrado">
                <?php
                    echo $_SESSION['nombre_usuarioCliente'];
                ?>
            </a>
                <img src="../../../../recursos/img/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header>
    <form action="../../../../datos/actualizarDatosCliente.php" method="post" enctype="multipart/form-data">
        <section class="contenedorTarjetas">
            <article class="tarjeta">
                    <h2>Nombre</h2>
                    <label for="">Primer nombre</label>
                    <input type="text" name="primernombre" class="dato" id="" readonly value="<?php echo $_SESSION['nombre_usuarioCliente']; ?>">
                    
                    <label for="">Segundo nombre</label>
                    <input type="text" name="segundonombre" class="dato" id="" readonly value="<?php echo $_SESSION['segundo_nombreCliente']; ?>">
                    
                    <label for="">Primer apellido</label>
                    <input type="text" name="primerapellido" class="dato" id="" readonly value="<?php echo $_SESSION['primer_apellidoCliente']; ?>">
                    
                    <label for="">Segundo apellido</label>
                    <input type="text" name="segundoapellido" class="dato" id="" readonly value="<?php echo $_SESSION['segundo_apellidoCliente']; ?>">

                    <!-- <button>✏</button> -->
            </article>
            <article class="tarjeta">
                <h2>Domicilio</h2>
                <label for="">Calle</label>
                <input type="text" name="calle" class="dato" id="" readonly value="<?php echo $_SESSION['calleCliente']; ?>">
                <label for="">Esquina</label>
                <input type="text" name="esquina" class="dato" id="" readonly value="<?php echo $_SESSION['esquinaCliente']; ?>">
                <label for="">Nro de puerta</label>
                <input type="text" name="puerta" class="dato" id="" readonly value="<?php echo $_SESSION['numero_puertaCliente']; ?>">
            </article>
            <article class="tarjeta">
                <h2>Contacto</h2>
                <label for="">Correo electrónico</label>
                <input type="text" name="mail" class="dato" id="" readonly value="<?php echo $_SESSION['emailCliente']; ?>">
                <label for="">Número de contacto</label>
                <input type="text" name="telefono" class="dato" id="" readonly value="<?php echo $_SESSION['telefonoCliente']; ?>">
            </article>
        </section>
        
        <button type="button" id="editar" class="habilitarEdicion">Editar</button>

        <input type="submit" name="" class="habilitarEdicion" id="editar" value="Actualizar">
    </form>
     <!-- <article class="subContenedorFoto">
                <h2>Perfil</h2>
                <img src="../../../../recursos/img/usr.png"/>
        </article>  -->
    <!--  -->
    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>

        <p>Copyright - Prometeo BND</p>
    </footer>
    
    <script src="../../../../recursos/js/inputs.js"></script>
</body>
</html>