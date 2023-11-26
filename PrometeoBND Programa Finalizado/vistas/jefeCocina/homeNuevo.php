<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();

    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: ..\..\vistas\home\formularioLogin.html');
        exit();
    }

    $query = "SELECT id_dieta, nombre_dieta FROM dieta  WHERE autorizacion = 1";
    $result = mysqli_query($con, $query);

    $con2 = conectar();
    $query2 = "SELECT id_comida, nombre FROM comida WHERE autorizacion = 1";
    $result2 = mysqli_query($con2, $query2);

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
    <title>Ingreso de productos</title>

    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">

    <link rel="stylesheet" href="../../recursos/css/jefeCocina/styleNuevo.css">
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
            </div>
            <div class="divSubContenedorDerecha">
                <a class="linkCentrado">
                <?php
                    echo $_SESSION['nombre_usuario'];
                    // echo $_SESSION['rolString'];
                ?>
                </a>
                <img src="../../recursos/img/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header>
    
    <!-- Dietas platos menus -->
    <section class="tarjeta">
        <article class="tarjetas">
            <button class="boton" id="btnDieta">
                Dietas
            </button>
        </article>
        <article class="tarjetas">
            <button class="boton" id="btnPlato">
                Platos
            </button>
        </article>
        <article class="tarjetas">
            <button class="boton">
                <a href="homeMenus.php" target="_blank">Menús</a>
            </button>
        </article>
    </section>
    <!-- Dietas  -->
    <section class="contenedorDietas" id="opcionesDieta">
        <article class="subContenedorTitulo">
            Agregar Dieta
        </article>
        <article class="subContenedorDatos">
            <form action="../../datos/registrarDieta.php" method="post" enctype="multipart/form-data" class="formDieta">
                <div class="divDatosDieta" class="divDatosDietaNombre">
                    <label for="nombreDietas">Nombre:</label>
                    <br>
                    <input type="text" name="nombreDieta" id="nombreDietas" placeholder="Dieta..." required>
                </div>
                <div class="divDatosDieta" class="divDatosDietaDescripcion">
                    <label for="labelDietaDescripcion">Descripción:</label>
                    <br>
                    <textarea name="descripcionDieta" id="labelDietaDescripcion" cols="30" rows="8" required></textarea>
                </div>
                <div class="contenedorBotonEnviarDieta">
                    <button class="botonEnviarDieta">Enviar</button>
                </div>
            </form>
        </article>
    </section>
    <!-- platos  -->
    <section class="contenedorPlatos" id="opcionesPlato">
        <article class="subContenedorTitulo">
            Agregar Plato
        </article>
        <form action="../../datos/registrarPlato.php" method="post" enctype="multipart/form-data">
            <article class="subContenedorDatosSuperior">
                    <div class="divDatosPlato">
                        <label for="nombrePlatos">Nombre:</label>
                        <br>
                        <input type="text" name="nombrePlato" id="nombrePlatos" placeholder="Plato..." required>
                    </div>
                    <!--  -->
                    <div class="divDatosPlato">
                        <label for="selectDietas">Selecciona una dieta:</label>
                        <br>
                        <select name="opcionDieta" id="selectDietas">
                            <!-- php -->
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['id_dieta'] . '">' . $row['nombre_dieta'] . '</option>';
                            }
                            ?>
                            <!-- php -->
                        </select>
                        <!-- php -->
                        <?php
                        mysqli_close($con);
                        ?>
                        <!-- php -->
                    </div>
                    
            </article>
            <article class="subContenedorDatosInferior">
                <div class="divDatosPlato">
                    <label for="Pdiet">Ingredientes:</label>
                    <br>
                    <textarea name="ingredientesPlato" id="" cols="45" rows="7" required></textarea>
                </div>
                <div class="divDatosPlato">
                    <button class="botonEnviarPlato">
                        Enviar
                    </button>
                </div>
            </article>
        </form>
    </section>

    
    <!--  -->
    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>
        <p>Copyright - Prometeo BND</p>

    </footer>

    <script src="../../recursos/js/jefeCocina/mainNuevo.js"></script>
</body>

</html>