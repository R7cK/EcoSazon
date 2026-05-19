-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para ecosazon
CREATE DATABASE IF NOT EXISTS `ecosazon` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ecosazon`;

-- Volcando estructura para tabla ecosazon.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.cache: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ecosazon.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.cache_locks: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ecosazon.cocinas
CREATE TABLE IF NOT EXISTS `cocinas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` enum('activa','inactiva') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activa',
  `zona` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `calificacion` decimal(2,1) NOT NULL DEFAULT '0.0',
  `abierto_24h` tinyint(1) NOT NULL DEFAULT '0',
  `horario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen_principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen_fachada` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cocinas_slug_unique` (`slug`),
  KEY `cocinas_user_id_foreign` (`user_id`),
  CONSTRAINT `cocinas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.cocinas: ~64 rows (aproximadamente)
INSERT INTO `cocinas` (`id`, `user_id`, `nombre`, `slug`, `categoria`, `estatus`, `zona`, `descripcion`, `calificacion`, `abierto_24h`, `horario`, `telefono`, `imagen_principal`, `imagen_fachada`, `created_at`, `updated_at`) VALUES
	(4, NULL, 'Pueblo Maya Fit', 'pueblo-maya-fit', 'Saludable', 'activa', 'Caucel', 'Comida balanceada, ligera y nutritiva sin perder el sabor local.', 4.2, 0, '09:00 - 21:00', '9991112233', 'Imagenes/Yuca4.png', 'Imagenes/Yuca4.png', NULL, NULL),
	(5, NULL, 'El Rincón de Itzimná', 'rincon-itzimna', 'Comida Yucateca', 'activa', 'Itzimná', 'El clásico rincón dominical para disfrutar de la mejor cochinita.', 4.5, 0, '06:00 - 13:00', '9994445566', 'Imagenes/Itzimna.png', 'Imagenes/Itzimna.png', NULL, NULL),
	(6, NULL, 'Fonda Las Margaritas', 'fonda-las-margaritas', 'Comida Casera', 'activa', 'Francisco de Montejo', 'comida casera con un toque especial, ideal para quienes buscan sabores familiares y reconfortantes.', 4.0, 0, '11:00 - 17:00', '9992223344', 'Imagenes/Margaritas.png', 'Imagenes/Margaritas.png', NULL, NULL),
	(7, NULL, 'Mariscos El Faro', 'mariscos-el-faro', 'Mariscos', 'activa', 'Progreso (Norte)', 'comida de mar fresca y deliciosa, con especialidad en ceviches y cocteles, perfecta para los amantes de los sabores del mar.', 4.7, 0, '10:00 - 19:00', '9999998877', 'Imagenes/Faro.png', 'Imagenes/Faro.png', NULL, NULL),
	(8, NULL, 'Eco-Sazón Vegano', 'eco-sazon-vegano', 'Vegana', 'activa', 'García Ginerés', 'Comida vegana con ingredientes locales, ideal para quienes buscan opciones sin carne.', 4.9, 0, '12:00 - 22:00', '9993332211', 'Imagenes/Eco.png', 'Imagenes/Eco.png', NULL, NULL),
	(11, NULL, 'Los Faisanes', 'los-faisanes', 'Comida Yucateca', 'activa', 'Altabrisa', 'Especialistas en queso relleno y sopa de lima.', 4.6, 0, '12:00 - 20:00', '9991000002', 'Imagenes/Cocinas/Yucateca/Faisanes.png', 'Imagenes/Cocinas/Yucateca/Faisanes.png', NULL, NULL),
	(12, NULL, 'Hacienda Mérida', 'hacienda-merida', 'Comida Yucateca', 'activa', 'García Ginerés', 'Platillos yucatecos gourmet en un ambiente colonial.', 4.9, 0, '13:00 - 23:00', '9991000003', 'Imagenes/Cocinas/Yucateca/Hacienda.png', 'Imagenes/Cocinas/Yucateca/Hacienda.png', NULL, NULL),
	(13, NULL, 'El Poc Chuc de la 60', 'el-poc-chuc-60', 'Comida Yucateca', 'activa', 'Centro', 'El mejor poc chuc al carbón del centro histórico.', 4.5, 0, '11:00 - 19:00', '9991000004', 'Imagenes/Cocinas/Yucateca/Pocchuc60.png', 'Imagenes/Cocinas/Yucateca/Pocchuc60.png', NULL, NULL),
	(14, NULL, 'La Chaya Maya', 'la-chaya-maya-norte', 'Comida Yucateca', 'activa', 'San Ramón Norte', 'Tradición culinaria con tortillas hechas a mano.', 4.8, 0, '08:00 - 22:00', '9991000005', 'Imagenes/Cocinas/Yucateca/ChayMay.png', 'Imagenes/Cocinas/Yucateca/ChayMay.png', NULL, NULL),
	(15, NULL, 'Papdzules El Mayab', 'papadzules-el-mayab', 'Comida Yucateca', 'activa', 'Pensiones', 'Receta original de papadzules con pepita fresca.', 4.4, 0, '09:00 - 17:00', '9991000006', 'Imagenes/Cocinas/Yucateca/PapadMay.png', 'Imagenes/Cocinas/Yucateca/PapadMay.png', NULL, NULL),
	(16, NULL, 'Relleno Negro Doña Mary', 'relleno-negro-mary', 'Comida Yucateca', 'activa', 'Chuburná', 'Relleno negro enterrado, preparado a la antigua usanza.', 4.9, 0, '07:00 - 15:00', '9991000007', 'Imagenes/Cocinas/Yucateca/RellnegMary.png', 'Imagenes/Cocinas/Yucateca/RellnegMary.png', NULL, NULL),
	(17, NULL, 'Mukbilpollo Todo el Año', 'mukbilpollo-todo-ano', 'Comida Yucateca', 'activa', 'Francisco de Montejo', 'Disfruta del sabor del pib sin importar la temporada.', 4.3, 0, '10:00 - 18:00', '9991000008', 'Imagenes/Cocinas/Yucateca/Mucbi.png', 'Imagenes/Cocinas/Yucateca/Mucbi.png', NULL, NULL),
	(18, NULL, 'Salbutes Las Américas', 'salbutes-las-americas', 'Antojitos Regionales', 'activa', 'Las Américas', 'Salbutes crujientes con pavo asado y escabeche.', 4.5, 0, '18:00 - 23:30', '9992000001', 'Imagenes/Cocinas/Regional/SalbutAme.png', 'Imagenes/Cocinas/Regional/SalbutAme.png', NULL, NULL),
	(19, NULL, 'Panuchos de la 42', 'panuchos-de-la-42', 'Antojitos Regionales', 'activa', 'Sur', 'Panuchos fritos al momento con frijol refrito casero.', 4.6, 0, '17:00 - 00:00', '9992000002', 'Imagenes/Cocinas/Regional/Pan42.png', 'Imagenes/Cocinas/Regional/Pan42.png', NULL, NULL),
	(20, NULL, 'Polcanes Cholul', 'polcanes-cholul', 'Antojitos Regionales', 'activa', 'Cholul', 'Polcanes rellenos de tok-sel, perfectos para la tarde.', 4.3, 0, '16:00 - 22:00', '9992000003', 'Imagenes/Cocinas/Regional/PolcCholul.png', 'Imagenes/Cocinas/Regional/PolcCholul.png', NULL, NULL),
	(21, NULL, 'El Rey del Kibis', 'reyes-del-kibi', 'Antojitos Regionales', 'activa', 'Progreso', 'Kibis tradicionales y rellenos de queso de bola.', 4.7, 0, '10:00 - 18:00', '9992000004', 'Imagenes/Cocinas/Regional/ReyKibis.png', 'Imagenes/Cocinas/Regional/ReyKibis.png', NULL, NULL),
	(22, NULL, 'Gorditas de la Alemán', 'gorditas-aleman', 'Antojitos Regionales', 'activa', 'Colonia Alemán', 'Gorditas de chicharrón y carne molida al estilo yucateco.', 4.4, 0, '08:00 - 14:00', '9992000005', 'Imagenes/Cocinas/Regional/GorAlem.png', 'Imagenes/Cocinas/Regional/GorAlem.png', NULL, NULL),
	(23, NULL, 'Piedras y Empanadas', 'piedras-y-empanadas', 'Antojitos Regionales', 'activa', 'Pensiones', 'Las mejores piedras de masa crujiente de la ciudad.', 4.2, 0, '17:00 - 23:00', '9992000006', 'Imagenes/Cocinas/Regional/PiedyEmp.png', 'Imagenes/Cocinas/Regional/PiedyEmp.png', NULL, NULL),
	(24, NULL, 'Vaporcitos El Parque', 'vaporcitos-el-parque', 'Antojitos Regionales', 'activa', 'Las Américas', 'Tamales torteados y vaporcitos recién hechos.', 4.8, 0, '07:00 - 12:00', '9992000007', 'Imagenes/Cocinas/Regional/VapElPar.png', 'Imagenes/Cocinas/Regional/VapElPar.png', NULL, NULL),
	(25, NULL, 'Antojitos Los Compadres', 'antojitos-los-compadres', 'Antojitos Regionales', 'activa', 'Juan Pablo II', 'Variedad de caldos y frituras regionales para cenar.', 4.5, 0, '19:00 - 01:00', '9992000008', 'Imagenes/Cocinas/Regional/AntCom.png', 'Imagenes/Cocinas/Regional/AntCom.png', NULL, NULL),
	(26, NULL, 'Sazón de la Abuela', 'sazon-abuela-merida', 'Comida Tradicional', 'activa', 'Centro Histórico', 'Guisos de olla tradicionales con el sabor de antaño.', 4.6, 0, '12:00 - 18:00', '9993000001', 'Imagenes/Cocinas/Tradicional/SazAbuela.png', 'Imagenes/Cocinas/Tradicional/SazAbuela.png', NULL, '2026-05-20 05:16:22'),
	(27, NULL, 'El Metate de Plata', 'metate-de-plata', 'Comida Tradicional', 'activa', 'Santiago', 'Recetas de herencia preparadas en metate y comal.', 4.7, 0, '08:00 - 16:00', '9993000002', 'Imagenes/Cocina36.png', 'Imagenes/Cocina36.png', NULL, NULL),
	(28, NULL, 'Comedor La Esperanza', 'comedor-esperanza', 'Comida Tradicional', 'activa', 'San José Tecoh', 'Comida corrida tradicional, abundante y económica.', 4.1, 0, '11:00 - 17:00', '9993000003', 'Imagenes/Cocinas/Tradicional/ComLaEsp.png', 'Imagenes/Cocinas/Tradicional/ComLaEsp.png', NULL, NULL),
	(29, NULL, 'Fogón Meridano', 'fogon-meridano', 'Comida Tradicional', 'activa', 'Caucel', 'Carnes y guisos preparados a la leña.', 4.5, 0, '13:00 - 21:00', '9993000004', 'Imagenes/Cocina37.png', 'Imagenes/Cocina37.png', NULL, NULL),
	(30, NULL, 'La Cazuela de Barro', 'cazuela-de-barro', 'Comida Tradicional', 'activa', 'Los Héroes', 'Especialistas en moles y pipianes artesanales.', 4.4, 0, '12:00 - 19:00', '9993000005', 'Imagenes/Cocina38.png', 'Imagenes/Cocina38.png', NULL, NULL),
	(31, NULL, 'Guisos de la Casona', 'guisos-casona', 'Comida Tradicional', 'activa', 'Santa Ana', 'Menú diario de platillos típicos mexicanos.', 4.8, 0, '09:00 - 18:00', '9993000006', 'Imagenes/Cocina39.png', 'Imagenes/Cocina39.png', NULL, NULL),
	(32, NULL, 'La Milpa Central', 'milpa-central', 'Comida Tradicional', 'activa', 'Centro', 'Sopa de tortilla, chiles rellenos y más clásicos.', 4.3, 0, '10:00 - 20:00', '9993000007', 'Imagenes/Cocinas/Tradicional/LaMilpCen.png', 'Imagenes/Cocinas/Tradicional/LaMilpCen.png', NULL, NULL),
	(33, NULL, 'El Cántaro', 'el-cantaro-merida', 'Comida Tradicional', 'activa', 'Francisco de Montejo', 'Aguas frescas y platillos servidos en loza de barro.', 4.2, 0, '11:00 - 18:00', '9993000008', 'Imagenes/Cocina40.png', 'Imagenes/Cocina40.png', NULL, NULL),
	(34, NULL, 'Cocina de Barrio', 'cocina-barrio-merida', 'Comida Tradicional', 'activa', 'San Juan', 'El verdadero sabor del almuerzo familiar de domingo.', 4.6, 0, '08:00 - 15:00', '9993000009', 'Imagenes/Cocina41.png', 'Imagenes/Cocina41.png', NULL, NULL),
	(35, NULL, 'Verde que te Quiero', 'verde-que-te-quiero', 'Saludable', 'activa', 'Montebello', 'Bowls nutritivos, ensaladas y jugos prensados en frío.', 4.8, 0, '08:00 - 21:00', '9994000001', 'Imagenes/Cocina1.png', 'Imagenes/Cocina1.png', NULL, NULL),
	(36, NULL, 'Frescura Meridana', 'frescura-meridana', 'Saludable', 'activa', 'Altabrisa', 'Comida ligera con ingredientes orgánicos y locales.', 4.5, 0, '09:00 - 20:00', '9994000002', 'Imagenes/Cocina2.png', 'Imagenes/Cocina2.png', NULL, NULL),
	(38, NULL, 'Natura Bowls', 'natura-bowls-merida', 'Saludable', 'activa', 'Campestre', 'Especialistas en açai bowls y smoothies energéticos.', 4.6, 0, '08:00 - 18:00', '9994000004', 'Imagenes/Cocina4.png', 'Imagenes/Cocina4.png', NULL, NULL),
	(39, NULL, 'Sano y Cotidiano', 'sano-y-cotidiano', 'Saludable', 'activa', 'García Ginerés', 'Comida del día baja en grasas y sodio.', 4.3, 0, '12:00 - 17:00', '9994000005', 'Imagenes/Cocina5.png', 'Imagenes/Cocina5.png', NULL, NULL),
	(40, NULL, 'Keto Mérida', 'keto-merida', 'Saludable', 'activa', 'Norte', 'Opciones bajas en carbohidratos, sin azúcar y deliciosas.', 4.9, 0, '09:00 - 21:00', '9994000006', 'Imagenes/Cocina6.png', 'Imagenes/Cocina6.png', NULL, NULL),
	(42, NULL, 'Raíces Clean Eating', 'raices-clean-eating', 'Saludable', 'activa', 'Chuburná', 'Gastronomía libre de procesados y conservadores.', 4.8, 0, '08:00 - 19:00', '9994000008', 'Imagenes/Cocina7.png', 'Imagenes/Cocina7.png', NULL, NULL),
	(43, NULL, 'Zen Food', 'zen-food-merida', 'Saludable', 'activa', 'Centro', 'Menú holístico pensado en la digestión y el bienestar.', 4.5, 0, '11:00 - 18:00', '9994000009', 'Imagenes/Cocina8.png', 'Imagenes/Cocina8.png', NULL, NULL),
	(44, NULL, 'El Buen Comer', 'el-buen-comer-casera', 'Comida Casera', 'activa', 'Pensiones', 'Comida corrida con tres tiempos, sazón 100% casero.', 4.4, 0, '12:00 - 17:00', '9995000001', 'Imagenes/Cocina10.png', 'Imagenes/Cocina10.png', NULL, NULL),
	(45, NULL, 'La Cocina de Mamá', 'cocina-de-mama', 'Comida Casera', 'activa', 'Los Héroes', 'Albóndigas, milanesas y caldos hechos con amor.', 4.7, 0, '11:00 - 18:00', '9995000002', 'Imagenes/Cocina11.png', 'Imagenes/Cocina11.png', NULL, NULL),
	(46, NULL, 'Guisos de la 60', 'guisos-de-la-60', 'Comida Casera', 'activa', 'Centro', 'Menú rotativo todos los días, como en casa.', 4.2, 0, '12:00 - 16:30', '9995000003', 'Imagenes/Cocina12.png', 'Imagenes/Cocina12.png', NULL, NULL),
	(47, NULL, 'Doña Rosa Comedor', 'dona-rosa-comedor', 'Comida Casera', 'activa', 'Juan Pablo II', 'Especialistas en asado de puerco y arroz a la mexicana.', 4.6, 0, '10:00 - 17:00', '9995000004', 'Imagenes/Cocina13.png', 'Imagenes/Cocina13.png', NULL, NULL),
	(48, NULL, 'Mi Nueva Casita', 'mi-casita-merida', 'Comida Casera', 'activa', 'Las Américas', 'La mejor pechuga empanizada y puré de papa natural.', 4.5, 0, '12:00 - 19:00', '9995000005', 'Imagenes/Cocina14.png', 'Imagenes/Cocina14.png', NULL, '2026-04-29 05:04:54'),
	(49, NULL, 'El Rinconcito Familiar', 'rinconcito-familiar', 'Comida Casera', 'activa', 'Cholul', 'Sopa de fideos y guisados abundantes a buen precio.', 4.3, 0, '11:30 - 17:30', '9995000006', 'Imagenes/Cocina15.png', 'Imagenes/Cocina15.png', NULL, NULL),
	(50, NULL, 'Sabor a Hogar', 'sabor-a-hogar', 'Comida Casera', 'activa', 'Ciudad Caucel', 'Comida calientita, fresca y lista para llevar o comer aquí.', 4.8, 0, '12:00 - 18:00', '9995000007', 'Imagenes/Cocina16.png', 'Imagenes/Cocina16.png', NULL, NULL),
	(51, NULL, 'La Mesa Puesta', 'la-mesa-puesta', 'Comida Casera', 'activa', 'Altabrisa', 'Ambiente cálido y comida sin pretensiones, solo buen sabor.', 4.4, 0, '12:00 - 17:00', '9995000008', 'Imagenes/Cocina17.png', 'Imagenes/Cocina17.png', NULL, NULL),
	(52, NULL, 'Ollas y Sartenes', 'ollas-y-sartenes', 'Comida Casera', 'activa', 'San Antonio Kaua', 'Porciones generosas y tortillas hechas a mano todos los días.', 4.5, 0, '10:00 - 16:00', '9995000009', 'Imagenes/Cocina18.png', 'Imagenes/Cocina18.png', NULL, NULL),
	(53, NULL, 'Ceviches El Muelle', 'ceviches-el-muelle', 'Mariscos', 'activa', 'Las Américas', 'Ceviches estilo peruano y aguachiles picantes.', 4.8, 0, '11:00 - 20:00', '9996000001', 'Imagenes/Cocina19.png', 'Imagenes/Cocina19.png', NULL, NULL),
	(54, NULL, 'La Palapa de Chelem', 'palapa-de-chelem-merida', 'Mariscos', 'activa', 'Caucel', 'Pescado frito y filetes al mojo de ajo traídos de la costa.', 4.6, 0, '10:00 - 19:00', '9996000002', 'Imagenes/Cocina20.png', 'Imagenes/Cocina20.png', NULL, NULL),
	(55, NULL, 'Mar Azul', 'mar-azul-merida', 'Mariscos', 'activa', 'Altabrisa', 'Mariscos gourmet, ostiones frescos y paella.', 4.9, 0, '13:00 - 22:00', '9996000003', 'Imagenes/Cocina21.png', 'Imagenes/Cocina21.png', NULL, NULL),
	(56, NULL, 'Tacos de Camarón El Güero', 'tacos-camaron-guero', 'Mariscos', 'activa', 'Centro', 'Tacos capeados estilo Baja y tostadas de atún.', 4.5, 0, '12:00 - 21:00', '9996000004', 'Imagenes/Cocina22.png', 'Imagenes/Cocina22.png', NULL, NULL),
	(57, NULL, 'La Ostionería', 'la-ostioneria-pensiones', 'Mariscos', 'activa', 'Pensiones', 'Especialistas en cocteles campechanos y vuelve a la vida.', 4.4, 0, '09:00 - 18:00', '9996000005', 'Imagenes/Cocina23.png', 'Imagenes/Cocina23.png', NULL, NULL),
	(58, NULL, 'Puerto Progreso 60', 'puerto-progreso-60', 'Mariscos', 'activa', 'Francisco de Montejo', 'Camarones empanizados y pulpo en su tinta.', 4.7, 0, '11:00 - 19:00', '9996000006', 'Imagenes/Cocina24.png', 'Imagenes/Cocina24.png', NULL, NULL),
	(59, NULL, 'El Pescador Alegre', 'pescador-alegre', 'Mariscos', 'activa', 'San Ramón Norte', 'Sopa de mariscos y filete relleno de mariscos.', 4.3, 0, '12:00 - 20:00', '9996000007', 'Imagenes/Cocina25.png', 'Imagenes/Cocina25.png', NULL, NULL),
	(60, NULL, 'Cangrejo Veloz', 'cangrejo-veloz', 'Mariscos', 'activa', 'Los Héroes', 'Snacks de mariscos, micheladas y tostadas rasuradas.', 4.2, 0, '12:00 - 22:00', '9996000008', 'Imagenes/Cocina26.png', 'Imagenes/Cocina26.png', NULL, NULL),
	(61, NULL, 'Brisas del Mar', 'brisas-del-mar', 'Mariscos', 'activa', 'Chuburná', 'Aguachiles negros, verdes y rojos de camarón fresco.', 4.6, 0, '11:00 - 19:00', '9996000009', 'Imagenes/Cocina27.png', 'Imagenes/Cocina27.png', NULL, NULL),
	(62, NULL, 'Plant Based Mérida', 'plant-based-merida', 'Vegana', 'activa', 'Norte', 'Hamburguesas veganas, hot dogs de zanahoria y más.', 4.8, 0, '13:00 - 22:00', '9997000001', 'Imagenes/Cocina28.png', 'Imagenes/Cocina28.png', NULL, NULL),
	(63, NULL, 'Tacos de Soya El Pastor', 'tacos-soya-pastor', 'Vegana', 'activa', 'Centro Histórico', 'Tacos al pastor hechos de proteína de soya texturizada.', 4.6, 0, '18:00 - 00:00', '9997000002', 'Imagenes/Cocina29.png', 'Imagenes/Cocina29.png', NULL, NULL),
	(64, NULL, 'Veggie Yucateco', 'veggie-yucateco', 'Vegana', 'activa', 'Santa Lucía', 'Versiones veganas de cochinita (setas) y queso relleno (almendras).', 4.9, 0, '12:00 - 21:00', '9997000003', 'Imagenes/Cocina30.png', 'Imagenes/Cocina30.png', NULL, NULL),
	(65, NULL, 'La Hoja Verde', 'la-hoja-verde', 'Vegana', 'activa', 'Francisco de Montejo', 'Menú 100% plant-based, postres sin lácteos ni huevo.', 4.7, 0, '09:00 - 18:00', '9997000004', 'Imagenes/Cocina31.png', 'Imagenes/Cocina31.png', NULL, NULL),
	(66, NULL, 'Bistro Vegano', 'bistro-vegano', 'Vegana', 'activa', 'Altabrisa', 'Pizzas con queso de cajú, pastas y vinos veganos.', 4.5, 0, '14:00 - 23:00', '9997000005', 'Imagenes/Cocina32.png', 'Imagenes/Cocina32.png', NULL, NULL),
	(67, NULL, 'Raíz y Fruto', 'raiz-y-fruto', 'Vegana', 'activa', 'Las Américas', 'Comida reconfortante vegana, ideal para transiciones.', 4.4, 0, '10:00 - 19:00', '9997000006', 'Imagenes/Cocina33.png', 'Imagenes/Cocina33.png', NULL, NULL),
	(68, NULL, 'El Helecho Mágico', 'helecho-magico', 'Vegana', 'activa', 'Pensiones', 'Guisos tradicionales mexicanos en su versión sin crueldad.', 4.8, 0, '12:00 - 17:00', '9997000007', 'Imagenes/Cocina34.png', 'Imagenes/Cocina34.png', NULL, NULL),
	(69, NULL, 'Kombucha & Seitan', 'kombucha-seitan', 'Vegana', 'activa', 'Montebello', 'Especialistas en carnes vegetales artesanales y fermentos.', 4.6, 0, '11:00 - 20:00', '9997000008', 'Imagenes/Cocina35.png', 'Imagenes/Cocina35.png', NULL, NULL),
	(70, NULL, 'Deli Sin Carne', 'deli-sin-carne', 'Vegana', 'activa', 'Caucel', 'Antojitos rápidos, empanadas de lentejas y choripan vegano.', 4.3, 0, '17:00 - 23:00', '9997000009', 'Imagenes/Cocinas/Vegano/DeliSCarne.png', 'Imagenes/Cocinas/Vegano/DeliSCarne.png', NULL, NULL),
	(81, 20, 'Plato Sorpresa', 'plato-sorpresa', 'Saludable', 'activa', 'Centro', 'Platos sorpresa para toda la familia', 0.0, 0, '09:00-15:00', '9995235612', 'Imagenes/Cocina9.png', 'Imagenes/Cocina9.png', '2026-05-18 08:34:33', '2026-05-18 08:34:33');

-- Volcando estructura para tabla ecosazon.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `cocina_id` bigint unsigned NOT NULL,
  `contenido` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `calificacion` int NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comentarios_user_id_foreign` (`user_id`),
  KEY `comentarios_cocina_id_foreign` (`cocina_id`),
  CONSTRAINT `comentarios_cocina_id_foreign` FOREIGN KEY (`cocina_id`) REFERENCES `cocinas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comentarios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.comentarios: ~2 rows (aproximadamente)

-- Volcando estructura para tabla ecosazon.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ecosazon.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ecosazon.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.job_batches: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ecosazon.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.migrations: ~12 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_03_11_011330_create_cocinas_table', 1),
	(5, '2026_03_11_011352_create_platos_table', 1),
	(6, '2026_04_13_024323_create_comentarios_table', 1),
	(7, '2026_04_13_031444_add_role_to_users_table', 2),
	(8, '2026_04_13_033032_add_user_id_to_cocinas_table', 3),
	(9, '2026_04_28_231403_add_estatus_to_cocinas_table', 4),
	(10, '2026_05_08_233949_add_categoria_to_platos_table', 5),
	(11, '2026_05_17_200152_create_tarjetas_table', 6),
	(12, '2026_05_18_014756_add_custom_fields_and_verification_to_users_table', 7),
	(13, '2026_05_19_165408_create_pedidos_table', 8),
	(14, '2026_05_19_170837_create_pedido_detalles_table', 9),
	(15, '2026_05_19_170500_create_pedidos_table', 10);

-- Volcando estructura para tabla ecosazon.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ecosazon.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `email_contacto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `iva` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `notas` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.pedidos: ~13 rows (aproximadamente)
INSERT INTO `pedidos` (`id`, `user_id`, `email_contacto`, `subtotal`, `iva`, `total`, `notas`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'chabricardo6@gmail.com', 94.83, 15.17, 110.00, NULL, '2026-05-19 23:22:47', '2026-05-19 23:22:47'),
	(2, NULL, 'chabricardo6@gmail.com', 0.00, 0.00, 0.00, NULL, '2026-05-19 23:22:55', '2026-05-19 23:22:55'),
	(3, NULL, 'chabricardo6@gmail.com', 155.17, 24.83, 180.00, NULL, '2026-05-19 23:23:33', '2026-05-19 23:23:33'),
	(4, NULL, 'chabricardo6@gmail.com', 155.17, 24.83, 180.00, NULL, '2026-05-19 23:30:24', '2026-05-19 23:30:24'),
	(5, NULL, 'chabricardo6@gmail.com', 103.45, 16.55, 120.00, '{"nota": "Sin comentarios adicionales"}', '2026-05-19 23:36:11', '2026-05-19 23:36:11'),
	(6, NULL, 'chabricardo6@gmail.com', 103.45, 16.55, 120.00, '{"nota": "Sin comentarios adicionales"}', '2026-05-19 23:42:27', '2026-05-19 23:42:27'),
	(7, NULL, 'chabricardo6@gmail.com', 198.28, 31.72, 230.00, NULL, '2026-05-19 23:45:20', '2026-05-19 23:45:20'),
	(8, 23, 'chabricardo6@gmail.com', 750.00, 120.00, 870.00, 'Sin comentarios adicionales', '2026-05-20 01:11:39', '2026-05-20 01:11:39'),
	(9, NULL, 'chabricardo6@gmail.com', 120.69, 19.31, 140.00, 'Sin comentarios adicionales', '2026-05-20 02:53:06', '2026-05-20 02:53:06'),
	(10, 23, 'chabricardo6@gmail.com', 90.52, 14.48, 105.00, 'Sin comentarios adicionales', '2026-05-20 03:07:58', '2026-05-20 03:07:58'),
	(11, 23, 'chabricardo6@gmail.com', 120.69, 19.31, 140.00, 'Sin comentarios adicionales', '2026-05-20 03:18:03', '2026-05-20 03:18:03'),
	(12, 23, 'chabricardo6@gmail.com', 556.03, 88.97, 645.00, 'Sin comentarios adicionales', '2026-05-20 03:26:12', '2026-05-20 03:26:12'),
	(13, 23, 'chabricardo6@gmail.com', 0.00, 0.00, 0.00, 'Sin comentarios adicionales', '2026-05-20 03:31:24', '2026-05-20 03:34:37'),
	(14, NULL, 'chabricardo6@gmail.com', 125.00, 0.00, 125.00, 'Sin comentarios adicionales', '2026-05-20 05:07:27', '2026-05-20 05:07:27'),
	(15, 23, 'chabricardo6@gmail.com', 420.00, 0.00, 420.00, 'Sin comentarios adicionales', '2026-05-20 05:10:45', '2026-05-20 05:12:05');

