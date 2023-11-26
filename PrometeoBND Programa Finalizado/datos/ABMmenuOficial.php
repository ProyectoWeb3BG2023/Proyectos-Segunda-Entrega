<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    // echo $_SESSION['nombre_usuario'];
    echo "<br>";
    if($_POST){
        $idMenu = $_POST['idmenus'];
        $nombreMenu = $_POST['nombremenu'];
        $precioMenu = $_POST['preciomenu'];
        $platoMenu = $_POST['platoMenu'];

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
        SET nombre = '$nombreMenu', stock_piso = '1', stock_techo = '1', stock_real = '0', precio = '$precioMenu', autorizacion = '1' 
        WHERE id_tipo_menu = $idMenu";
        $resultadoActualizacionTipoMenu = mysqli_query($con,$actualizacionTipoMenu);
// c

        $actualizacionIntegra1 = "UPDATE integra SET id_comida ='$idPlato1' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado1'";
        $actualizacionIntegra2 = "UPDATE integra SET id_comida ='$idPlato2' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado2'";
        $actualizacionIntegra3 = "UPDATE integra SET id_comida ='$idPlato3' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado3'";
        $actualizacionIntegra4 = "UPDATE integra SET id_comida ='$idPlato4' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado4'";
        $actualizacionIntegra5 = "UPDATE integra SET id_comida ='$idPlato5' WHERE id_tipo_menu ='$idMenu' AND id_comida='$platoPasado5'";

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
    } else {
        mysqli_close($con);
        echo
            '<script>
                alert("Opción actualmente indefinida");
                window.location = "../vistas/gerente/homeSolicitud.php";
            </script>';
        exit();
    }
?>