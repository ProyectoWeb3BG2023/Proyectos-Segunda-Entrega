<?php

include("conexion/conexion.php");
$con = conectar();
if ($_POST) {

    $nombreMenu = $_POST['nombreMenu'];

    /*$platoMenu1 = $_POST['platoMenu1'];

    $platoMenu2 = $_POST['platoMenu2'];

    $platoMenu3 = $_POST['platoMenu3'];*/

    $stockTecho = $_POST['stockTecho'];

    $stockPiso = $_POST['stockPiso'];

    $durabilidadMenu = $_POST['durabilidadMenu'];

    $precioMenu = $_POST['precioMenu'];

    
    
    /*$imagenMenu = $_POST['imagenMenu'];

    $imagenMenu = addslashes(file_get_contents($_FILES['imagenMenu']['tmp_name']));
*/
    $guardar = "INSERT INTO 
    tipo_menu(nombre, stock_piso, stock_techo, durabilidad, precio) 
    VALUES
    ('$nombreMenu','$stockPiso','$stockTecho','$durabilidadMenu','$precioMenu')";

    $resultado = mysqli_query($con, $guardar);

     if($resultado) {
         mysqli_close($con);
         echo
             '<script>
                 alert("Registro realizado exitosamente");
                 window.location = "../recursos/jefeCocina/homeNuevo.php";
             </script>';
         exit();
     }else{
        mysqli_close($con);
         echo
             '<script>
                 alert("Registro no efectuado, intentelo de nuevo");
                 window.location = "../recursos/jefeCocina/homeNuevo.php";
             </script>';
         exit();
     }
}
?>