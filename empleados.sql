-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2019 at 04:58 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzanova`
--

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(10) UNSIGNED NOT NULL,
  `nombre_empleado` varchar(20) NOT NULL,
  `apellido_empleado` varchar(20) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `genero` enum('M','F') DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nacionalidad` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `id_Cargo` int(10) UNSIGNED DEFAULT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre_empleado`, `apellido_empleado`, `dui`, `direccion`, `telefono`, `genero`, `fecha_nacimiento`, `nacionalidad`, `correo`, `id_Cargo`, `id_usuario`) VALUES
(1, 'Ricky', 'Balistreri', '46795687-8', 'Apopa', 78745896, 'M', '1996-07-17', 'El Salvador', 'rick@mail.com', 1, 1),
(2, 'Conrad', 'Legros', '64795687-9', 'Santa Ana', 78745896, 'M', '1994-10-15', 'El Salvador', 'Conrad@mail.com', 2, 2),
(3, 'Assunta', 'Pouros', '68795687-8', 'Sonsonate', 78745896, 'F', '1993-09-01', 'El Salvador', 'Assun@mail.com', 1, 3),
(4, 'Lexus', 'Beatty', '94795687-8', 'Libertad', 78745896, 'M', '1987-04-26', 'El Salvador', 'lexs@mail.com', 1, 4),
(5, 'Elyse', 'Bashirian', '12795687-9', 'Soyapango', 78745896, 'F', '1996-07-19', 'El Salvador', 'Eys@mail.com', 1, 5),
(6, 'Marlin', 'Spinka', '13795687-8', 'San Salvador', 78745896, 'F', '1986-08-12', 'El Salvador', 'Marlin@mail.com', 1, 6),
(7, 'Ray', 'Wunsch', '44795687-9', 'Cabañas', 78745896, 'M', '1999-02-23', 'El Salvador', 'Ray@mail.com', 1, 7),
(8, 'Sebastian', 'Morar', '98795687-9', 'La Union', 78745896, 'M', '1991-09-07', 'El Salvador', 'Sebas@mail.com', 1, 8),
(9, 'Fatima', 'Windler', '35795687-8', 'Santa Tecla', 78745896, 'F', '1992-06-24', 'El Salvador', 'Fatwin@mail.com', 1, 9),
(10, 'Florine', 'Mills', '49795687-9', 'Ilobasco', 78745896, 'F', '1991-02-26', 'El Salvador', 'Florine@mail.com', 1, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_Cargo` (`id_Cargo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_Cargo`) REFERENCES `cargo` (`id_Cargo`),
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
