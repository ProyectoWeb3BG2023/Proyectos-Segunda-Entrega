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
// c

    // Menús de 5 platos - Usuario

    $consulta5 = "SELECT integra.id_tipo_menu, integra.cantidad_comida
    FROM integra, tipo_menu 
    WHERE integra.personalizado = 0 
    AND tipo_menu.autorizacion = 0
    AND integra.cantidad_comida = 5
    AND integra.id_tipo_menu = tipo_menu.id_tipo_menu
    GROUP BY `integra`.`id_tipo_menu` ASC";

    $resultado5 = mysqli_query($con, $consulta5);

    // Menús de 10 platos - Usuario

    $consulta10 = "SELECT integra.id_tipo_menu, integra.cantidad_comida
    FROM integra, tipo_menu 
    WHERE integra.personalizado = 0 
    AND tipo_menu.autorizacion = 0
    AND integra.cantidad_comida = 10
    AND integra.id_tipo_menu = tipo_menu.id_tipo_menu
    GROUP BY `integra`.`id_tipo_menu` ASC";

    $resultado10 = mysqli_query($con, $consulta10);
    
    // Menús de 20 platos - Usuario
    $consulta20 = "SELECT integra.id_tipo_menu, integra.cantidad_comida
    FROM integra, tipo_menu 
    WHERE integra.personalizado = 0 
    AND tipo_menu.autorizacion = 0
    AND integra.cantidad_comida = 20
    AND integra.id_tipo_menu = tipo_menu.id_tipo_menu
    GROUP BY `integra`.`id_tipo_menu` ASC";

    $resultado20 = mysqli_query($con, $consulta20);

    // Menús de 5 platos - Cliente
    $consultaPersonalizados5 = "SELECT integra.id_tipo_menu, integra.cantidad_comida 
                                FROM integra, tipo_menu 
                                WHERE integra.personalizado <> 0 
                                AND tipo_menu.autorizacion = 0
                                AND integra.id_tipo_menu = tipo_menu.id_tipo_menu
                                AND integra.cantidad_comida = 5
                                GROUP BY integra.id_tipo_menu ASC";

    $resultadoMenusPersonalizados5 = mysqli_query($con, $consultaPersonalizados5);

    // Menús de 10 platos - Cliente

    $consultaPersonalizados10 = "SELECT integra.id_tipo_menu, integra.cantidad_comida 
                                FROM integra, tipo_menu 
                                WHERE integra.personalizado <> 0 
                                AND tipo_menu.autorizacion = 0
                                AND integra.id_tipo_menu = tipo_menu.id_tipo_menu
                                AND integra.cantidad_comida = 10
                                GROUP BY integra.id_tipo_menu ASC";

    $resultadoMenusPersonalizados10 = mysqli_query($con, $consultaPersonalizados10);

    // Menús de 20 platos - Cliente

    $consultaPersonalizados20 = "SELECT integra.id_tipo_menu, integra.cantidad_comida 
                                FROM integra, tipo_menu 
                                WHERE integra.personalizado <> 0 
                                AND tipo_menu.autorizacion = 0
                                AND integra.id_tipo_menu = tipo_menu.id_tipo_menu
                                AND integra.cantidad_comida = 20
                                GROUP BY integra.id_tipo_menu ASC";

    $resultadoMenusPersonalizados20 = mysqli_query($con, $consultaPersonalizados20);

// c

    $query2 = "SELECT id_comida, nombre FROM comida";
    $idNombreComidas = mysqli_query($con, $query2);

    foreach ($idNombreComidas as $row) {
        $nombresComidas[] = $row['nombre'];
        $idsComidas[] = $row['id_comida'];
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
    <link rel="stylesheet" href="../../recursos/css/gerente/styleFormularios.css">
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
        echo "<h2>No existen comidas para revisar</h2>";
    }
?>

<!-- Menus -->