-- Volcando estructura para tabla ecosazon.pedido_detalles
CREATE TABLE IF NOT EXISTS `pedido_detalles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint unsigned NOT NULL,
  `plato_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cocina_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `estatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_detalles_pedido_id_foreign` (`pedido_id`),
  CONSTRAINT `pedido_detalles_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.pedido_detalles: ~0 rows (aproximadamente)
INSERT INTO `pedido_detalles` (`id`, `pedido_id`, `plato_nombre`, `cocina_nombre`, `cantidad`, `precio_unitario`, `subtotal`, `estatus`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Ensalada Citrus Berry', 'Frescura Meridana', 1, 110.00, 110.00, 'pendiente', '2026-05-19 23:22:47', '2026-05-19 23:22:47'),
	(2, 3, 'Bowl Salmón KETO', 'Verde que te Quiero', 1, 180.00, 180.00, 'pendiente', '2026-05-19 23:23:34', '2026-05-19 23:23:34'),
	(3, 4, 'Bowl Salmón KETO', 'Verde que te Quiero', 1, 180.00, 180.00, 'pendiente', '2026-05-19 23:30:24', '2026-05-19 23:30:24'),
	(4, 5, 'Pollo a la plancha', 'Pueblo Maya Fit', 1, 120.00, 120.00, 'pendiente', '2026-05-19 23:36:11', '2026-05-19 23:36:11'),
	(5, 6, 'Pollo a la plancha', 'Pueblo Maya Fit', 1, 120.00, 120.00, 'pendiente', '2026-05-19 23:42:27', '2026-05-19 23:42:27'),
	(6, 7, 'Pollo a la plancha', 'Pueblo Maya Fit', 1, 120.00, 120.00, 'pendiente', '2026-05-19 23:45:20', '2026-05-19 23:45:20'),
	(7, 7, 'Ensalada Citrus Berry', 'Frescura Meridana', 1, 110.00, 110.00, 'pendiente', '2026-05-19 23:45:20', '2026-05-19 23:45:20'),
	(8, 8, 'Ensalada Citrus Berry', 'Frescura Meridana', 6, 110.00, 660.00, 'pendiente', '2026-05-20 01:11:39', '2026-05-20 01:11:39'),
	(9, 8, 'Wrap de Pavo Nutritivo', 'Frescura Meridana', 2, 105.00, 210.00, 'pendiente', '2026-05-20 01:11:39', '2026-05-20 01:11:39'),
	(10, 9, 'Plato Sorpresa Saludable Diario', 'Plato Sorpresa', 1, 140.00, 140.00, 'entregado', '2026-05-20 02:53:06', '2026-05-20 03:16:30'),
	(11, 10, 'Gelatina de Mosaico', 'Sabor a Hogar', 3, 35.00, 105.00, 'pendiente', '2026-05-20 03:07:58', '2026-05-20 03:07:58'),
	(12, 11, 'Plato Sorpresa Saludable Diario', 'Plato Sorpresa', 1, 140.00, 140.00, 'entregado', '2026-05-20 03:18:03', '2026-05-20 03:19:32'),
	(13, 12, 'Plato Sorpresa Saludable Diario', 'Plato Sorpresa', 3, 140.00, 420.00, 'entregado', '2026-05-20 03:26:12', '2026-05-20 03:27:19'),
	(14, 12, 'Postre Sorpresa Light', 'Plato Sorpresa', 3, 75.00, 225.00, 'cancelado', '2026-05-20 03:26:12', '2026-05-20 03:27:20'),
	(15, 13, 'Plato Sorpresa Saludable Diario', 'Plato Sorpresa', 1, 140.00, 140.00, 'cancelado', '2026-05-20 03:31:24', '2026-05-20 03:34:37'),
	(16, 14, 'Açai Bowl Supremo', 'Natura Bowls', 1, 125.00, 125.00, 'pendiente', '2026-05-20 05:07:27', '2026-05-20 05:07:27'),
	(17, 15, 'Plato Sorpresa Saludable Diario', 'Plato Sorpresa', 3, 140.00, 420.00, 'entregado', '2026-05-20 05:10:46', '2026-05-20 05:11:57'),
	(18, 15, 'Postre Sorpresa Light', 'Plato Sorpresa', 5, 75.00, 375.00, 'cancelado', '2026-05-20 05:10:46', '2026-05-20 05:12:05');

-- Volcando estructura para tabla ecosazon.platos
CREATE TABLE IF NOT EXISTS `platos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cocina_id` bigint unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `precio` decimal(8,2) NOT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `platos_cocina_id_foreign` (`cocina_id`),
  CONSTRAINT `platos_cocina_id_foreign` FOREIGN KEY (`cocina_id`) REFERENCES `cocinas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.platos: ~133 rows (aproximadamente)
