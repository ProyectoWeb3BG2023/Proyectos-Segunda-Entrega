



<?php
include("../datos/conexion/conexion.php");

$con = conectar();



    
// Supongamos que tienes el ID de la imagen
$id_imagen = 65; // Reemplaza con el ID correcto

$query = "SELECT ruta_imagen FROM tipo_menu WHERE id_tipo_menu = $id_imagen";
$resultado = mysqli_query($con, $query);

if ($row = mysqli_fetch_assoc($resultado)) {
    $ruta_imagen = $row['ruta_imagen'];
} else {
    // Manejar la situación en la que no se encuentra la imagen
    echo "Imagen no encontrada.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Imagen</title>
</head>
<body>
    <h1>Imagen:</h1>
    <img src="<?php echo $ruta_imagen; ?>" alt="Imagen" width="1000px">
</body>
</html>
