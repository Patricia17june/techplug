-- Users table
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('customer','admin') DEFAULT 'customer',
  phone VARCHAR(20),
  reset_token VARCHAR(100) NULL,
  reset_expires DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO `addresses` (`id`, `user_id`, `label`, `county`, `town`, `street`, `phone`, `is_default`) VALUES
(1, 1, 'Kasongo', 'Nairobi', 'Kindiki', 'Parliament', '0712345678', 1);



-- Addresses table
CREATE TABLE IF NOT EXISTS addresses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  label VARCHAR(50) DEFAULT 'Home',
  county VARCHAR(100),
  town VARCHAR(100),
  street VARCHAR(255),
  phone VARCHAR(20),
  is_default TINYINT DEFAULT 0,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `phone`, `reset_token`, `reset_expires`, `created_at`) VALUES
(1, 'tech', 'tech@gmail.com', '$2y$10$t6ZlFI/lQtgoD7mjjqbz4OFG30b2g3HjfwVDXrQePrPOQqmsTyFRm', 'customer', '0710345678', NULL, NULL, '2026-11-20 18:24:50');
