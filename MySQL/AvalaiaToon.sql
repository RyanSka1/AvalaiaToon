CREATE DATABASE AvalaiaToon;

USE AvalaiaToon;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL, -- Armazene as senhas como hashes
    email VARCHAR(100) NOT NULL,
    cpf CHAR(14) NOT NULL,
    phone CHAR(15) NOT NULL
);
