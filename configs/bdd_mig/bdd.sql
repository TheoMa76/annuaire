CREATE DATABASE php_framework;

USE php_framework;

CREATE TABLE etudiant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    telephone VARCHAR(100),
    mail VARCHAR(100),
    adresse VARCHAR(500)
);

