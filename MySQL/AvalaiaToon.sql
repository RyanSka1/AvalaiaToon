CREATE DATABASE if not exists AvalaiaToon;

USE AvalaiaToon;

SET GLOBAL event_scheduler = ON;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL, -- Store passwords as hashes
    email VARCHAR(100) NOT NULL,
    verified BOOLEAN DEFAULT 0
);

CREATE TABLE email_verification_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE email_verification_tokens ADD FOREIGN KEY (user_id) REFERENCES users(id);

CREATE EVENT IF NOT EXISTS delete_expired_tokens
ON SCHEDULE EVERY 1 MINUTE
DO
    DELETE FROM email_verification_tokens WHERE created_at < DATE_SUB(NOW(), INTERVAL 24 HOUR);


CREATE TABLE password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE password_resets ADD FOREIGN KEY (user_id) REFERENCES users(id);

CREATE EVENT IF NOT EXISTS delete_expired_tokens
ON SCHEDULE EVERY 1 MINUTE
DO
    DELETE FROM password_resets WHERE created_at < DATE_SUB(NOW(), INTERVAL 15 MINUTE);
