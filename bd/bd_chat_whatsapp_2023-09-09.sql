# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Base de datos: bd_chat_whatsapp
# Tiempo de Generación: 2023-09-09 21:54:48 +0000
# ************************************************************
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8 */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;
# Volcado de tabla clickuser
# ------------------------------------------------------------
DROP TABLE IF EXISTS `clickuser`;
CREATE TABLE `clickuser` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `UserIdSession` varchar(50) DEFAULT NULL,
  `clickUser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish_ci;
# Volcado de tabla msjs
# ------------------------------------------------------------
DROP TABLE IF EXISTS `msjs`;
CREATE TABLE `msjs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) DEFAULT NULL,
  `user_id` int(250) DEFAULT NULL,
  `to_user` varchar(250) DEFAULT NULL,
  `to_id` int(250) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `fecha` varchar(250) DEFAULT NULL,
  `nombre_equipo_user` varchar(250) DEFAULT NULL,
  `leido` varchar(100) DEFAULT NULL,
  `sonido` varchar(10) DEFAULT NULL,
  `archivos` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MyISAM DEFAULT CHARSET = latin1 COLLATE = latin1_swedish_ci;
# Volcado de tabla users
# ------------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_apellido` varchar(250) DEFAULT NULL,
  `email_user` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `estatus` varchar(10) DEFAULT NULL,
  `fecha_registro` varchar(50) DEFAULT NULL,
  `fecha_session` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */
;
INSERT INTO `users` (
    `id`,
    `nombre_apellido`,
    `email_user`,
    `password`,
    `imagen`,
    `estatus`,
    `fecha_registro`,
    `fecha_session`
  )
VALUES (
    1,
    'Urian',
    'dev@gmail.com',
    '$2y$10$ysOZo2KGH4w/7CnHfnyf1OrlN7JkzMEv7JzFQCsh9ZlksOEvDYuv6',
    '6593d72014.jpeg',
    'Inactiva',
    '09/09/2023 02:32 pm',
    '09/09/2023 02:51 pm'
  ),
  (
    2,
    'Brenda',
    'brenda@gmail.com',
    '$2y$10$KaytI.EMiwTaOE9pDTVMSeVy7foOKWsQaPBD8r3RU4OY2zml/SyR.',
    'f0b0045e42.jpg',
    'Inactiva',
    '09/09/2023 02:52 pm',
    '09/09/2023 02:53 pm'
  ),
  (
    3,
    'Abelardo Perez',
    'abelardo@gmail.com',
    '$2y$10$qil5sHQ8aRAgIxLH54ETUukHTHuWmJwSobFe4hoP6k4URyjEIrOG.',
    '6f842c4fe3.jpeg',
    'Inactiva',
    '09/09/2023 02:53 pm',
    '09/09/2023 02:54 pm'
  ),
  (
    4,
    'Cristian R.',
    'cristian@hotmail.com',
    '$2y$10$xDZn40SPhfMagbYTsz4MZ.1L7XD.VN5OIcJCZzjrWWnvE5HjWtOci',
    '45d9649ddf.png',
    'Activo',
    '09/09/2023 02:54 pm',
    NULL
  ),
  (
    5,
    'Roxana D',
    'roxana@gmail.com',
    '$2y$10$kxPmU9mvpCM.KZgKUH0houoIHfD2w.xD2KD5czjjZxo6L53uGBihW',
    'da4808ea74.png',
    'Activo',
    '09/09/2023 02:57 pm',
    NULL
  ),
  (
    6,
    'Franco E.',
    'franco@gmail.com',
    '$2y$10$5VLSB3NqFVjCOE.I8ooEY.kV9S1c96zDWDweaXH7RdG15v2p/RAIC',
    '17d760c7b0.jpeg',
    'Activo',
    '09/09/2023 02:57 pm',
    NULL
  ),
  (
    7,
    'Chica Mala',
    'chica@gmail.com',
    '$2y$10$f6otTzetZ4Two1zcKowYxudasE.rD4CFXmVdn98zR5vHkMVtYNEe2',
    '2689136cbf.webp',
    'Activo',
    '09/09/2023 02:59 pm',
    NULL
  ),
  (
    8,
    'Deyna Castellano',
    'deyna@gmail.com',
    '$2y$10$iHn2vpc.qc.eYPcE2aWsiOVm9gAyek4NeVZr/Qfvoo31e7JQsNF9S',
    'c02d4a11e0.jpg',
    'Activo',
    '09/09/2023 03:00 pm',
    NULL
  ),
  (
    9,
    'Urian V.',
    'urian@gmail.com',
    '$2y$10$Jw1IU3IGpSpMUHmr7jcdUOjc8OH0Mte0SpBUsfgGtm7GP7t2DEMze',
    '529a73c510.png',
    'Activo',
    '09/09/2023 03:01 pm',
    NULL
  );
/*!40000 ALTER TABLE `users` ENABLE KEYS */
;
UNLOCK TABLES;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;