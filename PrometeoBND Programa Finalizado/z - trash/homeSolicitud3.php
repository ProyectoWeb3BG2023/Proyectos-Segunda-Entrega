<?php
    session_start();
    include("../../datos/conexion/conexion.php");
    $con = conectar();

    if (!isset($_SESSION['identificadorCliente'])) {
        header('Location: formularioLogin.html');
        exit();
    }

    $dietasSinAutorizacion = "SELECT *
    FROM dieta
    WHERE autorizacion = 0";

    $resultadoDietas = mysqli_query($con, $dietasSinAutorizacion);
// c
    $comidasSinAutorizacion = "SELECT *
    FROM comida
    WHERE autorizacion = 0";

    $resultadoComidas = mysqli_query($con, $comidasSinAutorizacion);


    $MenusSinAutorizacionPrehechos = "SELECT *
    FROM tipo_menu
    JOIN integra ON tipo_menu.id_tipo_menu = integra.id_tipo_menu
    WHERE tipo_menu.autorizacion = 0
    AND integra.personalizado = 0";

    $resultadoMenusPrehechos = mysqli_query($con, $MenusSinAutorizacionPrehechos);
    // var_dump($resultadoMenusPrehechos);


    $consulta = "SELECT integra.id_tipo_menu FROM `integra` GROUP BY `integra`.`id_tipo_menu` ASC";
    $resultado = mysqli_query($con, $consulta);


    $query2 = "SELECT id_comida, nombre FROM comida";
    $idNombreComidas = mysqli_query($con, $query2);

    // $j = 0;
    foreach ($idNombreComidas as $row) {
        $nombresComidas[] = $row['nombre'];
        $idsComidas[] = $row['id_comida'];
        // echo $nombresComidas[$j];
        // echo $idsComidas[$j];

        // echo "__";

        // $j++;
    }

    $sql = "SELECT id_tipo_menu, id_comida FROM integra";
    $result = $con->query($sql);