<?php
    if(mysqli_num_rows($resultado5) >= 1){
        echo "<h2>Menus para autorizar - 5 platos - Usuarios</h2>";
        echo "<section class='contenedorFormularios'>";
        $i = 1;
        $count = 0;

        foreach ($resultado5 as $row) {
            $id = $row['id_tipo_menu'];
            $nombrePrecio = "SELECT nombre, precio, durabilidad, stock_piso, stock_techo, descripcion
                            FROM tipo_menu
                            WHERE id_tipo_menu = $id ";

            $resultadoNombrePrecio = mysqli_query($con, $nombrePrecio);
           
            $consult = "SELECT comida.nombre, comida.id_comida
                        FROM comida
                        WHERE comida.id_comida
                        IN (SELECT id_comida
                            FROM integra
                            WHERE id_tipo_menu = $id )";

            $result = mysqli_query($con, $consult);
        // k
            if( $i == 1 ) {
                echo "<article class='subContenedorFormularios'>";
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$id'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                    $nombre = $fila['nombre'];
                    $precio = $fila['precio'];
                    $durabilidad = $fila['durabilidad'];
                    $stockTecho = $fila['stock_techo'];
                    $stockPiso = $fila['stock_piso'];
                    $descripcion = $fila['descripcion'];

                    echo "<input type='text' name='nombremenu' value='$nombre' required>";
                    echo "<input type='text' name='preciomenu' value='$precio' required>";
                    echo "<input type='text' name='durabilidad' value='$durabilidad'required>";
                    echo "<input type='text' name='stocktecho' value='$stockTecho' required>";
                    echo "<input type='text' name='stockpiso' value='$stockPiso' required>";
                    echo "<input type='text' name='descripcion' value='$descripcion' required>";

                }
                $z = 1;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsPlatosPasados[] = $fila['id_comida'];
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton5' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            } else if ( $i == 3 ){
                echo '<div class="divFormulario">';
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$id'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                    $nombre = $fila['nombre'];
                    $precio = $fila['precio'];
                    $durabilidad = $fila['durabilidad'];
                    $stockTecho = $fila['stock_techo'];
                    $stockPiso = $fila['stock_piso'];
                    $descripcion = $fila['descripcion'];
                    echo "<input type='text' name='nombremenu' value='$nombre' required>";
                    echo "<input type='text' name='preciomenu' value='$precio' required>";
                    echo "<input type='text' name='durabilidad' value='$durabilidad'required>";
                    echo "<input type='text' name='stocktecho' value='$stockTecho' required>";
                    echo "<input type='text' name='stockpiso' value='$stockPiso' required>";
                    echo "<input type='text' name='descripcion' value='$descripcion' required>";

                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
              
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton5' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                echo '</article>';
                $i = 1;
            } else {
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$id'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                    $nombre = $fila['nombre'];
                    $precio = $fila['precio'];
                    $stockTecho = $fila['stock_techo'];
                    $stockPiso = $fila['stock_piso'];
                    $descripcion = $fila['descripcion'];
                    $durabilidad = $fila['durabilidad'];

                    echo "<input type='text' name='nombremenu' value='$nombre' required>";
                    echo "<input type='text' name='preciomenu' value='$precio' required>";
                    echo "<input type='text' name='durabilidad' value='$durabilidad'required>";
                    echo "<input type='text' name='stocktecho' value='$stockTecho' required>";
                    echo "<input type='text' name='stockpiso' value='$stockPiso' required>";
                    echo "<input type='text' name='descripcion' value='$descripcion' required>";

                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsComida = $fila['id_comida'];
                
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton5' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            }
        }
    echo "</section>";
    } else {
        echo "<h2>No existen menus para autorizar - 5 platos - Hecho por Usuarios</h2>";
    }
?>

