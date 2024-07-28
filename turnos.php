<?php
include('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $comentario = $_POST['comentario'];
    $presupuesto = isset($_POST['presupuesto']) ? 1 : 0;
    $cliente_existente = isset($_POST['cliente_existente']) ? 1 : 0;

    $insert_query = "INSERT INTO turnos (nombre, apellido, email, telefono, fecha, hora, comentario, presupuesto, cliente_existente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $insert_query);
    mysqli_stmt_bind_param($stmt, "sssssssii", $nombre, $apellido, $email, $telefono, $fecha, $hora, $comentario, $presupuesto, $cliente_existente);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $message_turno = "Turno agendado exitosamente.";
    } else {
        $message_turno = "Error al agendar el turno.";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mat Construcciones - Turnos</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <div class="container">
        <p class="logo">Mat Construcciones</p>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="#Servicios">Servicios</a>
            <a href="talentos.php">Talentos</a>
            <a href="ingreso/ingreso.php">Ingresar</a>
            <a href="turnos.php">Turnos</a>
            <a href="enviar_presupuesto.php">Presupuestos</a>
        </nav>
    </div>
</header>
<main>
    <h1 class="color-acento">¡Súmate a la empresa, envía tu CV!</h1>

    <section id="turnos">
        <div class="container">
            <?php if (isset($message_turno)) { ?>
                <p class="message"><?php echo htmlspecialchars($message_turno); ?></p>
            <?php } ?>

            <form action="turnos.php" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" required>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora" required>

                <label for="comentario">Comentario:</label>
                <textarea id="comentario" name="comentario"></textarea>

                <div>
                    <input type="checkbox" id="presupuesto" name="presupuesto">
                    <label for="presupuesto">¿Ya realizó un presupuesto?</label>
                </div>

                <div>
                    <input type="checkbox" id="cliente_existente" name="cliente_existente">
                    <label for="cliente_existente">¿Es un cliente existente?</label>
                </div>

                <button type="submit">Agendar Turno</button>
            </form>
        </div>
    </section>
</main>
<footer>
    <div class="container">
        <p>&copy;MatC</p>
    </div>
</footer>
</body>
</html>
