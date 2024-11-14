-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 09:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cuentas`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--
-- Creation: Nov 07, 2024 at 08:53 PM
-- Last update: Nov 12, 2024 at 06:30 PM
--

CREATE TABLE `cart` (
  `Id_carrito` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
-- Creation: Nov 07, 2024 at 08:51 PM
-- Last update: Nov 12, 2024 at 08:44 PM
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` text NOT NULL,
  `tipo` text NOT NULL,
  `marca` text NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `nombre`, `precio`, `descripcion`, `imagen`, `tipo`, `marca`, `cantidad`) VALUES
(7, 'Computadora', 10111, '', 'uploads/Laptop.png', 'computadora', 'Asus', 2),
(13, 'Iphone 15', 14000, '-Apple iPhone 15 (128 GB) - Negro\r\n-Pantalla Super Retina XDR de 6.1 pulgadas\r\n-Chip A16 Bionic con Neural Engine\r\n-Sistema de cámara dual de 12 MP (ultra gran angular y gran -angular)\r\n-Modo Noche y Deep Fusion\r\n-Face ID para autenticación segura\r\n-Resistencia al agua y al polvo (IP68)\r\n-Carga inalámbrica y MagSafe\r\n-iOS 17', 'uploads/apple1.jpeg', 'celular', 'Apple', 5),
(15, 'Dell', 100000, 'Alo Alo\r\nsol', 'uploads/asus2.jpeg', 'computadora', 'Dell', 232);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Nov 07, 2024 at 08:50 PM
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `name`, `password`) VALUES
(1, 'Fatima Esmeralda', 'esme'),
(2, 'Brandon Andres', '3213');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `fk_carrito_usuario` (`id_usuario`),
  ADD KEY `fk_carrito_producto` (`id_producto`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_carrito_producto` FOREIGN KEY (`id_producto`) REFERENCES `products` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_carrito_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
