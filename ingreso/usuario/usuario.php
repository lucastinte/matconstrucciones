<?php
session_start();
include '../../db.php';

// Obtener el estado actual de la base de datos
$sql = "SELECT mostrar_talentos FROM configuraciones WHERE id = 1";
$result = mysqli_query($conexion, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $mostrar_talentos = $row['mostrar_talentos'];
} else {
    // Si no se encuentra la fila, inicializar con valor predeterminado
    $mostrar_talentos = 0;
}

// Manejar el cambio de estado del botón
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['activar_talentos'])) {
        $sql = "UPDATE configuraciones SET mostrar_talentos = 1 WHERE id = 1";
        mysqli_query($conexion, $sql);
        $mostrar_talentos = true;
    } elseif (isset($_POST['desactivar_talentos'])) {
        $sql = "UPDATE configuraciones SET mostrar_talentos = 0 WHERE id = 1";
        mysqli_query($conexion, $sql);
        $mostrar_talentos = false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Usuario</title>
    <link rel="stylesheet" href="usuario.css">
</head>

<body>
    <header>
        <div class="container">
            <p class="logo">Mat Construcciones</p>
            <nav>
                <a href="gestion_cliente/gestioncliente.html">Gestion <br> Clientes</a>
                <a href="gestion_usuario/gestionusuario.html">Gestion <br>Usuarios</a>
                <a href="talentos.php">Gestion <br>Talentos</a>
                <a href="turnos.php">Gestion <br>Turnos</a>
                <a href="presupuestos.php">Gestion <br>Presupuesto</a>

                <a href="../../index.php"> <button>Inicio</button></a>
            </nav>
        </div>
    </header>

    <section id="hero">
        <h1>BIENVENIDO<br> AL SISTEMA DE GESTION <br> COMO USUARIO</h1>
        <form method="post">
            <button type="submit" name="activar_talentos">Activar Talentos</button>
            <button type="submit" name="desactivar_talentos">Desactivar Talentos</button>
        </form>
    </section>
</body>
</html>
