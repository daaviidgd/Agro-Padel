# Agro-Padel
#Uso de la página:
Sistema operativo: indiferente, el desarrollo se hizo por completo en Windows.
Navegador: preferible Chrome.
Librerias: estan todas las librerias necesarias integradas en el proyecto, algunas necesitan conexión a internet.

Primero necesitamos instalar XAMPP desde el sitio web oficial.
Segundo iniciar los servidor de XAMPP y activar tambien el MySQL
Tercero copiar el código de abajo
Cuarto descargarte la carpeta del proyecto y pegarla en C:\xampp\htdocs\xampp 
Quinto acceder a la pagina con [localhost](http://localhost/xampp/)
#Codigo para levantar la base de datos ya sea en local en XAMPP/MySQL o en un host en su sitio respectivo 


-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2023 a las 10:03:11
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agropadel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `pista` varchar(20) DEFAULT NULL,
  `hora` varchar(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `idContacto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `pista`, `hora`, `fecha`, `idContacto`) VALUES
(1, 'Pista 2', '9', '2023-06-01', 10),
(2, 'Pista 2', '10', '2023-06-01', 10),
(3, 'Pista 2', '8', '2023-06-02', 10),
(4, 'Pista 2', '8', '2023-06-01', 10),
(5, 'Pista 1', '8', '2023-06-02', 10),
(6, 'Pista 1', '8', '2023-06-02', 10),
(7, 'Pista 3', '8', '2023-06-02', 10),
(8, 'Pista 3', '8', '2023-06-03', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `pass`, `email`) VALUES
(10, 'david', '$2y$10$U7EKsu0.dLA1Hvmw/Ont5OGtWtjD96IuyEPgX66bXEgC.Q1et0cxi', 'david@gmail.com'),
(11, 'monica', '$2y$10$1fh2jKnzQvAtAHVjrhcuZe5rXD82RLBdSmW3f9eLuAip.nrtBsIkO', 'moni@gmail.com'),
(12, 'dani', '$2y$10$vyNlDNHXzmkvu6kGFidGfes4etiN4/KZkchOyN4rN3UyilWPDuNbm', 'dani@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idContacto` (`idContacto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idContacto`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

#################################################################################################################



