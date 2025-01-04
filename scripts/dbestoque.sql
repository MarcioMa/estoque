-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para dbestoque
CREATE DATABASE IF NOT EXISTS `dbestoque` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dbestoque`;

-- Copiando estrutura para tabela dbestoque.produto
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` enum('Ativo','Inativo') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Ativo',
  `categoria` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `situacao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `patrimonio` varchar(50) NOT NULL,
  `data_entrada` date NOT NULL,
  `data_garantia` date DEFAULT NULL,
  `espec_tecnicas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela dbestoque.produto: ~11 rows (aproximadamente)
DELETE FROM `produto`;
INSERT INTO `produto` (`id`, `status`, `categoria`, `marca`, `situacao`, `modelo`, `patrimonio`, `data_entrada`, `data_garantia`, `espec_tecnicas`, `updated_at`) VALUES
	(1, 'Ativo', 'Computador', 'Lenovo', 'Novo', 'N/A', 'N/A', '2024-12-23', '2024-12-23', 'N/A', '2025-01-02 22:19:12'),
	(2, 'Inativo', 'Computador', 'Compaq', 'Manutenção', 'Compaq Presario RTX', 'N/A', '2024-12-23', '2024-12-23', 'Intel DUO core SSD-128GB Ram 2GB', '2025-01-02 22:38:05'),
	(3, 'Ativo', 'Notebook', 'Dell', 'Usado', 'Inspiron I15-i120k-a35p', 'I0002', '2024-12-26', '2024-12-31', 'N/A', '2025-01-02 22:35:59'),
	(4, 'Inativo', 'Periférico', 'Outro', 'Novo', 'GT-750', 'N/A', '2024-12-26', '2024-12-26', 'Placa de video GT-750', '2025-01-02 22:19:12'),
	(5, 'Inativo', 'Acessório', 'Multilaser', 'Funciona', 'Projetor - PX300', 'N/A', '2024-12-26', '2024-12-26', 'N/A', '2025-01-02 22:19:12'),
	(6, 'Inativo', 'Notebook', 'Acer', 'Novo', 'AC1540', 'N/A', '2024-12-26', '2024-12-27', 'N/A', '2025-01-02 22:19:12'),
	(7, 'Ativo', 'Periférico', 'Acer', 'Novo', 'Placa Video RTX6090', 'N/A', '2025-01-02', '2030-12-02', '16 GB RAM Cache 5MB GDDR5', '2025-01-02 22:34:00'),
	(8, 'Inativo', 'Acessório', 'Multilaser', 'Novo', 'Projetor XR', 'I2210', '2025-01-03', '2024-12-31', 'Projeto DVI/DVR/USB3', '2025-01-02 23:42:15'),
	(9, 'Inativo', 'Acessório', 'Outro', 'Reparo', 'Camera WebOS', 'N/A', '2025-01-02', '2025-01-02', 'N/A', '2025-01-02 22:44:02'),
	(10, 'Inativo', 'Computador', 'Lenovo', 'Reparo', 'Thinkercenter', 'I007878', '2025-01-01', '2025-01-02', 'I7 9300 HDD2T', '2025-01-02 22:54:28'),
	(11, 'Ativo', 'Periférico', 'Multilaser', 'Usado', 'Passador Manual', 'N/A', '2025-01-02', '2025-01-02', 'N/A', '2025-01-02 23:25:27');

-- Copiando estrutura para tabela dbestoque.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nivel` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela dbestoque.usuarios: ~2 rows (aproximadamente)
DELETE FROM `usuarios`;
INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `email`, `nivel`) VALUES
	(1, 'Administrador', '$2y$10$jcF9G5k82Do0OLN6cjVd9emMZx4cV9gFSpZx4JXZXozhv.rdq9CzS', 'admin@email.com', 0),
	(2, 'user', '$2y$10$xdTtuCGLUiptiu/wKEIBWeomrgecVHQI0TJb.dAKZ5SvjmcSCfy2O', 'user@email.com', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
