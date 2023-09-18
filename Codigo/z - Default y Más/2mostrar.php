<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar</title>
</head>
<body>
    <a href="2index.php"><button>Volver a registro</button></a>
    <br><hr>
    <center>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Segundo nombre</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include("2conexion.php");
                $con = conectar();
                $query = "SELECT * FROM cliente";
                $resultado = mysqli_query($con,$query);
                while($row = mysqli_fetch_assoc($resultado)){ ;?>
                <tr>
                    <td><?= $row['id']?></td>
                    <td><?= $row['nombre']?></td>
                    <td><img height="70px" src="data:image/jpeg;base64,<?= base64_encode($row['imagen'])?>"></td>
                    <td><a href="editar.php?id=<?= $row['id']?>"><button>Modificar</button></a></td>
                    <td><a href="eliminar.php?id=<?= $row['id']?>"><button>Eliminar</button></a></td>
                </tr>

                <?php }?>

            </tbody>
        </table>
    </center>
</body>
</html>