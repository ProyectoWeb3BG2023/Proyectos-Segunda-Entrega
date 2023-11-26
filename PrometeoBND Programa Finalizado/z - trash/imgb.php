<?php
include("../datos/conexion/conexion.php");

$con = conectar();

if($_POST) {

    // $img = $_POST["imagen"];

    // Verificar si se ha enviado un archivo
    if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $nombre_temporal = $_FILES['imagen']['tmp_name'];
        $nombre_original = $_FILES['imagen']['name'];
        
        // Mover la imagen al directorio deseado
        $ruta = "C:/xampp/htdocs/PrometeoOrdenadoActua/recursos/img/" . $nombre_original;
        move_uploaded_file($nombre_temporal, $ruta);
        
        // Guardar la ruta en la base de datos
        $query = "INSERT INTO tipo_menu (ruta_imagen) VALUES ('$ruta')";
        mysqli_query($con, $query);
        
        echo "Imagen subida exitosamente.";
    } else {
        echo "Error al subir la imagen.";
    }

}



?>