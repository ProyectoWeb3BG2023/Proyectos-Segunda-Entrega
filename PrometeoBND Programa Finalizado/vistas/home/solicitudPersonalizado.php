<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();

    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }


    $query = "SELECT id_comida, nombre FROM comida";
    $result2 = mysqli_query($con, $query);
    

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
    <link rel="stylesheet" href="../../recursos/css/cliente/styleSolicitudPersonalizado.css">

    <link rel="stylesheet" href ="../../recursos/css/footercVolverArriba.css">
    <link rel="icon" href="../../recursos/img/logo.png">
    <title>Creación de Menús</title>
</head>
<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homeUL.php">
                    <img src="../../recursos/img/logo.png">
                </a>

                <a href="homeUL.php" class="linkCentrado"><span>Home</span></a>

            </div>

            <div class="divSubContenedorDerecha">
                <a href="../../datos/logout.php" class="linkCentrado">Cerrar Sesión</a>
                <a class="linkCentrado">
                    <?php
                        if(isset($_SESSION['nombre_usuarioCliente'])) {
                            if($_SESSION['tipoDocumentoCliente'] == "RUT"){
                                echo "<a href='../cliente/perfiles/empresa/perfilEmpresa.php'>" . $_SESSION['nombre_usuarioCliente'] ." </a>";
                            } else {
                                echo "<a href='../cliente/perfiles/web/perfilWeb.php'>" . $_SESSION['nombre_usuarioCliente'] ." </a>";
                            }
                        }
                    ?>
                </a>
            </div>
        </div>
    </header>
    
    <!-- c -->
    <section class="tarjeta">
        <article class="tarjetas">
            <button class="boton" id="btn5">
                5
            </button>
        </article>
        <article class="tarjetas">
            <button class="boton" id="btn10">
                10
            </button>
        </article>
        <article class="tarjetas">
            <button class="boton" id="btn20">
                20
            </button>
        </article>
    </section>
    <!-- c -->

    <section class="contenedorMenus contenedorMenus5" id="opciones5">
        <article class="subContenedorTitulo">
            Agregar Menu 5
        </article>
        <form action="../../datos/registrarMenu.php" method="post" enctype="multipart/form-data" class="containerFormm">
            <article class="subContenedorSuperiorDatosMenu">
                <div class="divDatosMenuNombre">
                    <label for="Mdiet">Nombre:</label>
                    <br>
                    <input type="text" name="nombreMenu" id="Mdiet" placeholder="Menu...">
                </div>
            </article>
            <article class="subContenedorInternoDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato1">Selecciona un Plato:</label>
                    <br>
                    <select id="plato1" name="platoMenu1">
                        <?php
                            foreach($result2 as $row) {
                                echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato2">Selecciona un Plato:</label>
                    <br>
                    <select id="plato2" name="platoMenu2">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </article>
            <article class="subContenedorInternoDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato3">Selecciona un Plato:</label>
                    <br>
                    <select id="plato3" name="platoMenu3">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu4">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </article>
            <article class="subContenedorInferiorDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato5">Selecciona un Plato:</label>
                    <br>
                    <select id="plato5" name="platoMenu5">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <button class="botonEnviarMenu" type="submit" name="boton5" value="5">Enviar</button>
                </div>
            </article>
        </form>
    </section>

    <!-- c -->

    <section class="contenedorMenus contenedorMenus10" id="opciones10">
        <article class="subContenedorTitulo">
            Agregar Menu 10
        </article>
        <form action="../../datos/registrarMenu.php" method="post" enctype="multipart/form-data">
            <article class="subContenedorSuperiorDatosMenu">
                <div class="divDatosMenuNombre">
                    <label for="Mdiet">Nombre:</label>
                    <br>
                    <input type="text" name="nombreMenu" id="Mdiet" placeholder="Menu...">
                </div>
            </article>

            <article class="subContenedorInternoDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato1">Selecciona un Plato:</label>
                    <br>
                    <select id="plato1" name="platoMenu1">
                        <?php
                            foreach($result2 as $row) {
                                echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato2">Selecciona un Plato:</label>
                    <br>
                    <select id="plato2" name="platoMenu2">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </article>
            
            <article class="subContenedorInternoDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato3">Selecciona un Plato:</label>
                    <br>
                    <select id="plato3" name="platoMenu3">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu4">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </article>

            <article class="subContenedorInternoDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato3">Selecciona un Plato:</label>
                    <br>
                    <select id="plato3" name="platoMenu5">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu6">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </article>

            <article class="subContenedorInternoDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato3">Selecciona un Plato:</label>
                    <br>
                    <select id="plato3" name="platoMenu7">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu8">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </article>

            <article class="subContenedorInternoDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato3">Selecciona un Plato:</label>
                    <br>
                    <select id="plato3" name="platoMenu9">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu10">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </article>
            <article class="subContenedorInferiorDatosMenu">
                <div class="divDatosMenu">
                    <button class="botonEnviarMenu" type="submit" name="boton10" value="10">Enviar</button>
                </div>
            </article>
        </form>
    </section>

    <!-- c -->

    <section class="contenedorMenus contenedorMenus20" id="opciones20">
        <article class="subContenedorTitulo">
            Agregar Menu 20
        </article>
        <form action="../../datos/registrarMenu.php" method="post" enctype="multipart/form-data">
            <article class="subContenedorSuperiorDatosMenu">
                <div class="divDatosMenuNombre">
                    <label for="Mdiet">Nombre:</label>
                    <br>
                    <input type="text" name="nombreMenu" id="Mdiet" placeholder="Menu...">
                </div>
            </article>
            <article class="subContenedorInternoDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato1">Selecciona un Plato:</label>
                    <br>
                    <select id="plato1" name="platoMenu1">
                        <?php
                            foreach($result2 as $row) {
                                echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato2">Selecciona un Plato:</label>
                    <br>
                    <select id="plato2" name="platoMenu2">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato2">Selecciona un Plato:</label>
                    <br>
                    <select id="plato2" name="platoMenu3">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato2">Selecciona un Plato:</label>
                    <br>
                    <select id="plato2" name="platoMenu4">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </article>
            <article class="subContenedorInternoDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato3">Selecciona un Plato:</label>
                    <br>
                    <select id="plato3" name="platoMenu5">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu6">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu7">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu8">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </article>

            <article class="subContenedorInternoDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato3">Selecciona un Plato:</label>
                    <br>
                    <select id="plato3" name="platoMenu9">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu10">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu11">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu12">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </article>

            <article class="subContenedorInternoDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato3">Selecciona un Plato:</label>
                    <br>
                    <select id="plato3" name="platoMenu13">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu14">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu15">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu16">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </article>

            <article class="subContenedorInternoDatosMenu">
                <div class="divDatosMenu">
                    <label for="plato3">Selecciona un Plato:</label>
                    <br>
                    <select id="plato3" name="platoMenu17">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu18">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu19">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="divDatosMenu">
                    <label for="plato4">Selecciona un Plato:</label>
                    <br>
                    <select id="plato4" name="platoMenu20">
                    <?php
                        foreach($result2 as $row) {
                            echo '<option value="' . $row['id_comida'] . '">' . $row['nombre'] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </article>
            <article class="subContenedorInferiorDatosMenu">
                <div class="divDatosMenu">
                    <button class="botonEnviarMenu" type="submit" name="boton20" value="20">Enviar</button>
                </div>
            </article>
        </form>
    </section>

   <script src="../../recursos/js/cliente/mainMenuPersonalizado.js"></script>
</body>
</html>