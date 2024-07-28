<?php
include('../../db.php');
session_start();

// Verifica que el usuario esté autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ingreso.php");
    exit();
}

// Consultar turnos
$query_turnos = "SELECT * FROM turnos";
$result_turnos = mysqli_query($conexion, $query_turnos);

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Turnos</title>
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

                <a href="usuario.php"> <button>Volver</button></a>

            </nav>
        </div>
    </header>

<section id="turnos">
    <h1>Gestión de Turnos</h1>
    <?php if (mysqli_num_rows($result_turnos) == 0) { ?>
        <p>No hay turnos registrados.</p>
    <?php } else { ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Comentario</th>
                    <th>Presupuesto</th>
                    <th>Cliente Existente</th>
                    <th>Creado en</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_turnos)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($row['hora']); ?></td>
                        <td><?php echo htmlspecialchars($row['comentario']); ?></td>
                        <td><?php echo htmlspecialchars($row['presupuesto'] ? 'Sí' : 'No'); ?></td>
                        <td><?php echo htmlspecialchars($row['cliente_existente'] ? 'Sí' : 'No'); ?></td>
                        <td><?php echo htmlspecialchars($row['creado_en']); ?></td>
                        <td>
                            <a href="#" class="btn-view">Ver</a>
                            <a href="eliminar_turno.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn-delete">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</section>



</body>
</html>
