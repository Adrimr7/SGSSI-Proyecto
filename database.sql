-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 16-09-2020 a las 16:37:17
-- Versión del servidor: 10.5.5-MariaDB-1:10.5.5+maria~focal
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE usuarios (
  Dni VARCHAR(9) PRIMARY KEY CHECK (Dni REGEXP '^[0-9]{8}[A-Z]$'),
    nombre VARCHAR(20),
    primer_apellido VARCHAR(20),
    segundo_apellido VARCHAR(20),
    telefono VARCHAR(9) CHECK (telefono REGEXP '^[0-9]{9}$')
    email VARCHAR(50) CHECK(email LIKE '%@%.%'),
    nacimiento DATE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla `pais`
CREATE TABLE pais (
    nombre VARCHAR(30) PRIMARY KEY
);

--Estructura de tabla para la tabla `vuelo`
CREATE TABLE vuelo (
    callsign VARCHAR(10) PRIMARY KEY,
    fecha DATE,
    numero_pasajeros INT,
    pais_salida VARCHAR(30),
    pais_llegada VARCHAR(30),
    FOREIGN KEY (pais_salida) REFERENCES pais(nombre),
    FOREIGN KEY (pais_llegada) REFERENCES pais(nombre)
);
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO usuario (Dni, nombre) VALUES
('14678903L', 'Mikel'),
('15464903K', 'Aitor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