INSERT INTO `platos` (`id`, `cocina_id`, `nombre`, `descripcion`, `precio`, `categoria`, `imagen`, `created_at`, `updated_at`) VALUES
	(4, 4, 'Pollo a la plancha', 'Opción ligera y saludable con vegetales al vapor.', 120.00, NULL, 'Imagenes/PolloP.png', NULL, NULL),
	(5, 5, 'Cochinita Pibil', 'Tradicional cochinita pibil enterrada, con cebolla morada y chile habanero.', 110.00, NULL, 'Imagenes/CochinitaP.png', NULL, NULL),
	(6, 6, 'Pechuga Empanizada', 'Crujiente pechuga de pollo acompañada de ensalada fresca y puré de papa.', 70.00, NULL, 'Imagenes/PechugaE.png', NULL, NULL),
	(7, 7, 'Ceviche Mixto', 'Fresco ceviche de pescado y camarón con el toque de la casa.', 150.00, NULL, 'Imagenes/CevicheM.png', NULL, NULL),
	(8, 8, 'Hamburguesa de Lentejas', 'Deliciosa alternativa libre de carne, con pan artesanal y papas gajo.', 95.00, NULL, 'Imagenes/HamburguesaL.png', NULL, NULL),
	(14, 4, 'Ensalada Quinoa', 'Quinoa con aguacate, espinaca y aderezo cítrico sutil.', 115.00, 'Ensaladas', 'Imagenes/Platos/Plato14_4.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(15, 4, 'Smoothie Antioxidante', 'Frutos rojos, plátano y leche de almendras sin azúcar.', 65.00, 'Bebidas', 'Imagenes/Platos/Plato15_4.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(16, 5, 'Sopa de Lima', 'Caldo de pollo sazonado con lima agria y tiritas de tortilla crujiente.', 85.00, 'Sopas', 'Imagenes/Platos/Plato16_5.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(17, 5, 'Panuchos de Cochinita', 'Tres deliciosos panuchos rellenos de frijol con cochinita pibil.', 75.00, 'Antojitos', 'Imagenes/Platos/Plato17_5.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(18, 6, 'Milanesa de Pollo Especial', 'Acompañada de arroz rojo, frijoles refritos y papas fritas.', 85.00, 'Plato Fuerte', 'Imagenes/Platos/Plato18_6.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(19, 6, 'Caldo de Pollo Casero', 'Caldo reconfortante con verduras frescas, arroz y garbanzos.', 75.00, 'Sopas', 'Imagenes/Platos/Plato19_6.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(20, 7, 'Coctel de Camarón Grande', 'Camarones seleccionados en salsa coctelera de la casa con aguacate.', 140.00, 'Cocteles', 'Imagenes/Platos/Plato20_7.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(21, 7, 'Filete de Pescado al Empapelado', 'Filete fresco cocinado al vapor con verduras finas y mantequilla.', 155.00, 'Plato Fuerte', 'Imagenes/Platos/Plato21_7.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(22, 8, 'Tacos de Portobello al Pastor', 'Hongos portobello marinados con piña, cebolla y cilantro.', 90.00, 'Tacos', 'Imagenes/Platos/Plato22_8.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(23, 8, 'Brownie Vegano Sin Culpa', 'Hecho con cacao orgánico y aguacate, endulzado de forma natural con dátil.', 55.00, 'Postres', 'Imagenes/Platos/Plato23_8.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(24, 11, 'Queso Relleno Especial', 'Queso de bola holandés original relleno de picadillo de carne fina.', 195.00, 'Especialidades', 'Imagenes/Platos/Plato24_11.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(25, 11, 'Sopa de Lima Tradicional', 'Receta ancestral con pechuga de pavo deshebrada.', 90.00, 'Sopas', 'Imagenes/Platos/Plato25_11.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(26, 12, 'Longaniza de Valladolid Asada', 'Acompañada de chiltomate, cebolla asada y naranjas agrias.', 140.00, 'Plato Fuerte', 'Imagenes/Platos/Plato26_12.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(27, 12, 'Filete de Res de la Hacienda', 'Filete tierno bañado en salsa gourmet de tres chiles locales.', 210.00, 'Gourmet', 'Imagenes/Platos/Plato27_12.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(28, 13, 'Poc Chuc Premium', 'Finas lajas de cerdo marinadas en naranja agria al carbón directo.', 135.00, 'Al Carbón', 'Imagenes/Platos/Plato28_13.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(29, 13, 'Chiltomate con Chicharrón', 'Entrada de salsa de tomate asado tradicional con chicharrón crujiente.', 65.00, 'Entradas', 'Imagenes/Platos/Plato29_13.pngg', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(30, 14, 'Pollo en Escabeche Oriental', 'Pollo tierno cocinado con recado de escabeche y cebollas curtidas.', 150.00, 'Plato Fuerte', 'Imagenes/Platos/Plato30_14.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(31, 14, 'Agua de Chaya con Limón', 'Refrescante bebida tradicional de la región preparada al momento.', 45.00, 'Bebidas', 'Imagenes/Platos/Plato31_14.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(32, 15, 'Papadzules Clásicos', 'Tortillas rellenas de huevo cocido bañadas en salsa cremosa de pepita.', 115.00, 'Tradicional', 'Imagenes/Platos/Plato32_15.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(33, 15, 'Tamalitos de Espelón', 'Dos tamales horneados con frijol espelón tierno y salsa de tomate.', 70.00, 'Antojitos', 'Imagenes/Platos/Plato33_15.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(34, 16, 'Relleno Negro de Pavo', 'Pavo cocido en un guiso oscuro a base de chiles secos quemados.', 160.00, 'Especialidades', 'Imagenes/Platos/Plato34_16.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(35, 16, 'But de Relleno Negro', 'Deliciosa albóndiga de carne molida sazonada al estilo tradicional.', 95.00, 'Entradas', 'Imagenes/Platos/Plato35_16.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(36, 17, 'Mucbipollo Individual', 'El tradicional tamal grande horneado bajo tierra con crujiente masa.', 180.00, 'Temporada', 'Imagenes/Platos/Plato36_17.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(37, 17, 'Pib de Pollo y Puerco', 'Porción generosa de pib mixto sazonado con achiote.', 195.00, 'Temporada', 'Imagenes/Platos/Plato37_17.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(38, 18, 'Salbutes de Pavo Asado', 'Tres salbutes crujientes con pavo, lechuga y aguacate fresco.', 80.00, 'Antojitos', 'Imagenes/Platos/Plato38_18.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(39, 18, 'Empanadas de Queso de Bola', 'Dos empanadas fritas con abundante queso holandés derretido.', 70.00, 'Antojitos', 'Imagenes/Platos/Plato39_18.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(40, 19, 'Panuchos de Huevo Cocido', 'Orden de tres panuchos rellenos de frijol negro con huevo.', 75.00, 'Antojitos', 'Imagenes/Platos/Plato40_19.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(41, 19, 'Caldo de Pavo Reconfortante', 'Caldo limpio ideal para acompañar tus antojitos.', 85.00, 'Sopas', 'Imagenes/Platos/Plato41_19.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(42, 20, 'Polcanes Tradicionales de Tok-sel', 'Dos polcanes de masa de maíz con semilla de calabaza molida.', 65.00, 'Antojitos', 'Imagenes/Platos/Plato42_20.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(43, 20, 'Horchata de Coco de la Región', 'Bebida refrescante y cremosa hecha en casa.', 40.00, 'Bebidas', 'Imagenes/Platos/Plato43_20.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(44, 21, 'Kibi Relleno de Queso de Bola', 'Kibi frito de trigo quebrado relleno de delicioso queso holandés.', 45.00, 'Antojitos', 'Imagenes/Platos/Plato44_21.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(45, 21, 'Kibi Tradicional de Carne', 'Trigo quebrado mezclado con carne molida selecta y menta.', 35.00, 'Antojitos', 'Imagenes/Platos/Plato45_21.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(46, 22, 'Gordita de Chicharrón Prensadito', 'Estilo yucateco con salsa chiltomate casera.', 40.00, 'Antojitos', 'Imagenes/Platos/Plato46_22.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(47, 22, 'Gordita de Carne Molida Especial', 'Rellena de carne sazonada con especias regionales.', 40.00, 'Antojitos', 'Imagenes/Platos/Plato47_22.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(48, 23, 'Piedras de Masa Crujientes', 'Dos piezas de masa frita preparadas con frijol e ingredientes locales.', 55.00, 'Antojitos', 'Imagenes/Platos/Plato48_23.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(49, 23, 'Empanadas de Cazón Deshebrado', 'Orden de dos empanadas con un excelente guiso de pescado.', 70.00, 'Antojitos', 'Imagenes/Platos/Plato49_23.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(50, 24, 'Tamal Torteado de Pollo', 'Envuelto en hoja de plátano con salsa de tomate frito arriba.', 45.00, 'Tamales', 'Imagenes/Platos/Plato50_24.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(51, 24, 'Vaporcitos de Cerdo Tradicionales', 'Orden de tres tamales delgados cocinados al vapor.', 60.00, 'Tamales', 'Imagenes/Platos/Plato51_24.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(52, 25, 'Caldo de Asado de Pavo', 'Guiso caldoso bien condimentado con piezas selectas de pavo.', 110.00, 'Caldos', 'Imagenes/Platos/Plato25_52.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(53, 25, 'Patitas de Puerco Entomatadas', 'Porción sazonada ideal para botanear por la noche.', 85.00, 'Antojitos', 'Imagenes/Platos/Plato25_53.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(54, 26, 'Potaje de Lentejas Dominguero', 'Con tocino, plátano macho, cerdo y el inconfundible sazón de hogar.', 105.00, 'De Olla', 'Imagenes/Platos/Plato25_54.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(55, 26, 'Puchero de Tres Carnes', 'Res, puerco y pollo acompañados con verduras surtidas y arroz.', 130.00, 'De Olla', 'Imagenes/Platos/Plato26_55.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(56, 27, 'Tortillas de Comal con Picadillo', 'Hechas a mano al momento con un guiso tradicional de res.', 85.00, 'Guisos', 'Imagenes/Platos/Plato27_56.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(57, 27, 'Frijol con Puerco Mestizo', 'El clásico plato de los lunes con arroz, rábano picado y cilantro.', 110.00, 'Tradicional', 'Imagenes/Platos/Plato27_57.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(58, 28, 'Comida Corrida del Día', 'Incluye una sopa de entrada, guisado abundante a elegir y agua fresca.', 75.00, 'Menú Diario', 'Imagenes/Platos/Plato28_58.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(59, 28, 'Milanesa de Res con Arroz', 'Fina lámina de res bien sazonada acompañada de ensalada.', 85.00, 'Plato Fuerte', 'Imagenes/Platos/Plato28_59.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(60, 29, 'Costilla de Cerdo a la Leña', 'Bañada en salsa barbacoa artesanal o chiltomate rústico.', 145.00, 'A la Leña', 'Imagenes/Platos/Plato29_60.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(61, 29, 'Pollo Asado al Carbón Estilo Fogón', 'Medio pollo dorado con tortillas, cebollas y salsas.', 120.00, 'A la Leña', 'Imagenes/Platos/Plato29_61.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(62, 30, 'Mole Poblano Artesanal', 'Con una pieza de pollo fresca y guarnición de arroz con verduras.', 125.00, 'Moles', 'Imagenes/Platos/Plato30_62.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(63, 30, 'Pipian Rojo con Cerdo', 'Salsa a base de semillas de calabaza tostadas y chiles secos.', 120.00, 'Pipianes', 'Imagenes/Platos/Plato30_63.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(64, 31, 'Chiles Rellenos de Picadillo', 'Bañados en una deliciosa salsa caldosa de jitomate.', 95.00, 'Tradicional', 'Imagenes/Platos/Plato31_64.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(65, 31, 'Sopa Azteca Tradicional', 'Con tiras de tortilla crujientes, queso, crema y chile pasilla.', 70.00, 'Sopas', 'Imagenes/Platos/Plato31_65.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(66, 32, 'Sopa de Tortilla Crujiente', 'Caldo sazonado con aguacate fresco, queso y chicharrón.', 70.00, 'Sopas', 'Imagenes/Platos/Plato32_66.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(67, 32, 'Enchiladas Mestizas de Mole', 'Tres enchiladas de pollo bañadas en mole dulce y ajonjolí.', 100.00, 'Plato Fuerte', 'Imagenes/Platos/Plato32_67.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(68, 33, 'Agua de Jamaica Orgánica Grande', 'Servida en un jarrón tradicional de barro frío.', 40.00, 'Bebidas', 'Imagenes/Platos/Plato33_68.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(69, 33, 'Chilaquiles Rojos con Huevo', 'Totopos horneados bañados con salsa y dos huevos estrellados.', 85.00, 'Desayunos', 'Imagenes/Platos/Plato33_69.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(70, 34, 'Bistec a la Mexicana', 'Tiras de res salteadas con tomate, cebolla y chile verde fresco.', 105.00, 'Guisos', 'Imagenes/Platos/Plato34_70.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(71, 34, 'Cortadillo de Cerdo en su Jugo', 'Carne tierna cocinada a fuego lento con especias de barrio.', 100.00, 'Guisos', 'Imagenes/Platos/Plato34_71.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(72, 35, 'Bowl Salmón KETO', 'Salmón fresco, base de coliflor rallada, aguacate y ajonjolí negro.', 180.00, 'Plato Fuerte', 'Imagenes/Platos/Plato35_72.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(73, 35, 'Tostadas de Aguacate', 'Dos tostadas de pan integral rústico con huevo poché.', 90.00, 'Desayunos', 'Imagenes/Platos/Plato35_73.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(74, 36, 'Ensalada Citrus Berry', 'Mix de lechugas, fresas frescas, nueces y aderezo ligero de mandarina.', 110.00, 'Ensaladas', 'Imagenes/Platos/Plato36_74.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(75, 36, 'Wrap de Pavo Nutritivo', 'Tortilla verde de espinaca con pechuga de pavo y vegetales crujientes.', 105.00, 'Wraps', 'Imagenes/Platos/Plato36_75.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(78, 38, 'Açai Bowl Supremo', 'Base de açai puro con granola artesanal, fresa y coco rallado.', 125.00, 'Bowls', 'Imagenes/Platos/Plato38_78.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(79, 38, 'Green Energy Juice', 'Extracción en frío de manzana verde, apio, pepino y limón.', 60.00, 'Bebidas', 'Imagenes/Platos/Plato38_79.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(80, 39, 'Pescado al Vapor con Hierbas', 'Filete de pescado blanco con finas hierbas y ejotes al vapor.', 130.00, 'Plato Fuerte', 'Imagenes/Platos/Plato39_80.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(81, 39, 'Sopa de Verduras de la Casa', 'Sopa ligera con verduras de estación libre de grasas añadidas.', 65.00, 'Entradas', 'Imagenes/Platos/Plato39_81.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(82, 40, 'Keto Pizza de Pepperoni', 'Masa crocante de harina de almendra con abundante queso mozzarella.', 175.00, 'Keto', 'Imagenes/Platos/Plato40_82.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(83, 40, 'Fat Bombs de Chocolate', 'Trufas de chocolate amargo con mantequilla de maní aptas para KETO.', 50.00, 'Postres', 'Imagenes/Platos/Plato40_83.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(84, 42, 'Tazón Macrobiótico', 'Camote horneado, garbanzos asados, kale y un toque de aderezo de tahini.', 120.00, 'Bowls', 'Imagenes/Platos/Plato42_84.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(85, 42, 'Chia Pudding de Mango', 'Semillas de chía hidratadas en leche de coco con cubos de mango fresco.', 70.00, 'Postres', 'Imagenes/Platos/Plato42_85.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(86, 43, 'Caldo Depurativo de Jengibre', 'Caldo reconfortante con jengibre fresco, champiñones y cubos de tofu.', 85.00, 'Sopas', 'Imagenes/Platos/Plato43_86.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(87, 43, 'Té Matcha Ceremonial Frío', 'Matcha orgánico de alta calidad batido con leche vegetal.', 65.00, 'Bebidas', 'Imagenes/Platos/Plato43_87.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(88, 44, 'Albóndigas al Chipotle', 'Rellenas de huevo cocido y bañadas en una salsa cremosa de chipotle.', 90.00, 'Guisados', 'Imagenes/Platos/Plato44_88.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(89, 44, 'Arroz con Leche de la Abuela', 'Postre tradicional espolvoreado con canela molida.', 40.00, 'Postres', 'Imagenes/Platos/Plato44_89.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(90, 45, 'Chiles Rellenos de Queso', 'Ligeramente capeados y bañados en salsa caldosa de jitomate.', 95.00, 'Casera', 'Imagenes/Platos/Plato45_90.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(91, 45, 'Sopa de Fideo Seco', 'Fideo sazonado con tomate, un toque de crema y queso fresco.', 55.00, 'Entradas', 'Imagenes/Platos/Plato45_91.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(92, 46, 'Guisado de Res con Papas', 'Carne tierna estofada con papas, zanahorias y chícharos.', 100.00, 'Guisados', 'Imagenes/Platos/plato46_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(93, 46, 'Agua del Día Horchata', 'Elaborada artesanalmente desde cero con arroz y canela pura.', 35.00, 'Bebidas', 'Imagenes/Platos/plato46_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(94, 47, 'Asado de Puerco Estilo Casero', 'Trozos de cerdo en salsa roja espesa bien condimentada.', 110.00, 'Especialidades', 'Imagenes/Platos/plato47_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(95, 47, 'Frijoles Charros con Tocino', 'Frijoles de la olla sazonados con tocino, chorizo y jalapeño.', 50.00, 'Complementos', 'Imagenes/Platos/plato47_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(96, 48, 'Pechuga a la Cordon Bleu', 'Rellena de jamón y queso con un sedoso puré de papa natural.', 120.00, 'Plato Fuerte', 'Imagenes/Platos/plato48_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(97, 48, 'Ensalada Rusa Tradicional', 'Papa, zanahoria, chícharos y mayonesa clásica de la casa.', 45.00, 'Complementos', 'Imagenes/Platos/plato48_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(98, 49, 'Enchiladas Verdes', 'Tres enchiladas rellenas de pollo con crema y queso gratinado.', 90.00, 'Plato Fuerte', 'Imagenes/Platos/plato49_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(99, 49, 'Flan Napolitano Casero', 'Postre suave horneado a baño María con caramelo líquido.', 45.00, 'Postres', 'Imagenes/Platos/plato49_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(100, 50, 'Picadillo de Res Tradicional', 'Carne molida sazonada con pasitas, almendras y cubos de papa.', 85.00, 'Guisados', 'Imagenes/Platos/plato50_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(101, 50, 'Gelatina de Mosaico', 'Cubos multicolores fijos en una base cremosa de tres leches.', 35.00, 'Postres', 'Imagenes/Platos/plato50_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(102, 51, 'Pollo en Mole Poblano', 'Pieza de pollo tierna bañada en mole artesanal con ajonjolí.', 115.00, 'Plato Fuerte', 'Imagenes/Platos/plato51_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(103, 51, 'Consomé de Pollo', 'Caldo claro con menudencias finas, arroz y limones.', 50.00, 'Sopas', 'Imagenes/Platos/plato51_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(104, 52, 'Cerdo en Salsa Verde', 'Guisado tradicional con trozos de calabacita tierna.', 95.00, 'Guisados', 'Imagenes/Platos/plato52_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(105, 52, 'Tacos Dorados de Papa', 'Orden de tres tacos crujientes acompañados de lechuga y crema.', 60.00, 'Antojitos', 'Imagenes/Platos/plato52_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(106, 53, 'Aguachile Verde de Camarón', 'Camarón curtido al momento en limón con chile serrano y pepino.', 165.00, 'Aguachiles', 'Imagenes/Platos/plato53_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(107, 53, 'Ceviche Peruano de Pescado', 'Láminas de pescado fresco con leche de tigre, camote y elote.', 175.00, 'Ceviches', 'Imagenes/Platos/plato53_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(108, 54, 'Pescado Frito Entero', 'Pesca fresca del día frita a la perfección con arroz y ensalada.', 220.00, 'Especialidades', 'Imagenes/Platos/plato54_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(109, 54, 'Filete al Mojo de Ajo', 'Filete de pescado dorado con abundantes láminas de ajo frito.', 145.00, 'Plato Fuerte', 'Imagenes/Platos/plato54_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(110, 55, 'Paella de Mariscos', 'Arroz azafranado premium con camarón, pulpo, mejillón y calamar.', 240.00, 'Gourmet', 'Imagenes/Platos/plato55_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(111, 55, 'Ostiones Frescos en su Concha', 'Media docena de ostiones premium listos para disfrutar con limón.', 180.00, 'Entradas', 'Imagenes/Platos/plato55_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(112, 56, 'Tacos Capeados Estilo Baja', 'Orden de tres tacos de pescado capeado con col y aderezo tártara.', 105.00, 'Tacos', 'Imagenes/Platos/plato56_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(113, 56, 'Tostada de Atún con Chipotle', 'Atún fresco en cubos sobre una cama fina de guacamole.', 65.00, 'Tostadas', 'Imagenes/Platos/plato56_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(114, 57, 'Coctel Campechano', 'Fabulosa combinación de camarón, pulpo y ostión fresco.', 160.00, 'Cocteles', 'Imagenes/Platos/plato57_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(115, 57, 'Vuelve a la Vida Especial', 'Caldo concentrado frío de mariscos surtidos, ideal para revivir.', 170.00, 'Especialidades', 'Imagenes/Platos/plato57_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(116, 58, 'Camarones Empanizados', 'Camarones gigantes crujientes servidos con papas y aderezo.', 180.00, 'Plato Fuerte', 'Imagenes/Platos/plato58_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(117, 58, 'Pulpo en su Tinta', 'Tierno pulpo local guisado y servido sobre una cama de arroz blanco.', 210.00, 'Especialidades', 'Imagenes/Platos/plato58_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(118, 59, 'Sopa de Mariscos 7 Mares', 'Caldo caliente y espeso con una variedad seleccionada del mar.', 195.00, 'Sopas', 'Imagenes/Platos/plato59_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(119, 59, 'Filete Relleno de Mariscos', 'Filete de pescado blanco relleno de camarón, pulpo y queso fundido.', 215.00, 'Plato Fuerte', 'Imagenes/Platos/plato59_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(120, 60, 'Tostadas Rasuradas de Cangrejo', 'Dos tostadas cargadas con pulpa de cangrejo bien sazonada.', 130.00, 'Snacks', 'Imagenes/Platos/plato60_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(121, 60, 'Michelada Marinera', 'Bebida preparada clásica coronada con una brocheta de camarones.', 110.00, 'Bebidas', 'Imagenes/Platos/plato60_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(122, 61, 'Aguachile Negro Tatemado', 'Salsa de chiles tatemados con camarones frescos curtidos.', 170.00, 'Aguachiles', 'Imagenes/Platos/plato61_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(123, 61, 'Aguachile Rojo Picante', 'Con un extracto intenso de chile de árbol, cebolla morada y pepino.', 165.00, 'Aguachiles', 'Imagenes/Platos/plato61_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(124, 62, 'Hamburguesa Plant Based', 'Medallón artesanal con queso vegano fundido y aderezo especial de la casa.', 125.00, 'Hamburguesas', 'Imagenes/Platos/plato62_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(125, 62, 'Hot Dog de Zanahoria Ahumada', 'Zanahoria premium marinada y asada con toppings clásicos.', 80.00, 'Snacks', 'Imagenes/Platos/plato62_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(126, 63, 'Gringas de Soya al Pastor', 'Tortilla de harina grande con soya texturizada al pastor y queso de papa.', 95.00, 'Antojitos', 'Imagenes/Platos/plato63_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(127, 63, 'Tacos de Setas al Alambre', 'Setas salteadas con pimientos, cebolla y un toque sazonado.', 90.00, 'Tacos', 'Imagenes/Platos/plato63_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(128, 64, 'Cochinita de Setas Orgánicas', 'Setas deshebradas marinadas en achiote y naranja agria.', 110.00, 'Yucateca Vegana', 'Imagenes/Platos/plato64_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(129, 64, 'Queso Relleno de Almendras', 'Alternativa 100% vegetal rellena de picadillo de soya y frutos secos.', 180.00, 'Yucateca Vegana', 'Imagenes/Platos/plato64_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(130, 65, 'Bowl de Buda Nutritivo', 'Garbanzos crujientes, quinoa, camote horneado, espinaca y hummus.', 120.00, 'Bowls', 'Imagenes/Platos/plato65_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(131, 65, 'Cheesecake Vegano de Frambuesa', 'Base de nueces crujientes y un relleno cremoso a base de nuez de la India.', 75.00, 'Postres', 'Imagenes/Platos/plato65_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(132, 66, 'Pizza con Queso de Cajú', 'Masa madre con salsa pomodoro orgánica, queso de nuez de la India y albahaca.', 165.00, 'Pizzas', 'Imagenes/Platos/plato66_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(133, 66, 'Pasta Alfredo Vegana', 'Fetuccini envuelto en una salsa cremosa de coliflor y ajo confitado.', 140.00, 'Pastas', 'Imagenes/Platos/plato66_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(134, 67, 'Nuggets de Garbanzo Crujientes', 'Acompañados de catsup orgánica hecha de forma artesanal.', 85.00, 'Snacks', 'Imagenes/Platos/plato67_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(135, 67, 'Tazón Comfort de Lentejas', 'Guisado espeso de lentejas con trozos de plátano macho asado.', 95.00, 'Guisados', 'Imagenes/Platos/plato68_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(136, 68, 'Enchiladas de Jamaica Enchipotlada', 'Flor de jamaica perfectamente sazonada envuelta en tortillas de maíz.', 110.00, 'Mexicanas', 'Imagenes/Platos/plato68_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(137, 68, 'Pozole Verde de Hongos', 'Caldo tradicional de maíz pozolero con mix de champiñones y setas.', 120.00, 'Sopas', 'Imagenes/Platos/plato69_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(138, 69, 'Steak de Seitán Marinado', 'Bife de seitán artesanal servido con papas rústicas al romero.', 160.00, 'Especialidades', 'Imagenes/Platos/plato69_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(139, 69, 'Kombucha de Jengibre y Limón', 'Bebida fermentada refrescante elaborada en nuestra barra.', 60.00, 'Bebidas', 'Imagenes/Platos/stock-kombucha.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(140, 70, 'Empanadas de Lentejas', 'Dos empanadas horneadas rellenas de guiso de lentejas bien sazonadas.', 70.00, 'Antojitos', 'Imagenes/Platos/plato70_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(141, 70, 'Choripán Vegano con Chimichurri', 'Salchicha vegetal premium en pan artesanal con chimichurri casero.', 95.00, 'Snacks', 'Imagenes/Platos/plato70_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(142, 81, 'Plato Sorpresa Saludable Diario', 'Creación nutritiva del chef basada en ingredientes frescos del día.', 140.00, 'Sorpresa', 'Imagenes/Platos/plato81_1.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36'),
	(143, 81, 'Postre Sorpresa Light', 'Delicia dulce balanceada del día para terminar libre de culpas.', 75.00, 'Sorpresa', 'Imagenes/Platos/plato81_2.png', '2026-05-19 05:44:36', '2026-05-19 05:44:36');

-- Volcando estructura para tabla ecosazon.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.sessions: ~1 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('4cqUb3GFWCiNCioSsc9oALkzZA5z62ejftLfvU1i', 20, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiT0VsNDBwUHE4ZE9EU29QQlBqOHoyQjVVcmtBN3FlUG9pU2Z6aFpPOCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cDovL2Vjb3Nhem9uLmxvY2FsL093bmVycy9vd25lci9kYXNoYm9hcmQiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czo0NDoiaHR0cDovL2Vjb3Nhem9uLmxvY2FsL093bmVycy9vd25lci9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6Im93bmVyLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTI6ImNhcHRjaGFfdGV4dCI7czo2OiJvRU5hRlgiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIwO30=', 1779226479),
	('7D3KgRUNs9QTFC4qfd4mhc2AYNVwiuJ7qs5CYtuY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibXVXc3dYb3hBQlRLdmtrUjQ0ZnFkUFFQdXU2c0E4Y29qcGtVQ01ZWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9lY29zYXpvbi5sb2NhbCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1779231220),
	('kolPJcDwtFe3DPLxL53XaZb2LhrEwQjbeTX5qQAr', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTVlIOWpjajBhRkxURTJMS2xYRERpWERGY0NuQ1dtOGlxUHBjN050biI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9lY29zYXpvbi5sb2NhbC9hZG1pbi9jb2NpbmFzP3BhZ2U9MyI7czo1OiJyb3V0ZSI7czoxOToiYWRtaW4uY29jaW5hcy5pbmRleCI7fXM6MTI6ImNhcHRjaGFfdGV4dCI7czo2OiI3anQ1SnIiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1779232582),
	('Vo5VirvD2e0MQx3tlWVz0uquEhiw7UDCc7CfHWJo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHpQSjAydUcxcDlJbFRSRFRpSjZuaEFTdlFJWmNXNk5BSmtQZGdXVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9lY29zYXpvbi5sb2NhbC9wcm9wb3NpdG8iO3M6NToicm91dGUiO3M6OToicHJvcG9zaXRvIjt9fQ==', 1779232602),
	('YmNvCPkIBK8IJr6a2N2JqykG1qoygOxlP7jpOUPs', 23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZm1OMXJXSzJGU0dBeUJ6a3lTZmh2TjhXb1ZzVTZFbXQ1Q2s2TlZDQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9lY29zYXpvbi5sb2NhbC9jb2NpbmFzIjtzOjU6InJvdXRlIjtzOjEzOiJjb2NpbmFzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMjoiY2FwdGNoYV90ZXh0IjtzOjY6IlA0Vk5UMiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjM7fQ==', 1779226581);

-- Volcando estructura para tabla ecosazon.tarjetas
CREATE TABLE IF NOT EXISTS `tarjetas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nombre_titular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_tarjeta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mes_expiracion` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano_expiracion` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance_simulado` decimal(15,2) NOT NULL DEFAULT '1200000.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tarjetas_user_id_foreign` (`user_id`),
  CONSTRAINT `tarjetas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.tarjetas: ~0 rows (aproximadamente)
INSERT INTO `tarjetas` (`id`, `user_id`, `nombre_titular`, `numero_tarjeta`, `mes_expiracion`, `ano_expiracion`, `balance_simulado`, `created_at`, `updated_at`) VALUES
	(2, 6, 'Hola Mundo', '1234567890123456', '12', '2030', 1199760.00, '2026-05-19 05:31:25', '2026-05-19 05:38:27'),
	(3, 23, 'Hola Mundo', '1234567890123456', '8', '2030', 1195210.00, '2026-05-20 01:08:01', '2026-05-20 05:12:05');

-- Volcando estructura para tabla ecosazon.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ecosazon.users: ~4 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `apellido`, `email`, `telefono`, `foto`, `email_verified_at`, `password`, `verification_code`, `is_verified`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(5, 'Administrador EcoSazón', '', 'admin@ecosazon.com', NULL, NULL, NULL, '$2y$12$UfNjBkQkJmxEVC9G65Rouukup3eTplItLy1qGOKfkO1PJxBXwrpam', NULL, 1, 'admin', NULL, '2026-04-29 03:59:52', '2026-04-29 03:59:52'),
	(6, 'Roger Alberto Arellano Jimenez', '', 'rogerarellano2@gmail.com', NULL, NULL, NULL, '$2y$12$ENJ6FGEhHl7gGOxq1Xj/Su8bjj8bXMvsmPAGA4Fk79rY/79apYtny', NULL, 1, 'user', NULL, '2026-04-29 05:35:57', '2026-04-29 05:35:57'),
	(20, 'Jorge Jimenez', 'Barragán Gonález', 'tonych24064@gmail.com', '9995235123', NULL, NULL, '$2y$12$8K0qY.1pPn0f.wEqLws5g.sI6gRWom7Ba20c6JCGL40OMR2fruMny', NULL, 1, 'owner', NULL, '2026-05-18 08:21:22', '2026-05-18 08:32:54'),
	(23, 'Ricardo Antonio', 'Chab Pool', 'chabricardo6@gmail.com', '9996346512', NULL, NULL, '$2y$12$/lYd5SaHlULx9RyvFcex7ett/u6WzyqwyCpMltPD/pj.8ociA56rq', NULL, 1, 'user', NULL, '2026-05-19 11:33:26', '2026-05-19 11:34:17');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
