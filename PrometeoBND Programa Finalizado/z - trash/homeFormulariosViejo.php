<?php
include("../../datos/conexion/conexion.php");
session_start();
$con = conectar();

$query = "SELECT *
FROM cliente
WHERE autorizacion = 0";

$query2 = "SELECT COUNT(*) as clientes
FROM cliente
WHERE autorizacion = 0";

$result = mysqli_query($con, $query);
$result2 = mysqli_query($con, $query2);

$totalClientes = mysqli_fetch_assoc($result2);
$cantidadClientes = $totalClientes['clientes'];
echo "$cantidadClientes ";

$filas = mysqli_fetch_array($result);
$fil = mysqli_fetch_array($result);

$_SESSION["suma"] = 1;
$f = $_SESSION["suma"];
// var_dump($filas);


//  for( $i = 1; $i <= $cantidadClientes; $i++) {
    
//     $_SESSION['arreglou'] = $nombreArreglo;
//  }

// $_SESSION['datos_clientes'] = $containerArrays;

// var_dump($_SESSION['datos_clientes']);

// $_SESSION['nombre'] = $row['primer_nombre'];
// $nombre = $_SESSION['nombre'];



// if (mysqli_num_rows($result) > 0) {
//     $data = mysqli_fetch_all($result, MYSQLI_ASSOC); // Obtener todas las filas como un arreglo asociativo

//     foreach ($data as $row2) {
//         // Acceder a los datos de cada fila a través del bucle foreach
//         $idCliente = $row2['id_cliente'];
//         $nombre = $row2['primer_nombre'];
//         $apellido = $row2['primer_apellido'];

//         // Hacer algo con los datos de cada fila
//         echo "ID Cliente: $idCliente<br>";
//         echo "Nombre: $nombre<br>";
//         echo "Apellido: $apellido<br>";
//         echo "<br>";
//     }
// } else {
//     echo "No se encontraron resultados.";
// }


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
    <!-- <link rel="stylesheet" href="../../recursos/css/fonts.css"> -->
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
        // $_SESSION['begin'] = 1;
        // $inicio = $_SESSION['begin'];

        // for( $_SESSION['begin'] = 1; $_SESSION['begin'] <= $cantidadClientes; $_SESSION['begin']++ ) {
        //     $inicio = $_SESSION['begin'];
        //     echo $inicio;
        //     $_SESSION['pp'] = $_SESSION["idWeb$inicio"];

        //  foreach( $result as $row ){
        // foreach( $containerArrays as $row ){
            //   $_SESSION['identCliente'] = $row[0];
            //   $_SESSION['nombreCliente'] = $row[1];
            //  $_SESSION['segNombre'] = $row[2];
            //  $_SESSION['apellido'] = $row[3];
            //  $_SESSION['segApellido'] = $row[4];
            //  $_SESSION['documento'] = $row[5];
            //   $_SESSION['tipoDocumento'] = $row[6];
            //  $_SESSION['mail'] = $row[7];
            //  $_SESSION['calle'] = $row[8];
            //  $_SESSION['puerta'] = $row[9];
            //  $_SESSION['esquina'] = $row[10];

            // for($asd = 0; $asd < 11; $asd++){
            //     echo "$row[$asd] ";
            //     echo "<br>";
            // }

            
    
        foreach( $result as $datitos ) {
            
            $_SESSION["idcl"] = $datitos['id_cliente'];

            echo $datitos['primer_nombre'];
            echo "_";
             if( $i == 1 ) {
                  echo '<article class="subContenedorFormularios">';
                  echo '<div class="divFormulario">';
                  echo '    <h2>Formulario</h2>';
                   echo '    <h3>' . $datitos['primer_nombre'] . '</h3>';
                   echo '    <h3>' . $datitos['tipo_documento'] . '</h3>';
                    echo '    <h3>' . $datitos['id_cliente'] . '</h3>';
                  if ( $datitos['tipo_documento'] == 'RUT' ){
                     echo '   <a href="homeFormEmpresa.php"><p>🛈</p></a>';
                  } else {
                     echo '   <a href="homeFormWeb.php"><p>🛈</p></a>';
                  }
                  echo '</div>';
                  $i++;

              } else if ( $i == 3 ){
                  echo '<div class="divFormulario">';
                  echo '    <h2>Formulario</h2>';
                  echo '    <h3>' . $datitos['primer_nombre'] . '</h3>';
                   echo '    <h3>' . $datitos['tipo_documento'] . '</h3>';
                    echo '    <h3>' . $datitos['id_cliente'] . '</h3>';

                  if ( $datitos['tipo_documento'] == 'CI' ){
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
                  echo '    <h3>' . $datitos['primer_nombre'] . '</h3>';
                  echo '    <h3>' . $datitos['tipo_documento'] . '</h3>';
                   echo '    <h3>' . $datitos['id_cliente'] . '</h3>';

                  if ( $datitos['tipo_documento'] == 'CI' ){

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