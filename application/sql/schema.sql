-- ============================================================
-- Internmo / Resume Builder — Database Schema
-- DB: jobportal  (configured in application/config/database.php)
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------------------------------------
-- roles
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `roles` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(50)  NOT NULL,
    `slug`       VARCHAR(50)  NOT NULL,
    `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_roles_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `slug`) VALUES
    (1, 'Admin', 'admin'),
    (2, 'User',  'user')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- ------------------------------------------------------------
-- users   (matches the schema you shared)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
    `id`                         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `role_id`                    INT UNSIGNED NOT NULL DEFAULT 2,
    `email`                      VARCHAR(190) NOT NULL,
    `password_hash`              VARCHAR(255) NOT NULL,
    `full_name`                  VARCHAR(150) NOT NULL,
    `mobile`                     VARCHAR(20)  NULL,
    `avatar_path`                VARCHAR(255) NULL,
    `email_verified_at`          DATETIME     NULL,
    `email_verify_token`         VARCHAR(100) NULL,
    `password_reset_token`       VARCHAR(100) NULL,
    `password_reset_expires_at`  DATETIME     NULL,
    `last_login_at`              DATETIME     NULL,
    `created_at`                 DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`                 DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at`                 DATETIME     NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_users_email` (`email`),
    KEY `idx_users_role` (`role_id`),
    KEY `idx_users_deleted` (`deleted_at`),
    CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- resume_templates  (drop+create so schema is always current)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `resumes`;
DROP TABLE IF EXISTS `resume_templates`;

CREATE TABLE `resume_templates` (
    `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `slug`          VARCHAR(60)  NOT NULL,
    `name`          VARCHAR(100) NOT NULL,
    `description`   VARCHAR(255) NULL,
    `preview_image` VARCHAR(255) NULL,
    `category`      VARCHAR(50)  NOT NULL DEFAULT 'professional',
    `is_active`     TINYINT(1)   NOT NULL DEFAULT 1,
    `sort_order`    INT          NOT NULL DEFAULT 0,
    `created_at`    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_templates_slug` (`slug`),
    KEY `idx_templates_active` (`is_active`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `resume_templates` (`slug`, `name`, `description`, `category`, `is_active`, `sort_order`) VALUES
    ('modern',  'Modern',  'Clean two-column layout with subtle color accents',     'professional', 1, 1),
    ('classic', 'Classic', 'Traditional single-column layout, formal and timeless', 'professional', 1, 2),
    ('minimal', 'Minimal', 'Ultra-clean ATS-friendly layout with maximum readability', 'minimal',   1, 3)
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- ------------------------------------------------------------
-- resumes  (already dropped above with templates)
-- ------------------------------------------------------------
CREATE TABLE `resumes` (
    `id`             INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`        INT UNSIGNED NOT NULL,
    `template_id`    INT UNSIGNED NOT NULL DEFAULT 1,
    `title`          VARCHAR(150) NOT NULL DEFAULT 'My Resume',
    `color_primary` VARCHAR(7)   NOT NULL DEFAULT '#2563eb',
    `color_accent`   VARCHAR(7)   NOT NULL DEFAULT '#1e40af',
    `font_family`    VARCHAR(60)  NOT NULL DEFAULT 'Inter',
    `data`           LONGTEXT     NULL COMMENT 'JSON: sections data',
    `is_public`      TINYINT(1)   NOT NULL DEFAULT 0,
    `public_slug`    VARCHAR(100) NULL,
    `created_at`     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at`     DATETIME     NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_resumes_public_slug` (`public_slug`),
    KEY `idx_resumes_user` (`user_id`),
    KEY `idx_resumes_template` (`template_id`),
    KEY `idx_resumes_deleted` (`deleted_at`),
    CONSTRAINT `fk_resumes_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_resumes_template` FOREIGN KEY (`template_id`) REFERENCES `resume_templates`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- activity_logs  (for admin analytics, login/usage tracking)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`    INT UNSIGNED    NULL,
    `action`     VARCHAR(80)     NOT NULL,
    `meta`       VARCHAR(255)    NULL,
    `ip`         VARCHAR(45)     NULL,
    `user_agent` VARCHAR(255)    NULL,
    `created_at` DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_logs_user` (`user_id`),
    KEY `idx_logs_action` (`action`),
    KEY `idx_logs_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- Admin user is seeded by visiting:
--   {base_url}/setup/seed
-- (one-time route in application/controllers/Setup.php)
-- Default credentials after seeding:
--   admin: admin@internmo.com / Admin@123
--   user:  demo@internmo.com  / Demo@123
-- DELETE the Setup controller after seeding for security.
-- ============================================================
