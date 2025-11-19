-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: ProyectoFinal-mysql
-- Tiempo de generación: 07-11-2025 a las 17:03:51
-- Versión del servidor: 8.4.5
-- Versión de PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `taller`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int UNSIGNED NOT NULL COMMENT 'Identificador único del cliente',
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nombre del cliente',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Correo electrónico único del cliente',
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contraseña hasheada del cliente',
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Número de teléfono del cliente',
  `direccion` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Dirección del cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de clientes registrados del taller BMW';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int UNSIGNED NOT NULL COMMENT 'Identificador único de la factura',
  `id_cliente` int UNSIGNED NOT NULL COMMENT 'Cliente que recibe la factura',
  `fecha_emision` date NOT NULL COMMENT 'Fecha de emisión de la factura',
  `total` decimal(10,2) NOT NULL COMMENT 'Importe total de la factura',
  `estado` enum('pendiente','pagada','cancelada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendiente' COMMENT 'Estado de la factura',
  `metodo_pago` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Método de pago usado',
  `comentarios` text COLLATE utf8mb4_unicode_ci COMMENT 'Observaciones o detalles adicionales'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Facturas emitidas a clientes';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_reparacion`
--

CREATE TABLE `factura_reparacion` (
  `id_factura_reparacion` int UNSIGNED NOT NULL COMMENT 'Identificador único de la relación',
  `id_factura` int UNSIGNED NOT NULL COMMENT 'Factura asociada',
  `id_reparacion` int UNSIGNED NOT NULL COMMENT 'Reparación incluida en la factura'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Relación entre facturas y reparaciones incluidas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id_pais` smallint UNSIGNED NOT NULL  COMMENT 'identificador único del país',
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'nombre del país'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de países utilizados por los usuarios del taller';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piezas`
--

CREATE TABLE `piezas` (
  `id_pieza` int UNSIGNED NOT NULL COMMENT 'Identificador único de la pieza',
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nombre o descripción de la pieza',
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Código interno o del fabricante',
  `marca` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BMW' COMMENT 'Marca o fabricante de la pieza',
  `precio` decimal(10,2) NOT NULL COMMENT 'Precio de la pieza',
  `stock` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Cantidad disponible en inventario',
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Catálogo general de piezas BMW del taller';

--
-- Volcado de datos para la tabla `piezas`
--

INSERT INTO `piezas` (`id_pieza`, `nombre`, `codigo`, `marca`, `precio`, `stock`, `fecha_creacion`) VALUES
(1, 'Filtro de aceite', 'FO-BMW-001', 'BMW', 25.50, 15, '2025-07-18 08:56:21'),
(2, 'Pastillas de freno delanteras', 'PF-BMW-002', 'BMW', 75.00, 10, '2025-07-18 08:56:21'),
(3, 'Batería 12V 70Ah', 'BAT-BMW-003', 'BMW', 120.00, 5, '2025-07-18 08:56:21'),
(4, 'Aceite sintético 5W30 4L', 'ACE-BMW-004', 'BMW', 40.00, 20, '2025-07-18 08:56:21'),
(5, 'Filtro de aire', 'FA-BMW-005', 'BMW', 30.00, 12, '2025-07-18 08:56:21'),
(6, 'Correa de distribución', 'CD-BMW-006', 'BMW', 200.00, 7, '2025-07-18 08:56:21'),
(7, 'Amortiguador delantero', 'AM-BMW-007', 'BMW', 150.00, 6, '2025-07-18 08:56:21'),
(8, 'Bujías de encendido', 'BUJ-BMW-008', 'BMW', 18.00, 30, '2025-07-18 08:56:21'),
(9, 'Líquido de frenos', 'LF-BMW-009', 'BMW', 12.00, 25, '2025-07-18 08:56:21'),
(10, 'Filtro de combustible', 'FF-BMW-010', 'BMW', 45.00, 10, '2025-07-18 08:56:21'),
(11, 'Termostato', 'TER-BMW-011', 'BMW', 60.00, 8, '2025-07-18 08:56:21'),
(12, 'Bombilla LED faro delantero', 'BLF-BMW-012', 'BMW', 35.00, 20, '2025-07-18 08:56:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparaciones`
--

CREATE TABLE `reparaciones` (
  `id_reparacion` int UNSIGNED NOT NULL COMMENT 'Identificador único de la reparación',
  `id_vehiculo` int UNSIGNED NOT NULL COMMENT 'Vehículo al que se le realiza la reparación',
  `id_usuario` int UNSIGNED NOT NULL COMMENT 'Empleado (usuario del taller) que realiza la reparación',
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descripción detallada de la reparación realizada',
  `fecha_inicio` datetime NOT NULL COMMENT 'Fecha y hora de inicio de la reparación',
  `fecha_fin` datetime DEFAULT NULL COMMENT 'Fecha y hora de finalización de la reparación (si ha finalizado)',
  `coste` decimal(10,2) DEFAULT NULL COMMENT 'Coste estimado o real de la reparación'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de reparaciones realizadas a los vehículos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparacion_pieza`
--

CREATE TABLE `reparacion_pieza` (
  `id_reparacion_pieza` int UNSIGNED NOT NULL COMMENT 'Identificador único del registro',
  `id_reparacion` int UNSIGNED NOT NULL COMMENT 'Reparación a la que pertenece esta pieza',
  `id_pieza` int UNSIGNED NOT NULL COMMENT 'Pieza utilizada en la reparación',
  `cantidad` int UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Cantidad de piezas usadas',
  `precio_pieza_reparacion` decimal(10,2) NOT NULL COMMENT 'Precio de la pieza en esta reparación'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Relación entre reparaciones y piezas usadas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int UNSIGNED NOT NULL COMMENT 'Identificador único de la reserva',
  `id_cliente` int UNSIGNED NOT NULL COMMENT 'Cliente que realiza la reserva',
  `id_vehiculo` int UNSIGNED NOT NULL COMMENT 'Vehículo del cliente para la reserva',
  `fecha_reserva` date NOT NULL COMMENT 'Fecha solicitada para la reserva',
  `hora_reserva` time NOT NULL COMMENT 'Hora solicitada para la reserva',
  `estado` enum('pendiente','confirmada','rechazada','no_asistida','finalizada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendiente' COMMENT 'Estado actual de la reserva',
  `creacion_reserva` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se registró la reserva'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de reservas realizadas por los clientes del taller';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` tinyint UNSIGNED NOT NULL COMMENT 'identificador único del rol',
  `nombre_rol` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nombre del rol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de roles asignables a los usuarios del taller ';

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'gerente'),
(3, 'mecanico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_taller`
--

CREATE TABLE `usuario_taller` (
  `id_usuario` int UNSIGNED NOT NULL COMMENT 'Identificador de usuario único',
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nombre del usuario',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'correo electrónico único del usuario',
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'contraseña hasheada del usuario',
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'numero de teléfono',
  `id_rol` tinyint UNSIGNED NOT NULL COMMENT 'clave foranea que apunta a la tabla roles',
  `id_pais` smallint UNSIGNED NOT NULL COMMENT 'clave foranea que apunta a tabla paises',
  `activo` tinyint UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = activo, 0 = baja'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de que contiene a los usuarios/empleados del taller';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id_vehiculo` int UNSIGNED NOT NULL COMMENT 'Identificador único del vehículo',
  `id_cliente` int UNSIGNED NOT NULL COMMENT 'Cliente propietario del vehículo',
  `marca` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Marca del vehículo',
  `modelo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Modelo del vehículo',
  `matricula` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Matrícula del vehículo',
  `anyo` year NOT NULL COMMENT 'Año de matriculación',
  `estado` enum('pendiente','finalizado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendiente' COMMENT 'Estado actual del vehículo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de vehículos de los clientes del taller';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `fk_factura_cliente` (`id_cliente`);

--
-- Indices de la tabla `factura_reparacion`
--
ALTER TABLE `factura_reparacion`
  ADD PRIMARY KEY (`id_factura_reparacion`),
  ADD KEY `fk_fr_factura` (`id_factura`),
  ADD KEY `fk_fr_reparacion` (`id_reparacion`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY id_pais SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  ADD PRIMARY KEY (`id_pais`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `piezas`
--
ALTER TABLE `piezas`
  ADD PRIMARY KEY (`id_pieza`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD PRIMARY KEY (`id_reparacion`),
  ADD KEY `fk_reparacion_vehiculo` (`id_vehiculo`),
  ADD KEY `fk_reparacion_usuario` (`id_usuario`);

--
-- Indices de la tabla `reparacion_pieza`
--
ALTER TABLE `reparacion_pieza`
  ADD PRIMARY KEY (`id_reparacion_pieza`),
  ADD KEY `fk_rp_reparacion` (`id_reparacion`),
  ADD KEY `fk_rp_pieza` (`id_pieza`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `fk_reserva_cliente` (`id_cliente`),
  ADD KEY `fk_reserva_vehiculo` (`id_vehiculo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `usuario_taller`
--
ALTER TABLE `usuario_taller`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuario_rol` (`id_rol`),
  ADD KEY `fk_usuario_pais` (`id_pais`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id_vehiculo`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD KEY `fk_vehiculo_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único del cliente';

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de la factura';

--
-- AUTO_INCREMENT de la tabla `factura_reparacion`
--
ALTER TABLE `factura_reparacion`
  MODIFY `id_factura_reparacion` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de la relación';

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id_pais` smallint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'identificador único del país';

--
-- AUTO_INCREMENT de la tabla `piezas`
--
ALTER TABLE `piezas`
  MODIFY `id_pieza` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de la pieza', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  MODIFY `id_reparacion` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de la reparación';

--
-- AUTO_INCREMENT de la tabla `reparacion_pieza`
--
ALTER TABLE `reparacion_pieza`
  MODIFY `id_reparacion_pieza` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único del registro';

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de la reserva';

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` tinyint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'identificador único del rol', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario_taller`
--
ALTER TABLE `usuario_taller`
  MODIFY `id_usuario` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de usuario único';

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id_vehiculo` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único del vehículo';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_factura_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura_reparacion`
--
ALTER TABLE `factura_reparacion`
  ADD CONSTRAINT `fk_fr_factura` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_fr_reparacion` FOREIGN KEY (`id_reparacion`) REFERENCES `reparaciones` (`id_reparacion`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD CONSTRAINT `fk_reparacion_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario_taller` (`id_usuario`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reparacion_vehiculo` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id_vehiculo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reparacion_pieza`
--
ALTER TABLE `reparacion_pieza`
  ADD CONSTRAINT `fk_rp_pieza` FOREIGN KEY (`id_pieza`) REFERENCES `piezas` (`id_pieza`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rp_reparacion` FOREIGN KEY (`id_reparacion`) REFERENCES `reparaciones` (`id_reparacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_reserva_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reserva_vehiculo` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id_vehiculo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_taller`
--
ALTER TABLE `usuario_taller`
  ADD CONSTRAINT `fk_usuario_pais` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `fk_vehiculo_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
