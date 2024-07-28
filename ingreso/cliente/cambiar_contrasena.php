<?php
include('../../db.php');
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ingreso.php");
    exit();
}

$mensaje = '';
$exito = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_SESSION['usuario'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar la contraseña actual
    $consulta_cliente = "SELECT * FROM clientes WHERE email='$usuario'";
    $resultado_cliente = mysqli_query($conexion, $consulta_cliente);
    $cliente = mysqli_fetch_assoc($resultado_cliente);

    if ($cliente && password_verify($current_password, $cliente['password'])) {
        if ($new_password === $confirm_password) {
            // Actualizar la contraseña
            $new_password_hashed = password_hash($new_password, PASSWORD_BCRYPT);
            $sql = "UPDATE clientes SET password='$new_password_hashed' WHERE email='$usuario'";

            if (mysqli_query($conexion, $sql)) {
                $mensaje = 'Contraseña cambiada exitosamente.';
                $exito = true;
            } else {
                $mensaje = 'Error al cambiar la contraseña. Inténtelo de nuevo.';
            }
        } else {
            $mensaje = 'Las contraseñas no coinciden.';
        }
    } else {
        $mensaje = 'Contraseña actual incorrecta.';
    }

    mysqli_close($conexion);

    if ($exito) {
        echo "<script>
            alert('$mensaje');
            window.location.href = cliente.php';
        </script>";
    } else {
        echo "<script>
            alert('$mensaje');
            window.location.href = 'cambiar_contrasena.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="clienteform.css">
</head>

<body>
    <header>
        <div class="container">
            <p class="logo">Mat Construcciones</p>
            <nav>
            <a href="logout.php" class="logout-button">Salir</a>

                <a href="cambiar_contrasena.php">Cambiar Contraseña</a>
                <a href="eliminar_cuenta.php">Eliminar Mi Cuenta</a>
                <a href="modificar_datos.php">Modificar Datos</a>
                <a href="consultar_proyecto.php">Consultar Proyecto</a>
            </nav>
        </div>
    </header>

    <section id="change-password">
        <h1>Cambiar Contraseña</h1>
        <form action="cambiar_contrasena.php" method="post">
            <div class="form-group">
                <label for="current_password">Contraseña Actual:</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Nueva Contraseña:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmar Nueva Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit">Actualizar Contraseña</button>
        </form>
        <a href="cliente.php" class="back-button">Volver a Gestión de Cliente</a>
    </section>
</body>

</html>
