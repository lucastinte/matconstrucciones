<?php
include('../../db.php');
session_start();

// Verifica que el usuario esté autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ingreso.php");
    exit();
}

// Consultar talentos
$query_talentos = "SELECT * FROM talentos";
$result_talentos = mysqli_query($conexion, $query_talentos);

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Talentos</title>
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
<section id="talentos">
    <h1>Gestión de Talentos</h1>
    <?php if (mysqli_num_rows($result_talentos) == 0) { ?>
        <p>No hay talentos registrados.</p>
    <?php } else { ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Puesto</th>
                    <th>CV</th>
                    <th>Fecha de Postulación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_talentos)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['puesto']); ?></td>
                        <td><a href="<?php echo htmlspecialchars($row['cv_path']); ?>" download>Descargar CV</a></td>
                        <td><?php echo htmlspecialchars($row['fecha_postulacion']); ?></td>
                        <td>
                            <a href="#" class="btn-view">Ver</a>
                            <a href="eliminar_talento.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn-delete">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</section>


</body>
</html>
