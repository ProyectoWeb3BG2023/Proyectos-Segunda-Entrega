<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    $idCliente = $_SESSION['identificadorCliente'];
    $documentoCliente = $_SESSION['documentoCliente'];

    $palabras = array("brown.png", "Green.png", "greenSquare.png", "lightGreen.png", "orange.png", "lightGreenSquareAlt.png", "lightGreenSquare.png", "redSquare.png", "tupperVaporwave.png");
    $palabraAleatoria = $palabras[array_rand($palabras)];
    
    $ruta = "../../recursos/img/" . $palabraAleatoria;

    if(isset($_POST["boton5"])) {
        // Menú Personalizado - 5 comidas
        $nombreMenu = $_POST['nombreMenu'];
        $platoMenu1 = $_POST['platoMenu1'];
        $platoMenu2 = $_POST['platoMenu2'];
        $platoMenu3 = $_POST['platoMenu3'];
        $platoMenu4 = $_POST['platoMenu4'];
        $platoMenu5 = $_POST['platoMenu5'];

        $consultaMenu = "SELECT * FROM tipo_menu WHERE nombre = '$nombreMenu'";
        $resultadoDatos = mysqli_query($con, $consultaMenu);

        if(mysqli_num_rows($resultadoDatos) == 1) {
            if(isset($_POST["boton5"])) {
                echo
                '<script>
                    alert("Solicitud no efectuada, intentelo de nuevo");
                    window.location = "../vistas/home/solicitudPersonalizado.php";
                </script>';
                exit();
            }
        } else {
            $guardar = "INSERT INTO tipo_menu(nombre, ruta_imagen) VALUES ('$nombreMenu', '$ruta')";
            $resultado = mysqli_query($con, $guardar);
            // $resultado = mysqli_query($con, $guardar);

            $consultaIdTipoMenu = "SELECT id_tipo_menu FROM tipo_menu WHERE nombre = '$nombreMenu'";
            $resultadoIdTipoMenu = mysqli_query($con, $consultaIdTipoMenu);
            $fila = mysqli_fetch_assoc($resultadoIdTipoMenu);

            $id = $fila['id_tipo_menu'];

            $guardarIntegra = "INSERT INTO
            integra(id_comida, id_tipo_menu, personalizado, cantidad_comida) 
            VALUES
            ('$platoMenu1','$id','$documentoCliente','5'),
            ('$platoMenu2','$id','$documentoCliente','5'),
            ('$platoMenu3','$id','$documentoCliente','5'),
            ('$platoMenu4','$id','$documentoCliente','5'),
            ('$platoMenu5','$id','$documentoCliente','5')";

            $resultadoIntegra = mysqli_query($con, $guardarIntegra);

            $guardarTiene = "INSERT INTO
            tiene(id_tipo_menu, id_estado_tipo_menu, fecha_inicio) 
            VALUES
            ('$id', '0', CURDATE())";
            $resultadoTiene = mysqli_query($con, $guardarTiene);
        }
    } else if(isset($_POST["boton10"])){
        $nombreMenu = $_POST['nombreMenu'];
        $platoMenu1 = $_POST['platoMenu1'];
        $platoMenu2 = $_POST['platoMenu2'];
        $platoMenu3 = $_POST['platoMenu3'];
        $platoMenu4 = $_POST['platoMenu4'];
        $platoMenu5 = $_POST['platoMenu5'];
        $platoMenu6 = $_POST['platoMenu6'];
        $platoMenu7 = $_POST['platoMenu7'];
        $platoMenu8 = $_POST['platoMenu8'];
        $platoMenu9 = $_POST['platoMenu9'];
        $platoMenu10 = $_POST['platoMenu10'];

        $consultaMenu = "SELECT * FROM tipo_menu WHERE nombre = '$nombreMenu'";
        $resultadoDatos = mysqli_query($con, $consultaMenu);

        if(mysqli_num_rows($resultadoDatos) == 1) {
            echo
            '<script>
                alert("Solicitud no efectuada, intentelo de nuevo");
                window.location = "../vistas/home/solicitudPersonalizado.php";
            </script>';
            exit();
        } else {
            $guardar = "INSERT INTO tipo_menu(nombre, ruta_imagen) VALUES ('$nombreMenu', '$ruta')";
            $resultado = mysqli_query($con, $guardar);
            // $resultado = mysqli_query($con, $guardar);

            $consultaIdTipoMenu = "SELECT id_tipo_menu FROM tipo_menu WHERE nombre = '$nombreMenu'";
            $resultadoIdTipoMenu = mysqli_query($con, $consultaIdTipoMenu);
            $fila = mysqli_fetch_assoc($resultadoIdTipoMenu);

            $id = $fila['id_tipo_menu'];

            $guardarIntegra = "INSERT INTO
            integra(id_comida, id_tipo_menu, personalizado, cantidad_comida) 
            VALUES
            ('$platoMenu1','$id','$documentoCliente','10'),
            ('$platoMenu2','$id','$documentoCliente','10'),
            ('$platoMenu3','$id','$documentoCliente','10'),
            ('$platoMenu4','$id','$documentoCliente','10'),
            ('$platoMenu5','$id','$documentoCliente','10'),
            ('$platoMenu6','$id','$documentoCliente','10'),
            ('$platoMenu7','$id','$documentoCliente','10'),
            ('$platoMenu8','$id','$documentoCliente','10'),
            ('$platoMenu9','$id','$documentoCliente','10'),
            ('$platoMenu10','$id','$documentoCliente','10')";

            $resultadoIntegra = mysqli_query($con, $guardarIntegra);

            $guardarTiene = "INSERT INTO
            tiene(id_tipo_menu, id_estado_tipo_menu, fecha_inicio) 
            VALUES
            ('$id', '0', CURDATE())";
            $resultadoTiene = mysqli_query($con, $guardarTiene);
        }
    } else if(isset($_POST["boton20"])){
        echo "20";

        $nombreMenu = $_POST['nombreMenu'];
        $platoMenu1 = $_POST['platoMenu1'];
        $platoMenu2 = $_POST['platoMenu2'];
        $platoMenu3 = $_POST['platoMenu3'];
        $platoMenu4 = $_POST['platoMenu4'];
        $platoMenu5 = $_POST['platoMenu5'];
        $platoMenu6 = $_POST['platoMenu6'];
        $platoMenu7 = $_POST['platoMenu7'];
        $platoMenu8 = $_POST['platoMenu8'];
        $platoMenu9 = $_POST['platoMenu9'];
        $platoMenu10 = $_POST['platoMenu10'];
        $platoMenu11 = $_POST['platoMenu11'];
        $platoMenu12 = $_POST['platoMenu12'];
        $platoMenu13 = $_POST['platoMenu13'];
        $platoMenu14 = $_POST['platoMenu14'];
        $platoMenu15 = $_POST['platoMenu15'];
        $platoMenu16 = $_POST['platoMenu16'];
        $platoMenu17 = $_POST['platoMenu17'];
        $platoMenu18 = $_POST['platoMenu18'];
        $platoMenu19 = $_POST['platoMenu19'];
        $platoMenu20 = $_POST['platoMenu20'];

        $consultaMenu = "SELECT * FROM tipo_menu WHERE nombre = '$nombreMenu'";
        $resultadoDatos = mysqli_query($con, $consultaMenu);

        if(mysqli_num_rows($resultadoDatos) == 1) {
            echo
            '<script>
                alert("Solicitud no efectuada, intentelo de nuevo");
                window.location = "../vistas/home/solicitudPersonalizado.php";
            </script>';
            exit();
        } else {
            $guardar = "INSERT INTO tipo_menu(nombre,ruta_imagen) VALUES ('$nombreMenu','$ruta')";
            $resultado = mysqli_query($con, $guardar);
            // $resultado = mysqli_query($con, $guardar);

            $consultaIdTipoMenu = "SELECT id_tipo_menu FROM tipo_menu WHERE nombre = '$nombreMenu'";
            $resultadoIdTipoMenu = mysqli_query($con, $consultaIdTipoMenu);
            $fila = mysqli_fetch_assoc($resultadoIdTipoMenu);

            $id = $fila['id_tipo_menu'];

            $guardarIntegra = "INSERT INTO
            integra(id_comida, id_tipo_menu, personalizado, cantidad_comida) 
            VALUES
            ('$platoMenu1','$id','$documentoCliente','20'),
            ('$platoMenu2','$id','$documentoCliente','20'),
            ('$platoMenu3','$id','$documentoCliente','20'),
            ('$platoMenu4','$id','$documentoCliente','20'),
            ('$platoMenu5','$id','$documentoCliente','20'),
            ('$platoMenu6','$id','$documentoCliente','20'),
            ('$platoMenu7','$id','$documentoCliente','20'),
            ('$platoMenu8','$id','$documentoCliente','20'),
            ('$platoMenu9','$id','$documentoCliente','20'),
            ('$platoMenu10','$id','$documentoCliente','20'),
            ('$platoMenu11','$id','$documentoCliente','20'),
            ('$platoMenu12','$id','$documentoCliente','20'),
            ('$platoMenu13','$id','$documentoCliente','20'),
            ('$platoMenu14','$id','$documentoCliente','20'),
            ('$platoMenu15','$id','$documentoCliente','20'),
            ('$platoMenu16','$id','$documentoCliente','20'),
            ('$platoMenu17','$id','$documentoCliente','20'),
            ('$platoMenu18','$id','$documentoCliente','20'),
            ('$platoMenu19','$id','$documentoCliente','20'),
            ('$platoMenu20','$id','$documentoCliente','20')";

            $resultadoIntegra = mysqli_query($con, $guardarIntegra);

            $guardarTiene = "INSERT INTO
            tiene(id_tipo_menu, id_estado_tipo_menu, fecha_inicio) 
            VALUES
            ('$id', '0', CURDATE())";
            $resultadoTiene = mysqli_query($con, $guardarTiene);

        }
    } else {
        // Menú hecho por Usuarios
        $nombreMenu = $_POST['nombreMenu'];
        $platoMenu1 = $_POST['platoMenu1'];
        $platoMenu2 = $_POST['platoMenu2'];
        $platoMenu3 = $_POST['platoMenu3'];
        $platoMenu4 = $_POST['platoMenu4'];
        $platoMenu5 = $_POST['platoMenu5'];
        $stockTecho = $_POST['stockTecho'];
        $stockPiso = $_POST['stockPiso'];
        $durabilidadMenu = $_POST['durabilidadMenu'];
        $precioMenu = $_POST['precioMenu'];
        /*$imagenMenu = $_POST['imagenMenu'];
        $imagenMenu = addslashes(file_get_contents($_FILES['imagenMenu']['tmp_name']));*/

        $consultaMenu = "SELECT * FROM tipo_menu WHERE nombre = '$nombreMenu'";
        $resultadoDatos = mysqli_query($con, $consultaMenu);
    
        if(mysqli_num_rows($resultadoDatos) == 1) {
            mysqli_close($con);
                    echo
                        '<script>
                            alert("ERROR, ya ha sido ingresada un menu con ese nombre");
                            window.location = "../vistas/home/solicitudPersonalizado.php";
                        </script>';
                    exit();
        } else if($stockPiso >= $stockTecho || $stockPiso < 0 || $stockTecho < 0){
            mysqli_close($con);
                    echo
                        '<script>
                            alert("ERROR, incoherencia en el Stock ingresado");
                            window.location = "../vistas/home/solicitudPersonalizado.php";
                        </script>';
                    exit();
        } else {
            $guardar = "INSERT INTO
            tipo_menu(nombre, stock_piso, stock_techo, durabilidad, precio) 
            VALUES
            ('$nombreMenu','$stockPiso','$stockTecho','$durabilidadMenu','$precioMenu')";
            $resultado = mysqli_query($con, $guardar);
            // $resultado = mysqli_query($con, $guardar);

            $consultaIdTipoMenu = "SELECT id_tipo_menu FROM tipo_menu WHERE nombre = '$nombreMenu'";
            $resultadoIdTipoMenu = mysqli_query($con, $consultaIdTipoMenu);
            $fila = mysqli_fetch_assoc($resultadoIdTipoMenu);
            $id = $fila['id_tipo_menu'];

            $guardarIntegra = "INSERT INTO
            integra(id_comida, id_tipo_menu, personalizado, cantidad_comida) 
            VALUES
            ('$platoMenu1','$id','0','5'),
            ('$platoMenu2','$id','0','5'),
            ('$platoMenu3','$id','0','5'),
            ('$platoMenu4','$id','0','5'),
            ('$platoMenu5','$id','0','5')";

            $resultadoIntegra = mysqli_query($con, $guardarIntegra);

            $guardarTiene = "INSERT INTO
            tiene(id_tipo_menu, id_estado_tipo_menu, fecha_inicio) 
            VALUES
            ('$id', '0', CURDATE())";
            $resultadoTiene = mysqli_query($con, $guardarTiene);

        }
    }

    if($resultado && $resultadoIntegra) {
            mysqli_close($con);
            echo
            '<script>
                alert("Solicitud efectuada exitosamente");
                window.location = "../vistas/home/solicitudPersonalizado.php";
            </script>';
            exit();
        
    } else {
        mysqli_close($con);
            echo
            '<script>
                alert("Solicitud no efectuada, intentelo de nuevo");
                window.location = "../vistas/home/solicitudPersonalizado.php";
            </script>';
        exit();
    }
    
?>