<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();
    
    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
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
    <meta name="keywords" content="formulario, sign up, registro">
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/informatico/styleFormularios.css">
    <link rel="icon" href="../../recursos/css/logo.png">
    <title>Registro</title>
</head>

<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.php">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homepage.php" class="linkCentrado"><span>Homepage</span></a>
            </div>
        </div>
    </header>

    <section class="contenedorFormularioRegistro">
        <article class="botonesWebEmpresa">
            <div class="botonWeb">
                Nuevo Trabajador
            </div>
        </article>
                <form action="../../datos/registrarUsuario.php" method="post" enctype="multipart/form-data" class="formularioWeb subContenedorFormularioWeb">
                    <label>Registro</label>
                    <p>
                        <input type="text" id="n1" name="primernombre" required placeholder="Primer nombre">
                        <input type="text" name="segundonombre" placeholder="Segundo nombre">
                    </p>
                    <p>
                        <input type="text" name="primerapellido" required placeholder="Primer Apellido">
                        <input type="text" name="segundoapellido" placeholder="Segundo apellido">
                    </p>
                    <p>
                        <input type="text" name="documento" required placeholder="Id usuario">
                    </p>
                    <div class="containerTipoUsuario">
                        <label for="opciones">Tipo de Usuario</label>
                        <select id="opciones" name="idTipoDeUsuario">
                            <option value="0">Informático</option>
                            <option value="1">Gerente</option>
                            <option value="2">Jefe de Cocina</option>
                            <option value="3">Administrativo</option>
                            <option value="4">Atención al Cliente</option>
                        </select>
                    </div>
                    <p class="">
                        <input type="password" name="contrasena" required placeholder="Contraseña">
                    </p>
                    <input type="submit" value="Registrar" name="registrar">
                </form>
    </section>

</body>

</html>