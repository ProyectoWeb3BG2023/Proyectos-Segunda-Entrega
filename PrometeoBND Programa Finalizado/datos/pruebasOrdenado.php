<?php
    session_start();
    include("conexion/conexion.php");

    $con = conectar();

    $consulta = "SELECT integra.id_tipo_menu FROM `integra` GROUP BY `integra`.`id_tipo_menu` ASC";
    $resultado = mysqli_query($con, $consulta);

    $query2 = "SELECT id_comida, nombre FROM comida";
    $result2 = mysqli_query($con, $query2);
    
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
    <title>Gestión</title>
    <link rel="stylesheet" href="../recursos/css/fonts.css">
    <link rel="stylesheet" href="../recursos/css/header.css">
    <link rel="stylesheet" href="../recursos/css/footercVolverArriba.css">
    <link rel="stylesheet" href="../recursos/css/atencionCliente/styleFormularios.css">
    <link rel="icon" href="../recursos/img/logo.png">
</head>
<body>
    <!-- <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.html">
                    <img src="../recursos/img/logo.png">
                </a>
                <a href="homepage.html" class="linkCentrado">Home</a>
            </div>

            <div class="divSubContenedorDerecha">
                <a class="linkCentrado">Vista de Pruebas</a>

                <img src="../recursos/img/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header> -->

    <!-- ////////////////////////////////////////////////////////////////////// -->
    <?php
    
    if(mysqli_num_rows($resultado) >= 1){
    echo "<h2>Menus para autorizar</h2>";
    $i = 1;
    $count = 0;

    foreach ($resultado as $row) {
        $id = $row['id_tipo_menu'];
        $nombrePrecio = "SELECT tipo_menu.nombre, tipo_menu.precio
                         FROM tipo_menu
                         WHERE id_tipo_menu = $id ";

        $resultadoNombrePrecio = mysqli_query($con, $nombrePrecio);
        // var_dump($resultadoNombrePrecio);
        // echo "<br>";
        // echo $row['id_tipo_menu'];

        $consult = "SELECT comida.nombre
                    FROM comida
                    WHERE comida.id_comida
                    IN (SELECT id_comida
                        FROM integra
                        WHERE id_tipo_menu = $id )";
        $result = mysqli_query($con, $consult);
        // var_dump($result);
        // echo "<br>";
        // echo "<br>";
        
    // k
        if( $i == 1 ) {
            echo "<article class='subContenedorFormularios'>";
            echo "  <div class='divFormulario'>";
            echo '      <h2>Formulario</h2>';
            echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
            while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                $nombre = $fila['nombre'];
                $precio = $fila['precio'];
                echo "<input type='text' name='nombremenu' value='$nombre'>";
                echo "<input type='text' name='preciomenu' value='$precio'>";
            }
            $z = 1;
            while ($fila = mysqli_fetch_assoc($result)) {
                $comida = $fila['nombre'];
            
                $nombres = array();
                foreach ($result2 as $row) {
                    $nombres[] = $row['nombre'];
                }
            
                echo "<select id='Pdietas' name='platoMenu[]'>";
                foreach ($nombres as $nombreDieta) {
                    $selected = ($nombreDieta == $nombres[$z]) ? 'selected' : '';
                    echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                }
                echo "</select>";
            
                $z++;
            }
            echo "          <div class='botonesRespuestaFormulario'>";
            echo "              <button type='submit' class='boton' name='opcion' value='0'>Aprobado</button>";
            echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
            echo "          </div>";
            echo "        </form>";
            echo '  </div>';
            $i++;
        } else if ( $i == 3 ){
            echo '<div class="divFormulario">';
            echo '      <h2>Formulario</h2>';
            echo "      <form action='../../datos/ABMdieta.php' method='post' enctype='multipart/form-data'>";
            while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                $nombre = $fila['nombre'];
                $precio = $fila['precio'];
                echo "<input type='text' value='$nombre'>";
                echo "<input type='text' value='$precio'>";
            }
            $z = 1;
            while ($fila = mysqli_fetch_assoc($result)) {
                $comida = $fila['nombre'];
            
                $nombres = array();
                foreach ($result2 as $row) {
                    $nombres[] = $row['nombre'];
                }
            
                echo "<select id='Pdietas' name='platoMenu[]'>";
                foreach ($nombres as $nombreDieta) {
                    $selected = ($nombreDieta == $nombres[$z]) ? 'selected' : '';
                    echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                }
                echo "</select>";
            
                $z++;
            }
            echo "          <div class='botonesRespuestaFormulario'>";
            echo "              <button type='submit' class='boton' name='opcion' value='0'>Aprobado</button>";
            echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
            echo "          </div>";
            echo "        </form>";
            echo '  </div>';
            echo '</article>';
            $i=1;
        } else {
            echo "  <div class='divFormulario'>";
            echo '      <h2>Formulario</h2>';
            echo "      <form action='../../datos/ABMdieta.php' method='post' enctype='multipart/form-data'>";
            while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                $nombre = $fila['nombre'];
                $precio = $fila['precio'];
                echo "<input type='text' value='$nombre'>";
                echo "<input type='text' value='$precio'>";
            }
            // while ($fila = mysqli_fetch_assoc($result)) {
            //     $comida = $fila['nombre'];
            //     echo "<select id='Pdietas' name='platoMenu1'>";
            //         $nombreDietaPorDefecto = $fila['nombre']; // Cambia esto al nombre de tu dieta por defecto
            //         foreach ($result2 as $row) {
            //             $selected = ($row['nombre'] == $nombreDietaPorDefecto) ? 'selected' : '';
            //             echo '<option value="' . $row['id_comida'] . '" ' . $selected . '>' . $row['nombre'] . '</option>';
            //         }
            //     echo "</select>";
            // }
            $z = 1;
            while ($fila = mysqli_fetch_assoc($result)) {
                $comida = $fila['nombre'];
            
                $nombres = array();
                foreach ($result2 as $row) {
                    $nombres[] = $row['nombre'];
                }
            
                echo "<select id='Pdietas' name='platoMenu[]'>";
                foreach ($nombres as $nombreDieta) {
                    $selected = ($nombreDieta == $nombres[$z]) ? 'selected' : '';
                    echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                }
                echo "</select>";
            
                $z++;
            }
            echo "          <div class='botonesRespuestaFormulario'>";
            echo "              <button type='submit' class='boton' name='opcion' value='0'>Aprobado</button>";
            echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
            echo "          </div>";
            echo "        </form>";
            echo '  </div>';
            $i++;
        }
    }

    // k
}
?>

<?php
    mysqli_close($con);
?>


    <!-- <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>
        <p>Copyright - Prometeo BND</p>
    </footer> -->
</body>
</html>