<?php
include('db.php');

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $validez = $_POST['validez'];
    $monto = $_POST['monto'];
    $comentario = $_POST['comentario'];

    // Consulta para insertar en la base de datos
    $insert_query = "INSERT INTO presupuestos (nombre, apellido, telefono, email, validez, monto, comentario) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $insert_query);
    mysqli_stmt_bind_param($stmt, "ssssids", $nombre, $apellido, $telefono, $email, $validez, $monto, $comentario);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $message = "Presupuesto enviado exitosamente.";
    } else {
        $message = "Error al enviar el presupuesto.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Presupuesto</title>
    <link rel="stylesheet" href="index.css"> <!-- Cambia el nombre del archivo de CSS si es necesario -->
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
        <section id="presupuesto-form">
            <h1 class="color-acento">Enviar Presupuesto</h1>
            <?php if (isset($message)) { ?>
                <p class="message"><?php echo htmlspecialchars($message); ?></p>
            <?php } ?>

            <form action="enviar_presupuesto.php" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>
                
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="validez">Validez:</label>
                <input type="date" id="validez" name="validez" required>
                
                <label for="monto">Monto:</label>
                <input type="number" id="monto" name="monto" step="0.01" required>
                
                <label for="comentario">Comentario:</label>
                <textarea id="comentario" name="comentario" rows="4" required></textarea>
                
                <button type="submit">Enviar</button>
            </form>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; Mat Construcciones</p>
        </div>
    </footer>
</body>
</html>
