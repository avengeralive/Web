-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 03 2018 г., 13:55
-- Версия сервера: 5.6.39-83.1
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `u0499164_hostel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `wp_usermeta`
--

CREATE TABLE IF NOT EXISTS `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci AUTO_INCREMENT=31 ;

--
-- Дамп данных таблицы `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'midnight'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'wp_capabilities', 'a:1:{s:13:"administrator";b:1;}'),
(13, 1, 'wp_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', 'master_1_0_view_help,text_widget_custom_html,theme_editor_notice'),
(15, 1, 'show_welcome_panel', '1'),
(16, 1, 'session_tokens', 'a:5:{s:64:"60cb6dbb043cce566baa3cc8e96c79dabf962e9cbd25e34547dbd808f2742e6a";a:4:{s:10:"expiration";i:1531648324;s:2:"ip";s:12:"109.172.15.9";s:2:"ua";s:113:"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36";s:5:"login";i:1530438724;}s:64:"f1caf5f9a4509e073bb7691e2d34c9fc9f65a4e45be7f12b53c3b2aaea731cf0";a:4:{s:10:"expiration";i:1531648429;s:2:"ip";s:14:"213.172.79.172";s:2:"ua";s:120:"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36";s:5:"login";i:1530438829;}s:64:"4819c30d7d81279a193aefa23bec5fb87b8500ae66ea249e225b78f7f9bfb53c";a:4:{s:10:"expiration";i:1530782802;s:2:"ip";s:12:"37.26.17.218";s:2:"ua";s:120:"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36";s:5:"login";i:1530610002;}s:64:"9962025b646a6f0232d6b20ea08b6ecc4111b15f3a7b67641d0b9ad0e18e31a5";a:4:{s:10:"expiration";i:1531819674;s:2:"ip";s:12:"37.26.17.218";s:2:"ua";s:120:"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36";s:5:"login";i:1530610074;}s:64:"8eef432e73291378cf1efae404b79268fb62134c2683f42345dc04e430175b58";a:4:{s:10:"expiration";i:1530786569;s:2:"ip";s:12:"109.172.15.9";s:2:"ua";s:113:"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36";s:5:"login";i:1530613769;}}'),
(17, 1, 'wp_user-settings', 'libraryContent=upload&editor=tinymce&mfold=o'),
(18, 1, 'wp_user-settings-time', '1530609999'),
(19, 1, 'wp_dashboard_quick_press_last_post_id', '4691'),
(20, 1, 'community-events-location', 'a:1:{s:2:"ip";s:12:"109.172.15.0";}'),
(21, 1, 'nav_menu_recently_edited', '51'),
(22, 1, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:"link-target";i:1;s:11:"css-classes";i:2;s:3:"xfn";i:3;s:11:"description";i:4;s:15:"title-attribute";}'),
(23, 1, 'metaboxhidden_nav-menus', 'a:14:{i:0;s:25:"add-post-type-hostel_room";i:1;s:21:"add-post-type-service";i:2;s:20:"add-post-type-coupon";i:3;s:18:"add-post-type-room";i:4;s:23:"add-post-type-portfolio";i:5;s:12:"add-post_tag";i:6;s:15:"add-post_format";i:7;s:24:"add-hostel_room_category";i:8;s:19:"add-hostel_room_tag";i:9;s:17:"add-room_category";i:10;s:12:"add-room_tag";i:11;s:22:"add-portfolio_category";i:12;s:17:"add-portfolio_tag";i:13;s:17:"add-page_category";}'),
(24, 1, 'closedpostboxes_page', 'a:0:{}'),
(25, 1, 'metaboxhidden_page', 'a:6:{i:0;s:11:"postexcerpt";i:1;s:10:"postcustom";i:2;s:16:"commentstatusdiv";i:3;s:11:"commentsdiv";i:4;s:7:"slugdiv";i:5;s:9:"authordiv";}'),
(26, 1, 'closedpostboxes_hostel_room', 'a:0:{}'),
(27, 1, 'metaboxhidden_hostel_room', 'a:1:{i:0;s:7:"slugdiv";}'),
(28, 1, 'closedpostboxes_post', 'a:0:{}'),
(29, 1, 'metaboxhidden_post', 'a:8:{i:0;s:12:"revisionsdiv";i:1;s:11:"postexcerpt";i:2;s:13:"trackbacksdiv";i:3;s:10:"postcustom";i:4;s:16:"commentstatusdiv";i:5;s:11:"commentsdiv";i:6;s:7:"slugdiv";i:7;s:9:"authordiv";}'),
(30, 1, 'ame_show_hints', 'a:3:{s:17:"ws_sidebar_pro_ad";b:0;s:16:"ws_whats_new_120";b:0;s:24:"ws_hint_menu_permissions";b:0;}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
