-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-07-2025 a las 01:24:44
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario_sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `access_history`
--

DROP TABLE IF EXISTS `access_history`;
CREATE TABLE IF NOT EXISTS `access_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `access_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `access_history`
--

INSERT INTO `access_history` (`id`, `user_id`, `access_time`) VALUES
(1, 2, '2025-07-14 17:07:18'),
(2, 2, '2025-07-14 17:08:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

DROP TABLE IF EXISTS `equipos`;
CREATE TABLE IF NOT EXISTS `equipos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `cantidad` int NOT NULL DEFAULT '1',
  `precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `nombre`, `tipo`, `cantidad`, `precio`, `user_id`) VALUES
(1, 'Hp 5320', 'Computadora', 1, 450.00, 2),
(2, 'Iphone 16 pro', 'Teléfono', 1, 650.00, 2),
(3, 'Silla Gamer', 'Otro', 2, 150.00, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `excerpt` text NOT NULL,
  `content` longtext,
  `author` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`id`, `title`, `excerpt`, `content`, `author`, `category`, `image_url`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'La Importancia del Control de Inventario de Hardware en 2024', 'Descubre cómo un sistema de inventario eficiente puede reducir costos operativos hasta en un 30% y mejorar la productividad empresarial.', NULL, 'María González', 'Hardware', 'https://images.pexels.com/photos/159711/network-cable-ethernet-computer-159711.jpeg?auto=compress&cs=tinysrgb&w=600', '2025-07-14 20:40:11', '2025-07-14 20:40:11', '2025-07-14 20:40:11'),
(2, 'Gestión de Licencias de Software: Evita Multas y Optimiza Costos', 'Las empresas pueden ahorrar hasta 40% en costos de software con una gestión adecuada de licencias y un inventario actualizado.', NULL, 'Carlos Ruiz', 'Software', 'https://images.pexels.com/photos/574071/pexels-photo-574071.jpeg?auto=compress&cs=tinysrgb&w=600', '2025-07-14 20:40:11', '2025-07-14 20:40:11', '2025-07-14 20:40:11'),
(3, 'Tendencias en Sistemas de Inventario: IA y Automatización', 'La inteligencia artificial y la automatización están revolucionando la gestión de inventarios, aumentando la precisión en un 95%.', NULL, 'Ana Martínez', 'Tecnología', 'https://images.pexels.com/photos/3861969/pexels-photo-3861969.jpeg?auto=compress&cs=tinysrgb&w=600', '2025-07-14 20:40:11', '2025-07-14 20:40:11', '2025-07-14 20:40:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pregunta_id` int NOT NULL DEFAULT '1',
  `respuesta_seguridad` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `company`, `password`, `created_at`, `updated_at`, `pregunta_id`, `respuesta_seguridad`) VALUES
(1, 'Administrador', 'admin@inventech.com', 'InvenTech', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-07-14 20:40:11', '2025-07-14 20:40:11', 1, ''),
(2, 'Isalleth Sánchez', 'nachej69@gmail.com', 'uwu', '$2y$10$QK8oxBoBNb1JY.uLS9t4zO9hV8plpxbPmv/mbjygFm.ylyI9eygGK', '2025-07-14 20:43:57', '2025-07-14 23:37:11', 1, '$2y$10$blogxpx1bqBm4MPwc9LMve6AOQlb5X5GWKVyFCfRwCrc76HsMWmNO');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--Alter Table para el Rol y ver si el usuario esta activo o no
ALTER TABLE `users`
ADD `role` VARCHAR(50) NOT NULL DEFAULT 'collaborator' COMMENT 'Rol del usuario (admin, collaborator)' AFTER `company`,
ADD `activo` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Usuario activo (1) o inactivo (0)' AFTER `respuesta_seguridad`;