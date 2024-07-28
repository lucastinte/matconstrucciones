<?php
// Incluir el archivo de conexión a la base de datos
include('../../../db.php');
session_start();

// Verificar si se ha establecido la conexión correctamente
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Manejar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password']; // Cambié 'contraseña' por 'password'

    // Preparar y vincular
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, usuario, password) VALUES (?, ?, ?)"); // Cambié 'contraseña' por 'password'
    $stmt->bind_param("sss", $nombre, $usuario, $password); // Cambié 'contraseña' por 'password'

    if ($stmt->execute()) {
        echo "<script>
            if (confirm('Registro exitoso. ¿Quieres registrar otro usuario?')) {
                window.location.href = 'formulario.html';
            } else {
                window.location.href = '/ingreso/usuario/gestion_usuario/gestionusuario.html';
            }
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
    exit(); // Asegúrate de detener el script después de procesar el formulario
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="formulario.css">
</head>

<body>
    <div class="container">
        <h2>REGISTRO DE USUARIOS</h2>
        <form action="formulario.php" method="post" class="login-form">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label> <!-- Cambié 'contraseña' por 'password' -->
                <input type="password" id="password" name="password" required> <!-- Cambié 'contraseña' por 'password' -->
            </div>
            <button type="submit">REGISTRAR</button>
        </form>
        <p></p>
        <a href="/ingreso/usuario/gestion_usuario/gestionusuario.html"><button>VOLVER</button></a>
    </div>
</body>

</html>
