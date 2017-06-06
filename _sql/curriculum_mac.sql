-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-06-2017 a las 18:06:05
-- Versión del servidor: 5.6.34
-- Versión de PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `curriculum`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencias`
--

CREATE TABLE `experiencias` (
  `id_exp` int(11) NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `profesion` varchar(100) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `FK_id_usr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `experiencias`
--

INSERT INTO `experiencias` (`id_exp`, `lugar`, `profesion`, `fecha_ini`, `fecha_fin`, `FK_id_usr`) VALUES
(8, 'poll', 'de la baca', '2017-06-09', '2017-06-03', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formacion`
--

CREATE TABLE `formacion` (
  `id_exp` int(11) NOT NULL,
  `fecha_ini` varchar(50) NOT NULL,
  `fecha_fin` varchar(50) NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `tipo_for` varchar(100) NOT NULL,
  `FK_id_usr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `formacion`
--

INSERT INTO `formacion` (`id_exp`, `fecha_ini`, `fecha_fin`, `lugar`, `tipo_for`, `FK_id_usr`) VALUES
(2, '05/28/2017', '05/31/2017', 'IES Son Ferrer', 'DAW', 3),
(4, '2017-05-28', '2017-05-31', 'IES Son Ferrer', 'Medico', 3),
(5, 'asdf', 'asdf', 'Pepe', 'caca', 2),
(6, '23/2/23', '34/24/121', 'ies la salle', 'la calle de la vida', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `FK_id_usr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesion`
--

CREATE TABLE `profesion` (
  `id_prof` int(11) NOT NULL,
  `nombre_profesion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesion`
--

INSERT INTO `profesion` (`id_prof`, `nombre_profesion`) VALUES
(0, 'Ninguna'),
(1, 'Informatico'),
(2, 'Administrativo'),
(3, 'Profesor'),
(4, 'Entrenador Personal'),
(7, 'Cantante'),
(8, 'Medico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr`
--

CREATE TABLE `usr` (
  `id_usr` int(11) NOT NULL,
  `mail` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `FK_id_prof` int(11) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `pic` varchar(150) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'default.jpg',
  `presentacion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usr`
--

INSERT INTO `usr` (`id_usr`, `mail`, `pass`, `name`, `surname`, `FK_id_prof`, `admin`, `pic`, `presentacion`) VALUES
(2, 'lmgspain@hotmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'Luis', 'Martinez', 1, 0, 'default.jpg', ''),
(3, 'cristiansmx2a@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'Cristian', 'Diaz', 1, 0, 'default.jpg', ''),
(4, 'rosamari@hotmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'Rouse', 'Mari', 2, 0, 'default.jpg', ''),
(6, 'admin@admin.com', '1a1dc91c907325c69271ddf0c944bc72', 'Admin', 'Administrador', 0, 1, 'default.jpg', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `experiencias`
--
ALTER TABLE `experiencias`
  ADD PRIMARY KEY (`id_exp`),
  ADD KEY `id_usr` (`FK_id_usr`);

--
-- Indices de la tabla `formacion`
--
ALTER TABLE `formacion`
  ADD PRIMARY KEY (`id_exp`),
  ADD KEY `id_usr` (`FK_id_usr`);

--
-- Indices de la tabla `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usr` (`FK_id_usr`);

--
-- Indices de la tabla `profesion`
--
ALTER TABLE `profesion`
  ADD PRIMARY KEY (`id_prof`);

--
-- Indices de la tabla `usr`
--
ALTER TABLE `usr`
  ADD PRIMARY KEY (`id_usr`),
  ADD KEY `id_prof` (`FK_id_prof`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `experiencias`
--
ALTER TABLE `experiencias`
  MODIFY `id_exp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `formacion`
--
ALTER TABLE `formacion`
  MODIFY `id_exp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `profesion`
--
ALTER TABLE `profesion`
  MODIFY `id_prof` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `usr`
--
ALTER TABLE `usr`
  MODIFY `id_usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `experiencias`
--
ALTER TABLE `experiencias`
  ADD CONSTRAINT `experiencias_ibfk_1` FOREIGN KEY (`FK_id_usr`) REFERENCES `usr` (`id_usr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `formacion`
--
ALTER TABLE `formacion`
  ADD CONSTRAINT `formacion_ibfk_1` FOREIGN KEY (`FK_id_usr`) REFERENCES `usr` (`id_usr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mail`
--
ALTER TABLE `mail`
  ADD CONSTRAINT `id_usr` FOREIGN KEY (`FK_id_usr`) REFERENCES `usr` (`id_usr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usr`
--
ALTER TABLE `usr`
  ADD CONSTRAINT `usr_ibfk_1` FOREIGN KEY (`FK_id_prof`) REFERENCES `profesion` (`id_prof`) ON UPDATE CASCADE;
