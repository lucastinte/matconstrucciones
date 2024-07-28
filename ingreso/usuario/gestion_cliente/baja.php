<?php
include('../../../db.php');
session_start();

// Redirigir si el usuario no está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../ingreso/ingreso.php");
    exit();
}

// Manejo de eliminación de cliente
if (isset($_POST['eliminar'])) {
    $id_cliente = intval($_POST['id_cliente']); // Sanitización básica

    // Consulta para eliminar el cliente
    $delete_query = "DELETE FROM clientes WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $id_cliente);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $message = "Cliente eliminado exitosamente.";
    } else {
        $message = "Error al eliminar el cliente.";
    }
    mysqli_stmt_close($stmt);
}

// Obtener todos los clientes
$query = "SELECT id, nombre, email FROM clientes";
$result = mysqli_query($conexion, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baja de Clientes</title>
    <link rel="stylesheet" href="gestioncliente.css">
    <script>
        function confirmDelete() {
            return confirm('¿Estás seguro de que deseas eliminar este cliente?');
        }
    </script>
</head>

<body>

    <header>
        <div class="container">
            <p class="logo">Mat Construcciones</p>
            <nav>
                <a href="alta/alta.html">Alta</a>
                <a href="baja.php">Baja</a>
                <a href="modificar.php">Modificar</a>
                <a href="gestioncliente.html">Volver</a>
            </nav>
        </div>
    </header>

    <section id="client-list" class="forms">
        <h1>Eliminar Clientes</h1>

        <?php if (isset($message)) { ?>
        <p><?php echo htmlspecialchars($message); ?></p>
        <?php } ?>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                        <form action="baja.php" method="post" style="display:inline;">
                            <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <button type="submit" name="eliminar" onclick="return confirmDelete();">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>

</body>

</html>
