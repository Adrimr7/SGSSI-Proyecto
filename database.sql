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
    dni VARCHAR(9) PRIMARY KEY CHECK (Dni REGEXP '^[0-9]{8}[A-Z]$'),
    nombre VARCHAR(20),
    apellidos  VARCHAR(20),
    telefono VARCHAR(9) CHECK (telefono REGEXP '^[0-9]{9}$'),
    email VARCHAR(50) CHECK(email LIKE '%@%.%'),
    contraseña longtext,
    nacimiento DATE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla `pais`

CREATE TABLE ciudad (
    nombre VARCHAR(30) PRIMARY KEY
);

-- Estructura de tabla para la tabla `vuelo`

CREATE TABLE vuelo (
    callsign VARCHAR(10) PRIMARY KEY,
    fecha DATE,
    numero_pasajeros INT,
    ciudad_salida VARCHAR(30),
    ciudad_llegada VARCHAR(30),
    FOREIGN KEY (ciudad_salida) REFERENCES ciudad(nombre),
    FOREIGN KEY (ciudad_llegada) REFERENCES ciudad(nombre)
);-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO usuarios (Dni, nombre, apellidos, telefono, email, nacimiento) VALUES
('14678903L', 'Mikel', 'apell', '123456789', 'mikel@example.com', '2000-01-01'),
('15464903K', 'Aitor', 'apellido', '987654321', 'aitor@example.com', '1995-05-05');


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
