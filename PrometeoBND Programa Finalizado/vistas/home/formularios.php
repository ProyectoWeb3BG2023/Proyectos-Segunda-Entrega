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
    <link rel="stylesheet" href="../../recursos/css/home/styleFormularios.css">
    <link rel="icon" href="../../recursos/css/logo.png">
    <title>Registro</title>
</head>

<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.html">
                    <img src="../../recursos/img/logo.png">
                </a>
                <a href="homepage.html" class="linkCentrado">Homepage</a>
            </div>
        </div>
    </header>

    <section class="contenedorFormularioRegistro">
        <article class="botonesWebEmpresa">
            <div class="botonWeb" onclick="mostrarOpciones('web')">
                Cliente Web
            </div>
            <div class="botonEmpresa" onclick="mostrarOpciones('empresa')">
                Cliente Empresa
            </div>
            <!-- <div>
                <button onclick="mostrarOpciones('web')">Cliente Web</button>
                <button onclick="mostrarOpciones('empresa')">Cliente Empresa</button>
            </div> -->
        </article>

        <article class="subContenedorFormularioWeb" id="opcionesWeb">
            <!-- <div> -->
                <form action="../../datos/registrarWeb.php" method="post" enctype="multipart/form-data" class="formularioWeb">
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
                        <input type="text" name="documento" required placeholder="Documento">
                
                        <input type="email" name="mail" required placeholder="Mail">
                        <input type="number" name="telefono" required placeholder="Teléfono">

                    </p>
                    <p class="domicilioUsuario">
                        <input type="text" name="calle" required placeholder="Calle">
                        <input type="number" name="puerta" required placeholder="Puerta">
                        <input type="text" name="esquina" required placeholder="Esquina">
                    </p>
                    <p class="">
                        <input type="password" name="contrasena" required placeholder="Contraseña">
                    </p>
                    <input type="submit" value="Registrar" name="registrar">
                </form>
            <!-- </div> -->
        </article>

        <article class="subContenedorFormularioEmpresa" id="opcionesEmpresa">
            <!-- <div> -->
                <form action="../../datos/registrarEmpresa.php" method="post" enctype="multipart/form-data" class="formularioEmpresa">
                    <label>Registro</label>
                    <p>
                        <input type="text" id="n1" name="nombre" required placeholder="Nombre">
                    </p>
                    <p>
                        <input type="text" name="documento" required placeholder="Documento">
                        <input type="email" name="mail" required placeholder="Mail">
                        <input type="number" name="telefono" required placeholder="Teléfono">
                    </p>
                    <p class="domicilioUsuario">
                        <input type="text" name="calle" required placeholder="Calle">
                        <input type="number" name="puerta" required placeholder="Puerta">
                        <input type="text" name="esquina" required placeholder="Esquina">
                    </p>
                    <p class="">
                        <input type="password" name="contrasena" required placeholder="Contraseña">
                    </p>
                    <input type="submit" value="Registrar" name="registrar">
                </form>
            <!-- </div> -->
        </article>
    </section>

    <script src="../../recursos/js/cliente/main.js"></script>
</body>

</html>