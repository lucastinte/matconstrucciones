<?php
session_start();
include 'db.php';

// Obtener el estado actual de la base de datos
$sql = "SELECT mostrar_talentos FROM configuraciones WHERE id = 1";
$result = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($result);
$mostrar_talentos = $row['mostrar_talentos'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mat</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <header>
        <div class="container">
            <p class="logo">Mat Construcciones</p>
            <nav>
                <a href="index.php">Inicio</a>
                <a href="#Servicios">Servicios</a>
                <?php if ($mostrar_talentos): ?>
                    <a href="talentos.php">Talentos</a>
                <?php endif; ?>
                <a href="ingreso/ingreso.php">Ingresar</a>
                <a href="turnos.php">Turnos</a>
                <a href="enviar_presupuesto.php">Presupuestos</a>
            </nav>
        </div>
    </header>
                <main>
    <section id="hero">
        <h1>Construimos tus ideas <br> desarrollamos tus sueños</h1>
        <form action="#">
            <button>COMIENZA</button>
        </form>
    </section>

    <section id="Nosotros">
        <div class="container">
            <div class="img-container"></div>
            <div class="texto">
                <h2>Somos <br><span class="color-acento">Mat Construcciones</span></h2>
                <h1>Un equipo caracterizado por el cumplimiento</h1>
                <p>Pensamos que el desarrollo de un proyecto es
                    la construccion de un sueño, la alquimia de lo posible</p>
                <button>Saber Mas</button>
            </div>
        </div>
    </section>

    <section id="Servicios">
        <div class="container">
            <h3>GENERAR CONFIANZA</h3>
            <h2>LA EXCELENCIA EN NUESTROS TRABAJOS <br> NOS REPRESENTA</h2>
            <div class="trabajo">
                <div class="tarjeta">
                    <h3>CANCHAS</h3>
                    <p>Canchas de todo tipo, de cesped sintetico o natural.
                        Para uso familiar o de alquiler.</p>
                </div>
                <div class="tarjeta">
                    <h3>HOGARES</h3>
                    <p>Casas modernas, amplias, iluminadas, un hogar para
                        vos y tu familia.</p>
                </div>
                <div class="tarjeta">
                    <h3>PISCINAS</h3>
                    <p>Todo tipo de piscinas, piletas, a medida. Con diseño
                        unico y sorprendente.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="caracterisiticas">

    </section>

    <section id="final">
        <h2>Listo para Construir?</h2>
        <button>COMIENZA</button>
    </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy;MatC</p>
        </div>
    </footer>
</body>
</html>
