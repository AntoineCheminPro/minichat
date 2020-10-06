DROP DATABASE IF EXISTS minichat_php;
CREATE DATABASE minichat_php CHARACTER SET 'utf8';
USE minichat_php;

DROP USER IF EXISTS 'MinichatPHP'@'Localhost';
CREATE USER 'MinichatPHP'@'Localhost';
GRANT ALL PRIVILEGES ON minichat_php.* To 'MinichatPHP'@'Localhost' IDENTIFIED BY 'minichat76';


CREATE TABLE Messages(
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  pseudo VARCHAR(50) NOT NULL,
  message VARCHAR(255) NOT NULL,
  date DATE NOT NULL,
  PRIMARY KEY (id)
)
ENGINE=InnoDB;

INSERT INTO Messages(pseudo, message)
VALUES
("Dupont", "Bonjour"),
("Claire", "Salut");