if ($result->num_rows > 0) {
    // Crear un array para almacenar los valores
    $valores = array();

    // Recorrer el resultado de la consulta y almacenar los valores en el array
    while ($row = $result->fetch_assoc()) {
        $valores[] = array($row['id_tipo_menu'], $row['id_comida']);
    }

    // Ahora puedes acceder a los valores en el array
    foreach ($valores as $valor) {
        $id_menu = $valor[0];
        $id_comida = $valor[1];
        // echo $id_menu;
        // echo "_";
        // echo $id_comida;
        // echo "_";

        // Hacer algo con $id_menu y $id_comida, como almacenarlos en variables o procesarlos de alguna manera
    }
} else {
    echo "No se encontraron resultados en la tabla integra.";
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
    <meta name="keywords" content="">
    <link rel="stylesheet" href="../../recursos/css/fonts.css">
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    <link rel="stylesheet" href="../../recursos/css/gerente/styleNuevo.css">
    <link rel="stylesheet" href="../../recursos/css/atencionCliente/styleFormularios.css">
    <link rel="icon" href="../../recursos/img/logo.png">
    <title>Ingreso Nuevo</title>
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
                        <?php echo $_SESSION['nombre_usuario']; ?>
                    </a>
                    <img src="../../recursos/img/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header>

    <!-- Dietas -->
    <?php
    if(mysqli_num_rows($resultadoDietas) >= 1){
        echo "<h2>Dietas para revisar</h2>";
        echo "<section class='contenedorFormularios'>";
            $i = 1;
            $count = 0;
            foreach( $resultadoDietas as $row ){
            // $_SESSION['nombre'] = $row['primer_nombre'];
            $idDieta = $row['id_dieta'];
            $nombreDieta = $row['nombre_dieta'];
            $descripcionDieta = $row['descripcion'];

            if( $i == 1 ) {
                echo "<article class='subContenedorFormularios'>";
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMdieta.php' method='post' enctype='multipart/form-data'>";
                echo "          <input type='text' name='dieta_id' value='$idDieta' readonly>";
                echo "          <input type='text' name='nombredieta' value='$nombreDieta'>";
                echo "          <input type='text' name='descripciondieta' value='$descripcionDieta'>";
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
                echo "          <input type='text' name='dieta_id' value='$idDieta' readonly>";
                echo "          <input type='text' name='nombredieta' value='$nombreDieta'>";
                echo "          <input type='text' name='descripciondieta' value='$descripcionDieta'>";
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
                echo "          <input type='text' name='dieta_id' value='$idDieta' readonly>";
                echo "          <input type='text' name='nombredieta' value='$nombreDieta'>";
                echo "          <input type='text' name='descripciondieta' value='$descripcionDieta'>";
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='opcion' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            }
        }
        // mysqli_close($con);
    echo "</section>";
    } else {
        echo "<h2>No existen dietas para revisar</h2>";
    }
    ?>

    <!-- k -->

    <?php
    if(mysqli_num_rows($resultadoComidas) >= 1){
        echo "<h2>Comidas para revisar</h2>";
        echo "<section class='contenedorFormularios'>";
            $i = 1;
            $count = 0;
            foreach( $resultadoComidas as $row ){
            // $_SESSION['nombre'] = $row['primer_nombre'];
            $idComida = $row['id_comida'];
            $nombreComida = $row['nombre'];
            $descripcionComida = $row['descripcion'];
            $ingredientesComida = $row['ingredientes'];

            if( $i == 1 ) {
                echo "<article class='subContenedorFormularios'>";
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMcomida.php' method='post' enctype='multipart/form-data'>";
                echo "          <input type='text' name='comida_id' value='$idComida' readonly>";
                echo "          <input type='text' name='nombrecomida' value='$nombreComida'>";
                echo "          <input type='text' name='descripcioncomida' value='$descripcionComida'>";
                echo "          <input type='text' name='ingredientescomida' value='$ingredientesComida'>";
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
                echo "      <form action='../../datos/ABMcomida.php' method='post' enctype='multipart/form-data'>";
                echo "          <input type='text' name='comida_id' value='$idComida' readonly>";
                echo "          <input type='text' name='nombrecomida' value='$nombreComida'>";
                echo "          <input type='text' name='descripcioncomida' value='$descripcionComida'>";
                echo "          <input type='text' name='ingredientescomida' value='$ingredientesComida'>";
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
                echo "      <form action='../../datos/ABMcomida.php' method='post' enctype='multipart/form-data'>";
                echo "          <input type='text' name='comida_id' value='$idComida' readonly>";
                echo "          <input type='text' name='nombrecomida' value='$nombreComida'>";
                echo "          <input type='text' name='descripcioncomida' value='$descripcionComida'>";
                echo "          <input type='text' name='ingredientescomida' value='$ingredientesComida'>";
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='opcion' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            }
        }
    echo "</section>";
    } else {
        echo "<h2>No existen dietas para revisar</h2>";
    }
    //  mysqli_close($con);
    ?>


<?php
    
    if(mysqli_num_rows($resultado) >= 1){
    echo "<h2>Menus para autorizar</h2>";
    $i = 1;
    $count = 0;

    foreach ($resultado as $row) {
        $id = $row['id_tipo_menu'];
        // var_dump($id);
        $nombrePrecio = "SELECT tipo_menu.nombre, tipo_menu.precio
                         FROM tipo_menu
                         WHERE id_tipo_menu = $id ";

        $resultadoNombrePrecio = mysqli_query($con, $nombrePrecio);
        // var_dump($resultadoNombrePrecio);
        // echo "<br>";
        // echo $row['id_tipo_menu'];

        $consult = "SELECT comida.nombre, comida.id_comida
                    FROM comida
                    WHERE comida.id_comida
                    IN (SELECT id_comida
                        FROM integra
                        WHERE id_tipo_menu = $id )";

        $result = mysqli_query($con, $consult);
        // $ids = "SELECT tipo_menu.id_tipo_menu, integra.id_comida FROM tipo_menu, integra WHERE integra.id_tipo_menu = $id";
        // $resultadoIds = mysqli_query($con, $ids);
        // var_dump($resultadoIds);

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
                echo "<input type='hidden' name='idmenus' value='$id'>";
                echo "<input type='text' name='nombremenu' value='$nombre'>";
                echo "<input type='text' name='preciomenu' value='$precio'>";
            }

            $z = 1;
            while ($fila = mysqli_fetch_assoc($result)) {
                $comida = $fila['nombre'];
                $idd= $fila['id_comida'];
            
                // $nombres = array();
                // foreach ($idNombreComidas as $row) {
                //     $nombres[] = $row['nombre'];
                // }
            
                echo "<select id='Pdietas' name='platoMenu[]'>";
                foreach ($nombresComidas as $nombreDieta) {
                    $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                    echo '<option value="' . $idd . '" ' . $selected . '>' . $nombreDieta . '</option>';
                }
                echo "</select>";
            
                $z++;
            }

            // $platoMenuL = array();
            // foreach ($platoMenuL as $row) {
            //     $platoMenuL[] = $row['id_comida'];
            // }
            // echo "<input type='hidden' name='plato1' value='$platoMenuL[0]'>";
            // echo "<input type='hidden' name='plato2' value='$platoMenuL[1]'>";
            // echo "<input type='hidden' name='plato3' value='$platoMenuL[2]'>";
            // echo "<input type='hidden' name='plato4' value='$platoMenuL[3]'>";
            // echo "<input type='hidden' name='plato5' value='$platoMenuL[4]'>";
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
            echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
            while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                $nombre = $fila['nombre'];
                $precio = $fila['precio'];
                echo "<input type='hidden' name='idmenus' value='$id'>";
                echo "<input type='text' name='nombremenu' value='$nombre'>";
                echo "<input type='text' name='preciomenu' value='$precio'>";
            }
            $z = 1;
            while ($fila = mysqli_fetch_assoc($result)) {
                $comida = $fila['nombre'];
            
                // $nombres = array();
                // foreach ($idNombreComidas as $row) {
                //     $nombres[] = $row['nombre'];
                // }
            
                echo "<select id='Pdietas' name='platoMenu[]'>";
                
                // 
                foreach ($nombresComidas as $nombreDieta) {

                    $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
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
            echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
            while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                $nombre = $fila['nombre'];
                $precio = $fila['precio'];
                echo "<input type='hidden' name='idmenus' value='$id'>";
                echo "<input type='text' name='nombremenu' value='$nombre'>";
                echo "<input type='text' name='preciomenu' value='$precio'>";
            }
            $z = 1;
            while ($fila = mysqli_fetch_assoc($result)) {
                $comida = $fila['nombre'];
                $idsComida = $fila['id_comida'];
            
                // $nombres = array();
                // foreach ($idNombreComidas as $row) {
                //     $nombres[] = $row['nombre'];
                // }
            
                echo "<select id='Pdietas' name='platoMenu[]'>";
                foreach ($nombresComidas as $nombreDieta) {
                    $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                    echo '<option value="' . $fila['id_comida'] . '" ' . $selected . '>' . $nombreDieta . '</option>';
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
    mysqli_close($con);

    // k
}
    ?>



    <!-- <footer>
        <p>Copyright - Prometeo BND</p>
    </footer> -->
</body>
</html>