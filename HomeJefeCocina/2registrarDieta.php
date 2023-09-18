<?php

include("2conexion.php");
$con = conectar();
if ($_POST) {

    $nombreDieta = $_POST['nombreDieta'];

    $descripcionDieta = $_POST['descripcionDieta'];


    $guardar = "INSERT INTO 
    dieta(nombre_dieta, descripcion) 
    VALUES
    ('$nombreDieta','$descripcionDieta')";

    $resultado = mysqli_query($con, $guardar);

     if($resultado) {
         mysqli_close($con);
         echo
             '<script>
                 alert("Registro realizado exitosamente");
                 window.location = "./homeNuevo.php";
             </script>';

             
         exit();

     }else{

        mysqli_close($con);
         echo
             '<script>
                 alert("Registro no efectuado, intentelo de nuevo");
                 window.location = "./homeNuevo.php";
             </script>';
         exit();

     }

}

?>