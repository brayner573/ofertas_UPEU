-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2024 a las 05:37:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_laboral`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(255) DEFAULT NULL,
  `ruc` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `razon_social`, `ruc`, `direccion`, `telefono`, `correo`, `id_rol`, `id_usuario`, `created`, `updated`) VALUES
(24, 'Gloria SAC', '452154854125', 'cultura', '975348218', 'gloria@gmail.com', NULL, 48, '2024-04-26 02:02:55', '2024-04-26 02:05:34'),
(25, 'upeu', '458451', 'floral', '9554121', 'upeu@gmail.com', NULL, 52, '2024-04-26 05:04:15', '2024-04-26 05:04:20'),
(26, 'gustavo sac', '541258965215', 'cultura', '9554121', 'hola@gmail.com', NULL, NULL, '2024-04-28 17:37:42', '2024-04-28 18:44:19'),
(27, 'prueba', '45454212545454', 'floral', '9554121', 'hola@gmail.com', NULL, NULL, '2024-04-29 03:52:26', '2024-04-29 03:52:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_oferta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `id_usuario`, `mensaje`, `fecha_creacion`, `id_oferta`) VALUES
(7, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-04 04:30:16', 0),
(8, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-04 04:40:14', 0),
(9, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-04 04:54:43', 0),
(10, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-04 04:54:49', 0),
(11, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-07 02:42:35', 0),
(12, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-14 03:19:35', 0),
(13, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-14 03:25:13', 0),
(14, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-14 03:43:44', 0),
(15, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-14 03:52:19', 0),
(16, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-14 04:07:57', 0),
(17, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-15 02:26:25', 0),
(18, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-15 02:27:22', 0),
(19, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-15 02:27:27', 0),
(20, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-15 02:30:29', 0),
(21, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-15 02:30:35', 0),
(22, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-15 02:41:39', 42),
(23, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo.', '2024-05-15 02:42:23', 42),
(24, 53, '¡Felicidades! Has sido seleccionado para el puesto de trabajo. ', '2024-05-15 02:47:11', 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_laboral`
--

CREATE TABLE `oferta_laboral` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_publicacion` date DEFAULT NULL,
  `fecha_cierre` date DEFAULT NULL,
  `remuneracion` decimal(10,2) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `tipo` enum('presencial','remoto') DEFAULT NULL,
  `limite_postulantes` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oferta_laboral`
--

