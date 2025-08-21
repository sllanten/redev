-- Seleccionar la base de datos 'dev'
USE dev;

-- Crear tabla 'usuario'
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    codigo VARCHAR(50) UNIQUE,
    rol INT(2) NOT NULL
);

-- Crear tabla 'info'
CREATE TABLE info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    red VARCHAR(20),
    pass VARCHAR(255),
    fechareg DATE,
    fechamod DATE,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);

-- Crear tabla 'suscripcion'
CREATE TABLE suscripcion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_info INT NOT NULL,
    estado INT(2) NOT NULL,
    fecha DATE,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id),
    FOREIGN KEY (id_info) REFERENCES info(id)
);

-- Crear tabla 'mensajes'
CREATE TABLE mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    mensaje TEXT NOT NULL,
    tipo TEXT NOT NULL,
    class TEXT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);

-- Crear tabla 'api'
CREATE TABLE api (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(25) NOT NULL,
    descripcion TEXT NOT NULL,
    url VARCHAR(255) NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);

-- Crear tabla 'validacion'
CREATE TABLE validacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    archivo VARCHAR(255) NOT NULL,
    comentario TEXT,
    fecha DATE,
    estado INT(2),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);

-- Crear tabla 'variables'
CREATE TABLE variables(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(25) NOT NULL,
    token VARCHAR(255) NOT NULL
);