<?php
    if(mysqli_num_rows($resultado10) >= 1){
        echo "<h2>Menus para autorizar - 10 platos - Usuarios</h2>";
        echo "<section class='contenedorFormularios'>";
        $i = 1;
        $count = 0;

        foreach ($resultado10 as $row) {
            $id = $row['id_tipo_menu'];
            $nombrePrecio = "SELECT nombre, precio, durabilidad, stock_techo, stock_piso, descripcion
                            FROM tipo_menu
                            WHERE id_tipo_menu = $id ";

            $resultadoNombrePrecio = mysqli_query($con, $nombrePrecio);
           
            $consult = "SELECT comida.nombre, comida.id_comida
                        FROM comida
                        WHERE comida.id_comida
                        IN (SELECT id_comida
                            FROM integra
                            WHERE id_tipo_menu = $id )";

            $result = mysqli_query($con, $consult);
        // k
            if( $i == 1 ) {
                echo "<article class='subContenedorFormularios'>";
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$id'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                    $nombre = $fila['nombre'];
                    $precio = $fila['precio'];
                    $durabilidad = $fila['durabilidad'];
                    $stockTecho = $fila['stock_techo'];
                    $stockPiso = $fila['stock_piso'];
                    $descripcion = $fila['descripcion'];

                    echo "<input type='text' name='nombremenu' value='$nombre' required>";
                    echo "<input type='text' name='preciomenu' value='$precio' required>";
                    echo "<input type='text' name='durabilidad' value='$durabilidad'required>";
                    echo "<input type='text' name='stocktecho' value='$stockTecho' required>";
                    echo "<input type='text' name='stockpiso' value='$stockPiso' required>";
                    echo "<input type='text' name='descripcion' value='$descripcion' required>";

                }
                $z = 1;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsPlatosPasados[] = $fila['id_comida'];
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton10' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            } else if ( $i == 3 ){
                echo '<div class="divFormulario">';
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$id'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                    $nombre = $fila['nombre'];
                    $precio = $fila['precio'];
                    $stockTecho = $fila['stock_techo'];
                    $stockPiso = $fila['stock_piso'];
                    $descripcion = $fila['descripcion'];
                    $durabilidad = $fila['durabilidad'];

                    echo "<input type='text' name='nombremenu' value='$nombre' required>";
                    echo "<input type='text' name='preciomenu' value='$precio' required>";
                    echo "<input type='text' name='durabilidad' value='$durabilidad'required>";
                    echo "<input type='text' name='stocktecho' value='$stockTecho' required>";
                    echo "<input type='text' name='stockpiso' value='$stockPiso' required>";
                    echo "<input type='text' name='descripcion' value='$descripcion' required>";

                }
                $z = 1;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
              
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton10' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                echo '</article>';
                $i = 1;
            } else {
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$id'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                    $nombre = $fila['nombre'];
                    $precio = $fila['precio'];
                    $stockTecho = $fila['stock_techo'];
                    $stockPiso = $fila['stock_piso'];
                    $descripcion = $fila['descripcion'];
                    $durabilidad = $fila['durabilidad'];

                    echo "<input type='text' name='nombremenu' value='$nombre' required>";
                    echo "<input type='text' name='preciomenu' value='$precio' required>";
                    echo "<input type='text' name='durabilidad' value='$durabilidad'required>";
                    echo "<input type='text' name='stocktecho' value='$stockTecho' required>";
                    echo "<input type='text' name='stockpiso' value='$stockPiso' required>";
                    echo "<input type='text' name='descripcion' value='$descripcion' required>";

                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsComida = $fila['id_comida'];
                
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton10' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            }
        }
    echo "</section>";
    } else {
        echo "<h2>No existen menus para autorizar - 10 platos - Hecho por Usuarios</h2>";
    }
?>


