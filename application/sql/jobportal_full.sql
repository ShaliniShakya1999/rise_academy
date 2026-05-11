-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2026 at 10:13 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_activity_logs`
--

DROP TABLE IF EXISTS `admin_activity_logs`;
CREATE TABLE IF NOT EXISTS `admin_activity_logs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_user_id` int UNSIGNED NOT NULL,
  `action` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity_id` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_json` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `aal_admin` (`admin_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_activity_logs`
--

INSERT INTO `admin_activity_logs` (`id`, `admin_user_id`, `action`, `entity`, `entity_id`, `meta_json`, `ip_address`, `created_at`) VALUES
(1, 1, 'block_user', 'users', '4', NULL, '127.0.0.1', '2026-05-06 22:00:45'),
(2, 1, 'unblock_user', 'users', '4', NULL, '127.0.0.1', '2026-05-06 22:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `ats_reports`
--

DROP TABLE IF EXISTS `ats_reports`;
CREATE TABLE IF NOT EXISTS `ats_reports` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `upload_id` int UNSIGNED DEFAULT NULL,
  `job_description` text COLLATE utf8mb4_unicode_ci,
  `extracted_text` mediumtext COLLATE utf8mb4_unicode_ci,
  `score` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `report_json` json NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ats_user` (`user_id`),
  KEY `ats_upload` (`upload_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ats_reports`
--

INSERT INTO `ats_reports` (`id`, `user_id`, `upload_id`, `job_description`, `extracted_text`, `score`, `report_json`, `created_at`) VALUES
(1, 2, 1, '', '', 35, '{\"score\": 35, \"resume_length\": 0, \"matched_keywords\": [], \"missing_keywords\": []}', '2026-05-06 18:04:30'),
(2, 4, 2, '', '', 35, '{\"score\": 35, \"resume_length\": 0, \"matched_keywords\": [], \"missing_keywords\": []}', '2026-05-07 10:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
CREATE TABLE IF NOT EXISTS `certificates` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `course_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issued_at` date NOT NULL,
  `verify_code` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cert_verify` (`verify_code`),
  KEY `cert_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('1ik537eclvghaec3l1hmo39f0i96c8mg', '::1', 1778161072, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136313037323b),
('24cbaakh4ahunm6b4a25mkub6ifvvoha', '::1', 1778156175, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383135363137353b),
('4176b6jai2609nc4ddmpv7iknbjfip33', '::1', 1778162502, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136323530323b757365725f69647c693a343b726f6c655f736c75677c733a343a2275736572223b),
('4sbo55o2if56tdncgj8n8dh9264l08v3', '::1', 1778155806, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383135353830363b),
('54v1rjtp0llk6h575i5v2ijjclnmmjkb', '::1', 1778161416, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136313431363b),
('5i5i94t9kd29m9s4enlc0gl47ulh69tc', '::1', 1778159302, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383135393330323b),
('5vjv4juh5t7tpgl1qkttkuq5vsbbiksj', '::1', 1778157267, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383135373236373b),
('78gg463rtnsoiu31k3eqlhka273p298m', '::1', 1778158729, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383135383732393b),
('7cc3ajlld5ei7r38rbd53kpc8pb65gf5', '::1', 1778160366, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136303336363b),
('7n8e7tbvu5ohrcv0hq699c9jb8eh756v', '::1', 1778156955, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383135363935353b),
('8rig6mpj6l7i9i68bvabgvl06gfcb888', '::1', 1778166531, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136363332323b757365725f69647c693a313b726f6c655f736c75677c733a353a2261646d696e223b),
('9f6c6li84m7dnvbrhmn35f2n2s0edp8j', '::1', 1778160652, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136303635323b),
('9u3n8trgld7q3t76loeuon6dnibausn4', '::1', 1778159441, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383135393434313b),
('b2avrlc1a2ji3kk1bg25olruvl8mcj4h', '::1', 1778160008, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136303030383b),
('d19t1eku6p9oj614sdlmp27i1e2hj6gu', '::1', 1778166322, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136363332323b757365725f69647c693a313b726f6c655f736c75677c733a353a2261646d696e223b),
('dj6brfadqg23eor3cctvvbhlqh42lbgt', '::1', 1778155750, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383135353735303b),
('du77oevonj063vr7nk2ikpk6fspdcf33', '::1', 1778160389, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136303336363b),
('fs9cvds09damqbu2gmabp2h1nb2ol0cj', '::1', 1778159113, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383135393131333b),
('hr84gilth4d24a4qulpke8bmmscvk6ge', '::1', 1778166017, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136363031373b757365725f69647c693a313b726f6c655f736c75677c733a353a2261646d696e223b),
('itmi5a5q4kogncqo4un1n8o14098b98a', '::1', 1778163129, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136333132393b757365725f69647c693a313b726f6c655f736c75677c733a353a2261646d696e223b),
('j0458hn57oc6scuabafqic6i0irali5v', '::1', 1778156636, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383135363633363b),
('m1j34otaoufp16tcfl7mmpfp1mjd3htj', '::1', 1778161755, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136313735353b757365725f69647c693a343b726f6c655f736c75677c733a343a2275736572223b),
('qqq48r31ava0hh8bgjcqvst29i0stjl7', '::1', 1778156173, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383135363137333b),
('sebnms3lt4dpcat5imau7jcir591cq7h', '::1', 1778160350, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136303335303b),
('sfmn3qdt60o6o254ubnbjg7c4k0ud6hi', '::1', 1778158694, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383135383639343b),
('tm6mp2im7hqhelgomengd4eeopk30q5r', '::1', 1778162808, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136323830383b757365725f69647c693a343b726f6c655f736c75677c733a343a2275736572223b),
('u21tn8mkdopfqklhbmp1c2sgdg6qot28', '::1', 1778162122, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737383136323132323b757365725f69647c693a343b726f6c655f736c75677c733a343a2275736572223b);

-- --------------------------------------------------------

--
-- Table structure for table `internships`
--

DROP TABLE IF EXISTS `internships`;
CREATE TABLE IF NOT EXISTS `internships` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `category` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'internship',
  `stipend_label` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_weeks` smallint UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `logo_text` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT 'IN',
  `is_remote` tinyint(1) NOT NULL DEFAULT '0',
  `search_blob` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `internships_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `internships`
--

INSERT INTO `internships` (`id`, `title`, `company`, `location`, `category`, `stipend_label`, `duration_weeks`, `description`, `requirements`, `logo_text`, `is_remote`, `search_blob`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Product Design Intern', 'Studio Nine', 'Hyderabad', 'design', '₹18k / month', 12, 'Ship UI explorations for career discovery flows.', 'Figma, prototyping basics.', 'S9', 0, 'product design figma hyderabad studio nine', '2026-05-06 16:23:10', '2026-05-06 16:23:10', NULL),
(2, 'Marketing Intern', 'Bright Reach', 'Remote', 'marketing', '₹15k / month', 8, 'Create internship campaigns and partner outreach.', 'Content writing, analytics curiosity.', 'BR', 1, 'marketing remote bright reach', '2026-05-06 16:23:10', '2026-05-06 16:23:10', NULL),
(3, 'Backend Intern', 'Ledger Tech', 'Chennai', 'engineering', '₹22k / month', 16, 'API development with PHP/MySQL services.', 'PHP, SQL, Git.', 'LT', 0, 'backend php mysql chennai ledger tech', '2026-05-06 16:23:10', '2026-05-06 16:23:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `internship_applications`
--

DROP TABLE IF EXISTS `internship_applications`;
CREATE TABLE IF NOT EXISTS `internship_applications` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `internship_id` int UNSIGNED NOT NULL,
  `cover_note` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_unique` (`user_id`,`internship_id`),
  KEY `ia_internship` (`internship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `category` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `employment_type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'full-time',
  `salary_label` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_min` int DEFAULT NULL,
  `salary_max` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `logo_text` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT 'CO',
  `is_remote` tinyint(1) NOT NULL DEFAULT '0',
  `search_blob` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_category` (`category`),
  KEY `jobs_location` (`location`(100))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `company`, `location`, `category`, `employment_type`, `salary_label`, `salary_min`, `salary_max`, `description`, `requirements`, `logo_text`, `is_remote`, `search_blob`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Frontend Engineer', 'Rise Partners', 'Gurugram', 'engineering', 'full-time', '₹18–22 LPA', 1800000, 2200000, 'Build responsive dashboards and job portal surfaces.', 'React, TypeScript, REST APIs.', 'RP', 0, 'frontend engineer react typescript gurugram rise partners', '2026-05-06 16:23:10', '2026-05-06 16:23:10', NULL),
(2, 'Data Analyst Intern', 'Insight Labs', 'Pune', 'data', 'internship', '₹25k stipend', NULL, NULL, 'Analyze hiring funnel metrics and internship conversions.', 'SQL, Excel, storytelling.', 'IL', 1, 'data analyst sql pune remote insight labs', '2026-05-06 16:23:10', '2026-05-06 16:23:10', NULL),
(3, 'HR Business Partner', 'Northwind HR', 'Noida', 'hr', 'full-time', '₹12–15 LPA', 1200000, 1500000, 'Partner with hiring managers on campus and lateral hiring.', 'Stakeholder management, ATS familiarity.', 'NH', 0, 'hr business partner noida northwind', '2026-05-06 16:23:10', '2026-05-06 16:23:10', NULL),
(4, 'DevOps Engineer', 'Skyline Cloud', 'Bengaluru', 'engineering', 'full-time', '₹22–28 LPA', 2200000, 2800000, 'CI/CD, observability, container orchestration.', 'Kubernetes, Terraform, Linux.', 'SC', 1, 'devops kubernetes terraform bengaluru remote skyline', '2026-05-06 16:23:10', '2026-05-06 16:23:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

DROP TABLE IF EXISTS `job_applications`;
CREATE TABLE IF NOT EXISTS `job_applications` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `job_id` int UNSIGNED NOT NULL,
  `cover_note` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ja_unique` (`user_id`,`job_id`),
  KEY `ja_job` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_activity_logs`
--

DROP TABLE IF EXISTS `login_activity_logs`;
CREATE TABLE IF NOT EXISTS `login_activity_logs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED DEFAULT NULL,
  `email_attempt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `success` tinyint(1) NOT NULL DEFAULT '0',
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `lal_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_activity_logs`
--

INSERT INTO `login_activity_logs` (`id`, `user_id`, `email_attempt`, `ip_address`, `user_agent`, `success`, `message`, `created_at`) VALUES
(1, 2, 'user@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-06 16:41:30'),
(2, 2, 'user@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-06 16:41:54'),
(3, 2, 'user@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-06 16:46:49'),
(4, 1, 'admin@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-06 17:00:44'),
(5, 1, 'admin@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8115', 1, 'OK', '2026-05-06 17:02:23'),
(6, 4, 'shakyashalini1999@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-06 17:06:48'),
(7, 4, 'shakyashalini1999@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-06 17:21:20'),
(8, NULL, 'admin@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 0, 'Invalid credentials', '2026-05-06 17:28:00'),
(9, NULL, 'admin@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 0, 'Invalid credentials', '2026-05-06 17:28:09'),
(10, 1, 'admin@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-06 17:29:36'),
(11, 1, 'admin@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8115', 1, 'OK', '2026-05-06 17:36:40'),
(12, 2, 'user@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-06 18:03:12'),
(13, 1, 'admin@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8115', 1, 'OK', '2026-05-06 21:40:13'),
(14, 1, 'admin@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8115', 1, 'OK', '2026-05-06 21:41:07'),
(15, 1, 'admin@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8115', 1, 'OK', '2026-05-06 21:41:50'),
(16, 1, 'admin@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-IN) WindowsPowerShell/5.1.26100.8115', 1, 'OK', '2026-05-06 21:42:13'),
(17, 1, 'admin@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-06 21:46:46'),
(18, 2, 'user@example.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-07 08:51:34'),
(19, 4, 'shakyashalini1999@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-07 09:10:36'),
(20, 4, 'shakyashalini1999@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-07 09:33:24'),
(21, 4, 'shakyashalini1999@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-07 19:18:20'),
(22, 1, 'admin@example.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-07 19:40:03'),
(23, 1, 'admin@example.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-07 19:43:14'),
(24, 1, 'admin@example.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 1, 'OK', '2026-05-07 20:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED DEFAULT NULL,
  `channel` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in_app',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `read_at` datetime DEFAULT NULL,
  `meta_json` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `notif_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `provider` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'razorpay',
  `provider_order_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_payment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_paise` int UNSIGNED NOT NULL DEFAULT '0',
  `currency` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INR',
  `status` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'created',
  `purpose` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'internship_fee',
  `raw_json` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pay_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resumes`
--

DROP TABLE IF EXISTS `resumes`;
CREATE TABLE IF NOT EXISTS `resumes` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `template_id` smallint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'My Resume',
  `completion_score` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resumes_user` (`user_id`),
  KEY `resumes_template` (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resumes`
--

INSERT INTO `resumes` (`id`, `user_id`, `template_id`, `title`, `completion_score`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, NULL, 'My Resume', 0, '2026-05-07 09:06:01', '2026-05-07 09:06:01', NULL),
(2, 4, 2, 'Shalini Shakya Resume', 100, '2026-05-07 09:33:49', '2026-05-07 10:16:17', NULL),
(3, 1, NULL, 'My Resume', 0, '2026-05-07 20:35:48', '2026-05-07 20:35:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resume_downloads`
--

DROP TABLE IF EXISTS `resume_downloads`;
CREATE TABLE IF NOT EXISTS `resume_downloads` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `resume_id` int UNSIGNED NOT NULL,
  `format` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pdf',
  `file_path` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `rd_user` (`user_id`),
  KEY `rd_resume` (`resume_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resume_downloads`
--

INSERT INTO `resume_downloads` (`id`, `user_id`, `resume_id`, `format`, `file_path`, `created_at`) VALUES
(1, 2, 1, 'pdf', 'D:/project/peyug_project/crm/study/uploads/pdf/resume-1-1778124962.pdf', '2026-05-07 09:06:05'),
(2, 2, 1, 'pdf', 'D:/project/peyug_project/crm/study/uploads/pdf/resume-1-1778124965.pdf', '2026-05-07 09:06:07'),
(3, 2, 1, 'pdf', 'D:/project/peyug_project/crm/study/uploads/pdf/resume-1-1778124970.pdf', '2026-05-07 09:06:12'),
(4, 2, 1, 'pdf', 'D:/project/peyug_project/crm/study/uploads/pdf/resume-1-1778124972.pdf', '2026-05-07 09:06:13'),
(5, 4, 2, 'pdf', 'D:/project/peyug_project/crm/study/uploads/pdf/resume-2-1778127770.pdf', '2026-05-07 09:52:52'),
(6, 4, 2, 'pdf', 'D:/project/peyug_project/crm/study/uploads/pdf/resume-2-1778127791.pdf', '2026-05-07 09:53:12'),
(7, 4, 2, 'pdf', 'D:/project/peyug_project/crm/study/uploads/pdf/resume-2-1778128120.pdf', '2026-05-07 09:58:41'),
(8, 4, 2, 'pdf', 'uploads/pdf/resume-2-1778128422.pdf', '2026-05-07 10:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `resume_sections`
--

DROP TABLE IF EXISTS `resume_sections`;
CREATE TABLE IF NOT EXISTS `resume_sections` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `resume_id` int UNSIGNED NOT NULL,
  `section_key` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_json` json NOT NULL,
  `sort_order` smallint NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resume_sections_unique` (`resume_id`,`section_key`),
  KEY `resume_sections_resume` (`resume_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resume_sections`
--

INSERT INTO `resume_sections` (`id`, `resume_id`, `section_key`, `section_json`, `sort_order`, `updated_at`) VALUES
(1, 2, 'header', '{\"name\": \"Shalini Shakya\", \"email\": \"sarah@example.com\", \"phone\": \"06392442891\"}', 0, '2026-05-07 10:16:17'),
(2, 2, 'summary', '{\"text\": \"Product designer with 4 years of SaaS experience designing onboarding, dashboards, and conversion-focused product experiences.\"}', 1, '2026-05-07 09:51:28'),
(3, 2, 'education', '{\"items\": [{\"tags\": [\"CGPA 8.7\", \"Passing Year 2021\", \"Semester 8\"], \"title\": \"B.Des, Interaction Design\", \"subtitle\": \"National Institute of Design · UI/UX Specialization\"}, {\"tags\": [\"Percentage 91%\", \"Passing Year 2017\", \"Regular\"], \"title\": \"Senior Secondary\", \"subtitle\": \"Delhi Public School · Commerce with Informatics\"}]}', 2, '2026-05-07 10:17:03'),
(4, 2, 'experience', '{\"items\": [{\"type\": \"Full Time\", \"title\": \"Lead Product Designer\", \"period\": \"Jan 2023 - Present\", \"subtitle\": \"Framerly Studio · Gurugram · Hybrid\", \"description\": \"Designed onboarding and analytics dashboards, improving activation by 18% and reducing support tickets by 22%.\"}, {\"type\": \"Internship\", \"title\": \"UX Research Intern\", \"period\": \"Jun 2021 - Dec 2021\", \"subtitle\": \"Canva Labs · Remote\", \"description\": \"Conducted usability studies and converted insights into low-friction resume editor improvements.\"}]}', 3, '2026-05-07 09:51:27'),
(5, 2, 'skills', '{\"items\": [{\"name\": \"UX Research\", \"tags\": [\"Product\", \"Research\"], \"percent\": 92}, {\"name\": \"Figma & Prototyping\", \"tags\": [\"Design\", \"Prototype\"], \"percent\": 96}, {\"name\": \"Design Systems\", \"tags\": [\"UI\", \"SaaS\"], \"percent\": 88}, {\"name\": \"Data-driven UX\", \"tags\": [\"Analytics\", \"A/B Testing\"], \"percent\": 82}], \"language_tags\": [\"Hindi Native\", \"English Professional\", \"Spanish Beginner\", \"Human Computer Interaction\"]}', 4, '2026-05-07 09:51:27'),
(6, 2, 'clubs', '{\"items\": [{\"tags\": [\"Leadership\", \"2020-2021\"], \"title\": \"Design Club President\", \"description\": \"Led 28 members and organized monthly product design critiques.\"}, {\"tags\": [\"Mentorship\", \"Product\"], \"title\": \"Innovation Cell\", \"description\": \"Mentored student teams on research, prototyping, and pitch decks.\"}]}', 5, '2026-05-07 09:51:27'),
(7, 2, 'projects', '{\"items\": [{\"tags\": [\"Figma\", \"UX Research\", \"Design System\", \"8 weeks\"], \"title\": \"AI Resume Builder Redesign\", \"description\": \"Designed a multi-step resume workflow with real-time ATS scoring and template preview.\"}, {\"tags\": [\"SaaS\", \"Charts\", \"Accessibility\", \"6 weeks\"], \"title\": \"Recruiter Analytics Dashboard\", \"description\": \"Created KPI dashboards for hiring teams with candidate funnel, scorecards, and alerts.\"}]}', 6, '2026-05-07 09:51:27'),
(8, 2, 'achievements', '{\"items\": [{\"icon\": \"certificate\", \"type\": \"Certification\", \"title\": \"Google UX Design Certificate\", \"dateLabel\": \"Mar 2024\", \"description\": \"Completed advanced specialization in UX process, research and portfolio.\"}, {\"icon\": \"award\", \"type\": \"Competition\", \"title\": \"National Design Challenge Winner\", \"dateLabel\": \"Aug 2023\", \"description\": \"Awarded for accessible fintech onboarding design concept.\"}, {\"icon\": \"chalkboard-user\", \"type\": \"Workshop\", \"title\": \"Design Systems Workshop\", \"dateLabel\": \"Jan 2024\", \"description\": \"Hands-on workshop covering tokens, components and governance.\"}, {\"icon\": \"medal\", \"type\": \"Scholarship\", \"title\": \"Merit Scholarship\", \"dateLabel\": \"2021\", \"description\": \"Awarded for academic excellence and design leadership.\"}]}', 7, '2026-05-07 09:51:27'),
(9, 2, 'volunteering', '{\"items\": []}', 8, '2026-05-07 09:51:27'),
(10, 2, 'extra_curricular', '{\"items\": []}', 9, '2026-05-07 09:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `resume_templates`
--

DROP TABLE IF EXISTS `resume_templates`;
CREATE TABLE IF NOT EXISTS `resume_templates` (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resume_templates_slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resume_templates`
--

INSERT INTO `resume_templates` (`id`, `slug`, `name`, `description`, `is_active`, `created_at`) VALUES
(1, 'modern', 'Modern', 'Clean two-column layout', 1, '2026-05-06 16:23:10'),
(2, 'classic', 'Classic', 'Traditional single column', 1, '2026-05-06 16:23:10'),
(3, 'compact', 'Compact', 'Dense single page', 1, '2026-05-06 16:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`) VALUES
(1, 'Administrator', 'admin', '2026-05-06 16:23:10'),
(2, 'User', 'user', '2026-05-06 16:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED DEFAULT NULL,
  `disk_path` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_bytes` int UNSIGNED NOT NULL DEFAULT '0',
  `purpose` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `uploads_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `user_id`, `disk_path`, `original_name`, `mime_type`, `size_bytes`, `purpose`, `created_at`) VALUES
(1, 2, 'uploads/ats/ats-2-1778070870-Shakya__Developer.docx', 'Shakya__Developer.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 34406, 'ats', '2026-05-06 18:04:30'),
(2, 4, 'uploads/ats/ats-4-1778129437-Shakya__Developer__2_.docx', 'Shakya__Developer (2).docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 34406, 'ats', '2026-05-07 10:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` tinyint UNSIGNED NOT NULL DEFAULT '2',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mobile` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `email_verify_token` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_expires_at` datetime DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `email`, `password_hash`, `full_name`, `mobile`, `avatar_path`, `email_verified_at`, `email_verify_token`, `password_reset_token`, `password_reset_expires_at`, `last_login_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'admin@example.com', '$2y$10$pRD7/qwck.Q3CmhbaXs6YOOSgygIahx3Mec1DjN804q7jUNzQC.lW', 'Admin User', '9990000000', NULL, '2026-05-06 16:23:10', NULL, NULL, NULL, '2026-05-11 09:36:35', '2026-05-06 16:23:10', '2026-05-11 09:36:35', NULL),
(2, 2, 'user@example.com', '$2y$10$MyXjlWHBUBGp.a6qNJd9K.0rSX3UWQPm4Zr1W8bUittbLMarQNTSG', 'Priya Sharma', '9898989898', NULL, '2026-05-06 16:23:10', NULL, NULL, NULL, '2026-05-07 03:21:34', '2026-05-06 16:23:10', '2026-05-07 08:51:34', NULL),
(3, 2, 'flowtest_242646885@example.com', '$2y$10$VSSSxAE/NVywalRcx4Eod.xbGVZ3yFWBkvvgd8SNIQ8kmJmkBiFUe', 'Flow Test User', '9999999999', NULL, NULL, '596ed3ee573279c352a95d87aaec7b5f0ef19d5dd7105aee', NULL, NULL, NULL, '2026-05-06 17:02:22', '2026-05-06 17:02:22', NULL),
(4, 2, 'shakyashalini1999@gmail.com', '$2y$10$YT7xUmlEZNy1PB3Nov2MFeJgjrPTRd69CMCWahVRcXjZBHHKfAGs6', 'Shalini Shakya', '06392442891', NULL, NULL, 'f45440177f72e3858247d0d913fcc5a30a186d75b804f486', NULL, NULL, '2026-05-11 10:09:57', '2026-05-06 17:06:37', '2026-05-11 10:09:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `headline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills_json` json DEFAULT NULL,
  `social_json` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_profiles_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `headline`, `summary`, `location`, `skills_json`, `social_json`, `created_at`, `updated_at`) VALUES
(1, 2, 'Aspiring Software Engineer', NULL, 'Bengaluru', '[\"JavaScript\", \"MySQL\", \"Communication\"]', NULL, '2026-05-06 16:23:10', '2026-05-06 16:23:10'),
(2, 3, '', NULL, '', NULL, NULL, '2026-05-06 17:02:22', '2026-05-06 17:02:22'),
(3, 4, '', NULL, '', NULL, NULL, '2026-05-06 17:06:37', '2026-05-06 17:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_items`
--

DROP TABLE IF EXISTS `wishlist_items`;
CREATE TABLE IF NOT EXISTS `wishlist_items` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `item_type` enum('job','internship') COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `snapshot_json` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlist_unique` (`user_id`,`item_type`,`item_id`),
  KEY `wishlist_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist_items`
--

INSERT INTO `wishlist_items` (`id`, `user_id`, `item_type`, `item_id`, `snapshot_json`, `created_at`) VALUES
(1, 2, 'internship', 1, '{\"id\": \"internship-1\", \"logo\": \"S9\", \"type\": \"internship\", \"title\": \"Product Design Intern\", \"salary\": \"₹18k / month\", \"company\": \"Studio Nine\", \"location\": \"Hyderabad\", \"savedDate\": \"06 May 2026\"}', '2026-05-06 20:50:22'),
(2, 4, 'job', 901, '{\"id\": \"job-901\", \"logo\": \"SC\", \"type\": \"job\", \"title\": \"Content & Social Media Executive\", \"salary\": \"₹3,00,000 - ₹5,00,000\", \"company\": \"Sparsh CCTV\", \"item_id\": 901, \"location\": \"Noida Uttar Pradesh\", \"savedDate\": \"07 May 2026\"}', '2026-05-07 09:33:25'),
(3, 4, 'internship', 1, '{\"id\": \"internship-1\", \"logo\": \"S9\", \"type\": \"internship\", \"title\": \"Product Design Intern\", \"salary\": \"₹18k / month\", \"company\": \"Studio Nine\", \"location\": \"Hyderabad\", \"savedDate\": \"07 May 2026\"}', '2026-05-07 10:14:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `internships`
--
ALTER TABLE `internships` ADD FULLTEXT KEY `internships_ft` (`title`,`company`,`search_blob`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs` ADD FULLTEXT KEY `jobs_ft` (`title`,`company`,`search_blob`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_activity_logs`
--
ALTER TABLE `admin_activity_logs`
  ADD CONSTRAINT `aal_admin_fk` FOREIGN KEY (`admin_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ats_reports`
--
ALTER TABLE `ats_reports`
  ADD CONSTRAINT `ats_upload_fk` FOREIGN KEY (`upload_id`) REFERENCES `uploads` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ats_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `cert_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `internship_applications`
--
ALTER TABLE `internship_applications`
  ADD CONSTRAINT `ia_internship_fk` FOREIGN KEY (`internship_id`) REFERENCES `internships` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ia_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `ja_job_fk` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ja_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `login_activity_logs`
--
ALTER TABLE `login_activity_logs`
  ADD CONSTRAINT `lal_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notif_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `pay_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resumes`
--
ALTER TABLE `resumes`
  ADD CONSTRAINT `resumes_template_fk` FOREIGN KEY (`template_id`) REFERENCES `resume_templates` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `resumes_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resume_downloads`
--
ALTER TABLE `resume_downloads`
  ADD CONSTRAINT `rd_resume_fk` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rd_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resume_sections`
--
ALTER TABLE `resume_sections`
  ADD CONSTRAINT `resume_sections_resume_fk` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD CONSTRAINT `wishlist_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
