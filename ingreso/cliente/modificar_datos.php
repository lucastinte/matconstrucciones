<?php
include('../../db.php');

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ingreso.php");
    exit();
}

$usuario = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $tel = $_POST['tel'];
    $direccion = $_POST['direccion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    if (updateUserData($usuario, $apellido, $nombre, $dni, $tel, $direccion, $fecha_nacimiento)) {
        echo "<script>
            alert('Datos actualizados exitosamente.');
            window.location.href = 'modificar_datos.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al actualizar los datos.');
            window.location.href = 'modificar_datos.php';
        </script>";
    }
    exit();
}

$cliente = getUserData($usuario);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Datos</title>
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

    <section id="modify-data">
        <h1>Modificar Datos</h1>
        <form action="modificar_datos.php" method="post">
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($cliente['apellido']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni" value="<?php echo htmlspecialchars($cliente['dni']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tel">Teléfono:</label>
                <input type="text" id="tel" name="tel" value="<?php echo htmlspecialchars($cliente['tel']); ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($cliente['direccion']); ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($cliente['fecha_nacimiento']); ?>" required>
            </div>
            <button type="submit">Actualizar Datos</button>
        </form>
        <a href="cliente.php" class="back-button">Volver a Gestión de Cliente</a>
    </section>
</body>
</html>
