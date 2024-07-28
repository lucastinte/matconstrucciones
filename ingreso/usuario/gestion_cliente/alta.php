<?php
include('../../../db.php');
session_start();

// Verificar si la conexión se ha establecido correctamente
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Manejar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $usuario = $email; // Usuario es igual al email
    $direccion = $_POST['direccion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT); // Encriptar la contraseña

    // Preparar la consulta para evitar SQL Injection
    $stmt = $conexion->prepare("INSERT INTO clientes (apellido, nombre, dni, tel, email, usuario, direccion, fecha_nacimiento, password) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $apellido, $nombre, $dni, $tel, $email, $usuario, $direccion, $fecha_nacimiento, $contraseña);

    if ($stmt->execute()) {
        echo "<script>
            if (confirm('Registro exitoso. ¿Quieres registrar otro cliente?')) {
                window.location.href = 'alta.php';
            } else {
                window.location.href = 'gestioncliente.html';
            }
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
    exit(); // Detener el script después de procesar el formulario
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="../../../../index.css">
</head>

<body>
    <main style="padding: 20px;">
        <form action="alta.php" method="post">
            <h3 style="text-align: center;">Registro de Clientes</h3>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" required><br><br>

            <label for="tel">Teléfono:</label>
            <input type="text" id="tel" name="tel" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required><br><br>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br><br>

            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required><br><br>

            <input type="submit" value="Registrar">
        </form>
    </main>
    <button style="width: 100px; margin: 20px auto ; padding: 10px;">
        <a href="../gestioncliente.html" style="text-decoration: none;color: aliceblue;">Volver</a>
    </button>
</body>

</html>