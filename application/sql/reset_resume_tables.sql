-- ============================================================
-- Reset resume-related tables (run THIS in phpMyAdmin)
--
-- Safe to run: drops only tables that don't yet hold user data.
-- It does NOT touch your `users` or `roles` tables.
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `resumes`;
DROP TABLE IF EXISTS `resume_templates`;
DROP TABLE IF EXISTS `activity_logs`;

-- ------------------------------------------------------------
-- resume_templates
-- ------------------------------------------------------------
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
    ('minimal', 'Minimal', 'Ultra-clean ATS-friendly layout with maximum readability', 'minimal',   1, 3);

-- ------------------------------------------------------------
-- resumes
-- ------------------------------------------------------------
CREATE TABLE `resumes` (
    `id`             INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`        INT UNSIGNED NOT NULL,
    `template_id`    INT UNSIGNED NOT NULL DEFAULT 1,
    `title`          VARCHAR(150) NOT NULL DEFAULT 'My Resume',
    `color_primary`  VARCHAR(7)   NOT NULL DEFAULT '#2563eb',
    `color_accent`   VARCHAR(7)   NOT NULL DEFAULT '#1e40af',
    `font_family`    VARCHAR(60)  NOT NULL DEFAULT 'Inter',
    `data`           LONGTEXT     NULL,
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
    CONSTRAINT `fk_resumes_user`     FOREIGN KEY (`user_id`)     REFERENCES `users`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_resumes_template` FOREIGN KEY (`template_id`) REFERENCES `resume_templates`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- activity_logs
-- ------------------------------------------------------------
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
