<?php
include("2conexion.php");
$con = conectar();
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
    <meta name="author" content="Nathan Guerra, Bruno Bordagorry, Diego Weble">
    <meta name="generator" content="Visual Studio Code">
    <meta http-equiv="X-UA-Compatible" content="IE=chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <title>Ingreso de productos</title>
    <link rel="stylesheet" href="styleNuevo.css">
    <link rel="icon" href="src/logo.png">
</head>

<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.html">
                    <img src="src/logo.png">
                </a>
                <a href="homepage.html" class="linkCentrado">Home</a>
            </div>
            <div class="divSubContenedorDerecha">
                <a class="linkCentrado">Nombre User</a>
                <img src="src/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header>
    <!-- Dietas platos menus -->
    <section class="tarjeta">
        <article class="tarjetas">
            <button onclick="mostrarOpciones('dieta')">
                Dietas
            </button>
        </article>
        <article class="tarjetas" class="centered-link">
            <button onclick="mostrarOpciones('plato')">
                Platos
            </button>
        </article>
        <article class="tarjetas">
            <button onclick="mostrarOpciones('menu')">
                Menús
            </button>
        </article>
    </section>

    <!-- Dietas  -->

    <section class="contenedorDietas" id="opcionesDieta">
        <article class="subContenedorTitulo">
            Agregar Dieta
        </article>
        
        <article class="subContenedorDatos">
            <form action="2registrarDieta.php" method="post" enctype="multipart/form-data" class="formDieta">
                <div class="divDatosDieta" class="divDatosDietaNombre">
                    <label for="nombreDietas">Nombre:</label>
                    <br>
                    <input type="text" name="nombreDieta" id="nombreDietas" placeholder="Dieta...">
                    <button class="botonEnviarDieta">Enviar</button>
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
        
        <form action="2registrarPlato.php" method="post" enctype="multipart/form-data">
            <article class="subContenedorDatosSuperior">
                    <div class="divDatosPlato">
                        <label for="nombrePlatos">Nombre:</label>
                        <br>
                        <input type="text" name="nombrePlato" id="nombrePlatos" placeholder="Plato...">
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
                    <div class="divDatosPlato">
                        <label for="imgPlato">Imagen:</label>
                        <br>
                        <input type="file" name="imagenPlato" id="imgPlato">
                    </div>
            </article>
            <article class="subContenedorDatosInferior">
                <div class="divDatosPlato">
                    <label for="Pdiet">Ingredientes:</label>
                    <br>
                    <textarea name="ingredientesPlato" id="" cols="45" rows="7"></textarea>
                </div>
                <div class="divDatosPlato">
                    <button class="botonEnviarDieta">
                        Enviar
                    </button>
                </div>
            </article>
        </form>
    </section>

    <!-- menus -->

    <section class="contenedorMenus" id="opcionesMenu">
        <article class="subContenedorTitulo">
            Agregar Menu
        </article>
        <form action="2registrarMenu.php" method="post" enctype="multipart/form-data">
            <article class="subContenedorSuperiorDatosMenu">
                <div class="divDatosMenuNombre">
                    <label for="Mdiet">Nombre:</label>
                    <br>
                    <input type="text" name="nombreMenu" id="Mdiet" placeholder="Menu...">
                </div>
            </article>
            <article class="subContenedorInternoDatosMenu">
                <!--  -->
                <div class="divDatosMenu">
                    <label for="Pdietas">Selecciona un Plato:</label>
                    <br>
                    <select id="Pdietas" name="platoMenu1">
                        <?php
                        while ($row = mysqli_fetch_assoc($result2)) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <?php
                    mysqli_close($con2);
                    ?>
                </div>
                <!--  -->
                <div class="divDatosMenu">
                    <label for="Pdietas2">Selecciona un Plato:</label>
                    <br>
                    <select id="Pdietas2" name="platoMenu2">
                    <?php
                        while ($row = mysqli_fetch_assoc($result3)) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <?php
                    mysqli_close($con3);
                    ?>
                </div>
            </article>
            <!--  -->
            <article class="subContenedorInternoDatosMenu">
                <!--  -->
                <div class="divDatosMenu">
                    <label for="Pdietas3">Selecciona un Plato:</label>
                    <br>
                    <select id="Pdietas3" name="platoMenu3">
                    <?php
                        while ($row = mysqli_fetch_assoc($result4)) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <?php
                    mysqli_close($con4);
                    ?>
                </div>
                <!--  -->
                <div class="divDatosMenu">
                    <label for="Pdietas4">Selecciona un Plato:</label>
                    <br>
                    <select id="Pdietas4" name="platoMenu4">
                    <?php
                        while ($row = mysqli_fetch_assoc($result5)) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <?php
                    mysqli_close($con5);
                    ?>
                </div>
            </article>
            <!--  -->
            <article class="subContenedorInferiorDatosMenu">
                <!--  -->
                <div class="divDatosMenu">
                    <label for="Pdietas5">Selecciona un Plato:</label>
                    <br>
                    <select id="Pdietas5" name="platoMenu5">
                    <!-- php -->
                    <?php
                        while ($row = mysqli_fetch_assoc($result6)) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    <!-- php -->
                    </select>
                    <!-- php -->
                    <?php
                    mysqli_close($con6);
                    ?>
                    <!-- php -->
                    <br><br><br>
                    <label for="precioMenus">Precio:</label>
                    <br>
                    <input type="number" name="precioMenu" minlength="1" id="precioMenus">
                    <br><br>
                    <label for="durabilidadMenus">Durabilidad:</label>
                    <br>
                    <input type="number" name="durabilidadMenu" minlength="1" class="datosMenu" id="durabilidadMenus">
                </div>
                <!--  -->
                <div class="divDatosMenu">
                    <label>Imagen:</label>
                    <br>
                    <input type="file" name="imagenMenu" class="datosMenu">
                    <br><br>
                    <label for="stockTechoMenus">Stock Techo:</label>
                    <br>
                    <input type="number" name="stockTecho" minlength="1" class="datosMenu" id="stockTechoMenus">
                    <br><br>
                    <label for="stockPisoMenus">Stock Piso:</label>
                    <br>
                    <input type="number" name="stockPiso" minlength="1" class="datosMenu" id="stockPisoMenus">
                    <br><br>
                    <button class="botonEnviarMenu">Enviar</button>
                </div>
            </article>
        </form>
    </section>
    <!--  -->
    <footer>
        <section>
            <a href="#hd">Volver arriba</a>
        </section>
        <p>Copyright - Prometeo BND</p>

    </footer>

    <script src="main.js"></script>
</body>

</html>