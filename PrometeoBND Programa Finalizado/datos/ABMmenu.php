<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    // echo $_SESSION['nombre_usuario'];
    // echo "<br>";
    if(isset($_POST["boton5"])){
        $idMenu = $_POST['idmenus'];
        $nombreMenu = $_POST['nombremenu'];
        $platoMenu = $_POST['platoMenu'];

        if(isset($_POST['descripcion'], $_POST['preciomenu'], $_POST['stocktecho'], $_POST['stockpiso'], $_POST['durabilidad'])){
            $descripcionMenu = $_POST['descripcion'];
            $precioMenu = $_POST['preciomenu'];
            $stockTecho = $_POST['stocktecho'];
            $stockPiso = $_POST['stockpiso'];
            $durabilidad = $_POST['durabilidad'];

            if(!isset($_POST['tipoMenu'])) {
                if($stockPiso >= $stockTecho || $stockPiso < 0 || $stockTecho < 0){
                    mysqli_close($con);
                    echo
                        '<script>
                            alert("ERROR, incoherencia en el Stock ingresado");
                            window.location = "../vistas/gerente/homeSolicitud.php";
                        </script>';
                    exit();
                }
            }

        } else {
            $descripcionMenu = "Indefinida";
            $precioMenu = 0;
            $stockTecho = 20;
            $stockPiso = 10;
            $durabilidad = 10;
        }

        // echo $idMenu;
        // echo $nombreMenu;
        // echo $precioMenu;
// c
        $arreglo = array();
        $j = 0;
        foreach ($platoMenu as $plato) {
            $arreglo[] = $plato;
        }
        $plato1 = $arreglo[0];
        $plato2 = $arreglo[1];
        $plato3 = $arreglo[2];
        $plato4 = $arreglo[3];
        $plato5 = $arreglo[4];
// c

        $guardarComidasPasadas = "SELECT id_comida FROM integra WHERE id_tipo_menu = '$idMenu'";
        $resultadoComidasPasadas = mysqli_query($con,$guardarComidasPasadas);
        $idsComidasPasadas = array();
        foreach ($resultadoComidasPasadas as $resultadoComidas) {
            $idsComidasPasadas[] = $resultadoComidas['id_comida'];
        }   
        $platoPasado1 = $idsComidasPasadas[0];
        $platoPasado2 = $idsComidasPasadas[1];
        $platoPasado3 = $idsComidasPasadas[2];
        $platoPasado4 = $idsComidasPasadas[3];
        $platoPasado5 = $idsComidasPasadas[4];
        // echo "_____";
        // echo $platoPasado1;
        // echo "_____";
// c

        $guardar = "SELECT id_comida FROM comida WHERE nombre = '$plato1'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato2'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato3'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato4'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato5'";
        
        $resultado = mysqli_query($con,$guardar);
        echo "<br>";
        $guardarId = array();

        foreach($resultado as $row){
            $guardarId[] = $row['id_comida'];
        }
        
        $idPlato1 = $guardarId[0];
        $idPlato2 = $guardarId[1];
        $idPlato3 = $guardarId[2];
        $idPlato4 = $guardarId[3];
        $idPlato5 = $guardarId[4];
// c

        $actualizacionTipoMenu = "UPDATE tipo_menu 
        SET nombre = '$nombreMenu', descripcion = '$descripcionMenu', durabilidad = '$durabilidad', stock_piso = '$stockPiso', stock_techo = '$stockTecho', stock_real = '0', precio = '$precioMenu', autorizacion = '1' 
        WHERE id_tipo_menu = $idMenu";
        $resultadoActualizacionTipoMenu = mysqli_query($con,$actualizacionTipoMenu);
// c

        $actualizacionIntegra1 = "UPDATE integra SET id_comida ='$idPlato1' WHERE id_tipo_menu = '$idMenu' AND id_comida='$platoPasado1'";
        $actualizacionIntegra2 = "UPDATE integra SET id_comida ='$idPlato2' WHERE id_tipo_menu = '$idMenu' AND id_comida='$platoPasado2'";
        $actualizacionIntegra3 = "UPDATE integra SET id_comida ='$idPlato3' WHERE id_tipo_menu = '$idMenu' AND id_comida='$platoPasado3'";
        $actualizacionIntegra4 = "UPDATE integra SET id_comida ='$idPlato4' WHERE id_tipo_menu = '$idMenu' AND id_comida='$platoPasado4'";
        $actualizacionIntegra5 = "UPDATE integra SET id_comida ='$idPlato5' WHERE id_tipo_menu = '$idMenu' AND id_comida='$platoPasado5'";

        $resultadoActualizacionIntegra1 = mysqli_query($con,$actualizacionIntegra1);
        $resultadoActualizacionIntegra2 = mysqli_query($con,$actualizacionIntegra2);
        $resultadoActualizacionIntegra3 = mysqli_query($con,$actualizacionIntegra3);
        $resultadoActualizacionIntegra4 = mysqli_query($con,$actualizacionIntegra4);
        $resultadoActualizacionIntegra5 = mysqli_query($con,$actualizacionIntegra5);

        if ($resultado && $resultadoActualizacionIntegra1 && $resultadoActualizacionIntegra2 && $resultadoActualizacionIntegra3
        && $resultadoActualizacionIntegra4 && $resultadoActualizacionIntegra5) {
            mysqli_close($con);
            echo
                '<script>
                    alert("Menu autorizado exitosamente");
                    window.location = "../vistas/gerente/homeSolicitud.php";
                </script>';
            exit();
        } else {
            mysqli_close($con);
            echo
                '<script>
                    alert("Cambio no efectuado, intentelo de nuevo");
                    window.location = "../vistas/gerente/homeSolicitud.php";
                </script>';
            exit();
        }
        
    } else if(isset($_POST["boton10"])) {
        $idMenu = $_POST['idmenus'];
        $nombreMenu = $_POST['nombremenu'];
        $precioMenu = $_POST['preciomenu'];
        $platoMenu = $_POST['platoMenu'];

        if(isset($_POST['descripcion'], $_POST['preciomenu'], $_POST['stocktecho'], $_POST['stockpiso'], $_POST['durabilidad'])){
            $descripcionMenu = $_POST['descripcion'];
            $precioMenu = $_POST['preciomenu'];
            $stockTecho = $_POST['stocktecho'];
            $stockPiso = $_POST['stockpiso'];
            $durabilidad = $_POST['durabilidad'];
            
            if(!isset($_POST['tipoMenu'])) {
                if($stockPiso >= $stockTecho || $stockPiso < 0 || $stockTecho < 0){
                    mysqli_close($con);
                    echo
                        '<script>
                            alert("ERROR, incoherencia en el Stock ingresado");
                            window.location = "../vistas/gerente/homeSolicitud.php";
                        </script>';
                    exit();
                }
            }
        } else {
            $descripcionMenu = "Indefinida";
            $precioMenu = 0;
            $stockTecho = 2;
            $stockPiso = 1;
            $durabilidad = 10;
        }

        // echo $idMenu;
        // echo $nombreMenu;
        // echo $precioMenu;
// c
        $arreglo = array();
        $j = 0;
        foreach ($platoMenu as $plato) {
            $arreglo[] = $plato;
        }
        $plato1 = $arreglo[0];
        $plato2 = $arreglo[1];
        $plato3 = $arreglo[2];
        $plato4 = $arreglo[3];
        $plato5 = $arreglo[4];
        $plato6 = $arreglo[5];
        $plato7 = $arreglo[6];
        $plato8 = $arreglo[7];
        $plato9 = $arreglo[8];
        $plato10 = $arreglo[9];

        $guardarComidasPasadas = "SELECT id_comida FROM integra WHERE id_tipo_menu = '$idMenu'";
        $resultadoComidasPasadas = mysqli_query($con,$guardarComidasPasadas);
        $idsComidasPasadas = array();
        foreach ($resultadoComidasPasadas as $resultadoComidas) {
            $idsComidasPasadas[] = $resultadoComidas['id_comida'];
        }   
        $platoPasado1 = $idsComidasPasadas[0];
        $platoPasado2 = $idsComidasPasadas[1];
        $platoPasado3 = $idsComidasPasadas[2];
        $platoPasado4 = $idsComidasPasadas[3];
        $platoPasado5 = $idsComidasPasadas[4];
        $platoPasado6 = $idsComidasPasadas[5];
        $platoPasado7 = $idsComidasPasadas[6];
        $platoPasado8 = $idsComidasPasadas[7];
        $platoPasado9 = $idsComidasPasadas[8];
        $platoPasado10 = $idsComidasPasadas[9];

        $guardar = "SELECT id_comida FROM comida WHERE nombre = '$plato1'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato2'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato3'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato4'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato5'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato6'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato7'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato8'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato9'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato10'";
        
        $resultado = mysqli_query($con,$guardar);
        echo "<br>";
        $guardarId = array();
        foreach($resultado as $row){
            $guardarId[] = $row['id_comida'];
        }
        
        $idPlato1 = $guardarId[0];
        $idPlato2 = $guardarId[1];
        $idPlato3 = $guardarId[2];
        $idPlato4 = $guardarId[3];
        $idPlato5 = $guardarId[4];
        $idPlato6 = $guardarId[5];
        $idPlato7 = $guardarId[6];
        $idPlato8 = $guardarId[7];
        $idPlato9 = $guardarId[8];
        $idPlato10 = $guardarId[9];

// c
        $actualizacionTipoMenu = "UPDATE tipo_menu 
        SET nombre = '$nombreMenu', descripcion = '$descripcionMenu', durabilidad = '$durabilidad', stock_piso = '$stockPiso', stock_techo = '$stockTecho', stock_real = '0', precio = '$precioMenu', autorizacion = '1' 
        WHERE id_tipo_menu = $idMenu";
        $resultadoActualizacionTipoMenu = mysqli_query($con,$actualizacionTipoMenu);
// c

        $actualizacionIntegra1 = "UPDATE integra SET id_comida ='$idPlato1' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado1'";
        $actualizacionIntegra2 = "UPDATE integra SET id_comida ='$idPlato2' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado2'";
        $actualizacionIntegra3 = "UPDATE integra SET id_comida ='$idPlato3' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado3'";
        $actualizacionIntegra4 = "UPDATE integra SET id_comida ='$idPlato4' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado4'";
        $actualizacionIntegra5 = "UPDATE integra SET id_comida ='$idPlato5' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado5'";
        $actualizacionIntegra6 = "UPDATE integra SET id_comida ='$idPlato6' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado6'";
        $actualizacionIntegra7 = "UPDATE integra SET id_comida ='$idPlato7' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado7'";
        $actualizacionIntegra8 = "UPDATE integra SET id_comida ='$idPlato8' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado8'";
        $actualizacionIntegra9 = "UPDATE integra SET id_comida ='$idPlato9' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado9'";
        $actualizacionIntegra10 = "UPDATE integra SET id_comida ='$idPlato10' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado10'";

        $resultadoActualizacionIntegra1 = mysqli_query($con,$actualizacionIntegra1);
        $resultadoActualizacionIntegra2 = mysqli_query($con,$actualizacionIntegra2);
        $resultadoActualizacionIntegra3 = mysqli_query($con,$actualizacionIntegra3);
        $resultadoActualizacionIntegra4 = mysqli_query($con,$actualizacionIntegra4);
        $resultadoActualizacionIntegra5 = mysqli_query($con,$actualizacionIntegra5);
        $resultadoActualizacionIntegra6 = mysqli_query($con,$actualizacionIntegra6);
        $resultadoActualizacionIntegra7 = mysqli_query($con,$actualizacionIntegra7);
        $resultadoActualizacionIntegra8 = mysqli_query($con,$actualizacionIntegra8);
        $resultadoActualizacionIntegra9 = mysqli_query($con,$actualizacionIntegra9);
        $resultadoActualizacionIntegra10 = mysqli_query($con,$actualizacionIntegra10);

        if ($resultado && $resultadoActualizacionIntegra1 && $resultadoActualizacionIntegra2 && $resultadoActualizacionIntegra3
        && $resultadoActualizacionIntegra4 && $resultadoActualizacionIntegra5 && $resultadoActualizacionIntegra6 && 
        $resultadoActualizacionIntegra7 && $resultadoActualizacionIntegra8 && $resultadoActualizacionIntegra9 && $resultadoActualizacionIntegra10) {
            mysqli_close($con);
            echo
                '<script>
                    alert("Menu autorizado exitosamente");
                    window.location = "../vistas/gerente/homeSolicitud.php";
                </script>';
            exit();
        } else {
            mysqli_close($con);
            echo
                '<script>
                    alert("Cambio no efectuado, intentelo de nuevo");
                    window.location = "../vistas/gerente/homeSolicitud.php";
                </script>';
            exit();
        }

    } else if(isset($_POST["boton20"])){
        $idMenu = $_POST['idmenus'];
        $nombreMenu = $_POST['nombremenu'];
        $precioMenu = $_POST['preciomenu'];
        $platoMenu = $_POST['platoMenu'];

        if(isset($_POST['descripcion'], $_POST['preciomenu'], $_POST['stocktecho'], $_POST['stockpiso'], $_POST['durabilidad'])){
            $descripcionMenu = $_POST['descripcion'];
            $precioMenu = $_POST['preciomenu'];
            $stockTecho = $_POST['stocktecho'];
            $stockPiso = $_POST['stockpiso'];
            $durabilidad = $_POST['durabilidad'];

            if(!isset($_POST['tipoMenu'])) {
                if($stockPiso >= $stockTecho || $stockPiso < 0 || $stockTecho < 0){
                    mysqli_close($con);
                    echo
                        '<script>
                            alert("ERROR, incoherencia en el Stock ingresado");
                            window.location = "../vistas/gerente/homeSolicitud.php";
                        </script>';
                    exit();
                }
            }
            
        } else {
            $descripcionMenu = "Indefinida";
            $precioMenu = 0;
            $stockTecho = 2;
            $stockPiso = 1;
            $durabilidad = 10;
        }

        // echo $idMenu;
        // echo $nombreMenu;
        // echo $precioMenu;
// c
        $arreglo = array();
        $j = 0;
        foreach ($platoMenu as $plato) {
            $arreglo[] = $plato;
        }
        $plato1 = $arreglo[0];
        $plato2 = $arreglo[1];
        $plato3 = $arreglo[2];
        $plato4 = $arreglo[3];
        $plato5 = $arreglo[4];
        $plato6 = $arreglo[5];
        $plato7 = $arreglo[6];
        $plato8 = $arreglo[7];
        $plato9 = $arreglo[8];
        $plato10 = $arreglo[9];
        $plato11 = $arreglo[10];
        $plato12 = $arreglo[11];
        $plato13 = $arreglo[12];
        $plato14 = $arreglo[13];
        $plato15 = $arreglo[14];
        $plato16 = $arreglo[15];
        $plato17 = $arreglo[16];
        $plato18 = $arreglo[17];
        $plato19 = $arreglo[18];
        $plato20 = $arreglo[19];

        $guardarComidasPasadas = "SELECT id_comida FROM integra WHERE id_tipo_menu = '$idMenu'";
        $resultadoComidasPasadas = mysqli_query($con,$guardarComidasPasadas);
        $idsComidasPasadas = array();
        foreach ($resultadoComidasPasadas as $resultadoComidas) {
            $idsComidasPasadas[] = $resultadoComidas['id_comida'];
        }   
        $platoPasado1 = $idsComidasPasadas[0];
        $platoPasado2 = $idsComidasPasadas[1];
        $platoPasado3 = $idsComidasPasadas[2];
        $platoPasado4 = $idsComidasPasadas[3];
        $platoPasado5 = $idsComidasPasadas[4];
        $platoPasado6 = $idsComidasPasadas[5];
        $platoPasado7 = $idsComidasPasadas[6];
        $platoPasado8 = $idsComidasPasadas[7];
        $platoPasado9 = $idsComidasPasadas[8];
        $platoPasado10 = $idsComidasPasadas[9];
        $platoPasado11 = $idsComidasPasadas[10];
        $platoPasado12 = $idsComidasPasadas[11];
        $platoPasado13 = $idsComidasPasadas[12];
        $platoPasado14 = $idsComidasPasadas[13];
        $platoPasado15 = $idsComidasPasadas[14];
        $platoPasado16 = $idsComidasPasadas[15];
        $platoPasado17 = $idsComidasPasadas[16];
        $platoPasado18 = $idsComidasPasadas[17];
        $platoPasado19 = $idsComidasPasadas[18];
        $platoPasado20 = $idsComidasPasadas[19];

        $guardar = "SELECT id_comida FROM comida WHERE nombre = '$plato1'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato2'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato3'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato4'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato5'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato6'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato7'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato8'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato9'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato10'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato11'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato12'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato13'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato14'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato15'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato16'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato17'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato18'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato19'
                    UNION
                    SELECT id_comida FROM comida WHERE nombre = '$plato20'";
        
        $resultado = mysqli_query($con,$guardar);
        echo "<br>";
        $guardarId = array();
        $j = 0;
        foreach($resultado as $row){
            $guardarId[] = $row['id_comida'];
            // echo "_";
            // echo "$guardarId[$j]";
            // echo "_";

            // $j++;
        }
        
        $idPlato1 = $guardarId[0];
        $idPlato2 = $guardarId[1];
        $idPlato3 = $guardarId[2];
        $idPlato4 = $guardarId[3];
        $idPlato5 = $guardarId[4];
        $idPlato6 = $guardarId[5];
        $idPlato7 = $guardarId[6];
        $idPlato8 = $guardarId[7];
        $idPlato9 = $guardarId[8];
        $idPlato10 = $guardarId[9];
        $idPlato11 = $guardarId[10];
        $idPlato12 = $guardarId[11];
        $idPlato13 = $guardarId[12];
        $idPlato14 = $guardarId[13];
        $idPlato15 = $guardarId[14];
// c
        $actualizacionTipoMenu = "UPDATE tipo_menu 
        SET nombre = '$nombreMenu', descripcion = '$descripcionMenu', durabilidad = '$durabilidad', stock_piso = '$stockPiso', stock_techo = '$stockTecho', stock_real = '0', precio = '$precioMenu', autorizacion = '1' 
        WHERE id_tipo_menu = '$idMenu'";
        $resultadoActualizacionTipoMenu = mysqli_query($con,$actualizacionTipoMenu);
// c
        $actualizacionIntegra1 = "UPDATE integra SET id_comida = '$guardarId[0]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado1'";
        $actualizacionIntegra2 = "UPDATE integra SET id_comida = '$guardarId[1]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado2'";
        $actualizacionIntegra3 = "UPDATE integra SET id_comida = '$guardarId[2]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado3'";
        $actualizacionIntegra4 = "UPDATE integra SET id_comida = '$guardarId[3]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado4'";
        $actualizacionIntegra5 = "UPDATE integra SET id_comida = '$guardarId[4]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado5'";
        $actualizacionIntegra6 = "UPDATE integra SET id_comida = '$guardarId[5]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado6'";
        $actualizacionIntegra7 = "UPDATE integra SET id_comida = '$guardarId[6]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado7'";
        $actualizacionIntegra8 = "UPDATE integra SET id_comida = '$guardarId[7]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado8'";
        $actualizacionIntegra9 = "UPDATE integra SET id_comida = '$guardarId[8]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado9'";
        $actualizacionIntegra10 = "UPDATE integra SET id_comida = '$guardarId[9]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado10'";
        $actualizacionIntegra11 = "UPDATE integra SET id_comida = '$guardarId[10]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado11'";
        $actualizacionIntegra12 = "UPDATE integra SET id_comida = '$guardarId[11]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado12'";
        $actualizacionIntegra13 = "UPDATE integra SET id_comida = '$guardarId[12]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado13'";
        $actualizacionIntegra14 = "UPDATE integra SET id_comida = '$guardarId[13]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado14'";
        $actualizacionIntegra15 = "UPDATE integra SET id_comida = '$guardarId[14]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado15'";
        $actualizacionIntegra16 = "UPDATE integra SET id_comida = '$guardarId[15]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado16'";
        $actualizacionIntegra17 = "UPDATE integra SET id_comida = '$guardarId[16]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado17'";
        $actualizacionIntegra18 = "UPDATE integra SET id_comida = '$guardarId[17]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado18'";
        $actualizacionIntegra19 = "UPDATE integra SET id_comida = '$guardarId[18]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado19'";
        $actualizacionIntegra20 = "UPDATE integra SET id_comida = '$guardarId[19]' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado20'";

        $resultadoActualizacionIntegra1 = mysqli_query($con,$actualizacionIntegra1);
        $resultadoActualizacionIntegra2 = mysqli_query($con,$actualizacionIntegra2);
        $resultadoActualizacionIntegra3 = mysqli_query($con,$actualizacionIntegra3);
        $resultadoActualizacionIntegra4 = mysqli_query($con,$actualizacionIntegra4);
        $resultadoActualizacionIntegra5 = mysqli_query($con,$actualizacionIntegra5);
        $resultadoActualizacionIntegra6 = mysqli_query($con,$actualizacionIntegra6);
        $resultadoActualizacionIntegra7 = mysqli_query($con,$actualizacionIntegra7);
        $resultadoActualizacionIntegra8 = mysqli_query($con,$actualizacionIntegra8);
        $resultadoActualizacionIntegra9 = mysqli_query($con,$actualizacionIntegra9);
        $resultadoActualizacionIntegra10 = mysqli_query($con,$actualizacionIntegra10);
        $resultadoActualizacionIntegra11 = mysqli_query($con,$actualizacionIntegra11);
        $resultadoActualizacionIntegra12 = mysqli_query($con,$actualizacionIntegra12);
        $resultadoActualizacionIntegra13 = mysqli_query($con,$actualizacionIntegra13);
        $resultadoActualizacionIntegra14 = mysqli_query($con,$actualizacionIntegra14);
        $resultadoActualizacionIntegra15 = mysqli_query($con,$actualizacionIntegra15);
        $resultadoActualizacionIntegra16 = mysqli_query($con,$actualizacionIntegra16);
        $resultadoActualizacionIntegra17 = mysqli_query($con,$actualizacionIntegra17);
        $resultadoActualizacionIntegra18 = mysqli_query($con,$actualizacionIntegra18);
        $resultadoActualizacionIntegra19 = mysqli_query($con,$actualizacionIntegra19);
        $resultadoActualizacionIntegra20 = mysqli_query($con,$actualizacionIntegra20);


        if ($resultado && $resultadoActualizacionIntegra1 && $resultadoActualizacionIntegra2 && $resultadoActualizacionIntegra3
        && $resultadoActualizacionIntegra4 && $resultadoActualizacionIntegra5 && $resultadoActualizacionIntegra6 && 
        $resultadoActualizacionIntegra7 && $resultadoActualizacionIntegra8 && $resultadoActualizacionIntegra9 && $resultadoActualizacionIntegra10 
        && $resultadoActualizacionIntegra11 && $resultadoActualizacionIntegra12 && $resultadoActualizacionIntegra13 && $resultadoActualizacionIntegra14
        && $resultadoActualizacionIntegra15) {
            mysqli_close($con);
            echo
                '<script>
                    alert("Menu autorizado exitosamente");
                    window.location = "../vistas/gerente/homeSolicitud.php";
                </script>';
            exit();
        } else {
            mysqli_close($con);
            echo
                '<script>
                    alert("Cambio no efectuado, intentelo de nuevo");
                    window.location = "../vistas/gerente/homeSolicitud.php";
                </script>';
            exit();
        }

    }
?>