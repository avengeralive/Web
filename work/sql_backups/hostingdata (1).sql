-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Хост: sql439.your-server.de
-- Время создания: Июл 06 2018 г., 13:31
-- Версия сервера: 5.6.35-1
-- Версия PHP: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hostingdata`
--

-- --------------------------------------------------------

--
-- Структура таблицы `casn_commentmeta`
--

CREATE TABLE `casn_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `casn_comments`
--

CREATE TABLE `casn_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `casn_links`
--

CREATE TABLE `casn_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `casn_options`
--

CREATE TABLE `casn_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `casn_options`
--

INSERT INTO `casn_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://gamescasino.win', 'yes'),
(2, 'home', 'http://gamescasino.win', 'yes'),
(3, 'blogname', 'Casino', 'yes'),
(4, 'blogdescription', 'Ещё один сайт на WordPress', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'office@aliveliyev.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '24', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '24', 'yes'),
(23, 'date_format', 'd.m.Y', 'yes'),
(24, 'time_format', 'H:i', 'yes'),
(25, 'links_updated_date_format', 'd.m.Y H:i', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:115:{s:10:\"casinos/?$\";s:27:\"index.php?post_type=casinos\";s:40:\"casinos/feed/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?post_type=casinos&feed=$matches[1]\";s:35:\"casinos/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?post_type=casinos&feed=$matches[1]\";s:27:\"casinos/page/([0-9]{1,})/?$\";s:45:\"index.php?post_type=casinos&paged=$matches[1]\";s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:47:\"casino/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:54:\"index.php?casino_category=$matches[1]&feed=$matches[2]\";s:42:\"casino/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:54:\"index.php?casino_category=$matches[1]&feed=$matches[2]\";s:23:\"casino/([^/]+)/embed/?$\";s:48:\"index.php?casino_category=$matches[1]&embed=true\";s:35:\"casino/([^/]+)/page/?([0-9]{1,})/?$\";s:55:\"index.php?casino_category=$matches[1]&paged=$matches[2]\";s:17:\"casino/([^/]+)/?$\";s:37:\"index.php?casino_category=$matches[1]\";s:35:\"casinos/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:45:\"casinos/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:65:\"casinos/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:60:\"casinos/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:60:\"casinos/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:41:\"casinos/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:24:\"casinos/([^/]+)/embed/?$\";s:40:\"index.php?casinos=$matches[1]&embed=true\";s:28:\"casinos/([^/]+)/trackback/?$\";s:34:\"index.php?casinos=$matches[1]&tb=1\";s:48:\"casinos/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?casinos=$matches[1]&feed=$matches[2]\";s:43:\"casinos/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?casinos=$matches[1]&feed=$matches[2]\";s:36:\"casinos/([^/]+)/page/?([0-9]{1,})/?$\";s:47:\"index.php?casinos=$matches[1]&paged=$matches[2]\";s:43:\"casinos/([^/]+)/comment-page-([0-9]{1,})/?$\";s:47:\"index.php?casinos=$matches[1]&cpage=$matches[2]\";s:32:\"casinos/([^/]+)(?:/([0-9]+))?/?$\";s:46:\"index.php?casinos=$matches[1]&page=$matches[2]\";s:24:\"casinos/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:34:\"casinos/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:54:\"casinos/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:49:\"casinos/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:49:\"casinos/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:30:\"casinos/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:12:\"robots\\.txt$\";s:18:\"index.php?robots=1\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:2:{i:0;s:30:\"advanced-custom-fields/acf.php\";i:1;s:37:\"breadcrumb-navxt/breadcrumb-navxt.php\";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '3', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', 'a:5:{i:0;s:64:\"/usr/www/users/alivel/casio/wp-content/themes/casi/functions.php\";i:1;s:60:\"/usr/www/users/alivel/casio/wp-content/themes/casi/style.css\";i:3;s:62:\"/usr/www/users/alivel/casio/wp-content/themes/casi/archive.php\";i:4;s:63:\"/usr/www/users/alivel/casio/wp-content/themes/casi/category.php\";i:5;s:59:\"/usr/www/users/alivel/casio/wp-content/themes/casi/page.php\";}', 'no'),
(40, 'template', 'casi', 'yes'),
(41, 'stylesheet', 'casi', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '0', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '38590', 'yes'),
(49, 'uploads_use_yearmonth_folders', '1', 'yes'),
(50, 'upload_path', '', 'yes'),
(51, 'blog_public', '1', 'yes'),
(52, 'default_link_category', '2', 'yes'),
(53, 'show_on_front', 'posts', 'yes'),
(54, 'tag_base', '', 'yes'),
(55, 'show_avatars', '1', 'yes'),
(56, 'avatar_rating', 'G', 'yes'),
(57, 'upload_url_path', '', 'yes'),
(58, 'thumbnail_size_w', '150', 'yes'),
(59, 'thumbnail_size_h', '150', 'yes'),
(60, 'thumbnail_crop', '1', 'yes'),
(61, 'medium_size_w', '300', 'yes'),
(62, 'medium_size_h', '300', 'yes'),
(63, 'avatar_default', 'mystery', 'yes'),
(64, 'large_size_w', '1024', 'yes'),
(65, 'large_size_h', '1024', 'yes'),
(66, 'image_default_link_type', 'none', 'yes'),
(67, 'image_default_size', '', 'yes'),
(68, 'image_default_align', '', 'yes'),
(69, 'close_comments_for_old_posts', '0', 'yes'),
(70, 'close_comments_days_old', '14', 'yes'),
(71, 'thread_comments', '1', 'yes'),
(72, 'thread_comments_depth', '5', 'yes'),
(73, 'page_comments', '0', 'yes'),
(74, 'comments_per_page', '50', 'yes'),
(75, 'default_comments_page', 'newest', 'yes'),
(76, 'comment_order', 'asc', 'yes'),
(77, 'sticky_posts', 'a:0:{}', 'yes'),
(78, 'widget_categories', 'a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(79, 'widget_text', 'a:0:{}', 'yes'),
(80, 'widget_rss', 'a:0:{}', 'yes'),
(81, 'uninstall_plugins', 'a:0:{}', 'no'),
(82, 'timezone_string', '', 'yes'),
(83, 'page_for_posts', '0', 'yes'),
(84, 'page_on_front', '0', 'yes'),
(85, 'default_post_format', '0', 'yes'),
(86, 'link_manager_enabled', '0', 'yes'),
(87, 'finished_splitting_shared_terms', '1', 'yes'),
(88, 'site_icon', '0', 'yes'),
(89, 'medium_large_size_w', '768', 'yes'),
(90, 'medium_large_size_h', '0', 'yes'),
(91, 'wp_page_for_privacy_policy', '3', 'yes'),
(92, 'initial_db_version', '38590', 'yes'),
(93, 'casn_user_roles', 'a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:61:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}', 'yes'),
(94, 'fresh_site', '0', 'yes'),
(95, 'WPLANG', 'ru_RU', 'yes'),
(96, 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(97, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(98, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(99, 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(100, 'widget_meta', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(101, 'sidebars_widgets', 'a:3:{s:19:\"wp_inactive_widgets\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-1\";a:0:{}s:13:\"array_version\";i:3;}', 'yes'),
(102, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(103, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(104, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(105, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(106, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(110, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(111, 'cron', 'a:5:{i:1530868566;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1530869871;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1530902271;a:3:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1530902290;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}s:7:\"version\";i:2;}', 'yes'),
(112, 'theme_mods_twentyseventeen', 'a:2:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1530597529;s:4:\"data\";a:4:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-2\";a:0:{}s:9:\"sidebar-3\";a:0:{}}}}', 'yes'),
(126, '_site_transient_timeout_browser_f9d97daae4bfc87faa966e34c03c6f54', '1531161490', 'no'),
(127, '_site_transient_browser_f9d97daae4bfc87faa966e34c03c6f54', 'a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:12:\"67.0.3396.99\";s:8:\"platform\";s:9:\"Macintosh\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}', 'no'),
(135, 'can_compress_scripts', '1', 'no'),
(144, 'recently_activated', 'a:0:{}', 'yes'),
(153, 'acf_version', '4.4.12', 'yes'),
(158, 'current_theme', 'Casi', 'yes'),
(159, 'theme_mods_casi', 'a:2:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}}', 'yes'),
(160, 'theme_switched', '', 'yes'),
(189, 'widget_bcn_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(202, 'bcn_version', '6.1.0', 'no'),
(203, 'bcn_options_bk', 'a:52:{s:17:\"bmainsite_display\";b:1;s:18:\"Hmainsite_template\";s:234:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:28:\"Hmainsite_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:13:\"bhome_display\";b:1;s:14:\"Hhome_template\";s:70:\"<a title=\"На главную\" href=\"/\"><i class=\"fa fa-home\"></i></a>\";s:24:\"Hhome_template_no_anchor\";s:0:\"\";s:13:\"bblog_display\";b:1;s:10:\"hseparator\";s:6:\" &gt; \";s:12:\"blimit_title\";b:0;s:17:\"amax_title_length\";i:20;s:20:\"bcurrent_item_linked\";b:0;s:28:\"bpost_page_hierarchy_display\";b:1;s:25:\"Spost_page_hierarchy_type\";s:15:\"BCN_POST_PARENT\";s:19:\"Hpost_page_template\";s:234:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:29:\"Hpost_page_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:15:\"apost_page_root\";s:1:\"0\";s:15:\"Hpaged_template\";s:147:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">Page %htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:14:\"bpaged_display\";b:0;s:19:\"Hpost_post_template\";s:234:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:29:\"Hpost_post_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:15:\"apost_post_root\";s:1:\"0\";s:28:\"bpost_post_hierarchy_display\";b:1;s:27:\"bpost_post_taxonomy_referer\";b:0;s:25:\"Spost_post_hierarchy_type\";s:8:\"category\";s:34:\"bpost_attachment_hierarchy_display\";b:0;s:31:\"Spost_attachment_hierarchy_type\";s:15:\"BCN_POST_PARENT\";s:21:\"apost_attachment_root\";i:0;s:25:\"Hpost_attachment_template\";s:234:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:35:\"Hpost_attachment_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:13:\"H404_template\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:10:\"S404_title\";s:41:\"404. Страница не найдена\";s:16:\"Hsearch_template\";s:302:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">Search results for &#039;<a property=\"item\" typeof=\"WebPage\" title=\"Go to the first page of search results for %title%.\" href=\"%link%\" class=\"%type%\">%htitle%</a>&#039;</span><meta property=\"position\" content=\"%position%\"></span>\";s:26:\"Hsearch_template_no_anchor\";s:173:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">Search results for &#039;%htitle%&#039;</span><meta property=\"position\" content=\"%position%\"></span>\";s:22:\"Htax_post_tag_template\";s:251:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% tag archives.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:32:\"Htax_post_tag_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:25:\"Htax_post_format_template\";s:247:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% archives.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:35:\"Htax_post_format_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:16:\"Hauthor_template\";s:180:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">Articles by: <a title=\"Go to the first page of posts by %title%.\" href=\"%link%\" class=\"%type%\">%htitle%</a>\";s:26:\"Hauthor_template_no_anchor\";s:155:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">Articles by: %htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:12:\"Sauthor_name\";s:12:\"display_name\";s:12:\"aauthor_root\";i:0;s:22:\"Htax_category_template\";s:256:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% category archives.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:32:\"Htax_category_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:14:\"Hdate_template\";s:247:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% archives.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:24:\"Hdate_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:26:\"bpost_acf_taxonomy_referer\";b:0;s:18:\"Hpost_acf_template\";s:234:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:28:\"Hpost_acf_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:25:\"bpost_acf_archive_display\";b:0;s:14:\"apost_acf_root\";i:0;s:27:\"bpost_acf_hierarchy_display\";b:0;s:24:\"Spost_acf_hierarchy_type\";s:8:\"BCN_DATE\";}', 'yes'),
(204, 'bcn_options', 'a:52:{s:17:\"bmainsite_display\";b:1;s:18:\"Hmainsite_template\";s:234:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:28:\"Hmainsite_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:13:\"bhome_display\";b:1;s:14:\"Hhome_template\";s:70:\"<a title=\"На главную\" href=\"/\"><i class=\"fa fa-home\"></i></a>\";s:24:\"Hhome_template_no_anchor\";s:26:\"<i class=\"fa fa-home\"></i>\";s:13:\"bblog_display\";b:1;s:10:\"hseparator\";s:6:\" &gt; \";s:12:\"blimit_title\";b:0;s:17:\"amax_title_length\";i:20;s:20:\"bcurrent_item_linked\";b:0;s:28:\"bpost_page_hierarchy_display\";b:1;s:25:\"Spost_page_hierarchy_type\";s:15:\"BCN_POST_PARENT\";s:19:\"Hpost_page_template\";s:234:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:29:\"Hpost_page_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:15:\"apost_page_root\";s:1:\"0\";s:15:\"Hpaged_template\";s:147:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">Page %htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:14:\"bpaged_display\";b:0;s:19:\"Hpost_post_template\";s:234:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:29:\"Hpost_post_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:15:\"apost_post_root\";s:1:\"0\";s:28:\"bpost_post_hierarchy_display\";b:1;s:27:\"bpost_post_taxonomy_referer\";b:0;s:25:\"Spost_post_hierarchy_type\";s:8:\"category\";s:34:\"bpost_attachment_hierarchy_display\";b:0;s:31:\"Spost_attachment_hierarchy_type\";s:15:\"BCN_POST_PARENT\";s:21:\"apost_attachment_root\";i:0;s:25:\"Hpost_attachment_template\";s:234:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:35:\"Hpost_attachment_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:13:\"H404_template\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:10:\"S404_title\";s:41:\"404. Страница не найдена\";s:16:\"Hsearch_template\";s:302:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">Search results for &#039;<a property=\"item\" typeof=\"WebPage\" title=\"Go to the first page of search results for %title%.\" href=\"%link%\" class=\"%type%\">%htitle%</a>&#039;</span><meta property=\"position\" content=\"%position%\"></span>\";s:26:\"Hsearch_template_no_anchor\";s:173:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">Search results for &#039;%htitle%&#039;</span><meta property=\"position\" content=\"%position%\"></span>\";s:22:\"Htax_post_tag_template\";s:251:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% tag archives.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:32:\"Htax_post_tag_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:25:\"Htax_post_format_template\";s:247:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% archives.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:35:\"Htax_post_format_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:16:\"Hauthor_template\";s:180:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">Articles by: <a title=\"Go to the first page of posts by %title%.\" href=\"%link%\" class=\"%type%\">%htitle%</a>\";s:26:\"Hauthor_template_no_anchor\";s:155:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">Articles by: %htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:12:\"Sauthor_name\";s:12:\"display_name\";s:12:\"aauthor_root\";i:0;s:22:\"Htax_category_template\";s:256:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% category archives.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:32:\"Htax_category_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:14:\"Hdate_template\";s:247:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% archives.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:24:\"Hdate_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:26:\"bpost_acf_taxonomy_referer\";b:0;s:18:\"Hpost_acf_template\";s:234:\"<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\"><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>\";s:28:\"Hpost_acf_template_no_anchor\";s:142:\"<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>\";s:25:\"bpost_acf_archive_display\";b:0;s:14:\"apost_acf_root\";i:0;s:27:\"bpost_acf_hierarchy_display\";b:0;s:24:\"Spost_acf_hierarchy_type\";s:8:\"BCN_DATE\";}', 'yes'),
(229, 'nav_menu_options', 'a:2:{i:0;b:0;s:8:\"auto_add\";a:0:{}}', 'yes'),
(385, 'category_children', 'a:0:{}', 'yes'),
(424, 'casino_category_children', 'a:2:{i:12;a:2:{i:0;i:14;i:1;i:16;}i:13;a:4:{i:0;i:15;i:1;i:17;i:2;i:18;i:3;i:19;}}', 'yes'),
(458, 'auto_core_update_notified', 'a:4:{s:4:\"type\";s:7:\"success\";s:5:\"email\";s:21:\"office@aliveliyev.com\";s:7:\"version\";s:5:\"4.9.7\";s:9:\"timestamp\";i:1530825846;}', 'no'),
(461, '_site_transient_timeout_theme_roots', '1530868843', 'no'),
(462, '_site_transient_theme_roots', 'a:4:{s:4:\"casi\";s:7:\"/themes\";s:13:\"twentyfifteen\";s:7:\"/themes\";s:15:\"twentyseventeen\";s:7:\"/themes\";s:13:\"twentysixteen\";s:7:\"/themes\";}', 'no'),
(463, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:65:\"https://downloads.wordpress.org/release/ru_RU/wordpress-4.9.7.zip\";s:6:\"locale\";s:5:\"ru_RU\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:65:\"https://downloads.wordpress.org/release/ru_RU/wordpress-4.9.7.zip\";s:10:\"no_content\";b:0;s:11:\"new_bundled\";b:0;s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"4.9.7\";s:7:\"version\";s:5:\"4.9.7\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"4.7\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1530867046;s:15:\"version_checked\";s:5:\"4.9.7\";s:12:\"translations\";a:0:{}}', 'no'),
(464, '_site_transient_update_themes', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1530867047;s:7:\"checked\";a:4:{s:4:\"casi\";s:0:\"\";s:13:\"twentyfifteen\";s:3:\"2.0\";s:15:\"twentyseventeen\";s:3:\"1.6\";s:13:\"twentysixteen\";s:3:\"1.5\";}s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}}', 'no'),
(465, '_site_transient_update_plugins', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1530867047;s:7:\"checked\";a:4:{s:30:\"advanced-custom-fields/acf.php\";s:6:\"4.4.12\";s:19:\"akismet/akismet.php\";s:5:\"4.0.8\";s:37:\"breadcrumb-navxt/breadcrumb-navxt.php\";s:5:\"6.1.0\";s:9:\"hello.php\";s:3:\"1.7\";}s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:4:{s:30:\"advanced-custom-fields/acf.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:36:\"w.org/plugins/advanced-custom-fields\";s:4:\"slug\";s:22:\"advanced-custom-fields\";s:6:\"plugin\";s:30:\"advanced-custom-fields/acf.php\";s:11:\"new_version\";s:6:\"4.4.12\";s:3:\"url\";s:53:\"https://wordpress.org/plugins/advanced-custom-fields/\";s:7:\"package\";s:72:\"https://downloads.wordpress.org/plugin/advanced-custom-fields.4.4.12.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:75:\"https://ps.w.org/advanced-custom-fields/assets/icon-256x256.png?rev=1082746\";s:2:\"1x\";s:75:\"https://ps.w.org/advanced-custom-fields/assets/icon-128x128.png?rev=1082746\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:78:\"https://ps.w.org/advanced-custom-fields/assets/banner-1544x500.jpg?rev=1729099\";s:2:\"1x\";s:77:\"https://ps.w.org/advanced-custom-fields/assets/banner-772x250.jpg?rev=1729102\";}s:11:\"banners_rtl\";a:0:{}}s:19:\"akismet/akismet.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:21:\"w.org/plugins/akismet\";s:4:\"slug\";s:7:\"akismet\";s:6:\"plugin\";s:19:\"akismet/akismet.php\";s:11:\"new_version\";s:5:\"4.0.8\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/akismet/\";s:7:\"package\";s:56:\"https://downloads.wordpress.org/plugin/akismet.4.0.8.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:59:\"https://ps.w.org/akismet/assets/icon-256x256.png?rev=969272\";s:2:\"1x\";s:59:\"https://ps.w.org/akismet/assets/icon-128x128.png?rev=969272\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:61:\"https://ps.w.org/akismet/assets/banner-772x250.jpg?rev=479904\";}s:11:\"banners_rtl\";a:0:{}}s:37:\"breadcrumb-navxt/breadcrumb-navxt.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:30:\"w.org/plugins/breadcrumb-navxt\";s:4:\"slug\";s:16:\"breadcrumb-navxt\";s:6:\"plugin\";s:37:\"breadcrumb-navxt/breadcrumb-navxt.php\";s:11:\"new_version\";s:5:\"6.1.0\";s:3:\"url\";s:47:\"https://wordpress.org/plugins/breadcrumb-navxt/\";s:7:\"package\";s:65:\"https://downloads.wordpress.org/plugin/breadcrumb-navxt.6.1.0.zip\";s:5:\"icons\";a:3:{s:2:\"2x\";s:68:\"https://ps.w.org/breadcrumb-navxt/assets/icon-256x256.png?rev=971477\";s:2:\"1x\";s:60:\"https://ps.w.org/breadcrumb-navxt/assets/icon.svg?rev=971477\";s:3:\"svg\";s:60:\"https://ps.w.org/breadcrumb-navxt/assets/icon.svg?rev=971477\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:70:\"https://ps.w.org/breadcrumb-navxt/assets/banner-772x250.jpg?rev=479408\";}s:11:\"banners_rtl\";a:0:{}}s:9:\"hello.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:25:\"w.org/plugins/hello-dolly\";s:4:\"slug\";s:11:\"hello-dolly\";s:6:\"plugin\";s:9:\"hello.php\";s:11:\"new_version\";s:3:\"1.6\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/hello-dolly/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:63:\"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=969907\";s:2:\"1x\";s:63:\"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=969907\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:65:\"https://ps.w.org/hello-dolly/assets/banner-772x250.png?rev=478342\";}s:11:\"banners_rtl\";a:0:{}}}}', 'no');

-- --------------------------------------------------------

--
-- Структура таблицы `casn_postmeta`
--

CREATE TABLE `casn_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `casn_postmeta`
--

INSERT INTO `casn_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 3, '_wp_page_template', 'default'),
(7, 6, '_edit_last', '1'),
(8, 6, 'field_5b3b3ef16372b', 'a:14:{s:3:\"key\";s:19:\"field_5b3b3ef16372b\";s:5:\"label\";s:34:\"Бонус без депозита\";s:4:\"name\";s:34:\"бонус_без_депозита\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:0;}'),
(9, 6, 'field_5b3b3ef86372c', 'a:14:{s:3:\"key\";s:19:\"field_5b3b3ef86372c\";s:5:\"label\";s:39:\"Приветственный бонус\";s:4:\"name\";s:39:\"приветственный_бонус\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:1;}'),
(10, 6, 'field_5b3b3f096372d', 'a:14:{s:3:\"key\";s:19:\"field_5b3b3f096372d\";s:5:\"label\";s:12:\"Ссылка\";s:4:\"name\";s:12:\"ссылка\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:2;}'),
(12, 6, 'position', 'normal'),
(13, 6, 'layout', 'no_box'),
(14, 6, 'hide_on_screen', ''),
(15, 6, '_edit_lock', '1530735178:1'),
(32, 2, '_edit_lock', '1530695085:1'),
(33, 9, '_wp_attached_file', '2018/07/slotv-casino-logo-medium.png'),
(34, 9, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:174;s:6:\"height\";i:84;s:4:\"file\";s:36:\"2018/07/slotv-casino-logo-medium.png\";s:5:\"sizes\";a:1:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:35:\"slotv-casino-logo-medium-150x84.png\";s:5:\"width\";i:150;s:6:\"height\";i:84;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(156, 2, '_edit_last', '1'),
(157, 24, '_edit_last', '1'),
(158, 24, 'field_5b3c8a2c9e75f', 'a:11:{s:3:\"key\";s:19:\"field_5b3c8a2c9e75f\";s:5:\"label\";s:8:\"Лого\";s:4:\"name\";s:8:\"лого\";s:4:\"type\";s:5:\"image\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:11:\"save_format\";s:3:\"url\";s:12:\"preview_size\";s:6:\"medium\";s:7:\"library\";s:3:\"all\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:0;}'),
(159, 24, 'rule', 'a:5:{s:5:\"param\";s:4:\"page\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:1:\"2\";s:8:\"order_no\";i:0;s:8:\"group_no\";i:0;}'),
(160, 24, 'position', 'normal'),
(161, 24, 'layout', 'no_box'),
(162, 24, 'hide_on_screen', ''),
(163, 24, '_edit_lock', '1530694406:1'),
(166, 26, 'лого', '9'),
(167, 26, '_лого', 'field_5b3c8a2c9e75f'),
(168, 2, 'лого', '9'),
(169, 2, '_лого', 'field_5b3c8a2c9e75f'),
(208, 6, 'field_5b3d251014692', 'a:12:{s:3:\"key\";s:19:\"field_5b3d251014692\";s:5:\"label\";s:19:\"Тип бонуса\";s:4:\"name\";s:19:\"тип_бонуса\";s:4:\"type\";s:6:\"select\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:7:\"choices\";a:2:{s:6:\"Нет\";s:6:\"Нет\";s:43:\"Бонус на первый депозит\";s:43:\"Бонус на первый депозит\";}s:13:\"default_value\";s:0:\"\";s:10:\"allow_null\";s:1:\"0\";s:8:\"multiple\";s:1:\"0\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:2:{s:5:\"field\";s:4:\"null\";s:8:\"operator\";s:2:\"==\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:3;}'),
(210, 6, 'field_5b3d2547f9380', 'a:14:{s:3:\"key\";s:19:\"field_5b3d2547f9380\";s:5:\"label\";s:25:\"Размер бонуса\";s:4:\"name\";s:25:\"размер_бонуса\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5b3d251014692\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:4;}'),
(211, 6, 'field_5b3d254ef9381', 'a:14:{s:3:\"key\";s:19:\"field_5b3d254ef9381\";s:5:\"label\";s:16:\"Фриспины\";s:4:\"name\";s:16:\"фриспины\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5b3d251014692\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:5;}'),
(212, 6, 'field_5b3d2559f9382', 'a:14:{s:3:\"key\";s:19:\"field_5b3d2559f9382\";s:5:\"label\";s:18:\"Множитель\";s:4:\"name\";s:18:\"множитель\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5b3d251014692\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:6;}'),
(214, 6, 'field_5b3d256aaab25', 'a:14:{s:3:\"key\";s:19:\"field_5b3d256aaab25\";s:5:\"label\";s:38:\"Комментарий к бонусу\";s:4:\"name\";s:38:\"комментарий_к_бонусу\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5b3d251014692\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:7;}'),
(216, 6, 'field_5b3d2576943f2', 'a:14:{s:3:\"key\";s:19:\"field_5b3d2576943f2\";s:5:\"label\";s:36:\"Ссылка на получение\";s:4:\"name\";s:36:\"ссылка_на_получение\";s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";s:1:\"0\";s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:10:\"formatting\";s:4:\"html\";s:9:\"maxlength\";s:0:\"\";s:17:\"conditional_logic\";a:3:{s:6:\"status\";s:1:\"0\";s:5:\"rules\";a:1:{i:0;a:3:{s:5:\"field\";s:19:\"field_5b3d251014692\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:0:\"\";}}s:8:\"allorany\";s:3:\"all\";}s:8:\"order_no\";i:8;}'),
(266, 35, '_edit_last', '1'),
(267, 35, '_edit_lock', '1530739645:1'),
(268, 35, '_thumbnail_id', '9'),
(270, 6, 'rule', 'a:5:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:7:\"casinos\";s:8:\"order_no\";i:0;s:8:\"group_no\";i:0;}'),
(271, 35, 'бонус_без_депозита', '-'),
(272, 35, '_бонус_без_депозита', 'field_5b3b3ef16372b'),
(273, 35, 'приветственный_бонус', '100% до €100  + 25 фриспинов'),
(274, 35, '_приветственный_бонус', 'field_5b3b3ef86372c'),
(275, 35, 'ссылка', 'http://ru.casinoglobal.info/casinos/go-slot-v-casino-ref-305/'),
(276, 35, '_ссылка', 'field_5b3b3f096372d'),
(277, 35, 'тип_бонуса', 'Бонус на первый депозит'),
(278, 35, '_тип_бонуса', 'field_5b3d251014692'),
(279, 35, 'размер_бонуса', '100% до €100'),
(280, 35, '_размер_бонуса', 'field_5b3d2547f9380'),
(281, 35, 'фриспины', '25'),
(282, 35, '_фриспины', 'field_5b3d254ef9381'),
(283, 35, 'множитель', '35'),
(284, 35, '_множитель', 'field_5b3d2559f9382'),
(285, 35, 'комментарий_к_бонусу', 'Какой то коммент'),
(286, 35, '_комментарий_к_бонусу', 'field_5b3d256aaab25'),
(287, 35, 'ссылка_на_получение', 'google.com'),
(288, 35, '_ссылка_на_получение', 'field_5b3d2576943f2'),
(289, 36, '_edit_last', '1'),
(290, 36, '_edit_lock', '1530740745:1'),
(291, 36, 'бонус_без_депозита', ''),
(292, 36, '_бонус_без_депозита', 'field_5b3b3ef16372b'),
(293, 36, 'приветственный_бонус', ''),
(294, 36, '_приветственный_бонус', 'field_5b3b3ef86372c'),
(295, 36, 'ссылка', ''),
(296, 36, '_ссылка', 'field_5b3b3f096372d'),
(297, 36, 'тип_бонуса', 'Нет'),
(298, 36, '_тип_бонуса', 'field_5b3d251014692'),
(299, 36, 'размер_бонуса', ''),
(300, 36, '_размер_бонуса', 'field_5b3d2547f9380'),
(301, 36, 'фриспины', ''),
(302, 36, '_фриспины', 'field_5b3d254ef9381'),
(303, 36, 'множитель', ''),
(304, 36, '_множитель', 'field_5b3d2559f9382'),
(305, 36, 'комментарий_к_бонусу', ''),
(306, 36, '_комментарий_к_бонусу', 'field_5b3d256aaab25'),
(307, 36, 'ссылка_на_получение', ''),
(308, 36, '_ссылка_на_получение', 'field_5b3d2576943f2'),
(309, 37, '_edit_last', '1'),
(310, 37, 'бонус_без_депозита', ''),
(311, 37, '_бонус_без_депозита', 'field_5b3b3ef16372b'),
(312, 37, 'приветственный_бонус', ''),
(313, 37, '_приветственный_бонус', 'field_5b3b3ef86372c'),
(314, 37, 'ссылка', ''),
(315, 37, '_ссылка', 'field_5b3b3f096372d'),
(316, 37, 'тип_бонуса', 'Нет'),
(317, 37, '_тип_бонуса', 'field_5b3d251014692'),
(318, 37, 'размер_бонуса', ''),
(319, 37, '_размер_бонуса', 'field_5b3d2547f9380'),
(320, 37, 'фриспины', ''),
(321, 37, '_фриспины', 'field_5b3d254ef9381'),
(322, 37, 'множитель', ''),
(323, 37, '_множитель', 'field_5b3d2559f9382'),
(324, 37, 'комментарий_к_бонусу', ''),
(325, 37, '_комментарий_к_бонусу', 'field_5b3d256aaab25'),
(326, 37, 'ссылка_на_получение', ''),
(327, 37, '_ссылка_на_получение', 'field_5b3d2576943f2'),
(328, 37, '_edit_lock', '1530808074:1'),
(329, 38, '_menu_item_type', 'custom'),
(330, 38, '_menu_item_menu_item_parent', '0'),
(331, 38, '_menu_item_object_id', '38'),
(332, 38, '_menu_item_object', 'custom'),
(333, 38, '_menu_item_target', ''),
(334, 38, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(335, 38, '_menu_item_xfn', ''),
(336, 38, '_menu_item_url', '#'),
(338, 39, '_menu_item_type', 'custom'),
(339, 39, '_menu_item_menu_item_parent', '0'),
(340, 39, '_menu_item_object_id', '39'),
(341, 39, '_menu_item_object', 'custom'),
(342, 39, '_menu_item_target', ''),
(343, 39, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(344, 39, '_menu_item_xfn', ''),
(345, 39, '_menu_item_url', '#'),
(347, 40, '_menu_item_type', 'custom'),
(348, 40, '_menu_item_menu_item_parent', '39'),
(349, 40, '_menu_item_object_id', '40'),
(350, 40, '_menu_item_object', 'custom'),
(351, 40, '_menu_item_target', ''),
(352, 40, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(353, 40, '_menu_item_xfn', ''),
(354, 40, '_menu_item_url', '/casino/bonus-na-deposit/?post_type=casinos'),
(356, 41, '_menu_item_type', 'custom'),
(357, 41, '_menu_item_menu_item_parent', '38'),
(358, 41, '_menu_item_object_id', '41'),
(359, 41, '_menu_item_object', 'custom'),
(360, 41, '_menu_item_target', ''),
(361, 41, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(362, 41, '_menu_item_xfn', ''),
(363, 41, '_menu_item_url', '/casino/online-casino?post_type=casinos'),
(365, 42, '_menu_item_type', 'custom'),
(366, 42, '_menu_item_menu_item_parent', '38'),
(367, 42, '_menu_item_object_id', '42'),
(368, 42, '_menu_item_object', 'custom'),
(369, 42, '_menu_item_target', ''),
(370, 42, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(371, 42, '_menu_item_xfn', ''),
(372, 42, '_menu_item_url', '/casino/mobile-casino?post_type=casinos'),
(374, 43, '_menu_item_type', 'custom'),
(375, 43, '_menu_item_menu_item_parent', '39'),
(376, 43, '_menu_item_object_id', '43'),
(377, 43, '_menu_item_object', 'custom'),
(378, 43, '_menu_item_target', ''),
(379, 43, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(380, 43, '_menu_item_xfn', ''),
(381, 43, '_menu_item_url', '/casino/bezdepozitniye/?post_type=casinos'),
(383, 44, '_menu_item_type', 'custom'),
(384, 44, '_menu_item_menu_item_parent', '39'),
(385, 44, '_menu_item_object_id', '44'),
(386, 44, '_menu_item_object', 'custom'),
(387, 44, '_menu_item_target', ''),
(388, 44, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(389, 44, '_menu_item_xfn', ''),
(390, 44, '_menu_item_url', '/casino/cashback/?post_type=casinos'),
(392, 45, '_menu_item_type', 'custom'),
(393, 45, '_menu_item_menu_item_parent', '39'),
(394, 45, '_menu_item_object_id', '45'),
(395, 45, '_menu_item_object', 'custom'),
(396, 45, '_menu_item_target', ''),
(397, 45, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(398, 45, '_menu_item_xfn', ''),
(399, 45, '_menu_item_url', '/casino/freespins/?post_type=casinos'),
(401, 46, '_edit_last', '1'),
(402, 46, '_edit_lock', '1530801155:1'),
(403, 46, '_thumbnail_id', '9'),
(404, 46, 'бонус_без_депозита', ''),
(405, 46, '_бонус_без_депозита', 'field_5b3b3ef16372b'),
(406, 46, 'приветственный_бонус', ''),
(407, 46, '_приветственный_бонус', 'field_5b3b3ef86372c'),
(408, 46, 'ссылка', ''),
(409, 46, '_ссылка', 'field_5b3b3f096372d'),
(410, 46, 'тип_бонуса', 'Нет'),
(411, 46, '_тип_бонуса', 'field_5b3d251014692'),
(412, 46, 'размер_бонуса', ''),
(413, 46, '_размер_бонуса', 'field_5b3d2547f9380'),
(414, 46, 'фриспины', ''),
(415, 46, '_фриспины', 'field_5b3d254ef9381'),
(416, 46, 'множитель', ''),
(417, 46, '_множитель', 'field_5b3d2559f9382'),
(418, 46, 'комментарий_к_бонусу', ''),
(419, 46, '_комментарий_к_бонусу', 'field_5b3d256aaab25'),
(420, 46, 'ссылка_на_получение', ''),
(421, 46, '_ссылка_на_получение', 'field_5b3d2576943f2'),
(422, 37, '_thumbnail_id', '9');

-- --------------------------------------------------------

--
-- Структура таблицы `casn_posts`
--

CREATE TABLE `casn_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `casn_posts`
--

INSERT INTO `casn_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(2, 1, '2018-07-02 21:37:50', '2018-07-02 18:37:50', '', 'Главная', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2018-07-04 12:06:54', '2018-07-04 09:06:54', '', 0, 'http://gamescasino.win/?page_id=2', 0, 'page', '', 0),
(3, 1, '2018-07-02 21:37:50', '2018-07-02 18:37:50', '<h2>Кто мы</h2><p>Наш адрес сайта: http://gamescasino.win.</p><h2>Какие персональные данные мы собираем и с какой целью</h2><h3>Комментарии</h3><p>Если посетитель оставляет комментарий на сайте, мы собираем данные указанные в форме комментария, а также IP адрес посетителя и данные user-agent браузера с целью определения спама.</p><p>Анонимизированная строка создаваемая из вашего адреса email (\"хеш\") может предоставляться сервису Gravatar, чтобы определить используете ли вы его. Политика конфиденциальности Gravatar доступна здесь: https://automattic.com/privacy/ . После одобрения комментария ваше изображение профиля будет видимым публично в контексте вашего комментария.</p><h3>Медиафайлы</h3><p>Если вы зарегистрированный пользователь и загружаете фотографии на сайт, вам возможно следует избегать загрузки изображений с метаданными EXIF, так как они могут содержать данные вашего месторасположения по GPS. Посетители могут извлечь эту информацию скачав изображения с сайта.</p><h3>Формы контактов</h3><h3>Куки</h3><p>Если вы оставляете комментарий на нашем сайте, вы можете включить сохранение вашего имени, адреса email и вебсайта в куки. Это делается для вашего удобства, чтобы не заполнять данные снова при повторном комментировании. Эти куки хранятся в течение одного года.</p><p>Если у вас есть учетная запись на сайте и вы войдете в неё, мы установим временный куки для определения поддержки куки вашим браузером, куки не содержит никакой личной информации и удаляется при закрытии вашего браузера.</p><p>При входе в учетную запись мы также устанавливаем несколько куки с данными входа и настройками экрана. Куки входа хранятся в течение двух дней, куки с настройками экрана - год. Если вы выберете возможность \"Запомнить меня\", данные о входе будут сохраняться в течение двух недель. При выходе из учетной записи куки входа будут удалены.</p><p>При редактировании или публикации статьи в браузере будет сохранен дополнительный куки, он не содержит персональных данных и содержит только ID записи отредактированной вами, истекает через 1 день.</p><h3>Встраиваемое содержимое других вебсайтов</h3><p>Статьи на этом сайте могут включать встраиваемое содержимое (например видео, изображения, статьи и др.), подобное содержимое ведет себя так же, как если бы посетитель зашел на другой сайт.</p><p>Эти сайты могут собирать ваши данные, использовать куки, внедрять дополнительное отслеживание третьей стороной и следить за вашим взаимодействием с внедренным содержимым, включая отслеживание взаимодействия, если у вас есть учетная запись и вы авторизовались на том сайте.</p><h3>Веб-аналитика</h3><h2>С кем мы делимся вашими данными</h2><h2>Как долго мы храним ваши данные</h2><p>Если вы оставляете комментарий, то сам комментарий и его метаданные сохраняются неопределенно долго. Это делается для того, чтобы определять и одобрять последующие комментарии автоматически, вместо помещения их в очередь на одобрение.</p><p>Для пользователей с регистрацией на нашем сайте мы храним ту личную информацию, которую они указывают в своем профиле. Все пользователи могут видеть, редактировать или удалить свою информацию из профиля в любое время (кроме имени пользователя). Администрация вебсайта также может видеть и изменять эту информацию.</p><h2>Какие у вас права на ваши данные</h2><p>При наличии учетной записи на сайте или если вы оставляли комментарии, то вы можете запросить файл экспорта персональных данных, которые мы сохранили о вас, включая предоставленные вами данные. Вы также можете запросить удаление этих данных, это не включает данные, которые мы обязаны хранить в административных целях, по закону или целях безопасности.</p><h2>Куда мы отправляем ваши данные</h2><p>Комментарии пользователей могут проверяться автоматическим сервисом определения спама.</p><h2>Ваша контактная информация</h2><h2>Дополнительная информация</h2><h3>Как мы защищаем ваши данные</h3><h3>Какие принимаются процедуры против взлома данных</h3><h3>От каких третьих сторон мы получаем данные</h3><h3>Какие автоматические решения принимаются на основе данных пользователей</h3><h3>Требования к раскрытию отраслевых нормативных требований</h3>', 'Политика конфиденциальности', '', 'draft', 'closed', 'open', '', 'privacy-policy', '', '', '2018-07-02 21:37:50', '2018-07-02 18:37:50', '', 0, 'http://gamescasino.win/?page_id=3', 0, 'page', '', 0),
(4, 1, '2018-07-02 21:38:10', '0000-00-00 00:00:00', '', 'Черновик', '', 'auto-draft', 'open', 'open', '', '', '', '', '2018-07-02 21:38:10', '0000-00-00 00:00:00', '', 0, 'http://gamescasino.win/?p=4', 0, 'post', '', 0),
(6, 1, '2018-07-03 12:17:27', '2018-07-03 09:17:27', '', 'Казино', '', 'publish', 'closed', 'closed', '', 'acf_%d0%ba%d0%b0%d0%b7%d0%b8%d0%bd%d0%be', '', '', '2018-07-04 23:15:21', '2018-07-04 20:15:21', '', 0, 'http://gamescasino.win/?post_type=acf&#038;p=6', 0, 'acf', '', 0),
(9, 1, '2018-07-03 14:58:22', '2018-07-03 11:58:22', '', 'slotv-casino-logo-medium', '', 'inherit', 'open', 'closed', '', 'slotv-casino-logo-medium', '', '', '2018-07-03 14:58:22', '2018-07-03 11:58:22', '', 0, 'http://gamescasino.win/wp-content/uploads/2018/07/slotv-casino-logo-medium.png', 0, 'attachment', 'image/png', 0),
(23, 1, '2018-07-04 11:49:37', '2018-07-04 08:49:37', '', 'Главная', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2018-07-04 11:49:37', '2018-07-04 08:49:37', '', 2, 'http://gamescasino.win/2018/07/04/2-revision-v1/', 0, 'revision', '', 0),
(24, 1, '2018-07-04 11:50:12', '2018-07-04 08:50:12', '', 'Главная', '', 'publish', 'closed', 'closed', '', 'acf_%d0%b3%d0%bb%d0%b0%d0%b2%d0%bd%d0%b0%d1%8f', '', '', '2018-07-04 11:50:12', '2018-07-04 08:50:12', '', 0, 'http://gamescasino.win/?post_type=acf&#038;p=24', 0, 'acf', '', 0),
(26, 1, '2018-07-04 12:06:54', '2018-07-04 09:06:54', '', 'Главная', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2018-07-04 12:06:54', '2018-07-04 09:06:54', '', 2, 'http://gamescasino.win/2018/07/04/2-revision-v1/', 0, 'revision', '', 0),
(35, 1, '2018-07-04 23:14:23', '2018-07-04 20:14:23', '', 'Slot V Casino', '', 'publish', 'closed', 'closed', '', 'slot-v-casino', '', '', '2018-07-05 00:24:56', '2018-07-04 21:24:56', '', 0, 'http://gamescasino.win/?post_type=casinos&#038;p=35', 0, 'casinos', '', 0),
(36, 1, '2018-07-05 00:47:56', '2018-07-04 21:47:56', '', 'Azartplay Casino', '', 'publish', 'closed', 'closed', '', 'azartplay-casino', '', '', '2018-07-05 00:47:59', '2018-07-04 21:47:59', '', 0, 'http://gamescasino.win/?post_type=casinos&#038;p=36', 0, 'casinos', '', 0),
(37, 1, '2018-07-05 00:48:20', '2018-07-04 21:48:20', '', 'Riobet Casino', '', 'publish', 'closed', 'closed', '', 'riobet-casino', '', '', '2018-07-05 17:35:15', '2018-07-05 14:35:15', '', 0, 'http://gamescasino.win/?post_type=casinos&#038;p=37', 0, 'casinos', '', 0),
(38, 1, '2018-07-05 00:54:23', '2018-07-04 21:54:23', '', 'Казино', '', 'publish', 'closed', 'closed', '', '%d0%ba%d0%b0%d0%b7%d0%b8%d0%bd%d0%be', '', '', '2018-07-05 01:02:41', '2018-07-04 22:02:41', '', 0, 'http://gamescasino.win/?p=38', 1, 'nav_menu_item', '', 0),
(39, 1, '2018-07-05 00:54:23', '2018-07-04 21:54:23', '', 'Бонусы', '', 'publish', 'closed', 'closed', '', '%d0%b1%d0%be%d0%bd%d1%83%d1%81%d1%8b', '', '', '2018-07-05 01:02:41', '2018-07-04 22:02:41', '', 0, 'http://gamescasino.win/?p=39', 4, 'nav_menu_item', '', 0),
(40, 1, '2018-07-05 00:54:23', '2018-07-04 21:54:23', '', 'Бонус на депозит', '', 'publish', 'closed', 'closed', '', '%d0%b1%d0%be%d0%bd%d1%83%d1%81-%d0%bd%d0%b0-%d0%b4%d0%b5%d0%bf%d0%be%d0%b7%d0%b8%d1%82', '', '', '2018-07-05 01:02:41', '2018-07-04 22:02:41', '', 0, 'http://gamescasino.win/?p=40', 5, 'nav_menu_item', '', 0),
(41, 1, '2018-07-05 00:58:38', '2018-07-04 21:58:38', '', 'Онлайн казино', '', 'publish', 'closed', 'closed', '', '%d0%be%d0%bd%d0%bb%d0%b0%d0%b9%d0%bd-%d0%ba%d0%b0%d0%b7%d0%b8%d0%bd%d0%be', '', '', '2018-07-05 01:02:41', '2018-07-04 22:02:41', '', 0, 'http://gamescasino.win/?p=41', 2, 'nav_menu_item', '', 0),
(42, 1, '2018-07-05 00:58:38', '2018-07-04 21:58:38', '', 'Мобильное казино', '', 'publish', 'closed', 'closed', '', '%d0%bc%d0%be%d0%b1%d0%b8%d0%bb%d1%8c%d0%bd%d0%be%d0%b5-%d0%ba%d0%b0%d0%b7%d0%b8%d0%bd%d0%be', '', '', '2018-07-05 01:02:41', '2018-07-04 22:02:41', '', 0, 'http://gamescasino.win/?p=42', 3, 'nav_menu_item', '', 0),
(43, 1, '2018-07-05 01:00:40', '2018-07-04 22:00:40', '', 'Бездепозитные бонусы', '', 'publish', 'closed', 'closed', '', '%d0%b1%d0%b5%d0%b7%d0%b4%d0%b5%d0%bf%d0%be%d0%b7%d0%b8%d1%82%d0%bd%d1%8b%d0%b5-%d0%b1%d0%be%d0%bd%d1%83%d1%81%d1%8b', '', '', '2018-07-05 01:02:41', '2018-07-04 22:02:41', '', 0, 'http://gamescasino.win/?p=43', 6, 'nav_menu_item', '', 0),
(44, 1, '2018-07-05 01:00:40', '2018-07-04 22:00:40', '', 'Кешбек бонусы', '', 'publish', 'closed', 'closed', '', '%d0%ba%d0%b5%d1%88%d0%b1%d0%b5%d0%ba-%d0%b1%d0%be%d0%bd%d1%83%d1%81%d1%8b', '', '', '2018-07-05 01:02:41', '2018-07-04 22:02:41', '', 0, 'http://gamescasino.win/?p=44', 7, 'nav_menu_item', '', 0),
(45, 1, '2018-07-05 01:00:40', '2018-07-04 22:00:40', '', 'Фриспины', '', 'publish', 'closed', 'closed', '', '%d1%84%d1%80%d0%b8%d1%81%d0%bf%d0%b8%d0%bd%d1%8b', '', '', '2018-07-05 01:02:41', '2018-07-04 22:02:41', '', 0, 'http://gamescasino.win/?p=45', 8, 'nav_menu_item', '', 0),
(46, 1, '2018-07-05 17:34:05', '2018-07-05 14:34:05', '', 'Test', '', 'publish', 'closed', 'closed', '', 'test', '', '', '2018-07-05 17:34:05', '2018-07-05 14:34:05', '', 0, 'http://gamescasino.win/?post_type=casinos&#038;p=46', 0, 'casinos', '', 0),
(47, 1, '2018-07-05 20:22:59', '0000-00-00 00:00:00', '', 'Черновик', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2018-07-05 20:22:59', '0000-00-00 00:00:00', '', 0, 'http://gamescasino.win/?post_type=casinos&p=47', 0, 'casinos', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `casn_termmeta`
--

CREATE TABLE `casn_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `casn_terms`
--

CREATE TABLE `casn_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `casn_terms`
--

INSERT INTO `casn_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Без рубрики', '%d0%b1%d0%b5%d0%b7-%d1%80%d1%83%d0%b1%d1%80%d0%b8%d0%ba%d0%b8', 0),
(11, 'Главное меню', '%d0%b3%d0%bb%d0%b0%d0%b2%d0%bd%d0%be%d0%b5-%d0%bc%d0%b5%d0%bd%d1%8e', 0),
(12, 'Казино', '%d0%ba%d0%b0%d0%b7%d0%b8%d0%bd%d0%be', 0),
(13, 'Бонусы', 'bonus', 0),
(14, 'Онлайн казино', 'online-casino', 0),
(15, 'Бонусы на депозит', 'bonus-na-deposit', 0),
(16, 'Мобильное казино', 'mobile-casino', 0),
(17, 'Бездепозитные бонусы', 'bezdepozitniye', 0),
(18, 'Кешбек бонусы', 'cashback', 0),
(19, 'Фриспины', 'freespins', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `casn_term_relationships`
--

CREATE TABLE `casn_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `casn_term_relationships`
--

INSERT INTO `casn_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(35, 12, 0),
(35, 13, 0),
(35, 14, 0),
(36, 12, 0),
(36, 16, 0),
(37, 12, 0),
(37, 13, 0),
(37, 14, 0),
(37, 15, 0),
(37, 16, 0),
(38, 11, 0),
(39, 11, 0),
(40, 11, 0),
(41, 11, 0),
(42, 11, 0),
(43, 11, 0),
(44, 11, 0),
(45, 11, 0),
(46, 12, 0),
(46, 16, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `casn_term_taxonomy`
--

CREATE TABLE `casn_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `casn_term_taxonomy`
--

INSERT INTO `casn_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 0),
(11, 11, 'nav_menu', '', 0, 8),
(12, 12, 'casino_category', '', 0, 4),
(13, 13, 'casino_category', '', 0, 2),
(14, 14, 'casino_category', '', 12, 2),
(15, 15, 'casino_category', '', 13, 1),
(16, 16, 'casino_category', '', 12, 3),
(17, 17, 'casino_category', '', 13, 0),
(18, 18, 'casino_category', '', 13, 0),
(19, 19, 'casino_category', '', 13, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `casn_usermeta`
--

CREATE TABLE `casn_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `casn_usermeta`
--

INSERT INTO `casn_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'casn_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'casn_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', 'wp496_privacy,theme_editor_notice'),
(15, 1, 'show_welcome_panel', '1'),
(16, 1, 'session_tokens', 'a:1:{s:64:\"80417696805f914afc34bbf65cc64b61d266c3dd6c1c866c6796bc2860b9cc6b\";a:4:{s:10:\"expiration\";i:1531766289;s:2:\"ip\";s:14:\"213.172.79.172\";s:2:\"ua\";s:120:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36\";s:5:\"login\";i:1530556689;}}'),
(17, 1, 'casn_dashboard_quick_press_last_post_id', '4'),
(18, 1, 'community-events-location', 'a:1:{s:2:\"ip\";s:12:\"213.172.79.0\";}'),
(19, 1, 'casn_user-settings', 'libraryContent=browse'),
(20, 1, 'casn_user-settings-time', '1530619101'),
(21, 1, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";i:4;s:15:\"title-attribute\";}'),
(22, 1, 'metaboxhidden_nav-menus', 'a:1:{i:0;s:12:\"add-post_tag\";}'),
(23, 1, 'nav_menu_recently_edited', '11');

-- --------------------------------------------------------

--
-- Структура таблицы `casn_users`
--

CREATE TABLE `casn_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `casn_users`
--

INSERT INTO `casn_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BN4SB4KdNnqjLTWMZRYuNLF0h5gzU11', 'admin', 'office@aliveliyev.com', '', '2018-07-02 18:37:50', '', 0, 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `casn_commentmeta`
--
ALTER TABLE `casn_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Индексы таблицы `casn_comments`
--
ALTER TABLE `casn_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Индексы таблицы `casn_links`
--
ALTER TABLE `casn_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Индексы таблицы `casn_options`
--
ALTER TABLE `casn_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Индексы таблицы `casn_postmeta`
--
ALTER TABLE `casn_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Индексы таблицы `casn_posts`
--
ALTER TABLE `casn_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Индексы таблицы `casn_termmeta`
--
ALTER TABLE `casn_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Индексы таблицы `casn_terms`
--
ALTER TABLE `casn_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Индексы таблицы `casn_term_relationships`
--
ALTER TABLE `casn_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Индексы таблицы `casn_term_taxonomy`
--
ALTER TABLE `casn_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Индексы таблицы `casn_usermeta`
--
ALTER TABLE `casn_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Индексы таблицы `casn_users`
--
ALTER TABLE `casn_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `casn_commentmeta`
--
ALTER TABLE `casn_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `casn_comments`
--
ALTER TABLE `casn_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `casn_links`
--
ALTER TABLE `casn_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `casn_options`
--
ALTER TABLE `casn_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;

--
-- AUTO_INCREMENT для таблицы `casn_postmeta`
--
ALTER TABLE `casn_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=423;

--
-- AUTO_INCREMENT для таблицы `casn_posts`
--
ALTER TABLE `casn_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `casn_termmeta`
--
ALTER TABLE `casn_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `casn_terms`
--
ALTER TABLE `casn_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `casn_term_taxonomy`
--
ALTER TABLE `casn_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `casn_usermeta`
--
ALTER TABLE `casn_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `casn_users`
--
ALTER TABLE `casn_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
