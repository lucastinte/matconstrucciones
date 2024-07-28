<?php
include('../../db.php');
session_start();

// Verifica que el usuario esté autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ingreso.php");
    exit();
}

// Consultar presupuestos
$query_presupuestos = "SELECT * FROM presupuestos";
$result_presupuestos = mysqli_query($conexion, $query_presupuestos);

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Presupuestos</title>
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

<section id="presupuestos">
    <h1>Gestión de Presupuestos</h1>
    <?php if (mysqli_num_rows($result_presupuestos) == 0) { ?>
        <p>No hay presupuestos registrados.</p>
    <?php } else { ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Validez</th>
                    <th>Monto</th>
                    <th>Comentario</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_presupuestos)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['validez']); ?></td>
                        <td><?php echo htmlspecialchars($row['monto']); ?></td>
                        <td><?php echo htmlspecialchars($row['comentario']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_creacion']); ?></td>
                        <td>
                            <a href="#" class="btn-view">Ver</a>
                            <a href="eliminar_presupuesto.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn-delete">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</section>



</body>
</html>
