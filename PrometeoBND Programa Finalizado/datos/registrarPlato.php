<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();

    if ($_POST) {
        $nombrePlato = $_POST['nombrePlato'];
        $opcionDieta = $_POST['opcionDieta'];
        $ingredientesPlato = $_POST['ingredientesPlato'];
        /*$descripcionDieta = $_POST['descripcionDieta'];*/
        //$imagen = addslashes(file_get_contents($_FILES['imagenPlato']['tmp_name']));

        $consultaPlato = "SELECT * FROM comida WHERE nombre = '$nombrePlato'";
        $resultadoDatos = mysqli_query($con, $consultaPlato);
    
        if(mysqli_num_rows($resultadoDatos) == 1) {
            mysqli_close($con);
                    echo
                        '<script>
                            alert("ERROR, ya ha sido ingresada un plato con ese nombre");
                            window.location = "../vistas/jefeCocina/homeNuevo.php";
                        </script>';
                    exit();
        } else {
            $guardar = "INSERT INTO 
            comida(nombre, ingredientes, descripcion, autorizacion) 
            VALUES
            ('$nombrePlato','$ingredientesPlato', 'PorDefinir', '0')";

            $resultado = mysqli_query($con, $guardar);

            $consultaIdComida = "SELECT id_comida FROM comida WHERE nombre = '$nombrePlato'";
            $resultadoIdComida = mysqli_query($con, $consultaIdComida);
            $fila = mysqli_fetch_assoc($resultadoIdComida);
            $id = $fila['id_comida'];

            $guardarSeAjusta = "INSERT INTO 
            se_ajusta(id_comida, id_dieta) 
            VALUES
            ('$id', '$opcionDieta')";

            $resultadoSeAjusta = mysqli_query($con, $guardarSeAjusta);

            if($resultado && $resultadoSeAjusta) {
                mysqli_close($con);
                echo
                    '<script>
                        alert("Registro realizado exitosamente");
                        window.location = "../vistas/jefeCocina/homeNuevo.php";
                    </script>';
                exit();
            } else {
                mysqli_close($con);
                echo
                    '<script>
                        alert("Registro no efectuado, intentelo de nuevo");
                        window.location = "../vistas/jefeCocina/homeNuevo.php";
                    </script>';
                exit();
            }
        }
    }
?>