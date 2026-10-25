-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: sql453.your-server.de
-- Время создания: Май 01 2019 г., 16:10
-- Версия сервера: 5.7.25-1
-- Версия PHP: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `studyprog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `briz_commentmeta`
--

CREATE TABLE `briz_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `briz_comments`
--

CREATE TABLE `briz_comments` (
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

--
-- Дамп данных таблицы `briz_comments`
--

INSERT INTO `briz_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Автор комментария', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2019-04-10 19:02:03', '2019-04-10 16:02:03', 'Привет! Это комментарий.\nЧтобы начать модерировать, редактировать и удалять комментарии, перейдите на экран «Комментарии» в консоли.\nАватары авторов комментариев загружаются с сервиса <a href=\"https://ru.gravatar.com\">Gravatar</a>.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `briz_links`
--

CREATE TABLE `briz_links` (
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
-- Структура таблицы `briz_options`
--

CREATE TABLE `briz_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `briz_options`
--

INSERT INTO `briz_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://brizwp.aliveliyev.com', 'yes'),
(2, 'home', 'http://brizwp.aliveliyev.com', 'yes'),
(3, 'blogname', 'Briz', 'yes'),
(4, 'blogdescription', 'Ещё один сайт на WordPress', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'office@aliveliyev.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'd.m.Y', 'yes'),
(24, 'time_format', 'H:i', 'yes'),
(25, 'links_updated_date_format', 'd.m.Y H:i', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:88:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:12:\"robots\\.txt$\";s:18:\"index.php?robots=1\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:27:\"comment-page-([0-9]{1,})/?$\";s:38:\"index.php?&page_id=2&cpage=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:4:{i:0;s:29:\"acf-repeater/acf-repeater.php\";i:1;s:34:\"advanced-custom-fields-pro/acf.php\";i:2;s:39:\"disable-gutenberg/disable-gutenberg.php\";i:3;s:23:\"rustolat/rus-to-lat.php\";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '3', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', 'a:3:{i:0;s:66:\"/usr/www/users/alivel/brizwp/wp-content/themes/briz/front-page.php\";i:2;s:61:\"/usr/www/users/alivel/brizwp/wp-content/themes/briz/style.css\";i:3;s:0:\"\";}', 'no'),
(40, 'template', 'briz', 'yes'),
(41, 'stylesheet', 'briz', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '0', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '44719', 'yes'),
(49, 'uploads_use_yearmonth_folders', '1', 'yes'),
(50, 'upload_path', '', 'yes'),
(51, 'blog_public', '1', 'yes'),
(52, 'default_link_category', '2', 'yes'),
(53, 'show_on_front', 'page', 'yes'),
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
(84, 'page_on_front', '2', 'yes'),
(85, 'default_post_format', '0', 'yes'),
(86, 'link_manager_enabled', '0', 'yes'),
(87, 'finished_splitting_shared_terms', '1', 'yes'),
(88, 'site_icon', '0', 'yes'),
(89, 'medium_large_size_w', '768', 'yes'),
(90, 'medium_large_size_h', '0', 'yes'),
(91, 'wp_page_for_privacy_policy', '3', 'yes'),
(92, 'show_comments_cookies_opt_in', '1', 'yes'),
(93, 'initial_db_version', '44719', 'yes'),
(94, 'briz_user_roles', 'a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:61:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}', 'yes'),
(95, 'fresh_site', '0', 'yes'),
(96, 'WPLANG', 'ru_RU', 'yes'),
(97, 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(98, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(99, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(100, 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(101, 'widget_meta', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(102, 'sidebars_widgets', 'a:2:{s:19:\"wp_inactive_widgets\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:13:\"array_version\";i:3;}', 'yes'),
(103, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(104, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(105, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(106, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(110, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(111, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(112, 'cron', 'a:5:{i:1556719326;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1556726526;a:3:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1556726538;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1556726539;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}s:7:\"version\";i:2;}', 'yes'),
(113, 'theme_mods_twentynineteen', 'a:2:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1554975579;s:4:\"data\";a:2:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}}}}', 'yes'),
(135, 'can_compress_scripts', '1', 'no'),
(154, 'current_theme', 'Briz theme', 'yes'),
(155, 'theme_mods_briz', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(156, 'theme_switched', '', 'yes'),
(159, 'recently_activated', 'a:0:{}', 'yes'),
(166, 'acf_version', '5.7.7', 'yes'),
(192, 'nav_menu_options', 'a:2:{i:0;b:0;s:8:\"auto_add\";a:0:{}}', 'yes'),
(291, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:65:\"https://downloads.wordpress.org/release/ru_RU/wordpress-5.1.1.zip\";s:6:\"locale\";s:5:\"ru_RU\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:65:\"https://downloads.wordpress.org/release/ru_RU/wordpress-5.1.1.zip\";s:10:\"no_content\";b:0;s:11:\"new_bundled\";b:0;s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"5.1.1\";s:7:\"version\";s:5:\"5.1.1\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.0\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1556686423;s:15:\"version_checked\";s:5:\"5.1.1\";s:12:\"translations\";a:0:{}}', 'no'),
(292, '_site_transient_update_themes', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1556686425;s:7:\"checked\";a:4:{s:4:\"briz\";s:0:\"\";s:14:\"twentynineteen\";s:3:\"1.3\";s:15:\"twentyseventeen\";s:3:\"2.1\";s:13:\"twentysixteen\";s:3:\"1.9\";}s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}}', 'no'),
(395, '_transient_timeout_acf_plugin_updates', '1556772824', 'no'),
(396, '_transient_acf_plugin_updates', 'a:4:{s:7:\"plugins\";a:1:{s:34:\"advanced-custom-fields-pro/acf.php\";a:8:{s:4:\"slug\";s:26:\"advanced-custom-fields-pro\";s:6:\"plugin\";s:34:\"advanced-custom-fields-pro/acf.php\";s:11:\"new_version\";s:6:\"5.7.13\";s:3:\"url\";s:37:\"https://www.advancedcustomfields.com/\";s:6:\"tested\";s:5:\"4.9.9\";s:7:\"package\";s:0:\"\";s:5:\"icons\";a:1:{s:7:\"default\";s:63:\"https://ps.w.org/advanced-custom-fields/assets/icon-256x256.png\";}s:7:\"banners\";a:1:{s:7:\"default\";s:66:\"https://ps.w.org/advanced-custom-fields/assets/banner-1544x500.jpg\";}}}s:10:\"expiration\";i:86400;s:6:\"status\";i:1;s:7:\"checked\";a:1:{s:34:\"advanced-custom-fields-pro/acf.php\";s:5:\"5.7.7\";}}', 'no'),
(397, '_site_transient_timeout_theme_roots', '1556688224', 'no'),
(398, '_site_transient_theme_roots', 'a:4:{s:4:\"briz\";s:7:\"/themes\";s:14:\"twentynineteen\";s:7:\"/themes\";s:15:\"twentyseventeen\";s:7:\"/themes\";s:13:\"twentysixteen\";s:7:\"/themes\";}', 'no'),
(399, '_site_transient_update_plugins', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1556686426;s:7:\"checked\";a:6:{s:29:\"acf-repeater/acf-repeater.php\";s:5:\"1.1.1\";s:34:\"advanced-custom-fields-pro/acf.php\";s:5:\"5.7.7\";s:19:\"akismet/akismet.php\";s:5:\"4.1.1\";s:39:\"disable-gutenberg/disable-gutenberg.php\";s:3:\"1.7\";s:9:\"hello.php\";s:5:\"1.7.1\";s:23:\"rustolat/rus-to-lat.php\";s:3:\"0.3\";}s:8:\"response\";a:2:{s:39:\"disable-gutenberg/disable-gutenberg.php\";O:8:\"stdClass\":12:{s:2:\"id\";s:31:\"w.org/plugins/disable-gutenberg\";s:4:\"slug\";s:17:\"disable-gutenberg\";s:6:\"plugin\";s:39:\"disable-gutenberg/disable-gutenberg.php\";s:11:\"new_version\";s:5:\"1.8.1\";s:3:\"url\";s:48:\"https://wordpress.org/plugins/disable-gutenberg/\";s:7:\"package\";s:66:\"https://downloads.wordpress.org/plugin/disable-gutenberg.1.8.1.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:70:\"https://ps.w.org/disable-gutenberg/assets/icon-256x256.png?rev=1925990\";s:2:\"1x\";s:70:\"https://ps.w.org/disable-gutenberg/assets/icon-128x128.png?rev=1925990\";}s:7:\"banners\";a:0:{}s:11:\"banners_rtl\";a:0:{}s:6:\"tested\";s:3:\"5.2\";s:12:\"requires_php\";s:6:\"5.6.20\";s:13:\"compatibility\";O:8:\"stdClass\":0:{}}s:34:\"advanced-custom-fields-pro/acf.php\";O:8:\"stdClass\":8:{s:4:\"slug\";s:26:\"advanced-custom-fields-pro\";s:6:\"plugin\";s:34:\"advanced-custom-fields-pro/acf.php\";s:11:\"new_version\";s:6:\"5.7.13\";s:3:\"url\";s:37:\"https://www.advancedcustomfields.com/\";s:6:\"tested\";s:5:\"4.9.9\";s:7:\"package\";s:0:\"\";s:5:\"icons\";a:1:{s:7:\"default\";s:63:\"https://ps.w.org/advanced-custom-fields/assets/icon-256x256.png\";}s:7:\"banners\";a:1:{s:7:\"default\";s:66:\"https://ps.w.org/advanced-custom-fields/assets/banner-1544x500.jpg\";}}}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:3:{s:19:\"akismet/akismet.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:21:\"w.org/plugins/akismet\";s:4:\"slug\";s:7:\"akismet\";s:6:\"plugin\";s:19:\"akismet/akismet.php\";s:11:\"new_version\";s:5:\"4.1.1\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/akismet/\";s:7:\"package\";s:56:\"https://downloads.wordpress.org/plugin/akismet.4.1.1.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:59:\"https://ps.w.org/akismet/assets/icon-256x256.png?rev=969272\";s:2:\"1x\";s:59:\"https://ps.w.org/akismet/assets/icon-128x128.png?rev=969272\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:61:\"https://ps.w.org/akismet/assets/banner-772x250.jpg?rev=479904\";}s:11:\"banners_rtl\";a:0:{}}s:9:\"hello.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:25:\"w.org/plugins/hello-dolly\";s:4:\"slug\";s:11:\"hello-dolly\";s:6:\"plugin\";s:9:\"hello.php\";s:11:\"new_version\";s:3:\"1.6\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/hello-dolly/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=2052855\";s:2:\"1x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=2052855\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:66:\"https://ps.w.org/hello-dolly/assets/banner-772x250.jpg?rev=2052855\";}s:11:\"banners_rtl\";a:0:{}}s:23:\"rustolat/rus-to-lat.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:22:\"w.org/plugins/rustolat\";s:4:\"slug\";s:8:\"rustolat\";s:6:\"plugin\";s:23:\"rustolat/rus-to-lat.php\";s:11:\"new_version\";s:3:\"0.3\";s:3:\"url\";s:39:\"https://wordpress.org/plugins/rustolat/\";s:7:\"package\";s:55:\"https://downloads.wordpress.org/plugin/rustolat.0.3.zip\";s:5:\"icons\";a:1:{s:7:\"default\";s:52:\"https://s.w.org/plugins/geopattern-icon/rustolat.svg\";}s:7:\"banners\";a:0:{}s:11:\"banners_rtl\";a:0:{}}}}', 'no');

-- --------------------------------------------------------

--
-- Структура таблицы `briz_postmeta`
--

CREATE TABLE `briz_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `briz_postmeta`
--

INSERT INTO `briz_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 3, '_wp_page_template', 'default'),
(3, 2, '_edit_lock', '1554981702:1'),
(8, 8, '_edit_last', '1'),
(9, 8, '_edit_lock', '1554978990:1'),
(10, 10, '_edit_last', '1'),
(11, 10, '_edit_lock', '1554982774:1'),
(12, 12, '_edit_last', '1'),
(13, 12, '_edit_lock', '1554979015:1'),
(14, 14, '_edit_last', '1'),
(15, 14, '_edit_lock', '1554979044:1'),
(16, 16, '_edit_last', '1'),
(17, 16, '_edit_lock', '1554979072:1'),
(18, 18, '_edit_last', '1'),
(19, 18, '_edit_lock', '1554979086:1'),
(20, 20, '_edit_last', '1'),
(21, 20, '_edit_lock', '1554988646:1'),
(22, 22, '_edit_last', '1'),
(23, 22, '_edit_lock', '1554987350:1'),
(24, 26, '_edit_last', '1'),
(25, 26, '_edit_lock', '1554979163:1'),
(26, 3, '_edit_lock', '1554979184:1'),
(27, 3, '_edit_last', '1'),
(28, 29, '_edit_last', '1'),
(29, 29, '_edit_lock', '1554979189:1'),
(30, 31, '_menu_item_type', 'post_type'),
(31, 31, '_menu_item_menu_item_parent', '0'),
(32, 31, '_menu_item_object_id', '10'),
(33, 31, '_menu_item_object', 'page'),
(34, 31, '_menu_item_target', ''),
(35, 31, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(36, 31, '_menu_item_xfn', ''),
(37, 31, '_menu_item_url', ''),
(39, 32, '_menu_item_type', 'post_type'),
(40, 32, '_menu_item_menu_item_parent', '0'),
(41, 32, '_menu_item_object_id', '8'),
(42, 32, '_menu_item_object', 'page'),
(43, 32, '_menu_item_target', ''),
(44, 32, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(45, 32, '_menu_item_xfn', ''),
(46, 32, '_menu_item_url', ''),
(48, 33, '_menu_item_type', 'post_type'),
(49, 33, '_menu_item_menu_item_parent', '0'),
(50, 33, '_menu_item_object_id', '14'),
(51, 33, '_menu_item_object', 'page'),
(52, 33, '_menu_item_target', ''),
(53, 33, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(54, 33, '_menu_item_xfn', ''),
(55, 33, '_menu_item_url', ''),
(57, 34, '_menu_item_type', 'post_type'),
(58, 34, '_menu_item_menu_item_parent', '0'),
(59, 34, '_menu_item_object_id', '12'),
(60, 34, '_menu_item_object', 'page'),
(61, 34, '_menu_item_target', ''),
(62, 34, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(63, 34, '_menu_item_xfn', ''),
(64, 34, '_menu_item_url', ''),
(66, 35, '_menu_item_type', 'post_type'),
(67, 35, '_menu_item_menu_item_parent', '0'),
(68, 35, '_menu_item_object_id', '20'),
(69, 35, '_menu_item_object', 'page'),
(70, 35, '_menu_item_target', ''),
(71, 35, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(72, 35, '_menu_item_xfn', ''),
(73, 35, '_menu_item_url', ''),
(75, 36, '_menu_item_type', 'post_type'),
(76, 36, '_menu_item_menu_item_parent', '0'),
(77, 36, '_menu_item_object_id', '18'),
(78, 36, '_menu_item_object', 'page'),
(79, 36, '_menu_item_target', ''),
(80, 36, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(81, 36, '_menu_item_xfn', ''),
(82, 36, '_menu_item_url', ''),
(84, 37, '_menu_item_type', 'post_type'),
(85, 37, '_menu_item_menu_item_parent', '0'),
(86, 37, '_menu_item_object_id', '16'),
(87, 37, '_menu_item_object', 'page'),
(88, 37, '_menu_item_target', ''),
(89, 37, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(90, 37, '_menu_item_xfn', ''),
(91, 37, '_menu_item_url', ''),
(120, 41, '_menu_item_type', 'post_type'),
(121, 41, '_menu_item_menu_item_parent', '0'),
(122, 41, '_menu_item_object_id', '22'),
(123, 41, '_menu_item_object', 'page'),
(124, 41, '_menu_item_target', ''),
(125, 41, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(126, 41, '_menu_item_xfn', ''),
(127, 41, '_menu_item_url', ''),
(129, 42, '_menu_item_type', 'post_type'),
(130, 42, '_menu_item_menu_item_parent', '0'),
(131, 42, '_menu_item_object_id', '10'),
(132, 42, '_menu_item_object', 'page'),
(133, 42, '_menu_item_target', ''),
(134, 42, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(135, 42, '_menu_item_xfn', ''),
(136, 42, '_menu_item_url', ''),
(138, 43, '_menu_item_type', 'post_type'),
(139, 43, '_menu_item_menu_item_parent', '0'),
(140, 43, '_menu_item_object_id', '8'),
(141, 43, '_menu_item_object', 'page'),
(142, 43, '_menu_item_target', ''),
(143, 43, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(144, 43, '_menu_item_xfn', ''),
(145, 43, '_menu_item_url', ''),
(147, 44, '_menu_item_type', 'post_type'),
(148, 44, '_menu_item_menu_item_parent', '0'),
(149, 44, '_menu_item_object_id', '22'),
(150, 44, '_menu_item_object', 'page'),
(151, 44, '_menu_item_target', ''),
(152, 44, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(153, 44, '_menu_item_xfn', ''),
(154, 44, '_menu_item_url', ''),
(156, 45, '_menu_item_type', 'post_type'),
(157, 45, '_menu_item_menu_item_parent', '0'),
(158, 45, '_menu_item_object_id', '12'),
(159, 45, '_menu_item_object', 'page'),
(160, 45, '_menu_item_target', ''),
(161, 45, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(162, 45, '_menu_item_xfn', ''),
(163, 45, '_menu_item_url', ''),
(165, 46, '_menu_item_type', 'post_type'),
(166, 46, '_menu_item_menu_item_parent', '0'),
(167, 46, '_menu_item_object_id', '29'),
(168, 46, '_menu_item_object', 'page'),
(169, 46, '_menu_item_target', ''),
(170, 46, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(171, 46, '_menu_item_xfn', ''),
(172, 46, '_menu_item_url', ''),
(174, 47, '_menu_item_type', 'post_type'),
(175, 47, '_menu_item_menu_item_parent', '0'),
(176, 47, '_menu_item_object_id', '26'),
(177, 47, '_menu_item_object', 'page'),
(178, 47, '_menu_item_target', ''),
(179, 47, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(180, 47, '_menu_item_xfn', ''),
(181, 47, '_menu_item_url', ''),
(183, 48, '_menu_item_type', 'post_type'),
(184, 48, '_menu_item_menu_item_parent', '0'),
(185, 48, '_menu_item_object_id', '3'),
(186, 48, '_menu_item_object', 'page'),
(187, 48, '_menu_item_target', ''),
(188, 48, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(189, 48, '_menu_item_xfn', ''),
(190, 48, '_menu_item_url', ''),
(192, 49, '_edit_last', '1'),
(193, 49, '_edit_lock', '1554979960:1'),
(194, 55, '_edit_last', '1'),
(195, 55, '_edit_lock', '1554987021:1'),
(196, 2, '_edit_last', '1'),
(197, 2, 'h1', 'eTransport for Smart Cities'),
(198, 2, '_h1', 'field_5caf1d07b75c0'),
(199, 2, 'main_link_title', 'Download App'),
(200, 2, '_main_link_title', 'field_5caf1d15b75c1'),
(201, 2, 'main_link_url', ''),
(202, 2, '_main_link_url', 'field_5caf1d2bb75c3'),
(203, 2, 'block_1_heading', 'Enjoy your ride'),
(204, 2, '_block_1_heading', 'field_5caf1d4cb75c5'),
(205, 2, 'block_1_text', 'Enjoy your ride. We offer dock‐less e­‐scooters<br> rentals to facilitate last-­mile urban trips. We<br> \r\n                    are committed to providing you with a simple,<br> \r\n                    accessible, dependable, healthy, and green<br> \r\n                    way to travel.'),
(206, 2, '_block_1_text', 'field_5caf1d3eb75c4'),
(207, 2, 'block_1_image', '67'),
(208, 2, '_block_1_image', 'field_5caf1d55b75c6'),
(209, 2, 'block_2_heading', 'Best city solution'),
(210, 2, '_block_2_heading', 'field_5caf1d66b75c7'),
(211, 2, 'block_2_text', 'This is a smart, decentralized mobility<br> platform. We distribute shared electric<br> \r\n                    scooters that can be unlocked with a<br> \r\n                    smartphone. Users don’t need a key, cash,<br> \r\n                    physical IDs, or a deposit. After a few quick<br> \r\n                    steps in the app, anyone can hop on and ride.'),
(212, 2, '_block_2_text', 'field_5caf1d69b75c8'),
(213, 2, 'block_2_image', '68'),
(214, 2, '_block_2_image', 'field_5caf1d6bb75c9'),
(215, 2, 'ios', ''),
(216, 2, '_ios', 'field_5caf1cdec3bd1'),
(217, 2, 'android', ''),
(218, 2, '_android', 'field_5caf1ce5c3bd2'),
(219, 2, 'twitter', ''),
(220, 2, '_twitter', 'field_5caf1cd1c3bcf'),
(221, 2, 'facebook', ''),
(222, 2, '_facebook', 'field_5caf1cc2c3bce'),
(223, 2, 'instagram', ''),
(224, 2, '_instagram', 'field_5caf1cd7c3bd0'),
(225, 65, 'h1', 'eTransport for Smart Cities'),
(226, 65, '_h1', 'field_5caf1d07b75c0'),
(227, 65, 'main_link_title', 'Download App'),
(228, 65, '_main_link_title', 'field_5caf1d15b75c1'),
(229, 65, 'main_link_url', ''),
(230, 65, '_main_link_url', 'field_5caf1d2bb75c3'),
(231, 65, 'block_1_heading', ''),
(232, 65, '_block_1_heading', 'field_5caf1d4cb75c5'),
(233, 65, 'block_1_text', ''),
(234, 65, '_block_1_text', 'field_5caf1d3eb75c4'),
(235, 65, 'block_1_image', ''),
(236, 65, '_block_1_image', 'field_5caf1d55b75c6'),
(237, 65, 'block_2_heading', ''),
(238, 65, '_block_2_heading', 'field_5caf1d66b75c7'),
(239, 65, 'block_2_text', ''),
(240, 65, '_block_2_text', 'field_5caf1d69b75c8'),
(241, 65, 'block_2_image', ''),
(242, 65, '_block_2_image', 'field_5caf1d6bb75c9'),
(243, 65, 'ios', ''),
(244, 65, '_ios', 'field_5caf1cdec3bd1'),
(245, 65, 'android', ''),
(246, 65, '_android', 'field_5caf1ce5c3bd2'),
(247, 65, 'twitter', ''),
(248, 65, '_twitter', 'field_5caf1cd1c3bcf'),
(249, 65, 'facebook', ''),
(250, 65, '_facebook', 'field_5caf1cc2c3bce'),
(251, 65, 'instagram', ''),
(252, 65, '_instagram', 'field_5caf1cd7c3bd0'),
(253, 66, 'h1', 'eTransport for Smart Cities'),
(254, 66, '_h1', 'field_5caf1d07b75c0'),
(255, 66, 'main_link_title', 'Download App'),
(256, 66, '_main_link_title', 'field_5caf1d15b75c1'),
(257, 66, 'main_link_url', ''),
(258, 66, '_main_link_url', 'field_5caf1d2bb75c3'),
(259, 66, 'block_1_heading', 'Enjoy your ride'),
(260, 66, '_block_1_heading', 'field_5caf1d4cb75c5'),
(261, 66, 'block_1_text', 'Enjoy your ride. We offer dock‐less e­‐scooters<br> rentals to facilitate last-­mile urban trips. We<br> \r\n                    are committed to providing you with a simple,<br> \r\n                    accessible, dependable, healthy, and green<br> \r\n                    way to travel.'),
(262, 66, '_block_1_text', 'field_5caf1d3eb75c4'),
(263, 66, 'block_1_image', ''),
(264, 66, '_block_1_image', 'field_5caf1d55b75c6'),
(265, 66, 'block_2_heading', 'Best city solution'),
(266, 66, '_block_2_heading', 'field_5caf1d66b75c7'),
(267, 66, 'block_2_text', 'This is a smart, decentralized mobility<br> platform. We distribute shared electric<br> \r\n                    scooters that can be unlocked with a<br> \r\n                    smartphone. Users don’t need a key, cash,<br> \r\n                    physical IDs, or a deposit. After a few quick<br> \r\n                    steps in the app, anyone can hop on and ride.'),
(268, 66, '_block_2_text', 'field_5caf1d69b75c8'),
(269, 66, 'block_2_image', ''),
(270, 66, '_block_2_image', 'field_5caf1d6bb75c9'),
(271, 66, 'ios', ''),
(272, 66, '_ios', 'field_5caf1cdec3bd1'),
(273, 66, 'android', ''),
(274, 66, '_android', 'field_5caf1ce5c3bd2'),
(275, 66, 'twitter', ''),
(276, 66, '_twitter', 'field_5caf1cd1c3bcf'),
(277, 66, 'facebook', ''),
(278, 66, '_facebook', 'field_5caf1cc2c3bce'),
(279, 66, 'instagram', ''),
(280, 66, '_instagram', 'field_5caf1cd7c3bd0'),
(281, 67, '_wp_attached_file', '2019/04/scooter.png'),
(282, 67, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:726;s:6:\"height\";i:760;s:4:\"file\";s:19:\"2019/04/scooter.png\";s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:19:\"scooter-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:6:\"medium\";a:4:{s:4:\"file\";s:19:\"scooter-287x300.png\";s:5:\"width\";i:287;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(283, 68, '_wp_attached_file', '2019/04/phone.png'),
(284, 68, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:864;s:6:\"height\";i:1722;s:4:\"file\";s:17:\"2019/04/phone.png\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:17:\"phone-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:6:\"medium\";a:4:{s:4:\"file\";s:17:\"phone-151x300.png\";s:5:\"width\";i:151;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:18:\"phone-768x1531.png\";s:5:\"width\";i:768;s:6:\"height\";i:1531;s:9:\"mime-type\";s:9:\"image/png\";}s:5:\"large\";a:4:{s:4:\"file\";s:18:\"phone-514x1024.png\";s:5:\"width\";i:514;s:6:\"height\";i:1024;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(285, 69, 'h1', 'eTransport for Smart Cities'),
(286, 69, '_h1', 'field_5caf1d07b75c0'),
(287, 69, 'main_link_title', 'Download App'),
(288, 69, '_main_link_title', 'field_5caf1d15b75c1'),
(289, 69, 'main_link_url', ''),
(290, 69, '_main_link_url', 'field_5caf1d2bb75c3'),
(291, 69, 'block_1_heading', 'Enjoy your ride'),
(292, 69, '_block_1_heading', 'field_5caf1d4cb75c5'),
(293, 69, 'block_1_text', 'Enjoy your ride. We offer dock‐less e­‐scooters<br> rentals to facilitate last-­mile urban trips. We<br> \r\n                    are committed to providing you with a simple,<br> \r\n                    accessible, dependable, healthy, and green<br> \r\n                    way to travel.'),
(294, 69, '_block_1_text', 'field_5caf1d3eb75c4'),
(295, 69, 'block_1_image', '67'),
(296, 69, '_block_1_image', 'field_5caf1d55b75c6'),
(297, 69, 'block_2_heading', 'Best city solution'),
(298, 69, '_block_2_heading', 'field_5caf1d66b75c7'),
(299, 69, 'block_2_text', 'This is a smart, decentralized mobility<br> platform. We distribute shared electric<br> \r\n                    scooters that can be unlocked with a<br> \r\n                    smartphone. Users don’t need a key, cash,<br> \r\n                    physical IDs, or a deposit. After a few quick<br> \r\n                    steps in the app, anyone can hop on and ride.'),
(300, 69, '_block_2_text', 'field_5caf1d69b75c8'),
(301, 69, 'block_2_image', '68'),
(302, 69, '_block_2_image', 'field_5caf1d6bb75c9'),
(303, 69, 'ios', ''),
(304, 69, '_ios', 'field_5caf1cdec3bd1'),
(305, 69, 'android', ''),
(306, 69, '_android', 'field_5caf1ce5c3bd2'),
(307, 69, 'twitter', ''),
(308, 69, '_twitter', 'field_5caf1cd1c3bcf'),
(309, 69, 'facebook', ''),
(310, 69, '_facebook', 'field_5caf1cc2c3bce'),
(311, 69, 'instagram', ''),
(312, 69, '_instagram', 'field_5caf1cd7c3bd0'),
(313, 10, '_wp_page_template', 'safety.php'),
(314, 70, '_edit_last', '1'),
(315, 70, '_edit_lock', '1554982797:1'),
(316, 79, '_wp_attached_file', '2019/04/safety1.png'),
(317, 79, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:250;s:6:\"height\";i:375;s:4:\"file\";s:19:\"2019/04/safety1.png\";s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:19:\"safety1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:6:\"medium\";a:4:{s:4:\"file\";s:19:\"safety1-200x300.png\";s:5:\"width\";i:200;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(318, 80, '_wp_attached_file', '2019/04/safety2.png'),
(319, 80, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:250;s:6:\"height\";i:375;s:4:\"file\";s:19:\"2019/04/safety2.png\";s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:19:\"safety2-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:6:\"medium\";a:4:{s:4:\"file\";s:19:\"safety2-200x300.png\";s:5:\"width\";i:200;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(320, 81, '_wp_attached_file', '2019/04/safety3.png'),
(321, 81, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:250;s:6:\"height\";i:375;s:4:\"file\";s:19:\"2019/04/safety3.png\";s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:19:\"safety3-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:6:\"medium\";a:4:{s:4:\"file\";s:19:\"safety3-200x300.png\";s:5:\"width\";i:200;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(322, 82, '_wp_attached_file', '2019/04/safety4.png'),
(323, 82, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:250;s:6:\"height\";i:375;s:4:\"file\";s:19:\"2019/04/safety4.png\";s:5:\"sizes\";a:2:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:19:\"safety4-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:6:\"medium\";a:4:{s:4:\"file\";s:19:\"safety4-200x300.png\";s:5:\"width\";i:200;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(324, 83, '_wp_attached_file', '2019/04/scooter1.png'),
(325, 83, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:256;s:6:\"height\";i:254;s:4:\"file\";s:20:\"2019/04/scooter1.png\";s:5:\"sizes\";a:1:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:20:\"scooter1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(326, 84, '_wp_attached_file', '2019/04/scooter2.png'),
(327, 84, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:256;s:6:\"height\";i:252;s:4:\"file\";s:20:\"2019/04/scooter2.png\";s:5:\"sizes\";a:1:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:20:\"scooter2-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(328, 10, 'section_0_h4', 'More wheels,<br> more ways'),
(329, 10, '_section_0_h4', 'field_5caf2540ba87c'),
(330, 10, 'section_0_paragraph', 'Improving people’s lives with the world’s best<br> transportation calls for more than just cars<br> — that’s why we’re adding scooters to the<br> Lyft lineup.'),
(331, 10, '_section_0_paragraph', 'field_5caf2545ba87d'),
(332, 10, 'section_0_image', '83'),
(333, 10, '_section_0_image', 'field_5caf254cba87e'),
(334, 10, 'section_1_h4', 'Get Started'),
(335, 10, '_section_1_h4', 'field_5caf2540ba87c'),
(336, 10, 'section_1_paragraph', 'When scooters are available in San Diego, they will appear in the “Nearby” section in your app. Tap the icon to reserve a scooter ahead of time. Scooters are just $1 to unlock and 15 cents per minute to ride.'),
(337, 10, '_section_1_paragraph', 'field_5caf2545ba87d'),
(338, 10, 'section_1_image', '84'),
(339, 10, '_section_1_image', 'field_5caf254cba87e'),
(340, 10, 'section', '2'),
(341, 10, '_section', 'field_5caf2524ba87a'),
(342, 10, 'block_0_h4', 'Agency Site'),
(343, 10, '_block_0_h4', 'field_5caf2568ba880'),
(344, 10, 'block_0_paragraph', 'Helmets keep you safe. Wear one. (All the cool kids are doing it.)'),
(345, 10, '_block_0_paragraph', 'field_5caf2568ba881'),
(346, 10, 'block_0_image', '79'),
(347, 10, '_block_0_image', 'field_5caf2568ba882'),
(348, 10, 'block_1_h4', 'Freelance'),
(349, 10, '_block_1_h4', 'field_5caf2568ba880'),
(350, 10, 'block_1_paragraph', 'Helmets keep you safe. Wear one. (All the cool kids are doing it.)'),
(351, 10, '_block_1_paragraph', 'field_5caf2568ba881'),
(352, 10, 'block_1_image', '80'),
(353, 10, '_block_1_image', 'field_5caf2568ba882'),
(354, 10, 'block_2_h4', 'Ecommerce'),
(355, 10, '_block_2_h4', 'field_5caf2568ba880'),
(356, 10, 'block_2_paragraph', 'Helmets keep you safe. Wear one. (All the cool kids are doing it.)'),
(357, 10, '_block_2_paragraph', 'field_5caf2568ba881'),
(358, 10, 'block_2_image', '81'),
(359, 10, '_block_2_image', 'field_5caf2568ba882'),
(360, 10, 'block_3_h4', 'Essentials'),
(361, 10, '_block_3_h4', 'field_5caf2568ba880'),
(362, 10, 'block_3_paragraph', 'Helmets keep you safe. Wear one. (All the cool kids are doing it.)'),
(363, 10, '_block_3_paragraph', 'field_5caf2568ba881'),
(364, 10, 'block_3_image', '82'),
(365, 10, '_block_3_image', 'field_5caf2568ba882'),
(366, 10, 'block', '4'),
(367, 10, '_block', 'field_5caf2568ba87f'),
(368, 85, 'section_0_h4', 'More wheels,<br> more ways'),
(369, 85, '_section_0_h4', 'field_5caf2540ba87c'),
(370, 85, 'section_0_paragraph', 'Improving people’s lives with the world’s best<br> transportation calls for more than just cars<br> — that’s why we’re adding scooters to the<br> Lyft lineup.'),
(371, 85, '_section_0_paragraph', 'field_5caf2545ba87d'),
(372, 85, 'section_0_image', '83'),
(373, 85, '_section_0_image', 'field_5caf254cba87e'),
(374, 85, 'section_1_h4', 'Get Started'),
(375, 85, '_section_1_h4', 'field_5caf2540ba87c'),
(376, 85, 'section_1_paragraph', 'When scooters are available in San Diego, they will appear in the “Nearby” section in your app. Tap the icon to reserve a scooter ahead of time. Scooters are just $1 to unlock and 15 cents per minute to ride.'),
(377, 85, '_section_1_paragraph', 'field_5caf2545ba87d'),
(378, 85, 'section_1_image', '84'),
(379, 85, '_section_1_image', 'field_5caf254cba87e'),
(380, 85, 'section', '2'),
(381, 85, '_section', 'field_5caf2524ba87a'),
(382, 85, 'block_0_h4', 'Agency Site'),
(383, 85, '_block_0_h4', 'field_5caf2568ba880'),
(384, 85, 'block_0_paragraph', 'Helmets keep you safe. Wear one. (All the cool kids are doing it.)'),
(385, 85, '_block_0_paragraph', 'field_5caf2568ba881'),
(386, 85, 'block_0_image', '79'),
(387, 85, '_block_0_image', 'field_5caf2568ba882'),
(388, 85, 'block_1_h4', 'Freelance'),
(389, 85, '_block_1_h4', 'field_5caf2568ba880'),
(390, 85, 'block_1_paragraph', 'Helmets keep you safe. Wear one. (All the cool kids are doing it.)'),
(391, 85, '_block_1_paragraph', 'field_5caf2568ba881'),
(392, 85, 'block_1_image', '80'),
(393, 85, '_block_1_image', 'field_5caf2568ba882'),
(394, 85, 'block_2_h4', 'Ecommerce'),
(395, 85, '_block_2_h4', 'field_5caf2568ba880'),
(396, 85, 'block_2_paragraph', 'Helmets keep you safe. Wear one. (All the cool kids are doing it.)'),
(397, 85, '_block_2_paragraph', 'field_5caf2568ba881'),
(398, 85, 'block_2_image', '81'),
(399, 85, '_block_2_image', 'field_5caf2568ba882'),
(400, 85, 'block_3_h4', 'Essentials'),
(401, 85, '_block_3_h4', 'field_5caf2568ba880'),
(402, 85, 'block_3_paragraph', 'Helmets keep you safe. Wear one. (All the cool kids are doing it.)'),
(403, 85, '_block_3_paragraph', 'field_5caf2568ba881'),
(404, 85, 'block_3_image', '82'),
(405, 85, '_block_3_image', 'field_5caf2568ba882'),
(406, 85, 'block', '4'),
(407, 85, '_block', 'field_5caf2568ba87f'),
(408, 10, 'section_0_effect', 'fadeInRight'),
(409, 10, '_section_0_effect', 'field_5caf266c56e5e'),
(410, 10, 'section_1_effect', 'fadeInLeft'),
(411, 10, '_section_1_effect', 'field_5caf266c56e5e'),
(412, 10, 'block_0_effect', 'fadeInRight'),
(413, 10, '_block_0_effect', 'field_5caf26798127f'),
(414, 10, 'block_1_effect', 'fadeInLeft'),
(415, 10, '_block_1_effect', 'field_5caf26798127f'),
(416, 10, 'block_2_effect', 'fadeInRight'),
(417, 10, '_block_2_effect', 'field_5caf26798127f'),
(418, 10, 'block_3_effect', 'fadeInLeft'),
(419, 10, '_block_3_effect', 'field_5caf26798127f'),
(420, 88, 'section_0_h4', 'More wheels,<br> more ways'),
(421, 88, '_section_0_h4', 'field_5caf2540ba87c'),
(422, 88, 'section_0_paragraph', 'Improving people’s lives with the world’s best<br> transportation calls for more than just cars<br> — that’s why we’re adding scooters to the<br> Lyft lineup.'),
(423, 88, '_section_0_paragraph', 'field_5caf2545ba87d'),
(424, 88, 'section_0_image', '83'),
(425, 88, '_section_0_image', 'field_5caf254cba87e'),
(426, 88, 'section_1_h4', 'Get Started'),
(427, 88, '_section_1_h4', 'field_5caf2540ba87c'),
(428, 88, 'section_1_paragraph', 'When scooters are available in San Diego, they will appear in the “Nearby” section in your app. Tap the icon to reserve a scooter ahead of time. Scooters are just $1 to unlock and 15 cents per minute to ride.'),
(429, 88, '_section_1_paragraph', 'field_5caf2545ba87d'),
(430, 88, 'section_1_image', '84'),
(431, 88, '_section_1_image', 'field_5caf254cba87e'),
(432, 88, 'section', '2'),
(433, 88, '_section', 'field_5caf2524ba87a'),
(434, 88, 'block_0_h4', 'Agency Site'),
(435, 88, '_block_0_h4', 'field_5caf2568ba880'),
(436, 88, 'block_0_paragraph', 'Helmets keep you safe. Wear one. (All the cool kids are doing it.)'),
(437, 88, '_block_0_paragraph', 'field_5caf2568ba881'),
(438, 88, 'block_0_image', '79'),
(439, 88, '_block_0_image', 'field_5caf2568ba882'),
(440, 88, 'block_1_h4', 'Freelance'),
(441, 88, '_block_1_h4', 'field_5caf2568ba880'),
(442, 88, 'block_1_paragraph', 'Helmets keep you safe. Wear one. (All the cool kids are doing it.)'),
(443, 88, '_block_1_paragraph', 'field_5caf2568ba881'),
(444, 88, 'block_1_image', '80'),
(445, 88, '_block_1_image', 'field_5caf2568ba882'),
(446, 88, 'block_2_h4', 'Ecommerce'),
(447, 88, '_block_2_h4', 'field_5caf2568ba880'),
(448, 88, 'block_2_paragraph', 'Helmets keep you safe. Wear one. (All the cool kids are doing it.)'),
(449, 88, '_block_2_paragraph', 'field_5caf2568ba881'),
(450, 88, 'block_2_image', '81'),
(451, 88, '_block_2_image', 'field_5caf2568ba882'),
(452, 88, 'block_3_h4', 'Essentials'),
(453, 88, '_block_3_h4', 'field_5caf2568ba880'),
(454, 88, 'block_3_paragraph', 'Helmets keep you safe. Wear one. (All the cool kids are doing it.)'),
(455, 88, '_block_3_paragraph', 'field_5caf2568ba881'),
(456, 88, 'block_3_image', '82'),
(457, 88, '_block_3_image', 'field_5caf2568ba882'),
(458, 88, 'block', '4'),
(459, 88, '_block', 'field_5caf2568ba87f'),
(460, 88, 'section_0_effect', 'fadeInRight'),
(461, 88, '_section_0_effect', 'field_5caf266c56e5e'),
(462, 88, 'section_1_effect', 'fadeInLeft'),
(463, 88, '_section_1_effect', 'field_5caf266c56e5e'),
(464, 88, 'block_0_effect', 'fadeInRight'),
(465, 88, '_block_0_effect', 'field_5caf26798127f'),
(466, 88, 'block_1_effect', 'fadeInLeft'),
(467, 88, '_block_1_effect', 'field_5caf26798127f'),
(468, 88, 'block_2_effect', 'fadeInRight'),
(469, 88, '_block_2_effect', 'field_5caf26798127f'),
(470, 88, 'block_3_effect', 'fadeInLeft'),
(471, 88, '_block_3_effect', 'field_5caf26798127f'),
(472, 22, '_wp_page_template', 'support.php'),
(473, 20, '_wp_page_template', 'faq.php'),
(474, 89, '_edit_last', '1'),
(475, 89, '_edit_lock', '1554988641:1'),
(476, 20, 'h1', 'So you have questions about scooters?'),
(477, 20, '_h1', 'field_5caf3ae91bc56'),
(478, 20, 'text', 'You\'ve got questions. Brize has answers. From \"How do I pay for a Brize\" to \"How do I locate a Brize near me\", find out all you need to know about our smart mobility service here.'),
(479, 20, '_text', 'field_5caf3aee1bc57'),
(480, 20, 'block_0_h2', 'How It Works'),
(481, 20, '_block_0_h2', 'field_5caf3b5bbbe42'),
(482, 20, 'block_0_questions_0_question', 'How do I download the app?'),
(483, 20, '_block_0_questions_0_question', 'field_5caf3b3ebbe40'),
(484, 20, 'block_0_questions_0_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(485, 20, '_block_0_questions_0_answer', 'field_5caf3b46bbe41'),
(486, 20, 'block_0_questions_1_question', 'How do I find a Lime near me?'),
(487, 20, '_block_0_questions_1_question', 'field_5caf3b3ebbe40'),
(488, 20, 'block_0_questions_1_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(489, 20, '_block_0_questions_1_answer', 'field_5caf3b46bbe41'),
(490, 20, 'block_0_questions_2_question', 'How do I unlock a Lime?'),
(491, 20, '_block_0_questions_2_question', 'field_5caf3b3ebbe40'),
(492, 20, 'block_0_questions_2_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(493, 20, '_block_0_questions_2_answer', 'field_5caf3b46bbe41'),
(494, 20, 'block_0_questions_3_question', 'Where can I ride a Lime?'),
(495, 20, '_block_0_questions_3_question', 'field_5caf3b3ebbe40'),
(496, 20, 'block_0_questions_3_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(497, 20, '_block_0_questions_3_answer', 'field_5caf3b46bbe41'),
(498, 20, 'block_0_questions_4_question', 'Where can I park a Lime?'),
(499, 20, '_block_0_questions_4_question', 'field_5caf3b3ebbe40'),
(500, 20, 'block_0_questions_4_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(501, 20, '_block_0_questions_4_answer', 'field_5caf3b46bbe41'),
(502, 20, 'block_0_questions_5_question', 'How do I end my ride?'),
(503, 20, '_block_0_questions_5_question', 'field_5caf3b3ebbe40'),
(504, 20, 'block_0_questions_5_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(505, 20, '_block_0_questions_5_answer', 'field_5caf3b46bbe41'),
(506, 20, 'block_0_questions', '6'),
(507, 20, '_block_0_questions', 'field_5caf3b2cbbe3f'),
(508, 20, 'block', '2'),
(509, 20, '_block', 'field_5caf3af31bc58'),
(510, 99, 'h1', 'So you have questions about scooters?'),
(511, 99, '_h1', 'field_5caf3ae91bc56'),
(512, 99, 'text', 'You\'ve got questions. Brize has answers. From \"How do I pay for a Brize\" to \"How do I locate a Brize near me\", find out all you need to know about our smart mobility service here.'),
(513, 99, '_text', 'field_5caf3aee1bc57'),
(514, 99, 'block_0_h2', 'How It Works'),
(515, 99, '_block_0_h2', 'field_5caf3b5bbbe42'),
(516, 99, 'block_0_questions_0_question', 'How do I download the app?'),
(517, 99, '_block_0_questions_0_question', 'field_5caf3b3ebbe40'),
(518, 99, 'block_0_questions_0_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(519, 99, '_block_0_questions_0_answer', 'field_5caf3b46bbe41'),
(520, 99, 'block_0_questions_1_question', 'How do I find a Lime near me?'),
(521, 99, '_block_0_questions_1_question', 'field_5caf3b3ebbe40'),
(522, 99, 'block_0_questions_1_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(523, 99, '_block_0_questions_1_answer', 'field_5caf3b46bbe41'),
(524, 99, 'block_0_questions_2_question', 'How do I unlock a Lime?'),
(525, 99, '_block_0_questions_2_question', 'field_5caf3b3ebbe40'),
(526, 99, 'block_0_questions_2_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(527, 99, '_block_0_questions_2_answer', 'field_5caf3b46bbe41'),
(528, 99, 'block_0_questions_3_question', 'Where can I ride a Lime?'),
(529, 99, '_block_0_questions_3_question', 'field_5caf3b3ebbe40'),
(530, 99, 'block_0_questions_3_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(531, 99, '_block_0_questions_3_answer', 'field_5caf3b46bbe41'),
(532, 99, 'block_0_questions_4_question', 'Where can I park a Lime?'),
(533, 99, '_block_0_questions_4_question', 'field_5caf3b3ebbe40'),
(534, 99, 'block_0_questions_4_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(535, 99, '_block_0_questions_4_answer', 'field_5caf3b46bbe41'),
(536, 99, 'block_0_questions_5_question', 'How do I end my ride?'),
(537, 99, '_block_0_questions_5_question', 'field_5caf3b3ebbe40'),
(538, 99, 'block_0_questions_5_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(539, 99, '_block_0_questions_5_answer', 'field_5caf3b46bbe41'),
(540, 99, 'block_0_questions', '6'),
(541, 99, '_block_0_questions', 'field_5caf3b2cbbe3f'),
(542, 99, 'block', '1'),
(543, 99, '_block', 'field_5caf3af31bc58'),
(544, 20, 'block_1_h2', 'Payment'),
(545, 20, '_block_1_h2', 'field_5caf3b5bbbe42'),
(546, 20, 'block_1_questions_0_question', 'How do I download the app?'),
(547, 20, '_block_1_questions_0_question', 'field_5caf3b3ebbe40'),
(548, 20, 'block_1_questions_0_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(549, 20, '_block_1_questions_0_answer', 'field_5caf3b46bbe41'),
(550, 20, 'block_1_questions_1_question', 'How do I find a Lime near me?'),
(551, 20, '_block_1_questions_1_question', 'field_5caf3b3ebbe40'),
(552, 20, 'block_1_questions_1_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(553, 20, '_block_1_questions_1_answer', 'field_5caf3b46bbe41'),
(554, 20, 'block_1_questions_2_question', 'How do I unlock a Lime?'),
(555, 20, '_block_1_questions_2_question', 'field_5caf3b3ebbe40'),
(556, 20, 'block_1_questions_2_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(557, 20, '_block_1_questions_2_answer', 'field_5caf3b46bbe41'),
(558, 20, 'block_1_questions_3_question', 'Where can I ride a Lime?'),
(559, 20, '_block_1_questions_3_question', 'field_5caf3b3ebbe40'),
(560, 20, 'block_1_questions_3_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(561, 20, '_block_1_questions_3_answer', 'field_5caf3b46bbe41'),
(562, 20, 'block_1_questions_4_question', 'Where can I park a Lime?'),
(563, 20, '_block_1_questions_4_question', 'field_5caf3b3ebbe40'),
(564, 20, 'block_1_questions_4_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(565, 20, '_block_1_questions_4_answer', 'field_5caf3b46bbe41'),
(566, 20, 'block_1_questions_5_question', 'How do I end my ride?'),
(567, 20, '_block_1_questions_5_question', 'field_5caf3b3ebbe40'),
(568, 20, 'block_1_questions_5_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(569, 20, '_block_1_questions_5_answer', 'field_5caf3b46bbe41'),
(570, 20, 'block_1_questions', '6'),
(571, 20, '_block_1_questions', 'field_5caf3b2cbbe3f'),
(572, 100, 'h1', 'So you have questions about scooters?'),
(573, 100, '_h1', 'field_5caf3ae91bc56'),
(574, 100, 'text', 'You\'ve got questions. Brize has answers. From \"How do I pay for a Brize\" to \"How do I locate a Brize near me\", find out all you need to know about our smart mobility service here.'),
(575, 100, '_text', 'field_5caf3aee1bc57'),
(576, 100, 'block_0_h2', 'How It Works'),
(577, 100, '_block_0_h2', 'field_5caf3b5bbbe42'),
(578, 100, 'block_0_questions_0_question', 'How do I download the app?'),
(579, 100, '_block_0_questions_0_question', 'field_5caf3b3ebbe40'),
(580, 100, 'block_0_questions_0_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(581, 100, '_block_0_questions_0_answer', 'field_5caf3b46bbe41'),
(582, 100, 'block_0_questions_1_question', 'How do I find a Lime near me?'),
(583, 100, '_block_0_questions_1_question', 'field_5caf3b3ebbe40'),
(584, 100, 'block_0_questions_1_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(585, 100, '_block_0_questions_1_answer', 'field_5caf3b46bbe41'),
(586, 100, 'block_0_questions_2_question', 'How do I unlock a Lime?'),
(587, 100, '_block_0_questions_2_question', 'field_5caf3b3ebbe40'),
(588, 100, 'block_0_questions_2_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(589, 100, '_block_0_questions_2_answer', 'field_5caf3b46bbe41'),
(590, 100, 'block_0_questions_3_question', 'Where can I ride a Lime?'),
(591, 100, '_block_0_questions_3_question', 'field_5caf3b3ebbe40'),
(592, 100, 'block_0_questions_3_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(593, 100, '_block_0_questions_3_answer', 'field_5caf3b46bbe41'),
(594, 100, 'block_0_questions_4_question', 'Where can I park a Lime?'),
(595, 100, '_block_0_questions_4_question', 'field_5caf3b3ebbe40'),
(596, 100, 'block_0_questions_4_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(597, 100, '_block_0_questions_4_answer', 'field_5caf3b46bbe41'),
(598, 100, 'block_0_questions_5_question', 'How do I end my ride?'),
(599, 100, '_block_0_questions_5_question', 'field_5caf3b3ebbe40'),
(600, 100, 'block_0_questions_5_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(601, 100, '_block_0_questions_5_answer', 'field_5caf3b46bbe41'),
(602, 100, 'block_0_questions', '6'),
(603, 100, '_block_0_questions', 'field_5caf3b2cbbe3f'),
(604, 100, 'block', '2'),
(605, 100, '_block', 'field_5caf3af31bc58'),
(606, 100, 'block_1_h2', 'Payment'),
(607, 100, '_block_1_h2', 'field_5caf3b5bbbe42'),
(608, 100, 'block_1_questions_0_question', 'How do I download the app?'),
(609, 100, '_block_1_questions_0_question', 'field_5caf3b3ebbe40'),
(610, 100, 'block_1_questions_0_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(611, 100, '_block_1_questions_0_answer', 'field_5caf3b46bbe41'),
(612, 100, 'block_1_questions_1_question', 'How do I find a Lime near me?'),
(613, 100, '_block_1_questions_1_question', 'field_5caf3b3ebbe40'),
(614, 100, 'block_1_questions_1_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(615, 100, '_block_1_questions_1_answer', 'field_5caf3b46bbe41'),
(616, 100, 'block_1_questions_2_question', 'How do I unlock a Lime?'),
(617, 100, '_block_1_questions_2_question', 'field_5caf3b3ebbe40'),
(618, 100, 'block_1_questions_2_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(619, 100, '_block_1_questions_2_answer', 'field_5caf3b46bbe41'),
(620, 100, 'block_1_questions_3_question', 'Where can I ride a Lime?'),
(621, 100, '_block_1_questions_3_question', 'field_5caf3b3ebbe40'),
(622, 100, 'block_1_questions_3_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(623, 100, '_block_1_questions_3_answer', 'field_5caf3b46bbe41'),
(624, 100, 'block_1_questions_4_question', 'Where can I park a Lime?'),
(625, 100, '_block_1_questions_4_question', 'field_5caf3b3ebbe40'),
(626, 100, 'block_1_questions_4_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(627, 100, '_block_1_questions_4_answer', 'field_5caf3b46bbe41'),
(628, 100, 'block_1_questions_5_question', 'How do I end my ride?'),
(629, 100, '_block_1_questions_5_question', 'field_5caf3b3ebbe40'),
(630, 100, 'block_1_questions_5_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(631, 100, '_block_1_questions_5_answer', 'field_5caf3b46bbe41'),
(632, 100, 'block_1_questions', '6'),
(633, 100, '_block_1_questions', 'field_5caf3b2cbbe3f'),
(634, 20, 'button_1_title', 'Contact support'),
(635, 20, '_button_1_title', 'field_5caf3df6345b3'),
(636, 20, 'button_1_url', ''),
(637, 20, '_button_1_url', 'field_5caf3dfd345b4'),
(638, 20, 'button_2_title', 'Visit help center'),
(639, 20, '_button_2_title', 'field_5caf3e03345b5'),
(640, 20, 'button_2_url', ''),
(641, 20, '_button_2_url', 'field_5caf3e09345b6'),
(642, 20, 'phone', '+7 495 000 04 95'),
(643, 20, '_phone', 'field_5caf3e0f345b7'),
(644, 106, 'h1', 'So you have questions about scooters?'),
(645, 106, '_h1', 'field_5caf3ae91bc56'),
(646, 106, 'text', 'You\'ve got questions. Brize has answers. From \"How do I pay for a Brize\" to \"How do I locate a Brize near me\", find out all you need to know about our smart mobility service here.'),
(647, 106, '_text', 'field_5caf3aee1bc57'),
(648, 106, 'block_0_h2', 'How It Works'),
(649, 106, '_block_0_h2', 'field_5caf3b5bbbe42'),
(650, 106, 'block_0_questions_0_question', 'How do I download the app?'),
(651, 106, '_block_0_questions_0_question', 'field_5caf3b3ebbe40'),
(652, 106, 'block_0_questions_0_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(653, 106, '_block_0_questions_0_answer', 'field_5caf3b46bbe41'),
(654, 106, 'block_0_questions_1_question', 'How do I find a Lime near me?'),
(655, 106, '_block_0_questions_1_question', 'field_5caf3b3ebbe40'),
(656, 106, 'block_0_questions_1_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(657, 106, '_block_0_questions_1_answer', 'field_5caf3b46bbe41'),
(658, 106, 'block_0_questions_2_question', 'How do I unlock a Lime?'),
(659, 106, '_block_0_questions_2_question', 'field_5caf3b3ebbe40'),
(660, 106, 'block_0_questions_2_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(661, 106, '_block_0_questions_2_answer', 'field_5caf3b46bbe41'),
(662, 106, 'block_0_questions_3_question', 'Where can I ride a Lime?'),
(663, 106, '_block_0_questions_3_question', 'field_5caf3b3ebbe40'),
(664, 106, 'block_0_questions_3_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(665, 106, '_block_0_questions_3_answer', 'field_5caf3b46bbe41'),
(666, 106, 'block_0_questions_4_question', 'Where can I park a Lime?'),
(667, 106, '_block_0_questions_4_question', 'field_5caf3b3ebbe40'),
(668, 106, 'block_0_questions_4_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(669, 106, '_block_0_questions_4_answer', 'field_5caf3b46bbe41'),
(670, 106, 'block_0_questions_5_question', 'How do I end my ride?'),
(671, 106, '_block_0_questions_5_question', 'field_5caf3b3ebbe40'),
(672, 106, 'block_0_questions_5_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(673, 106, '_block_0_questions_5_answer', 'field_5caf3b46bbe41'),
(674, 106, 'block_0_questions', '6'),
(675, 106, '_block_0_questions', 'field_5caf3b2cbbe3f'),
(676, 106, 'block', '2'),
(677, 106, '_block', 'field_5caf3af31bc58'),
(678, 106, 'block_1_h2', 'Payment'),
(679, 106, '_block_1_h2', 'field_5caf3b5bbbe42'),
(680, 106, 'block_1_questions_0_question', 'How do I download the app?'),
(681, 106, '_block_1_questions_0_question', 'field_5caf3b3ebbe40'),
(682, 106, 'block_1_questions_0_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(683, 106, '_block_1_questions_0_answer', 'field_5caf3b46bbe41'),
(684, 106, 'block_1_questions_1_question', 'How do I find a Lime near me?'),
(685, 106, '_block_1_questions_1_question', 'field_5caf3b3ebbe40'),
(686, 106, 'block_1_questions_1_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(687, 106, '_block_1_questions_1_answer', 'field_5caf3b46bbe41'),
(688, 106, 'block_1_questions_2_question', 'How do I unlock a Lime?'),
(689, 106, '_block_1_questions_2_question', 'field_5caf3b3ebbe40'),
(690, 106, 'block_1_questions_2_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(691, 106, '_block_1_questions_2_answer', 'field_5caf3b46bbe41'),
(692, 106, 'block_1_questions_3_question', 'Where can I ride a Lime?'),
(693, 106, '_block_1_questions_3_question', 'field_5caf3b3ebbe40'),
(694, 106, 'block_1_questions_3_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(695, 106, '_block_1_questions_3_answer', 'field_5caf3b46bbe41'),
(696, 106, 'block_1_questions_4_question', 'Where can I park a Lime?'),
(697, 106, '_block_1_questions_4_question', 'field_5caf3b3ebbe40');
INSERT INTO `briz_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(698, 106, 'block_1_questions_4_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(699, 106, '_block_1_questions_4_answer', 'field_5caf3b46bbe41'),
(700, 106, 'block_1_questions_5_question', 'How do I end my ride?'),
(701, 106, '_block_1_questions_5_question', 'field_5caf3b3ebbe40'),
(702, 106, 'block_1_questions_5_answer', 'To find a Lime near you, simply open the Lime app. You’ll automatically be taken to the map screen, showing all available Lime vehicles in your area. If you don’t see any vehicle icons displayed on the map, zoom out to search a wider area.'),
(703, 106, '_block_1_questions_5_answer', 'field_5caf3b46bbe41'),
(704, 106, 'block_1_questions', '6'),
(705, 106, '_block_1_questions', 'field_5caf3b2cbbe3f'),
(706, 106, 'button_1_title', 'Contact support'),
(707, 106, '_button_1_title', 'field_5caf3df6345b3'),
(708, 106, 'button_1_url', ''),
(709, 106, '_button_1_url', 'field_5caf3dfd345b4'),
(710, 106, 'button_2_title', 'Visit help center'),
(711, 106, '_button_2_title', 'field_5caf3e03345b5'),
(712, 106, 'button_2_url', ''),
(713, 106, '_button_2_url', 'field_5caf3e09345b6'),
(714, 106, 'phone', '+7 495 000 04 95'),
(715, 106, '_phone', 'field_5caf3e0f345b7');

-- --------------------------------------------------------

--
-- Структура таблицы `briz_posts`
--

CREATE TABLE `briz_posts` (
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
-- Дамп данных таблицы `briz_posts`
--

INSERT INTO `briz_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2019-04-10 19:02:03', '2019-04-10 16:02:03', '<!-- wp:paragraph -->\n<p>Добро пожаловать в WordPress. Это ваша первая запись. Отредактируйте или удалите ее, затем начинайте создавать!</p>\n<!-- /wp:paragraph -->', 'Привет, мир!', '', 'publish', 'open', 'open', '', '%d0%bf%d1%80%d0%b8%d0%b2%d0%b5%d1%82-%d0%bc%d0%b8%d1%80', '', '', '2019-04-10 19:02:03', '2019-04-10 16:02:03', '', 0, 'http://brizwp.aliveliyev.com/?p=1', 0, 'post', '', 1),
(2, 1, '2019-04-10 19:02:03', '2019-04-10 16:02:03', '', 'Home page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2019-04-11 14:23:49', '2019-04-11 11:23:49', '', 0, 'http://brizwp.aliveliyev.com/?page_id=2', 0, 'page', '', 0),
(3, 1, '2019-04-10 19:02:03', '2019-04-10 16:02:03', '<!-- wp:heading -->\r\n<h2>Кто мы</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Наш адрес сайта: http://brizwp.aliveliyev.com.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading -->\r\n<h2>Какие персональные данные мы собираем и с какой целью</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Комментарии</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Если посетитель оставляет комментарий на сайте, мы собираем данные указанные в форме комментария, а также IP адрес посетителя и данные user-agent браузера с целью определения спама.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Анонимизированная строка создаваемая из вашего адреса email (\"хеш\") может предоставляться сервису Gravatar, чтобы определить используете ли вы его. Политика конфиденциальности Gravatar доступна здесь: https://automattic.com/privacy/ . После одобрения комментария ваше изображение профиля будет видимым публично в контексте вашего комментария.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Медиафайлы</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Если вы зарегистрированный пользователь и загружаете фотографии на сайт, вам возможно следует избегать загрузки изображений с метаданными EXIF, так как они могут содержать данные вашего месторасположения по GPS. Посетители могут извлечь эту информацию скачав изображения с сайта.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Формы контактов</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Куки</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Если вы оставляете комментарий на нашем сайте, вы можете включить сохранение вашего имени, адреса email и вебсайта в куки. Это делается для вашего удобства, чтобы не заполнять данные снова при повторном комментировании. Эти куки хранятся в течение одного года.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Если у вас есть учетная запись на сайте и вы войдете в неё, мы установим временный куки для определения поддержки куки вашим браузером, куки не содержит никакой личной информации и удаляется при закрытии вашего браузера.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>При входе в учетную запись мы также устанавливаем несколько куки с данными входа и настройками экрана. Куки входа хранятся в течение двух дней, куки с настройками экрана - год. Если вы выберете возможность \"Запомнить меня\", данные о входе будут сохраняться в течение двух недель. При выходе из учетной записи куки входа будут удалены.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>При редактировании или публикации статьи в браузере будет сохранен дополнительный куки, он не содержит персональных данных и содержит только ID записи отредактированной вами, истекает через 1 день.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Встраиваемое содержимое других вебсайтов</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Статьи на этом сайте могут включать встраиваемое содержимое (например видео, изображения, статьи и др.), подобное содержимое ведет себя так же, как если бы посетитель зашел на другой сайт.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Эти сайты могут собирать данные о вас, использовать куки, внедрять дополнительное отслеживание третьей стороной и следить за вашим взаимодействием с внедренным содержимым, включая отслеживание взаимодействия, если у вас есть учетная запись и вы авторизовались на том сайте.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Веб-аналитика</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading -->\r\n<h2>С кем мы делимся вашими данными</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading -->\r\n<h2>Как долго мы храним ваши данные</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Если вы оставляете комментарий, то сам комментарий и его метаданные сохраняются неопределенно долго. Это делается для того, чтобы определять и одобрять последующие комментарии автоматически, вместо помещения их в очередь на одобрение.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Для пользователей с регистрацией на нашем сайте мы храним ту личную информацию, которую они указывают в своем профиле. Все пользователи могут видеть, редактировать или удалить свою информацию из профиля в любое время (кроме имени пользователя). Администрация вебсайта также может видеть и изменять эту информацию.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading -->\r\n<h2>Какие у вас права на ваши данные</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>При наличии учетной записи на сайте или если вы оставляли комментарии, то вы можете запросить файл экспорта персональных данных, которые мы сохранили о вас, включая предоставленные вами данные. Вы также можете запросить удаление этих данных, это не включает данные, которые мы обязаны хранить в административных целях, по закону или целях безопасности.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading -->\r\n<h2>Куда мы отправляем ваши данные</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Комментарии пользователей могут проверяться автоматическим сервисом определения спама.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading -->\r\n<h2>Ваша контактная информация</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading -->\r\n<h2>Дополнительная информация</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Как мы защищаем ваши данные</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Какие принимаются процедуры против взлома данных</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>От каких третьих сторон мы получаем данные</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Какие автоматические решения принимаются на основе данных пользователей</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Требования к раскрытию отраслевых нормативных требований</h3>\r\n<!-- /wp:heading -->', 'Privacy Policy', '', 'publish', 'closed', 'open', '', 'privacy-policy', '', '', '2019-04-11 13:42:00', '2019-04-11 10:42:00', '', 0, 'http://brizwp.aliveliyev.com/?page_id=3', 0, 'page', '', 0),
(7, 1, '2019-04-11 12:58:26', '2019-04-11 09:58:26', '', 'Home page', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2019-04-11 12:58:26', '2019-04-11 09:58:26', '', 2, 'http://brizwp.aliveliyev.com/2019/04/11/2-revision-v1/', 0, 'revision', '', 0),
(8, 1, '2019-04-11 13:38:48', '2019-04-11 10:38:48', '', 'How it works?', '', 'publish', 'closed', 'closed', '', 'how-it-works', '', '', '2019-04-11 13:38:48', '2019-04-11 10:38:48', '', 0, 'http://brizwp.aliveliyev.com/?page_id=8', 0, 'page', '', 0),
(9, 1, '2019-04-11 13:38:48', '2019-04-11 10:38:48', '', 'How it works?', '', 'inherit', 'closed', 'closed', '', '8-revision-v1', '', '', '2019-04-11 13:38:48', '2019-04-11 10:38:48', '', 8, 'http://brizwp.aliveliyev.com/8-revision-v1/', 0, 'revision', '', 0),
(10, 1, '2019-04-11 13:38:58', '2019-04-11 10:38:58', '', 'Safety', '', 'publish', 'closed', 'closed', '', 'safety', '', '', '2019-04-11 14:36:07', '2019-04-11 11:36:07', '', 0, 'http://brizwp.aliveliyev.com/?page_id=10', 0, 'page', '', 0),
(11, 1, '2019-04-11 13:38:58', '2019-04-11 10:38:58', '', 'Safety', '', 'inherit', 'closed', 'closed', '', '10-revision-v1', '', '', '2019-04-11 13:38:58', '2019-04-11 10:38:58', '', 10, 'http://brizwp.aliveliyev.com/10-revision-v1/', 0, 'revision', '', 0),
(12, 1, '2019-04-11 13:39:11', '2019-04-11 10:39:11', '', 'Become a Charger', '', 'publish', 'closed', 'closed', '', 'become-a-charger', '', '', '2019-04-11 13:39:11', '2019-04-11 10:39:11', '', 0, 'http://brizwp.aliveliyev.com/?page_id=12', 0, 'page', '', 0),
(13, 1, '2019-04-11 13:39:11', '2019-04-11 10:39:11', '', 'Become a Charger', '', 'inherit', 'closed', 'closed', '', '12-revision-v1', '', '', '2019-04-11 13:39:11', '2019-04-11 10:39:11', '', 12, 'http://brizwp.aliveliyev.com/12-revision-v1/', 0, 'revision', '', 0),
(14, 1, '2019-04-11 13:39:24', '2019-04-11 10:39:24', '', 'Region', '', 'publish', 'closed', 'closed', '', 'region', '', '', '2019-04-11 13:39:24', '2019-04-11 10:39:24', '', 0, 'http://brizwp.aliveliyev.com/?page_id=14', 0, 'page', '', 0),
(15, 1, '2019-04-11 13:39:24', '2019-04-11 10:39:24', '', 'Region', '', 'inherit', 'closed', 'closed', '', '14-revision-v1', '', '', '2019-04-11 13:39:24', '2019-04-11 10:39:24', '', 14, 'http://brizwp.aliveliyev.com/14-revision-v1/', 0, 'revision', '', 0),
(16, 1, '2019-04-11 13:40:07', '2019-04-11 10:40:07', '', 'Our Mission', '', 'publish', 'closed', 'closed', '', 'our-mission', '', '', '2019-04-11 13:40:07', '2019-04-11 10:40:07', '', 0, 'http://brizwp.aliveliyev.com/?page_id=16', 0, 'page', '', 0),
(17, 1, '2019-04-11 13:40:07', '2019-04-11 10:40:07', '', 'Our Mission', '', 'inherit', 'closed', 'closed', '', '16-revision-v1', '', '', '2019-04-11 13:40:07', '2019-04-11 10:40:07', '', 16, 'http://brizwp.aliveliyev.com/16-revision-v1/', 0, 'revision', '', 0),
(18, 1, '2019-04-11 13:40:24', '2019-04-11 10:40:24', '', 'About App', '', 'publish', 'closed', 'closed', '', 'about-app', '', '', '2019-04-11 13:40:24', '2019-04-11 10:40:24', '', 0, 'http://brizwp.aliveliyev.com/?page_id=18', 0, 'page', '', 0),
(19, 1, '2019-04-11 13:40:24', '2019-04-11 10:40:24', '', 'About App', '', 'inherit', 'closed', 'closed', '', '18-revision-v1', '', '', '2019-04-11 13:40:24', '2019-04-11 10:40:24', '', 18, 'http://brizwp.aliveliyev.com/18-revision-v1/', 0, 'revision', '', 0),
(20, 1, '2019-04-11 13:40:33', '2019-04-11 10:40:33', '', 'FAQ', '', 'publish', 'closed', 'closed', '', 'faq', '', '', '2019-04-11 16:18:50', '2019-04-11 13:18:50', '', 0, 'http://brizwp.aliveliyev.com/?page_id=20', 0, 'page', '', 0),
(21, 1, '2019-04-11 13:40:33', '2019-04-11 10:40:33', '', 'FAQ', '', 'inherit', 'closed', 'closed', '', '20-revision-v1', '', '', '2019-04-11 13:40:33', '2019-04-11 10:40:33', '', 20, 'http://brizwp.aliveliyev.com/20-revision-v1/', 0, 'revision', '', 0),
(22, 1, '2019-04-11 13:40:45', '2019-04-11 10:40:45', '', 'Support', '', 'publish', 'closed', 'closed', '', 'support', '', '', '2019-04-11 15:52:52', '2019-04-11 12:52:52', '', 0, 'http://brizwp.aliveliyev.com/?page_id=22', 0, 'page', '', 0),
(23, 1, '2019-04-11 13:40:45', '2019-04-11 10:40:45', '', 'How it works', '', 'inherit', 'closed', 'closed', '', '22-revision-v1', '', '', '2019-04-11 13:40:45', '2019-04-11 10:40:45', '', 22, 'http://brizwp.aliveliyev.com/22-revision-v1/', 0, 'revision', '', 0),
(25, 1, '2019-04-11 13:41:21', '2019-04-11 10:41:21', '', 'Support', '', 'inherit', 'closed', 'closed', '', '22-revision-v1', '', '', '2019-04-11 13:41:21', '2019-04-11 10:41:21', '', 22, 'http://brizwp.aliveliyev.com/22-revision-v1/', 0, 'revision', '', 0),
(26, 1, '2019-04-11 13:41:45', '2019-04-11 10:41:45', '', 'Terms&Conditions', '', 'publish', 'closed', 'closed', '', 'termsconditions', '', '', '2019-04-11 13:41:45', '2019-04-11 10:41:45', '', 0, 'http://brizwp.aliveliyev.com/?page_id=26', 0, 'page', '', 0),
(27, 1, '2019-04-11 13:41:45', '2019-04-11 10:41:45', '', 'Terms&Conditions', '', 'inherit', 'closed', 'closed', '', '26-revision-v1', '', '', '2019-04-11 13:41:45', '2019-04-11 10:41:45', '', 26, 'http://brizwp.aliveliyev.com/26-revision-v1/', 0, 'revision', '', 0),
(28, 1, '2019-04-11 13:42:00', '2019-04-11 10:42:00', '<!-- wp:heading -->\r\n<h2>Кто мы</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Наш адрес сайта: http://brizwp.aliveliyev.com.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading -->\r\n<h2>Какие персональные данные мы собираем и с какой целью</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Комментарии</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Если посетитель оставляет комментарий на сайте, мы собираем данные указанные в форме комментария, а также IP адрес посетителя и данные user-agent браузера с целью определения спама.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Анонимизированная строка создаваемая из вашего адреса email (\"хеш\") может предоставляться сервису Gravatar, чтобы определить используете ли вы его. Политика конфиденциальности Gravatar доступна здесь: https://automattic.com/privacy/ . После одобрения комментария ваше изображение профиля будет видимым публично в контексте вашего комментария.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Медиафайлы</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Если вы зарегистрированный пользователь и загружаете фотографии на сайт, вам возможно следует избегать загрузки изображений с метаданными EXIF, так как они могут содержать данные вашего месторасположения по GPS. Посетители могут извлечь эту информацию скачав изображения с сайта.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Формы контактов</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Куки</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Если вы оставляете комментарий на нашем сайте, вы можете включить сохранение вашего имени, адреса email и вебсайта в куки. Это делается для вашего удобства, чтобы не заполнять данные снова при повторном комментировании. Эти куки хранятся в течение одного года.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Если у вас есть учетная запись на сайте и вы войдете в неё, мы установим временный куки для определения поддержки куки вашим браузером, куки не содержит никакой личной информации и удаляется при закрытии вашего браузера.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>При входе в учетную запись мы также устанавливаем несколько куки с данными входа и настройками экрана. Куки входа хранятся в течение двух дней, куки с настройками экрана - год. Если вы выберете возможность \"Запомнить меня\", данные о входе будут сохраняться в течение двух недель. При выходе из учетной записи куки входа будут удалены.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>При редактировании или публикации статьи в браузере будет сохранен дополнительный куки, он не содержит персональных данных и содержит только ID записи отредактированной вами, истекает через 1 день.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Встраиваемое содержимое других вебсайтов</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Статьи на этом сайте могут включать встраиваемое содержимое (например видео, изображения, статьи и др.), подобное содержимое ведет себя так же, как если бы посетитель зашел на другой сайт.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Эти сайты могут собирать данные о вас, использовать куки, внедрять дополнительное отслеживание третьей стороной и следить за вашим взаимодействием с внедренным содержимым, включая отслеживание взаимодействия, если у вас есть учетная запись и вы авторизовались на том сайте.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Веб-аналитика</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading -->\r\n<h2>С кем мы делимся вашими данными</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading -->\r\n<h2>Как долго мы храним ваши данные</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Если вы оставляете комментарий, то сам комментарий и его метаданные сохраняются неопределенно долго. Это делается для того, чтобы определять и одобрять последующие комментарии автоматически, вместо помещения их в очередь на одобрение.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Для пользователей с регистрацией на нашем сайте мы храним ту личную информацию, которую они указывают в своем профиле. Все пользователи могут видеть, редактировать или удалить свою информацию из профиля в любое время (кроме имени пользователя). Администрация вебсайта также может видеть и изменять эту информацию.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading -->\r\n<h2>Какие у вас права на ваши данные</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>При наличии учетной записи на сайте или если вы оставляли комментарии, то вы можете запросить файл экспорта персональных данных, которые мы сохранили о вас, включая предоставленные вами данные. Вы также можете запросить удаление этих данных, это не включает данные, которые мы обязаны хранить в административных целях, по закону или целях безопасности.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading -->\r\n<h2>Куда мы отправляем ваши данные</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:paragraph -->\r\n<p>Комментарии пользователей могут проверяться автоматическим сервисом определения спама.</p>\r\n<!-- /wp:paragraph -->\r\n\r\n<!-- wp:heading -->\r\n<h2>Ваша контактная информация</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading -->\r\n<h2>Дополнительная информация</h2>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Как мы защищаем ваши данные</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Какие принимаются процедуры против взлома данных</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>От каких третьих сторон мы получаем данные</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Какие автоматические решения принимаются на основе данных пользователей</h3>\r\n<!-- /wp:heading -->\r\n\r\n<!-- wp:heading {\"level\":3} -->\r\n<h3>Требования к раскрытию отраслевых нормативных требований</h3>\r\n<!-- /wp:heading -->', 'Privacy Policy', '', 'inherit', 'closed', 'closed', '', '3-revision-v1', '', '', '2019-04-11 13:42:00', '2019-04-11 10:42:00', '', 3, 'http://brizwp.aliveliyev.com/3-revision-v1/', 0, 'revision', '', 0),
(29, 1, '2019-04-11 13:42:11', '2019-04-11 10:42:11', '', 'Rental Agreement', '', 'publish', 'closed', 'closed', '', 'rental-agreement', '', '', '2019-04-11 13:42:11', '2019-04-11 10:42:11', '', 0, 'http://brizwp.aliveliyev.com/?page_id=29', 0, 'page', '', 0),
(30, 1, '2019-04-11 13:42:11', '2019-04-11 10:42:11', '', 'Rental Agreement', '', 'inherit', 'closed', 'closed', '', '29-revision-v1', '', '', '2019-04-11 13:42:11', '2019-04-11 10:42:11', '', 29, 'http://brizwp.aliveliyev.com/29-revision-v1/', 0, 'revision', '', 0),
(31, 1, '2019-04-11 13:43:33', '2019-04-11 10:43:33', ' ', '', '', 'publish', 'closed', 'closed', '', '31', '', '', '2019-04-11 13:43:33', '2019-04-11 10:43:33', '', 0, 'http://brizwp.aliveliyev.com/?p=31', 2, 'nav_menu_item', '', 0),
(32, 1, '2019-04-11 13:43:33', '2019-04-11 10:43:33', ' ', '', '', 'publish', 'closed', 'closed', '', '32', '', '', '2019-04-11 13:43:33', '2019-04-11 10:43:33', '', 0, 'http://brizwp.aliveliyev.com/?p=32', 1, 'nav_menu_item', '', 0),
(33, 1, '2019-04-11 13:43:48', '2019-04-11 10:43:48', ' ', '', '', 'publish', 'closed', 'closed', '', '33', '', '', '2019-04-11 13:43:48', '2019-04-11 10:43:48', '', 0, 'http://brizwp.aliveliyev.com/?p=33', 2, 'nav_menu_item', '', 0),
(34, 1, '2019-04-11 13:43:48', '2019-04-11 10:43:48', ' ', '', '', 'publish', 'closed', 'closed', '', '34', '', '', '2019-04-11 13:43:48', '2019-04-11 10:43:48', '', 0, 'http://brizwp.aliveliyev.com/?p=34', 1, 'nav_menu_item', '', 0),
(35, 1, '2019-04-11 13:44:59', '2019-04-11 10:44:59', ' ', '', '', 'publish', 'closed', 'closed', '', '35', '', '', '2019-04-11 13:44:59', '2019-04-11 10:44:59', '', 0, 'http://brizwp.aliveliyev.com/?p=35', 3, 'nav_menu_item', '', 0),
(36, 1, '2019-04-11 13:44:59', '2019-04-11 10:44:59', ' ', '', '', 'publish', 'closed', 'closed', '', '36', '', '', '2019-04-11 13:44:59', '2019-04-11 10:44:59', '', 0, 'http://brizwp.aliveliyev.com/?p=36', 2, 'nav_menu_item', '', 0),
(37, 1, '2019-04-11 13:44:59', '2019-04-11 10:44:59', ' ', '', '', 'publish', 'closed', 'closed', '', '37', '', '', '2019-04-11 13:44:59', '2019-04-11 10:44:59', '', 0, 'http://brizwp.aliveliyev.com/?p=37', 1, 'nav_menu_item', '', 0),
(41, 1, '2019-04-11 13:45:57', '2019-04-11 10:45:57', ' ', '', '', 'publish', 'closed', 'closed', '', '41', '', '', '2019-04-11 13:45:57', '2019-04-11 10:45:57', '', 0, 'http://brizwp.aliveliyev.com/?p=41', 3, 'nav_menu_item', '', 0),
(42, 1, '2019-04-11 13:45:57', '2019-04-11 10:45:57', ' ', '', '', 'publish', 'closed', 'closed', '', '42', '', '', '2019-04-11 13:45:57', '2019-04-11 10:45:57', '', 0, 'http://brizwp.aliveliyev.com/?p=42', 2, 'nav_menu_item', '', 0),
(43, 1, '2019-04-11 13:45:57', '2019-04-11 10:45:57', ' ', '', '', 'publish', 'closed', 'closed', '', '43', '', '', '2019-04-11 13:45:57', '2019-04-11 10:45:57', '', 0, 'http://brizwp.aliveliyev.com/?p=43', 1, 'nav_menu_item', '', 0),
(44, 1, '2019-04-11 13:46:28', '2019-04-11 10:46:28', ' ', '', '', 'publish', 'closed', 'closed', '', '44', '', '', '2019-04-11 13:46:28', '2019-04-11 10:46:28', '', 0, 'http://brizwp.aliveliyev.com/?p=44', 2, 'nav_menu_item', '', 0),
(45, 1, '2019-04-11 13:46:28', '2019-04-11 10:46:28', ' ', '', '', 'publish', 'closed', 'closed', '', '45', '', '', '2019-04-11 13:46:28', '2019-04-11 10:46:28', '', 0, 'http://brizwp.aliveliyev.com/?p=45', 1, 'nav_menu_item', '', 0),
(46, 1, '2019-04-11 13:46:55', '2019-04-11 10:46:55', ' ', '', '', 'publish', 'closed', 'closed', '', '46', '', '', '2019-04-11 13:46:55', '2019-04-11 10:46:55', '', 0, 'http://brizwp.aliveliyev.com/?p=46', 3, 'nav_menu_item', '', 0),
(47, 1, '2019-04-11 13:46:55', '2019-04-11 10:46:55', ' ', '', '', 'publish', 'closed', 'closed', '', '47', '', '', '2019-04-11 13:46:55', '2019-04-11 10:46:55', '', 0, 'http://brizwp.aliveliyev.com/?p=47', 1, 'nav_menu_item', '', 0),
(48, 1, '2019-04-11 13:46:55', '2019-04-11 10:46:55', ' ', '', '', 'publish', 'closed', 'closed', '', '48', '', '', '2019-04-11 13:46:55', '2019-04-11 10:46:55', '', 0, 'http://brizwp.aliveliyev.com/?p=48', 2, 'nav_menu_item', '', 0),
(49, 1, '2019-04-11 13:54:50', '2019-04-11 10:54:50', 'a:7:{s:8:\"location\";a:1:{i:0;a:1:{i:0;a:3:{s:5:\"param\";s:4:\"page\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:1:\"2\";}}}s:8:\"position\";s:6:\"normal\";s:5:\"style\";s:7:\"default\";s:15:\"label_placement\";s:3:\"top\";s:21:\"instruction_placement\";s:5:\"label\";s:14:\"hide_on_screen\";s:0:\"\";s:11:\"description\";s:0:\"\";}', 'Settings', 'settings', 'publish', 'closed', 'closed', '', 'group_5caf1c796b2e1', '', '', '2019-04-11 13:54:50', '2019-04-11 10:54:50', '', 0, 'http://brizwp.aliveliyev.com/?post_type=acf-field-group&#038;p=49', 0, 'acf-field-group', '', 0),
(50, 1, '2019-04-11 13:54:50', '2019-04-11 10:54:50', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'IOS', 'ios', 'publish', 'closed', 'closed', '', 'field_5caf1cdec3bd1', '', '', '2019-04-11 13:54:50', '2019-04-11 10:54:50', '', 49, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=50', 0, 'acf-field', '', 0),
(51, 1, '2019-04-11 13:54:50', '2019-04-11 10:54:50', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Android', 'android', 'publish', 'closed', 'closed', '', 'field_5caf1ce5c3bd2', '', '', '2019-04-11 13:54:50', '2019-04-11 10:54:50', '', 49, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=51', 1, 'acf-field', '', 0),
(52, 1, '2019-04-11 13:54:50', '2019-04-11 10:54:50', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Twitter', 'twitter', 'publish', 'closed', 'closed', '', 'field_5caf1cd1c3bcf', '', '', '2019-04-11 13:54:50', '2019-04-11 10:54:50', '', 49, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=52', 2, 'acf-field', '', 0),
(53, 1, '2019-04-11 13:54:50', '2019-04-11 10:54:50', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Facebook', 'facebook', 'publish', 'closed', 'closed', '', 'field_5caf1cc2c3bce', '', '', '2019-04-11 13:54:50', '2019-04-11 10:54:50', '', 49, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=53', 3, 'acf-field', '', 0),
(54, 1, '2019-04-11 13:54:50', '2019-04-11 10:54:50', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Instagram', 'instagram', 'publish', 'closed', 'closed', '', 'field_5caf1cd7c3bd0', '', '', '2019-04-11 13:54:50', '2019-04-11 10:54:50', '', 49, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=54', 4, 'acf-field', '', 0),
(55, 1, '2019-04-11 13:57:38', '2019-04-11 10:57:38', 'a:7:{s:8:\"location\";a:1:{i:0;a:1:{i:0;a:3:{s:5:\"param\";s:4:\"page\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:1:\"2\";}}}s:8:\"position\";s:6:\"normal\";s:5:\"style\";s:7:\"default\";s:15:\"label_placement\";s:3:\"top\";s:21:\"instruction_placement\";s:5:\"label\";s:14:\"hide_on_screen\";s:0:\"\";s:11:\"description\";s:0:\"\";}', 'Home', 'home', 'publish', 'closed', 'closed', '', 'group_5caf1d0aa6aad', '', '', '2019-04-11 14:20:13', '2019-04-11 11:20:13', '', 0, 'http://brizwp.aliveliyev.com/?post_type=acf-field-group&#038;p=55', 0, 'acf-field-group', '', 0),
(56, 1, '2019-04-11 13:57:38', '2019-04-11 10:57:38', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'H1', 'h1', 'publish', 'closed', 'closed', '', 'field_5caf1d07b75c0', '', '', '2019-04-11 13:57:38', '2019-04-11 10:57:38', '', 55, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=56', 0, 'acf-field', '', 0),
(57, 1, '2019-04-11 13:57:38', '2019-04-11 10:57:38', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Main link title', 'main_link_title', 'publish', 'closed', 'closed', '', 'field_5caf1d15b75c1', '', '', '2019-04-11 13:57:38', '2019-04-11 10:57:38', '', 55, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=57', 1, 'acf-field', '', 0),
(58, 1, '2019-04-11 13:57:38', '2019-04-11 10:57:38', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Main link url', 'main_link_url', 'publish', 'closed', 'closed', '', 'field_5caf1d2bb75c3', '', '', '2019-04-11 13:57:38', '2019-04-11 10:57:38', '', 55, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=58', 2, 'acf-field', '', 0),
(59, 1, '2019-04-11 13:57:38', '2019-04-11 10:57:38', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Block 1 heading', 'block_1_heading', 'publish', 'closed', 'closed', '', 'field_5caf1d4cb75c5', '', '', '2019-04-11 13:57:38', '2019-04-11 10:57:38', '', 55, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=59', 3, 'acf-field', '', 0),
(60, 1, '2019-04-11 13:57:38', '2019-04-11 10:57:38', 'a:10:{s:4:\"type\";s:8:\"textarea\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:9:\"new_lines\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:4:\"rows\";s:0:\"\";}', 'Block 1 text', 'block_1_text', 'publish', 'closed', 'closed', '', 'field_5caf1d3eb75c4', '', '', '2019-04-11 14:20:04', '2019-04-11 11:20:04', '', 55, 'http://brizwp.aliveliyev.com/?post_type=acf-field&#038;p=60', 4, 'acf-field', '', 0),
(61, 1, '2019-04-11 13:57:38', '2019-04-11 10:57:38', 'a:15:{s:4:\"type\";s:5:\"image\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"return_format\";s:3:\"url\";s:12:\"preview_size\";s:4:\"full\";s:7:\"library\";s:3:\"all\";s:9:\"min_width\";s:0:\"\";s:10:\"min_height\";s:0:\"\";s:8:\"min_size\";s:0:\"\";s:9:\"max_width\";s:0:\"\";s:10:\"max_height\";s:0:\"\";s:8:\"max_size\";s:0:\"\";s:10:\"mime_types\";s:0:\"\";}', 'Block 1 image', 'block_1_image', 'publish', 'closed', 'closed', '', 'field_5caf1d55b75c6', '', '', '2019-04-11 13:57:38', '2019-04-11 10:57:38', '', 55, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=61', 5, 'acf-field', '', 0),
(62, 1, '2019-04-11 13:57:38', '2019-04-11 10:57:38', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Block 2 heading', 'block_2_heading', 'publish', 'closed', 'closed', '', 'field_5caf1d66b75c7', '', '', '2019-04-11 13:57:38', '2019-04-11 10:57:38', '', 55, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=62', 6, 'acf-field', '', 0),
(63, 1, '2019-04-11 13:57:38', '2019-04-11 10:57:38', 'a:10:{s:4:\"type\";s:8:\"textarea\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:9:\"new_lines\";s:0:\"\";}', 'Block 2 text', 'block_2_text', 'publish', 'closed', 'closed', '', 'field_5caf1d69b75c8', '', '', '2019-04-11 14:20:13', '2019-04-11 11:20:13', '', 55, 'http://brizwp.aliveliyev.com/?post_type=acf-field&#038;p=63', 7, 'acf-field', '', 0),
(64, 1, '2019-04-11 13:57:38', '2019-04-11 10:57:38', 'a:15:{s:4:\"type\";s:5:\"image\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"return_format\";s:3:\"url\";s:12:\"preview_size\";s:4:\"full\";s:7:\"library\";s:3:\"all\";s:9:\"min_width\";s:0:\"\";s:10:\"min_height\";s:0:\"\";s:8:\"min_size\";s:0:\"\";s:9:\"max_width\";s:0:\"\";s:10:\"max_height\";s:0:\"\";s:8:\"max_size\";s:0:\"\";s:10:\"mime_types\";s:0:\"\";}', 'Block 2 image', 'block_2_image', 'publish', 'closed', 'closed', '', 'field_5caf1d6bb75c9', '', '', '2019-04-11 13:57:38', '2019-04-11 10:57:38', '', 55, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=64', 8, 'acf-field', '', 0),
(65, 1, '2019-04-11 14:19:52', '2019-04-11 11:19:52', '', 'Home page', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2019-04-11 14:19:52', '2019-04-11 11:19:52', '', 2, 'http://brizwp.aliveliyev.com/2-revision-v1/', 0, 'revision', '', 0),
(66, 1, '2019-04-11 14:21:12', '2019-04-11 11:21:12', '', 'Home page', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2019-04-11 14:21:12', '2019-04-11 11:21:12', '', 2, 'http://brizwp.aliveliyev.com/2-revision-v1/', 0, 'revision', '', 0),
(67, 1, '2019-04-11 14:23:32', '2019-04-11 11:23:32', '', 'scooter', '', 'inherit', 'open', 'closed', '', 'scooter', '', '', '2019-04-11 14:23:32', '2019-04-11 11:23:32', '', 2, 'http://brizwp.aliveliyev.com/wp-content/uploads/2019/04/scooter.png', 0, 'attachment', 'image/png', 0),
(68, 1, '2019-04-11 14:23:44', '2019-04-11 11:23:44', '', 'phone', '', 'inherit', 'open', 'closed', '', 'phone', '', '', '2019-04-11 14:23:44', '2019-04-11 11:23:44', '', 2, 'http://brizwp.aliveliyev.com/wp-content/uploads/2019/04/phone.png', 0, 'attachment', 'image/png', 0),
(69, 1, '2019-04-11 14:23:49', '2019-04-11 11:23:49', '', 'Home page', '', 'inherit', 'closed', 'closed', '', '2-revision-v1', '', '', '2019-04-11 14:23:49', '2019-04-11 11:23:49', '', 2, 'http://brizwp.aliveliyev.com/2-revision-v1/', 0, 'revision', '', 0),
(70, 1, '2019-04-11 14:29:29', '2019-04-11 11:29:29', 'a:7:{s:8:\"location\";a:1:{i:0;a:1:{i:0;a:3:{s:5:\"param\";s:4:\"page\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:2:\"10\";}}}s:8:\"position\";s:6:\"normal\";s:5:\"style\";s:7:\"default\";s:15:\"label_placement\";s:3:\"top\";s:21:\"instruction_placement\";s:5:\"label\";s:14:\"hide_on_screen\";s:0:\"\";s:11:\"description\";s:0:\"\";}', 'Safety', 'safety', 'publish', 'closed', 'closed', '', 'group_5caf2508e7266', '', '', '2019-04-11 14:42:13', '2019-04-11 11:42:13', '', 0, 'http://brizwp.aliveliyev.com/?post_type=acf-field-group&#038;p=70', 0, 'acf-field-group', '', 0),
(71, 1, '2019-04-11 14:31:03', '2019-04-11 11:31:03', 'a:10:{s:4:\"type\";s:8:\"repeater\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:9:\"collapsed\";s:0:\"\";s:3:\"min\";s:0:\"\";s:3:\"max\";s:0:\"\";s:6:\"layout\";s:5:\"table\";s:12:\"button_label\";s:0:\"\";}', 'Section', 'section', 'publish', 'closed', 'closed', '', 'field_5caf2524ba87a', '', '', '2019-04-11 14:31:03', '2019-04-11 11:31:03', '', 70, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=71', 0, 'acf-field', '', 0),
(72, 1, '2019-04-11 14:31:03', '2019-04-11 11:31:03', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'H4', 'h4', 'publish', 'closed', 'closed', '', 'field_5caf2540ba87c', '', '', '2019-04-11 14:31:03', '2019-04-11 11:31:03', '', 71, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=72', 0, 'acf-field', '', 0),
(73, 1, '2019-04-11 14:31:03', '2019-04-11 11:31:03', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Paragraph', 'paragraph', 'publish', 'closed', 'closed', '', 'field_5caf2545ba87d', '', '', '2019-04-11 14:31:03', '2019-04-11 11:31:03', '', 71, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=73', 1, 'acf-field', '', 0),
(74, 1, '2019-04-11 14:31:04', '2019-04-11 11:31:04', 'a:15:{s:4:\"type\";s:5:\"image\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"return_format\";s:3:\"url\";s:12:\"preview_size\";s:4:\"full\";s:7:\"library\";s:3:\"all\";s:9:\"min_width\";s:0:\"\";s:10:\"min_height\";s:0:\"\";s:8:\"min_size\";s:0:\"\";s:9:\"max_width\";s:0:\"\";s:10:\"max_height\";s:0:\"\";s:8:\"max_size\";s:0:\"\";s:10:\"mime_types\";s:0:\"\";}', 'Image', 'image', 'publish', 'closed', 'closed', '', 'field_5caf254cba87e', '', '', '2019-04-11 14:42:13', '2019-04-11 11:42:13', '', 71, 'http://brizwp.aliveliyev.com/?post_type=acf-field&#038;p=74', 2, 'acf-field', '', 0),
(75, 1, '2019-04-11 14:31:04', '2019-04-11 11:31:04', 'a:10:{s:4:\"type\";s:8:\"repeater\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:9:\"collapsed\";s:0:\"\";s:3:\"min\";s:0:\"\";s:3:\"max\";s:0:\"\";s:6:\"layout\";s:5:\"table\";s:12:\"button_label\";s:0:\"\";}', 'Block', 'block', 'publish', 'closed', 'closed', '', 'field_5caf2568ba87f', '', '', '2019-04-11 14:31:04', '2019-04-11 11:31:04', '', 70, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=75', 1, 'acf-field', '', 0),
(76, 1, '2019-04-11 14:31:04', '2019-04-11 11:31:04', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'H4', 'h4', 'publish', 'closed', 'closed', '', 'field_5caf2568ba880', '', '', '2019-04-11 14:31:04', '2019-04-11 11:31:04', '', 75, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=76', 0, 'acf-field', '', 0),
(77, 1, '2019-04-11 14:31:04', '2019-04-11 11:31:04', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Paragraph', 'paragraph', 'publish', 'closed', 'closed', '', 'field_5caf2568ba881', '', '', '2019-04-11 14:31:04', '2019-04-11 11:31:04', '', 75, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=77', 1, 'acf-field', '', 0),
(78, 1, '2019-04-11 14:31:04', '2019-04-11 11:31:04', 'a:15:{s:4:\"type\";s:5:\"image\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"return_format\";s:3:\"url\";s:12:\"preview_size\";s:4:\"full\";s:7:\"library\";s:3:\"all\";s:9:\"min_width\";s:0:\"\";s:10:\"min_height\";s:0:\"\";s:8:\"min_size\";s:0:\"\";s:9:\"max_width\";s:0:\"\";s:10:\"max_height\";s:0:\"\";s:8:\"max_size\";s:0:\"\";s:10:\"mime_types\";s:0:\"\";}', 'Image', 'image', 'publish', 'closed', 'closed', '', 'field_5caf2568ba882', '', '', '2019-04-11 14:31:04', '2019-04-11 11:31:04', '', 75, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=78', 2, 'acf-field', '', 0),
(79, 1, '2019-04-11 14:31:48', '2019-04-11 11:31:48', '', 'safety1', '', 'inherit', 'open', 'closed', '', 'safety1', '', '', '2019-04-11 14:31:48', '2019-04-11 11:31:48', '', 10, 'http://brizwp.aliveliyev.com/wp-content/uploads/2019/04/safety1.png', 0, 'attachment', 'image/png', 0),
(80, 1, '2019-04-11 14:31:48', '2019-04-11 11:31:48', '', 'safety2', '', 'inherit', 'open', 'closed', '', 'safety2', '', '', '2019-04-11 14:31:48', '2019-04-11 11:31:48', '', 10, 'http://brizwp.aliveliyev.com/wp-content/uploads/2019/04/safety2.png', 0, 'attachment', 'image/png', 0),
(81, 1, '2019-04-11 14:31:49', '2019-04-11 11:31:49', '', 'safety3', '', 'inherit', 'open', 'closed', '', 'safety3', '', '', '2019-04-11 14:31:49', '2019-04-11 11:31:49', '', 10, 'http://brizwp.aliveliyev.com/wp-content/uploads/2019/04/safety3.png', 0, 'attachment', 'image/png', 0),
(82, 1, '2019-04-11 14:31:50', '2019-04-11 11:31:50', '', 'safety4', '', 'inherit', 'open', 'closed', '', 'safety4', '', '', '2019-04-11 14:31:50', '2019-04-11 11:31:50', '', 10, 'http://brizwp.aliveliyev.com/wp-content/uploads/2019/04/safety4.png', 0, 'attachment', 'image/png', 0),
(83, 1, '2019-04-11 14:31:51', '2019-04-11 11:31:51', '', 'scooter1', '', 'inherit', 'open', 'closed', '', 'scooter1', '', '', '2019-04-11 14:31:51', '2019-04-11 11:31:51', '', 10, 'http://brizwp.aliveliyev.com/wp-content/uploads/2019/04/scooter1.png', 0, 'attachment', 'image/png', 0),
(84, 1, '2019-04-11 14:31:52', '2019-04-11 11:31:52', '', 'scooter2', '', 'inherit', 'open', 'closed', '', 'scooter2', '', '', '2019-04-11 14:31:52', '2019-04-11 11:31:52', '', 10, 'http://brizwp.aliveliyev.com/wp-content/uploads/2019/04/scooter2.png', 0, 'attachment', 'image/png', 0),
(85, 1, '2019-04-11 14:34:05', '2019-04-11 11:34:05', '', 'Safety', '', 'inherit', 'closed', 'closed', '', '10-revision-v1', '', '', '2019-04-11 14:34:05', '2019-04-11 11:34:05', '', 10, 'http://brizwp.aliveliyev.com/10-revision-v1/', 0, 'revision', '', 0),
(86, 1, '2019-04-11 14:35:23', '2019-04-11 11:35:23', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Effect', 'effect', 'publish', 'closed', 'closed', '', 'field_5caf266c56e5e', '', '', '2019-04-11 14:35:23', '2019-04-11 11:35:23', '', 71, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=86', 3, 'acf-field', '', 0),
(87, 1, '2019-04-11 14:35:32', '2019-04-11 11:35:32', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Effect', 'effect', 'publish', 'closed', 'closed', '', 'field_5caf26798127f', '', '', '2019-04-11 14:35:32', '2019-04-11 11:35:32', '', 75, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=87', 3, 'acf-field', '', 0),
(88, 1, '2019-04-11 14:36:07', '2019-04-11 11:36:07', '', 'Safety', '', 'inherit', 'closed', 'closed', '', '10-revision-v1', '', '', '2019-04-11 14:36:07', '2019-04-11 11:36:07', '', 10, 'http://brizwp.aliveliyev.com/10-revision-v1/', 0, 'revision', '', 0),
(89, 1, '2019-04-11 16:03:35', '2019-04-11 13:03:35', 'a:7:{s:8:\"location\";a:1:{i:0;a:1:{i:0;a:3:{s:5:\"param\";s:4:\"page\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:2:\"20\";}}}s:8:\"position\";s:6:\"normal\";s:5:\"style\";s:7:\"default\";s:15:\"label_placement\";s:3:\"top\";s:21:\"instruction_placement\";s:5:\"label\";s:14:\"hide_on_screen\";s:0:\"\";s:11:\"description\";s:0:\"\";}', 'FAQ', 'faq', 'publish', 'closed', 'closed', '', 'group_5caf3ae55cd23', '', '', '2019-04-11 16:16:12', '2019-04-11 13:16:12', '', 0, 'http://brizwp.aliveliyev.com/?post_type=acf-field-group&#038;p=89', 0, 'acf-field-group', '', 0),
(90, 1, '2019-04-11 16:03:35', '2019-04-11 13:03:35', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'H1', 'h1', 'publish', 'closed', 'closed', '', 'field_5caf3ae91bc56', '', '', '2019-04-11 16:03:35', '2019-04-11 13:03:35', '', 89, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=90', 0, 'acf-field', '', 0),
(91, 1, '2019-04-11 16:03:35', '2019-04-11 13:03:35', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Text', 'text', 'publish', 'closed', 'closed', '', 'field_5caf3aee1bc57', '', '', '2019-04-11 16:03:35', '2019-04-11 13:03:35', '', 89, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=91', 1, 'acf-field', '', 0),
(92, 1, '2019-04-11 16:03:35', '2019-04-11 13:03:35', 'a:10:{s:4:\"type\";s:8:\"repeater\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:9:\"collapsed\";s:0:\"\";s:3:\"min\";s:0:\"\";s:3:\"max\";s:0:\"\";s:6:\"layout\";s:5:\"table\";s:12:\"button_label\";s:0:\"\";}', 'Block', 'block', 'publish', 'closed', 'closed', '', 'field_5caf3af31bc58', '', '', '2019-04-11 16:03:35', '2019-04-11 13:03:35', '', 89, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=92', 2, 'acf-field', '', 0),
(95, 1, '2019-04-11 16:05:01', '2019-04-11 13:05:01', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'H2', 'h2', 'publish', 'closed', 'closed', '', 'field_5caf3b5bbbe42', '', '', '2019-04-11 16:05:01', '2019-04-11 13:05:01', '', 92, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=95', 0, 'acf-field', '', 0),
(96, 1, '2019-04-11 16:05:01', '2019-04-11 13:05:01', 'a:10:{s:4:\"type\";s:8:\"repeater\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:9:\"collapsed\";s:0:\"\";s:3:\"min\";s:0:\"\";s:3:\"max\";s:0:\"\";s:6:\"layout\";s:5:\"table\";s:12:\"button_label\";s:0:\"\";}', 'Questions', 'questions', 'publish', 'closed', 'closed', '', 'field_5caf3b2cbbe3f', '', '', '2019-04-11 16:05:01', '2019-04-11 13:05:01', '', 92, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=96', 1, 'acf-field', '', 0),
(97, 1, '2019-04-11 16:05:01', '2019-04-11 13:05:01', 'a:10:{s:4:\"type\";s:8:\"textarea\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:9:\"new_lines\";s:0:\"\";}', 'Question', 'question', 'publish', 'closed', 'closed', '', 'field_5caf3b3ebbe40', '', '', '2019-04-11 16:05:01', '2019-04-11 13:05:01', '', 96, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=97', 0, 'acf-field', '', 0),
(98, 1, '2019-04-11 16:05:01', '2019-04-11 13:05:01', 'a:10:{s:4:\"type\";s:8:\"textarea\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:9:\"new_lines\";s:0:\"\";}', 'Answer', 'answer', 'publish', 'closed', 'closed', '', 'field_5caf3b46bbe41', '', '', '2019-04-11 16:05:01', '2019-04-11 13:05:01', '', 96, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=98', 1, 'acf-field', '', 0),
(99, 1, '2019-04-11 16:07:38', '2019-04-11 13:07:38', '', 'FAQ', '', 'inherit', 'closed', 'closed', '', '20-revision-v1', '', '', '2019-04-11 16:07:38', '2019-04-11 13:07:38', '', 20, 'http://brizwp.aliveliyev.com/20-revision-v1/', 0, 'revision', '', 0),
(100, 1, '2019-04-11 16:09:18', '2019-04-11 13:09:18', '', 'FAQ', '', 'inherit', 'closed', 'closed', '', '20-revision-v1', '', '', '2019-04-11 16:09:18', '2019-04-11 13:09:18', '', 20, 'http://brizwp.aliveliyev.com/20-revision-v1/', 0, 'revision', '', 0);
INSERT INTO `briz_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(101, 1, '2019-04-11 16:16:11', '2019-04-11 13:16:11', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Button 1 title', 'button_1_title', 'publish', 'closed', 'closed', '', 'field_5caf3df6345b3', '', '', '2019-04-11 16:16:11', '2019-04-11 13:16:11', '', 89, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=101', 3, 'acf-field', '', 0),
(102, 1, '2019-04-11 16:16:11', '2019-04-11 13:16:11', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Button 1 url', 'button_1_url', 'publish', 'closed', 'closed', '', 'field_5caf3dfd345b4', '', '', '2019-04-11 16:16:11', '2019-04-11 13:16:11', '', 89, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=102', 4, 'acf-field', '', 0),
(103, 1, '2019-04-11 16:16:11', '2019-04-11 13:16:11', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Button 2 title', 'button_2_title', 'publish', 'closed', 'closed', '', 'field_5caf3e03345b5', '', '', '2019-04-11 16:16:11', '2019-04-11 13:16:11', '', 89, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=103', 5, 'acf-field', '', 0),
(104, 1, '2019-04-11 16:16:11', '2019-04-11 13:16:11', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Button 2 url', 'button_2_url', 'publish', 'closed', 'closed', '', 'field_5caf3e09345b6', '', '', '2019-04-11 16:16:11', '2019-04-11 13:16:11', '', 89, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=104', 6, 'acf-field', '', 0),
(105, 1, '2019-04-11 16:16:11', '2019-04-11 13:16:11', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Phone', 'phone', 'publish', 'closed', 'closed', '', 'field_5caf3e0f345b7', '', '', '2019-04-11 16:16:11', '2019-04-11 13:16:11', '', 89, 'http://brizwp.aliveliyev.com/?post_type=acf-field&p=105', 7, 'acf-field', '', 0),
(106, 1, '2019-04-11 16:18:50', '2019-04-11 13:18:50', '', 'FAQ', '', 'inherit', 'closed', 'closed', '', '20-revision-v1', '', '', '2019-04-11 16:18:50', '2019-04-11 13:18:50', '', 20, 'http://brizwp.aliveliyev.com/20-revision-v1/', 0, 'revision', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `briz_termmeta`
--

CREATE TABLE `briz_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `briz_terms`
--

CREATE TABLE `briz_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `briz_terms`
--

INSERT INTO `briz_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Без рубрики', '%d0%b1%d0%b5%d0%b7-%d1%80%d1%83%d0%b1%d1%80%d0%b8%d0%ba%d0%b8', 0),
(2, 'Main left', 'main-left', 0),
(3, 'Main right', 'main-right', 0),
(4, 'Company', 'company', 0),
(5, 'Rider', 'rider', 0),
(6, 'Charger', 'charger', 0),
(7, 'Footer', 'footer', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `briz_term_relationships`
--

CREATE TABLE `briz_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `briz_term_relationships`
--

INSERT INTO `briz_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(31, 2, 0),
(32, 2, 0),
(33, 3, 0),
(34, 3, 0),
(35, 4, 0),
(36, 4, 0),
(37, 4, 0),
(41, 5, 0),
(42, 5, 0),
(43, 5, 0),
(44, 6, 0),
(45, 6, 0),
(46, 7, 0),
(47, 7, 0),
(48, 7, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `briz_term_taxonomy`
--

CREATE TABLE `briz_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `briz_term_taxonomy`
--

INSERT INTO `briz_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'nav_menu', '', 0, 2),
(3, 3, 'nav_menu', '', 0, 2),
(4, 4, 'nav_menu', '', 0, 3),
(5, 5, 'nav_menu', '', 0, 3),
(6, 6, 'nav_menu', '', 0, 2),
(7, 7, 'nav_menu', '', 0, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `briz_usermeta`
--

CREATE TABLE `briz_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `briz_usermeta`
--

INSERT INTO `briz_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
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
(12, 1, 'briz_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'briz_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', 'wp496_privacy,theme_editor_notice'),
(15, 1, 'show_welcome_panel', '1'),
(16, 1, 'session_tokens', 'a:1:{s:64:\"f3d03c4aace413b418a057097bb041843eec3754d195a34de7ea142d781c1558\";a:4:{s:10:\"expiration\";i:1556121737;s:2:\"ip\";s:12:\"31.173.81.35\";s:2:\"ua\";s:120:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36\";s:5:\"login\";i:1554912137;}}'),
(17, 1, 'briz_dashboard_quick_press_last_post_id', '4'),
(18, 1, 'community-events-location', 'a:1:{s:2:\"ip\";s:11:\"31.173.83.0\";}'),
(19, 1, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";i:4;s:15:\"title-attribute\";}'),
(20, 1, 'metaboxhidden_nav-menus', 'a:1:{i:0;s:12:\"add-post_tag\";}'),
(21, 1, 'briz_user-settings', 'libraryContent=browse'),
(22, 1, 'briz_user-settings-time', '1554981825');

-- --------------------------------------------------------

--
-- Структура таблицы `briz_users`
--

CREATE TABLE `briz_users` (
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
-- Дамп данных таблицы `briz_users`
--

INSERT INTO `briz_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BQEP1c8sBDr.HTowdBgq8a.mf7zbMJ/', 'admin', 'office@aliveliyev.com', '', '2019-04-10 16:02:03', '', 0, 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `briz_commentmeta`
--
ALTER TABLE `briz_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Индексы таблицы `briz_comments`
--
ALTER TABLE `briz_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Индексы таблицы `briz_links`
--
ALTER TABLE `briz_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Индексы таблицы `briz_options`
--
ALTER TABLE `briz_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Индексы таблицы `briz_postmeta`
--
ALTER TABLE `briz_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Индексы таблицы `briz_posts`
--
ALTER TABLE `briz_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Индексы таблицы `briz_termmeta`
--
ALTER TABLE `briz_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Индексы таблицы `briz_terms`
--
ALTER TABLE `briz_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Индексы таблицы `briz_term_relationships`
--
ALTER TABLE `briz_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Индексы таблицы `briz_term_taxonomy`
--
ALTER TABLE `briz_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Индексы таблицы `briz_usermeta`
--
ALTER TABLE `briz_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Индексы таблицы `briz_users`
--
ALTER TABLE `briz_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `briz_commentmeta`
--
ALTER TABLE `briz_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `briz_comments`
--
ALTER TABLE `briz_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `briz_links`
--
ALTER TABLE `briz_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `briz_options`
--
ALTER TABLE `briz_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT для таблицы `briz_postmeta`
--
ALTER TABLE `briz_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=716;

--
-- AUTO_INCREMENT для таблицы `briz_posts`
--
ALTER TABLE `briz_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT для таблицы `briz_termmeta`
--
ALTER TABLE `briz_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `briz_terms`
--
ALTER TABLE `briz_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `briz_term_taxonomy`
--
ALTER TABLE `briz_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `briz_usermeta`
--
ALTER TABLE `briz_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `briz_users`
--
ALTER TABLE `briz_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
