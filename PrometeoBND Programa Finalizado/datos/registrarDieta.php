<?php
    session_start();
    include("conexion/conexion.php");
    $con = conectar();
    if ($_POST) {
        $nombreDieta = $_POST['nombreDieta'];
        $descripcionDieta = $_POST['descripcionDieta'];

        $consultaDieta = "SELECT * FROM dieta WHERE nombre_dieta = '$nombreDieta'";
        $resultadoDatos = mysqli_query($con, $consultaDieta);
    
        if(mysqli_num_rows($resultadoDatos) == 1) {
            mysqli_close($con);
                    echo
                        '<script>
                            alert("ERROR, ya ha sido ingresada una dieta con ese nombre");
                            window.location = "../vistas/jefeCocina/homeNuevo.php";
                        </script>';
                    exit();
        } else {
            $guardar = "INSERT INTO 
            dieta(nombre_dieta, descripcion, autorizacion) 
            VALUES
            ('$nombreDieta','$descripcionDieta', '0')";

            $resultado = mysqli_query($con, $guardar);

            if($resultado) {
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