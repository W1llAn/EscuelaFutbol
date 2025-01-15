-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2025 a las 18:16:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `academiafut`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canchas`
--

CREATE TABLE `canchas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `canchas`
--

INSERT INTO `canchas` (`id`, `nombre`) VALUES
(1, 'Cancha Principal'),
(2, 'Cancha Secundaria'),
(3, 'Cancha Cintética'),
(4, 'Cancha FutSal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `dia_entrenamiento` varchar(60) NOT NULL,
  `hora_inicio` varchar(6) NOT NULL,
  `hora_fin` varchar(6) NOT NULL,
  `id_cancha` int(11) NOT NULL,
  `id_entrenador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `dia_entrenamiento`, `hora_inicio`, `hora_fin`, `id_cancha`, `id_entrenador`) VALUES
(1, 'Sub8', 'Martes,Jueves', '08:00', '11:00', 3, 1),
(2, 'Sub12', 'Lunes,Miércoles,Viernes', '10:00', '12:00', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_jugadores`
--

CREATE TABLE `categorias_jugadores` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_jugador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_jugadores`
--

INSERT INTO `categorias_jugadores` (`id`, `id_categoria`, `id_jugador`) VALUES
(13, 1, 1),
(14, 1, 2),
(15, 2, 3),
(16, 2, 4),
(17, 1, 5),
(18, 1, 6),
(19, 2, 7),
(20, 2, 8),
(21, 1, 9),
(22, 2, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadores`
--

CREATE TABLE `entrenadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entrenadores`
--

INSERT INTO `entrenadores` (`id`, `nombre`) VALUES
(1, 'Juan Pérez'),
(2, 'María López');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `fecha_inscripcion` date NOT NULL,
  `fecha_pago_mensual` date NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `pago_mensual` decimal(10,2) NOT NULL,
  `estado_pago` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id`, `nombre`, `direccion`, `telefono`, `fecha_inscripcion`, `fecha_pago_mensual`, `fecha_nacimiento`, `pago_mensual`, `estado_pago`) VALUES
(1, 'Carlos Gómez', 'Calle 12344', '123456777', '2025-01-01', '2024-12-01', '2015-03-15', 55.00, 'Pagado'),
(2, 'Ana Torres', 'Calle 456', '0987654321', '2025-01-02', '2024-11-10', '2012-05-20', 30.00, 'Pagado'),
(3, 'Luis Martínez', 'Calle 789', '9876543210', '2025-01-03', '2024-02-20', '2014-07-10', 50.00, 'Pendiente'),
(4, 'Marta López', 'Av. Central 123', '4567891234', '2025-01-04', '2024-01-20', '2013-08-25', 60.00, 'Pendiente'),
(5, 'Pedro Sánchez', 'Av. Norte 456', '5678912345', '2025-01-05', '2024-01-25', '2011-11-15', 55.00, 'Pendiente'),
(6, 'Sofía Morales', 'Calle Sur 789', '6789123456', '2025-01-06', '2025-01-14', '2016-06-05', 45.00, 'Pagado'),
(7, 'Juan Pérez', 'Av. Este 123', '7891234567', '2025-01-07', '2024-01-30', '2015-01-10', 50.00, 'Pendiente'),
(8, 'María Fernández', 'Calle Oeste 456', '8912345678', '2025-01-08', '2024-01-30', '2013-02-20', 55.00, 'Pendiente'),
(9, 'Diego Rivera', 'Av. Primavera 789', '9123456789', '2025-01-09', '2024-02-05', '2012-09-15', 60.00, 'Pendiente'),
(10, 'Camila Rodríguez', 'Calle Verano 123', '2345678912', '2025-01-10', '2024-02-05', '2014-12-25', 50.00, 'Pendiente'),
(12, 'Alexander', '  Pillaro', ' 096768514', '2025-01-15', '2024-12-15', '2000-06-21', 45.00, 'Pagado'),
(13, 'peuwva', '  kjshd', ' 0929182', '2025-01-15', '2025-01-15', '2000-06-21', 0.00, 'Pagado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canchas`
--
ALTER TABLE `canchas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entrenadoresFK` (`id_entrenador`),
  ADD KEY `canchasFK` (`id_cancha`);

--
-- Indices de la tabla `categorias_jugadores`
--
ALTER TABLE `categorias_jugadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoriasFK` (`id_categoria`),
  ADD KEY `jugadoresFK` (`id_jugador`);

--
-- Indices de la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canchas`
--
ALTER TABLE `canchas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categorias_jugadores`
--
ALTER TABLE `categorias_jugadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `canchasFK` FOREIGN KEY (`id_cancha`) REFERENCES `canchas` (`id`),
  ADD CONSTRAINT `entrenadoresFK` FOREIGN KEY (`id_entrenador`) REFERENCES `entrenadores` (`id`);

--
-- Filtros para la tabla `categorias_jugadores`
--
ALTER TABLE `categorias_jugadores`
  ADD CONSTRAINT `categoriasFK` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `jugadoresFK` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
