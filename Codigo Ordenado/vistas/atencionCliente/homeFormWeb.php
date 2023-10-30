<?php
include("../../datos/conexion/conexion.php");
session_start();
$con = conectar();
// var_dump($_SESSION['id_cliente']);
// $query = "SELECT id_cliente, tipo_documento, autorizacion
// FROM cliente
// WHERE id_cliente = ";

// $result = mysqli_query($con, $query);

// $filas = mysqli_fetch_array($result);
// $fil = mysqli_fetch_array($result);

////

// $datos_clientes = $_SESSION['datos_clientes'];

// $ic = $datos_clientes[0];
// $prn = $datos_clientes[1];
// $sn = $datos_clientes[2];
// $pa = $datos_clientes[3];
// $sa = $datos_clientes[4];
// $d = $datos_clientes[5];
// $td = $datos_clientes[6];
// $m = $datos_clientes[7];
// $c = $datos_clientes[8];
// $p = $datos_clientes[9];
// $e = $datos_clientes[10];

$a = $_SESSION["suma"];

var_dump($_SESSION["datosCliente$a"]);
// $inicio = $_SESSION['begin'];
// echo $_SESSION['begin'];
// $dato_cliente = $_SESSION["idWeb$inicio"];

//  echo $_SESSION["idWeb$inicio"];
// var_dump($_SESSION['datos_clientes']);

// foreach ($datos_clientes as $cliente) {
//     $idCliente = $cliente[0]; // Accede al primer campo de datos
//     $primerNombre = $cliente[1]; // Accede al segundo campo de datos
//     $segundoNombre = $cliente[2]; // Accede al tercer campo de datos
//     // ... y así sucesivamente
//     $pa = $cliente[3];
//     $sa = $cliente[4];
//     $d = $cliente[5];
//     $td = $cliente[6]; 
//     $m = $cliente[7];
//     $c = $cliente[8];
//     $p = $cliente[9];
//     $e = $cliente[10];
// }


// if (isset($_GET['id'])) {
//     $idCliente = $_GET['id'];
//     // Ahora puedes usar $idCliente para cargar los datos específicos del cliente desde tu arreglo o base de datos
// } else {
//     // Maneja el caso en el que no se proporciona un ID en la URL
// }




?>  
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Diego Weble, Nathan Guerra, Bruno Bordagorry">
    <meta name="generator" content="Visual Studio Code">
    <meta http-equiv="X-UA-Compatible" content="IE=chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <!-- <link rel="stylesheet" href="../../recursos/css/fonts.css"> -->
    <link rel="stylesheet" href="../../recursos/css/header.css">
    <link rel="stylesheet" href="../../recursos/css/footercVolverArriba.css">
    <title>Ingreso Nuevo</title>
    <link rel="stylesheet" href="../../recursos/css/AtencionCliente/styleFormWeb.css">
    <link rel="icon" href="../../recursos/img/logo.png">
</head>

<body>
    <header id="header">
        <div class="divContenedor">
            <div class="divSubContenedorIzquierda">
                <a href="homepage.html">
                    <img src="../../../src/logo.png">
                </a>
                <a href="homepage.html" class="linkCentrado">Home</a>
            </div>

            <div class="divSubContenedorDerecha">
            <a href="../../datos/logout.php" class="linkCentrado">Cerrar Sesión</a>
            <a class="linkCentrado">
                <!-- Nombre User -->
                <?php
                    echo $_SESSION['nombre_usuario'];
                ?>
            </a>
                <img src="../../recursos/img/usr.png" class="linkCentrado" alt="">
            </div>
        </div>
    </header>

    <section class="contenedorFormulario">
        <article class="subContenedorTitulo">
            Cliente Web
        </article>
        <article class="subContenedorFormulario" id="opcionesWeb">
                <form action="../../datos/registrarWeb.php" method="post" enctype="multipart/form-data" class="formRegistroClienteWeb">
                    <label>Formulario</label>
                    <p>
                        <input type="text" id="n1" name="primernombre" readonly value="<?php echo $idCliente; ?>" placeholder="Primer nombre">
                        <input type="text" name="segundonombre" placeholder="Segundo nombre">
                    </p>
                    <p>
                        <input type="text" name="primerapellido" required placeholder="Primer Apellido">
                        <input type="text" name="segundoapellido" placeholder="Segundo apellido">
                    </p>
                    <p>
                        <input type="text" name="documento" required placeholder="Documento">
                        <input type="email" name="mail" required placeholder="Mail">
                    </p>
                    <p class="pDatoDomicilioUsuario">
                        <input type="text" name="calle" required placeholder="Calle">
                        <input type="number" name="puerta" required placeholder="Puerta">
                        <input type="text" name="esquina" required placeholder="Esquina">
                    </p>
                    <input type="text" class="inputDatoComentario">
                    <input type="submit" class="botonEnviarFormulario" value="Enviar" name="registrar">
                </form>
        </article>
    </section>
    <footer>
        <section>
            <a href="#header">Volver arriba</a>
        </section>
        <p>Copyright - Prometeo BND</p>
        
    </footer>
    <?php
    mysqli_close($con);
        ?>
</body>
</html>