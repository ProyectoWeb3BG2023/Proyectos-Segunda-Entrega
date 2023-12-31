<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();

    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }

    $query = "SELECT id_dieta, nombre_dieta FROM dieta";
    $result = mysqli_query($con, $query);

    $con2 = conectar();
    $query2 = "SELECT id_comida, nombre FROM comida";
    $result2 = mysqli_query($con2, $query2);

    $con3 = conectar();
    $query3 = "SELECT id_comida, nombre FROM comida";
    $result3 = mysqli_query($con3, $query3);

    $con4 = conectar();
    $query4 = "SELECT id_comida, nombre FROM comida";
    $result4 = mysqli_query($con4, $query4);

    $con5 = conectar();
    $query5 = "SELECT id_comida, nombre FROM comida";
    $result5 = mysqli_query($con5, $query5);

    $con6 = conectar();
    $query6 = "SELECT id_comida, nombre FROM comida";
    $result6 = mysqli_query($con6, $query6);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Diego Weble, Bruno Bordagorry, Nathan Guerra">
    <meta name="generator" content="Visual Studio Code">
    <meta http-equiv="X-UA-Compatible" content="IE=chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <title>Aprobación de productos</title>
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    <link rel="stylesheet" href="../../recursos/css/gerente/styleSolicitud.css">
    <link rel="stylesheet" href="../../recursos/css/gerente/styleNuevo.css">

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
                    ?>
                </a>
                <img src="../../recursos/img/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header>
    <!-- Dietas platos menus metas-->
    <section class="tarjeta">
        <article class="tarjetas">
            <button onclick="mostrarOpciones('dieta')" class="boton">
                Dietas
            </button>
        </article>
        <article class="tarjetas" class="linkCentrado">
            <button onclick="mostrarOpciones('plato')" class="boton">
                Platos
            </button>
        </article>
        <article class="tarjetas">
            <button onclick="mostrarOpciones('menu')" class="boton">
                Menús
            </button>
        </article>
        <article class="tarjetas">
            <button onclick="mostrarOpciones('meta')" class="boton">
                Metas
            </button>
        </article>
    </section>
    <!-- Dietas  -->
    <section class="contenedorDietas" id="opcionesDieta">
        <article class="subContenedorTitulo">
            Agregar Dieta
        </article>
        <article class="identificador">
            <div class="subidentificador">
                Nombre/ID Jefe/Cocina
            </div>
        </article>
        <article class="subContenedorDatosDieta">
            <form action="2registrarDieta.php" method="post" enctype="multipart/form-data" class="formDieta">
                <div class="divDatosDieta" class="divDatosDietaNombre">
                    <label for="nombreDietas">Nombre:</label>
                    <br>
                    <input type="text" name="nombreDieta" id="nombreDietas" placeholder="Dieta...">
                    <button class="botonEnviarDieta boton">Enviar</button>
                </div>
                <div class="divDatosDieta" class="divDatosDietaDescripcion">
                    <label for="labelDietaDescripcion">Descripción:</label>
                    <br>
                    <textarea name="descripcionDieta" id="labelDietaDescripcion" cols="30" rows="8"></textarea>
                </div>
            </form>
        </article>
    </section>
    <!-- platos  -->
    <section class="contenedorPlatos" id="opcionesPlato">
        <article class="subContenedorTitulo">
            Agregar Plato
        </article>
        <article class="identificador">
            <div class="subidentificador">
                Nombre/ID Jefe/Cocina
            </div>
        </article>
        <form action="2registrarPlato.php" method="post" enctype="multipart/form-data">
            <article class="subContenedorSuperiorDatosPlato">
                    <div class="divDatosPlato">
                        <label for="nombrePlatos">Nombre:</label>
                        <br>
                        <input type="text" name="nombrePlato" id="nombrePlatos" placeholder="Plato...">
                    </div>
                        <div class="divDatosPlato">
                        <label for="selectDietas">Selecciona una dieta:</label>
                        <br>
                        <select name="opcionDieta" id="selectDietas">
                            <!-- php -->
                            <?php
                            foreach($result2 as $row){
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
                    <div class="divDatosPlato">
                        <label for="imgPlato">Imagen:</label>
                        <br>
                        <input type="file" name="imagenPlato" id="imgPlato">
                    </div>
            </article>
            <article class="subContenedorInferiorDatosPlato">
                <div class="divDatosPlato">
                    <label for="Pdiet">Ingredientes:</label>
                    <br>
                    <textarea name="ingredientesPlato" id="" cols="45" rows="7"></textarea>
                </div>
                <div class="divDatosPlato">
                    <button class="botonEnviarDieta boton">
                        Enviar
                    </button>
                </div>
            </article>
        </form>
    </section>

    <!-- menus -->

    <section class="contenedorMenus" id="opcionesMenu">
    <!-- subContenedorTitulo -->
        <article class="subContenedorTitulo">
            Agregar Menu
        </article>
        <article class="identificador">
            <div class="subidentificador">
                Nombre/ID Jefe/Cocina
            </div>
        </article>
        <article class="subContenedorInternoDatosMenu">
            <div class="divDatosMenuNombre" class="Minpu1">
                <label for="Mdiet">Nombre:</label>
                <br>
                <input type="text" name="nombreMenu" id="Mdiet" placeholder="Menu...">
            </div>
        </article>
        <article class="subContenedorInternoDatosMenu">
            <div class="divDatosMenu">
                <label for="Pdietas">Selecciona un Plato:</label>
                <br>
                <select id="Pdietas" name="Pdietas">
                <?php
                    foreach($result2 as $row) {
                        echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                    }
                ?>
                </select>
                <?php
                    mysqli_close($con2);
                ?>
            </div>
            <div class="divDatosMenu">
                <label for="Pdietas">Selecciona un Plato:</label>
                <br>
                <select id="Pdietas" name="Pdietas">
                <?php
                    foreach($result2 as $row) {
                        echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                    }
                ?>
                </select>
                <?php
                    mysqli_close($con3);
                ?>
            </div>

        </article>
        <article class="subContenedorInternoDatosMenu">
            <div class="divDatosMenu">
                <label for="Pdietas">Selecciona un Plato:</label>
                <br>
                <select id="Pdietas" name="Pdietas">
                <?php
                    foreach($result2 as $row) {
                        echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                    }
                ?>
                </select>
                <?php
                    mysqli_close($con4);
                ?>
            </div>
            <div class="divDatosMenu">
                <label for="Pdietas">Selecciona un Plato:</label>
                <br>
                <select id="Pdietas" name="Pdietas">
                <?php
                    foreach($result2 as $row) {
                        echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                    }
                ?>
                </select>
                <?php
                    mysqli_close($con5);
                ?>
            </div>
        </article>
        <article class="subContenedorInternoDatosMenu">
            <div class="divDatosMenu">
                <label for="Pdietas">Selecciona un Plato:</label>
                <br>
                <select id="Pdietas" name="Pdietas">
                <?php
                    foreach($result2 as $row) {
                        echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                    }
                ?>
                </select>
                <?php
                    mysqli_close($con6);
                    ?>
            </div>

            <div class="divDatosMenu">
                <label for="">Stock Techo:</label>
                <br>
                <input type="number" minlength="1" id="Mfail">
            </div>
        </article>
        <article class="subContenedorInferiorDatosMenu">
            <div class="divImagenMenu">
                <label for="">Imagen:</label>
                <br>
                <img src="../../src/imagen.png" alt="">
                <br>
                <br>
                <button class="botonEnviarMenu boton">Aceptar</button> 
            </div>
            
            <div class="divDatosMenu">
                <label for="">Stock Piso:</label>
                <br>
                <input type="number" minlength="1" id="Mfail">
                <br>
                <br>
                <label for="">Precio:</label>
                <br>
                <input type="number" name="precioMenu" minlength="1" id="Mfail">
                <br>
                <br>
                <label for="">Durabilidad:</label>
                <br>
                <input type="number" name="durabilidadMenu" minlength="1" id="Mfail">
            </div>
        </article>
    </section>

    <section class="contenedorMetas" id="opcionesMeta">
        <article class="subContenedorTitulo">   
            Introducir Metas
        </article>
        <article class="subContenedorIntroduccionMetas">
            <div class="divMeta">
                <label for="meta">Meta</label>
                <input type="text" name="" id="meta" placeholder="Meta...">
                <button class="botonEnviarMeta">+</button>
            </div>
        </article>
    </section>

    <footer>
        <p>Copyright - Prometeo BND</p>
    </footer>

    <script src="../../recursos/js/gerente/main.js"></script>
</body>

</html>