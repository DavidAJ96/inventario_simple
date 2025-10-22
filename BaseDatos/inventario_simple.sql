-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para simple_stock
CREATE DATABASE IF NOT EXISTS `simple_stock` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `simple_stock`;

-- Volcando estructura para tabla simple_stock.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(255) NOT NULL,
  `descripcion_categoria` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla simple_stock.compras
CREATE TABLE IF NOT EXISTS `compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `cuit_proveedor` varchar(13) NOT NULL DEFAULT '',
  `tipo_comprobante` varchar(20) NOT NULL,
  `nro_comprobante` varchar(50) NOT NULL,
  `total` decimal(12,2) DEFAULT 0.00,
  `observaciones` text DEFAULT NULL,
  `estado` enum('PENDIENTE','PAGADA','ANULADA') DEFAULT 'PENDIENTE',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_compra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla simple_stock.detalle_compra
CREATE TABLE IF NOT EXISTS `detalle_compra` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `importe` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) GENERATED ALWAYS AS (`cantidad` * `importe`) STORED,
  PRIMARY KEY (`id_detalle`),
  KEY `fk_detalle_compra` (`id_compra`),
  KEY `fk_detalle_articulo` (`id_producto`),
  CONSTRAINT `fk_detalle_articulo` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  CONSTRAINT `fk_detalle_compra` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compra`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla simple_stock.detalle_documento
CREATE TABLE IF NOT EXISTS `detalle_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_documento` int(11) NOT NULL,
  `nro_item` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `precio_unitario` decimal(12,2) DEFAULT 0.00,
  `subtotal` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_documento` (`id_documento`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `detalle_documento_ibfk_1` FOREIGN KEY (`id_documento`) REFERENCES `documentos` (`ID`),
  CONSTRAINT `detalle_documento_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla simple_stock.documentos
CREATE TABLE IF NOT EXISTS `documentos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tip_documento` varchar(3) DEFAULT NULL,
  `nro_documento` varchar(10) DEFAULT NULL,
  `id_sector` int(11) DEFAULT NULL,
  `fecha_documento` date DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `cuit_destinatario` varchar(13) DEFAULT NULL,
  `id_documento_cancelado` int(11) DEFAULT NULL,
  `can_items` int(11) DEFAULT NULL,
  `total` decimal(20,6) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla simple_stock.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` char(20) NOT NULL,
  `nombre_producto` char(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `fecha_venc` date DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  UNIQUE KEY `codigo_producto` (`codigo_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla simple_stock.proveedor
CREATE TABLE IF NOT EXISTS `proveedor` (
  `cuit` varchar(13) NOT NULL,
  `razon_social` varchar(60) NOT NULL,
  `domicilio` varchar(100) DEFAULT NULL,
  `localidad` varchar(30) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cuit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla simple_stock.sectores
CREATE TABLE IF NOT EXISTS `sectores` (
  `id_sector` int(11) NOT NULL AUTO_INCREMENT,
  `nom_sector` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sector`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla simple_stock.stock
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) DEFAULT NULL,
  `id_sector` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `stock_min` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_stock_productos` (`id_producto`),
  KEY `FK_stock_sectores` (`id_sector`),
  CONSTRAINT `FK_stock_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_stock_sectores` FOREIGN KEY (`id_sector`) REFERENCES `sectores` (`id_sector`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla simple_stock.tipo_documento
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `tipo_documento` varchar(3) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `mar_stock` enum('S','R','N') DEFAULT NULL,
  `usa_importes` varchar(1) DEFAULT NULL,
  `nro_documento` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
