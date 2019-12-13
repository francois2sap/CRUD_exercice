DROP DATABASE IF EXISTS `it-akademy`;
CREATE DATABASE IF NOT EXISTS `it-akademy`;
USE `it-akademy`;
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    description TEXT(500) NOT NULL,
    photo BLOB NOT NULL,
    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);