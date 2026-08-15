-- =========================================================
-- Base de datos: luna_store
-- Reconstruida a partir del código PHP del proyecto
-- (no se encontró un archivo .sql original en el zip)
-- =========================================================

CREATE DATABASE IF NOT EXISTS luna_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE luna_store;

-- Tabla de usuarios (login / registro)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Tabla de empleados
CREATE TABLE IF NOT EXISTS empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    puesto VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telefono VARCHAR(20) NOT NULL
);

-- Tabla de productos
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    descripcion TEXT,
    stock INT NOT NULL DEFAULT 0
);

-- Tabla de sucursales
CREATE TABLE IF NOT EXISTS sucursales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(150) NOT NULL
);

-- =========================================================
-- Datos de ejemplo opcionales (para poder ver algo al abrir
-- el proyecto sin tener que cargar todo a mano)
-- =========================================================

INSERT INTO empleados (nombre, puesto, email, telefono) VALUES
('Juan Pérez', 'Vendedor', 'juan@lunastore.com', '0999999999'),
('Maria Gomez', 'Cajera', 'maria@lunastore.com', '0988888888');

INSERT INTO productos (nombre, precio, descripcion, stock) VALUES
('Camiseta básica', 15.99, 'Camiseta de algodón 100%', 50),
('Pantalón jean', 35.50, 'Pantalón de mezclilla', 30);

INSERT INTO sucursales (nombre, direccion, telefono, email) VALUES
('Luna Store Centro', 'Av. Principal 123', '022222222', 'centro@lunastore.com');
