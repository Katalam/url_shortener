/*
 * MySQL Database
 */

CREATE DATABASE IF NOT EXISTS url_shortener

CREATE TABLE `urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` text NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`) USING HASH
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
