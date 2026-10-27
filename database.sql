-- Base de datos AECAUM
CREATE DATABASE IF NOT EXISTS aecaum_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE aecaum_db;

-- Tabla de roles
CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    label VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Migración para bases existentes: admite cualquier cantidad de secciones.
SET @agenda_sections_column_exists = (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'agenda_months' AND COLUMN_NAME = 'sections_json'
);
SET @agenda_sections_migration = IF(
    @agenda_sections_column_exists = 0,
    'ALTER TABLE agenda_months ADD COLUMN sections_json LONGTEXT NULL',
    'SELECT 1'
);
PREPARE agenda_sections_statement FROM @agenda_sections_migration;
EXECUTE agenda_sections_statement;
DEALLOCATE PREPARE agenda_sections_statement;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de documentos
CREATE TABLE IF NOT EXISTS documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    filename VARCHAR(255) NOT NULL,
    path VARCHAR(500) NOT NULL,
    description TEXT,
    uploaded_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de índices
CREATE TABLE IF NOT EXISTS indices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    description TEXT,
    month VARCHAR(20) DEFAULT 'enero',
    year INT DEFAULT 2024,
    informe VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `indices`
ADD COLUMN `image2` VARCHAR(255) NULL DEFAULT NULL AFTER `image`,
ADD COLUMN `image3` VARCHAR(255) NULL DEFAULT NULL AFTER `image2`,
ADD COLUMN `informe_mensual` VARCHAR(255) NULL DEFAULT '' AFTER `informe`;

-- Contenido editable de la agenda institucional (una entrada por mes y año)
CREATE TABLE IF NOT EXISTS agenda_months (
    year SMALLINT UNSIGNED NOT NULL,
    month_number TINYINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL DEFAULT '',
    subtitle VARCHAR(255) NOT NULL DEFAULT '',
    text_one LONGTEXT NOT NULL,
    text_two LONGTEXT NOT NULL,
    sections_json LONGTEXT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (year, month_number),
    CONSTRAINT chk_agenda_month CHECK (month_number BETWEEN 1 AND 12)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Tabla de informes institucionales
CREATE TABLE IF NOT EXISTS informes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    file_path VARCHAR(255) NOT NULL DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de permisos de documentos (roles que pueden acceder)
CREATE TABLE IF NOT EXISTS document_permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    document_id INT NOT NULL,
    role_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (document_id) REFERENCES documents(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    UNIQUE KEY unique_doc_role (document_id, role_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de mensajes de contacto
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar roles iniciales
INSERT INTO roles (name, label, description) VALUES 
('Superadmin', 'SuperAdministrador', 'Acceso completo al sistema'),
('Admin', 'Administrador', 'Acceso sistema'),
('Usuario', 'UsuarioFinal', 'Usuario Final');

-- Insertar usuario admin inicial (contraseña: admin123)
INSERT INTO users (name, email, password, role_id) VALUES 
('Sebastian Gomez', 'zvzgmzq@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1);

