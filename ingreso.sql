-- Creación de la tabla `clientes`
CREATE TABLE `clientes` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `apellido` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar datos en la tabla `clientes`
INSERT INTO `clientes` (`id`, `apellido`, `nombre`, `dni`, `tel`, `email`, `usuario`, `direccion`, `fecha_nacimiento`, `password`, `reg_date`) VALUES
(1, 'duran', 'damian', '33758278', '3815991790', 'dsd1711@gmail.com', '', 'Los Tipales 260', '1988-11-17', '$2y$10$wpGWJ5QBJP0yviv/lIvDdu/Q8eVyWyEJMYr3RCaK.u3RXKKG1pS/i', '2024-06-18 16:08:48');

-- Creación de la tabla `usuarios`
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar datos en la tabla `usuarios`
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `password`) VALUES
(1, 'duran', 'damian', '123');

-- Creación de la tabla `turnos`
CREATE TABLE `turnos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100),
  `apellido` VARCHAR(100),
  `email` VARCHAR(100),
  `telefono` VARCHAR(20),
  `fecha` DATE,
  `hora` TIME,
  `comentario` TEXT,
  `presupuesto` BOOLEAN,
  `cliente_existente` BOOLEAN,
  `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creación de la tabla `talentos`
CREATE TABLE `talentos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `puesto` VARCHAR(255) NOT NULL,
  `cv_path` VARCHAR(255) NOT NULL,
  `fecha_postulacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creación de la tabla `proyectos`
CREATE TABLE `proyectos` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_cliente` int(6) UNSIGNED NOT NULL,
  `nombre_proyecto` varchar(100) NOT NULL,
  `descripcion` text,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date,
  `estado` varchar(20),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_cliente`) REFERENCES clientes(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creación de la tabla `archivos`
CREATE TABLE `archivos` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_proyecto` int(6) UNSIGNED NOT NULL,
  `nombre_archivo` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_proyecto`) REFERENCES proyectos(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creación de la tabla `presupuestos`
CREATE TABLE `presupuestos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `validez` DATE NOT NULL,
  `monto` DECIMAL(10, 2) NOT NULL,
  `comentario` TEXT NOT NULL,
  `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creación de la tabla `configuraciones`
CREATE TABLE `configuraciones` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `mostrar_talentos` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar datos en la tabla `configuraciones`
INSERT INTO `configuraciones` (`mostrar_talentos`) VALUES (1);