<?php
    if(mysqli_num_rows($resultado20) >= 1){
        echo "<h2>Menus para autorizar - 20 platos - Usuarios</h2>";
        echo "<section class='contenedorFormularios'>";
        $i = 1;
        $count = 0;

        foreach ($resultado20 as $row) {
            $id = $row['id_tipo_menu'];
            $nombrePrecio = "SELECT nombre, precio, durabilidad, stock_techo, stock_piso, descripcion
                            FROM tipo_menu
                            WHERE id_tipo_menu = $id";

            $resultadoNombrePrecio = mysqli_query($con, $nombrePrecio);
           
            $consult = "SELECT comida.nombre, comida.id_comida
                        FROM comida
                        WHERE comida.id_comida
                        IN (SELECT id_comida
                            FROM integra
                            WHERE id_tipo_menu = $id )";

            $result = mysqli_query($con, $consult);
        // k
            if( $i == 1 ) {
                echo "<article class='subContenedorFormularios'>";
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$id'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                    $nombre = $fila['nombre'];
                    $precio = $fila['precio'];
                    $durabilidad = $fila['durabilidad'];
                    $stockTecho = $fila['stock_techo'];
                    $stockPiso = $fila['stock_piso'];
                    $descripcion = $fila['descripcion'];

                    echo "<input type='text' name='nombremenu' value='$nombre' required>";
                    echo "<input type='text' name='preciomenu' value='$precio' required>";
                    echo "<input type='text' name='durabilidad' value='$durabilidad'required>";
                    echo "<input type='text' name='stocktecho' value='$stockTecho' required>";
                    echo "<input type='text' name='stockpiso' value='$stockPiso' required>";
                    echo "<input type='text' name='descripcion' value='$descripcion' required>";
                }
                $z = 1;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsPlatosPasados[] = $fila['id_comida'];
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton20' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            } else if ( $i == 3 ){
                echo '<div class="divFormulario">';
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$id'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                    $nombre = $fila['nombre'];
                    $precio = $fila['precio'];
                    $stockTecho = $fila['stock_techo'];
                    $stockPiso = $fila['stock_piso'];
                    $descripcion = $fila['descripcion'];
                    $durabilidad = $fila['durabilidad'];

                    echo "<input type='text' name='nombremenu' value='$nombre' required>";
                    echo "<input type='text' name='preciomenu' value='$precio' required>";
                    echo "<input type='text' name='durabilidad' value='$durabilidad'requied>";
                    echo "<input type='text' name='stocktecho' value='$stockTecho' required>";
                    echo "<input type='text' name='stockpiso' value='$stockPiso' required>";
                    echo "<input type='text' name='descripcion' value='$descripcion' required>";
                }
                $z = 1;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
              
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton20' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                echo '</article>';
                $i = 1;
            } else {
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$id'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecio)) {
                    $nombre = $fila['nombre'];
                    $precio = $fila['precio'];
                    $stockTecho = $fila['stock_techo'];
                    $stockPiso = $fila['stock_piso'];
                    $durabilidad = $fila['durabilidad'];
                    $descripcion = $fila['descripcion'];

                    echo "<input type='text' name='nombremenu' value='$nombre' required>";
                    echo "<input type='text' name='preciomenu' value='$precio' required>";
                    echo "<input type='text' name='durabilidad' value='$durabilidad'required>";
                    echo "<input type='text' name='stocktecho' value='$stockTecho' required>";
                    echo "<input type='text' name='stockpiso' value='$stockPiso' required>";
                    echo "<input type='text' name='descripcion' value='$descripcion' required>";

                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsComida = $fila['id_comida'];
                
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton20' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            }
        }
    echo "</section>";
    } else {
        echo "<h2>No existen menus para autorizar - 20 platos - Hecho por Usuarios</h2>";
    }
?>



<!-- c -->

