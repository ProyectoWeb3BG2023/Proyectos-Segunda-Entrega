<?php

include("conexion/conexion.php");
$con = conectar();
if ($_POST) {

    $nombrePlato = $_POST['nombrePlato'];

    $opcionDieta = $_POST['opcionDieta'];

    /*$descripcionDieta = $_POST['descripcionDieta'];*/

    $ingredientesPlato = $_POST['ingredientesPlato'];

    //$imagen = addslashes(file_get_contents($_FILES['imagenPlato']['tmp_name']));

    $guardar = "INSERT INTO 
    comida(nombre, ingredientes) 
    VALUES
    ('$nombrePlato','$ingredientesPlato')";

    $resultado = mysqli_query($con, $guardar);

     if($resultado) {
         mysqli_close($con);
         echo
              '<script>
                  alert("Registro realizado exitosamente");
                  window.location = "../nuevo/homeNuevo.php";
              </script>';
         exit();
     }else{
        mysqli_close($con);
         echo
             '<script>
                 alert("Registro no efectuado, intentelo de nuevo");
                 window.location = "../nuevo/homeNuevo.php";
             </script>';
         exit();
     }
}
?>