<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $puesto = $_POST['puesto'];
    
    // Maneja el archivo del CV
    $cv = $_FILES['cv'];
    $cv_name = $cv['name'];
    $cv_tmp_name = $cv['tmp_name'];
    $cv_path = 'cv/' . $cv_name;

    if (move_uploaded_file($cv_tmp_name, $cv_path)) {
        $insert_query = "INSERT INTO talentos (nombre, email, puesto, cv_path) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $insert_query);
        mysqli_stmt_bind_param($stmt, "ssss", $nombre, $email, $puesto, $cv_path);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $message = "Tu postulación ha sido recibida exitosamente.";
        } else {
            $message = "Error al procesar tu postulación.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $message = "Error al subir el CV.";
    }
    
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Talentos</title>
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
        <section id="talentos-form">
            <h1 class="color-acento">Postula tu Talento</h1>
            <?php if (isset($message)) { ?>
                <p class="message"><?php echo htmlspecialchars($message); ?></p>
            <?php } ?>

            <form action="talentos.php" method="post" enctype="multipart/form-data">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="puesto" placeholder="Puesto al que aspiras" required>
                <input type="file" name="cv" accept=".pdf,.doc,.docx" required>
                <button type="submit">Enviar</button>
            </form>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy;Mat Construcciones</p>
        </div>
    </footer>
</body>
</html>