<?php
    if(mysqli_num_rows($resultadoMenusPersonalizados5) >= 1){
        echo "<h2>Menus Personalizados - 5 platos - Clientes</h2>";
        echo "<section class='contenedorFormularios'>";
        $i = 1;
        $count = 0;

        foreach ($resultadoMenusPersonalizados5 as $row) {
            $cantidadComida = $row['cantidad_comida'];
            $idPersonalizado = $row['id_tipo_menu'];
            $nombrePrecioPersonalizado = "SELECT tipo_menu.nombre
                                            FROM tipo_menu
                                            WHERE id_tipo_menu = $idPersonalizado";

            $resultadoNombrePrecioPersonalizado = mysqli_query($con, $nombrePrecioPersonalizado);
            $consult = "SELECT comida.nombre, comida.id_comida
                        FROM comida
                        WHERE comida.id_comida
                        IN (SELECT id_comida
                            FROM integra
                            WHERE id_tipo_menu = $idPersonalizado )";

            $result = mysqli_query($con, $consult);
            if( $i == 1 ) {
                echo "<article class='subContenedorFormularios'>";
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$idPersonalizado'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecioPersonalizado)) {
                    $nombre = $fila['nombre'];
                    // $precio = $fila['precio'];
                    echo "<input type='text' name='nombremenu' value='$nombre'>";
                    echo "<input type='text' name='preciomenu' placeholder='Precio'>";
                    echo "<input type='text' name='durabilidad' placeholder='Durabilidad...'>";
                    echo "<input type='text' name='stocktecho' placeholder='Stock límite' value='0' readonly>";
                    echo "<input type='text' name='stockpiso' placeholder='Stock mínimo' value='0' readonly>";
                    echo "<input type='hidden' name='tipoMenu' value='9'>";
                    echo "<input type='hidden' name='descripcion' value=''>";

                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsPlatosPasados[] = $fila['id_comida'];
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton5' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            } else if ( $i == 3 ){
                echo '<div class="divFormulario">';
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$idPersonalizado'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecioPersonalizado)) {
                    $nombre = $fila['nombre'];
                    echo "<input type='text' name='nombremenu' value='$nombre'>";
                    echo "<input type='text' name='preciomenu' placeholder='Precio'>";
                    echo "<input type='text' name='durabilidad' placeholder='Durabilidad...'>";
                    echo "<input type='text' name='stocktecho' placeholder='Stock límite' value='0' readonly>";
                    echo "<input type='text' name='stockpiso' placeholder='Stock mínimo' value='0' readonly>";
                    echo "<input type='hidden' name='tipoMenu' value='9'>";
                    echo "<input type='hidden' name='descripcion' value=''>";
                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton5' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                echo '</article>';
                $i = 1;
            } else {
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$idPersonalizado'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecioPersonalizado)) {
                    $nombre = $fila['nombre'];
                    echo "<input type='text' name='nombremenu' value='$nombre'>";
                    echo "<input type='text' name='preciomenu' placeholder='Precio'>";
                    echo "<input type='text' name='durabilidad' placeholder='Durabilidad...'>";
                    echo "<input type='text' name='stocktecho' placeholder='Stock límite' value='0' readonly>";
                    echo "<input type='text' name='stockpiso' placeholder='Stock mínimo' value='0' readonly>";
                    echo "<input type='hidden' name='tipoMenu' value='9'>";

                    echo "<input type='hidden' name='descripcion' value=''>";

                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsComida = $fila['id_comida'];
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton5' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='0'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            }
        }
        // mysqli_close($con);
        // k
        echo "</section>";

    } else {
        echo "<h2>No existen menus para autorizar - 5 platos - Hecho por Clientes</h2>";

    }
?>

<?php
    if(mysqli_num_rows($resultadoMenusPersonalizados10) >= 1){
        echo "<h2>Menus Personalizados - 10 platos - Clientes</h2>";
        echo "<section class='contenedorFormularios'>";
        $i = 1;
        $count = 0;

        foreach ($resultadoMenusPersonalizados10 as $row) {
            $cantidadComida = $row['cantidad_comida'];
            $idPersonalizado = $row['id_tipo_menu'];
            $nombrePrecioPersonalizado = "SELECT tipo_menu.nombre
                                            FROM tipo_menu
                                            WHERE id_tipo_menu = $idPersonalizado";

            $resultadoNombrePrecioPersonalizado = mysqli_query($con, $nombrePrecioPersonalizado);
            $consult = "SELECT comida.nombre, comida.id_comida
                        FROM comida
                        WHERE comida.id_comida
                        IN (SELECT id_comida
                            FROM integra
                            WHERE id_tipo_menu = $idPersonalizado )";

            $result = mysqli_query($con, $consult);
            if( $i == 1 ) {
                echo "<article class='subContenedorFormularios'>";
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$idPersonalizado'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecioPersonalizado)) {
                    $nombre = $fila['nombre'];
                    echo "<input type='text' name='nombremenu' value='$nombre'>";
                    echo "<input type='text' name='preciomenu' placeholder='Precio'>";
                    echo "<input type='text' name='durabilidad' placeholder='Durabilidad...'>";
                    echo "<input type='text' name='stocktecho' placeholder='Stock límite' value='0' readonly>";
                    echo "<input type='text' name='stockpiso' placeholder='Stock mínimo' value='0' readonly>";
                    "<input type='hidden' name='descripcion' value=''>";

                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsPlatosPasados[] = $fila['id_comida'];
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton10' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            } else if ( $i == 3 ){
                echo '<div class="divFormulario">';
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$idPersonalizado'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecioPersonalizado)) {
                    $nombre = $fila['nombre'];
                    echo "<input type='text' name='nombremenu' value='$nombre'>";
                    echo "<input type='text' name='preciomenu' placeholder='Precio'>";
                    echo "<input type='text' name='durabilidad' placeholder='Durabilidad...'>";
                    echo "<input type='text' name='stocktecho' placeholder='Stock límite' value='0' readonly>";
                    echo "<input type='text' name='stockpiso' placeholder='Stock mínimo' value='0' readonly>";
                    echo "<input type='hidden' name='tipoMenu' value='9'>";
                    echo "<input type='hidden' name='descripcion' value=''>";

                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton10' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                echo '</article>';
                $i = 1;
            } else {
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$idPersonalizado'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecioPersonalizado)) {
                    $nombre = $fila['nombre'];
                    echo "<input type='text' name='nombremenu' value='$nombre'>";
                    echo "<input type='text' name='preciomenu' placeholder='Precio'>";
                    echo "<input type='text' name='durabilidad' placeholder='Durabilidad...'>";
                    echo "<input type='text' name='stocktecho' placeholder='Stock límite' value='0' readonly>";
                    echo "<input type='text' name='stockpiso' placeholder='Stock mínimo' value='0' readonly>";
                    echo "<input type='hidden' name='tipoMenu' value='9'>";
                    echo "<input type='hidden' name='descripcion' value=''>";

                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsComida = $fila['id_comida'];
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton10' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            }
        }
        echo "</section>";
    } else {
        echo "<h2>No existen menus para autorizar - 10 platos - Hecho por Clientes</h2>";
    }
?>

<?php
    if(mysqli_num_rows($resultadoMenusPersonalizados20) >= 1){
        echo "<h2>Menus Personalizados - 20 platos - Clientes</h2>";
        echo "<section class='contenedorFormularios'>";
        $i = 1;
        $count = 0;

        foreach ($resultadoMenusPersonalizados20 as $row) {
            $cantidadComida = $row['cantidad_comida'];
            $idPersonalizado = $row['id_tipo_menu'];
            $nombrePrecioPersonalizado = "SELECT tipo_menu.nombre
                                            FROM tipo_menu
                                            WHERE id_tipo_menu = $idPersonalizado";

            $resultadoNombrePrecioPersonalizado = mysqli_query($con, $nombrePrecioPersonalizado);
            $consult = "SELECT comida.nombre, comida.id_comida
                        FROM comida
                        WHERE comida.id_comida
                        IN (SELECT id_comida
                            FROM integra
                            WHERE id_tipo_menu = $idPersonalizado )";

            $result = mysqli_query($con, $consult);
            if( $i == 1 ) {
                echo "<article class='subContenedorFormularios'>";
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$idPersonalizado'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecioPersonalizado)) {
                    $nombre = $fila['nombre'];
                    echo "<input type='text' name='nombremenu' value='$nombre'>";
                    echo "<input type='text' name='preciomenu' placeholder='Precio'>";
                    echo "<input type='text' name='durabilidad' placeholder='Durabilidad...'>";
                    echo "<input type='text' name='stocktecho' placeholder='Stock límite' value='0' readonly>";
                    echo "<input type='text' name='stockpiso' placeholder='Stock mínimo' value='0' readonly>";
                    echo "<input type='hidden' name='tipoMenu' value='9'>";
                    echo "<input type='hidden' name='descripcion' value=''>";

                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsPlatosPasados[] = $fila['id_comida'];
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton20' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            } else if ( $i == 3 ){
                echo '<div class="divFormulario">';
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$idPersonalizado'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecioPersonalizado)) {
                    $nombre = $fila['nombre'];
                    echo "<input type='text' name='nombremenu' value='$nombre'>";
                    echo "<input type='text' name='preciomenu' placeholder='Precio'>";
                    echo "<input type='text' name='durabilidad' placeholder='Durabilidad...'>";
                    echo "<input type='text' name='stocktecho' placeholder='Stock límite' value='0' readonly>";
                    echo "<input type='text' name='stockpiso' placeholder='Stock mínimo' value='0' readonly>";
                    echo "<input type='hidden' name='tipoMenu' value='9'>";
                    echo "<input type='hidden' name='descripcion' value=''>";

                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsPlatosPasados[] = $fila['id_comida'];

                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton20' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                echo '</article>';
                $i = 1;
            } else {
                echo "  <div class='divFormulario'>";
                echo '      <h2>Formulario</h2>';
                echo "      <form action='../../datos/ABMmenu.php' method='post' enctype='multipart/form-data'>";
                echo "      <input type='hidden' name='idmenus' value='$idPersonalizado'>";
                while ($fila = mysqli_fetch_assoc($resultadoNombrePrecioPersonalizado)) {
                    $nombre = $fila['nombre'];
                    echo "<input type='text' name='nombremenu' value='$nombre'>";
                    echo "<input type='text' name='preciomenu' placeholder='Precio'>";
                    echo "<input type='text' name='durabilidad' placeholder='Durabilidad...'>";
                    echo "<input type='text' name='stocktecho' placeholder='Stock límite' value='0' readonly>";
                    echo "<input type='text' name='stockpiso' placeholder='Stock mínimo' value='0' readonly>";
                    echo "<input type='hidden' name='tipoMenu' value='9'>";
                    echo "<input type='hidden' name='descripcion' value=''>";

                }
                $z = 0;
                while ($fila = mysqli_fetch_assoc($result)) {
                    $comida = $fila['nombre'];
                    $idsComida = $fila['id_comida'];
                    echo "<select id='Pdietas' name='platoMenu[]'>";
                    foreach ($nombresComidas as $nombreDieta) {
                        $selected = ($nombreDieta == $fila['nombre']) ? 'selected' : '';
                        echo '<option value="' . $nombreDieta . '" ' . $selected . '>' . $nombreDieta . '</option>';
                    }
                    echo "</select>";
                    $z++;
                }
                echo "          <div class='botonesRespuestaFormulario'>";
                echo "              <button type='submit' class='boton' name='boton20' value='0'>Aprobado</button>";
                echo "              <button type='submit' class='boton' name='opcion' value='1'>Rechazado</button>";
                echo "          </div>";
                echo "        </form>";
                echo '  </div>';
                $i++;
            }
        }
        mysqli_close($con);
        // k
        echo "</section>";

    } else {
        echo "<h2>No existen menus para autorizar - 20 platos - Clientes</h2>";

    }
?>

    <!-- <footer>
        <p>Copyright - Prometeo BND</p>
    </footer> -->
</body>
</html>