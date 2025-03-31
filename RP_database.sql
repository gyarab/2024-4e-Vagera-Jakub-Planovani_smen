-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Úte 01. dub 2025, 00:13
-- Verze serveru: 8.0.41-0ubuntu0.20.04.1
-- Verze PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `RP_database`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `attendance`
--

CREATE TABLE `attendance` (
  `id_attendance` int NOT NULL,
  `id_planned` int NOT NULL,
  `log_from` time DEFAULT NULL,
  `log_to` time DEFAULT NULL,
  `pause_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pause_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id` int NOT NULL,
  `com_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `com_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `delay_arr` int DEFAULT NULL,
  `delay_dep` int DEFAULT NULL,
  `planned_from` time DEFAULT NULL,
  `planned_to` time DEFAULT NULL,
  `comment_on` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_shift` int DEFAULT NULL,
  `saved_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `board`
--

CREATE TABLE `board` (
  `id_board` int NOT NULL,
  `caption` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `employee_full` int NOT NULL,
  `employee_part` int NOT NULL,
  `management` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `created_by` int NOT NULL,
  `image_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `board_logs`
--

CREATE TABLE `board_logs` (
  `id_board_log` int NOT NULL,
  `timestamp_at` timestamp NOT NULL,
  `made_by` int NOT NULL,
  `id_board` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `favorite_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint NOT NULL,
  `to_id` bigint NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `devices`
--

CREATE TABLE `devices` (
  `id_device` bigint UNSIGNED NOT NULL,
  `description_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `edit_logs`
--

CREATE TABLE `edit_logs` (
  `id_edit` int NOT NULL,
  `id` int NOT NULL,
  `timestamp_at` timestamp NOT NULL,
  `made_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `management_rights`
--

CREATE TABLE `management_rights` (
  `id_right` int NOT NULL,
  `id` int NOT NULL,
  `id_object` int NOT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `management_rights_logs`
--

CREATE TABLE `management_rights_logs` (
  `id_right_logs` int NOT NULL,
  `id` int NOT NULL,
  `timestamp_at` timestamp NOT NULL,
  `made_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `object_model`
--

CREATE TABLE `object_model` (
  `id_object` int NOT NULL,
  `object_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `superior_object_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `object_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `delete_status` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `permanent_time_options`
--

CREATE TABLE `permanent_time_options` (
  `id_permanent` int NOT NULL,
  `monday` int NOT NULL,
  `mon_from` time NOT NULL,
  `mon_to` time NOT NULL,
  `tuesday` int NOT NULL,
  `tue_from` time NOT NULL,
  `tue_to` time NOT NULL,
  `wednesday` int NOT NULL,
  `wed_from` time NOT NULL,
  `wed_to` time NOT NULL,
  `thursday` int NOT NULL,
  `thu_from` time NOT NULL,
  `thu_to` time NOT NULL,
  `friday` int NOT NULL,
  `fri_from` time NOT NULL,
  `fri_to` time NOT NULL,
  `saturday` int NOT NULL,
  `sat_from` time NOT NULL,
  `sat_to` time NOT NULL,
  `sunday` int NOT NULL,
  `sun_from` time NOT NULL,
  `sun_to` time NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `permanent_time_options_logs`
--

CREATE TABLE `permanent_time_options_logs` (
  `id_permanent_logs` int NOT NULL,
  `id` int NOT NULL,
  `timestamp_at` timestamp NOT NULL,
  `made_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `profile_pictures`
--

CREATE TABLE `profile_pictures` (
  `id_picture` bigint UNSIGNED NOT NULL,
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `shift_active_data`
--

CREATE TABLE `shift_active_data` (
  `id_active` int NOT NULL,
  `id_planned` int NOT NULL,
  `saved_at` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_shift` int NOT NULL,
  `saved_from` time NOT NULL,
  `saved_to` time NOT NULL,
  `timestamp_update` int NOT NULL,
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `shift_assignment`
--

CREATE TABLE `shift_assignment` (
  `id_assignment` int NOT NULL,
  `id` int NOT NULL,
  `id_shift` int NOT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `shift_assignment_logs`
--

CREATE TABLE `shift_assignment_logs` (
  `id_assignment_logs` int NOT NULL,
  `id` int NOT NULL,
  `timestamp_at` timestamp NOT NULL,
  `made_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `shift_check`
--

CREATE TABLE `shift_check` (
  `id_check` int NOT NULL,
  `id_shift` int NOT NULL,
  `year_shift` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `month_shift` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `shift_model`
--

CREATE TABLE `shift_model` (
  `id_shift` int NOT NULL,
  `start_shift` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rep_non` int NOT NULL,
  `monday` int NOT NULL,
  `mon_from` time NOT NULL,
  `mon_to` time NOT NULL,
  `tuesday` int NOT NULL,
  `tue_from` time NOT NULL,
  `tue_to` time NOT NULL,
  `wednesday` int NOT NULL,
  `wed_from` time NOT NULL,
  `wed_to` time NOT NULL,
  `thursday` int NOT NULL,
  `thu_from` time NOT NULL,
  `thu_to` time NOT NULL,
  `friday` int NOT NULL,
  `fri_from` time NOT NULL,
  `fri_to` time NOT NULL,
  `saturday` int NOT NULL,
  `sat_from` time NOT NULL,
  `sat_to` time NOT NULL,
  `sunday` int NOT NULL,
  `sun_from` time NOT NULL,
  `sun_to` time NOT NULL,
  `shift_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_object` int NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `delete_status` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `shift_offer`
--

CREATE TABLE `shift_offer` (
  `id_offer` int NOT NULL,
  `id_shift` int NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` int NOT NULL,
  `created_by` int NOT NULL,
  `accepted_at` date DEFAULT NULL,
  `accepted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `shift_planned_data`
--

CREATE TABLE `shift_planned_data` (
  `id_planned` int NOT NULL,
  `saved_at` varchar(255) NOT NULL,
  `id` int DEFAULT NULL,
  `id_shift` int NOT NULL,
  `saved_from` time NOT NULL,
  `saved_to` time NOT NULL,
  `timestamp_update` int NOT NULL,
  `comments_on` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `shift_request`
--

CREATE TABLE `shift_request` (
  `id_request` int NOT NULL,
  `id_offer` int NOT NULL,
  `id` int NOT NULL,
  `requested_at` timestamp NOT NULL,
  `request_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `shift_stored_data`
--

CREATE TABLE `shift_stored_data` (
  `id` int NOT NULL,
  `saved_date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_of_shift` int NOT NULL,
  `saved_from` time NOT NULL,
  `saved_to` time NOT NULL,
  `up_timestamp` int NOT NULL,
  `id_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `time_options`
--

CREATE TABLE `time_options` (
  `id_option` int NOT NULL,
  `id` int NOT NULL,
  `saved_at` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `opt_from` time NOT NULL,
  `opt_to` time NOT NULL,
  `timestamp_update` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `phone_code` int DEFAULT NULL,
  `phone_number` int DEFAULT NULL,
  `delete_status` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `bio`, `active_status`, `avatar`, `dark_mode`, `messenger_color`, `status`, `phone_code`, `phone_number`, `delete_status`) VALUES
(1, 'Example', 'Test.', 'User', 'tester', 'example@gmail.com', '2024-12-27 14:14:43', '$2y$12$34fdU2mXMGxZyLZ2F7UhOeep5Vx/g.b/OylUPcDTRvRIEqzw/QB5m', 'GhLuKseEa1ogdtsmJCNsxWkKUQ7JS0A63PuJEyMnhgfa7QkVqUJ5EtKdesD6', '2024-11-09 20:07:19', '2025-01-26 16:28:47', 'admin', 'Main admin', 1, '46708c69-686e-4733-94c7-08bac317c60e.jpg', 0, '#2180f3', 1, 44, 1111, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `users_logs`
--

CREATE TABLE `users_logs` (
  `id_log` int NOT NULL,
  `id` int NOT NULL,
  `timestamp_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id_verification` int NOT NULL,
  `id` int NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id_attendance`);

--
-- Klíče pro tabulku `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`id_board`);

--
-- Klíče pro tabulku `board_logs`
--
ALTER TABLE `board_logs`
  ADD PRIMARY KEY (`id_board_log`);

--
-- Klíče pro tabulku `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Klíče pro tabulku `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Klíče pro tabulku `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id_device`),
  ADD UNIQUE KEY `devices_device_token_unique` (`device_token`);

--
-- Klíče pro tabulku `edit_logs`
--
ALTER TABLE `edit_logs`
  ADD PRIMARY KEY (`id_edit`);

--
-- Klíče pro tabulku `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Klíče pro tabulku `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Klíče pro tabulku `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `management_rights`
--
ALTER TABLE `management_rights`
  ADD PRIMARY KEY (`id_right`);

--
-- Klíče pro tabulku `management_rights_logs`
--
ALTER TABLE `management_rights_logs`
  ADD PRIMARY KEY (`id_right_logs`);

--
-- Klíče pro tabulku `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `object_model`
--
ALTER TABLE `object_model`
  ADD PRIMARY KEY (`id_object`);

--
-- Klíče pro tabulku `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Klíče pro tabulku `permanent_time_options`
--
ALTER TABLE `permanent_time_options`
  ADD PRIMARY KEY (`id_permanent`);

--
-- Klíče pro tabulku `permanent_time_options_logs`
--
ALTER TABLE `permanent_time_options_logs`
  ADD PRIMARY KEY (`id_permanent_logs`);

--
-- Klíče pro tabulku `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Klíče pro tabulku `profile_pictures`
--
ALTER TABLE `profile_pictures`
  ADD PRIMARY KEY (`id_picture`);

--
-- Klíče pro tabulku `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Klíče pro tabulku `shift_active_data`
--
ALTER TABLE `shift_active_data`
  ADD PRIMARY KEY (`id_active`);

--
-- Klíče pro tabulku `shift_assignment`
--
ALTER TABLE `shift_assignment`
  ADD PRIMARY KEY (`id_assignment`);

--
-- Klíče pro tabulku `shift_assignment_logs`
--
ALTER TABLE `shift_assignment_logs`
  ADD PRIMARY KEY (`id_assignment_logs`);

--
-- Klíče pro tabulku `shift_check`
--
ALTER TABLE `shift_check`
  ADD PRIMARY KEY (`id_check`);

--
-- Klíče pro tabulku `shift_model`
--
ALTER TABLE `shift_model`
  ADD PRIMARY KEY (`id_shift`);

--
-- Klíče pro tabulku `shift_offer`
--
ALTER TABLE `shift_offer`
  ADD PRIMARY KEY (`id_offer`);

--
-- Klíče pro tabulku `shift_planned_data`
--
ALTER TABLE `shift_planned_data`
  ADD PRIMARY KEY (`id_planned`);

--
-- Klíče pro tabulku `shift_request`
--
ALTER TABLE `shift_request`
  ADD PRIMARY KEY (`id_request`),
  ADD UNIQUE KEY `unique_index` (`id`,`id_offer`);

--
-- Klíče pro tabulku `shift_stored_data`
--
ALTER TABLE `shift_stored_data`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `time_options`
--
ALTER TABLE `time_options`
  ADD PRIMARY KEY (`id_option`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Klíče pro tabulku `users_logs`
--
ALTER TABLE `users_logs`
  ADD PRIMARY KEY (`id_log`);

--
-- Klíče pro tabulku `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`id_verification`),
  ADD UNIQUE KEY `verification_code` (`verification_code`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id_attendance` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `board`
--
ALTER TABLE `board`
  MODIFY `id_board` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `board_logs`
--
ALTER TABLE `board_logs`
  MODIFY `id_board_log` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `devices`
--
ALTER TABLE `devices`
  MODIFY `id_device` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `edit_logs`
--
ALTER TABLE `edit_logs`
  MODIFY `id_edit` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `management_rights`
--
ALTER TABLE `management_rights`
  MODIFY `id_right` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `management_rights_logs`
--
ALTER TABLE `management_rights_logs`
  MODIFY `id_right_logs` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `object_model`
--
ALTER TABLE `object_model`
  MODIFY `id_object` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `permanent_time_options`
--
ALTER TABLE `permanent_time_options`
  MODIFY `id_permanent` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `permanent_time_options_logs`
--
ALTER TABLE `permanent_time_options_logs`
  MODIFY `id_permanent_logs` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `profile_pictures`
--
ALTER TABLE `profile_pictures`
  MODIFY `id_picture` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `shift_active_data`
--
ALTER TABLE `shift_active_data`
  MODIFY `id_active` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `shift_assignment`
--
ALTER TABLE `shift_assignment`
  MODIFY `id_assignment` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `shift_assignment_logs`
--
ALTER TABLE `shift_assignment_logs`
  MODIFY `id_assignment_logs` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `shift_check`
--
ALTER TABLE `shift_check`
  MODIFY `id_check` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `shift_model`
--
ALTER TABLE `shift_model`
  MODIFY `id_shift` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `shift_offer`
--
ALTER TABLE `shift_offer`
  MODIFY `id_offer` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `shift_planned_data`
--
ALTER TABLE `shift_planned_data`
  MODIFY `id_planned` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `shift_request`
--
ALTER TABLE `shift_request`
  MODIFY `id_request` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `shift_stored_data`
--
ALTER TABLE `shift_stored_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `time_options`
--
ALTER TABLE `time_options`
  MODIFY `id_option` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pro tabulku `users_logs`
--
ALTER TABLE `users_logs`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id_verification` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
