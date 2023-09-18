<?php
    
    include("conexion.php");
    $con = conectar();
    if($_POST){
        $nombre = $_POST['nombre'];
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

        $guardar = "INSERT INTO 
            producto(nombre, imagen) 
            VALUES
            ('$nombre','$imagen')";
        
        $resultado = mysqli_query($con,$guardar);

        if($resultado){
            mysqli_close($con);
            echo 
            '<script>
                alert("Registro realizado exitosamente");
                window.location = "./index.php";
            </script>';
            exit();
            
        }
        
    }

?>