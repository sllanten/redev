-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS dev;

USE dev;

-- ========================
-- TABLA: variables
-- ========================
DROP TABLE IF EXISTS variables;

CREATE TABLE variables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    token VARCHAR(255) NOT NULL
);

-- ========================
-- TABLA: solicitud
-- ========================
DROP TABLE IF EXISTS solicitud;

CREATE TABLE solicitud (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(150) NOT NULL,
    celular VARCHAR(20),
    fecha DATETIME NOT NULL,
    estado VARCHAR(50) NOT NULL
);

-- ========================
-- TABLA: usuario
-- ========================
DROP TABLE IF EXISTS usuario;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    codigo VARCHAR(100) NOT NULL,
    rol VARCHAR(50) NOT NULL
);

-- ========================
-- TABLA: api
-- ========================
DROP TABLE IF EXISTS api;

CREATE TABLE api (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    url VARCHAR(255) NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario (id) ON DELETE CASCADE
);

-- ========================
-- TABLA: info
-- ========================
DROP TABLE IF EXISTS info;

CREATE TABLE info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    red VARCHAR(100) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    fechareg DATETIME NOT NULL,
    fechamod DATETIME,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario (id) ON DELETE CASCADE
);

-- ========================
-- TABLA: mensajes
-- ========================
DROP TABLE IF EXISTS mensajes;

CREATE TABLE mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    mensaje TEXT NOT NULL,
    tipo VARCHAR(50),
    class VARCHAR(50),
    FOREIGN KEY (id_usuario) REFERENCES usuario (id) ON DELETE CASCADE
);

-- ========================
-- TABLA: suscripcion
-- ========================
DROP TABLE IF EXISTS suscripcion;

CREATE TABLE suscripcion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_info INT NOT NULL,
    estado VARCHAR(50) NOT NULL,
    fecha DATETIME NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario (id) ON DELETE CASCADE,
    FOREIGN KEY (id_info) REFERENCES info (id) ON DELETE CASCADE
);