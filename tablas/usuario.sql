-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-09-2024 a las 14:49:27
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
-- Base de datos: `aimys`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `NOMBRES` varchar(30) NOT NULL,
  `APELLIDOS` varchar(30) NOT NULL,
  `CONTR` varchar(20) NOT NULL,
  `CORREO` varchar(50) NOT NULL,
  `ESTADO` varchar(20) NOT NULL,
  `CEL` int(20) NOT NULL,
  `DESCRIPCION` varchar(50) NOT NULL,
  `GENERO` varchar(20) NOT NULL,
  `USUARIO_ID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`NOMBRES`, `APELLIDOS`, `CONTR`, `CORREO`, `ESTADO`, `CEL`, `DESCRIPCION`, `GENERO`, `USUARIO_ID`) VALUES
('Yiray', 'Caballero', '1111111111', 'Updalith@gmail.com', 'ACTIVO', 323232, 'USUARIO', 'male', 16),
('Maria Jose', 'Torres', '987654321', 'mjmt1605@gmail.com', 'ACTIVO', 2147483647, 'USUARIO', 'female', 17),
('Saul', 'Torres', 'sssssssssss', 'etssanabria@gmail.com', 'ACTIVO', 322424, 'USUARIO', 'male', 18),
('sa', 'sa', 'dsadsaad', 'saultorresets@gmail.com', 'ACTIVO', 23432423, 'USUARIO', 'male', 19);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`USUARIO_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `USUARIO_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