INSERT INTO `oferta_laboral` (`id`, `id_empresa`, `titulo`, `descripcion`, `fecha_publicacion`, `fecha_cierre`, `remuneracion`, `ubicacion`, `tipo`, `limite_postulantes`, `created`, `updated`) VALUES
(37, 0, 'cuartelero', 'cuidar de noche', '2024-04-25', '2024-04-30', 5000.00, 'arequipa', 'presencial', 5, '2024-04-29 03:52:46', '2024-04-29 03:52:46'),
(38, 0, 'cuartelero', 'cuidar de noche', '2024-04-25', '2024-04-30', 5000.00, 'arequipa', 'presencial', 5, '2024-04-29 03:52:46', '2024-04-29 03:52:46'),
(39, 24, 'periodista', 'cuidar de noche', '2024-05-09', '2024-05-10', 5000.00, 'arequipa', 'presencial', 0, '2024-05-03 01:55:02', '2024-05-04 02:22:49'),
(40, 0, 'nuevo prueba', 'cuidar de noche', '2024-05-01', '2024-05-04', 5000.00, 'arequipa', 'presencial', 0, '2024-05-04 02:29:15', '2024-05-04 02:29:45'),
(41, 0, 'nuevo prueba5', 'en quinta restobar', '2024-05-01', '2024-05-02', 5000.00, 'arequipa', 'presencial', 0, '2024-05-04 02:32:52', '2024-05-04 02:32:52'),
(42, 25, 'prueba cv', 'cuidar de noche', '2024-05-01', '2024-05-04', 5000.00, 'arequipa', 'presencial', 1, '2024-05-04 03:09:42', '2024-05-04 03:09:50'),
(43, 25, 'prueba subir cv', 'cuidar de noche', '2024-05-06', '2024-05-08', 2000.00, 'arequipa', 'presencial', 14, '2024-05-07 02:23:38', '2024-05-07 02:40:48'),
(44, 25, 'chuño', 'cuidar de noche', '2024-05-14', '2024-05-16', 5000.00, 'arequipa', 'presencial', 3, '2024-05-15 03:13:32', '2024-05-15 03:22:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulaciones`
--

CREATE TABLE `postulaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_oferta` int(11) DEFAULT NULL,
  `fecha_hora_postulacion` datetime DEFAULT NULL,
  `estado_actual` enum('abierto','cerrado') DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `postulaciones`
--

INSERT INTO `postulaciones` (`id`, `id_usuario`, `id_oferta`, `fecha_hora_postulacion`, `estado_actual`, `created`, `updated`) VALUES
(2, 49, 39, '2024-05-02 20:59:02', 'abierto', '2024-05-03 01:59:02', '2024-05-03 01:59:02'),
(3, 49, 39, '2024-05-03 21:22:32', 'abierto', '2024-05-04 02:22:32', '2024-05-04 02:22:32'),
(4, 49, 39, '2024-05-03 21:22:42', 'abierto', '2024-05-04 02:22:42', '2024-05-04 02:22:42'),
(5, 49, 39, '2024-05-03 21:22:44', 'abierto', '2024-05-04 02:22:44', '2024-05-04 02:22:44'),
(6, 49, 39, '2024-05-03 21:22:48', 'abierto', '2024-05-04 02:22:48', '2024-05-04 02:22:48'),
(7, 49, 39, '2024-05-03 21:22:49', 'abierto', '2024-05-04 02:22:49', '2024-05-04 02:22:49'),
(8, 53, 40, '2024-05-03 21:29:31', 'abierto', '2024-05-04 02:29:31', '2024-05-04 02:29:31'),
(9, 53, 40, '2024-05-03 21:29:33', 'abierto', '2024-05-04 02:29:33', '2024-05-04 02:29:33'),
(10, 53, 40, '2024-05-03 21:29:38', 'abierto', '2024-05-04 02:29:38', '2024-05-04 02:29:38'),
(11, 53, 40, '2024-05-03 21:29:40', 'abierto', '2024-05-04 02:29:40', '2024-05-04 02:29:40'),
(12, 53, 40, '2024-05-03 21:29:45', 'abierto', '2024-05-04 02:29:45', '2024-05-04 02:29:45'),
(13, 53, 42, '2024-05-03 22:09:50', 'abierto', '2024-05-04 03:09:50', '2024-05-04 03:09:50'),
(14, 53, 43, '2024-05-06 21:30:57', 'abierto', '2024-05-07 02:30:57', '2024-05-07 02:30:57'),
(15, 53, 43, '2024-05-06 21:31:05', 'abierto', '2024-05-07 02:31:05', '2024-05-07 02:31:05'),
(16, 53, 43, '2024-05-06 21:40:48', 'abierto', '2024-05-07 02:40:48', '2024-05-07 02:40:48'),
(17, 53, 44, '2024-05-14 22:22:01', 'abierto', '2024-05-15 03:22:01', '2024-05-15 03:22:01'),
(18, 53, 44, '2024-05-14 22:22:06', 'abierto', '2024-05-15 03:22:06', '2024-05-15 03:22:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `dni` varchar(15) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `contrasenia` varchar(50) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `ruta_imagen` varchar(255) DEFAULT NULL,
  `ruta_cv` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado_asignacion` tinyint(1) NOT NULL DEFAULT 0,
  `id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `dni`, `direccion`, `telefono`, `usuario`, `contrasenia`, `id_rol`, `ruta_imagen`, `ruta_cv`, `created`, `updated`, `estado_asignacion`, `id_empresa`) VALUES
(10, 'Administrador', 'admin', '2341234', '', '998712341', 'admin', 'admin', 1, '../images/imagen_663588c32b0ef_descarga.jpg', NULL, '2024-04-12 01:28:29', '2024-05-04 01:00:51', 0, NULL),
(48, 'gustavo', 'salluca', '541212', 'floral', '975485125', 'gustavo', '123', 2, NULL, NULL, '2024-04-26 02:04:51', '2024-04-26 02:05:34', 1, 24),
(49, 'pedro', 'pascal', '541212', 'floral', '9554121', 'pedro', '123', 3, NULL, NULL, '2024-04-26 02:14:38', '2024-04-28 18:44:19', 0, NULL),
(52, 'Raul', 'Salluca', '541212', 'floral', '9554121', 'raul', '123', 2, '../images/imagen_662f0e300d954_descarga.jpg', NULL, '2024-04-26 04:46:07', '2024-04-29 03:04:16', 1, 25),
(53, 'pedro', 'pascal', '541212', 'floral', '9554121', 'go', '123', 3, '../images/imagen_6635a32a2a00e_descarga.jpg', '../document/st_electricidad.csv', '2024-04-29 03:51:51', '2024-05-07 02:40:45', 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `oferta_laboral`
--
ALTER TABLE `oferta_laboral`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `oferta_laboral`
--
ALTER TABLE `oferta_laboral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
