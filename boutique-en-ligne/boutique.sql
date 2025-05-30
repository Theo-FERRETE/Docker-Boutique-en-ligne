CREATE DATABASE IF NOT EXISTS boutique
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
USE boutique;

-- Table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT 0
);

-- Table des commandes
CREATE TABLE commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total DECIMAL(10,2),
    date_commande DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table des jeux commandés (liens RAWG)
CREATE TABLE commandes_jeux (
    commande_id INT NOT NULL,
    game_id INT NOT NULL,
    game_name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (commande_id, game_id),
    FOREIGN KEY (commande_id) REFERENCES commandes(id)
);

-- Table optionnelle pour favoris/wishlist
CREATE TABLE favoris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    game_id INT NOT NULL,
    game_name VARCHAR(255) NOT NULL,
    date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Données de test (optionnel)
INSERT INTO users (username, email, password, is_admin) VALUES
('admin', 'admin@demo.com', '$2y$10$eImiTXuWVxfM37uY4JANjQ==', 1),
('user', 'user@demo.com', '$2y$10$eImiTXuWVxfM37uY4JANjQ==', 0);
