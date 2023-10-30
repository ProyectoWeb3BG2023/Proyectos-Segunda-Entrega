<?php
include("../../datos/conexion/conexion.php");
session_start();

$con = conectar();
$query = "SELECT *
FROM cliente
WHERE autorizacion = 0";

$result = mysqli_query($con, $query);
$filas = mysqli_fetch_array($result);
$fil = mysqli_fetch_array($result);
var_dump($filas);

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
                <a href="homepage.php" class="linkCentrado">Home</a>
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

    <section class="contenedorFormularios">
        <?php
        $i = 1;
        $count = 0;
        foreach( $result as $row ){
        $_SESSION['nombre'] = $row['primer_nombre'];
            if( $i == 1 ) {
                echo '<article class="subContenedorFormularios">';
                echo '<div class="divFormulario">';
                echo '    <h2>Formulario</h2>';
                echo '    <h3>' . $row['id_cliente'] . '</h3>';
                echo '    <h3>' . $row['tipo_documento'] . '</h3>';
                if ( $row['tipo_documento'] == 'CI' ){
                    echo '<a href="homeFormWeb.php"><p>🛈</p></a>';

                } else {
                    echo '<a href="homeFormEmpresa.html"><p>🛈</p></a>';
                }
                echo '</div>';
                $i++;

            } else if ( $i == 3 ){
                echo '<div class="divFormulario">';
                echo '    <h2>Formulario</h2>';
                echo '    <h3>' . $row['id_cliente'] . '</h3>';
                echo '    <h3>' . $row['tipo_documento'] . '</h3>';
                if ( $row['tipo_documento'] == 'CI' ){
                    echo '   <a href="homeFormWeb.php"><p>🛈</p></a>';
                } else {
                echo '   <a href="homeFormEmpresa.html"><p>🛈</p></a>';
                }
                echo '</div>';
                echo '</article>';
                $i=1;
            } else {
                echo '<div class="divFormulario">';
                echo '    <h2>Formulario</h2>';
                echo '    <h3>'. $row['id_cliente'] . '</h3>';
                echo '    <h3>' . $row['tipo_documento'] . '</h3>';
                if ( $row['tipo_documento'] == 'CI' ){
                    
                    echo '   <a href="homeFormWeb.php"><p>🛈</p></a>';

                } else {
                echo '   <a href="homeFormEmpresa.html"><p>🛈</p></a>';
                }
                echo '</div>';
                $i++;
            }
        }
        mysqli_close($con);
        // session_destroy();
        ?>
        
    </section>
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