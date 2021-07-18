CREATE DATABASE IF NOT EXISTS `production`;
CREATE DATABASE IF NOT EXISTS `testing`;

CREATE USER 'laravel'@'localhost' IDENTIFIED BY 'local';
GRANT ALL PRIVILEGES ON *.* TO 'laravel'@'%';
