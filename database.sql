-- Sistema Integral para el Control Financiero y Administrativo - Academia Conduser
-- Base de datos MySQL

-- Crear base de datos
CREATE DATABASE IF NOT EXISTS `conduser_academy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `conduser_academy`;

-- Tabla users
CREATE TABLE `users` (
    `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password` varchar(255) NOT NULL,
    `role` enum('root','administrador','colaborador') NOT NULL DEFAULT 'colaborador',
    `status` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
    `remember_token` varchar(100) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla movements
CREATE TABLE `movements` (
    `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    `amount` decimal(10,2) NOT NULL,
    `type` enum('ingreso','egreso') NOT NULL,
    `date` date NOT NULL,
    `associated_to` varchar(255) DEFAULT NULL,
    `description` text NOT NULL,
    `user_id` bigint UNSIGNED NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `movements_user_id_foreign` (`user_id`),
    CONSTRAINT `movements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar usuario root inicial
INSERT INTO `users` (`name`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`) 
VALUES (
    'Usuario Root', 
    'root@conduser.com', 
    '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- password123
    'root', 
    'activo', 
    NOW(), 
    NOW()
);

-- Crear tabla de sesiones para Laravel
CREATE TABLE `sessions` (
    `id` varchar(255) NOT NULL,
    `user_id` bigint UNSIGNED DEFAULT NULL,
    `ip_address` varchar(45) DEFAULT NULL,
    `user_agent` text DEFAULT NULL,
    `payload` longtext NOT NULL,
    `last_activity` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY `sessions_user_id_index` (`user_id`),
    KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de migraciones para Laravel
CREATE TABLE `migrations` (
    `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
    `migration` varchar(255) NOT NULL,
    `batch` int NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
