-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 06 2019 г., 17:52
-- Версия сервера: 5.6.26
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `studyprog2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `post_template` int(11) NOT NULL,
  `post_design` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `post_template`, `post_design`, `title`, `content`, `visibility`) VALUES
(1, 'news', 0, 1, 1, '', '', 1),
(2, 'education', 0, 1, 1, '', '', 1),
(3, 'gallery', 0, 1, 1, '', '', 1),
(4, 'studyprog-news', 1, 0, 0, '', '', 1),
(5, 'internet', 1, 0, 0, '', '', 1),
(6, 'it-events', 1, 0, 0, '', '', 1),
(7, 'algo', 2, 0, 0, '', '', 1),
(8, 'basic', 7, 0, 0, '', '', 1),
(9, 'sort-and-search', 7, 0, 0, '', '', 1),
(10, 'graph-theory', 7, 0, 0, '', '', 1),
(11, 'code', 2, 0, 0, '', '', 1),
(12, 'c', 11, 0, 0, '', '', 1),
(13, 'cpp', 11, 0, 0, '', '', 0),
(14, 'c-sharp', 11, 0, 0, '', '', 0),
(15, 'java', 11, 0, 0, '', '', 1),
(16, 'html', 11, 0, 0, '', '', 0),
(17, 'javascript', 11, 0, 0, '', '', 0),
(18, 'css', 11, 0, 0, '', '', 0),
(19, 'php', 11, 0, 0, '', '', 0),
(20, 'lets-solve-e-olimp', 3, 0, 0, '', '', 1),
(21, 'library', 0, 1, 3, '', '', 1),
(22, 'programming-in-c', 21, 0, 0, '', '', 1),
(23, 'programming-in-cpp', 21, 0, 0, '', '', 1),
(24, 'web-programming', 21, 0, 0, '', '', 1),
(25, 'programming-sql', 21, 0, 0, '', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `categories_templates`
--

CREATE TABLE IF NOT EXISTS `categories_templates` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `template` int(11) NOT NULL,
  `theme` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories_templates`
--

INSERT INTO `categories_templates` (`id`, `category`, `template`, `theme`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 0, 1),
(5, 5, 0, 1),
(6, 6, 0, 1),
(7, 7, 2, 1),
(8, 8, 1, 1),
(9, 9, 0, 1),
(10, 10, 0, 1),
(11, 11, 1, 1),
(12, 12, 0, 1),
(13, 13, 1, 1),
(14, 14, 1, 1),
(15, 15, 0, 1),
(16, 16, 1, 1),
(17, 17, 0, 1),
(18, 18, 0, 1),
(19, 19, 0, 1),
(20, 20, 1, 1),
(21, 21, 1, 1),
(22, 22, 0, 1),
(23, 23, 0, 1),
(24, 24, 0, 1),
(25, 25, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contents`
--

INSERT INTO `contents` (`id`, `name`, `content`, `visibility`) VALUES
(1, 'header', '', 1),
(2, 'footer', '', 1),
(3, 'slider', '', 1),
(4, 'right_sidebar', '', 1),
(5, 'algo_main', '', 1),
(6, 'code_main', '', 1),
(7, 'lib_main', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `designs`
--

CREATE TABLE IF NOT EXISTS `designs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `designs`
--

INSERT INTO `designs` (`id`, `name`, `content`, `visibility`) VALUES
(1, 'post', '<section id="news">\n<div class="container-fluid">\n<h1 class="post-title">[post_title]</h1>\n<span class="text-justify">[post_content]</span>\n</div>\n</section>', 1),
(2, 'form', '<script src=''https://www.google.com/recaptcha/api.js''></script>\n<script type="text/javascript" charset="utf-8">\n$(function()\n{			\n	$(''#feedback-form'').validate({\n        submitHandler: function(form)\n        {\n			submit_feedback_form(form);\n        }\n    });\n    function submit_feedback_form(form)\n    {\n		$.ajax(\n		{\n            url: form.action,\n			type: "POST",\n			data: $(form).serialize(),\n			success:function(data, status, jqxhr)\n			{ console.log(data);\n				if (data == 1)\n				{\n					$("#feedback-div").html("<div class=''alert alert-success''>[tr_feedback_success]</div>");\n				}\n				else\n				{\n					$("#error").html("<div class=''alert alert-danger''>[tr_feedback_error]</div>");\n				}\n			},\n			error: function (request, status, error) {\n				console.log(request.responseText);\n			}                        \n		}); \n    }\n});\n</script>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clear"></div>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px;" id="feedback-div">\n	<form role="form" id="feedback-form" class="form-horizontal" method="POST" action="[url][action]">\n		<div class="form-group">\n			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">\n				<input type="text" class="form-control required_field" id="feedback-name" name="name" placeholder="[ph_name]">\n			</div>\n			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">\n				<input type="email" class="form-control required_field" id="feedback-email" name="email" placeholder="[ph_email]">\n			</div>\n			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">\n				<input type="text" class="form-control required_field" id="feedback-email" name="subject" placeholder="[ph_subject]">\n			</div>\n		</div>\n		<div class="form-group">\n			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">\n				<textarea class="form-control" id="feedback-message" name="message" placeholder="[ph_message]" style="height: 300px;"></textarea>\n			</div>\n		</div>\n		<div class="form-group">\n			<label for="feedback-captcha" class="control-label col-xs-12 col-sm-12 col-md-3 col-lg-3">[ph_captcha]</label>\n			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">\n				<div id="feedback-captcha" class="g-recaptcha" data-sitekey="6Le9kAkTAAAAAKet8MNJuMg6VixOeYcnG3YwG2cD"></div>\n			</div>\n		</div>\n		<div class="form-group">\n			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">\n				<button type="submit" class="btn btn-primary" id="feedback-submit">[submit]</button>\n			</div>\n		</div>\n		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px;" id="error"></div>\n	</form>\n</div>', 1),
(3, 'library_item', '<section id="news">\n<div class="container-fluid">\n<h1 class="post-title">[post_title]</h1>\n<span class="text-justify">[post_content]</span>\n<p><a href="[post_pdf]">PDF</a></p>\n<p><a href="[post_djvu]">DJVU</a></p>\n</div>\n</section>', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `errors`
--

CREATE TABLE IF NOT EXISTS `errors` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `errors`
--

INSERT INTO `errors` (`id`, `code`, `description`) VALUES
(1, 'shc-001', 'Error in your shortcode (extra spaces in shortcode)'),
(2, 'cnt-001', 'Content not exists');

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibility` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `captcha` varchar(255) NOT NULL,
  `reset_button` tinyint(1) NOT NULL,
  `reset_button_title` varchar(255) NOT NULL,
  `submit_button_title` varchar(255) NOT NULL,
  `form_class` varchar(255) NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forms`
--

INSERT INTO `forms` (`id`, `name`, `title`, `action`, `captcha`, `reset_button`, `reset_button_title`, `submit_button_title`, `form_class`, `visibility`) VALUES
(1, 'contact-form', '', 'common/default/sendFeedback', 'google', 0, '', '', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `form_fields`
--

CREATE TABLE IF NOT EXISTS `form_fields` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `type` varchar(256) NOT NULL,
  `select_id` int(11) NOT NULL,
  `placeholder` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `form_fields`
--

INSERT INTO `form_fields` (`id`, `form_id`, `name`, `label`, `type`, `select_id`, `placeholder`, `value`, `visibility`) VALUES
(1, 1, 'name', '', 'text', 0, '', '', 1),
(2, 1, 'email', '', 'text', 0, '', '', 1),
(3, 1, 'subject', '', 'text', 0, '', '', 1),
(4, 1, 'message', '', 'textarea', 0, '', '', 1),
(5, 1, 'captcha', '', 'text', 0, '', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `form_selects`
--

CREATE TABLE IF NOT EXISTS `form_selects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `form_select_options`
--

CREATE TABLE IF NOT EXISTS `form_select_options` (
  `id` int(11) NOT NULL,
  `select_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `head`
--

CREATE TABLE IF NOT EXISTS `head` (
  `id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `theme` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `orders` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `head`
--

INSERT INTO `head` (`id`, `path`, `type`, `theme`, `active`, `orders`) VALUES
(1, '/style.css', 'css', 1, 1, 1),
(2, '/jquery-3.1.1.min.js', 'js', 1, 1, 1),
(3, '/script.js', 'js', 1, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL,
  `language` varchar(256) DEFAULT NULL,
  `short` varchar(2) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id`, `language`, `short`, `title`, `img`, `visibility`) VALUES
(1, 'russian', 'ru', 'Русский', '', 1),
(2, 'english', 'en', 'English', '', 1),
(3, 'azerbaijan', 'az', 'Azərbaycan', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `list_mockups`
--

CREATE TABLE IF NOT EXISTS `list_mockups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `base` longtext NOT NULL,
  `repeats` longtext NOT NULL,
  `style` longtext NOT NULL,
  `visibility` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `list_mockups`
--

INSERT INTO `list_mockups` (`id`, `name`, `base`, `repeats`, `style`, `visibility`) VALUES
(1, 'main_menu', '[$repeats]', '<li id="menu-item-[$id]"><a href="[$url]" [$toggle]>[$title]</a>[$sub]</li>', '', 1),
(2, 'main_submenu', '<ul class="sub-menu">[$repeats]</ul>', '<li id="menu-item-[$id]"><a href="[$url]" [$toggle]>[$title]</a>[$sub]</li>', '', 1),
(3, 'social_icons_menu', '[$repeats]', '<li id="menu-item-[$id]" [$toggle]><a href="[$url]"><i class="[$title]"></i></a>[$sub]</li>', '', 1),
(4, 'news_list', '<h1>[$title]</h1>\n[$repeats]\n[$navigation]', '<div class="item">\n<div class="post-title">\n<h2><a href="[$post_url]">[$post_title]</a></h2>\n</div>\n<div class="post-short">\n[$post_short]\n</div>\n<div class="post-additional">\n<div class="post-date"><p><i class="fa fa-calendar"></i> [$post_date]</p></div>\n<div class="post-category"><p><i class="fa fa-list-ul"></i> [$post_category]</p></div>\n</div>\n\n</div>', '', 1),
(5, 'navigation', '<ul class="pagination">[$repeats]</ul>', '<li><a [$active] href="[$url]/[$page]">[$page]</a></li>', '', 1),
(6, 'category_list', '<ul class="categories-list">[$repeats]</ul>', '<li><a [$current] href="[$url]">[$category_title]</a></li>', '', 1),
(7, 'language', '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe"></i></a><ul class="dropdown-menu">[$repeats]</ul></li>', '<li id="menu-item-[$id]"><a href="[$url]">[$title]</a></li>', '', 1),
(8, 'language_mobile', '[$repeats]', '<li id="menu-item-[$id]"><a href="[$url]">[$title]</a></li>', '', 1),
(9, 'gallery_list', '<h1 style="margin-bottom: 50px;">[$title]</h1>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">[$repeats]</div>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">[$navigation]</div>', '<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">\n	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 article_item">\n		<a href="[$post_url]">\n			<div class="image-container col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0px !important;">\n				<div class="frame col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0px !important;">\n					[$post_short]					\n				</div>\n				<div class="image-overlay col-xs-12 col-sm-12 col-md-12 col-lg-12">                            \n					<h4>[$post_title]</h4>\n					<p><span class="glyphicon glyphicon-th-list"></span> [$post_category]</p>\n				</div>\n			</div>\n		</a>\n	</div>\n</div>', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `design_id` int(11) NOT NULL,
  `sub_design_id` int(11) NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`, `design_id`, `sub_design_id`, `visibility`) VALUES
(1, 'studyprog', 1, 1, 1),
(2, 'social', 3, 7, 1),
(3, 'language', 7, 0, 1),
(4, 'language_mobile', 8, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `menu_elements`
--

CREATE TABLE IF NOT EXISTS `menu_elements` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `package` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `parameters` varchar(255) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `custom_url` varchar(255) NOT NULL,
  `orders` int(11) NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu_elements`
--

INSERT INTO `menu_elements` (`id`, `parent_id`, `title`, `package`, `controller`, `action`, `parameters`, `menu_id`, `custom_url`, `orders`, `visibility`) VALUES
(1, 0, '', 'pages', 'default', 'get', 'name=news', 1, '', 1, 1),
(2, 0, '', 'pages', 'default', 'get', 'name=education', 1, '', 2, 1),
(3, 0, '', 'pages', 'default', 'get', 'name=gallery', 1, '', 3, 1),
(4, 0, '', 'pages', 'default', 'get', 'name=about', 1, '', 4, 1),
(5, 0, '', 'pages', 'default', 'get', 'name=contacts', 1, '', 5, 1),
(6, 0, '', '', '', '', '', 2, 'https://www.facebook.com/studyprog', 1, 1),
(7, 0, '', '', '', '', '', 2, 'https://twitter.com/StudyProg', 2, 1),
(8, 0, '', '', '', '', '', 2, 'https://www.youtube.com/user/studyprog', 3, 1),
(9, 0, '', '', '', '', '', 2, '#', 4, 0),
(10, 0, '', '', '', '', '', 3, '[$system_url]az/[$route]', 0, 1),
(11, 0, '', '', '', '', '', 3, '[$system_url]ru/[$route]', 0, 1),
(12, 0, '', '', '', '', '', 3, '[$system_url]en/[$route]', 0, 1),
(13, 0, '', '', '', '', '', 4, '[$system_url]az', 0, 1),
(14, 0, '', '', '', '', '', 4, '[$system_url]ru', 0, 1),
(15, 0, '', '', '', '', '', 4, '[$system_url]ru', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `oauth`
--

CREATE TABLE IF NOT EXISTS `oauth` (
  `id` int(11) NOT NULL,
  `social_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `visibility` tinyint(1) NOT NULL,
  `main` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `title`, `content`, `visibility`, `main`) VALUES
(1, 'index', '', '', 1, 1),
(2, 'about', '', '', 1, 0),
(3, 'contacts', '', '', 1, 0),
(4, 'news', '', '', 1, 0),
(5, 'education', '', '', 1, 0),
(6, 'algo', '', '', 1, 0),
(7, 'code', '', '', 1, 0),
(8, 'gallery', '', '', 1, 0),
(9, 'library', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pages_templates`
--

CREATE TABLE IF NOT EXISTS `pages_templates` (
  `id` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `template` int(11) NOT NULL,
  `theme` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages_templates`
--

INSERT INTO `pages_templates` (`id`, `page`, `template`, `theme`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 2, 1),
(5, 5, 1, 1),
(6, 6, 3, 1),
(7, 7, 4, 1),
(8, 8, 5, 1),
(9, 9, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL,
  `package` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `permission` varchar(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `package`, `controller`, `action`, `method`, `group_id`, `user_id`, `permission`) VALUES
(1, 'pages', 'default', 'get', 'GET', 1, 0, 'A'),
(3, 'pages', 'default', 'get', 'GET', 2, 0, 'A'),
(4, 'templates', 'default', 'get', 'GET', 1, 0, 'A'),
(5, 'templates', 'default', 'get', 'GET', 2, 0, 'A'),
(6, 'contents', 'default', 'get', 'GET', 1, 0, 'A'),
(7, 'contents', 'default', 'get', 'GET', 2, 0, 'A'),
(8, 'common', 'default', 'getHeader', 'GET', 1, 0, 'A'),
(9, 'common', 'default', 'getHeader', 'GET', 2, 0, 'A'),
(10, 'common', 'default', 'getFooter', 'GET', 1, 0, 'A'),
(11, 'common', 'default', 'getFooter', 'GET', 2, 0, 'A'),
(12, 'admin', 'default', 'dashboard', 'GET', 1, 0, 'D'),
(13, 'admin', 'default', 'dashboard', 'GET', 2, 0, 'A'),
(14, 'admin', 'default', 'getHeader', 'GET', 1, 0, 'A'),
(15, 'admin', 'default', 'getHeader', 'GET', 2, 0, 'A'),
(16, 'admin', 'default', 'getFooter', 'GET', 1, 0, 'A'),
(17, 'admin', 'default', 'getFooter', 'GET', 2, 0, 'A'),
(18, 'admin', 'default', 'getMenu', 'GET', 1, 0, 'A'),
(19, 'admin', 'default', 'getMenu', 'GET', 2, 0, 'A'),
(20, 'menus', 'default', 'get', 'GET', 1, 0, 'A'),
(21, 'menus', 'default', 'get', 'GET', 2, 0, 'A'),
(22, 'admin', 'default', 'templates', 'GET', 2, 0, 'A'),
(23, 'admin', 'default', 'pages', 'GET', 2, 0, 'A'),
(24, 'admin', 'default', 'contents', 'GET', 2, 0, 'A'),
(25, 'admin', 'default', 'menus', 'GET', 2, 0, 'A'),
(26, 'admin', 'default', 'categories', 'GET', 2, 0, 'A'),
(27, 'admin', 'default', 'posts', 'GET', 2, 0, 'A'),
(28, 'admin', 'default', 'forms', 'GET', 2, 0, 'A'),
(29, 'templates', 'default', 'jsonGet', 'GET', 2, 0, 'A'),
(30, 'crud', 'default', 'get', 'GET', 1, 0, 'A'),
(31, 'crud', 'default', 'get', 'GET', 2, 0, 'A'),
(32, 'crud', 'default', 'jsonGet', 'GET', 1, 0, 'A'),
(33, 'crud', 'default', 'jsonGet', 'GET', 2, 0, 'A'),
(34, 'crud', 'default', 'jsonSingleGet', 'GET', 1, 0, 'A'),
(35, 'crud', 'default', 'jsonSingleGet', 'GET', 2, 0, 'A'),
(36, 'crud', 'default', 'post', 'POST', 1, 0, 'A'),
(37, 'admin', 'default', 'menu_elements', 'GET', 1, 0, 'A'),
(38, 'admin', 'default', 'menu_elements', 'GET', 2, 0, 'A'),
(39, 'crud', 'default', 'put', 'PUT', 2, 0, 'A'),
(40, 'crud', 'default', 'delete', 'DELETE', 2, 0, 'A'),
(41, 'admin', 'default', 'categories', 'GET', 2, 0, 'A'),
(42, 'admin', 'default', 'posts', 'GET', 2, 0, 'A'),
(43, 'admin', 'additional', 'getPostAdditional', 'GET', 2, 0, 'A'),
(44, 'admin', 'additional', 'getPostAdditionalValues', 'GET', 2, 0, 'A'),
(45, 'admin', 'additional', 'savePostAdditional', 'POST', 2, 0, 'A'),
(46, 'admin', 'default', 'documentation', 'GET', 2, 0, 'A'),
(47, 'admin', 'additional', 'getPageTemplate', 'GET', 2, 0, 'A'),
(48, 'admin', 'additional', 'savePageTemplate', 'POST', 2, 0, 'A'),
(49, 'admin', 'additional', 'getPages', 'GET', 2, 0, 'A'),
(50, 'admin', 'additional', 'saveMainPage', 'POST', 2, 0, 'A'),
(51, 'admin', 'default', 'themes', 'GET', 2, 0, 'A'),
(52, 'admin', 'additional', 'getThemes', 'GET', 2, 0, 'A'),
(53, 'admin', 'additional', 'saveMainTheme', 'POST', 2, 0, 'A'),
(54, 'admin', 'default', 'additional_fields', 'GET', 2, 0, 'A'),
(55, 'admin', 'default', 'file_storage', 'GET', 2, 0, 'A'),
(56, 'admin', 'additional', 'file_upload', 'POST', 2, 0, 'A'),
(57, 'files', 'default', 'post', 'POST', 1, 0, 'A'),
(58, 'admin', 'additional', 'getCategoryTemplate', 'GET', 2, 0, 'A'),
(59, 'admin', 'additional', 'saveCategoryTemplate', 'POST', 2, 0, 'A'),
(60, 'posts', 'default', 'get', 'GET', 1, 0, 'A'),
(61, 'admin', 'default', 'includes', 'GET', 2, 0, 'A'),
(62, 'admin', 'additional', 'saveHead', 'POST', 2, 0, 'A'),
(63, 'auth', 'default', 'get', 'GET', 1, 0, 'A'),
(64, 'admin', 'default', 'login', 'GET', 1, 0, 'A'),
(65, 'auth', 'default', 'check', 'GET', 1, 0, 'A'),
(66, 'admin', 'default', 'logout', 'GET', 2, 0, 'A'),
(67, 'admin', 'additional', 'pageVisible', 'POST', 2, 0, 'A'),
(68, 'admin', 'additional', 'postVisible', 'POST', 2, 0, 'A'),
(69, 'admin', 'additional', 'contentVisible', 'POST', 2, 0, 'A'),
(70, 'admin', 'additional', 'menuVisible', 'POST', 2, 0, 'A'),
(71, 'admin', 'additional', 'menuItemVisible', 'POST', 2, 0, 'A'),
(72, 'files', 'default', 'get', 'GET', 2, 0, 'A'),
(73, 'admin', 'additional', 'fileVisible', 'POST', 2, 0, 'A'),
(74, 'files', 'default', 'delete', 'DELETE', 2, 0, 'A'),
(75, 'admin', 'default', 'designs', 'GET', 2, 0, 'A'),
(76, 'admin', 'additional', 'designVisible', 'POST', 2, 0, 'A'),
(77, 'admin', 'additional', 'mockupVisible', 'POST', 2, 0, 'A'),
(78, 'admin', 'default', 'mockups', 'GET', 2, 0, 'A'),
(79, 'admin', 'default', 'seo', 'GET', 2, 0, 'A'),
(80, 'admin', 'default', 'permissions', 'GET', 2, 0, 'A'),
(81, 'admin', 'default', 'groups', 'GET', 2, 0, 'A'),
(82, 'admin', 'default', 'users', 'GET', 2, 0, 'A'),
(83, 'admin', 'default', 'forms', 'GET', 2, 0, 'A'),
(84, 'admin', 'default', 'formVisible', 'POST', 2, 0, 'A'),
(85, 'admin', 'default', 'formItemVisible', 'POST', 2, 0, 'A'),
(86, 'admin', 'default', 'form_elements', 'GET', 2, 0, 'A'),
(87, 'admin', 'default', 'selects', 'GET', 2, 0, 'A'),
(88, 'admin', 'default', 'options', 'GET', 2, 0, 'A'),
(89, 'admin', 'default', 'users_additional_fields', 'GET', 2, 0, 'A'),
(90, 'admin', 'default', 'shortcodes', 'GET', 2, 0, 'A'),
(91, 'posts', 'default', 'getCategoryList', 'GET', 1, 0, 'A'),
(92, 'forms', 'default', 'get', 'GET', 1, 0, 'A'),
(93, 'common', 'default', 'sendFeedback', 'POST', 1, 0, 'A');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `short` text NOT NULL,
  `content` longtext NOT NULL,
  `cover` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `category`, `language`, `name`, `title`, `short`, `content`, `cover`, `author`, `date`, `visibility`) VALUES
(1, 4, 3, 'bu-gun-azerbaycanda-ilk-tedrisedici-programlashdirma-uzre-meselelerini-test-eden-portal-acildi', 'Bu gün Azərbaycanda ilk tədrisedici, programlaşdırma üzrə məsələlərini test edən portal acıldı.', '<p>Bu gün Azərbaycanda ilk tədrisedici, programlaşdırma üzrə məsələlərini test edən portal acıldı. Bu portal şagirdlərə və tələbələrə olimpiyada yarışlarına hazırlaşmağa kömək etmək məqsədi ilə yaradılıb.</p>', '<span class="text-justify"><p>Bu gün Azərbaycanda ilk tədrisedici, programlaşdırma üzrə məsələlərini test edən portal acıldı. Bu portal şagirdlərə və tələbələrə olimpiyada yarışlarına hazırlaşmağa kömək etmək məqsədi ilə yaradılıb.</p>\n\n\n<p>Test sisteminin beta versiyası artıq mövcuddur Məsələlərin siyahısı tez zamanda yenilənəcək.</p>\n\n<p>Nəzərə çatdırımaq istəyirik ki, bu resurs üç dil dəstəkləyir: rus, inglis və azərbaycan.</p>\n\n<p>Layıhənın qurucuları Lomonosov adına MSU-nun Bakı filialının 4-cü kurs tələbəsi Vəliyev Əli, Lomonosov adına MSU-nun Bakı filialının 1-ci kurs magistrı Proskuryakov Aleksandr. Yaradılan dizayn və dəstəyə görə <a href="http://bitep.net">Bitep</a> kompaniyasına va <a href="http://qformat.net">Qformat</a>&nbsp; intellektual klubuna təşəkkürümüzü bildiririk. Həmçinin, Lomonosov adına MSU-nun Bakı filialının tələbələrinə Kamran Kazımi və İsayeva Səbinəyə interfeys tərcüməsinə görə təşəkkürümüzü bildiririk.</p>\n\n<p>Məsələlərin&nbsp; və dərslərin müzakirəsı <a href="http://qformat.net/blog/ocode/">Qformat</a> intellektual klubunun veb-saytında aparılacaq.</p>\n\n<p>Programlaşdırma ilə məşgul olmaq istəyən hər kəsə uğurlar diləyirik. Biz çox güman edirik ki, bizim layihə sizin üçün çox faydalı olacaq.</p>\n\n<p>Bundan əlavə bizi <a href="http://www.facebook.com/studyprog">Facebook</a>,&nbsp;<a href="http://vk.com/studyprog">VK</a> və <a href="https://twitter.com/StudyProg">Twitter</a>-də izləyə bilərsiniz.&nbsp;</p>\n</span>', 0, 1, '2013-09-14 06:00:00', 1),
(2, 6, 3, 'bu-gun-qafqaz-universitetinde-acm-icpc-azerbaijan-subregional-basha-chatdi', 'Bu gün Qafqaz Universitetində ACM-ICPC Azerbaijan subregional başa çatdı', '<span class="text-justify"><p>Bu gün noyabirin 3-cü 2013 il, Qafqaz Universitetində ACM-ICPC IX Azerbaijan Subregional Contest başa çatdı. Contestdə Azərbaycan universitetlərindən 45 komanda iştirak etmişdir. Rəsmi nəticələri <a href="http://neerc.ifmo.ru/subregions/standings/azerbaijan-2013.html">burada</a> baxa bilərsiniz. Növbəti mərhələ Gurcüstanın paytaxtı Tbilisi şəhərində 30 noyabr - 1 dekabr tarixində keciriləcək. Azərbaycan komandalarına ugurlar dinləyirik!</p>\n</span>', '<span class="text-justify"><p>Bu gün noyabirin 3-cü 2013 il, Qafqaz Universitetində ACM-ICPC IX Azerbaijan Subregional Contest başa çatdı. Contestdə Azərbaycan universitetlərindən 45 komanda iştirak etmişdir. Rəsmi nəticələri <a href="http://neerc.ifmo.ru/subregions/standings/azerbaijan-2013.html">burada</a> baxa bilərsiniz. Növbəti mərhələ Gurcüstanın paytaxtı Tbilisi şəhərində 30 noyabr - 1 dekabr tarixində keciriləcək. Azərbaycan komandalarına ugurlar dinləyirik!</p>\n</span>', 0, 1, '2013-11-03 13:39:52', 1),
(3, 6, 3, 'milli-net-2013-de-saytlarin-qeydiyyati-basha-chatib', 'Milli Net 2013-də saytların qeydiyyatı başa çatıb', '<span class="text-justify"><p>Milli Net Təşkilat Komitəsi bildirir ki, noyabrın 23-ü saat 24.00-da Milli Net-də saytların qeydiyyatı başa çatıb.</p>\n<p>Milli Net Təşkilat Komitəsi bildirir ki, noyabrın 23-ü saat 24.00-da &nbsp;Milli Net-də saytların qeydiyyatı başa çatıb. Bu il Milli İnternet Mükafatına 14 Nominasiya üzrə &nbsp;401 sayt təqdim edilib və hələlik 307 sayt Müsabiqəyə qəbul olunub.</p></span>', '<span class="text-justify"><p>Milli Net Təşkilat Komitəsi bildirir ki, noyabrın 23-ü saat 24.00-da Milli Net-də saytların qeydiyyatı başa çatıb.</p>\n\n\n<p>Milli Net Təşkilat Komitəsi bildirir ki, noyabrın 23-ü saat 24.00-da &nbsp;Milli Net-də saytların qeydiyyatı başa çatıb. Bu il Milli İnternet Mükafatına 14 Nominasiya üzrə &nbsp;401 sayt təqdim edilib və hələlik 307 sayt Müsabiqəyə qəbul olunub.</p>\n\n<p>Saytların qeydiyyat müddəti bitdikdən sonra istifadəçilər yalnız Müsabiqəyə qəbul edilən saytlara öz şərhlərini və rəylərini yazmaq üçün qeydiyyatdan keçə bilərlər.</p>\n\n<p>Bu müddətədək saytlarını qeydiyyatdan keçirib təqdim edənlər, lakin müxtəlif problemlər səbəbindən Milli Net TK tərəfindən &nbsp;Müsabiqəyə buraxılmayanlar &nbsp;1-ci səsvermə başa çatanadək yenidən müraciət edə bilərlər.</p>\n\n<p>Hazırda Milli Net-ə qəbul edilən saytların 1-ci səsvermə prosesi başlayıb və dekabrın 2-si başa çatacaq. 1-ci səsvermənin yekunu olaraq Milli Net –in Nominantları seçiləcək və &nbsp;Nominantlar arasından 2-ci səsvermə nəticəsində Milli İnternet Mükafatının qalibləri müəyyən olunacaq.</p>\n\n<p>2-ci səsvermə prosesi dekabr 3-ü başlayacaq və dekabrın 15- i yekunlaşacaq.</p>\n\n<p>Münsiflərin verdikləri qiymətlər və şərhlər yalnız Təqdimat mərasimindən sonra açıqlanacaq.</p>\n\n<p>Qaliblərin mükafatlandırılması ilə bağlı TƏQDİMAT mərasiminin &nbsp;dekabrın sonunda keçirilməsi nəzərdə tutulub.&nbsp;</p>\n\n<p>Hazırda Təşkilat Komitəsi qaliblərin mükafatlandırılmasına hazırlıq işləri görür.</p>\n\n<p>Müsabiqənin Baş sponsoru Azercell şirkətidir. &nbsp;RİTN və Delta Telecom şirkətləri də Milli İnternet Mükafatına &nbsp;dəstək verirlər.</p>\n\n<p>Daha geniş məlumat www.millinet.az &nbsp; &nbsp; saytında yerləşdirilib.</p>\n\n<p>Qeyd edək ki bizim gənc portalılımız da MilliNet müsabigəsində "Elm və təhsil" kateqoriyasında&nbsp;iştirak edir.</p></span>', 0, 1, '2013-11-25 11:40:49', 1),
(4, 4, 3, 'analitik-helli-olan-meselelerin-test-olunmasi', 'Analitik həlli olan məsələlərin test olunması.', '<span class="text-justify"><p>Veb-saytda analitik həlli olan məsələlərin həll olunması üçün daha rahat interfeysdən.</p>\n\n<p>Hal hazırda bu kategoriyada variyasiya hesablanmasının asan məsələləri var. Bu məsələlərin həlli <b>t</b> parametrdən asılı olan həqiqi funksiyadır. Həllivizi yoxlamaq üçün onu müvafiq sahəyə çap edin və "Göndər" düyməsini basın (bütün riyazi funksiyalari və əməliyyatları C dilinin qaydalarına uyğun yığın).</p>\n</span>', '<span class="text-justify"><p>Veb-saytda analitik həlli olan məsələlərin həll olunması üçün daha rahat interfeysdən.</p>\n\n<p>Hal hazırda bu kategoriyada variyasiya hesablanmasının asan məsələləri var. Bu məsələlərin həlli <b>t</b> parametrdən asılı olan həqiqi funksiyadır. Həllivizi yoxlamaq üçün onu müvafiq sahəyə çap edin və "Göndər" düyməsini basın (bütün riyazi funksiyalari və əməliyyatları C dilinin qaydalarına uyğun yığın).</p>\n\n\n<p>Misal üçün <a href="http://studyprog.com/problem/show?id=57">57</a>-ci məsələyə nəzər edək, onun həlli <b>t</b> funksiyasıdı. <b>t</b> sözünü müvafiq sahəyə yazanda <b>Hesablanıb</b> cavabını alırıq. İndi hesab edək ki məsələni səhv həll etmişik, misal üçün <b>t*t</b> funksiyası alındı. Yazanda görürük ki sistem <b>Cavab yalnışdı</b> cavabını qaytarır.</p>\n</span>', 0, 1, '2013-11-25 11:45:34', 1),
(5, 6, 3, 'amea-nin-informasiya-texnologiyalari-institutunda-kechirilmish-final-merhelesinde-qalibler-mueyyenleshdirilmishdir', 'AMEA-nın İnformasiya Texnologiyaları İnstitutunda keçirilmiş final mərhələsində qaliblər müəyyənləşdirilmişdir.', '<span class="text-justify"><p>Rabitə və Yüksək Texnologiyalar Nazirliyinin, Heydər Əliyev Fondunun, Təhsil Nazirliyinin və AMEA-nın İnformasiya Texnologiyaları İnstitutunun birgə təşkilatçılığı ilə 17 May - Dünya Telekommunikasiya və İnformasiya Cəmiyyəti Gününə həsr olunan “Ali məktəb tələbələri arasında informatika üzrə Ümumrespublika Olimpiadası” 2014-cü ildə növbəti 9-cu dəfə keçirilmişdir. Olimpiadanın 13 aprel 2104-cü il tarixində keçirilmiş ilk mərhələsində respublikanın 8 ali təhsil müəssisəsindən 49 komanda iştirak etmişdir. Respublikanın 8 ali təhsil müəssisəsindən 28 komanda ikinci (final) mərhələsinə vəsiqə qazanmışdır. 26 aprel 2014-cü il tarixində AMEA-nın İnformasiya Texnologiyaları İnstitutunda keçirilmiş final mərhələsində qaliblər müəyyənləşdirilmişdir.</p>\n</span>', '<span class="text-justify"><p>Rabitə və Yüksək Texnologiyalar Nazirliyinin, Heydər Əliyev Fondunun, Təhsil Nazirliyinin və AMEA-nın İnformasiya Texnologiyaları İnstitutunun birgə təşkilatçılığı ilə 17 May - Dünya Telekommunikasiya və İnformasiya Cəmiyyəti Gününə həsr olunan “Ali məktəb tələbələri arasında informatika üzrə Ümumrespublika Olimpiadası” 2014-cü ildə növbəti 9-cu dəfə keçirilmişdir. Olimpiadanın 13 aprel 2104-cü il tarixində keçirilmiş ilk mərhələsində respublikanın 8 ali təhsil müəssisəsindən 49 komanda iştirak etmişdir. Respublikanın 8 ali təhsil müəssisəsindən 28 komanda ikinci (final) mərhələsinə vəsiqə qazanmışdır. 26 aprel 2014-cü il tarixində AMEA-nın İnformasiya Texnologiyaları İnstitutunda keçirilmiş final mərhələsində qaliblər müəyyənləşdirilmişdir.</p>\n\n\n<p><b>1-ci yer</b></p>\n\n<p>Qafqaz Universitetinin “Qafqaz Programmers” komandası</p>\n\n<p><b>2-ci yer</b></p>\n\n<p>M.V. Lomonosov adına Moskva Dövlət Universitetinin Bakı filialının “MSU Programmers” komandası</p>\n\n<p><b>3-cü yer</b></p>\n\n<p>Qafqaz Universitetinin “Qafqaz U4” komandası</p>\n\n<p>Olimpiada qalibləri 17 may - Dünya Telekommunikasiya və İnformasiya Cəmiyyəti Gününə həsr olunan tədbirdə “HP” şirkətinin qiymətli hədiyyələri ilə mükafatlandırılacaqlar.</p>\n</span>', 0, 1, '2014-04-28 12:53:42', 1),
(6, 6, 3, 'telebeler-arasinda-beynelxalq-acm-icpc-proqramlashdirma-yarishinin-olke-merhelesi-kechirilir', 'Tələbələr arasında beynəlxalq ACM ICPC proqramlaşdırma yarışının ölkə mərhələsi keçirilir', '<span class="text-justify"><p>Universitet Tələbələrinin 39-cu ACM ICPC (International Collegiate Programming Contest) Beynəlxalq Proqramlaşdırma Müsabiqəsinin ¼ final və ya ölkə mərhələsi 9 noyabr 2014-cü ildə keçiriləcək.</p>\n\n\n<p>Saat 10.00-da Qafqaz Universitetində müsabiqənin rəsmi açılışı olacaq. Tədbirin təşkilatçıları Qafqaz Universiteti, Bakı Dövlət Universiteti, Proqramlaşdırma Müsabiqələri İştirakçılarının Milli Assosiasiyası, IEEE Azərbaycan bölməsi və Azərbaycan ACM Bölməsidir. Xatırladaq ki, ACM ICPC müsabiqəsinin Azərbaycan üzrə regional direktoru Bakı Dövlət Universitetinin dosenti, fizika-riyaziyyat elmləri namizədi Ramin Mahmudzadə, münsiflər heyətinin sədri isə Qafqaz Universitetinin baş müəllimi Etibar Seyidzadədir.</p>\n</span>', '<span class="text-justify"><p>Universitet Tələbələrinin 39-cu ACM ICPC (International Collegiate Programming Contest) Beynəlxalq Proqramlaşdırma Müsabiqəsinin ¼ final və ya ölkə mərhələsi 9 noyabr 2014-cü ildə keçiriləcək.</p>\n\n\n<p>Saat 10.00-da Qafqaz Universitetində müsabiqənin rəsmi açılışı olacaq. Tədbirin təşkilatçıları Qafqaz Universiteti, Bakı Dövlət Universiteti, Proqramlaşdırma Müsabiqələri İştirakçılarının Milli Assosiasiyası, IEEE Azərbaycan bölməsi və Azərbaycan ACM Bölməsidir. Xatırladaq ki, ACM ICPC müsabiqəsinin Azərbaycan üzrə regional direktoru Bakı Dövlət Universitetinin dosenti, fizika-riyaziyyat elmləri namizədi Ramin Mahmudzadə, münsiflər heyətinin sədri isə Qafqaz Universitetinin baş müəllimi Etibar Seyidzadədir.</p>\n\n<p>Müsabiqədə müxtəlif universitetlərin komandaları iştirak edir, qalib komandalar regional yarımfinala vəsiqə qazanır. İştirak edən hər komanda 3 nəfər bakalavr və ya magistratura səviyyəsində təhsil alan tələbədən ibarət olur. Komandalar 5 saat ərzində verilən məsələləri həll etməyə çaılışır. Beynəlxalq İnformatika Olimpiadasından fərqli olaraq burada bir məsələnin həlli ancaq bütün testləri uğurla keçdikdə düzgün hesab olunur. Komandalara 9-11 alqoritmik məsələnin şərti verilir və müsabiqə zamanı iştirakçılar məsələlərin həllini C, C++, C#, Cava (Java), Paskal (Pascal) proqramlaşdırma dillərindən birində yazıb avtomatik qiymətləndirmə sisteminə göndərirlər. Məsələlərin həlli bu sistem vasitəsilə yoxlanır və komandaya uyğun ballar verilir. Müsabiqənin şərtləri barədə daha ətraflı məlumatı <a href="http://icpc.baylor.edu" target="_blank">http://icpc.baylor.edu</a> veb-saytından əldə etmək olar.</p>\n</span>', 0, 1, '2014-11-08 12:02:35', 1),
(7, 6, 3, 'acm-icpc-x-azerbaijan-subregional-championship-in-neticeleri', '"ACM ICPC X Azerbaijan Subregional Championship"-in nəticələri', '<span class="text-justify"><p>Qafqaz Universitetində “39-cu ACM ICPC Universitet Tələbələrinin Proqramlaşdırma üzrə Beynəlxalq” müsabiqəsinin növbəti 1/4 final mərhələsi (X Azərbaycan Çempionluğu) keçirildi.</p>\n<p>Qafqaz Universiteti, Bakı Dövlət Universiteti, NAPCAR, IEEE Computer Society Azərbaycan bölməsi, IEEE Telecommunication Society Azərbaycan bölməsi, ACM Azərbaycan bölməsinin təşkilatı dəstəyi ilə “39-cu ACM ICPC Universitet Tələbələrinin Proqramlaşdırma üzrə Beynəlxalq” müsabiqəsinin növbəti 1/4 final mərhələsi (X Azərbaycan Çempionluğu) 9 noyabr 2014-cü il tarixində Qafqaz Universitetində keçirildi.</p>\n</span>', '<span class="text-justify">Qafqaz Universitetində “39-cu ACM ICPC Universitet Tələbələrinin Proqramlaşdırma üzrə Beynəlxalq” müsabiqəsinin növbəti 1/4 final mərhələsi (X Azərbaycan Çempionluğu) keçirildi.<br>\nQafqaz Universiteti, Bakı Dövlət Universiteti, NAPCAR, IEEE Computer Society Azərbaycan bölməsi, IEEE Telecommunication Society Azərbaycan bölməsi, ACM Azərbaycan bölməsinin təşkilatı dəstəyi ilə “39-cu ACM ICPC Universitet Tələbələrinin Proqramlaşdırma üzrə Beynəlxalq” müsabiqəsinin növbəti 1/4 final mərhələsi (X Azərbaycan Çempionluğu) 9 noyabr 2014-cü il tarixində Qafqaz Universitetində keçirildi.<br>\nMüsabiqədə 14 universitetdən, o cümlədən 58 komanda (hər komandada 3 tələbə) və müsabiqədənkənar 3 məktəblilər komandası iştirak etdi.<br>\nQafqaz Universiteti – 10<br>\nMoskva Dövlət Universitetinin Bakı filialı – 8<br>\nBakı Dövlət Universiteti – 8<br>\nAzərbaycan Dövlət Neft Akademiyası – 6<br>\nAzərbaycan Milli Aviasiya Akademiyası – 6<br>\nADA Universiteti – 5<br>\nBakı Ali Neft Məktəbi - 3<br>\nAzərbaycan Texniki Universiteti – 3<br>\nXəzər Universiteti – 3<br>\nAzərbaycan Universiteti – 3<br>\nAzərbaycan Memarlıq və İnşaat Universiteti – 1<br>\nAzərbaycan Dövlət Pedaqoji Universiteti – 1<br>\nNaxçıvan Dövlət Universiteti – 1<br>\nOdlaryurdu Univerditeti - 1<br>\nMəktəblilər – 3 (müsabiqədən kənar)<br>\nkomanda ilə (hər komandada 3 nəfər) təmsil olunmuşlar.<br>\nKomandalara 5 saat ərzində 12 alqoritmik məsələni həll etmək tapşırığı verildi. Qiymətləndirmə e-olimp.com.ua/az saytında avtomatik test sistemi ilə aparıldı.<br>\nQafqaz Universitetinin Qafqaz U 1 komandası I; Qafqaz U 2 komandası II; Qafqaz U 3 və Qafqaz U 5 komandaları III, Moskva Dövlət Universitetinin Bakı filialının BakuMSU1 və BakuMSU8 komandaları III yerə layiq görüldülər.<br>\nQafqaz Universitetinin Qafqaz U 6, Qafqaz U 4, Azərbaycan Dövlət Neft Akademiyasının Az SOA 5, Bakı Dövlət Universitetinin Baku SU1, BakuSU 3, Baku SU 2, Moskva Dövlət Universitetinin Bakı flialının BakuMSU2, məktəblilərdən ibarət SHOOL1 və SHOOL2 komandaları III dərəcəli diplomla təltif olundular.<br>\nMüsabiqənin qalibləri 6-7 dekabr 2014-cü il tarixlərində Gürcüstan Respublikasının Tbilisi şəhərində keçiriləcək “39-cu ACM ICPC Universitet Tələbələrinin Proqramlaşdırma üzrə Beynəlxalq” müsabiqəsinin növbəti yarımfinal mərhələsində və Cənubi Qafqaz açıq çempionatında iştirak etmək üçün vəsiqə qazanmışlar.<br>\n<br>\n<a href="http://studyprog.com/pages/getPage?p=acm_azerbaijan2014">Nəticələr</a><br>\n<br>\nI YER<br>\nQafqaz U 1 komandası<br>\nMəhəmməd Vəliyev, Elmi Əhmədov, Təbriz Hacıyev<br>\n<br>\nII YER<br>\nQafqaz U 2 komandası<br>\nRəşad Məmmədov, Qalib Sarayev, Eldar Həsənov<br>\n<br>\nIII YER<br>\nQafqaz U 3 komandası<br>\nNurlan Əliyev, Rövşən Hüseynov, Mahmud Allahverdiyev<br>\n<br>\nIII YER<br>\nBakuMSU1 komandası<br>\nAleksandr Proskuryakov, Əli Vəliyev, Səbuhi Əzimzadə<br>\n<br>\nIII YER<br>\nQafqaz U 5 komandası<br>\nƏləkbər Vəlizadə, Hidayət Soltanzadə, Orxan İsmayilov<br>\n<br>\nIII YER<br>\nBakuMSU8 komandası<br>\nQəzənfər Ağayev, Şahin Kazımov, Bahri Abdullaxan<br>\n<br>\nMənbə: Etibar Səidzadə, Facebookun National Association of Programming Contestants of Azerbaijan Republic grupu.</span>', 0, 1, '2014-11-11 15:09:05', 1),
(8, 4, 3, 'mdu-nun-baki-filialinin-magistrantlarinin-studyprog-layihesi-milli-net-2014-mukafatinda-en-yaxshilar-sirasina-daxil-olub', 'MDU-nun Bakı filialının magistrantlarının Studyprog layihəsi Milli Net 2014 mükafatında ən yaxşılar sırasına daxil olub', '<span class="text-justify"><p>Milli İnternet mükafatı 2014 - Milli Net 2014 qaliblərin mükafatlandırılma mərasimi dekabrın 19-da Bakı Biznes Mərkəzində olub. 6-ci sessiyasında mükafatı təqdimetmə mərasimində Azərbaycan İnternet Forumunun prezidenti Osman Gündüz Milli Net 2014 təşkilat komitəsi adından çıxış edib, Milli Net 2014 və müsabiqə çərçivəsində görülən işlər haqqında məlumat verib.</p>\n</span>', '<span class="text-justify">Milli İnternet mükafatı 2014 - Milli Net 2014 qaliblərin mükafatlandırılma mərasimi dekabrın 19-da Bakı Biznes Mərkəzində olub. 6-ci sessiyasında mükafatı təqdimetmə mərasimində Azərbaycan İnternet Forumunun prezidenti Osman Gündüz Milli Net 2014 təşkilat komitəsi adından çıxış edib, Milli Net 2014 və müsabiqə çərçivəsində görülən işlər haqqında məlumat verib.<br>\nBildirilmişdir ki, 14 nominasiya üzrə 322 sayt təqdim edilib, onlardan 272-i müsabiqəyə buraxılıb. M.V.lomonosov adına MDU-nun Bakı Filialının magistrantları Əli Vəliyev və Aleksandr Proskuryakovun tərəfindən yaradılmış www.studyprog.com saytı Milli Net 2014 müsabiqəsində fəxri üçüncü yeri tutub.<br>\nQeyd edək ki, Studyprog - Azərbaycanda ilk riyaziyyat, proqramlaşdırma və digər müxtəlif bölmə üzrə avtomatik test sistemidir. Bu layihənin yaradılma məqsədi proqramlaşdırma tədrisində şagirdlərə və tələbələrə də kömək etməkdi. Layihə tədris materialları və ya istənilən materialı mənimsəmək arzusunda olanlara kömək edəcək, bu sahədə elmi bazası zənginləşdirilir.<br>\nSayt üç dildə - azərbaycan, rus və ingilis fəaliyyət göstərir. Bu sistem vasitəsilə Moskva Dövlət Universitetinin Bakı Filialının tələbələri arasında proqramlaşdırma üzrə çempionatı və optimallaşdırılması metodları fənn üzrə yoxlama keçirilmişdir. Hazırda sistemdə Azərbaycan məktəblilər və tələbələr arasında proqramlaşdırma üzrə olimpiadaların keçirilməsi üçün imkan var.</span>', 0, 1, '2014-12-19 17:31:08', 1),
(9, 6, 3, 'ali-mekteb-telebeleri-arasinda-informatika-uzre-umumrespublika-olimpiadasi”nin-final-merhelesi-kechirilib', '"Ali məktəb tələbələri arasında informatika üzrə ümumrespublika olimpiadası”nın final mərhələsi keçirilib', '<span class="text-justify"><p class="sizeable" style="text-align: justify;">Mayın 2-də AMEA İnformasiya Texnologiyaları İnstitutunda 17 May - Ümumdünya Telekommunikasiya və İnformasiya Cəmiyyəti gününə həsr olunan “Ali məktəb tələbələri arasında informatika üzrə ümumrespublika olimpiadası”nın final mərhələsi keçirilib.</p>\n\n\n<p class="sizeable" style="text-align: justify;">2007-ci ildən ardıcıl olaraq keçirilən tədbirin təşkilatçıları <a class="sizeable" href="http://www.heydar-aliyev-foundation.org/az" target="_blank">Heydər Əliyev Fondu</a>, AR <a class="sizeable" href="http://www.mincom.gov.az/" target="_blank">Rabitə və Yüksək Texnologiyalar Nazirliyi</a>, AR <a class="sizeable" href="http://edu.gov.az/view.php?lang=az&amp;menu=0" target="_blank">Təhsil Nazirliyi</a> və AMEA İnformasiya Texnologiyaları İnstitutudur.</p>\n</span>', '<span class="text-justify"><p class="sizeable" style="text-align: justify;">Mayın 2-də AMEA İnformasiya Texnologiyaları İnstitutunda 17 May - Ümumdünya Telekommunikasiya və İnformasiya Cəmiyyəti gününə həsr olunan “Ali məktəb tələbələri arasında informatika üzrə ümumrespublika olimpiadası”nın final mərhələsi keçirilib.</p>\n\n\n<p class="sizeable" style="text-align: justify;">2007-ci ildən ardıcıl olaraq keçirilən tədbirin təşkilatçıları <a class="sizeable" href="http://www.heydar-aliyev-foundation.org/az" target="_blank">Heydər Əliyev Fondu</a>, AR <a class="sizeable" href="http://www.mincom.gov.az/" target="_blank">Rabitə və Yüksək Texnologiyalar Nazirliyi</a>, AR <a class="sizeable" href="http://edu.gov.az/view.php?lang=az&amp;menu=0" target="_blank">Təhsil Nazirliyi</a> və AMEA İnformasiya Texnologiyaları İnstitutudur.</p>\n\n<p class="sizeable" style="text-align: justify;">Olimpiadanın final mərhələsində respublikanın 12 ali təhsil müəssisəsindən (Bakı Dövlət Universiteti (BDU), Azərbaycan Dövlət Neft Akademiyası, Qafqaz Universiteti, Bakı Ali Neft Məktəbi, Azərbaycan Texniki Universiteti, Moskva Dövlət Universitetinin (MDU) Bakı filialı, Naxçıvan Dövlət Universiteti, Azərbaycan Respublikası Prezidenti yanında Dövlət İdarəçilik Akademiyası, Azərbaycan Universiteti, Azərbaycan Memarlıq və İnşaat Universiteti, Milli Aviasiya Akademiyası, ADA Universiteti) 12 komanda iştirak edib.</p>\n\n<p class="sizeable" style="text-align: justify;">Öncə qonaqlar institutda yaradılmış innovativ şəraitlə yaxından tanış oldular, onlara institutun maddi-texniki bazası haqqında ətraflı məlumat verilib.</p>\n\n<p class="sizeable" style="text-align: justify;">Sonra təşkilat komitəsinin üzvləri, final mərhələsində iştirak edən universitetlərin nümayəndələrinin iştirakı ilə olimpiadanın açılış mərasimi keçirilib. Tədbiri giriş nitqi ilə açan Rabitə və yüksək texnologiyalar nazirinin müavini <strong>Elmir Vəlizadə</strong> ölkəmizdə informasiya-kommunikasiya texnologiyaları (İKT) sahəsində yüksək ixtisaslı gənc mütəxəssislərə böyük ehtiyac olduğunu bildirib. Qeyd edib ki, İKT-nin dinamik inkişafı və geniş vüsət alması dünyada informasiya cəmiyyətinin formalaşması, bəşəriyyətin inkişafı üçün böyük imkanlar yaradır. “Azərbaycanın gələcəyi olan gənclər də informasiya cəmiyyətinin qurulmasında yaxından iştirak etməlidirlər”, - deyə bildirən E.Vəlizadənin sözlərinə görə, 10-cu dəfədir keçirilən olimpiadanın 10-cu dəfədir keçirilən olimpiadanın ilk mərhələsində respublikanın 16 ali təhsil müəssisəsindən 55 komanda iştirak etmiş, 12 komanda final mərhələsinə vəsiqə qazanmışdır.</p>\n\n<p class="sizeable" style="text-align: justify;">Nazir müavini cari ilin mayın 17-də Cenevrədə Azərbaycanın Qızıl Tərəfdaşı olduğu Beynəlxalq Telekommunikasiya İttifaqının (BTİ) 150 illik yubileyinin və Azərbaycan rabitəsinin yaranmasının 134 illiyinin qeyd olunacağını əlamətdar hadisə kimi qiymətləndirib.</p>\n\n<p class="sizeable" style="text-align: justify;">Sonra çıxış edən olimpiadanın Münsiflər Heyətinin sədri, BDU-nun dosenti, Azərbaycanda informatika üzrə olimpiadaların əsasını qoyan <strong>Ramin Mahmudzadə</strong> gənclərin İKT biliklərinin təkmilləşdirilməsi, informatika və proqramlaşdırma sahəsində istedadlı tələbələrin aşkara çıxarılması və onlara dəstək vermək baxımından olimpiadanın böyük əhəmiyyətə malik olduğunu diqqətə çatdırıb. Qeyd edib ki, başlıca hədəflərdən biri informatika fənni üzrə respublika olimpiadasının qaliblərini beynəlxalq yarışlara hazırlaşdırmaqla Azərbaycanın intellektual yarışlarda yüksək səviyyədə təmsil olunmasına şərait yaratmaqdır.</p>\n\n<p class="sizeable" style="text-align: justify;">AMEA-nın akademik-katibi, İnformasiya Texnologiyaları İnstitutunun direktoru, akademik Rasim Əliquliyev bu gün dünyada informasiya texnologiyaları üzrə yüksəkixtisaslı, böyük elmi-praktiki təcrübəyə malik, innovativ təfəkkürlü kadrların, xüsusən də, proqram mühəndislərinin hazırlanmasına böyük tələbatın olduğunu bildirib. Ölkəmizdə də elm və təhsilin inkişafına ölkə rəhbərliyi tərəfindən daim diqqət və qayğı göstərildiyini söyləyən alim Rabitə və Yüksək Texnologiyalar Nazirliyinin xidmətləri sayəsində son 10 ildə Azərbaycanda İKT sahəsində yüksək nailiyyətlərin əldə olunduğunu dilə gətirib. Azərbaycanda qurulmaqda olan biliklər cəmiyyətinin əsas lokomotivinin proqram mühəndisliyi olduğunu söyləyən R.Əliquliyev bu sahənin AMEA rəhbərliyinin daim diqqət mərkəzində olan sahələrdən biri olduğunu vurğulayıb.</p>\n\n<p class="sizeable" style="text-align: justify;">İKT sahəsində innovasiyaların daha sürətlə vüsət almasında gənc kadrların rolundan danışan akademik bu sahədə yeni imkanların meydana gəlməsi və innovasiyaların geniş tətbiqi prosesinə innovativ təfəkkürə malik gənclərin böyük töhfə verdiyini vurğulayıb. Bu kimi tədbirlərin keçirilməsinin İKT üzrə innovativ təfəkkürə malik istedadlı gənclərin seçilməsi və onların ölkəmizdə bu sahə ilə bağlı həyata keçirilən layihələrə cəlb edilməsinə, ölkəmizin beynəlxalq yarışlarda layiqincə təmsil edilməsinə imkan yaratdığını önə çəkib.</p>\n\n<p class="sizeable" style="text-align: justify;">Sonra olimpiada onlayn rejimdə, www.e-olimp.com saytı vasitəsilə keçirilib. Yarış zamanı hər komandaya 5 saat ərzində 9 məsələni həll etmək tapşırığı verilib.</p>\n\n<p class="sizeable" style="text-align: justify;">Sonda ilk 4 yerə layiq görülmüş komandaların adları açıqlandı. Final mərhələsinin nəticələrinə görə, Qafqaz Universitetinin “Qafqaz Programmers” komandası 1-ci, Azərbaycan Texniki Universitetinin “AzTU1” və ADA Universitetinin “ADA U4” komandaları 2-ci, Milli Aviasiya Akademiyasının “NAA50”, Azərbaycan Dövlət Neft Akademiyasının ADNA1 və Bakı Ali Neft Məktəbinin BHOS1 komandaları isə 3-cü yerə layiq görülüblər.</p>\n\n<p class="sizeable" style="text-align: justify;">Qaliblərə mükafatlar 14 may 2014-cü il tarixdə AMEA İnformasiya Texnologiyaları İnstitutunda keçiriləcək 17 May - İnformasiya Cəmiyyəti Gününə həsr olunmuş tədbirdə təqdim olunacaq.</p>\n</span>', 0, 1, '2015-05-04 17:55:48', 1),
(10, 6, 3, '2019-2020-ci-illerde-beynelxalq-informatika-olimpiadasi-azerbaycanda-ve-sinqapurda-kechirilecek', '2019-2020-ci illərdə Beynəlxalq İnformatika Olimpiadası Azərbaycanda və Sinqapurda keçiriləcək', '<span class="text-justify"><p>2019-2020-ci illərdə Beynəlxalq İnformatika Olimpiadası Azərbaycanda və Sinqapurda keçiriləcək. Bu barədə “Kazinform” agentliyinə Olimpiadanın prezidenti Krassimir Manev bildirib: «Bu gün idarə heyətinin iclasında gələcək olimpiadaların keçiriləcək yerlərin adları açıqlanıb. 2019-cu ildə keçiriləcək Beynəlxalq İnformatika Olimpiadasını Azərbaycan qəbul edəcək. 2020-ci ildə isə Olimpadaya Sinqapur ev sahiblik edəcək».</p>\n</span>', '<span class="text-justify"><p>2019-2020-ci illərdə Beynəlxalq İnformatika Olimpiadası Azərbaycanda və Sinqapurda keçiriləcək. Bu barədə “Kazinform” agentliyinə Olimpiadanın prezidenti Krassimir Manev bildirib: «Bu gün idarə heyətinin iclasında gələcək olimpiadaların keçiriləcək yerlərin adları açıqlanıb. 2019-cu ildə keçiriləcək Beynəlxalq İnformatika Olimpiadasını Azərbaycan qəbul edəcək. 2020-ci ildə isə Olimpadaya Sinqapur ev sahiblik edəcək».</p>\n\n\n<p>Xatırladaq ki, bu il Qazaxıstan ilk dəfə Beynəlxalq İnformatika Olimpiadasını qəbul edib. Tədbirdə 83 ölkədən 630 nümayəndə iştirak edib. Yarışda Güney Koreyadan Ci Xak Yun 600 mümkün baldan 600 bal yığıb. Qazaxıstan yığması 3 gümüş və 1 bürünc medal qazanıb.</p>\n\n<p>2016-cı ildə olimpiada Kazanda, 2017-ci ildə İranda, 2018-ci ildə Yaponiyada keçiriləcək.</p>\n</span>', 0, 1, '2015-08-08 08:01:46', 1),
(11, 6, 3, '11-ci-acm-azerbaycan-subregional-2015-kechirildi', '11-ci ACM Azərbaycan Subregional 2015 keçirildi', '<span class="text-justify"><p style="margin: 0px 0px 6px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">Qafqaz Universitetində “40-cı ACM ICPC Universitet Tələbələrinin Proqramlaşdırma üzrə Beynəlxalq” müsabiqəsinin növbəti 1/4 final mərhələsi (XI Azərbaycan Çempionluğu) keçirilib.</p>\n\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">Qafqaz Universiteti, Bakı Dövlət Universiteti, ADA Universiteti, NAPCAR, IEEE Computer Society Azərbaycan Bölməsi, ACM Azərbaycan bölməsinin təşkilatı dəstəyi ilə “40-cı ACM ICPC Universitet Tələbələrinin Proqramlaşdırma üzrə Beynəlxalq” müsabiqəsinin növbəti 1/4 final mərhələsi (XI Azərbaycan Çempionluğu) 24 oktyabr 2015-ci il tarixində Qafqaz Universitetində keçirilib. Müsabiqədə 15 universitetdən 62 komanda qeydiyyatdan keçib, 55 komanda iştirak edib:</p>\n</span>', '<span class="text-justify"><p style="margin: 0px 0px 6px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">Qafqaz Universitetində “40-cı ACM ICPC Universitet Tələbələrinin Proqramlaşdırma üzrə Beynəlxalq” müsabiqəsinin növbəti 1/4 final mərhələsi (XI Azərbaycan Çempionluğu) keçirilib.</p>\n\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">Qafqaz Universiteti, Bakı Dövlət Universiteti, ADA Universiteti, NAPCAR, IEEE Computer Society Azərbaycan Bölməsi, ACM Azərbaycan bölməsinin təşkilatı dəstəyi ilə “40-cı ACM ICPC Universitet Tələbələrinin Proqramlaşdırma üzrə Beynəlxalq” müsabiqəsinin növbəti 1/4 final mərhələsi (XI Azərbaycan Çempionluğu) 24 oktyabr 2015-ci il tarixində Qafqaz Universitetində keçirilib. Müsabiqədə 15 universitetdən 62 komanda qeydiyyatdan keçib, 55 komanda iştirak edib:</p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">ADA Universiteti – 7 komanda<br>\nAzərbaycan Dövlət Aqrar Universiteti – 1 komanda<br>\nAzərbaycan Dövlət Neft və Sənaye Universiteti – 3 komanda<br>\nAzərbaycan Dövlət Pedaqoji Universiteti – 1 komanda<br>\nAzərbaycan Memarlıq və İnşaat Universiteti – 1 komanda<br>\nAzərbaycan Texniki Universiteti – 1 komanda<br>\nAzərbaycan Universiteti – 6 komanda<br>\nBakı Ali Neft Məktəbi - 4 komanda<br>\nBakı Dövlət Universiteti – 10 komanda<br>\nM.Lomonosov adına Moskva Dövlət Universitetinin Bakı filialı – 4 komanda<br>\nMilli Aviasiya Akademiyası – 6 komanda<br>\nNaxçıvan Dövlət Universiteti – 1 komanda<br>\nQafqaz Universiteti – 6 komanda<br>\nXəzər Universiteti – 4 komanda</p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">Komandalara 5 saat ərzində 12 alqoritmik məsələni C, C++, Java proqramlaşdırma dillərində həll etmək tapşırığı verilib. Qiymətləndirmə PCMS2 online avtomatik test sistemi ilə aparılıb.</p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">Müsabiqənin nəticələri:</p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;"><a href="https://www.facebook.com/l.php?u=https%3A%2F%2Fneerc.ifmo.ru%2Finformation%2Fstandings-azb.html&amp;h=JAQHQKXliAQGrlYQatoPUnQpSYTc6OLnsAf0lqHvkkOHu1w&amp;enc=AZOrnYY24I5Yna1Q_QLa3fg3fizrwQcrW7nWUUrmIWvuwL-VTmr-qZEv5mK54Z-B9FmbKYTTf4QyQBkxEmlg91U8KDKzXH11x0kJMHB9FYuI4nMykHoBsgf1t73woTbRDv6OMU9QAiTemxnpYvojtk_RXDgWaltXzGYU5PHceGpeolKrbntpku6_bqOrwwhqZ4x5dPcUgFnyIkr002KUeEf_&amp;s=1" rel="nofollow" style="color: rgb(59, 89, 152); cursor: pointer; text-decoration: none;" target="_blank">https://neerc.ifmo.ru/information/standings-azb.html</a></p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">I YER<br>\nQafqaz University 2 (Mammadov, Sarayev, Allahverdiyev)</p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">II YER<br>\nQafqaz University 1 (Valiyev, Ahmadov, Hajiyev)<br>\nQafqaz University 3 (Kerimov, Huseynov, Hajili)</p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">III YER<br>\nBaku Branch of Moscow State University 1 (Yahyayev, Veliyev, Kazimi)<br>\nAzerbaijan Technical University (Mammadzade, Rehimova, Abdullayev)<br>\nQafqaz University 5 (Hasanov, Akhundov, Klyestov)</p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">II DƏRƏCƏLİ DİPLOM<br>\nBaku State University 6 (Talibov, Mammadov, Badalov)<br>\nBaku State University 1 (Gasimov, Garibzade, Khidirov)<br>\nAzerbaijan State University of Oil and Industry 2 (Musabeyli, Mammadov, Hesenov)</p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">III DƏRƏCƏLİ DİPLOM<br>\nADA University 2 (Mustafali, Isgandarli, Hasanov)<br>\nBaku Higher Oil School 1 (Huseynli, Bakhshili, Alikhanov)<br>\nADA University 10 (Huseynzade, Farzaliyev, Sadigov)<br>\nBaku Branch of Moscow State University 2 (Plavskiy, Yahyayeva, Perevezenseva)<br>\nADA University 3 (Hasanov, Fahradov, Suleymanov)</p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">YÜKSƏK NAİLİYYƏT SERTİFİKATI<br>\nBaku State University 5 (Aghabayli, Nabiyev, Gadirli)<br>\nBaku Higher Oil School 2 (Omarov, Rahimli, Karimov)<br>\nQafqaz University 4 (Shikhizade, Jeferov, Alakbarov)<br>\nAzerbaijan State University of Oil and Industry 3 (Alasgarov, Alizada, Hasanov)<br>\nBaku State University 2 (Suleymanov, Azer, Alihaydar)<br>\nNational Aviation Academy 6 (Tagiyev, Mammadov, Orujov)<br>\nBaku State University 3 (Abdullayev, Sofiyev, Shukurzade)<br>\nBaku State University 10 (Ismayilova, Aliyeva, Quliyeva)<br>\nADA University 1 (Ilyasov, Musabayli, Gasimov)</p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">Müsabiqənin yarımfinal mərhələsi 5-6 dekabr 2015-ci il tarixlərində Gürcüstan Respublikasının Tbilisi şəhərində keçiriləcək.</p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">Ramin Mahmudzadə<br>\nRegional Director<br>\nACM ICPC NEERC Azərbaycan Subregion</p>\n\n<p style="margin: 6px 0px; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">Etibar Seyidzadə<br>\nChief Judje<br>\nACM ICPC NEERC Azərbaycan Subregion</p>\n\n<p style="margin: 6px 0px 0px; display: inline; color: rgb(20, 24, 35); font-family: helvetica, arial, sans-serif; font-size: 14px; line-height: 19.32px;">NAPCAR</p>\n</span>', 0, 1, '2015-10-25 12:43:58', 1),
(12, 4, 3, 'studyprog-startap-gunlerinde-3-cu-yere-layiq-goruldu', 'Studyprog Startap Günlərində 3-cü yerə layıq göruldü', '<p>Studyprog layihəsi 6-8 noyabrda keçən Startap Günlərində 3-cü yerə layiq görülüb. Sizə <a href="http://xeberler.az/new/details/startap-gunleri-2015-in-qalibleri-elan-olundu--13313.htm">Xəbərlər.az</a> saytından məlumatı çatdırırıq:</p>\n\n\n<p>Günlər çərçivəsində iştirakçılar tərəfindən təqdim edilən 25 &nbsp;ideyanı münsiflər &nbsp;təhlil edib və onlardan &nbsp;6-sı &nbsp;qalib gələrək bu ideya ətrafında komanda formalaşdırmaq və layihə hazırlamaq şansı qazanıb.</p>\n\n<p>Seçilən innovativ biznes ideyaları ətrafında Günlərin iştirakçılarından ibarət olmaqla 4-6 nəfərlik 6 startap komandası formalaşdırılıb.</p>', '<p>Studyprog layihəsi 6-8 noyabrda keçən Startap Günlərində 3-cü yerə layiq görülüb. Sizə <a href="http://xeberler.az/new/details/startap-gunleri-2015-in-qalibleri-elan-olundu--13313.htm">Xəbərlər.az</a> saytından məlumatı çatdırırıq:</p>\n<p>Günlər çərçivəsində iştirakçılar tərəfindən təqdim edilən 25 &nbsp;ideyanı münsiflər &nbsp;təhlil edib və onlardan &nbsp;6-sı &nbsp;qalib gələrək bu ideya ətrafında komanda formalaşdırmaq və layihə hazırlamaq şansı qazanıb. Seçilən innovativ biznes ideyaları ətrafında Günlərin iştirakçılarından ibarət olmaqla 4-6 nəfərlik 6 startap komandası formalaşdırılıb. Seçilmiş komandalara Günlər çərçivəsində beynəlxalq ekspert Justin Crevierin "Marketing Yourself and your Business " ( Sizin marketinq və biznesiniz) mövzusunda təlim keçib. Daha sonra Azərbaycan startap sahəsindən yaxından tanıdığımız Orxan Rzayev komandalara “Yeni startapı necə təqdim etməli” mövzusunda təlim keçib. Startap Günləri boyunca komandalar ekspertlərin və mentorların dəstəyi ilə layihələrin ilkin versiyalarının hazırlanması üzərində işləyiblər.</p>\n<p>Startap Günlərinin iştirakçıları eyni zamanda beynəlxalq startap tədbirlərində və beynəlxalq müsabiqələrdə iştirak edən ekspertlərimizlə görüşüblər. Görüş gənc startapçılarla diskussiya şəraitində davam edib. Bu gün isə tədbirin son günü keçirilib və qalib komandalar açıqlanıb. Xeberler.az-ın məlumatına görə, komandalar bu gün səhərdən münsiflər qarşısında layihələrinin ilkin versiyasının-prototiplərinin təqdimatatını ediblər. Hər komandaya çıxış üçün 3 dəqiqə vaxt verilib. Qeyd edək ki, bu mərhələdə 6 komanda–layihə yarışıb:</p>\n<p>Düşünən beyinlər - startapın əsas məqsədi sürücüləri xüsusi proqramlar vasitəsilə avtomobil qəzalarından qorumaqdır. Yaradılan ağıllı qurğular vasitəsilə istifadəçinin təhlükəsizliyi təmin olunur. Çağır Gəlsin - layihə yerli bazar üçün nəzərdə tutulmuş kuryer xidməti göstərən startapdır. Startapın əsas məqsədi müştəriyə ucuz qiymətə xidmət göstərəcək münasib şəxsləri işə cəlb etməkdir. Study Prog - Azərbaycanda olimpiada proqramlaşdırmanın inkişafı üçün yaranıb. Layihə demək olar ki, onlayn təhsil sistemidi, müəllimlər cəlb edildikdən sonra burada vebinar, videomühazirələr və s. yerləşdirmək nəzərdə tutulub. Vahid mütəxəssis bazası- startapın mahiyyəti müxtəlif ixtisaslar üzrə olan mütəxəssisləri bir platformaya toplamaqdır. İşəgötürənlərin işini asanlaşdırmaq üçün nəzərdə tutulub. MusicBeez- bu platforma istifadəçilərə bəyəndikləri musiqini səs çoxluğu ilə seçdikləri müğənnilərdən dinləmək şansı yaradır. Belə ki, istifadəçilər sistemə daxil olur və istədiyi müğənninin başqa müğənniyə aid mahnısını qeyd edir. Daha sonra həmin müğənni səs çoxluğuna görə istəyi dəyərləndirir. Banging Games - Banging tanks müxtəlif yaşlı istifadəçilər üçün nəzərdə tutulmuş oyundur. İstifadəçinin bu oyunu metroda, yolda gedərkən rahatlıqla oynaya bilməsi və asan istifadəsi üçün yaradılıb. Gələcəkdə oyunun dizaynı və funksiyaları daha da təkmilləşdiriləcək.</p>\n<p>Layihələri münsiflər 10 ballıq sistemlə dəyərləndirib. Nəticədə yüksək bal toplayan MusicBeez komandası qalib olub. 2-ci yeri Banging Games, 3-ci yer isə Study Prog layihəsi tutub. Startap Günləri 2015 –in qalib layihələrinə və qalib layihələrin hər bir iştirakçısına ATL Group və Bakcell şirkətlərinin qiymətli hədiyyələri və diplomlar təqdim olunub. Həmçinin tədbirlərin bütün mərhələlərində aktiv iştirak edənlərə "Startap Azərbaycan " müsabiqəsinin sertifikatı təqdim edilib.</p>\n<p>Startap Günlərinə Rabitə və Yüksək Texnologiyaları Nazirliyi, İnformasiya Texnologiyalarının İnkişafı Dövlət Fondu, Yüksək Texnologiyalar Parkı, Cybernet, SİNAM, Bakcell şirkətləri və ATL Group şirkəti dəstək verib. Startap Azərbaycan tərəfindən Bakıda Yüksək Texnologiyalar Parkında Startap Günləri keçirilib. Tədbir 3 gün davam edib. Bu günlər ərzində iştirakçılara biznes haqqında təlim keçirilib, startap aləmindən yaxından tanıdığımız məşhur startapçılar onlara biznesin həlli yolları mövzusunda, komanda formalaşdırmaq və ideyanı inkişaf etdirmək haqqında öz fikirlərini bölüşüblər.</p>\n<p>Əli Vəliyev hesab edir ki, Startap Günlərində təcrübəli ekspertlərlə ünsiyyətdə olmaq ona çox şey qazandırıb: “3 gün ərzində keçirilən Günlərdə çoxlu məlumat qazandım. Konfransın birinci günündə ekspertlər arasında müzakirə olunan mövzulardan biri də informatika fənninin tədrisi ilə bağlı yaranan problemlər idi. Mənim layihəm də sırf təhsillə əlaqəli olduğu üçün həvəslə təqdim etdim. Startap günləri maraqlı idi, hesab edirəm ki, uğurlu biznesə doğru addımlamaq istəyən hər bir gəncin yolu startap günlərindən keçməlidir”.</p>\n<p>Səbinə İsayeva Xeberler.az-a bildirir ki, tədbir çərçivəsində iştirakçılar üçün yaradılan imkanlar (dəvət olunmuş təlimçilər, ekspertlər, məşhur startapçılar və s.) yüksək səviyyədə təşkil olunub: “Startap Günləri ərzində çoxlu maraqlı, vacib informasiyalar əldə etdim. Birincisi, biznesi necə yaratmaq olar, onun yollarını öyrəndim. Düşünürəm ki, bu istiqamətdə xarici biznes haqqında məlumatlandırılmaq, ondan bəhrələnmək, uğurlu biznes yaratmağın asan yollarını müzakirə etmək vacib idi. Buna görə də təşkilatçılar tərəfindən dəvət olunan beynəlxalq ekspert Justin Crevierin "Marketing Yourself and your Business " ( Sizin marketinq və biznesiniz) mövzusunda keçdiyi təliminə həvəslə qulaq asdım. O cümlədən komandada işləmək, layihəni təqdim etmək, müsahibədə düzgün davranış qaydalarına dair önəmli belə biliklər əldə etdim”.</p>\n<p>Vaqif Kazımov Xeberler.az-a bildirib ki, startap atmosferi ilə tanış olmaq, maraqlı insanlarla ünsiyyət saxlamaq xoş idi. “Startap layihələri haqqında eşitmişdim, amma iştirak etməmişdim. Yaxşı ki gəldim və iştiakçı oldum. Bu 3 gün ərzində startap mühiti ilə tanış olmaq çox maraqlı idi. Burada startapçı üçün layihəni düzgün təqdim etmək, diqqət yetirilməsi vacib olan məqamları bilmək və s. haqqında maraqlı məlumatlar əldə etdim. Hesab edirəm ki, öyrəndiklərimiz gələcək işlərimizdə bizə çox böyük dəstək olacaq”.</p>', 0, 1, '2015-11-08 14:07:39', 1),
(13, 4, 1, 'в-азербайджане-открылся-первый-обучающий-портал-с-системой-тестирования-задач-по-программированию', 'В Азербайджане открылся первый обучающий портал с системой тестирования задач по программированию.', '<p>Сегодня открылся первый обучающий портал в&nbsp;Азербайджане, который поможет школьникам и студентам подготавливаться к соревнованиям по программированию.</p>\n', '<p>Сегодня открылся первый обучающий портал в&nbsp;Азербайджане, который поможет школьникам и студентам подготавливаться к соревнованиям по программированию.</p>\n\n\n<p>Тестирующая система на стадии бета-версии уже доступна для проверки задач. Список задач будет пополнен в кратчайшие сроки.</p>\n\n<p>Также отметим, что данный ресурс поддерживает три языка: русский, азербайджанский и английский.</p>\n\n<p>Разработчиками проекта являются студент 4-го курса Бакинского филиала МГУ им. М. В. Ломоносова - Али Велиев и магистрант 1-го курса Бакинского филиала МГУ им. М. В. Ломоносова - Александр Проскуряков. За созданный дизайн и оказанную поддержку благодарим компанию <a href="http://bitep.net">Bitep</a> и интеллектуальный клуб <a href="http://qformat.net">QFormat</a>.Также благодарим студентов Бакинского филиала МГУ им. М. В. Ломоносова Исаеву Сабину и Кязыми Кямрана за перевод интерфейса и статей на английский и азербайджанский языки соответственно.</p>\n\n<p>Обсуждения задач и уроков будут вестись на сайте интеллектуального сообщества <a href="http://qformat.net/blog/ocode/">QFormat</a>.</p>\n\n<p>Желаем всем,&nbsp; кто решил заняться программированием успехов! Мы очень надеемся, что наш проект окажется для Вас полезным.</p>\n\n<p>Помимо этого StudyProg есть в социальных сетях Facebook и ВКонтакте, а также в микроблоге Твиттер.&nbsp;</p>\n', 0, 1, '2013-09-14 06:00:00', 1),
(14, 4, 1, 'сегодня-в-университете-кавказ-состоялся-14-финала-acm-icpc-azerbaijan-subregional', 'Сегодня в университете Кавказ состоялся 1/4 финала ACM-ICPC Azerbaijan subregional', '<p>3 ноября 2013 года, в университете Кавказ состоялся четвертьфинал ACM-ICPC IX Azerbaijan Subregional Contest. В контесте приняли участие 45 команд из различных вузов Азербайджана. Официальный результат доступен по <a href="http://neerc.ifmo.ru/subregions/standings/azerbaijan-2013.html">ссылке</a>. Следующий этап пройдёт в городе Тбилиси c 30 ноября по 1 декабря 2013 года.</p>\n', '<p>3 ноября 2013 года, в университете Кавказ состоялся четвертьфинал ACM-ICPC IX Azerbaijan Subregional Contest. В контесте приняли участие 45 команд из различных вузов Азербайджана. Официальный результат доступен по <a href="http://neerc.ifmo.ru/subregions/standings/azerbaijan-2013.html">ссылке</a>. Следующий этап пройдёт в городе Тбилиси c 30 ноября по 1 декабря 2013 года.</p>\n', 0, 1, '2013-11-03 13:39:52', 1),
(15, 5, 1, 'в-facebook-распространяется-новый-вирус', 'В Facebook распространяется новый вирус', 'В крупнейшей социальной сети мира начал распространяться новый вирус. Пользователь Facebook видит ссылку на польский сайт, проиллюстрированную фотографией двух людей на капоте автомобиля, передает&nbsp;<a href="http://day.az/" style="color: rgb(55, 97, 178); text-decoration: none;" target="_blank">Day.Az</a>&nbsp;со ссылкой на&nbsp;<a href="http://mignews.com/" style="color: rgb(55, 97, 178); text-decoration: none;" target="_blank">Mignews.com</a>.', 'В крупнейшей социальной сети мира начал распространяться новый вирус. Пользователь Facebook видит ссылку на польский сайт, проиллюстрированную фотографией двух людей на капоте автомобиля, передает&nbsp;<a href="http://day.az/" style="color: rgb(55, 97, 178); text-decoration: none;" target="_blank">Day.Az</a>&nbsp;со ссылкой на&nbsp;<a href="http://mignews.com/" style="color: rgb(55, 97, 178); text-decoration: none;" target="_blank">Mignews.com</a>.\n<p>Заголовок ссылки в переводе с польского означает "Пойман учитель во время романа со студентом. По делу начато расследование (видео)". Пользователь, кликнувший на эту надпись, становится жертвой зловреда.&nbsp;</p>\n\n<p>Как отмечают эксперты из "Лаборатории Касперского, вирус работает следующим образом. У друзей зараженного пользователя Facebook в новостной ленте будет отображаться новость о якобы понравившемся ему сайте. Когда кто-то из друзей кликнет эту новость, у новой жертвы откроется мошенническая страница на польском языке. На этой странице есть скрипт, который без ведома пользователя делает лайк, и вирус распространяется дальше. Одновременно пользователю предлагают просмотреть видео, заплатив с помощью SMS 2,46 злотых.&nbsp;<br />\n<br />\nРанее были зафиксированы аналогичные мошеннические схемы в Рунете.</p>\n', 0, 1, '2013-11-24 07:57:06', 1),
(16, 5, 1, 'google-предложил-способ-перехода-с-iphone-на-android', 'Google предложил способ перехода с iPhone на Android', '<p><span style="background-color:rgb(255, 255, 255); font-family:arial,tahoma; font-size:12px">Председатель совета директоров Google Эрик Шмидт&nbsp;на&nbsp;своей странице в&nbsp;сети Google+&nbsp;предложил перед Рождеством способ перехода на&nbsp;Android-смартфоны для&nbsp;пользователей iPhone, сообщает&nbsp;Digit.ru. </span></p>\n', '<p><span style="background-color:rgb(255, 255, 255); font-family:arial,tahoma; font-size:12px">Председатель совета директоров Google Эрик Шмидт&nbsp;на&nbsp;своей странице в&nbsp;сети Google+&nbsp;предложил перед Рождеством способ перехода на&nbsp;Android-смартфоны для&nbsp;пользователей iPhone, сообщает&nbsp;Digit.ru. </span></p>\n\n\n<p><span style="background-color:rgb(255, 255, 255); font-family:arial,tahoma; font-size:12px">В подробном техническом гиде по&nbsp;переходу на&nbsp;операционную систему Android Шмидт описывает способы перенести на&nbsp;новое устройство список контактов, приложения, музыку и&nbsp;фотографии, и&nbsp;одновременно сохранить их в&nbsp;облачном сервисе компании. Также он рекомендует всем пользователям использовать на&nbsp;смартфонах двухфакторную авторизацию и&nbsp;браузер Chrome. По словам Шмидта, многие из&nbsp;его друзей начали использовать вместо iPhone смартфоны на&nbsp;Android, которые обладают высокой производительностью, имеют лучшие экраны и&nbsp;более удобный интерфейс. Он упомянул Nexus 5, Samsung Galaxy S4 и&nbsp;Motorola Droid Ultra как&nbsp;хорошие идеи для&nbsp;рождественских подарков пользователям iPhone. Как сообщал Digit.ru, по&nbsp;данным аналитического агентства Gartner, операционная система Android сейчас занимает первое место в&nbsp;мире по&nbsp;распространенности&nbsp;— ее доля на&nbsp;рынке составляет 81,9%. iOS остается на&nbsp;втором месте, занимая 12,1%. Компания Apple является вторым крупнейшим производителем смартфонов&nbsp;— в&nbsp;третьем квартале этого года, по&nbsp;данным Gartner, она продала более 30 миллионов устройств, что составляет 12,1% рынка. </span></p>\n\n<p><strong><span style="background-color:rgb(255, 255, 255); font-family:arial,tahoma; font-size:12px">Как Android-смартфоны вытеснили Symbian OS </span></strong></p>\n\n<p><span style="background-color:rgb(255, 255, 255); font-family:arial,tahoma; font-size:12px">В третьем квартале 2013 года операционная система Android и&nbsp;недорогие смартфоны на&nbsp;ее базе укрепили свои позиции, практически полностью вытеснив операционную систему Symbian компании Nokia. Согласно отчету компании МТС, за&nbsp;год продажи смартфонов, работающих на&nbsp;операционной системе Android, увеличились с&nbsp;64% в&nbsp;третьем квартале 2012 года до&nbsp;75,6% в&nbsp;третьем квартале 2013 года. Рост популярности смартфонов на&nbsp;Android происходит за&nbsp;счет большого количества доступных устройств, которые вызывают интерес у&nbsp;разных целевых аудиторий.</span><br />\n<br />\n<span style="background-color:rgb(255, 255, 255); font-family:arial,tahoma; font-size:12px">Подробности:&nbsp;</span><a href="http://www.1news.az/az/economy/tech/20131125125433262.html" style="margin: 0px; padding: 0px; font-family: Arial, Tahoma; color: rgb(0, 0, 0); font-size: 12px; line-height: normal;">http://www.1news.az/az/economy/tech/20131125125433262.html</a></p>\n', 0, 1, '2013-11-25 11:34:03', 1);
INSERT INTO `posts` (`id`, `category`, `language`, `name`, `title`, `short`, `content`, `cover`, `author`, `date`, `visibility`) VALUES
(17, 4, 1, 'тестирование-задач-с-аналитическим-решением', 'Тестирование задач с аналитическим решением.', '<p>Добавлена возможность тестирования задач, имеющих аналитическое решение через более удобный интерфейс.</p>\n\n<p>В настоящее время такими задачами на сайте являются задачи простейшего вариационного исчисления.Решением таких задач являются функции, зависящие от одного вещественного аргумента <b>t</b>. Для того чтобы проверить свое решение введите его в соответствующее поле и нажмите кнопку отправить (все арифметические операции и функции должны быть написаны по правилам языка Си).</p>\n', '<p>Добавлена возможность тестирования задач, имеющих аналитическое решение через более удобный интерфейс.</p>\n\n<p>В настоящее время такими задачами на сайте являются задачи простейшего вариационного исчисления.Решением таких задач являются функции, зависящие от одного вещественного аргумента <b>t</b>. Для того чтобы проверить свое решение введите его в соответствующее поле и нажмите кнопку отправить (все арифметические операции и функции должны быть написаны по правилам языка Си).</p>\n\n\n<p>Для примера рассмотрим задачу <a href="http://studyprog.com/problem/show?id=57">57</a>, ее решением является функция <b>t</b>. Пишем <b>t</b> в соответствующее полеи получаем вердикт <b>Засчитано</b>. Предположим теперь, что мы нашли функцию неправильно, например получили <b>t*t</b>. Пишем ее в указанное поле и получаем вердикт <b>Неверный ответ</b>.</p>\n', 0, 1, '2013-11-25 11:45:34', 1),
(18, 4, 1, 'первая-контрольная-работа-на-системе-studyprog', 'Первая контрольная работа на системе Studyprog', '<p>23 декабря 2013 года в Бакинском Филиале МГУ прошло первое тестирование на сервисе StudyProg.</p>\n\n<p>В испытательном соревновании приняло участие 7 человек. Участникам было предложено решить по одной задаче на разные темы по дисциплине "Оптимизация". Участники показали положительные результаты, с которыми можно ознакомиться по <a href="http://studyprog.com/ru/contest/result/?id=3">ссылке</a>.</p>\n', '<p>23 декабря 2013 года в Бакинском Филиале МГУ прошло первое тестирование на сервисе StudyProg.</p>\n\n<p>В испытательном соревновании приняло участие 7 человек. Участникам было предложено решить по одной задаче на разные темы по дисциплине "Оптимизация". Участники показали положительные результаты, с которыми можно ознакомиться по <a href="http://studyprog.com/ru/contest/result/?id=3">ссылке</a>.</p>\n\n\n<p>Профессор Эльфат Михайлович Галеев и все участники испытания были довольны проведённым мероприятием. Создатели проекта заявили, что будут дальше продолжать улучшать систему, чтобы в будущем на ней можно было бы проводить настоящие зачётные тестирования.</p>\n\n<p>А сейчас ознакомимся с мнением участников испытания и прокоментируем некоторые из них.</p>\n\n<p><strong>Алиева Лейла</strong>: "Мне понравилось минималистичное оформление сайта. Проверка решенных задач прошла очень быстро, что заметно экономит время. Не понравился долгий процесс регистрации, но, я думаю, это возможно решить".</p>\n\n<p><strong>Комментарий</strong>: Разумеется можно. В будущем планируется ввести систему Open ID (регистрация через Facebook, Google и т.д.).</p>\n\n<p><strong>Джахангирова Лейла</strong>: "Система тестирования мне очень понравилась. Быстродействие системы приводит в восторг. Надеюсь в будущем зачёты будут проходить именно таким образом. Я желаю удачи авторам проекта и надеюсь, что в дальнейшем будут предоставлены более обширные возможности системы".</p>\n\n<p><strong>Исмайлова Лейли</strong>: Хороший сайт, удобный, с хорошим интерфейсом. Особо покопаться не успела, но то, что видела очень даже нормально. Единственно, можно добавить ссылку на помощь на страничку с вводом решения.</p>\n\n<p><strong>Комментарий</strong>: Если есть хоть одно замечание по этому поводу - мы обязаны это исправить.</p>\n', 0, 1, '2013-12-29 04:49:07', 1),
(19, 4, 1, 'поздравления-с-днём-солидарности-всех-азербайджанцев-и-с-новым-годом', 'Поздравления с Днём солидарности всех азербайджанцев и с Новым годом', 'Studyprog поздравляет всех с Днём солидарности азербайджанцев всего мира и с Новым годом.<cut></cut> Мы желаем Вам счастья, успехов, побед, а самое главное хотели бы сказать: "Если у Вас есть какая-то цель, просто не смотря ни на что стремитесь к ней, и удача скорее всего повернётся к Вам лицом". С НОВЫМ ГОДОМ!!!', 'Studyprog поздравляет всех с Днём солидарности азербайджанцев всего мира и с Новым годом.<cut></cut> Мы желаем Вам счастья, успехов, побед, а самое главное хотели бы сказать: "Если у Вас есть какая-то цель, просто не смотря ни на что стремитесь к ней, и удача скорее всего повернётся к Вам лицом". С НОВЫМ ГОДОМ!!!', 0, 1, '2013-12-31 04:45:18', 1),
(20, 5, 1, '25-худших-паролей-в-2013-году', '25 худших паролей в 2013 году', '<p>Интернет-ресурс SplashData провел интересное ежегодное исследование и составил рейтинг самых худших паролей 2013 года.</p>\n', '<p>Интернет-ресурс SplashData провел интересное ежегодное исследование и составил рейтинг самых худших паролей 2013 года.</p>\n\n\n<p>Впервые за всю историю подобного мониторинга с лидирующей позиции на второе место ушел пароль "Password". В 2013 году самым популярным и в то же время худшим паролем оказалась комбинация "123456". Также в рейтинге присутствуют такие пароли, как "qwerty", "iloveyou", "1234" и "111111". Рейтинг паролей SplashData основывается на базах данных украденных паролей, которые были найдены в Интернете. Наличие в рейтинге таких паролей, как "photoshop" и "adobe123" дает понять, что ни в коем случае не нужно генерировать пароль, исходя из названия сайта, который в любой момент может быть взломан. Генеральный директор SplashData заметил интересный факт: повышается популярность простых цифровых паролей. Он находит это странным, ведь большинство сайтов выдвигают очень строгие требования к установке пароля. С рейтингом 25 худших паролей года вы можете ознакомиться ниже.</p>\n<img src="http://studyprog.com/images/news/passwordrank.jpg" />', 0, 1, '2014-01-22 12:59:49', 1),
(21, 4, 1, 'studyprog-будет-представлен-на-конференции-ломоносов', 'Studyprog будет представлен на конференции "Ломоносов"', '<p>3 марта 2014-го года, в Бакинском филиале МГУ прошёл региональный этап XXI международной конференции студентов, аспирантов и молодых учёных "Ломоносов". Доклад "Расширенная тестирующая система" был удостоен членами жюри первого места. Конференция пройдёт в Москве, с 7-го по 11-е апреля. Проект будет представлять Проскуряков Александр Игоревич. Желаем удачи!</p>\n', '<p>3 марта 2014-го года, в Бакинском филиале МГУ прошёл региональный этап XXI международной конференции студентов, аспирантов и молодых учёных "Ломоносов". Доклад "Расширенная тестирующая система" был удостоен членами жюри первого места. Конференция пройдёт в Москве, с 7-го по 11-е апреля. Проект будет представлять Проскуряков Александр Игоревич. Желаем удачи!</p>\n', 0, 1, '2014-03-03 14:05:56', 1),
(22, 4, 1, 'в-бакинском-филиале-мгу-состоялась-первая-олимпиада-на-тестирующей-системе-studyprog', 'В Бакинском филиале МГУ состоялась первая олимпиада на тестирующей системе Studyprog', '<p>15 марта 2014-го года в Бакинском филиале МГУ на системе Studyprog прошёл Первый Чемпионат университета. На соревновании участникам было предложено 6 задач на 3 часа. В олимпиаде приняли участие 15 человек. 6 из них были удостоены дипломами 1,2 и 3 степени, а остальные были награждены сертификатами участников. За решённые 4 задачи диплом первой степени получил Плавский Юрий (группа 212), дипломами второй степени были награждены Агаев Газанфар и Исаева Сабина за решённые 3 задачи (группа 211), дипломами 3ей степени за 2 решённые задачи были награждены Кязымов Вагиф, Гейдаров Тимур и Гусейнов Микаил (группа 213). 19 марта прошло награждение победителей.</p>\n', '<p>15 марта 2014-го года в Бакинском филиале МГУ на системе Studyprog прошёл Первый Чемпионат университета. На соревновании участникам было предложено 6 задач на 3 часа. В олимпиаде приняли участие 15 человек. 6 из них были удостоены дипломами 1,2 и 3 степени, а остальные были награждены сертификатами участников. За решённые 4 задачи диплом первой степени получил Плавский Юрий (группа 212), дипломами второй степени были награждены Агаев Газанфар и Исаева Сабина за решённые 3 задачи (группа 211), дипломами 3ей степени за 2 решённые задачи были награждены Кязымов Вагиф, Гейдаров Тимур и Гусейнов Микаил (группа 213). 19 марта прошло награждение победителей.</p>\n\n\n<p>За огранизацию олимпиады хотелось бы сказать "Спасибо" доц. Григорьеву Илье Сергеевичу, за оказанную им помощь, поддержу и представленные задачи. Олимпиада прошла на высоком уровне, не было зафиксировано никаких нарушений со стороны участников, никаких спорных вопросов на счёт некорректности условия и тестов к задачам. Система Studyprog полностью оправдала все ожидания разработчиков.</p>\n\n<p>Разработчик проекта Али Велиев заявил: "Система полностью работоспособна на языках С/С++. В ближайшее время мы внедрим языки Pascal и Java, и с этого момента Studyprog будет полностью готов провести Открытую Республиканскую Олимпиаду не только среди студентов, но и среди всех желающих".</p>\nВидео с олимпиады:<br />\n<iframe allowfullscreen="" frameborder="0" height="315" src="//www.youtube.com/embed/jFewIfv8QUc" width="560"></iframe><br />\nВидео с награждения:<br />\n<iframe allowfullscreen="" frameborder="0" height="315" src="//www.youtube.com/embed/kMq8FbURT7I" width="560"></iframe>', 0, 1, '2014-03-20 09:48:50', 1),
(23, 4, 1, 'studyprog-покорил-ломоносов-2014', 'Studyprog покорил "Ломоносов 2014"', '<p>C 7 по 11 апреля в МГУ проходил Международный молодежный научный форум «Ломоносов». Форум включал в себя одноименную конференцию, всероссийский конкурс студенческих бизнес-идей «Потенциал будущего», выставку образовательных программ МГУ, форум «Новое Поколение-2014» и другие мероприятия.</p>\n', '<p>C 7 по 11 апреля в МГУ проходил Международный молодежный научный форум «Ломоносов». Форум включал в себя одноименную конференцию, всероссийский конкурс студенческих бизнес-идей «Потенциал будущего», выставку образовательных программ МГУ, форум «Новое Поколение-2014» и другие мероприятия.</p>\n\n\n<p>Доклад «Расширенная тестирующая система» магистранта 1 года обучения и студента 4 курса факультета прикладной математики Проскурякова Александра и Велиева Али были признаны лучшим докладом секции. (<a href="http://msu.az/ru/news-view/123-%D0%98%D1%82%D0%BE%D0%B3%D0%B8%20%D0%9C%D0%B5%D0%B6%D0%B4%D1%83%D0%BD%D0%B0%D1%80%D0%BE%D0%B4%D0%BD%D0%BE%D0%B9%20%D0%BD%D0%B0%D1%83%D1%87%D0%BD%D0%BE%D0%B9%20%D0%BA%D0%BE%D0%BD%D1%84%D0%B5%D1%80%D0%B5%D0%BD%D1%86%D0%B8%D0%B8%20%D1%81%D1%82%D1%83%D0%B4%D0%B5%D0%BD%D1%82%D0%BE%D0%B2,%20%D0%B0%D1%81%D0%BF%D0%B8%D1%80%D0%B0%D0%BD%D1%82%D0%BE%D0%B2%20%D0%B8%20%D0%BC%D0%BE%D0%BB%D0%BE%D0%B4%D1%8B%D1%85%20%D1%83%D1%87%D0%B5%D0%BD%D1%8B%D1%85%20%C2%AB%D0%9B%D0%BE%D0%BC%D0%BE%D0%BD%D0%BE%D1%81%D0%BE%D0%B2-2014%C2%BB">источник</a>)</p>\n\n<p>Отметим, что несмотря на столь короткий срок существования Studyprog, он уже успел зарекомендовать себя как надёжная тестирующая система, помощник по решению задач и по подготовке к разного рода мероприятиям по проверке знаний. Также Studyprog является участником проекта <a href="http://www.netty.az/cgi-bin/onelike.cgi?id=49">NETTY</a></p>\n', 0, 1, '2014-04-19 14:25:02', 1),
(24, 4, 1, 'стали-известны-результаты-республиканской-олимпиады-по-программированию-среди-студентов-вузов', 'Стали известны результаты Республиканской олимпиады по программированию среди студентов ВУЗов', 'Организованный Министерством Связи и Высоких Технологий, Фондом Гейдара Алиева и Институтом Информационных Технологий НАНА финал <a href="http://olimpiada.az">Чемпионата Азербайджана по программированию среди студентов</a> прошёл 26-го апреля 2014 года в ИИТ НАНА.', 'Организованный Министерством Связи и Высоких Технологий, Фондом Гейдара Алиева и Институтом Информационных Технологий НАНА финал <a href="http://olimpiada.az">Чемпионата Азербайджана по программированию среди студентов</a> прошёл 26-го апреля 2014 года в ИИТ НАНА. В финале приняло участие 28 команд (10 из университета "Кавказ", 3 из Бакинского филиала МГУ, 7 из БГУ, 1 из АТУ, 2 из АГНА, 3 из БВНШ, 1 из Нахчиванского и 1 из Гянджинского университета). Участникам было предложено решить 10 задач за 5 часов.\n<p>В результате были выявлены 3 победителя:</p>\n\n<p><b>I МЕСТО</b></p>\n\n<p>Qafqaz Programmers - университет "Кавказ".</p>\n\n<p><b>II МЕСТО</b></p>\n\n<p>MSU Programmers - Бакинский филиал МГУ</p>\n\n<p><b>III МЕСТО</b></p>\n\n<p>Qafqaz U4 -&nbsp;университет "Кавказ".</p>\n\n<p>Победители будут награждены ценными призами от компании HP. Поздравляем!</p>\n&nbsp;', 0, 1, '2014-04-28 12:53:42', 1),
(25, 4, 1, 'studyprog-обновился-до-версии-20', 'Studyprog обновился до версии 2.0', '14 сентября 2013-го года был запущен проект Studyprog. Главной целью этого проекта была проверка олимпиадных задач и проведение соревнований на сайте. Но позже на сайте впервые в мире появилась возможность тестировать задачи высшей математики. В класс таких задач входили задачи вычисления квадратурных формул, задачи оптимизации и выпуклого анализа, а также задачи вычислительной математики.', '14 сентября 2013-го года был запущен проект Studyprog. Главной целью этого проекта была проверка олимпиадных задач и проведение соревнований на сайте. Но позже на сайте впервые в мире появилась возможность тестировать задачи высшей математики. В класс таких задач входили задачи вычисления квадратурных формул, задачи оптимизации и выпуклого анализа, а также задачи вычислительной математики.<br />\nСегодня же мы выпускаем новую версию проекта:<br />\n1. Новый дизайн. Каркас сайта написан на разметке Bootstrap. Это позволяет адекватно отображать его на смартфонах и планшетах. Сайт посажен на MVC framework Qbit 3. Использованные языки: HTML5, CSS3, Javascript, PHP, MySql, Shell. Также внедрено большое количество jQuery плагинов.<br />\n2. Теперь для компиляции задач доступны 4 компилятора: С (gcc), С++ (g++), Java (jdk) и Pascal (fpc). Это выводит Studyprog на уровень проведения соревнований, скажем среди школьников.<br />\n3. На сайте любой пользователь, имеющий определённые права может вести собственный блог. Как пример, этим могут заниматься преподаватели информатики.<br />\n4. Исправлены системные баги.<br />\n5. Сайт оснащён ректорами LaTeX и MathML.<br />\n6. Дружелюбный интерфейс для пользователей и больше полезной литературы по всем направлениям математики.<br />\nТакже подписывайтесь на нас в соц. сетях:<br />\nFacebook: <a href="https://www.facebook.com/studyprog">https://www.facebook.com/studyprog</a><br />\nTwitter: <a href="https://twitter.com/StudyProg">https://twitter.com/StudyProg</a><br />\nВКонтакте: <a href="http://vk.com/studyprog">http://vk.com/studyprog</a><br />\nGoogle+: <a href="https://plus.google.com/+Studyprog">https://plus.google.com/+Studyprog</a><br />\nYoutube: <a href="https://www.youtube.com/user/studyprog">https://www.youtube.com/user/studyprog</a><br />\nInstagram: <a href="http://instagram.com/studyprog">http://instagram.com/studyprog</a><br />\n<br />\nЕсли Вы являетесь преподавателем, то Вы сможете стать администратором проекта написав письмо по адресу: <a href="mailto:admin@studyprog.com">admin@studyprog.com</a><br />\nЕсли Вы хотите добавить задачу, Вы можете отправить письмо адресу <a href="mailto:problems@studyprog.com">problems@studyprog.com</a>.<br />\nДля публикации статьи обращайтесь по адресу <a href="mailto:article@studyprog.com">article@studyprog.com</a><br />\nВаши предложения по улучшению проекта мы рады видеть на <a href="mailto:partners@studyprog.com">partners@studyprog.com</a><br />\n<br />\nТакже хотим поблагодарить наших партнёров: <a href="http://bitep.net">компанию BITEP</a> и <a href="http://qformat.net">интеллектуальный клуб QFormat</a>.<br />\n<br />\nБолее детальную информацию о проекте можно получить в разделах <a href="http://studyprog.com/about/">"О проекте"</a> и <a href="http://studyprog.com/help/">"Помощь"</a>', 0, 1, '2014-09-01 06:00:00', 1),
(26, 4, 1, 'результаты-открытого-кубка-им-лотфи-заде-2014', 'Результаты Открытого Кубка им. Лотфи-Заде 2014', '<p>\n  21 сентября 2014-го года в университете Кавказ состоялся первый Открытый Кубок им. Лотфи-Заде по программированию. Ведущим мероприятия был старший преподаватель университета "Кавказ" Этибар Сеидзаде. В начале мероприятия выступили организаторы и члены жюри (в составе с доц. Рамином Махмудзаде, доц. Абзеддином Адамовым, Али Гасановым, Тофигом Гасановым, Бахрузом Гарамамедовым, Адылем Алиевым и Назимом Сулейманлы) и пожелали участникам удачи, а также рассказали идею создания данного соревнования.</p>', '<p>\n  21 сентября 2014-го года в университете Кавказ состоялся первый Открытый Кубок им. Лотфи-Заде по программированию. Ведущим мероприятия был старший преподаватель университета "Кавказ" Этибар Сеидзаде. В начале мероприятия выступили организаторы и члены жюри (в составе с доц. Рамином Махмудзаде, доц. Абзеддином Адамовым, Али Гасановым, Тофигом Гасановым, Бахрузом Гарамамедовым, Адылем Алиевым и Назимом Сулейманлы) и пожелали участникам удачи, а также рассказали идею создания данного соревнования.</p><p>Кубок Лотфи-Заде является аналогом Кубка Векуа, который на международном масштабе проводится каждый год в Грузии. Организаторы выразили своё мнение относительно нынешнего мероприятия и заявили, что массовое участие в данном мероприятии также выведет его на международный уровень и ещё раз прославит имя великого азербайджанского учёного. Также было кратко рассказано про биографию Лотфи-Заде. За создание задач выпускникам университета "Кавказ" была выражена благодарность.\n</p>\n<p>\n  После открытия Кубка участники приступили к решению 9-ти задач в течении 5-ти часов на системе <a href="http://e-olimp.com.ua">e-olimp</a>. В мероприятии приняли участие 49 участников из разных ВУЗ-ов Азербайджана, в том числе и вне конкурса из стран Европы участвовали бывшие выпускники азербайджанских ВУЗов. В результате всем участникам были розданы майки с логотипом мероприятия, а также сертификаты за участие. Участники решившие 3-4 задачи были награждены дипломами третьей степени, 5 задач - второй степени, 6-7 задач - первой степени.\n</p>\n<p>\n  Первое место, Кубок и золотую медаль получил студент университета "Кавказ" Рашид Мамедов за 7 решёных задач.\n</p>\n<p>\n  Второе место и серебряные медали получили магистрант Бакинского филиала МГУ им. М. В. Ломоносова Велиев Али и студент университета "Кавказ" Махмуд Аллахвердиев.\n</p>\n<p>\n  Третье место и бронзовые медали достались студентам университета "Кавказ" Тебриз Гаджиев, Эльми Ахмедов и магистранту Азербайджанской Государственной Академии Мусагилю Мусабейли.\n</p>\n<p>\n  Победителям также были вручены ценные призы.\n</p>\n<p>\n  Также символические призы были вручены организаторам и членам жюри данного мероприятия.\n</p>\n<p>\n  Предлагаем вниманию читателей видео с награждения участников из Бакинского филиала МГУ.\n</p>\n<iframe allowfullscreen="" frameborder="0" height="315" src="//www.youtube.com/embed/t47m2WlOeU0" width="560"></iframe>', 0, 1, '2014-09-21 13:24:36', 1),
(27, 4, 1, 'результаты-acm-icpc-x-azerbaijan-subregional-championship', 'Результаты "ACM ICPC X Azerbaijan Subregional Championship"', 'В университете Кавказ прошёл четвертьфинал “39-го Чемпионата Мира по программированию среди студентов ACM ICPC” (X Чемпионат Азербайджана).', 'В университете Кавказ прошёл четвертьфинал “39-го Чемпионата Мира по программированию среди студентов ACM ICPC” (X Чемпионат Азербайджана).<br />\nПри поддержке университета "Кавказ", Бакинского Государственного Университета, NAPCAR, IEEE Computer Society Azərbaycan bölməsi, IEEE Telecommunication Society Azərbaycan bölməsi, ACM Azərbaycan bölməsinin təşkilatı 9 ноября 2014-го года в университете "Кавказ" прошёл четвертьфинал “39-го Чемпионата Мира по программированию среди студентов ACM ICPC” (X Чемпионат Азербайджана).<br />\nВ соревновании приняло участие 58 команд из 14 университетов и 3 школьные команды (вне конкурса)<br />\nУниверситет "Кавказ" – 10<br />\nБакинский филиал МГУ – 8<br />\nБакинский Государственный Университет – 8<br />\nАзербайджанская Государственная Нефтяная Академия – 6<br />\nАзербайджанская Национальная Академия Авиации – 6<br />\nУниверситет "АДА" – 5<br />\nВысшая Нефтяная школа Баку - 3<br />\nАзербайджанский Технический Университет – 3<br />\nУниверситет "Хазар" – 3<br />\nУниверситет "Азербайджан" – 3<br />\nАзербайджанский Архитектурно-строительный Университет – 1<br />\nАзербайджанский Государственный Педагогический Университет – 1<br />\nНахичеванский Государственный Университет – 1<br />\nУниверситет "Одлар Юрду" - 1<br />\nШкольники – 3 (вне конкурса)<br />\nпредставляли свои университеты в командном виде (в каждой команде по 3 человека).<br />\nКомандам было дано решить 12 алгоритмических задач за 5 часов. Оценивание проводилось с помощью автоматической тестирующей системы e-olimp.com.ua/az<br />\nКоманда Qafqaz U 1 университета "Кавказ" удостоилась I места; Qafqaz U 2 II места; Qafqaz U 3 и Qafqaz U 5 III и команды Бакинского филиала МГУ BakuMSU1 и BakuMSU8 III места.<br />\nКоманды Университета "Кавказ" Qafqaz U 6, Qafqaz U 4, команда Азербайджанской Государственной Нефтяной Академии Az SOA 5, Бакинского Государственного Университета Baku SU1, BakuSU 3, Baku SU 2, Бакинского филиала МГУ BakuMSU2, школьников SHOOL1 и SHOOL2 удостоились диплома III степени.<br />\nПобедители конкурса получают право участвовать в полуфинале “39-го Чемпионата Мира по программированию среди студентов ACM ICPC” и Открытого Чемпионата Южного Кавказа который пройдёт 6-7 декабря 2014-го года в городе Тбилиси.<br />\n<br />\n<a href="[[constant name=portal_url]]pages/getPage?p=acm_azerbaijan2014">Результаты</a><br />\n<br />\nI МЕСТО<br />\nКоманда Qafqaz U 1<br />\nMəhəmməd Vəliyev, Elmi Əhmədov, Təbriz Hacıyev<br />\n<br />\nII МЕСТО<br />\nКоманда Qafqaz U 2<br />\nRəşad Məmmədov, Qalib Sarayev, Eldar Həsənov<br />\n<br />\nIII МЕСТО<br />\nКоманда Qafqaz U 3<br />\nNurlan Əliyev, Rövşən Hüseynov, Mahmud Allahverdiyev<br />\n<br />\nIII МЕСТО<br />\nКоманда BakuMSU1<br />\nAleksandr Proskuryakov, Əli Vəliyev, Səbuhi Əzimzadə<br />\n<br />\nIII МЕСТО<br />\nКоманда Qafqaz U 5<br />\nƏləkbər Vəlizadə, Hidayət Soltanzadə, Orxan İsmayilov<br />\n<br />\nIII МЕСТО<br />\nКоманда BakuMSU8<br />\nQəzənfər Ağayev, Şahin Kazımov, Bahri Abdullaxan<br />\n<br />\nИсточник: Этибар Сеидзаде, группа National Association of Programming Contestants of Azerbaijan Republic в Facebook.', 0, 1, '2014-11-11 15:09:05', 1),
(28, 4, 1, 'проект-studyprog-магистрантов-бакинского-филиала-мгу-вошел-в-тройку-лучших-премии-milli-net-2014', 'Проект Studyprog магистрантов Бакинского филиала МГУ вошел в тройку лучших премии Milli Net 2014', '19 декабря в Баку Бизнес Центре состоялась церемония награждения победителей премии Milli Net 2014 – Национальный Интернет 2014.<span style="line-height: 20.7999992370605px;">', '19 декабря в Баку Бизнес Центре состоялась церемония награждения победителей премии Milli Net 2014 – Национальный Интернет 2014.<span style="line-height: 20.7999992370605px;"></span> На 6-ой церемонии вручения премии Milli Net 2014 от имени организационного комитета выступил президент Интернет-форума Азербайджана Осман Гюндуз, который рассказал о Milli Net 2014 и о работах, проделанных в рамках конкурса.<br />\nБыло отмечено, что в 14 номинациях были представлены 322 сайта, из которых 272 допущены к конкурсу. Сайт www.studyprog.com, созданный магистрантами Филиала МГУ имени М.В.Ломоносова в г. Баку Проскуряковым Александром и Велиевым Али занял почетное третье место в конкурсе Milli Net 2014.<br />\nОтметим, что Studyprog – первая в Азербайджане система автоматического тестирования задач по олимпиадному программированию, численным методам и другим различным разделам математики. Целью создания данного проекта является помощь в обучении программированию школьникам и студентам. Проект пополняется базой учебных материалов и задач, которые помогут всем желающим освоить любой материал в данной области науки.<br />\nСайт функционирует на трех языках – азербайджанском, русском и английском. Посредством данной тестирующей системы были проведены контрольные по предмету методы оптимизации и чемпионат по программированию среди студентов Бакинского Филиала МГУ. В настоящее время в системе имеется возможность для проведения олимпиад по программированию среди школьников и студентов Азербайджана.', 0, 1, '2014-12-19 17:31:08', 1),
(29, 6, 1, 'ux-azerbaijan', 'UX Azerbaijan', '9-го февраля 2015-го года в офисе инновационного центра компании Azercell - "Барама", состоялось мероприятие, посвящнное понятию пользовательского опыта и удобства пользователей при использовании IT продуктов.', '9-го февраля 2015-го года в офисе инновационного центра компании Azercell - "Барама", состоялось мероприятие, посвящнное понятию пользовательского опыта и удобства пользователей при использовании IT продуктов. Мероприятие состояло из двух частей. В первой части мероприятия выступил представитель компании Keytorc Барыш Сарыалиоглу. В своей презентации он рассказал о различиях понятий UX (user experience) и UI (user interface), о поведении недовольных пользователей, критерий удобств и их аспектов и частых ошибках разработчиков продуктов.<br />\nВторую часть мероприятия провёл представитель компании Azercell Эмиль Исмаилханов, который рассказал о вредрении понятий UX в продукты компании Azercell.<br />\nВ конце мероприятия среди зрителей были розыграны призы - книги и билет на участие в конференции по UX в Стамбуле.', 0, 1, '2015-02-09 14:06:41', 1),
(30, 6, 1, 'азербайджан-и-сингапур-выбраны-для-проведения-ioi-в-2019-и-2020-годах', 'Азербайджан и Сингапур выбраны для проведения IOI в 2019 и 2020 годах', '<p>В 2019 и в 2020 годах Международная олимпиада по информатике (IOI) пройдет в Азербайджане и Сингапуре. Об этом корреспонденту МИА «Казинформ» сообщил президент IOI, профессор департамента информатики Нового Болгарского университета Крассимир Манев.</p>\n', '<p>В 2019 и в 2020 годах Международная олимпиада по информатике (IOI) пройдет в Азербайджане и Сингапуре. Об этом корреспонденту МИА «Казинформ» сообщил президент IOI, профессор департамента информатики Нового Болгарского университета Крассимир Манев.</p>\n\n\n<p>«Сегодня на совете руководителей были объявлены страны, принимающие у себя Международную олимпиаду по информатике. В 2019 хозяином соревнований станет Азербайджан. Но так как в этот раз было сильное желание Сингапура принимать у себя олимпиаду, то мы решили в этом году выбрать два государства. Таким образом, в 2020 году олимпиада будет проходить в Сингапуре», - сказал К.Манев.</p>\n\n<p>Напомним, что в этом году Казахстан впервые принимал у себя Международную олимпиаду по информатике, на которую приехали свыше 630 делегатов из 83 стран мира. По итогам двух дней соревнований лучшим стал школьник из Южной Кореи Джи Хак Юн, который набрал 600 баллов из 600 возможных. Казахстанская сборная завоевала три «серебра» и одну «бронзу».</p>\n\n<p>В 2016 году олимпиада впервые пройдет в столице Татарстана Казани на базе Казанского федерального университета. В 2017-ом олимпиаду примет у себя Иран, в 2018 - Япония.</p>\n', 0, 1, '2015-08-08 08:01:46', 1),
(31, 4, 2, 'it-was-opened-the-first-training-portal-in-azerbaijan-with-the-online-programming-problems-judging-system', 'It was opened the first training portal in Azerbaijan with the online programming problems judging system.', '<p>Today it has been opened the first training portal in Azerbaijan which would help schoolboys and students to get prepared to programming contests.&nbsp;</p>\n', '<p>Today it has been opened the first training portal in Azerbaijan which would help schoolboys and students to get prepared to programming contests.&nbsp;</p>\n\n\n<p>Testing system is in the beta-version release and is already available for checking your solutions. Task list will be topped up as soon as possible.</p>\n\n<p>We also want to add that this resource has three language packs: Russian, Azeri and English.&nbsp;</p>\n\n<p>This project was created by Ali Veliyev (4<sup>th</sup> year student in Baku branch of MSU named after M.V. Lomonosov) and Alexander Proskuryakov (1<sup>st</sup> year master in Baku branch of MSU named after M.V. Lomonosov). We are grateful to company "<a href="http://bitep.net">Bitep</a>"&nbsp;and intellectual club “<a href="http://qfotmat.net">QFormat</a>” for support. We are also grateful to students of Baku branch of MSU named after M.V. Lomonosov,&nbsp; Isayeva Sabina and Kamran Kazimi for interface translation into English and Azeri.</p>\n\n<p>The problems and lessons will be discussed on website of intellectual club of “<a href="http://qformat.net/blog/ocode/">QFormat</a>” community.</p>\n\n<p>We want to wish good luck to everyone who decided to start programming. We hope that our project will be very useful for you.</p>\n\n<p>You can follow StudyProg &nbsp;in FB , VK, Twitter.&nbsp;</p>\n', 0, 1, '2013-09-14 06:00:00', 1),
(32, 8, 3, 'alqoritmlerin-qurulushu-bairede-ve-meselelerin-helli-uchun-ne-bilmek-lazimdir', 'Alqoritmlərin quruluşu bairədə və məsələlərin həlli üçün nə bilmək lazımdır?', '<p>Bu gün dünyada proqramlaşdırma peşəsi ən gərəklilərindəndir.</p>\n\n<p>Bəs "proqramçı" deyəndə kim nəzərdə tutulur? Bütün gün mənasiz kod yazan adam? Və niyə mənasız? Bəlkə bir mənası var?</p>', '<p>Bu gün dünyada proqramlaşdırma peşəsi ən gərəklilərindəndir.</p>\n\n<p>Bəs "proqramçı" deyəndə kim nəzərdə tutulur? Bütün gün mənasiz kod yazan adam? Və niyə mənasız? Bəlkə bir mənası var?</p>\n\n<p>Əlbəttə, bu peşəyə ümumi tələb ilə yanaşı, bu həmdə alqoritmik zəka tələb edir.</p>\n\n<p>Bəs "alqoritm" nədir?</p>\n\n<p>Bu sualın cavabını, məsələn, Vikipediyada, tapa bilərsiniz.</p>\n<cut> <i>Bilmək lazımdır ki, proqramçı ilk növbədə alqoritmlər ilə işləyir. Bizim saytda "Kodlaşdırma" bölməsi var. Çox güman ki, saytımızın bu hissi "koder"lərə yardımcı olacaq. Adətən hazır alqoritmlərlə işləyənə "koder" deyirlər. Bizim resurs həm alqoritm hazırlayanlar, həm də "koder"lər üçündür.</i>\n\n<p>İndi alqoritmin hazırlanma prosesinə nəzər salaq.</p>\n\n<ul>\n	<li>Əvvəlcə qarşımıza qoyulan məqsədi diqqətlə incələmək lazımdır. Proqramın girişini və çıxışını bəlirləmək lazımdır.</li>\n	<li>Məsələnin həlli üçün alqoritmi birbaşa hazırlamaq lazımdır.</li>\n	<li>Həlli elə maksimal dərəcədə optimallaşdırmaq lazımdır ki, mümkün qədər az misal həll etsin. Sturtur məlumatlarının istifadə etdiyi yaddaşın həcmini minimallaşdırmaq lazımdır.</li>\n	<li>Bizə lazım olan alqoritmi əldə etdikdə, onu reallaşdırmaq lazımdır. Alqoritmi funksiyalar və prosedurların reallaşdırdıqı hissələrə maksimal dərəcədə çox hissələrə, bölünməmək dərəcəsinə çatana qədər, bölmək lazımdır. Bundan sonra əsas funksiyadan bu funksiyaların superpozisiyalarını yaratmaq lazımdır.</li>\n	<li>Hər funksiyanın öz alqoritmini yerinə yetirməsini diqqətlə yoxlayın.</li>\n</ul>\n\n<p>Bu qaydalardan istifadə etməklə istədiyiniz alqoritmin doğru reallaşdırılmasına vasitə olacaq. Amma əgər sizdə alınmasa, hara müraciət etmək lazımdır, bilirsiniz.</p>\n\n<p>Suallarınızı <a href="qformat.net">QFormat</a> intellektual qrupunda və ya bizim <a href="http://www.facebook.com/groups/studyprog/">facebook qrupumuzda</a> verə bilərsiniz. Gələn görüşlərə qədər.</p>\n\n<p>Tərcüməyə görə Səmədov Bəhruza təşəkkür bildiririk.</p>', 0, 1, '2014-07-04 03:28:43', 1),
(33, 8, 3, 'alqoritmlerin-murekkebliyi', 'Alqoritmlərin mürəkkəbliyi', '<p>Məsələnin şərtini garşımıza goyandan sonra bizim əsas məqsədımız bütün testlərə düzgün cavab verən, tələb olunan vaxt və yaddaş limitinə uyğun olan algoritmı tərtib etməkdir.</p>', '<p>Məsələnin şərtini garşımıza goyandan sonra bizim əsas məqsədımız bütün testlərə düzgün cavab verən, tələb olunan vaxt və yaddaş limitinə uyğun olan algoritmı tərtib etməkdir.</p>\n\n<p><strong><em>Tərif 1.</em></strong> Əgər əməliyyatı algoritmdə vahid addım kimi təsfir etmək olarsa onu elementar adlandırırlar. Məsələn: şərtin yoxlanması, məlumatın oxunması və s. elementar əməliyyatlardılar.</p>\n\n<p>Tutaq ki, <em><strong>f </strong></em>və <em><strong>g</strong></em> iki  (həqiqi ədədləri həqiqi ədədlərə əks etdirən) funksiyadır. Əgər <em><strong>f</strong></em> funksiyası <strong><em>g</em></strong> funksiyasından tez artmır, onda deyilir ki, <em><strong>f</strong></em> bərabərdir O(<em><strong>g</strong></em>).</p>\n\n<p>Tutaq ki, <em><strong>f </strong></em>və <em><strong>g</strong></em> iki  (həqiqi ədədləri həqiqi ədədlərə əks etdirən) funksiyadır. Əgər <em><strong>f</strong></em> funksiyası O(<strong><em>g</em></strong>) bərabərdir sə, onda deyilir ki, <em><strong>g</strong></em> bərabərdir &Omega;(<strong><em>f</em></strong>).</p>\n\n<p>Algoritmin müəyyən verilənlərı daxil etdikdən sonrakı işini eksperiment adlandırırıq. Eksperimentlərin sayı verilənərin sayənı artirdiqca sonsuzluğa yaxınlaşır.&nbsp;</p>\n\n<p>Tutaq ki, işləmə vaxtının ardıcıllığı həqiqi oxda olan <em><strong>f</strong></em> funksiyasını təyin edir. Deyilir li, algoritm O(<em><strong>g</strong></em>), zamanında işləyir, əgər elə <em><strong>g</strong></em> funksiyası mövcuddur ki, <em><strong>f</strong></em>  O(<em><strong>g</strong></em>)-di və istənilən digər <em><strong>h</strong></em> O(<strong><em>g</em></strong>) olaraq &Omega;(<em><strong>f</strong></em>)-ə bərabər deyil.&nbsp;</p>\n\n<p><strong><em>Tərif 2.</em></strong> Əgər algoritm verilənlərin sayı sonsuzluğa yaxınlaşdiqca O(<strong><em>f</em></strong>) elementar əməliyyat yerinə yetirir, onda <strong><em>f</em></strong> funksiyası algoritmin mürəkkəbliyi adlanır.</p>\n\n<p>Mühazirəni hazırladı: <a href="http://studyprog.com/ru/profile/show/?username=admin">Əli Vəliyev</a>.</p>\n\n<p>Mənbələr: <a href="http://www.wikipedia.org/">Vikipediya</a>, <a href="http://www.intuit.ru/">İnternet-Universitet &quot;İntuit&quot;</a>,&nbsp;Makkonel C. - Algoritm əsasları.</p>\n<p>Tərcümə - <a href="http://studyprog.com/ru/profile/show/?id=3">İsayeva Səbinə</a></p>', 0, 1, '2014-08-16 13:50:44', 1),
(34, 9, 3, 'ardicil-axtarish', 'Ardıcıl axtarış', '<p>Bütün sonrakı alqoritmlər növlərə ayırmaları üçün bir vəzifənin həllinə xidmət edir: Həmin növlərə ayırmaq massivi. Təlimlərdə "bu" mənada biz tam ədədlər dərk edəcəyik. Lakin gerçəkləşdirilməsi əlavə <b>int compare()</b> funksiyaları istifadə etməklə ümumi halda gedəcək.', '<p>Bütün sonrakı alqoritmlər növlərə ayırmaları üçün bir vəzifənin həllinə xidmət edir: Həmin növlərə ayırmaq massivi. Təlimlərdə "bu" mənada biz tam ədədlər dərk edəcəyik. Lakin gerçəkləşdirilməsi əlavə <b>int compare()</b> funksiyaları istifadə etməklə ümumi halda gedəcək. Belə olan halda biz nəinki artması qaydada, həm də убавания qaydada, habelə xüsusi meyara (məsələn müəyyən verib ki, sayı az olsa onun vahidlərinin sayı azdır, sayından asılı olmayaraq onlarla və digər kateqoriyaları) görə çeşidləmək bilərik. Ayrıca funksiyası da istifadə olunacaq - b-void swap () - / b- ilə paralel bir massivinin çeşidlənməsi, növlərə ayırmaq ikinci (məsələn, x координате üzrə nöqtələrinin koordinatlarının çeşidlənməsi) imkan verəcək. Halbuki bu, işin (əlavə funksiyaların dəfələrlə çağırış) sürəti azaldır, amma asan yadda alqoritm kömək edir və əgər lazımdırsa və kodu.</p>\n\n<p>Hər hansı verilmiş elementi tapmaq lüzumu ildə verilmiş siyahıda tez-tez yaranır. Bu заданый element məqsədli adlanır. Siyahı üzrə elementlərin gizlətməyə неотсортированным sayılır. Biz də bu növlərə ayırılmış siyahıda ardıcıl axtarışlar alqoritmdə barədə danışaq.</p>\n\n<p>Qoy bizim ardıcıllığı N elementləri də var. Alqoritm ideyası məqsədli ilə müqayisədə ardıcıl şəkildə yoxlamada elementlərinin və onların ibarətdir. Aydındır ki, N maksimum sayı müqayisə oluna bilər, çünki düz N müqayisə ən pis halda iki alqoritm (o ardıcıllıqla məqsədli element və ya məqsədli element son siyahıda yoxdur) tələb edir. Əgər müqayisə N daha çox olardı ki, bu bir elementdir, iştirak edən bir dəfədən artıq müqayisədə var idi. O fikirlərdə minimallığı əməliyyatlarının ən pis hal üçün ziddiyyət yaranır. İş vaxtı ardıcıl axtarış O (N), həm də müqayisəsi zamanı nəzərə alınır ki, hər tip məlumatların müqayisə üçün deyil bir əməliyyat (məsələn ayın 64#битные üçün maşına 32#битной) tələb edir.</p>\n\n<p>Следующие реализации обходят массив целых чисел, сравнивают каждый элемент с целевым элементов <b>target</b> и возвращают индекс элемента. Если целевой элемент не найден, то возвращается несуществующее значение индекса.</p>\n\n<p>Реализация последовательного поиска на Pascal:</p>\n\n<pre class="brush: pascal;">\nProgram Sequental_Search;\ntype intarray = array[1..100] of integer;\nvar \n    mas : intarray;\n    n, i, target : integer;\n\nfunction SequentalSearch(mas : intarray; n, target : integer ) : integer;\nvar\n    i : integer;\nbegin\n    SequentalSearch := 0;\n    for i := 1 to n do\n    if ( mas[i] = target ) then SequentalSearch := i;\nend;\n\nbegin\n    readln(n);\n    for i:=1 to n do\n    read(mas[i]);\n    read(target);\n    writeln(SequentalSearch(mas,n,target));\nend.\n</pre>\n\n<p>Реализация последовательного поиска на C:</p>\n\n<pre class="brush: c;">\n#include &lt;stdio.h&gt;\n#include &lt;stdlib.h&gt;\n\nint SequentalSearch( int*, int, int );\nint main(void) {\n    int *mas, n, i, target;\n    scanf( "%d", &amp;n );\n    mas = ( int* ) malloc(n * sizeof(int));\n    for ( i = 0; i &lt; n; i++ ) scanf( "%d", &amp;mas[i] );\n    scanf( "%d", &amp;target );\n    printf("%d\n", SequentalSearch(mas,n,target ) );\n    return 0;\n}\n\nint SequentalSearch( int *mas, int n, int target) {\n    int i;\n    for ( i = 0; i &lt; n; i++ ) {\n        if ( mas[i] == target ) return i;\n    }\n    return -1;\n}\n</pre>\n\n<p>Реализация последовательного поиска на C++:</p>\n\n<pre class="brush: cpp;">\n#include &lt;iostream&gt;\nusing namespace std;\n\nint SequentalSearch( int*, int, int );\nint main() {\n    int *mas, n, i, target;\n    cin &gt;&gt; n;\n    mas = new int[n];\n    for ( i = 0; i &lt; n; i++ ) cin &gt;&gt; mas[i];\n    cin &gt;&gt; target;\n    cout &lt;&lt; SequentalSearch(mas,n,target) &lt;&lt; endl;\n    return 0;\n}\n\nint SequentalSearch( int *mas, int n, int target) {\n    int i;\n    for ( i = 0; i &lt; n; i++ ) {\n        if ( mas[i]==target ) return i;\n    }\n    return -1;\n}\n</pre>\n\n<p>Реализация последовательного поиска на Java:</p>\n\n<pre class="brush: java;">\nimport java.io.*;\nimport java.util.*;\n \nclass SequentalSearch { \n    public static void main(String[] args) {  \n        Locale.setDefault(Locale.ENGLISH);\n        Scanner in = new Scanner(System.in);\n        PrintWriter out = new PrintWriter(System.out);   \n        int mas[], n, i, target;\n        n = in.nextInt();\n        mas = new int[n];\n        for ( i = 0; i &lt; n; i++ ) mas[i] = in.nextInt();\n        target = in.nextInt();\n        out.println( SequentalSearch(mas,n,target) );\n        out.flush();\n    }\n    public static int SequentalSearch( int mas[], int n, int target) {\n        int i;\n        for ( i = 0; i &lt; n; i++ ) {\n            if ( mas[i] == target ) return i;\n        }\n        return -1;\n    }\n}\n</pre>\n\n<p>Лекцию подготовили: <a href="[[constant name=portal_url]]users/show/?id=1">Али Велиев</a> и <a href="[[constant name=portal_url]]users/show/?id=2">Александр Проскуряков</a></p>\n\n<p>Реализации: С/С++/Java - <a href="[[constant name=portal_url]]users/show/?id=1">Али Велиев</a></p>\n\n<p>Pascal - <a href="[[constant name=portal_url]]users/show/?id=3">Сабина Исаева</a></p>\n', 0, 1, '2014-08-16 13:52:15', 1),
(35, 9, 3, 'binar-axtarish', 'Binar axtarış', '<p>Hesab edək ki bizə sıralanmış <b>N</b> ünsürdən ibarət olan siyahi verilib. Məqsədi ünsürü siyaxıda <b>i</b> göstəricisi ilə olan təsadüfi ünsür ilə müqaisə edək. Üc hala nəzər edək:</p>\n', '<p>Hesab edək ki bizə sıralanmış <b>N</b> ünsürdən ibarət olan siyahi verilib. Məqsədi ünsürü siyaxıda <b>i</b> göstəricisi ilə olan təsadüfi ünsür ilə müqaisə edək. Üc hala nəzər edək:</p>\n\n\n<ol>\n	<li>Məqsədi ünsür <b>i</b> göstəricisi olan ünsür ilə bərabərdi.</li>\n	<li>Məqsədi ünsür <b>i</b> göstəricisi olan ünsürdan böyükdür.</li>\n	<li>Məqsədi ünsür <b>i</b> göstəricisi olan ünsürdan kiçikdir.</li>\n</ol>\n\n<p>Siyahının siralanmış olduğuna əsasən 2-ci və 3-cü halda biz <b>[0,i]</b> və ya <b>[i,N-1]</b> kəsirində olan ünsürləri nəzərdən çixarıb, və həmən algoritmi siyahinin qalan hissəsinə rekursiv olaraq tətbiq edə bilərik. Alqoritmin optimallığını nəzərə alaraq siyahı bölünən zaman alınmış hissələrin ünsürlarının sayı təhminən eyni olmalıdır (ən çoxu 1 ünsür fərqlənə bilər). Beləliklə tez-tez <b>i</b> bərabər olunur <b>N/2</b>. Bu logorifmik axtarış murəkkəbliyini təmin edir, elə ki <b>N</b> həmişə bu şərtlərə cavab verir: <b>2<sup>K</sup> ≤ N &lt; 2<sup>K+1</sup></b>. Aydındı ki, <b>2<sup>K</sup></b> ünsürlü olan siyahıda ən çoxu <b>K+1</b> müqaisə apara bilərik. Burdan isə <b>N</b> ünsürlü siyahıda <b>log<sub>2</sub>N+1</b> müqaisə aparılır. Beləliklə binar axtarış algoritmin mürəkkəbliyi <b>O(log{N})</b>.</p>\n\n<p>Alqoritmi sadə anlamaq üçün bu funksiyanı daxil edək:</p>\n\n<p align="center"><img src="[[constant name=portal_url]]materials/algo/article/4_1.png" /></p>\n\n<p>Bu funksiya keçid düyməsi rolunu oynayır. <b>switch</b> komandasını istifadə edərək biz <b>compare(mas[middle],target)</b> funksiyasının nəticəsinə görə 3 haldan birinə baxa bilərik, burada <b>middle</b> - orta üstürünün göstəricisidi.</p>\n\n<p>Pascal dilində binar axtarışının həyata keçirilməsi:</p>\n\n<pre class="brush: pascal;">\nProgram Binary_Search;\ntype intarray = array[1..1000] of integer;\nvar    \n    mas : intarray;    \n    n, i, target : integer;\n\nfunction compare(x, y : integer) : integer;\nbegin    \n    if ( x &lt; y ) then compare := -1 \n    else if ( x = y ) then compare := 0 \n    else compare := 1;\nend;\n\nfunction BinarySearch(mas : intarray; n, target : integer ) : integer;\nvar    \n    start, finish, middle : integer;\nbegin    \n    start := 1;    \n    finish := n;    \n    while ( start &lt;= finish ) do    \n    begin        \n        middle := ( start + finish ) div 2;        \n        case (compare(mas[middle], target)) of            \n            -1 : start := middle + 1;            \n            0 : begin BinarySearch := middle; break; end;            \n            1 : finish := middle - 1;        \n        end;    \n    end;\nend;\n\nbegin    \n    readln(n);    \n    for i := 1 to n do    \n        read(mas[i]);    \n    readln(target);    \n    writeln(BinarySearch(mas, n,target) );\nend.\n</pre>\n\n<p>C dilində binar axtarışının həyata keçirilməsi:</p>\n\n<pre class="brush: c;">\n#include &lt;stdio.h&gt;\n#include &lt;stdlib.h&gt;\n\nint BinarySearch( int*, int, int );\nint compare ( int , int );\n\nint main(void) \n{    \n    int *mas, n, i, target;\n    scanf( "%d", &amp;n );    \n    mas = ( int* ) malloc(n * sizeof(int));    \n    for ( i = 0; i &lt; n; i++ ) scanf( "%d", &amp;mas[i] );    \n    scanf( "%d", &amp;target );    \n    printf("%d\\n", BinarySearch(mas,n,target ) );    \n    return 0;\n}\n\nint BinarySearch( int *mas, int n, int target ) \n{    \n    int start = 0, finish = n-1, middle;    \n    while ( start &lt;= finish ) \n    {       \n        middle = ( start + finish ) / 2;        \n		switch ( compare(mas[middle],target) ) \n        {            \n            case -1: start = middle + 1; break;            \n            case 0: return middle;            \n            case 1: finish = middle - 1; break;        \n        }    \n    }    \n    return -1;\n}\n\nint compare ( int x, int y ) \n{    \n    if ( x &lt; y ) return -1;    \n    if ( x == y ) return 0;    \n    return 1;\n}\n</pre>\n\n<p>C++ dilində binar axtarışının həyata keçirilməsi:</p>\n\n<pre class="brush: cpp;">\n#include &lt;iostream&gt;\nusing namespace std;\n\nint BinarySearch( int*, int, int );\nint compare ( int , int );\n\nint main() \n{    \n    int *mas, n, i, target;    \n    cin &gt;&gt; n;    \n    mas = new int[n];    \n    for ( i = 0; i &lt; n; i++ ) cin &gt;&gt; mas[i];    \n    cin &gt;&gt; target;   \n    cout &lt;&lt; BinarySearch(mas,n,target) &lt;&lt; endl;    \n    return 0;\n}\n\nint BinarySearch( int *mas, int n, int target ) \n{    \n    int start = 0, finish = n-1, middle;    \n    while ( start &lt;= finish ) \n    {        \n        middle = ( start + finish ) / 2;       \n        switch ( compare(mas[middle],target) ) \n        {            \n            case -1: start = middle + 1; break;            \n            case 0: return middle;            \n            case 1: finish = middle - 1; break;        \n        }    \n    }    \n    return -1;\n}\n\nint compare ( int x, int y ) \n{    \n    if ( x &lt; y ) return -1;    \n    if ( x == y ) return 0;    \n    return 1;\n}\n</pre>\n\n<p>Java dilində binar axtarışının həyata keçirilməsi:</p>\n\n<pre class="brush: java;">\nimport java.io.*;\nimport java.util.*;\n\nclass BinarySearch \n{     \n    public static void main(String[] args) \n    {          \n        Locale.setDefault(Locale.ENGLISH);\n        Scanner in = new Scanner(System.in);        \n        PrintWriter out = new PrintWriter(System.out);          \n        int mas[], n, i, target;        \n        n = in.nextInt();        \n        mas = new int[n];       \n        for ( i = 0; i &lt; n; i++ ) mas[i] = in.nextInt();        \n        target = in.nextInt();        \n        out.println( BinarySearch(mas,n,target) );        \n        out.flush();   \n    }   \n    public static int BinarySearch( int mas[], int n, int target ) \n    {	    \n        int start = 0, finish = n-1, middle;        \n        while ( start &lt;= finish ) \n        {            \n            middle = ( start + finish ) / 2;            \n            switch ( compare(mas[middle],target) ) \n            {                \n                case -1: start = middle + 1; break;                \n                case 0: return middle;                \n                case 1: finish = middle - 1; break;            \n            }        \n        }        \n        return -1;    \n    }    \n    public static int compare ( int x, int y ) \n    {        \n        if ( x &lt; y ) return -1;        \n        if ( x == y ) return 0;        \n        return 1;    \n    }\n}\n</pre>\n\n<p>Mühazirəni hazırlayanlar: <a href="[[constant name=portal_url]]users/show/?id=1">Əli Vəliyev</a> və <a href="[[constant name=portal_url]]users/show/?id=2">Aleksandr Proskuryakov</a></p>\n\n<p>Programların həyata keçirilməsi: С/С++/Java - <a href="[[constant name=portal_url]]users/show/?id=1">Əli Vəliyev</a></p>\n\n<p>Pascal - <a href="[[constant name=portal_url]]users/show/?id=3">İsayeva Səbinə</a></p>\n\n<p>Tərcümə: <a href="[[constant name=portal_url]]users/show/?id=1">Əli Vəliyev</a></p>\n', 0, 1, '2014-08-16 14:13:28', 1);
INSERT INTO `posts` (`id`, `category`, `language`, `name`, `title`, `short`, `content`, `cover`, `author`, `date`, `visibility`) VALUES
(36, 10, 3, 'girish-ve-graf-nezeriyyesi-esas-anlayishlar', 'Giriş və graf nəzəriyyəsi əsas anlayışlar', '<p>İnternetdə qraflar nəzəriyyəsi üzrə (görə) kitabların böyük miqdarı mövcuddur. Və əgər onların ümumi kəsişməsini götürməksə, ona bütün axan nəticələri yazıb qurtarmaqsa, onda o böyüyü yaratmaq olar, hansını ki, oxuyub hələ (daha) bir yığın sual (məsələ) qalacaq. Buna görə Sizə "Qraflar nəzəriyyəsi" üzrə (görə) kiçik kitabçadan kəsməni (kəsiyi) təqdim edirik. Biz nadir hallarda şəxsi müəllifliyin bu mövzusuna mühazirələri çıxardacağıq, çünki bunda heç bir məna görmürük. Axı hamı (hər şey) ki, biz Sizə çatdırmaq istəyirik, hörmətli oxucular, artıq başqa sözlə çox kitablarda təsvir edilmişdir. Bu mövzuya məsələlərin qərarı (həlli) üçün əvvəlcə zadəganlıq təyinlərin və xüsusiyyətlərin yetərli miqdarı lazımdır, və (amma) bizdən sonra alqoritmlərin özlərinin öyrənilməsinə keçəcəyik. Qrafların xüsusiyyətlərinin biliyi daha az əhəmiyyətli deyil, çünki bəzən məsələlər düşür (rast gəlir), harada sadəcə düsturdan istifadə etmək lazımdır, və (amma) dərinliyə qrafı keçməmək və ya ümumiyyətlə yaddaşda onu necəsə saxlamaq.</p>\n', '<p>İnternetdə qraflar nəzəriyyəsi üzrə (görə) kitabların böyük miqdarı mövcuddur. Və əgər onların ümumi kəsişməsini götürməksə, ona bütün axan nəticələri yazıb qurtarmaqsa, onda o böyüyü yaratmaq olar, hansını ki, oxuyub hələ (daha) bir yığın sual (məsələ) qalacaq. Buna görə Sizə "Qraflar nəzəriyyəsi" üzrə (görə) kiçik kitabçadan kəsməni (kəsiyi) təqdim edirik. Biz nadir hallarda şəxsi müəllifliyin bu mövzusuna mühazirələri çıxardacağıq, çünki bunda heç bir məna görmürük. Axı hamı (hər şey) ki, biz Sizə çatdırmaq istəyirik, hörmətli oxucular, artıq başqa sözlə çox kitablarda təsvir edilmişdir. Bu mövzuya məsələlərin qərarı (həlli) üçün əvvəlcə zadəganlıq təyinlərin və xüsusiyyətlərin yetərli miqdarı lazımdır, və (amma) bizdən sonra alqoritmlərin özlərinin öyrənilməsinə keçəcəyik. Qrafların xüsusiyyətlərinin biliyi daha az əhəmiyyətli deyil, çünki bəzən məsələlər düşür (rast gəlir), harada sadəcə düsturdan istifadə etmək lazımdır, və (amma) dərinliyə qrafı keçməmək və ya ümumiyyətlə yaddaşda onu necəsə saxlamaq.</p>\n\n\n<p>Biz hansısa bir konkret mühazirələrdə dayanmayacağıq, bir halda ki, (çünki,) necə artıq yuxarı, çox zaman bu müxtəlif dillərdə yazılmış eyni fikir deyilmişdi. Və ki, oxucu ifadənin eyni stilinə öyrəşməsin, biz müxtəlif mənbələrdən mühazirələri çıxardacağıq. Ancaq biz onlar belə tikməyə çalışacağıq ki, bu fərq heç vaxt özünü göstərməsin.</p>\n\n<h3>Bir az tarix və predmet haqqında...</h3>\n\n<p>Qraflar nəzəriyyəsi diskret riyaziyyatın bölmələrindən biridir, hansı ki, onların elementlərinin arasında verilmiş münasibətlərlə (əlaqələrlə) son və ya hesab çoxluqlarının xüsusiyyətlərini tədqiq edir. Obyektlərin öyrənilməsinə həndəsi yanaşma bu nəzəriyyənin xüsusiyyətidir.</p>\n\n<p>İlk dəfə "qraf" anlayışı macar riyaziyyatçısı Deneş Кëниг 1936-cı ildə daxil etdi. Ancaq qraflar nəzəriyyəsi üzrə (görə) birinci iş hələ (daha) 1736-cı ildə Leonard Eyler tərəfindən yazılmışdı, hansında ki, o "məsələni haqqında Кëнигсбергских körpülər" həll etdi. Bu məsələnin mahiyyəti növbətidən ibarətdir. Şəkildə. 1 şəhərin mərkəzi hissəsinin sxemi Кëнигсберг təqdim edilmişdir (təsəvvür edilmişdir) (hal-hazırda Kalininqrad), hansı ki, iki çayın qırağı, onda iki ada və yeddi birləşdirən onların körpüsü daxil edir (qoşur). Hamını (hər şeyi) qurunun dörd hissəsi keçmək tələb olunur, bir dəfə hər körpü üzrə (görə) keçib, və ilk nöqtəyə qayıtmaq. Sonra biz bu məsələnin qərarına (həllinə) baxacağıq.</p>\n\n<p align="center"><img src="/images/algo/5_1.png" /></p>\n\n<p>Müasir qraflar nəzəriyyəsi müxtəlif təbiətin obyektlərinin arasında müxtəlif sistemlərin və münasibətlərin (əlaqələrin) struktur xüsusiyyətlərinin modelləşdirilməsi üçün xüsusi (istisna) rahat aparatı verir. Buna görə o geniş istifadə olunur necə özündə riyaziyyata, həm də elmin, texnikanın və praktik fəaliyyətin ən müxtəlif sahələrində (ərazilərində) onun əlavələri (proqramları). Xüsusi halda, qraflar nəzəriyyəsi informatikada və proqramlaşdırmada öz tətbiqini tapır, kimyalar, iqtisadiyyata, logistikaya, rabitə və nəqliyyat sistemlərində, sxemotexnike.</p>\n\n<h3>Əsas anlayışlar və təyinlər</h3>\n\n<p>Пусть S &nbsp;– &nbsp;непустое &nbsp;конечное &nbsp;множество, &nbsp; V(2) &nbsp;– &nbsp;множество &nbsp; всех &nbsp;его двухэлементных&nbsp;подмножеств.</p>\n\n<p><em><strong>Определение &nbsp;1.1.</strong></em> &nbsp;Псевдографом &nbsp;(или просто графом) G &nbsp;называется &nbsp;пара множеств (S,U), где U -&nbsp;произвольное&nbsp;подмножество множества V(2) . При этом пишут G = (S,U).</p>\n\n<p><em><strong>Определение &nbsp;1.2.</strong></em> &nbsp;Пусть G &nbsp;= &nbsp;(S,U) &nbsp;– &nbsp;псевдограф. &nbsp;Элементы &nbsp;множества &nbsp;S называются вершинами&nbsp;графа G, а элементы множества &nbsp;U – его ребрами.&nbsp;</p>\n\n<p><em><strong>Определение 1.3.</strong></em> Граф G = (S,U) называется пустым&nbsp;или нуль-графом, если&nbsp;U = ∅.</p>\n\n<p><em><strong>Определение 1.4.</strong></em> Число вершин графа G = (S,U) называется его порядком.&nbsp;Если порядок графа равен n, то пишут |G| = n.</p>\n\n<p>Двухэлементное подмножество &nbsp;множества S (ребро), &nbsp;принадлежащее U и&nbsp;состоящее из элементов x и y будем&nbsp;обозначать через (x, y).&nbsp;В общем случае множество U может содержать пары с одинаковыми элементами вида (x, x) и одинаковые&nbsp;пары.</p>\n\n<p><em><strong>Определение 1.5.</strong></em> Ребра вида (x, x) называются петлями.</p>\n\n<p><em><strong>Определение 1.6.</strong></em> Одинаковые пары из множества U называются кратными&nbsp;(или параллельными) ребрами.</p>\n\n<p>Таким образом, псевдограф может содержать петли и кратные ребра. В этом смысле псевдографы еще&nbsp;называются графами с кратными ребрами и петлями.</p>\n\n<p><em><strong>Определение &nbsp;1.7.</strong></em> &nbsp;Псевдограф &nbsp;без &nbsp;петель &nbsp;называется &nbsp;мультиграфом &nbsp;(или графом с кратными&nbsp;ребрами).</p>\n\n<p><em><strong>Определение &nbsp; 1.8.</strong></em> &nbsp; Мультиграф &nbsp; без &nbsp;кратных &nbsp; ребер &nbsp;называется &nbsp;простым&nbsp;графом.</p>\n\n<p>Таким образом, простой граф не содержит петель и кратных ребер.</p>\n\n<p>Графы имеют наглядную &nbsp;графическую &nbsp;интерпретацию в виде диаграмм, состоящих из точек и линий,&nbsp;соединяющих &nbsp;некоторые из этих точек. Точки соответствуют вершинам графа, а линии &nbsp;– его ребрам.&nbsp;При этом форма и длина линий значения не имеют. Важно лишь, что две данные точки соединены или не&nbsp;соединены линией.</p>\n\n<p><span style="line-height:1.6em"><em><strong>Пример 1.1.</strong></em> Указать какие из графов, диаграммы которых изображены на&nbsp;</span><span style="line-height:1.6em">рис. 2 являются псевдографами, мультиграфами, простыми графами.</span></p>\n\n<p align="center"><img src="/images/algo/5_2.png" /></p>\n\n<p><em><strong>Решение.</strong></em> &nbsp; Все &nbsp;графы &nbsp; являются псевдографами, &nbsp; графы &nbsp; G1, &nbsp;G3, &nbsp;G4, &nbsp;G5 –&nbsp;мультиграфами, графы G1, G4, G5 &nbsp;-&nbsp;простыми графами. &nbsp;</p>\n\n<p><em><strong>Определение 1.9. </strong></em>&nbsp; &nbsp;Граф называется <strong>неориентированным</strong> (кратко &nbsp;–&nbsp;неорграфом), если пары в множестве U являются неупорядоченными.</p>\n\n<p>Если &nbsp;(x, y) &nbsp; – &nbsp; неупорядоченная &nbsp; пара, &nbsp; то &nbsp;ребро (x, y) называется&nbsp;неориентированным, а вершины x &nbsp;и y называются&nbsp;концами&nbsp;неориентированного ребра (x, y).</p>\n\n<p><em><strong>Определение 1.10.</strong></em> Граф называется <strong>ориентированным</strong> (кратко – орграфом),&nbsp;если пары в множестве U являются упорядоченными.</p>\n\n<p><em><strong>Определение 1.11.</strong></em>&nbsp;Ребра орграфа называются <strong>дугами</strong> (или&nbsp;ориентированными ребрами).</p>\n\n<p>Вершина x дуги (x, y) называется ее началом, &nbsp;а вершина y – ее концом. В&nbsp;этом случае говорят, что дуга (x, y) исходит из вершины x и входит в вершину y.&nbsp;На диаграммах орграфов направления дуг отмечаются стрелками, которые примыкают к их концам.</p>\n\n<p><em><strong>Замечание 1.1.</strong></em> Неориентированное ребро (x, y) равносильно двум&nbsp;противоположно направленным дугам (x, y) и (y, x). Поэтому неориентированный граф можно&nbsp;рассматривать как ориентированный граф, который вместе с каждой дугой (x, y) содержит и дугу (y, x)&nbsp;противоположного направления.</p>\n\n<p>Условимся вершины графа обозначать буквами x, y, z (без индексов или с индексами), а ребра и дуги –&nbsp;буквами v, u, w (без индексов или с индексами).&nbsp;Рассмотрим ряд понятий и определений для неориентированных &nbsp;и&nbsp;ориентированных графов. &nbsp;При этом, если не будет оговорено особо, те же понятия и определения&nbsp;переносятся без изменений на неориентированные &nbsp;и ориентированные псевдографы.</p>\n\n<p><em><strong>Определение 1.12.</strong></em> Два ребра графа называются <strong>смежными</strong>, если они имеют общий конец.</p>\n\n<p><em><strong>Определение 1.13.</strong></em> Вершина x и ребро u графа называются <strong>инцидентными</strong>,&nbsp;если x является концом ребра u, и неинцидентными в противном случае.</p>\n\n<p><em><strong>Определение 1.14.</strong></em> Две вершины графа называются <strong>смежными</strong>, если существует инцидентное им ребро.</p>\n\n<p><em><strong>Определение 1.15.</strong></em> Число ребер (дуг) графа (орграфа) G, инцидентных данной вершине x<sub>i</sub> называется&nbsp;<strong>степенью (валентностью) вершины</strong> x<sub>i</sub> и обозначается через deg (x<sub>i</sub>) (от англ. degree – степень).</p>\n\n<p><em><strong>Определение 1.16.</strong></em> Вершина графа называется <strong>изолированной</strong>, &nbsp;если ее степень&nbsp;равна нулю.</p>\n\n<p><em><strong>Определение 1.17.</strong></em> Вершина графа называется <strong>висячей</strong>, &nbsp;а если ее степень равна единице.</p>\n\n<p><em><strong>Замечание 1.2.</strong></em> В случае неориентированного псевдографа обычно считается, что вклад каждой петли,&nbsp;инцидентной некоторой вершине x, в ее степень P(x) равен 2, в то время как вклад любого другого&nbsp;ребра, инцидентного вершине x равен 1.</p>\n\n<p><em><strong>Определение 1.18.</strong></em> Полустепенью исхода (захода) вершины xi орграфа называется число deg<sup>+</sup>(x<sub>i</sub>) (deg<sup>–</sup>(x<sub>i</sub>)) его дуг, исходящих из вершины x<sub>i</sub> (заходящих в вершину x<sub>i</sub>).&nbsp;Для орграфа deg (x<sub>i</sub>) = deg<sup>+</sup>(x<sub>i</sub>) + deg<sup>–</sup>(x<sub>i</sub>).</p>\n\n<p><em><strong>Замечание 1.3.</strong></em> В случае ориентированного псевдографа вклад каждой петли,&nbsp;инцидентной некоторой вершине x, равен 1, как в deg<sup>+</sup>(x), так и в deg<sup>–</sup>(x).</p>\n\n<p><em><strong>Определение 1.19.</strong></em> Неориентированный простой граф, &nbsp;в котором любые две&nbsp;различные &nbsp;вершины &nbsp;смежны, называется&nbsp;<strong>полным</strong>. Полный граф &nbsp;порядка &nbsp;n&nbsp;обозначается через K<sub>n</sub>.</p>\n\n<p><em><strong>Определение &nbsp;1.20.</strong></em> &nbsp;Неориентированный &nbsp;граф &nbsp;называется &nbsp;<strong>двудольным</strong>, если&nbsp;существует такое разбиение множества его вершин &nbsp;на две части (доли), что концы каждого ребра&nbsp;принадлежат разным частям.</p>\n\n<p><em><strong>Определение 1.21.</strong></em> &nbsp;Двудольный граф, любые две вершины которого, входящие&nbsp;в разные доли смежны, &nbsp;называется <strong>полным двудольным</strong>. Полный двудольный граф, доли которого состоят&nbsp;из p и q вершин, обозначается символом K<sub>p,q</sub>.</p>\n\n<p>Mənbə: A.V. Çerednikova, İ.V. Zemlyakova, qraflar nəzəriyyəsinə Müqəddimə (Daxil etmə), Kostrama, KQTU, 2011</p>\n', 0, 1, '2014-08-16 14:15:11', 1),
(37, 8, 1, 'что-необходимо-знать-о-составлении-алгоритмов-для-решения-задач', 'Что необходимо знать о составлении алгоритмов для решения задач?', '<p>В современном мире профессия программиста является одной из востребованных.</p>\n\n<p><span style="line-height:1.6em">Но что же именно подразумевает это слово-«программист»? Человек, который целыми днями печатает &nbsp;бессмысленный машинный код? А почему, собственно, &nbsp;бессмысленный? Может он, все таки, что-то значит?&nbsp;</span></p>\n', '<p>В современном мире профессия программиста является одной из востребованных.</p>\n\n<p><span style="line-height:1.6em">Но что же именно подразумевает это слово-«программист»? Человек, который целыми днями печатает &nbsp;бессмысленный машинный код? А почему, собственно, &nbsp;бессмысленный? Может он, все таки, что-то значит?&nbsp;</span></p>\n\n<p><span style="line-height:1.6em">Конечно же, помимо широкой востребованности, это, еще и одна из самых трудоемких профессий, требующее алгоритмический склад ума.</span></p>\n\n<p><span style="line-height:1.6em">Что же такое «алгоритм»?</span></p>\n\n<p>Ответ на этот вопрос можно прочитать, например, в&nbsp;<a href="http://ru.wikipedia.org/wiki/%D0%90%D0%BB%D0%B3%D0%BE%D1%80%D0%B8%D1%82%D0%BC">Википедии</a>.</p>\n\n<blockquote>\n<p><em style="line-height:1.6em">Алгори́тм — набор инструкций, описывающих порядок действий исполнителя для достижения результата решения задачи за конечное число действий.</em></p>\n</blockquote>\n\n<p>&nbsp;Нет необходимости долго разбираться в статье, &nbsp;чтобы понять, что программист, в первую очередь, должен хорошо разбираться в алгоритмах. На нашем сайте присутствует раздел &nbsp;«<a href="http://studyprog.com/ru/code/show/">Кодинг</a>». По большей части, этот раздел будет в помощь, так называемым "кодерам". Кодером в народе принято называть того, кто реализует готовые алгоритмы. Наш ресурс полезен как для разработчиков алгоритмов, так и для кодеров.</p>\n\n<p><span style="line-height:1.6em">А теперь &nbsp;рассмотрим &nbsp;весь процесс грамотного составления алгоритма.</span></p>\n\n<ol>\n	<li>Внимательно изучить поставленную перед собой задачу. Обдумать, что должно подаваться на вход программы, и &nbsp;что она должна выводить.</li>\n	<li>Составить алгоритм решения задачи&nbsp; напрямую.</li>\n	<li>Максимально оптимизировать решение так, чтобы оно выполняло как можно меньше операций. Минимизировать объем памяти используемый структурами данных.</li>\n	<li>После того как мы получили необходимый алгоритм, время его реализовать. Необходимо разбить алгоритм на максимальное количество частей, реализуемые &nbsp;функциями или процедурами таким образом, что каждую подфункцию (подпроцедуру) уже невозможно было поделить на более мелкие.&nbsp;И уже из главной функции создавать суперпозиции этих функций.</li>\n	<li>&nbsp;Реализовать каждую функцию как отдельную программу. Тщательно проверьте, чтобы каждая функция выполняла предписанный ей алгоритм.</li>\n</ol>\n\n<p>Использование этих правил позволит вам грамотно реализовывать придуманный алгоритм.&nbsp;Ну, а если у вас что-то не получится, вы хорошо знаете, куда следует обращаться.</p>\n\n<p>Задавайте ваши вопросы на сайте интеллектуального сообщества&nbsp;<a href="http://qformat.net/blog/ocode/">QFormat</a>, а также в нашей группе на <a href="http://www.facebook.com/groups/studyprog/">Facebook</a>. До новых встреч, дорогие STUDYPROGраммисты!</p>', 0, 1, '2014-07-04 03:28:43', 1),
(38, 8, 1, 'сложности-алгоритмов', 'Сложности алгоритмов', '<p>Когда перед нами стоит условие задачи, наша главная цель придумать такой алгоритм, чтобы для входных данных из заданного диапазона программа выдавала верный ответ для всех тестов и укладывать в заданные лимиты времени и памяти.</p>', '<p>Когда перед нами стоит условие задачи, наша главная цель придумать такой алгоритм, чтобы для входных данных из заданного диапазона программа выдавала верный ответ для всех тестов и укладывать в заданные лимиты времени и памяти.</p>\n\n<p><strong><em>Определение 1.</em></strong> Операция называется элементарной, если в алгоритме её можно представить в виде некоторой единицы действия. Например: проверка условия, арифметическая операция, считывание данных и т.п. считаются элементарными операциями.</p>\n\n<p>Пусть <em><strong>f </strong></em>и <em><strong>g</strong></em> две функции (для простоты отображающие действительные числа в действительные). Говорят, что <em><strong>f</strong></em> является O(<em><strong>g</strong></em>) &nbsp;(читается &quot;о-большое от <em><strong>g</strong></em>&quot;), если функция <em><strong>f</strong></em> растёт не быстрее, чем функция <strong><em>g</em></strong>.</p>\n\n<p>Пусть <em><strong>f</strong></em> и <em><strong>g</strong></em> две функции (для простоты отображающие действительные числа в действительные). Говорят, что <em><strong>g</strong></em> является &Omega;(<strong><em>f</em></strong>) (читается &quot;омега-большое от <em><strong>f</strong></em>&quot;), если функция <em><strong>f</strong></em> есть O(<strong><em>g</em></strong>)</p>\n\n<p>Работу алгоритма при вводе конкретных входных данных назовём экспериментом. В основном полагается, что количество экспериментов стремится к бесконечности с ростом входных данных.&nbsp;</p>\n\n<p>Пусть последовательность результатов работы времени экстпериментов задаёт некоторую функцию <em><strong>f</strong></em> на вещественной оси. Будем говорить, что алгоритм работает за время O(<em><strong>g</strong></em>), если существует такая функция <em><strong>g</strong></em>, что <em><strong>f</strong></em> есть O(<em><strong>g</strong></em>) и любая другая функция <em><strong>h</strong></em> являющаяся O(<strong><em>g</em></strong>) не является &Omega;(<em><strong>f</strong></em>).&nbsp;</p>\n\n<p><strong><em>Определение 2.</em></strong> Сложностью алгоритма называется функция <strong><em>f</em></strong>, такая что алгоритм выполняет O(<strong><em>f</em></strong>) элементарных операций при стремлении входных данныъ к бесконечности.</p>\n\n<p>Лекцию подготовил: <a href="http://studyprog.com/ru/profile/show/?username=admin">Али Велиев</a>.</p>\n\n<p>Используемые источники: <a href="http://www.wikipedia.org/">Википедия</a>, <a href="http://www.intuit.ru/">Интернет-университет &quot;Интуит&quot;</a>,&nbsp;Макконнелл Дж. - Основы современных алгоритмов.</p>\n', 0, 1, '2014-08-16 13:50:44', 1),
(39, 9, 1, 'введение-в-раздел-и-последовательный-поиск', 'Введение в раздел и последовательный поиск', '<p>Все последующие алгоритмы сортировок служат для решения одной задачи: отсортировать массив данных. На обучении в смысле "данные" мы будем понимать целые числа. Однако реализация будет идти в общем случае с использованием дополнительной функции <b>int compare()</b>.', '<p>Все последующие алгоритмы сортировок служат для решения одной задачи: отсортировать массив данных. На обучении в смысле "данные" мы будем понимать целые числа. Однако реализация будет идти в общем случае с использованием дополнительной функции <b>int compare()</b>. В таком случае мы сможем сортировать не только в порядке возрастания, но и в порядке убавания, а также по специальному критерию (например дав определение, что число меньше если меньше число его единиц, независимо от числа десятков и других разрядов). Также будет использована отдельная функция <b>void swap()</b>, которая позволит параллельно с сортировкой одного массива сортировать второй (например, сортировка координат точек по координате x). Хотя это и уменьшает скорость работы (многократный вызов дополнительных функций), но помогает легче запомнить алгоритм и если нужно и код.</p>\n\n<p>Часто возникает надобность найти какой-либо заданный элемент в заданном списке. Этот заданый элемент называется целевым. Список элементов по умолчанию считается неотсортированным. Мы также поговорим об алгоритме последовательного поиска в отсортированном списке.</p>\n\n<p>Пусть у нас имеется последовательность из N элементов. Идея алгоритма состоит в последовательном обходе элементов и сравнении их с целевым. Очевидно, что максимальное число сравнений может быть N, так как два наихудших случая алгоритма (в последовательности нет целевого элемента или целевой элемент последний в списке) требует ровно N сравнений. Если бы сравнений было бы больше N, это значило бы что существует элемент, который участвовал в сравнении более одного раза. В соображениях минимальности операций для наихудшего случая возникает противоречие. Время работы последовательного поиска O(N), так как при сравнении также учитывается, что не всякий тип данных требует для сравнения одну операцию (например 64-битные числа на 32-битной машине).</p>\n\n<p>Следующие реализации обходят массив целых чисел, сравнивают каждый элемент с целевым элементов <b>target</b> и возвращают индекс элемента. Если целевой элемент не найден, то возвращается несуществующее значение индекса.</p>\n\n<p>Реализация последовательного поиска на Pascal:</p>\n\n<pre class="brush: pascal;">\nProgram Sequental_Search;\ntype intarray = array[1..100] of integer;\nvar \n    mas : intarray;\n    n, i, target : integer;\n\nfunction SequentalSearch(mas : intarray; n, target : integer ) : integer;\nvar\n    i : integer;\nbegin\n    SequentalSearch := 0;\n    for i := 1 to n do\n    if ( mas[i] = target ) then SequentalSearch := i;\nend;\n\nbegin\n    readln(n);\n    for i:=1 to n do\n    read(mas[i]);\n    read(target);\n    writeln(SequentalSearch(mas,n,target));\nend.\n</pre>\n\n<p>Реализация последовательного поиска на C:</p>\n\n<pre class="brush: c;">\n#include &lt;stdio.h&gt;\n#include &lt;stdlib.h&gt;\n\nint SequentalSearch( int*, int, int );\nint main(void) {\n    int *mas, n, i, target;\n    scanf( "%d", &amp;n );\n    mas = ( int* ) malloc(n * sizeof(int));\n    for ( i = 0; i &lt; n; i++ ) scanf( "%d", &amp;mas[i] );\n    scanf( "%d", &amp;target );\n    printf("%d\n", SequentalSearch(mas,n,target ) );\n    return 0;\n}\n\nint SequentalSearch( int *mas, int n, int target) {\n    int i;\n    for ( i = 0; i &lt; n; i++ ) {\n        if ( mas[i] == target ) return i;\n    }\n    return -1;\n}\n</pre>\n\n<p>Реализация последовательного поиска на C++:</p>\n\n<pre class="brush: cpp;">\n#include &lt;iostream&gt;\nusing namespace std;\n\nint SequentalSearch( int*, int, int );\nint main() {\n    int *mas, n, i, target;\n    cin &gt;&gt; n;\n    mas = new int[n];\n    for ( i = 0; i &lt; n; i++ ) cin &gt;&gt; mas[i];\n    cin &gt;&gt; target;\n    cout &lt;&lt; SequentalSearch(mas,n,target) &lt;&lt; endl;\n    return 0;\n}\n\nint SequentalSearch( int *mas, int n, int target) {\n    int i;\n    for ( i = 0; i &lt; n; i++ ) {\n        if ( mas[i]==target ) return i;\n    }\n    return -1;\n}\n</pre>\n\n<p>Реализация последовательного поиска на Java:</p>\n\n<pre class="brush: java;">\nimport java.io.*;\nimport java.util.*;\n \nclass SequentalSearch { \n    public static void main(String[] args) {  \n        Locale.setDefault(Locale.ENGLISH);\n        Scanner in = new Scanner(System.in);\n        PrintWriter out = new PrintWriter(System.out);   \n        int mas[], n, i, target;\n        n = in.nextInt();\n        mas = new int[n];\n        for ( i = 0; i &lt; n; i++ ) mas[i] = in.nextInt();\n        target = in.nextInt();\n        out.println( SequentalSearch(mas,n,target) );\n        out.flush();\n    }\n    public static int SequentalSearch( int mas[], int n, int target) {\n        int i;\n        for ( i = 0; i &lt; n; i++ ) {\n            if ( mas[i] == target ) return i;\n        }\n        return -1;\n    }\n}\n</pre>\n\n<p>Лекцию подготовили: <a href="[[constant name=portal_url]]users/show/?id=1">Али Велиев</a> и <a href="[[constant name=portal_url]]users/show/?id=2">Александр Проскуряков</a></p>\n\n<p>Реализации: С/С++/Java - <a href="[[constant name=portal_url]]users/show/?id=1">Али Велиев</a></p>\n\n<p>Pascal - <a href="[[constant name=portal_url]]users/show/?id=3">Сабина Исаева</a></p>\n', 0, 1, '2014-08-16 13:52:15', 1),
(40, 9, 1, 'двоичный-поиск', 'Двоичный поиск', '<p>Пусть нам задан отсортированный в порядке неубывания список из <b>N</b> элементов. Сравним целевой элемент со случайным элементом из списка с индексом <b>i</b>. Рассмотрим три случая:</p>\n', '<p>Пусть нам задан отсортированный в порядке неубывания список из <b>N</b> элементов. Сравним целевой элемент со случайным элементом из списка с индексом <b>i</b>. Рассмотрим три случая:</p>\n\n\n<ol>\n	<li>Целевой элемент равен <b>i</b>-тому элементу.</li>\n	<li>Целевой элемент больше <b>i</b>-того элемента.</li>\n	<li>Целевой элемент меньше <b>i</b>-того элемента.</li>\n</ol>\n\n<p>Тогда исходя из отсортированности списка во втором и третьих случаях мы можем отбросить все элементы из отрезка <b>[0,i]</b> и <b>[i,N-1]</b> соответственно, и применить данную операцию рекурсивно ко второй половине списка. Также из соображений оптимальности алгоритма отброшенная и рассматриваемая часть списка должна содержать приблизительно одинаковое количество элементов (максимум различаться на 1 элемент). Поэтому очень часто полагают <b>i</b> равным <b>N/2</b>. Это обеспечивает логарифмическую сложность поиска, так как любое число <b>N</b> будет удовлетворять следующим условиям: <b>2<sup>K</sup> ≤ N &lt; 2<sup>K+1</sup></b>. Очевидно, что для списка из <b>2<sup>K</sup></b> элементов нужно будет произвести максимум <b>K+1</b> сравнений. Отсюда получаем что для списка из <b>N</b> элементов надо будет производить <b>log<sub>2</sub>N+1</b> сравнений. Следовательно, сложность алгоритма бинарного поиска <b>O(log{N})</b>.</p>\n\n<p>Для упрощения понимания алгоритма определим функцию:</p>\n\n<p align="center"><img src="[[constant name=portal_url]]materials/algo/article/4_1.png" /></p>\n\n<p>Эта функция будет играть роль переключателя. Используя команду <b>switch</b> мы сможем сделать одно из трёх доступных действий по полученному результату выполнения функции <b>compare(mas[middle],target)</b>, где <b>middle</b> - индекс среднего элемента.</p>\n\n<p>Реализация двоичного поиска на Pascal:</p>\n\n<pre class="brush: pascal;">\nProgram Binary_Search;\ntype intarray = array[1..1000] of integer;\nvar    \n    mas : intarray;    \n    n, i, target : integer;\n\nfunction compare(x, y : integer) : integer;\nbegin    \n    if ( x &lt; y ) then compare := -1 \n    else if ( x = y ) then compare := 0 \n    else compare := 1;\nend;\n\nfunction BinarySearch(mas : intarray; n, target : integer ) : integer;\nvar    \n    start, finish, middle : integer;\nbegin    \n    start := 1;    \n    finish := n;    \n    while ( start &lt;= finish ) do    \n    begin        \n        middle := ( start + finish ) div 2;        \n        case (compare(mas[middle], target)) of            \n            -1 : start := middle + 1;            \n            0 : begin BinarySearch := middle; break; end;            \n            1 : finish := middle - 1;        \n        end;    \n    end;\nend;\n\nbegin    \n    readln(n);    \n    for i := 1 to n do    \n        read(mas[i]);    \n    readln(target);    \n    writeln(BinarySearch(mas, n,target) );\nend.\n</pre>\n\n<p>Реализация двоичного поиска на С:</p>\n\n<pre class="brush: c;">\n#include &lt;stdio.h&gt;\n#include &lt;stdlib.h&gt;\n\nint BinarySearch( int*, int, int );\nint compare ( int , int );\n\nint main(void) \n{    \n    int *mas, n, i, target;\n    scanf( "%d", &amp;n );    \n    mas = ( int* ) malloc(n * sizeof(int));    \n    for ( i = 0; i &lt; n; i++ ) scanf( "%d", &amp;mas[i] );    \n    scanf( "%d", &amp;target );    \n    printf("%d\\n", BinarySearch(mas,n,target ) );    \n    return 0;\n}\n\nint BinarySearch( int *mas, int n, int target ) \n{    \n    int start = 0, finish = n-1, middle;    \n    while ( start &lt;= finish ) \n    {       \n        middle = ( start + finish ) / 2;        \n		switch ( compare(mas[middle],target) ) \n        {            \n            case -1: start = middle + 1; break;            \n            case 0: return middle;            \n            case 1: finish = middle - 1; break;        \n        }    \n    }    \n    return -1;\n}\n\nint compare ( int x, int y ) \n{    \n    if ( x &lt; y ) return -1;    \n    if ( x == y ) return 0;    \n    return 1;\n}\n</pre>\n\n<p>Реализация двоичного поиска на С++:</p>\n\n<pre class="brush: cpp;">\n#include &lt;iostream&gt;\nusing namespace std;\n\nint BinarySearch( int*, int, int );\nint compare ( int , int );\n\nint main() \n{    \n    int *mas, n, i, target;    \n    cin &gt;&gt; n;    \n    mas = new int[n];    \n    for ( i = 0; i &lt; n; i++ ) cin &gt;&gt; mas[i];    \n    cin &gt;&gt; target;   \n    cout &lt;&lt; BinarySearch(mas,n,target) &lt;&lt; endl;    \n    return 0;\n}\n\nint BinarySearch( int *mas, int n, int target ) \n{    \n    int start = 0, finish = n-1, middle;    \n    while ( start &lt;= finish ) \n    {        \n        middle = ( start + finish ) / 2;       \n        switch ( compare(mas[middle],target) ) \n        {            \n            case -1: start = middle + 1; break;            \n            case 0: return middle;            \n            case 1: finish = middle - 1; break;        \n        }    \n    }    \n    return -1;\n}\n\nint compare ( int x, int y ) \n{    \n    if ( x &lt; y ) return -1;    \n    if ( x == y ) return 0;    \n    return 1;\n}\n</pre>\n\n<p>Реализация двоичного поиска на Java:</p>\n\n<pre class="brush: java;">\nimport java.io.*;\nimport java.util.*;\n\nclass BinarySearch \n{     \n    public static void main(String[] args) \n    {          \n        Locale.setDefault(Locale.ENGLISH);\n        Scanner in = new Scanner(System.in);        \n        PrintWriter out = new PrintWriter(System.out);          \n        int mas[], n, i, target;        \n        n = in.nextInt();        \n        mas = new int[n];       \n        for ( i = 0; i &lt; n; i++ ) mas[i] = in.nextInt();        \n        target = in.nextInt();        \n        out.println( BinarySearch(mas,n,target) );        \n        out.flush();   \n    }   \n    public static int BinarySearch( int mas[], int n, int target ) \n    {	    \n        int start = 0, finish = n-1, middle;        \n        while ( start &lt;= finish ) \n        {            \n            middle = ( start + finish ) / 2;            \n            switch ( compare(mas[middle],target) ) \n            {                \n                case -1: start = middle + 1; break;                \n                case 0: return middle;                \n                case 1: finish = middle - 1; break;            \n            }        \n        }        \n        return -1;    \n    }    \n    public static int compare ( int x, int y ) \n    {        \n        if ( x &lt; y ) return -1;        \n        if ( x == y ) return 0;        \n        return 1;    \n    }\n}\n</pre>\n\n<p>Лекцию подготовили: <a href="[[constant name=portal_url]]users/show/?id=1">Али Велиев</a> и <a href="[[constant name=portal_url]]users/show/?id=2">Александр Проскуряков</a></p>\n\n<p>Реализации: С/С++/Java - <a href="[[constant name=portal_url]]users/show/?id=1">Али Велиев</a></p>\n\n<p>Pascal - <a href="[[constant name=portal_url]]users/show/?id=3">Сабина Исаева</a></p>\n', 0, 1, '2014-08-16 14:13:28', 1),
(41, 10, 1, 'введение-и-основные-понятия-в-теории-графов', 'Введение и основные понятия в теории графов', '<p>В интернете существует огромное количество книг по теории графов. И если взять их общее пересечение, к нему дописать все вытекающие последствия, то можно создать огромный том, прочитав который останется ещё куча вопросов. Поэтому представляем Вам вырезку из небольшой книжки по "Теории графов". Мы редко будем выкладывать лекции на эту тему собственного авторства, так как не видим в этом никакого смысла. Ведь всё что мы хотим донести Вам, уважаемые читатели, уже другими словами описано во многих книгах. Для решения задач на эту тему изначально надо знать достаточное количество определений и свойств, а после мы перейдём к изучению самих алгоритмов. Знание свойств графов не менее важно, так как иногда попадаются задачи, где просто надо воспользоваться формулой, а не обходить граф в глубину или вообще сохранять его как-то в памяти.</p>\n', '<p>В интернете существует огромное количество книг по теории графов. И если взять их общее пересечение, к нему дописать все вытекающие последствия, то можно создать огромный том, прочитав который останется ещё куча вопросов. Поэтому представляем Вам вырезку из небольшой книжки по "Теории графов". Мы редко будем выкладывать лекции на эту тему собственного авторства, так как не видим в этом никакого смысла. Ведь всё что мы хотим донести Вам, уважаемые читатели, уже другими словами описано во многих книгах. Для решения задач на эту тему изначально надо знать достаточное количество определений и свойств, а после мы перейдём к изучению самих алгоритмов. Знание свойств графов не менее важно, так как иногда попадаются задачи, где просто надо воспользоваться формулой, а не обходить граф в глубину или вообще сохранять его как-то в памяти.</p>\n\n\n<p>Мы не будем останавливаться на каких-то конкретных лекциях, поскольку, как уже было сказано выше, в большинстве случаев это одна и та же мысль, написанная на разных языках. И чтобы читатель не привык к одному и тому же стилю изложения, мы будем выкладывать лекции из разных источников. Однако мы будем стараться их строить так, чтобы эта разница никак не показывала себя.</p>\n\n<h3>Немного истории и о предмете...</h3>\n\n<p>Теория графов является одним из разделов дискретной математики, который исследует свойства конечных или счетных множеств с заданными отношениями между их элементами. Особенностью этой теории является геометрический подход к изучению объектов.</p>\n\n<p>Впервые понятие «граф» ввел в 1936 году венгерский математик Денеш Кëниг. Однако первая работа по теории графов была написана еще в 1736 году Леонардом Эйлером, в которой он решил «задачу о Кëнигсбергских мостах». Суть этой задачи состоит в следующем. На рис. 1 представлена схема центральной части города Кëнигсберг (ныне Калининград), которая включает два берега реки, два острова в ней и семь соединяющих их мостов. Требуется обойти все четыре части суши, пройдя по каждому мосту один раз, и вернуться в исходную точку. Позже мы рассмотрим решение этой задачи.</p>\n\n<p align="center"><img src="/images/algo/5_1.png" /></p>\n\n<p>Современная теория графов даёт исключительно удобный аппарат для моделирования структурных свойств различных систем и отношений между объектами разной природы. Поэтому она широко используется как в самой математике, так и ее приложениях в самых разнообразных областях науки, техники и практической деятельности. В частности, теория графов находит свое применение в информатике и программировании, химии, экономике, логистике, в коммуникационных и транспортных системах, схемотехнике.</p>\n\n<h3>Основные понятия и определения</h3>\n\n<p>Пусть S &nbsp;– &nbsp;непустое &nbsp;конечное &nbsp;множество, &nbsp; V(2) &nbsp;– &nbsp;множество &nbsp; всех &nbsp;его двухэлементных&nbsp;подмножеств.</p>\n\n<p><em><strong>Определение &nbsp;1.1.</strong></em> &nbsp;Псевдографом &nbsp;(или просто графом) G &nbsp;называется &nbsp;пара множеств (S,U), где U -&nbsp;произвольное&nbsp;подмножество множества V(2) . При этом пишут G = (S,U).</p>\n\n<p><em><strong>Определение &nbsp;1.2.</strong></em> &nbsp;Пусть G &nbsp;= &nbsp;(S,U) &nbsp;– &nbsp;псевдограф. &nbsp;Элементы &nbsp;множества &nbsp;S называются вершинами&nbsp;графа G, а элементы множества &nbsp;U – его ребрами.&nbsp;</p>\n\n<p><em><strong>Определение 1.3.</strong></em> Граф G = (S,U) называется пустым&nbsp;или нуль-графом, если&nbsp;U = ∅.</p>\n\n<p><em><strong>Определение 1.4.</strong></em> Число вершин графа G = (S,U) называется его порядком.&nbsp;Если порядок графа равен n, то пишут |G| = n.</p>\n\n<p>Двухэлементное подмножество &nbsp;множества S (ребро), &nbsp;принадлежащее U и&nbsp;состоящее из элементов x и y будем&nbsp;обозначать через (x, y).&nbsp;В общем случае множество U может содержать пары с одинаковыми элементами вида (x, x) и одинаковые&nbsp;пары.</p>\n\n<p><em><strong>Определение 1.5.</strong></em> Ребра вида (x, x) называются петлями.</p>\n\n<p><em><strong>Определение 1.6.</strong></em> Одинаковые пары из множества U называются кратными&nbsp;(или параллельными) ребрами.</p>\n\n<p>Таким образом, псевдограф может содержать петли и кратные ребра. В этом смысле псевдографы еще&nbsp;называются графами с кратными ребрами и петлями.</p>\n\n<p><em><strong>Определение &nbsp;1.7.</strong></em> &nbsp;Псевдограф &nbsp;без &nbsp;петель &nbsp;называется &nbsp;мультиграфом &nbsp;(или графом с кратными&nbsp;ребрами).</p>\n\n<p><em><strong>Определение &nbsp; 1.8.</strong></em> &nbsp; Мультиграф &nbsp; без &nbsp;кратных &nbsp; ребер &nbsp;называется &nbsp;простым&nbsp;графом.</p>\n\n<p>Таким образом, простой граф не содержит петель и кратных ребер.</p>\n\n<p>Графы имеют наглядную &nbsp;графическую &nbsp;интерпретацию в виде диаграмм, состоящих из точек и линий,&nbsp;соединяющих &nbsp;некоторые из этих точек. Точки соответствуют вершинам графа, а линии &nbsp;– его ребрам.&nbsp;При этом форма и длина линий значения не имеют. Важно лишь, что две данные точки соединены или не&nbsp;соединены линией.</p>\n\n<p><span style="line-height:1.6em"><em><strong>Пример 1.1.</strong></em> Указать какие из графов, диаграммы которых изображены на&nbsp;</span><span style="line-height:1.6em">рис. 2 являются псевдографами, мультиграфами, простыми графами.</span></p>\n\n<p align="center"><img src="/images/algo/5_2.png" /></p>\n\n<p><em><strong>Решение.</strong></em> &nbsp; Все &nbsp;графы &nbsp; являются псевдографами, &nbsp; графы &nbsp; G1, &nbsp;G3, &nbsp;G4, &nbsp;G5 –&nbsp;мультиграфами, графы G1, G4, G5 &nbsp;-&nbsp;простыми графами. &nbsp;</p>\n\n<p><em><strong>Определение 1.9. </strong></em>&nbsp; &nbsp;Граф называется <strong>неориентированным</strong> (кратко &nbsp;–&nbsp;неорграфом), если пары в множестве U являются неупорядоченными.</p>\n\n<p>Если &nbsp;(x, y) &nbsp; – &nbsp; неупорядоченная &nbsp; пара, &nbsp; то &nbsp;ребро (x, y) называется&nbsp;неориентированным, а вершины x &nbsp;и y называются&nbsp;концами&nbsp;неориентированного ребра (x, y).</p>\n\n<p><em><strong>Определение 1.10.</strong></em> Граф называется <strong>ориентированным</strong> (кратко – орграфом),&nbsp;если пары в множестве U являются упорядоченными.</p>\n\n<p><em><strong>Определение 1.11.</strong></em>&nbsp;Ребра орграфа называются <strong>дугами</strong> (или&nbsp;ориентированными ребрами).</p>\n\n<p>Вершина x дуги (x, y) называется ее началом, &nbsp;а вершина y – ее концом. В&nbsp;этом случае говорят, что дуга (x, y) исходит из вершины x и входит в вершину y.&nbsp;На диаграммах орграфов направления дуг отмечаются стрелками, которые примыкают к их концам.</p>\n\n<p><em><strong>Замечание 1.1.</strong></em> Неориентированное ребро (x, y) равносильно двум&nbsp;противоположно направленным дугам (x, y) и (y, x). Поэтому неориентированный граф можно&nbsp;рассматривать как ориентированный граф, который вместе с каждой дугой (x, y) содержит и дугу (y, x)&nbsp;противоположного направления.</p>\n\n<p>Условимся вершины графа обозначать буквами x, y, z (без индексов или с индексами), а ребра и дуги –&nbsp;буквами v, u, w (без индексов или с индексами).&nbsp;Рассмотрим ряд понятий и определений для неориентированных &nbsp;и&nbsp;ориентированных графов. &nbsp;При этом, если не будет оговорено особо, те же понятия и определения&nbsp;переносятся без изменений на неориентированные &nbsp;и ориентированные псевдографы.</p>\n\n<p><em><strong>Определение 1.12.</strong></em> Два ребра графа называются <strong>смежными</strong>, если они имеют общий конец.</p>\n\n<p><em><strong>Определение 1.13.</strong></em> Вершина x и ребро u графа называются <strong>инцидентными</strong>,&nbsp;если x является концом ребра u, и неинцидентными в противном случае.</p>\n\n<p><em><strong>Определение 1.14.</strong></em> Две вершины графа называются <strong>смежными</strong>, если существует инцидентное им ребро.</p>\n\n<p><em><strong>Определение 1.15.</strong></em> Число ребер (дуг) графа (орграфа) G, инцидентных данной вершине x<sub>i</sub> называется&nbsp;<strong>степенью (валентностью) вершины</strong> x<sub>i</sub> и обозначается через deg (x<sub>i</sub>) (от англ. degree – степень).</p>\n\n<p><em><strong>Определение 1.16.</strong></em> Вершина графа называется <strong>изолированной</strong>, &nbsp;если ее степень&nbsp;равна нулю.</p>\n\n<p><em><strong>Определение 1.17.</strong></em> Вершина графа называется <strong>висячей</strong>, &nbsp;а если ее степень равна единице.</p>\n\n<p><em><strong>Замечание 1.2.</strong></em> В случае неориентированного псевдографа обычно считается, что вклад каждой петли,&nbsp;инцидентной некоторой вершине x, в ее степень P(x) равен 2, в то время как вклад любого другого&nbsp;ребра, инцидентного вершине x равен 1.</p>\n\n<p><em><strong>Определение 1.18.</strong></em> Полустепенью исхода (захода) вершины xi орграфа называется число deg<sup>+</sup>(x<sub>i</sub>) (deg<sup>–</sup>(x<sub>i</sub>)) его дуг, исходящих из вершины x<sub>i</sub> (заходящих в вершину x<sub>i</sub>).&nbsp;Для орграфа deg (x<sub>i</sub>) = deg<sup>+</sup>(x<sub>i</sub>) + deg<sup>–</sup>(x<sub>i</sub>).</p>\n\n<p><em><strong>Замечание 1.3.</strong></em> В случае ориентированного псевдографа вклад каждой петли,&nbsp;инцидентной некоторой вершине x, равен 1, как в deg<sup>+</sup>(x), так и в deg<sup>–</sup>(x).</p>\n\n<p><em><strong>Определение 1.19.</strong></em> Неориентированный простой граф, &nbsp;в котором любые две&nbsp;различные &nbsp;вершины &nbsp;смежны, называется&nbsp;<strong>полным</strong>. Полный граф &nbsp;порядка &nbsp;n&nbsp;обозначается через K<sub>n</sub>.</p>\n\n<p><em><strong>Определение &nbsp;1.20.</strong></em> &nbsp;Неориентированный &nbsp;граф &nbsp;называется &nbsp;<strong>двудольным</strong>, если&nbsp;существует такое разбиение множества его вершин &nbsp;на две части (доли), что концы каждого ребра&nbsp;принадлежат разным частям.</p>\n\n<p><em><strong>Определение 1.21.</strong></em> &nbsp;Двудольный граф, любые две вершины которого, входящие&nbsp;в разные доли смежны, &nbsp;называется <strong>полным двудольным</strong>. Полный двудольный граф, доли которого состоят&nbsp;из p и q вершин, обозначается символом K<sub>p,q</sub>.</p>\n\n<p>Источник: А.В. Чередникова, И.В. Землякова, Введение в теорию графов, Кострома, КГТУ, 2011</p>\n', 0, 1, '2014-08-16 14:15:11', 1),
(42, 8, 2, 'what-should-you-know-about-algorithms', 'What should you know about algorithms? ', '<p>The Programmers are very demanded in contemporary world. But what does this word mean? Is it a man who writes meaningless machine code all days long? And why do you think that it is meaningless? Maybe something hidden behind it? &nbsp;This profession is one of the hardest and demands the algorithmic thinking.</p>\n', '<p>The Programmers are very demanded in contemporary world. But what does this word mean? Is it a man who writes meaningless machine code all days long? And why do you think that it is meaningless? Maybe something hidden behind it? &nbsp;This profession is one of the hardest and demands the algorithmic thinking.</p>\n\n<p>But what is the algorithm?</p>\n\n<p>The answer to this question we can find in Wikipedia;</p>\n\n<blockquote>\n<p>Algorithm is finite lists of instructions for getting the result of problems.</p>\n</blockquote>\n\n<p>There is no need to read all this article elaborately to get that programmer must be able to understand and manipulate with algorithms. In out web-site we have “Coding” tab. Mainly this tab will be useful for coders. Coders are the people who are implementing complete algorithms. Our resource is useful both for algorithmers and coders.</p>\n\n<p>And now let’s look at the process of composing algorithms.</p>\n\n<ol>\n	<li>Read the conditions attentively and try to understand it. Think about task’s input and output.</li>\n	<li>Draw the straight algorithm.</li>\n	<li>Try to optimize it. Algorithm must implement less operations and structures must use as less memory as it is possible.</li>\n	<li>After getting the algorithm that will work under conditions that we have mentioned it’s time to implement it. Try to divide the algorithm into the maximum possible parts(functions and procedures). And then make their superposition.</li>\n	<li>Implement each function as individual program. Carefully check them.</li>\n</ol>\n\n<p>As you see using these rules will help you to implement invented algorithm correctly.&nbsp;</p>\n\n<p>And if something goes wrong you know where to go.</p>\n\n<p>Ask your questions in website of intellectual club “<a href="http://qformat.net/blog/ocode/">QFormat</a>” and also in our <a href="http://www.facebook.com/groups/studyprog/">FB group</a>. See you, dear STUDYPROGrammers.&nbsp;</p>\n', 0, 1, '2014-07-04 03:28:43', 1),
(43, 20, 2, 'lets-solve-e-olimp-начали-за-здравие-задачи-291-и-790-засчитаны-1', 'Let''s solve E-OLIMP - Начали за здравие [Задачи 291 и 790 засчитаны] #1', '<iframe allowfullscreen="" frameborder="0" height="auto" src="https://www.youtube.com/embed/9R64DPdj5no?rel=0" width="100%"></iframe>', '<iframe allowfullscreen="" frameborder="0" height="auto" src="https://www.youtube.com/embed/9R64DPdj5no?rel=0" width="100%"></iframe>', 0, 2, '2015-08-25 12:57:15', 1),
(44, 20, 2, 'lets-solve-e-olimp-рекурсия-и-строка-задачи-1211-и-1227-засчитаны-2', 'Let''s solve E-OLIMP - Рекурсия и строка [Задачи 1211 и 1227 засчитаны] #2', '<iframe width="100%" src="https://www.youtube.com/embed/Uol3kX48kr0?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/Uol3kX48kr0?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 13:25:39', 1),
(45, 20, 2, 'lets-solve-e-olimp-2-дня-угробил-задачи-1228-и-1868-засчитаны-3', 'Let''s solve E-OLIMP - 2 ДНЯ УГРОБИЛ!!! [Задачи 1228 и 1868 засчитаны] #3', '<iframe width="100%" src="https://www.youtube.com/embed/sfVPSoiE9ac?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/sfVPSoiE9ac?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 13:27:24', 1),
(46, 20, 2, 'lets-solve-e-olimp-сложно-в-учении-задачи-6130-424-497-и-1034-засчитаны-4', 'Let''s solve E-OLIMP - Сложно в учении [Задачи 6130, 424, 497 и 1034 засчитаны] #4', '<iframe width="100%" src="https://www.youtube.com/embed/xP7yE7kjJJU?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/xP7yE7kjJJU?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 17:15:29', 1),
(47, 20, 2, 'lets-solve-e-olimp-вне-соревнований-задачи-1226-7362-7363-и-7364-засчитаны-5', 'Let''s solve E-OLIMP - Вне соревнований!!! [Задачи 1226, 7362, 7363 и 7364 засчитаны] #5', '<iframe width="100%" src="https://www.youtube.com/embed/JKHk4PHde1A?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/JKHk4PHde1A?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 17:36:41', 1),
(48, 20, 2, 'lets-solve-e-olimp-дал-жару-задачи-7365-7366-7367-7668-и-7669-засчитаны-6', 'Let''s solve E-OLIMP - Дал жару [Задачи 7365, 7366, 7367, 7668 и 7669 засчитаны] #6', '<iframe width="100%" src="https://www.youtube.com/embed/C0fDuOtJTDQ?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/C0fDuOtJTDQ?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 17:54:31', 1),
(49, 20, 2, 'lets-solve-e-olimp-наименьшая-сумма-нок-задача-1246-засчитана-7', 'Let''s solve E-OLIMP - Наименьшая сумма НОК [Задача 1246 засчитана] #7', '<iframe width="100%" src="https://www.youtube.com/embed/Qd-jIqHMo5M?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/Qd-jIqHMo5M?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:39:58', 1),
(50, 20, 2, 'lets-solve-e-olimp-8', 'Let''s solve E-OLIMP #8', '<iframe width="100%" src="https://www.youtube.com/embed/cfr6rs-8T9o?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/cfr6rs-8T9o?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:51:20', 1),
(51, 20, 2, 'lets-solve-e-olimp-9', 'Let''s solve E-OLIMP #9', '<iframe width="100%" src="https://www.youtube.com/embed/leu73Jq7TfY?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/leu73Jq7TfY?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:52:32', 1),
(52, 20, 2, 'lets-solve-e-olimp-наименьшая-сумма-нок-разбор-засчитанных-задач-324-5491-и-1703-10', 'Let''s solve E-OLIMP - Наименьшая сумма НОК [Разбор засчитанных задач 324, 5491 и 1703] #10', '<iframe width="100%" src="https://www.youtube.com/embed/6yxPCtpkKKw?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/6yxPCtpkKKw?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:53:37', 1),
(53, 20, 2, 'lets-solve-e-olimp-11', 'Let''s solve E-OLIMP #11', '<iframe width="100%" src="https://www.youtube.com/embed/POQ3a4nwJQo?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/POQ3a4nwJQo?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:54:32', 1),
(54, 20, 2, 'lets-solve-e-olimp-12', 'Let''s solve E-OLIMP #12', '<iframe width="100%" src="https://www.youtube.com/embed/UyuNw20AzxU?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/UyuNw20AzxU?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 19:05:01', 1),
(55, 20, 2, 'lets-solve-e-olimp-13', 'Let''s solve E-OLIMP #13', '<iframe width="100%" src="https://www.youtube.com/embed/f8IX7YxSeWU?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/f8IX7YxSeWU?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 19:05:51', 1);
INSERT INTO `posts` (`id`, `category`, `language`, `name`, `title`, `short`, `content`, `cover`, `author`, `date`, `visibility`) VALUES
(56, 20, 2, 'lets-solve-e-olimp-14', 'Let''s solve E-OLIMP #14', '<iframe width="100%" src="https://www.youtube.com/embed/-umBVd9HWNU?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/-umBVd9HWNU?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 19:06:39', 1),
(57, 20, 2, 'lets-solve-e-olimp-неудачный-пилот-нового-сезона-задача-1796-засчитана-15', 'Let''s solve E-OLIMP - Неудачный пилот нового сезона [Задача 1796 засчитана] #15 ', '<iframe allowfullscreen="" frameborder="0" height="auto" src="https://www.youtube.com/embed/0oUTah4vM6A" width="100%"></iframe>', '<iframe allowfullscreen="" frameborder="0" height="auto" src="https://www.youtube.com/embed/0oUTah4vM6A" width="100%"></iframe>', 0, 2, '2015-09-30 13:22:45', 1),
(58, 20, 2, 'lets-solve-e-olimp-порисуем-разбор-задач-18-24-25-16', 'Let''s solve E-OLIMP - Порисуем? [Разбор задач 18, 24, 25] #16 ', '<iframe allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/32bLT67gBC0?rel=0" width="100%"></iframe>', '<iframe allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/32bLT67gBC0?rel=0" width="100%"></iframe>', 0, 2, '2015-10-09 18:38:14', 1),
(59, 20, 1, 'lets-solve-e-olimp-начали-за-здравие-задачи-291-и-790-засчитаны-1', 'Let''s solve E-OLIMP - Начали за здравие [Задачи 291 и 790 засчитаны] #1', '<iframe allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/9R64DPdj5no?rel=0" width="100%"></iframe>', '<iframe allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/9R64DPdj5no?rel=0" width="100%"></iframe>', 0, 2, '2015-08-25 12:57:15', 1),
(60, 20, 1, 'lets-solve-e-olimp-рекурсия-и-строка-задачи-1211-и-1227-засчитаны-2', 'Let''s solve E-OLIMP - Рекурсия и строка [Задачи 1211 и 1227 засчитаны] #2', '<iframe width="100%" src="https://www.youtube.com/embed/Uol3kX48kr0?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/Uol3kX48kr0?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 13:25:39', 1),
(61, 20, 1, 'lets-solve-e-olimp-2-дня-угробил-задачи-1228-и-1868-засчитаны-3', 'Let''s solve E-OLIMP - 2 ДНЯ УГРОБИЛ!!! [Задачи 1228 и 1868 засчитаны] #3', '<iframe width="100%" src="https://www.youtube.com/embed/sfVPSoiE9ac?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/sfVPSoiE9ac?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 13:27:24', 1),
(62, 20, 1, 'lets-solve-e-olimp-сложно-в-учении-задачи-6130-424-497-и-1034-засчитаны-4', 'Let''s solve E-OLIMP - Сложно в учении [Задачи 6130, 424, 497 и 1034 засчитаны] #4', '<iframe width="100%" src="https://www.youtube.com/embed/xP7yE7kjJJU?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/xP7yE7kjJJU?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 17:15:29', 1),
(63, 20, 1, 'lets-solve-e-olimp-вне-соревнований-задачи-1226-7362-7363-и-7364-засчитаны-5', 'Let''s solve E-OLIMP - Вне соревнований!!! [Задачи 1226, 7362, 7363 и 7364 засчитаны] #5', '<iframe width="100%" src="https://www.youtube.com/embed/JKHk4PHde1A?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/JKHk4PHde1A?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 17:36:41', 1),
(64, 20, 1, 'lets-solve-e-olimp-дал-жару-задачи-7365-7366-7367-7668-и-7669-засчитаны-6', 'Let''s solve E-OLIMP - Дал жару [Задачи 7365, 7366, 7367, 7668 и 7669 засчитаны] #6', '<iframe width="100%" src="https://www.youtube.com/embed/C0fDuOtJTDQ?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/C0fDuOtJTDQ?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 17:54:31', 1),
(65, 20, 1, 'lets-solve-e-olimp-наименьшая-сумма-нок-задача-1246-засчитана-7', 'Let''s solve E-OLIMP - Наименьшая сумма НОК [Задача 1246 засчитана] #7', '<iframe width="100%" src="https://www.youtube.com/embed/Qd-jIqHMo5M?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/Qd-jIqHMo5M?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:39:58', 1),
(66, 20, 1, 'lets-solve-e-olimp-8', 'Let''s solve E-OLIMP #8', '<iframe width="100%" src="https://www.youtube.com/embed/cfr6rs-8T9o?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/cfr6rs-8T9o?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:51:20', 1),
(67, 20, 1, 'lets-solve-e-olimp-9', 'Let''s solve E-OLIMP #9', '<iframe width="100%" src="https://www.youtube.com/embed/leu73Jq7TfY?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/leu73Jq7TfY?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:52:32', 1),
(68, 20, 1, 'lets-solve-e-olimp-наименьшая-сумма-нок-разбор-засчитанных-задач-324-5491-и-1703-10', 'Let''s solve E-OLIMP - Наименьшая сумма НОК [Разбор засчитанных задач 324, 5491 и 1703] #10', '<iframe width="100%" src="https://www.youtube.com/embed/6yxPCtpkKKw?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/6yxPCtpkKKw?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:53:37', 1),
(69, 20, 1, 'lets-solve-e-olimp-11', 'Let''s solve E-OLIMP #11', '<iframe width="100%" src="https://www.youtube.com/embed/POQ3a4nwJQo?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/POQ3a4nwJQo?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:54:32', 1),
(70, 20, 1, 'lets-solve-e-olimp-12', 'Let''s solve E-OLIMP #12', '<iframe width="100%" src="https://www.youtube.com/embed/UyuNw20AzxU?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/UyuNw20AzxU?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 19:05:01', 1),
(71, 20, 1, 'lets-solve-e-olimp-13', 'Let''s solve E-OLIMP #13', '<iframe width="100%" src="https://www.youtube.com/embed/f8IX7YxSeWU?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/f8IX7YxSeWU?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 19:05:51', 1),
(72, 20, 1, 'lets-solve-e-olimp-14', 'Let''s solve E-OLIMP #14', '<iframe width="100%" src="https://www.youtube.com/embed/-umBVd9HWNU?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/-umBVd9HWNU?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 19:06:39', 1),
(73, 20, 1, 'lets-solve-e-olimp-неудачный-пилот-нового-сезона-задача-1796-засчитана-15', 'Let''s solve E-OLIMP - Неудачный пилот нового сезона [Задача 1796 засчитана] #15 ', '<iframe allowfullscreen="" frameborder="0" height="auto" src="https://www.youtube.com/embed/0oUTah4vM6A" width="100%"></iframe>', '<iframe allowfullscreen="" frameborder="0" height="auto" src="https://www.youtube.com/embed/0oUTah4vM6A" width="100%"></iframe>', 0, 2, '2015-09-30 13:22:45', 1),
(74, 20, 1, 'lets-solve-e-olimp-порисуем-разбор-задач-18-24-25-16', 'Let''s solve E-OLIMP - Порисуем? [Разбор задач 18, 24, 25] #16 ', '<iframe allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/32bLT67gBC0?rel=0" width="100%"></iframe>', '<iframe allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/32bLT67gBC0?rel=0" width="100%"></iframe>', 0, 2, '2015-10-09 18:38:14', 1),
(75, 20, 3, 'lets-solve-e-olimp-начали-за-здравие-задачи-291-и-790-засчитаны-1', 'Let''s solve E-OLIMP - Начали за здравие [Задачи 291 и 790 засчитаны] #1', '<iframe allowfullscreen="" frameborder="0" height="auto" src="https://www.youtube.com/embed/9R64DPdj5no?rel=0" width="100%"></iframe>', '<iframe allowfullscreen="" frameborder="0" height="auto" src="https://www.youtube.com/embed/9R64DPdj5no?rel=0" width="100%"></iframe>', 0, 2, '2015-08-25 12:57:15', 1),
(76, 20, 3, 'lets-solve-e-olimp-рекурсия-и-строка-задачи-1211-и-1227-засчитаны-2', 'Let''s solve E-OLIMP - Рекурсия и строка [Задачи 1211 и 1227 засчитаны] #2', '<iframe width="100%" src="https://www.youtube.com/embed/Uol3kX48kr0?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/Uol3kX48kr0?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 13:25:39', 1),
(77, 20, 3, 'lets-solve-e-olimp-2-дня-угробил-задачи-1228-и-1868-засчитаны-3', 'Let''s solve E-OLIMP - 2 ДНЯ УГРОБИЛ!!! [Задачи 1228 и 1868 засчитаны] #3', '<iframe width="100%" src="https://www.youtube.com/embed/sfVPSoiE9ac?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/sfVPSoiE9ac?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 13:27:24', 1),
(78, 20, 3, 'lets-solve-e-olimp-сложно-в-учении-задачи-6130-424-497-и-1034-засчитаны-4', 'Let''s solve E-OLIMP - Сложно в учении [Задачи 6130, 424, 497 и 1034 засчитаны] #4', '<iframe width="100%" src="https://www.youtube.com/embed/xP7yE7kjJJU?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/xP7yE7kjJJU?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 17:15:29', 1),
(79, 20, 3, 'lets-solve-e-olimp-вне-соревнований-задачи-1226-7362-7363-и-7364-засчитаны-5', 'Let''s solve E-OLIMP - Вне соревнований!!! [Задачи 1226, 7362, 7363 и 7364 засчитаны] #5', '<iframe width="100%" src="https://www.youtube.com/embed/JKHk4PHde1A?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/JKHk4PHde1A?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 17:36:41', 1),
(80, 20, 3, 'lets-solve-e-olimp-дал-жару-задачи-7365-7366-7367-7668-и-7669-засчитаны-6', 'Let''s solve E-OLIMP - Дал жару [Задачи 7365, 7366, 7367, 7668 и 7669 засчитаны] #6', '<iframe width="100%" src="https://www.youtube.com/embed/C0fDuOtJTDQ?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/C0fDuOtJTDQ?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 17:54:31', 1),
(81, 20, 3, 'lets-solve-e-olimp-наименьшая-сумма-нок-задача-1246-засчитана-7', 'Let''s solve E-OLIMP - Наименьшая сумма НОК [Задача 1246 засчитана] #7', '<iframe width="100%" src="https://www.youtube.com/embed/Qd-jIqHMo5M?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/Qd-jIqHMo5M?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:39:58', 1),
(82, 20, 3, 'lets-solve-e-olimp-8', 'Let''s solve E-OLIMP #8', '<iframe width="100%" src="https://www.youtube.com/embed/cfr6rs-8T9o?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/cfr6rs-8T9o?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:51:20', 1),
(83, 20, 3, 'lets-solve-e-olimp-9', 'Let''s solve E-OLIMP #9', '<iframe width="100%" src="https://www.youtube.com/embed/leu73Jq7TfY?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/leu73Jq7TfY?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:52:32', 1),
(84, 20, 3, 'lets-solve-e-olimp-наименьшая-сумма-нок-разбор-засчитанных-задач-324-5491-и-1703-10', 'Let''s solve E-OLIMP - Наименьшая сумма НОК [Разбор засчитанных задач 324, 5491 и 1703] #10', '<iframe width="100%" src="https://www.youtube.com/embed/6yxPCtpkKKw?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/6yxPCtpkKKw?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:53:37', 1),
(85, 20, 3, 'lets-solve-e-olimp-11', 'Let''s solve E-OLIMP #11', '<iframe width="100%" src="https://www.youtube.com/embed/POQ3a4nwJQo?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/POQ3a4nwJQo?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 18:54:32', 1),
(86, 20, 3, 'lets-solve-e-olimp-12', 'Let''s solve E-OLIMP #12', '<iframe width="100%" src="https://www.youtube.com/embed/UyuNw20AzxU?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/UyuNw20AzxU?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 19:05:01', 1),
(87, 20, 3, 'lets-solve-e-olimp-13', 'Let''s solve E-OLIMP #13', '<iframe width="100%" src="https://www.youtube.com/embed/f8IX7YxSeWU?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/f8IX7YxSeWU?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 19:05:51', 1),
(88, 20, 3, 'lets-solve-e-olimp-14', 'Let''s solve E-OLIMP #14', '<iframe width="100%" src="https://www.youtube.com/embed/-umBVd9HWNU?rel=0" frameborder="0" allowfullscreen></iframe>', '<iframe width="100%" src="https://www.youtube.com/embed/-umBVd9HWNU?rel=0" frameborder="0" allowfullscreen></iframe>', 0, 2, '2015-08-25 19:06:39', 1),
(89, 20, 3, 'lets-solve-e-olimp-неудачный-пилот-нового-сезона-задача-1796-засчитана-15', 'Let''s solve E-OLIMP - Неудачный пилот нового сезона [Задача 1796 засчитана] #15 ', '<iframe allowfullscreen="" frameborder="0" height="auto" src="https://www.youtube.com/embed/0oUTah4vM6A" width="100%"></iframe>', '<iframe allowfullscreen="" frameborder="0" height="auto" src="https://www.youtube.com/embed/0oUTah4vM6A" width="100%"></iframe>', 0, 2, '2015-09-30 13:22:45', 1),
(90, 20, 3, 'lets-solve-e-olimp-порисуем-разбор-задач-18-24-25-16', 'Let''s solve E-OLIMP - Порисуем? [Разбор задач 18, 24, 25] #16 ', '<iframe allowfullscreen="" frameborder="0" height="auto" src="https://www.youtube.com/embed/32bLT67gBC0?rel=0" width="100%"></iframe>', '<iframe allowfullscreen="" frameborder="0" height="auto" src="https://www.youtube.com/embed/32bLT67gBC0?rel=0" width="100%"></iframe>', 0, 2, '2015-10-09 18:38:14', 1),
(91, 22, 1, 'как-программировать-на-с-дейтел-харви-дейтел-пол', 'Как программировать на С (Дейтел Харви, Дейтел Пол)', '<p>Книга рассчитана как для начинающих, так и на опытных программистов. Особое внимание уделяется методикам структурного и объектно-ориентированного программирования больших программных систем. Примеры и многочисленные упражнения знакомят читателя с часто применяемыми алгоритмами и фундаментальными структурами данных. Книга адресована широкому кругу читателей, от новичков до студентов, изучающих программирование в рамках своей специальности.</p>', '<p>Книга рассчитана как для начинающих, так и на опытных программистов. Особое внимание уделяется методикам структурного и объектно-ориентированного программирования больших программных систем. Примеры и многочисленные упражнения знакомят читателя с часто применяемыми алгоритмами и фундаментальными структурами данных. Книга адресована широкому кругу читателей, от новичков до студентов, изучающих программирование в рамках своей специальности.</p>', 0, 2, '2015-08-20 19:33:47', 1),
(92, 23, 1, 'c++-для-чайников-стефан-р-дэвис', 'C++ для чайников (Стефан Р. Дэвис)', '<p>Данная книга не требует от читателя никаких знаний в области программирования. В ней вы найдёте всю необходимую для изучения С++ информацию, описанную доступным языком. Прочитав эту книгу вы сможете самостоятельно написать на С++ программу и самое главное понимать как она работает. Книга, которая у вас в руках, — это введение в язык программирования C++. Она начинается с азов: от читателя не требуется каких-либо знаний в области программирования (и в этом основное отличие от предыдущего издания, которое предполагает знание языка С).</p>\r\n<p>В отличие от других книг по программированию на C++, в этой книге вопрос «почему» считается не менее важным, чем вопрос «как». И потому перед изложением конкретных особенностей языка C++ автор старался объяснить читателю, как они действуют в целом. Ведь каждая структурная особенность языка — это отдельный штрих единой картины.</p>', '<p>Данная книга не требует от читателя никаких знаний в области программирования. В ней вы найдёте всю необходимую для изучения С++ информацию, описанную доступным языком. Прочитав эту книгу вы сможете самостоятельно написать на С++ программу и самое главное понимать как она работает. Книга, которая у вас в руках, — это введение в язык программирования C++. Она начинается с азов: от читателя не требуется каких-либо знаний в области программирования (и в этом основное отличие от предыдущего издания, которое предполагает знание языка С).</p>\r\n<p>В отличие от других книг по программированию на C++, в этой книге вопрос «почему» считается не менее важным, чем вопрос «как». И потому перед изложением конкретных особенностей языка C++ автор старался объяснить читателю, как они действуют в целом. Ведь каждая структурная особенность языка — это отдельный штрих единой картины.</p>', 0, 2, '2015-08-21 09:48:16', 1),
(93, 23, 1, 'самоучитель-c++-герберт-шилдт', 'Самоучитель C++ (Герберт Шилдт)', '<p>Книга по одному из самых популярных языков объектно-ориентированного программирования C++.</p>\r\n\r\n<p>Эта книга уникальна тем, что автор дает описание языка C++ в соответствии с новым стандартом этого языка (Standard C++), предложенным комитетом ANSI/ICO.</p>\r\n', '<p>Книга по одному из самых популярных языков объектно-ориентированного программирования C++.</p>\r\n\r\n<p>Эта книга уникальна тем, что автор дает описание языка C++ в соответствии с новым стандартом этого языка (Standard C++), предложенным комитетом ANSI/ICO.</p>\r\n\r\n\r\n<p>В книге последовательно излагаются следующие темы:</p>\r\n\r\n<ul>\r\n	<li>Аспекты объектно-ориентированного программирования</li>\r\n	<li>Принципиальные отличия между C и C++</li>\r\n	<li>Создание классов</li>\r\n	<li>Конструкторы и деструкторы</li>\r\n	<li>Массивы, указатели и ссылки</li>\r\n	<li>Перегрузка операторов и функций</li>\r\n	<li>Наследование классов</li>\r\n	<li>Система ввода/вывода языка C++</li>\r\n	<li>Виртуальные функции</li>\r\n	<li>Шаблоны</li>\r\n	<li>Обработка исключительных ситуаций</li>\r\n	<li>Динамическая идентификация и приведение типов</li>\r\n	<li>Пространства имен</li>\r\n	<li>Библиотека стандартных шаблонов (STL)</li>\r\n	<li>И многое другое</li>\r\n</ul>\r\n\r\n<p>В книге содержиться большое количество примеров программ с подробными комментариями, пояснениями и ценными советами.</p>\r\n\r\n<p>Книга рассчитана на широкий круг читателей и подойдет как начинающим программистам, желающим освоить C++, так и опытным профессионалам, которые смогут узнать из книги о новых возможностях C++.</p>\r\n', 0, 2, '2015-08-23 11:50:26', 1),
(94, 23, 1, 'c++-освой-на-примерах-максим-динман', 'C++. Освой на примерах (Максим Динман)', '<p>\r\n  Подробно и доступно на занимательных примерах рассмотрены синтаксис, семантика и техника программирования на языке С++. Описаны все этапы проектирования программ, приведены подробные комментарии программного кода, проанализированы результаты вычислений, показаны типичные проблемы и пути их решения. Большое внимание уделяется алгоритмам и примерам решения задач при помощи графов, а также алгоритмам шифрования. Каждая глава содержит упражнения для самостоятельной работы.\r\n</p>', '<p>\r\n  Подробно и доступно на занимательных примерах рассмотрены синтаксис, семантика и техника программирования на языке С++. Описаны все этапы проектирования программ, приведены подробные комментарии программного кода, проанализированы результаты вычислений, показаны типичные проблемы и пути их решения. Большое внимание уделяется алгоритмам и примерам решения задач при помощи графов, а также алгоритмам шифрования. Каждая глава содержит упражнения для самостоятельной работы.\r\n</p>', 0, 2, '2015-08-24 13:43:55', 1),
(95, 23, 1, 'абстракция-данных-и-решение-задач-на-c++-стены-и-зеркала-каррано-фм-причард-дж', 'Абстракция данных и решение задач на C++. Стены и зеркала (Каррано Ф.М., Причард Дж.)', '<p>Книга представляет собой классический учебник для высшей школы, содержащий глубокое изложение вопросов, связанных с абстракцией и структурами данных, а также их реализацией на языке C++. Помимо предоставления прочных основ методов абстракции данных, в ней особо подчеркивается различие между спецификацией и реализацией, что является принципиально важным в объектно-ориентированном подходе. В книге подробно обсуждаются ключевые понятия объектно-ориентированного профаммирования, включая инкапсуляцию, наследование и полиморфизм, однако в центре внимания всегда находится именно абстракция данных, а не синтаксические конструкции языка C++. Книга будет полезна всем, кто заинтересован в глубоком изучении важнейших аспектов ООП и полном освоении соответствующих возможностей языка C++.</p>\r\n', '<p>Книга представляет собой классический учебник для высшей школы, содержащий глубокое изложение вопросов, связанных с абстракцией и структурами данных, а также их реализацией на языке C++. Помимо предоставления прочных основ методов абстракции данных, в ней особо подчеркивается различие между спецификацией и реализацией, что является принципиально важным в объектно-ориентированном подходе. В книге подробно обсуждаются ключевые понятия объектно-ориентированного профаммирования, включая инкапсуляцию, наследование и полиморфизм, однако в центре внимания всегда находится именно абстракция данных, а не синтаксические конструкции языка C++. Книга будет полезна всем, кто заинтересован в глубоком изучении важнейших аспектов ООП и полном освоении соответствующих возможностей языка C++.</p>\r\n', 0, 2, '2015-08-26 09:19:53', 1),
(96, 23, 1, 'c++-экспресс-курс-лаптев-вв', 'C++. Экспресс-курс. (Лаптев В.В.)', '<p>Настоящее издание является руководством по программированию на С++, позволяющее быстро освоиться в данном алгоритмическом языке. Прикладное пособие включает в себя как необходимый теоретический материал, так и реализации задуманных программ в виде листингов, поясняющих рисунков, таблиц. Каждый желающий сможет ознакомиться с принципами перехода от формального словесного описания задачи к описанию, понятному для ПК и позволяющего решить ее за короткое время. Начиная с изучения простых основ языка читатель постепенно осваивает все более сложные конструкции, учится сам использовать богатый арсенал С++. Приводятся примеры не только работающих, отлаженных программ, но и наиболее вероятные ошибки, возникающие в процессе их написания и не всегда распознаваемые компилятором. Рассматриваемые встроенные функции, библиотеки дают возможность значительно сократить программный код при правильном подключении уже готовых функций, макросов.</p>\r\n', '<p>Настоящее издание является руководством по программированию на С++, позволяющее быстро освоиться в данном алгоритмическом языке. Прикладное пособие включает в себя как необходимый теоретический материал, так и реализации задуманных программ в виде листингов, поясняющих рисунков, таблиц. Каждый желающий сможет ознакомиться с принципами перехода от формального словесного описания задачи к описанию, понятному для ПК и позволяющего решить ее за короткое время. Начиная с изучения простых основ языка читатель постепенно осваивает все более сложные конструкции, учится сам использовать богатый арсенал С++. Приводятся примеры не только работающих, отлаженных программ, но и наиболее вероятные ошибки, возникающие в процессе их написания и не всегда распознаваемые компилятором. Рассматриваемые встроенные функции, библиотеки дают возможность значительно сократить программный код при правильном подключении уже готовых функций, макросов.</p>\r\n', 0, 2, '2015-08-26 09:44:07', 1),
(97, 23, 1, 'библиотека-программиста-джефф-элджер', 'Библиотека программиста (Джефф Элджер)', '<p>C++ - это гибкий, но в тоже время достаточно сложный язык. На полное изучение C++ могут уйти многие годы, тем более, что книг именно для опытных разработчиков C++ практически нет. Джеф Элджер решил заполнить данную пустошь. Из его книги можно узнать о нетривиальных возможностях одного из самых гениальных объектно-ориентированных языков. Автор рассказывает в своей книге о тонкостях программирования на C++, о специфических проблемах, возникающих при разработке программных систем, и способах их решения.</p>\r\n', '<p>C++ - это гибкий, но в тоже время достаточно сложный язык. На полное изучение C++ могут уйти многие годы, тем более, что книг именно для опытных разработчиков C++ практически нет. Джеф Элджер решил заполнить данную пустошь. Из его книги можно узнать о нетривиальных возможностях одного из самых гениальных объектно-ориентированных языков. Автор рассказывает в своей книге о тонкостях программирования на C++, о специфических проблемах, возникающих при разработке программных систем, и способах их решения.</p>\r\n', 0, 2, '2015-08-30 15:38:16', 1),
(98, 23, 1, 'современное-проектирование-на-с++-андрей-александреску', 'Современное проектирование на С++ (Андрей Александреску)', '<p>Книга представляет читателям современный подход в проектировании программных систем на языке C++.</p>\r\n\r\n<p>Автор рассказывает в своей книге о том, что такое обобщенное программирование, как создавать программные системы, используя обобщенные компоненты.</p>\r\n', '<p>Книга представляет читателям современный подход в проектировании программных систем на языке C++.</p>\r\n\r\n<p>Автор рассказывает в своей книге о том, что такое обобщенное программирование, как создавать программные системы, используя обобщенные компоненты.</p>\r\n\r\n\r\n<p>Из книги читатель узнает о том:</p>\r\n\r\n<ul>\r\n	<li>Какие существуют методы создания обобщенных компонент</li>\r\n	<li>В чем состоят особенности обобщенного программирования на языке C++</li>\r\n	<li>С какими типичными проблемами при проектировании сталкиваются программисты и как они решаются</li>\r\n	<li>Какие мощные структуры можно использовать для манипуляции типами</li>\r\n	<li>При помощи какие средств можно создавать более гибкие шаблоны</li>\r\n	<li>Какой вспомогательный инструмент используется для распределения памяти небольших объектов</li>\r\n</ul>\r\n\r\n<p>Также читатель познакомится с примерами реализации многих обобщенных компонент.</p>\r\n\r\n<p>Книга станет ценным советчиком для профессиональных разработчиков, желающих узнать новые тенденции в проектировании программных систем, а также для тех, кто не желает слишком много времени тратить на создание архитектуры системы,и хочет использовать уже готовые решения.</p>\r\n', 0, 2, '2015-09-08 06:36:48', 1),
(99, 23, 1, 'стандарты-программирования-на-с++-герб-саттер-андрей-александреску', 'Стандарты программирования на С++ (Герб Саттер, Андрей Александреску)', '<p>Книга «Стандарты программирования на С++» &nbsp;Герб Саттера и Андрея Александреску поможет новичку стать профессионалом, так как в ней представлен сконцентрированный лучший опыт программистов на C++, обобщенный двумя экспертами мирового класса.</p>\r\n', '<p>Книга «Стандарты программирования на С++» &nbsp;Герб Саттера и Андрея Александреску поможет новичку стать профессионалом, так как в ней представлен сконцентрированный лучший опыт программистов на C++, обобщенный двумя экспертами мирового класса.</p>\r\n\r\n\r\n<p>Начинающий программист найдет в книге «Стандарты программирования на С++» простые и понятные рекомендации для ежедневного использования, подкрепленные примерами их конкретного применения на практике. Опытные программисты найдут в ней советы и новые рекомендации, которые можно сразу же принять на вооружение. Программисты-профессионалы могут использовать эту книгу как основу для разработки собственных стандартов кодирования, как для себя лично, так и для группы, которой они руководят.</p>\r\n\r\n<p>Конечно, книга «Стандарты программирования на С++» рассчитана в первую очередь на профессиональных программистов с глубокими знаниями языка, однако она будет полезна любому, кто захочет углубить свои знания в данной области.</p>\r\n', 0, 2, '2015-09-08 06:43:45', 1),
(100, 23, 1, 'stl-для-программистов-на-c++-леен-аммерааль', 'STL для программистов на C++ (Леен Аммерааль)', '<p>В книге автор рассказывает о том, как быстро научиться эффективно использовать библиотеку шаблонов STL.</p>\r\n\r\n<p>Библиотека шаблонов STL (Standard Template Library) – это мощный интрумент, позволяющий создавать надежные, более универсальные и переносимые программы. Любой уважающий себя программист C++ знаком с STL.</p>\r\n', '<p>В книге автор рассказывает о том, как быстро научиться эффективно использовать библиотеку шаблонов STL.</p>\r\n\r\n<p>Библиотека шаблонов STL (Standard Template Library) – это мощный интрумент, позволяющий создавать надежные, более универсальные и переносимые программы. Любой уважающий себя программист C++ знаком с STL.</p>\r\n\r\n\r\n<p>В книге читатель узнает, об основных понятиях STL: списках, контейнерах, итераторах, алгоритмах и функциональных объектах, а также о тонкостях и специальных возможностях библиотеки шаблонов.</p>\r\n\r\n<p>Отдельный раздел книги посвящен классу string.</p>\r\n\r\n<p>Материалы книги содержат множество примеров с комментариями и подробными объяснениями.</p>\r\n\r\n<p>Книга расчитана на профессиональных разработчиков, которые уже знакомы с языком C++.</p>\r\n', 0, 2, '2015-09-08 06:48:39', 1),
(101, 24, 1, 'изучаем-html-xhtml-и-css-фримен-эрик-фримен-элизабет', 'Изучаем HTML, XHTML и CSS (Фримен Эрик, Фримен Элизабет)', '<p>Устали от чтения таких книг по HTML, которые понятны только специалистам в этой области? Тогда самое время взять в руки наше издание.Хотите изучить НТМL так, чтобы уметь создавать web- страницы, о которых вы всегда мечтали? Так, чтобы более эффективно общаться с друзьямн, семьей и привередливыми клиентами? Хотите действительно обслуживать и улучшать НТМL-страннцы по про­ шествии времени, чтобы они работали во всех браузерах и мобильных устройствах? Тогда эта книга для вас. Прочитав ее, вы узнаете все секреты создания веб-страниц.</p>\r\n', '<p>Устали от чтения таких книг по HTML, которые понятны только специалистам в этой области? Тогда самое время взять в руки наше издание.Хотите изучить НТМL так, чтобы уметь создавать web- страницы, о которых вы всегда мечтали? Так, чтобы более эффективно общаться с друзьямн, семьей и привередливыми клиентами? Хотите действительно обслуживать и улучшать НТМL-страннцы по про­ шествии времени, чтобы они работали во всех браузерах и мобильных устройствах? Тогда эта книга для вас. Прочитав ее, вы узнаете все секреты создания веб-страниц.</p>\r\n\r\n\r\n<p>Благодаря ей вам больше не придется думать, какие цвета нужно использовать. чтобы они сочета­лись между собой, как правильно применять шрифты, чтобы они не «плавали» по экрану н верно отобра­жались в различных браузерах. Вы узнаете, как работают профессионалы, чтобы получить внзуа.1ьно при­влекательный дизайн, и как максимально эффективно использовать HTML, CSS и ХНТЧL. чтобы созда­вать такие веб-страницы, мимо которых не пройдет ни один пользователь.</p>\r\n\r\n<p>Права на издание nолучены no соглашению с O`Reilly. Все nрава защищены. Никакая часть данной книги не может быть восnроизведена в какой бы то ни было фор­ме без nисьменного разрешения владельцев авторских nрав. Информация, содержащаяся в данной книге, nолучена из источников, рассматриваемых издательством как на­ дежные. Тем не менее, имея в виду возможные человеческие или технические ошибки, издательство не может гарантировать абсолютную точность и nолноту nриводимых сведений и не несет ответственности за возмож­ные ошибки, связанные с исnользованием книги.</p>\r\n', 0, 2, '2015-09-09 13:15:17', 1),
(102, 25, 1, 'изучаем-sql-линн-бейли', 'Изучаем SQL (Линн Бейли)', '<p>В современном мире наивысшую ценность имеет информация, но не менее важно уметь этой информацией управлять. Эта книга посвящена языку запросов SQL и управлению базами данных. Материал излагается, начиная с описания базовых запросов и заканчивая сложными манипуляциями с помощью объединений, подзапросов и транзакций. Если вы пытаетесь разобраться в организации и управлении базами данных – эта книга будет отличным практическим пособием и предоставит вам все необходимые инструменты. Особенностью данного издания является уникальный способ подачи материала, выделяющий серию «Head First» издательства O’Reilly в ряду множества скучных книг, посвященных программированию.</p>\r\n', '<p>В современном мире наивысшую ценность имеет информация, но не менее важно уметь этой информацией управлять. Эта книга посвящена языку запросов SQL и управлению базами данных. Материал излагается, начиная с описания базовых запросов и заканчивая сложными манипуляциями с помощью объединений, подзапросов и транзакций. Если вы пытаетесь разобраться в организации и управлении базами данных – эта книга будет отличным практическим пособием и предоставит вам все необходимые инструменты. Особенностью данного издания является уникальный способ подачи материала, выделяющий серию «Head First» издательства O’Reilly в ряду множества скучных книг, посвященных программированию.</p>\r\n', 0, 2, '2015-09-09 13:22:34', 1),
(103, 24, 1, 'php-и-mysql-исчерпывающее-руководство-бретт-маклафлин', 'PHP и MySQL. Исчерпывающее руководство (Бретт Маклафлин)', '<p>Если у вас есть опыт разработки сайтов с помощью CSS и JavaScript, то эта книга переведет вас на новый уровень веб-разработки — создание динамических веб-сайтов на основе PHP и MySQL. С по- мощью практических примеров в книге вы узнаете все возможности серверного программирования. Вы прочитаете, как выстраивать базу данных, управлять контентом и обмениваться информацией с пользователями, применяя запросы и веб-формы.</p>\r\n', '<p>Если у вас есть опыт разработки сайтов с помощью CSS и JavaScript, то эта книга переведет вас на новый уровень веб-разработки — создание динамических веб-сайтов на основе PHP и MySQL. С по- мощью практических примеров в книге вы узнаете все возможности серверного программирования. Вы прочитаете, как выстраивать базу данных, управлять контентом и обмениваться информацией с пользователями, применяя запросы и веб-формы.</p>\r\n\r\n\r\n<ul>\r\n	<li>Написание PHP-скриптов и создание веб-форм.</li>\r\n	<li>Синтаксис PHP и SQL.</li>\r\n	<li>Создание и управление базой данных.</li>\r\n	<li>Создание динамических веб-страниц, которые изменяются при каждом новом просмотре.</li>\r\n	<li>Разработка шаблонов страниц об ошибках, которые будут выводиться пользователям.</li>\r\n	<li>Использование файловой системы для доступа к данным пользователя, включая иллюстрации и двоичные файлы.</li>\r\n	<li>Создание административной страницы для управления сайтом.</li>\r\n</ul>\r\n', 0, 2, '2015-09-09 13:31:32', 1),
(104, 24, 1, 'html5-разработка-приложений-для-мобильных-устройств-эстель-вейл', 'HTML5. Разработка приложений для мобильных устройств (Эстель Вейл)', '<p>Создавайте сногсшибательные сайты и приложения для любых мобильных и настольных платформ. Для этого вам потребуется всего лишь добавить в ваш инструментарий веб-разработки технологии HTML5 и CSS3. Вооружившись этой практичной книгой, вы научитесь разрабатывать веб-приложения, которые не только хорошо работают на iOS, Android, Blackberry и Windows Phone, но и очень удобны в использовании. Книга содержит множество примеров кода и разметки. Она поможет вам освоить работу с разнообразными инструментами HTML5 — в частности, с новыми веб-формами, масштабируемой векторной графикой (SVG), холстом (Canvas), localStorage и другими родственными API. Кроме того, в этом издании подробно рассмотрены таблицы стилей CSS3. Вы научитесь разрабатывать приложения, которые одинаково хорошо работают как на огромных мониторах, так и на крошечных экранах.</p>\r\n', '<p>Создавайте сногсшибательные сайты и приложения для любых мобильных и настольных платформ. Для этого вам потребуется всего лишь добавить в ваш инструментарий веб-разработки технологии HTML5 и CSS3. Вооружившись этой практичной книгой, вы научитесь разрабатывать веб-приложения, которые не только хорошо работают на iOS, Android, Blackberry и Windows Phone, но и очень удобны в использовании. Книга содержит множество примеров кода и разметки. Она поможет вам освоить работу с разнообразными инструментами HTML5 — в частности, с новыми веб-формами, масштабируемой векторной графикой (SVG), холстом (Canvas), localStorage и другими родственными API. Кроме того, в этом издании подробно рассмотрены таблицы стилей CSS3. Вы научитесь разрабатывать приложения, которые одинаково хорошо работают как на огромных мониторах, так и на крошечных экранах.</p>\r\n', 0, 2, '2015-09-09 13:34:59', 1),
(105, 24, 1, 'разработка-веб-сайтов-для-мобильных-устройств-лиза-гарднер-джейсон-григсби', 'Разработка веб-сайтов для мобильных устройств (Лиза Гарднер, Джейсон Григсби)', '<p>Разработка приложений для мобильных устройств - это новый прорыв в веб-разработке. Скоро пользоваться Интернетом будут чаще с помощью мобильных телефонов и планшетов, чем персональных компьютеров. Ваш бизнес нуждается в мобильной стратегии, но вы не знаете с чего начать? Из этой книги вы узнаете, как использовать уже знакомые веб-технологии для разработки приложений, сайтов, которые будут работать на любом устройстве. Используйте навыки HTML, JavaScript и CSS для создания и оптимизации сайтов для конкретных моделей мобильных устройств.</p>\r\n', '<p>Разработка приложений для мобильных устройств - это новый прорыв в веб-разработке. Скоро пользоваться Интернетом будут чаще с помощью мобильных телефонов и планшетов, чем персональных компьютеров. Ваш бизнес нуждается в мобильной стратегии, но вы не знаете с чего начать? Из этой книги вы узнаете, как использовать уже знакомые веб-технологии для разработки приложений, сайтов, которые будут работать на любом устройстве. Используйте навыки HTML, JavaScript и CSS для создания и оптимизации сайтов для конкретных моделей мобильных устройств.</p>\r\n', 0, 2, '2015-09-09 13:37:04', 1),
(106, 22, 1, 'изучаем-программирование-на-c-дэвид-гриффитс-дон-гриффитс', 'Изучаем программирование на C (Дэвид Гриффитс, Дон Гриффитс)', '<p>Вы всегда мечтали о том, чтобы найти более легкий способ изучения программирования на С? "Изучаем C" предлагает методику, с помощью которой вы научитесь создавать программы на этом языке. В книге используется уникальных подход, который выходит за рамки синтаксиса и пошаговых руководств и поможет вам стать отличным программистом. Вы изучите ключевые моменты, в том числе основы языка, динамическое управление памятью, указатели и арифметические операции с ними. А благодаря более продвинутым темам, таким как многопоточность и сетевое программирование, "Изучаем C" может рассматриваться в качестве учебника для студентов. Практические задания помогут усовершенствовать ваши способности, проверить приобретенные вами навыки и сделать вас более уверенным в себе.</p>\r\n', '<p>Вы всегда мечтали о том, чтобы найти более легкий способ изучения программирования на С? "Изучаем C" предлагает методику, с помощью которой вы научитесь создавать программы на этом языке. В книге используется уникальных подход, который выходит за рамки синтаксиса и пошаговых руководств и поможет вам стать отличным программистом. Вы изучите ключевые моменты, в том числе основы языка, динамическое управление памятью, указатели и арифметические операции с ними. А благодаря более продвинутым темам, таким как многопоточность и сетевое программирование, "Изучаем C" может рассматриваться в качестве учебника для студентов. Практические задания помогут усовершенствовать ваши способности, проверить приобретенные вами навыки и сделать вас более уверенным в себе.</p>\r\n', 0, 2, '2015-09-09 13:39:09', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `posts_additional_fields`
--

CREATE TABLE IF NOT EXISTS `posts_additional_fields` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `select_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts_additional_fields`
--

INSERT INTO `posts_additional_fields` (`id`, `name`, `category`, `type`, `select_id`, `title`) VALUES
(1, 'pdf', 21, 'text', 0, ''),
(2, 'djvu', 21, 'text', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `posts_additional_values`
--

CREATE TABLE IF NOT EXISTS `posts_additional_values` (
  `id` int(11) NOT NULL,
  `field` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts_additional_values`
--

INSERT INTO `posts_additional_values` (`id`, `field`, `post`, `value`) VALUES
(1, 1, 91, 'https://drive.google.com/file/d/0BwO7PI-rniNobWRqSU1TU1N3Ymc/view?usp=sharing'),
(2, 2, 91, '#'),
(3, 1, 92, 'https://drive.google.com/file/d/0BwO7PI-rniNobmNyUFJiTENHRFk/view?usp=sharing'),
(4, 2, 92, '#'),
(5, 1, 93, 'https://drive.google.com/file/d/0BwO7PI-rniNoUDVYUFotTTlWSjQ/view?usp=sharing'),
(6, 2, 93, '#'),
(7, 1, 94, 'https://drive.google.com/file/d/0BwO7PI-rniNoXzJKR2E1Yl9pMFE/view?usp=sharing'),
(8, 2, 94, 'https://drive.google.com/file/d/0BwO7PI-rniNoOTBvZk1WdE40eXM/view?usp=sharing'),
(9, 1, 95, 'https://drive.google.com/file/d/0BwO7PI-rniNoUUhYTnh4cV91Tk0/view?usp=sharing'),
(10, 2, 95, '#'),
(11, 1, 96, 'https://drive.google.com/file/d/0BwO7PI-rniNoU1dnVGl0N3dERW8/view?usp=sharing'),
(12, 2, 96, '#'),
(13, 1, 97, 'https://drive.google.com/file/d/0BwO7PI-rniNoa2FkZWlaUWZ5RjQ/view?usp=sharing'),
(14, 2, 97, '#'),
(15, 1, 98, 'https://drive.google.com/file/d/0BwO7PI-rniNoWXhLWUYtZVlSV3M/view?usp=sharing'),
(16, 2, 98, '#'),
(17, 1, 99, 'https://drive.google.com/file/d/0BwO7PI-rniNoVWY5WTkxNzlJZ0U/view?usp=sharing'),
(18, 2, 99, '#'),
(19, 1, 100, '#'),
(20, 2, 100, 'https://drive.google.com/file/d/0BwO7PI-rniNoaFM5WUZJeXVUSGc/view?usp=sharing'),
(21, 1, 101, 'https://drive.google.com/file/d/0BwO7PI-rniNoQWFtejY5RHptckk/view?usp=sharing'),
(22, 2, 101, '#'),
(23, 1, 102, 'https://drive.google.com/file/d/0BwO7PI-rniNoMkVPX2tfbEZvWUE/view?usp=sharing'),
(24, 2, 102, '#'),
(25, 1, 103, 'https://drive.google.com/file/d/0BwO7PI-rniNoNk90dEZHWDEtYU0/view?usp=sharing'),
(26, 2, 103, '#'),
(27, 1, 104, 'https://drive.google.com/file/d/0BwO7PI-rniNoLTFfc3ZwS0JpMW8/view?usp=sharing'),
(28, 2, 104, '#'),
(29, 1, 105, 'https://drive.google.com/file/d/0BwO7PI-rniNoWkpBRkdRdmFzUlU/view?usp=sharing'),
(30, 2, 105, '#'),
(31, 1, 106, '#'),
(32, 2, 106, 'https://drive.google.com/file/d/0BwO7PI-rniNoYUVtOG40ejFmeXc/view?usp=sharing');

-- --------------------------------------------------------

--
-- Структура таблицы `shortcodes`
--

CREATE TABLE IF NOT EXISTS `shortcodes` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `package` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shortcodes`
--

INSERT INTO `shortcodes` (`id`, `code`, `package`, `controller`, `action`, `parameter`) VALUES
(1, 'content', 'contents', 'default', 'get', 'name'),
(2, 'file', 'files', 'default', 'get', 'id'),
(3, 'category', 'posts', 'default', 'getCategoryList', 'id');

-- --------------------------------------------------------

--
-- Структура таблицы `studyprog_feedback`
--

CREATE TABLE IF NOT EXISTS `studyprog_feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL,
  `theme` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `templates`
--

INSERT INTO `templates` (`id`, `theme`, `name`, `content`) VALUES
(1, 1, 'index', '<div class="container-fluid page">\n[content=header]\n[page]\n[content=footer]\n</div>'),
(2, 1, 'news', '<div class="container-fluid page">\n[content=header] \n<section id="news">\n<div class="container-fluid">\n<div class="right-sidebar col-xs-12 col-sm-4 col-md-3 col-lg-3 col-sm-push-8 col-md-push-9 col-lg-push-9">[package=posts controller=default action=getCategoryList main_category_name=news type=categories_current navigation=10 sub_category_page=news mockup=category_list][content=right_sidebar]</div>\n<div class="content col-xs-12 col-sm-8 col-md-9 col-lg-9 col-sm-pull-4 col-md-pull-3 col-lg-pull-3">[page]</div>\n</div> \n</section>\n[content=footer]\n</div>'),
(3, 1, 'algo', '<div class="container-fluid page">\n[content=header] \n<section id="news">\n<div class="container-fluid">\n<div class="right-sidebar col-xs-12 col-sm-4 col-md-3 col-lg-3 col-sm-push-8 col-md-push-9 col-lg-push-9">[package=posts controller=default action=getCategoryList main_category_name=algo type=categories_current navigation=10 sub_category_page=algo mockup=category_list][content=right_sidebar]</div>\n<div class="content col-xs-12 col-sm-8 col-md-9 col-lg-9 col-sm-pull-4 col-md-pull-3 col-lg-pull-3">[page]</div>\n</div> \n</section>\n[content=footer]\n</div>'),
(4, 1, 'code', '<div class="container-fluid page">\n[content=header] \n<section id="news">\n<div class="container-fluid">\n<div class="right-sidebar col-xs-12 col-sm-4 col-md-3 col-lg-3 col-sm-push-8 col-md-push-9 col-lg-push-9">[package=posts controller=default action=getCategoryList main_category_name=code type=categories_current navigation=10 sub_category_page=code mockup=category_list][content=right_sidebar]</div>\n<div class="content col-xs-12 col-sm-8 col-md-9 col-lg-9 col-sm-pull-4 col-md-pull-3 col-lg-pull-3">[page]</div>\n</div> \n</section>\n[content=footer]\n</div>'),
(5, 1, 'gallery', '<div class="container-fluid page">\n[content=header] \n<section id="news">\n<div class="container-fluid">\n<div class="right-sidebar col-xs-12 col-sm-4 col-md-3 col-lg-3 col-sm-push-8 col-md-push-9 col-lg-push-9">[package=posts controller=default action=getCategoryList main_category_name=gallery type=categories_current navigation=10 sub_category_page=gallery mockup=category_list][content=right_sidebar]</div>\n<div class="content col-xs-12 col-sm-8 col-md-9 col-lg-9 col-sm-pull-4 col-md-pull-3 col-lg-pull-3">[page]</div>\n</div> \n</section>\n[content=footer]\n</div>'),
(6, 1, 'library', '<div class="container-fluid page">\n[content=header] \n<section id="news">\n<div class="container-fluid">\n<div class="right-sidebar col-xs-12 col-sm-4 col-md-3 col-lg-3 col-sm-push-8 col-md-push-9 col-lg-push-9">[package=posts controller=default action=getCategoryList main_category_name=library type=categories_current navigation=10 sub_category_page=library mockup=category_list][content=right_sidebar]</div>\n<div class="content col-xs-12 col-sm-8 col-md-9 col-lg-9 col-sm-pull-4 col-md-pull-3 col-lg-pull-3">[page]</div>\n</div> \n</section>\n[content=footer]\n</div>');

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `name`, `active`) VALUES
(1, 'default', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `translations`
--

CREATE TABLE IF NOT EXISTS `translations` (
  `id` int(11) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `field` varchar(255) NOT NULL,
  `object_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `translation` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=319 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `translations`
--

INSERT INTO `translations` (`id`, `table_name`, `field`, `object_id`, `language_id`, `translation`) VALUES
(1, 'pages', 'title', 1, 1, 'Главная страница'),
(2, 'pages', 'title', 1, 2, 'Main page'),
(3, 'pages', 'title', 1, 3, 'Ana səhifə'),
(4, 'pages', 'content', 1, 1, '<section id="content">[content=slider]</section>'),
(5, 'pages', 'content', 1, 2, '<section id="content">[content=slider]</section>'),
(6, 'pages', 'content', 1, 3, '<section id="content">[content=slider]</section>'),
(7, 'contents', 'content', 1, 1, '<header>\n<nav class="navbar navbar-default">\n	<div class="container-fluid">\n		<div class="navbar-header">\n			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">\n				<span class="sr-only">Toggle navigation</span>\n				<span class="icon-bar"></span>\n				<span class="icon-bar"></span>\n				<span class="icon-bar"></span>\n			</button>\n			<h1><a class="navbar-brand" href="[$system_url]">стадипрог</a></h1>\n		</div>\n		<div class="collapse navbar-collapse" id="main-menu">\n                        <ul class="nav navbar-nav navbar-right social-menu">\n				[package=menus controller=default action=get id=2 parent_id=0][package=menus controller=default action=get id=3 parent_id=0]\n			</ul>\n			<ul class="nav navbar-nav navbar-right main-menu">\n				[package=menus controller=default action=get id=1 parent_id=0]\n			</ul>\n		</div>\n  </div>\n</nav>\n</header>'),
(8, 'contents', 'content', 1, 2, '<header>\n<nav class="navbar navbar-default">\n	<div class="container-fluid">\n		<div class="navbar-header">\n			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">\n				<span class="sr-only">Toggle navigation</span>\n				<span class="icon-bar"></span>\n				<span class="icon-bar"></span>\n				<span class="icon-bar"></span>\n			</button>\n			<h1><a class="navbar-brand" href="[$system_url]">Studyprog</a></h1>\n		</div>\n		<div class="collapse navbar-collapse" id="main-menu">\n                        <ul class="nav navbar-nav navbar-right social-menu">\n				[package=menus controller=default action=get id=2 parent_id=0][package=menus controller=default action=get id=3 parent_id=0]\n			</ul>\n			<ul class="nav navbar-nav navbar-right main-menu">\n				[package=menus controller=default action=get id=1 parent_id=0]\n			</ul>\n		</div>\n  </div>\n</nav>\n</header>'),
(9, 'contents', 'content', 1, 3, '<header>\n<nav class="navbar navbar-default">\n	<div class="container-fluid">\n		<div class="navbar-header">\n			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">\n				<span class="sr-only">Toggle navigation</span>\n				<span class="icon-bar"></span>\n				<span class="icon-bar"></span>\n				<span class="icon-bar"></span>\n			</button>\n			<h1><a class="navbar-brand" href="[$system_url]">Studyprog</a></h1>\n		</div>\n		<div class="collapse navbar-collapse" id="main-menu">\n                        <ul class="nav navbar-nav navbar-right social-menu">\n				[package=menus controller=default action=get id=2 parent_id=0][package=menus controller=default action=get id=3 parent_id=0]\n			</ul>\n			<ul class="nav navbar-nav navbar-right main-menu">\n				[package=menus controller=default action=get id=1 parent_id=0]\n			</ul>\n		</div>\n  </div>\n</nav>\n</header>'),
(10, 'contents', 'content', 2, 1, '<footer>\n<div class="container-fluid">\n<p>Studyprog © 2016. <a href="#">Privacy Policy</a></p>\n</div>\n</footer>'),
(11, 'contents', 'content', 2, 2, '<footer>\n<div class="container-fluid">\n<p>Studyprog © 2016. <a href="#">Privacy Policy</a></p>\n</div>\n</footer>'),
(12, 'contents', 'content', 2, 3, '<footer>\n<div class="container-fluid">\n<p>Studyprog © 2016. <a href="#">Privacy Policy</a></p>\n</div>\n</footer>'),
(13, 'pages', 'title', 2, 1, 'О проекте'),
(14, 'pages', 'title', 2, 2, 'About'),
(15, 'pages', 'title', 2, 3, 'Layihə haqqında'),
(16, 'pages', 'content', 2, 1, '<section id="about">\n<div class="container-fluid">\n<h1>О проекте</h1>\n<p class="text-justify">Идея о создании проекта Studyprog появилась в октябре 2012-го года. Изначально в проекте участвовали магистрант Бакинского филиала МГУ им. М. В. Ломоносова Александр Проскуряков, разработавший первоначальный вариант тестирующей системы, и студент этого же университета Али Велиев. Первый релиз проекта состоялся 14-го сентября 2013-го года.</p>\n\n<blockquote>\n<p class="text-justify">Тогда в 2013-ом мы решили сделать тестирующую систему для олимпиадных задач, так как очень увлекались именно ими. Но потом по предложению нашего учителя Григорьева И. С. Мы добавили возможность тестирования и численных задач математики.</p>\n<small>Али Велиев, <cite title="Source Title">основатель проекта "Studyprog"</cite></small></blockquote>\n\n<p class="text-justify">На сайте Studyprog можно найти обучающие материалы по теории алгоритмов и программированию. Также у сайта действует <a href="https://www.youtube.com/user/studyprog" target="_blank">канал на Youtube</a>, где также публикуются видеоуроки, а также видеоматериалы с разных мероприятий.</p>\n\n<p>На данный момент разработкой сайта занимается Али Велиев.</p>\n\n<h3>Благодарности</h3>\n\n<ul>\n	<li>Спасибо <a href="http://mech.math.msu.su/~iliagri/" target="_blank">к.ф-м.н. Илье Сергеевичу Григорьеву</a> и <a href="http://galeevem.math.msu.su/" target="_blank">д.ф-м.н. Эльфату Михайловичу Галееву</a> за поддержку.</li>\n	<li>Спасибо Вагифу Кязымову, Кямрану Кязыми и Сабине Исаевой за помощь в переводах статей и интерфейса сайта.</li>\n	<li>Спасибо <a href="http://msu.az/" target="_blank">Бакинскому филиалу МГУ им. М. В. Ломоносова</a> и компании <a href="http://bitep.net/" target="_blank">BITEP</a> за поддержку.</li>\n</ul>\n\n<h3>Обратная связь</h3>\n\n<p class="text-justify">Связаться с нами можно любым способом описанным <a href="http://studyprog.com/contacts">здесь</a>.</p>\n</div>\n</section>'),
(17, 'pages', 'content', 2, 2, '<section id="about">\n<div class="container-fluid">\n<h1>About project</h1>\n<p class="text-justify">The idea of creating a Studyprog project appeared in October of 2012. Initially, the development of the project was attended by undergraduate&nbsp;of the Baku branch of Moscow State University named after M. V. Lomonosov Alexander Proskuryakov, who create a primary version of testing system&nbsp;and student of this University&nbsp;Ali Veliyev. The first release of the project took place on 14 September 2013.</p>\n\n<blockquote>\n<p class="text-justify">Then in 2013-th we decided to make testing system for Olympiad problems, because it is very fond of it. But then, at the suggestion of our teacher Grigoriev&nbsp;I. we''ve added the ability to test and numerical problems of mathematics.</p>\n<small>Ali Veliyev, <cite title="Source Title">founder of the "Studyprog" project</cite></small></blockquote>\n\n<p class="text-justify">The site Studyprog can find educational materials on the theory of algorithms and programming. Also, the site operates <a href="https://www.youtube.com/user/studyprog" target="_blank">channel on Youtube</a>, which are also published video tutorials, as well as footage from various events.</p>\n\n<p>Now development and support of site and testing system makes by&nbsp;Ali Veliyev.</p>\n\n<h3>Thanks</h3>\n\n<ul>\n	<li>Thanks to <a href="http://mech.math.msu.su/~iliagri/" target="_blank">PhD Grigiryev Ilya Sergeevich</a> and <a href="http://galeevem.math.msu.su/" target="_blank">Dr. Galeev Elfat Michailovich</a> for their support.</li>\n	<li>Thank Kazimov Vagif, Kamran Kyazymi Sabina Isayeva and for help in translating articles and website interface.</li>\n	<li>Thanks to the <a href="http://msu.az/" target="_blank">Baku branch of Moscow State University named after M. V. Lomonosov</a> and <a href="http://bitep.net/" target="_blank">BITEP</a> company for support.</li>\n</ul>\n\n<h3>Feedback</h3>\n\n<p class="text-justify">You can contact us by any method which described <a href="http://studyprog.com/contacts">here</a>.</p>\n</div>\n</section>'),
(18, 'pages', 'content', 2, 3, '<section id="about">\n<div class="container-fluid">\n<h1>Layihə haqqında</h1>\n<p class="text-justify">Studyprog layihəsi barədə fikir 2012-ci ilin oktyabr ayinda yaranmışdır. Əvvəl layihə üstündə Moskva Dövlət Universitetinin Bakı filialının maqistrantı Aleksandr Proskuryakov, hansı ki test sisteminin birinci versiyasını yazıb&nbsp;və tələbəsi Əli Vəliyev işləmişdilər. Layihə ilk dəfə 14 sentyabr 2013-cü ildə işıq üzü gördü.</p>\n\n<blockquote>\n<p class="text-justify">O vaxtı, 2013-də biz olimpiadalarda iştirak etdiyimiz üçün qərara gəldik ki Azərbaycanda da belə sistem olsun. Amma sonradan İlya müəllimimiz bizə tövsiyə etdi ki sistem riyazi məsələləri də yoxlasın.</p>\n<small>Əli Vəliyev, <cite title="Source Title">"Studyprog" lahiyəsinin icraçısı</cite></small></blockquote>\n\n<p class="text-justify">Studyprog saytında alqoritm və proqramlaşdırma mövzusu ilə olan tədrisedici məqalələr var. Hətta bizim <a href="https://www.youtube.com/user/studyprog" target="_blank">Youtube kanalımızda</a> videodərslər və digər faydalı materiallar mövcuddur.</p>\n\n<p>Hal hazırda sayt və test sistemi üzrə işləri&nbsp;Əli Vəliyev görür.</p>\n\n<h3>Təşəkkürlərimiz</h3>\n\n<ul>\n	<li><a href="http://mech.math.msu.su/~iliagri/" target="_blank">f-r.e.n. Qrigoryev İlya Sergeeviça</a> və <a href="http://galeevem.math.msu.su/" target="_blank">f-r.e.d. Qaleev Elfət Mixayloviça</a> dəstəyə görə təşəkkürlərimizi bildiririk.</li>\n	<li>Vaqif Kazımova, Kamran Kazımiya və Səbinə İsəyevaya tərcümələrə görə təşəkkürlərimizi bildiririk.</li>\n	<li><a href="http://msu.az/" target="_blank">Moskva Dövlət Universitetinin Bakı filialına</a> və <a href="http://bitep.net/" target="_blank">BITEP</a> şorkətinə dəstəyə görə təşəkkürlərimizi bildiririk.</li>\n</ul>\n\n<h3>Əlaqə</h3>\n\n<p class="text-justify">Bizimlə <a href="http://studyprog.com/contacts">burda</a> olan hər hansı bir üsul ilə əlaqə saxlaya bilərsiniz.</p>\n</div>\n</section>'),
(19, 'categories', 'title', 1, 1, 'Новости'),
(20, 'categories', 'title', 1, 2, 'News'),
(21, 'categories', 'title', 1, 3, 'Xəbərlər'),
(22, 'categories', 'content', 1, 1, 'Новости'),
(23, 'categories', 'content', 1, 2, 'News'),
(24, 'categories', 'content', 1, 3, 'Xəbərlər'),
(25, 'categories', 'title', 2, 1, 'Обучение'),
(26, 'categories', 'title', 2, 2, 'Education'),
(27, 'categories', 'title', 2, 3, 'Təlim'),
(28, 'categories', 'content', 2, 1, ''),
(29, 'categories', 'content', 2, 2, ''),
(30, 'categories', 'content', 2, 3, ''),
(31, 'categories', 'title', 3, 1, 'Галерея'),
(32, 'categories', 'title', 3, 2, 'Gallery'),
(33, 'categories', 'title', 3, 3, 'Qalereya'),
(34, 'categories', 'content', 3, 1, ''),
(35, 'categories', 'content', 3, 2, ''),
(36, 'categories', 'content', 3, 3, ''),
(37, 'menu_elements', 'title', 1, 1, 'Новости'),
(38, 'menu_elements', 'title', 1, 2, 'News'),
(39, 'menu_elements', 'title', 1, 3, 'Xəbərlər'),
(40, 'menu_elements', 'title', 2, 1, 'Обучение'),
(41, 'menu_elements', 'title', 2, 2, 'Education'),
(42, 'menu_elements', 'title', 2, 3, 'Təlim'),
(43, 'pages', 'title', 3, 1, 'Контакты'),
(44, 'pages', 'title', 3, 2, 'Contacts'),
(45, 'pages', 'title', 3, 3, 'Əlaqə'),
(46, 'pages', 'content', 3, 1, '<section id="contacts">\n<div class="container-fluid">\n<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">\n<h1>Наши контакты</h1>\n<p>Вы можете связаться с нами по электронной почте: <a href="mailto:admin@studyprog.com" target="_top">admin@studyprog.com</a></p>\n<p>Также отслеживайте наши обновления в социальных сетях:</p>\n<div class="social_link_cont"><a class="btn btn-social-icon btn-facebook" href="https://www.facebook.com/studyprog" target="_blank"><i class="fa fa-facebook"></i></a> <a class="btn btn-social-icon btn-twitter" href="https://twitter.com/StudyProg" target="_blank"><i class="fa fa-twitter"></i></a> <a class="btn btn-social-icon btn-vk" href="https://vk.com/studyprog" target="_blank"><i class="fa fa-vk"></i></a> <a class="btn btn-social-icon btn-google-plus" href="https://plus.google.com/+Studyprog" target="_blank"><i class="fa fa-google-plus"></i></a> <a class="btn btn-social-icon btn-youtube" href="https://www.youtube.com/user/studyprog" target="_blank"><i class="fa fa-youtube"></i></a> <a class="btn btn-social-icon btn-instagram" href="https://instagram.com/studyprog" target="_blank"><i class="fa fa-instagram"></i></a></div>\n</div>\n<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">\n<h1>Обратная связь</h1>\n[package=forms controller=default action=get design=form form=contact-form]\n</div>\n</div>\n</section>'),
(47, 'pages', 'content', 3, 2, '<section id="contacts">\n<div class="container-fluid">\n<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">\n<h1>Наши контакты</h1>\n<p>Вы можете связаться с нами по электронной почте: <a href="mailto:admin@studyprog.com" target="_top">admin@studyprog.com</a></p>\n<p>Также отслеживайте наши обновления в социальных сетях:</p>\n<div class="social_link_cont"><a class="btn btn-social-icon btn-facebook" href="https://www.facebook.com/studyprog" target="_blank"><i class="fa fa-facebook"></i></a> <a class="btn btn-social-icon btn-twitter" href="https://twitter.com/StudyProg" target="_blank"><i class="fa fa-twitter"></i></a> <a class="btn btn-social-icon btn-vk" href="https://vk.com/studyprog" target="_blank"><i class="fa fa-vk"></i></a> <a class="btn btn-social-icon btn-google-plus" href="https://plus.google.com/+Studyprog" target="_blank"><i class="fa fa-google-plus"></i></a> <a class="btn btn-social-icon btn-youtube" href="https://www.youtube.com/user/studyprog" target="_blank"><i class="fa fa-youtube"></i></a> <a class="btn btn-social-icon btn-instagram" href="https://instagram.com/studyprog" target="_blank"><i class="fa fa-instagram"></i></a></div>\n</div>\n<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">\n<h1>Обратная связь</h1>\n[package=forms controller=default action=get design=form form=contact-form]\n</div>\n</div>\n</section>'),
(48, 'pages', 'content', 3, 3, '<section id="contacts">\n<div class="container-fluid">\n<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">\n<h1>Наши контакты</h1>\n<p>Вы можете связаться с нами по электронной почте: <a href="mailto:admin@studyprog.com" target="_top">admin@studyprog.com</a></p>\n<p>Также отслеживайте наши обновления в социальных сетях:</p>\n<div class="social_link_cont"><a class="btn btn-social-icon btn-facebook" href="https://www.facebook.com/studyprog" target="_blank"><i class="fa fa-facebook"></i></a> <a class="btn btn-social-icon btn-twitter" href="https://twitter.com/StudyProg" target="_blank"><i class="fa fa-twitter"></i></a> <a class="btn btn-social-icon btn-vk" href="https://vk.com/studyprog" target="_blank"><i class="fa fa-vk"></i></a> <a class="btn btn-social-icon btn-google-plus" href="https://plus.google.com/+Studyprog" target="_blank"><i class="fa fa-google-plus"></i></a> <a class="btn btn-social-icon btn-youtube" href="https://www.youtube.com/user/studyprog" target="_blank"><i class="fa fa-youtube"></i></a> <a class="btn btn-social-icon btn-instagram" href="https://instagram.com/studyprog" target="_blank"><i class="fa fa-instagram"></i></a></div>\n</div>\n<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">\n<h1>Обратная связь</h1>\n[package=forms controller=default action=get design=form form=contact-form]\n</div>\n</div>\n</section>'),
(49, 'menu_elements', 'title', 3, 1, 'Галерея'),
(50, 'menu_elements', 'title', 3, 2, 'Gallery'),
(51, 'menu_elements', 'title', 3, 3, 'Qalereya'),
(52, 'menu_elements', 'title', 4, 1, 'О нас'),
(53, 'menu_elements', 'title', 4, 2, 'About'),
(54, 'menu_elements', 'title', 4, 3, 'Haqqımızda'),
(55, 'menu_elements', 'title', 5, 1, 'Контакты'),
(56, 'menu_elements', 'title', 5, 2, 'Contacts'),
(57, 'menu_elements', 'title', 5, 3, 'Əlaqə'),
(58, 'menu_elements', 'title', 6, 1, 'fa fa-facebook'),
(59, 'menu_elements', 'title', 6, 2, 'fa fa-facebook'),
(60, 'menu_elements', 'title', 6, 3, 'fa fa-facebook'),
(61, 'menu_elements', 'title', 7, 1, 'fa fa-twitter'),
(62, 'menu_elements', 'title', 7, 2, 'fa fa-twitter'),
(63, 'menu_elements', 'title', 7, 3, 'fa fa-twitter'),
(64, 'menu_elements', 'title', 8, 1, 'fa fa-youtube'),
(65, 'menu_elements', 'title', 8, 2, 'fa fa-youtube'),
(66, 'menu_elements', 'title', 8, 3, 'fa fa-youtube'),
(67, 'contents', 'content', 3, 1, '<div class="container-fluid slider-writing">\n<h1>Присоединяйтесь к нашей системе<br>решайте задачи и повышайте рейтинг</h1>\n<p>Наш сайт доступен на трёх языках. Здесь Вы можете решать множество задач, также прочитать обучающие материалы и другую полезную информацию.</p>\n<a href="http://contest.studyprog.com/">Присоединиться к системе</a>\n</div>'),
(68, 'contents', 'content', 3, 2, '<div class="container-fluid slider-writing">\n<h1>Join to our judge system<br>solve problems and up your ranking</h1>\n<p>Our website avilable in 3 languages. Here you can solve many problems, found education articles and other useful information.</p>\n<a href="http://contest.studyprog.com/">Join to judge</a>\n</div>'),
(69, 'contents', 'content', 3, 3, '<div class="container-fluid slider-writing">\n<h1>Bizim test sistemimizə qoşulun<br>məsələləri həll edin və nəticənizi yüksəldin</h1>\n<p>Saytımız 3 dildə fəaliyyət göstərir. Burda siz çoxlu məsələlər həll edib, həmçinin, tədris məqalələri və digər lazımlı məlumat əldə edə bilərsiniz.</p>\n<a href="http://contest.studyprog.com/">Sistemə qoşul</a>\n</div>'),
(70, 'pages', 'title', 4, 1, 'Новости'),
(71, 'pages', 'title', 4, 2, 'News'),
(72, 'pages', 'title', 4, 3, 'Xəbərlər'),
(73, 'pages', 'content', 4, 1, '[package=posts controller=default action=getCategoryList category_name=news type=posts_all navigation=10 sub_category_page=news mockup=news_list post_design=post navigation_mockup=navigation]'),
(74, 'pages', 'content', 4, 2, '[package=posts controller=default action=getCategoryList category_name=news type=posts_all navigation=10 sub_category_page=news mockup=news_list post_design=post navigation_mockup=navigation]'),
(75, 'pages', 'content', 4, 3, '[package=posts controller=default action=getCategoryList category_name=news type=posts_all navigation=10 sub_category_page=news mockup=news_list post_design=post navigation_mockup=navigation]'),
(76, 'categories', 'title', 4, 1, 'Новости Studyprog'),
(77, 'categories', 'title', 4, 2, 'Studyprog news'),
(78, 'categories', 'title', 4, 3, 'Studyprog xəbərləri'),
(79, 'categories', 'content', 4, 1, ''),
(80, 'categories', 'content', 4, 2, ''),
(81, 'categories', 'content', 4, 3, ''),
(82, 'contents', 'content', 4, 1, ''),
(83, 'contents', 'content', 4, 2, ''),
(84, 'contents', 'content', 4, 3, ''),
(85, 'categories', 'title', 5, 1, 'Интернет'),
(86, 'categories', 'title', 5, 2, 'Internet'),
(87, 'categories', 'title', 5, 3, 'İnternet'),
(88, 'categories', 'content', 5, 1, ''),
(89, 'categories', 'content', 5, 2, ''),
(90, 'categories', 'content', 5, 3, ''),
(91, 'categories', 'title', 6, 1, 'IT события'),
(92, 'categories', 'title', 6, 2, 'IT events'),
(93, 'categories', 'title', 6, 3, 'İT tədbirlər'),
(94, 'categories', 'content', 6, 1, ''),
(95, 'categories', 'content', 6, 2, ''),
(96, 'categories', 'content', 6, 3, ''),
(97, 'menu_elements', 'title', 9, 1, 'fa fa-globe'),
(98, 'menu_elements', 'title', 9, 2, 'fa fa-globe'),
(99, 'menu_elements', 'title', 9, 3, 'fa fa-globe'),
(100, 'menu_elements', 'title', 10, 1, 'Азербайджанский'),
(101, 'menu_elements', 'title', 10, 2, 'Azerbaijan'),
(102, 'menu_elements', 'title', 10, 3, 'Azərbaycan'),
(103, 'menu_elements', 'title', 11, 1, 'Русский'),
(104, 'menu_elements', 'title', 11, 2, 'Russian'),
(105, 'menu_elements', 'title', 11, 3, 'Rus'),
(106, 'menu_elements', 'title', 12, 1, 'Английский'),
(107, 'menu_elements', 'title', 12, 2, 'English'),
(108, 'menu_elements', 'title', 12, 3, 'İnglis'),
(109, 'menu_elements', 'title', 13, 1, 'Азербайджанский'),
(110, 'menu_elements', 'title', 13, 2, 'Azerbaijan'),
(111, 'menu_elements', 'title', 13, 3, 'Azərbaycan'),
(112, 'menu_elements', 'title', 14, 1, 'Русский'),
(113, 'menu_elements', 'title', 14, 2, 'Russian'),
(114, 'menu_elements', 'title', 14, 3, 'Rus'),
(115, 'menu_elements', 'title', 15, 1, 'Английский'),
(116, 'menu_elements', 'title', 15, 2, 'English'),
(117, 'menu_elements', 'title', 15, 3, 'İnglİs'),
(118, 'pages', 'title', 5, 1, 'Обучение'),
(119, 'pages', 'title', 5, 2, 'Education'),
(120, 'pages', 'title', 5, 3, 'Təlim'),
(121, 'pages', 'content', 5, 1, '[content=algo_main]\n[content=code_main]\n[content=lib_main]'),
(122, 'pages', 'content', 5, 2, '[content=algo_main]\n[content=code_main]\n[content=lib_main]'),
(123, 'pages', 'content', 5, 3, '[content=algo_main]\n[content=code_main]\n[content=lib_main]'),
(124, 'contents', 'content', 5, 1, '<section id="algo">\n<div class="container-fluid" >\n<h1>Алгоритмы</h1>\n<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-push-8 col-lg-push-8">\n<img src="[$theme_url]images/algoritm.png"/>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-pull-4 col-lg-pull-4">\n<p>Алгоритм — набор инструкций, описывающих порядок действий исполнителя для достижения некоторого результата.</p>\n<p>В работе настоящего программиста в первую очередь важны познания в алгоритме программы, её структуре, какие действия она выполняет, а также какие действия приведут к её некорректной работе и как избежать этого.</p>\n<br><br><a class="more" href="[$system_url]algo">Подробнее</a>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 slidegroupout">\n<a class="slidedown" href="#code"><i class="fa fa-arrow-circle-o-down"></i></a></div>\n</div>\n</section>'),
(125, 'contents', 'content', 5, 2, '<section id="algo">\n<div class="container-fluid" >\n<h1>Algorithms</h1>\n<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-push-8 col-lg-push-8">\n<img src="[$theme_url]images/algoritm.png"/>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-pull-4 col-lg-pull-4">\n<p>Algorithm — a set of instructions describing the procedures for the executive to achieve a certain result.</p>\n<p>In the work of the programmer is primarily important knowledge in the algorithm of the program, its structure, which actions it performs, and what actions will lead to its malfunction and how to avoid it.</p>\n<br><br><a class="more" href="[$system_url]algo">More</a>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 slidegroupout">\n<a class="slidedown" href="#code"><i class="fa fa-arrow-circle-o-down"></i></a></div>\n</div>\n</section>'),
(126, 'contents', 'content', 5, 3, '<section id="algo">\n<div class="container-fluid" >\n<h1>Alqoritmlər</h1>\n<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-push-8 col-lg-push-8">\n<img src="[$theme_url]images/algoritm.png"/>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-pull-4 col-lg-pull-4">\n<p>Alqoritm — istifadəçinin bir nəticə əldə etməyin fəaliyət qaydasını təsvir edən təlimat dəstidir.</p>\n<p>Əsl proqramçının işində ilk öncə proramın alqoritminin anlayışı, proqramın quruluşu, onun hansı fəaliyyət göstərdiyini anlamaq, hanşı tədbirlər onun işinin nasazlığına səbəb olmasının anlayışı və bunu neçə aradan qaldırma yollarının axtarışını bacarmağı vacibdir.</p>\n<br><br><a class="more" href="[$system_url]algo">Ətraflı</a>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 slidegroupout">\n<a class="slidedown" href="#code"><i class="fa fa-arrow-circle-o-down"></i></a></div>\n</div>\n</section>'),
(127, 'contents', 'content', 6, 1, '<section id="code">\n<div class="container-fluid">\n<h1>Кодинг</h1>\n<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">\n<img src="[$theme_url]images/code.png"/>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">\n<p>Кодинг — процесс реализации алгоритма в машинно представимом виде, в виде готового продукта, которую можно запустить на компьютере.</p>\n<p>В настоящее время существуют довольно много языков программирования, и важно понимать, что не каждый язык программирования способен решить ту или иную задачу так, как это хотелось бы нам. Зная хитрости каждого языка, можно оптимизировать программу под наши нужды.</p>\n<br><br>\n<a class="more" href="[$system_url]code">Подробнее</a>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 slidegroupout">\n<div class="slidegroup">\n<a class="slidedown" href="#algo"><i class="fa fa-arrow-circle-o-up"></i></a>\n<a class="slidedown" href="#lib"><i class="fa fa-arrow-circle-o-down"></i></a>\n</div></div>\n</div>\n</section>'),
(128, 'contents', 'content', 6, 2, '<section id="code">\n<div class="container-fluid">\n<h1>Coding</h1>\n<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">\n<img src="[$theme_url]images/code.png"/>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">\n<p>Coding — process of implementation of the algorithm in machine imaginable form, in the form of a finished product, which can be run on a computer.</p>\n<p>Currently, there are quite a lot of programming languages, and it is important to understand that not every programming language is able to solve a particular problem as it is, we would. Knowing the tricks of each language, you can optimize the software to our needs.</p>\n<br><br>\n<a class="more" href="[$system_url]code">More</a>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 slidegroupout">\n<div class="slidegroup">\n<a class="slidedown" href="#algo"><i class="fa fa-arrow-circle-o-up"></i></a>\n<a class="slidedown" href="#lib"><i class="fa fa-arrow-circle-o-down"></i></a>\n</div></div>\n</div>\n</section>'),
(129, 'contents', 'content', 6, 3, '<section id="code">\n<div class="container-fluid">\n<h1>Kodlaşdırma</h1>\n<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">\n<img src="[$theme_url]images/code.png"/>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">\n<p>Kodlaşdırma — alqoritmin maşın təsviri dilldə, yani hazır bir məhsul kimi, həyata keçirilməsidi. Bu məhsulu biz elektron çıhaz vasıtəsi ilə istifadə edə bilərik.</p>\n<p>Hal hazırdə çoxlu proqramlaşdırma dilləri mövcuddur, və onu da anlamaq vacibdir ki, hər proqramlaşdırma dili hər məsələni biz istədiyimiz kimi həll edə bilmir. Dilin fəndlərini bilərək proqramı bizim istədiyimiz kimi optimallaşdıra bilərik.</p>\n<br><br>\n<a class="more" href="[$system_url]code">Ətraflı</a>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 slidegroupout">\n<div class="slidegroup">\n<a class="slidedown" href="#algo"><i class="fa fa-arrow-circle-o-up"></i></a>\n<a class="slidedown" href="#lib"><i class="fa fa-arrow-circle-o-down"></i></a>\n</div>\n</div>\n</div>\n</section>'),
(130, 'contents', 'content', 7, 1, '<section id="lib"><div class="container-fluid">\n<h1>Библиотека</h1>\n<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-push-8 col-lg-push-8">\n<img src="[$theme_url]images/library.png"/>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-pull-4 col-lg-pull-4">\n<p>Проведите время с пользой, читая научную литературу, посвящённым разделам математики или же архитектуре вычислительных устройств и языкам программирования.</p>\n<p>Здесь можно найти с бесплатно скачать огромное количество электронных книг. Просто найдите нужную и скачайте в один клик.</p>\n<br><br>\n<a class="more" href="[$system_url]library">Подробнее</a>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 slidegroupout">\n<a class="slidedown" href="#code"><i class="fa fa-arrow-circle-o-up"></i></a></div>\n</div></section>'),
(131, 'contents', 'content', 7, 2, '<section id="lib"><div class="container-fluid">\n<h1>Library</h1>\n<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-push-8 col-lg-push-8">\n<img src="[$theme_url]images/library.png"/>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-pull-4 col-lg-pull-4">\n<p>Spend time with the benefit of reading the scientific literature on branches of mathematics or architecture computing devices and programming languages.</p>\n<p>Here you can find a free download huge number of e-books. Just look for the right and download with one click.</p>\n<br><br>\n<a class="more" href="[$system_url]library">More</a>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 slidegroupout">\n<a class="slidedown" href="#code"><i class="fa fa-arrow-circle-o-up"></i></a></div>\n</div></section>'),
(132, 'contents', 'content', 7, 3, '<section id="lib"><div class="container-fluid">\n<h1>Kitabxana</h1>\n<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-push-8 col-lg-push-8">\n<img src="[$theme_url]images/library.png"/>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-pull-4 col-lg-pull-4">\n<p>Vaxtınızı riyaziyyata və ya elektron cıhazların inşaatı və proqramlaşdırma dillərinə həsr olunmuş elmi ədəbiyyat oxuyaraq, səmərəli istivadə edin.</p>\n<p>Burda çoxlu miqdarda elektron kitab tapıb və endirmək olar. Sadəcə istədiyiniz kitabı tapıb 1 tıkıltıya endirin.</p>\n<br><br>\n<a class="more" href="[$system_url]library">Ətraflı</a>\n</div>\n<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 slidegroupout">\n<a class="slidedown" href="#code"><i class="fa fa-arrow-circle-o-up"></i></a></div>\n</div></section>'),
(133, 'pages', 'title', 6, 1, 'Алгоритмы'),
(134, 'pages', 'title', 6, 2, 'Algorithms'),
(135, 'pages', 'title', 6, 3, 'Alqoritmlər'),
(136, 'pages', 'content', 6, 1, '[package=posts controller=default action=getCategoryList category_name=algo type=posts_all navigation=10 sub_category_page=algo mockup=news_list post_design=post navigation_mockup=navigation]'),
(137, 'pages', 'content', 6, 2, '[package=posts controller=default action=getCategoryList category_name=algo type=posts_all navigation=10 sub_category_page=algo mockup=news_list post_design=post navigation_mockup=navigation]'),
(138, 'pages', 'content', 6, 3, '[package=posts controller=default action=getCategoryList category_name=algo type=posts_all navigation=10 sub_category_page=algo mockup=news_list post_design=post navigation_mockup=navigation]'),
(139, 'categories', 'title', 7, 1, 'Алгоритмы'),
(140, 'categories', 'title', 7, 2, 'Algorithms'),
(141, 'categories', 'title', 7, 3, 'Alqoritmlər'),
(142, 'categories', 'content', 7, 1, ''),
(143, 'categories', 'content', 7, 2, ''),
(144, 'categories', 'content', 7, 3, ''),
(145, 'categories', 'title', 8, 1, 'Основы алгоритмизации'),
(146, 'categories', 'title', 8, 2, 'Basics of algorithms'),
(147, 'categories', 'title', 8, 3, 'Alqoritmlərin əsası'),
(148, 'categories', 'content', 8, 1, ''),
(149, 'categories', 'content', 8, 2, ''),
(150, 'categories', 'content', 8, 3, ''),
(151, 'categories', 'title', 9, 1, 'Сортировки и поиск'),
(152, 'categories', 'title', 9, 2, 'Sort and search'),
(153, 'categories', 'title', 9, 3, 'Çeşidlənmə və axtarış'),
(154, 'categories', 'content', 9, 1, ''),
(155, 'categories', 'content', 9, 2, ''),
(156, 'categories', 'content', 9, 3, ''),
(157, 'categories', 'title', 10, 1, 'Теория графов'),
(158, 'categories', 'title', 10, 2, 'Graph theory'),
(159, 'categories', 'title', 10, 3, 'Qraflar nəzəriyyəsi'),
(160, 'categories', 'content', 10, 1, ''),
(161, 'categories', 'content', 10, 2, ''),
(162, 'categories', 'content', 10, 3, ''),
(163, 'pages', 'title', 7, 1, 'Кодинг'),
(164, 'pages', 'title', 7, 2, 'Code'),
(165, 'pages', 'title', 7, 3, 'Kodlaşdırma'),
(166, 'pages', 'content', 7, 1, '[package=posts controller=default action=getCategoryList category_name=code type=posts_all navigation=10 sub_category_page=code mockup=news_list post_design=post navigation_mockup=navigation]'),
(167, 'pages', 'content', 7, 2, '[package=posts controller=default action=getCategoryList category_name=code type=posts_all navigation=10 sub_category_page=code mockup=news_list post_design=post navigation_mockup=navigation]'),
(168, 'pages', 'content', 7, 3, '[package=posts controller=default action=getCategoryList category_name=code type=posts_all navigation=10 sub_category_page=code mockup=news_list post_design=post navigation_mockup=navigation]'),
(169, 'forms', 'title', 1, 1, 'Форма обратной связи'),
(170, 'forms', 'title', 1, 2, 'Feedback form'),
(171, 'forms', 'title', 1, 3, 'Əlaqə forması'),
(172, 'forms', 'reset_button_title', 1, 1, ''),
(173, 'forms', 'reset_button_title', 1, 2, ''),
(174, 'forms', 'reset_button_title', 1, 3, ''),
(175, 'forms', 'submit_button_title', 1, 1, 'Отправить сообщение'),
(176, 'forms', 'submit_button_title', 1, 2, 'Send message'),
(177, 'forms', 'submit_button_title', 1, 3, 'İsmarıcı göndər'),
(178, 'categories', 'title', 11, 1, 'Кодинг'),
(179, 'categories', 'title', 11, 2, 'Coding'),
(180, 'categories', 'title', 11, 3, 'Kodlaşdırma'),
(181, 'categories', 'content', 11, 1, ''),
(182, 'categories', 'content', 11, 2, ''),
(183, 'categories', 'content', 11, 3, ''),
(184, 'categories', 'title', 12, 1, 'C'),
(185, 'categories', 'title', 12, 2, 'C'),
(186, 'categories', 'title', 12, 3, 'C'),
(187, 'categories', 'content', 12, 1, ''),
(188, 'categories', 'content', 12, 2, ''),
(189, 'categories', 'content', 12, 3, ''),
(190, 'categories', 'title', 13, 1, 'C++'),
(191, 'categories', 'title', 13, 2, 'C++'),
(192, 'categories', 'title', 13, 3, 'C++'),
(193, 'categories', 'content', 13, 1, ''),
(194, 'categories', 'content', 13, 2, ''),
(195, 'categories', 'content', 13, 3, ''),
(196, 'categories', 'title', 14, 1, 'C#'),
(197, 'categories', 'title', 14, 2, 'C#'),
(198, 'categories', 'title', 14, 3, 'C#'),
(199, 'categories', 'content', 14, 1, ''),
(200, 'categories', 'content', 14, 2, ''),
(201, 'categories', 'content', 14, 3, ''),
(202, 'categories', 'title', 15, 1, 'Java'),
(203, 'categories', 'title', 15, 2, 'Java'),
(204, 'categories', 'title', 15, 3, 'Java'),
(205, 'categories', 'content', 15, 1, ''),
(206, 'categories', 'content', 15, 2, ''),
(207, 'categories', 'content', 15, 3, ''),
(208, 'categories', 'title', 16, 1, 'HTML'),
(209, 'categories', 'title', 16, 2, 'HTML'),
(210, 'categories', 'title', 16, 3, 'HTML'),
(211, 'categories', 'content', 16, 1, ''),
(212, 'categories', 'content', 16, 2, ''),
(213, 'categories', 'content', 16, 3, ''),
(214, 'categories', 'title', 17, 1, 'JavaScript'),
(215, 'categories', 'title', 17, 2, 'JavaScript'),
(216, 'categories', 'title', 17, 3, 'JavaScript'),
(217, 'categories', 'content', 17, 1, ''),
(218, 'categories', 'content', 17, 2, ''),
(219, 'categories', 'content', 17, 3, ''),
(220, 'categories', 'title', 18, 1, 'CSS'),
(221, 'categories', 'title', 18, 2, 'CSS'),
(222, 'categories', 'title', 18, 3, 'CSS'),
(223, 'categories', 'content', 18, 1, ''),
(224, 'categories', 'content', 18, 2, ''),
(225, 'categories', 'content', 18, 3, ''),
(226, 'categories', 'title', 19, 1, 'PHP'),
(227, 'categories', 'title', 19, 2, 'PHP'),
(228, 'categories', 'title', 19, 3, 'PHP'),
(229, 'categories', 'content', 19, 1, ''),
(230, 'categories', 'content', 19, 2, ''),
(231, 'categories', 'content', 19, 3, ''),
(232, 'form_fields', 'label', 1, 1, 'Имя'),
(233, 'form_fields', 'label', 1, 2, 'Name'),
(234, 'form_fields', 'label', 1, 3, 'Adı'),
(235, 'form_fields', 'placeholder', 1, 1, 'Имя'),
(236, 'form_fields', 'placeholder', 1, 2, 'Name'),
(237, 'form_fields', 'placeholder', 1, 3, 'Adı'),
(238, 'form_fields', 'label', 2, 1, 'Электронная почта'),
(239, 'form_fields', 'label', 2, 2, 'E-mail'),
(240, 'form_fields', 'label', 2, 3, 'E-poçt'),
(241, 'form_fields', 'placeholder', 2, 1, 'Электронная почта'),
(242, 'form_fields', 'placeholder', 2, 2, 'E-mail'),
(243, 'form_fields', 'placeholder', 2, 3, 'E-poçt'),
(244, 'form_fields', 'label', 3, 1, 'Тема'),
(245, 'form_fields', 'label', 3, 2, 'Subject'),
(246, 'form_fields', 'label', 3, 3, 'Mövzu'),
(247, 'form_fields', 'placeholder', 3, 1, 'Тема'),
(248, 'form_fields', 'placeholder', 3, 2, 'Subject'),
(249, 'form_fields', 'placeholder', 3, 3, 'Mövzu'),
(250, 'form_fields', 'label', 4, 1, 'Сообщение'),
(251, 'form_fields', 'label', 4, 2, 'Message'),
(252, 'form_fields', 'label', 4, 3, 'İsmarıc'),
(253, 'form_fields', 'placeholder', 4, 1, 'Сообщение'),
(254, 'form_fields', 'placeholder', 4, 2, 'Message'),
(255, 'form_fields', 'placeholder', 4, 3, 'İsmarıc'),
(256, 'form_fields', 'label', 5, 1, 'Подтвердите, что вы не робот'),
(257, 'form_fields', 'label', 5, 2, 'Confirm that you are not a robot'),
(258, 'form_fields', 'label', 5, 3, 'Təsdiq edin ki, robot deyilsiniz'),
(259, 'form_fields', 'placeholder', 5, 1, 'Подтвердите, что вы не робот'),
(260, 'form_fields', 'placeholder', 5, 2, 'Confirm that you are not a robot'),
(261, 'form_fields', 'placeholder', 5, 3, 'Təsdiq edin ki, robot deyilsiniz'),
(262, 'pages', 'title', 8, 1, 'Галерея'),
(263, 'pages', 'title', 8, 2, 'Gallery'),
(264, 'pages', 'title', 8, 3, 'Qalereya'),
(265, 'pages', 'content', 8, 1, '[package=posts controller=default action=getCategoryList category_name=gallery type=posts_all navigation=12 sub_category_page=gallery mockup=gallery_list post_design=post navigation_mockup=navigation]'),
(266, 'pages', 'content', 8, 2, '[package=posts controller=default action=getCategoryList category_name=gallery type=posts_all navigation=12 sub_category_page=gallery mockup=gallery_list post_design=post navigation_mockup=navigation]'),
(267, 'pages', 'content', 8, 3, '[package=posts controller=default action=getCategoryList category_name=gallery type=posts_all navigation=12 sub_category_page=gallery mockup=gallery_list post_design=post navigation_mockup=navigation]'),
(268, 'posts_additional_fields', 'title', 1, 1, 'Видео'),
(269, 'posts_additional_fields', 'title', 1, 2, 'Video'),
(270, 'posts_additional_fields', 'title', 1, 3, 'Video'),
(271, 'categories', 'title', 20, 1, 'Let''s solve E-OLIMP'),
(272, 'categories', 'title', 20, 2, 'Let''s solve E-OLIMP'),
(273, 'categories', 'title', 20, 3, 'Let''s solve E-OLIMP'),
(274, 'categories', 'content', 20, 1, ''),
(275, 'categories', 'content', 20, 2, ''),
(276, 'categories', 'content', 20, 3, ''),
(277, 'categories', 'title', 21, 1, 'Библиотека'),
(278, 'categories', 'title', 21, 2, 'Library'),
(279, 'categories', 'title', 21, 3, 'Kitabxana'),
(280, 'categories', 'content', 21, 1, ''),
(281, 'categories', 'content', 21, 2, ''),
(282, 'categories', 'content', 21, 3, ''),
(283, 'categories', 'title', 22, 1, 'Программирование на языке С'),
(284, 'categories', 'title', 22, 2, 'Programming in C'),
(285, 'categories', 'title', 22, 3, 'C dilində proqramlaşdırma'),
(286, 'categories', 'content', 22, 1, ''),
(287, 'categories', 'content', 22, 2, ''),
(288, 'categories', 'content', 22, 3, ''),
(289, 'categories', 'title', 23, 1, 'Программирование на языке С++'),
(290, 'categories', 'title', 23, 2, 'Programming in C++'),
(291, 'categories', 'title', 23, 3, 'C++ dilində proqramlaşdırma'),
(292, 'categories', 'content', 23, 1, ''),
(293, 'categories', 'content', 23, 2, ''),
(294, 'categories', 'content', 23, 3, ''),
(295, 'posts_additional_fields', 'title', 1, 1, 'PDF'),
(296, 'posts_additional_fields', 'title', 1, 2, 'PDF'),
(297, 'posts_additional_fields', 'title', 1, 3, 'PDF'),
(298, 'posts_additional_fields', 'title', 2, 1, 'DJVU'),
(299, 'posts_additional_fields', 'title', 2, 2, 'DJVU'),
(300, 'posts_additional_fields', 'title', 2, 3, 'DJVU'),
(301, 'categories', 'title', 24, 1, 'Веб-программирование'),
(302, 'categories', 'title', 24, 2, 'Web programming'),
(303, 'categories', 'title', 24, 3, 'Veb-proqramlaşdırma'),
(304, 'categories', 'content', 24, 1, ''),
(305, 'categories', 'content', 24, 2, ''),
(306, 'categories', 'content', 24, 3, ''),
(307, 'categories', 'title', 25, 1, 'SQL'),
(308, 'categories', 'title', 25, 2, 'SQL'),
(309, 'categories', 'title', 25, 3, 'SQL'),
(310, 'categories', 'content', 25, 1, ''),
(311, 'categories', 'content', 25, 2, ''),
(312, 'categories', 'content', 25, 3, ''),
(313, 'pages', 'title', 9, 1, 'Библиотека'),
(314, 'pages', 'title', 9, 2, 'Library'),
(315, 'pages', 'title', 9, 3, 'Kitabxana'),
(316, 'pages', 'content', 9, 1, '[package=posts controller=default action=getCategoryList category_name=library type=posts_all navigation=10 sub_category_page=library mockup=news_list post_design=library_item navigation_mockup=navigation]'),
(317, 'pages', 'content', 9, 2, '[package=posts controller=default action=getCategoryList category_name=library type=posts_all navigation=10 sub_category_page=library mockup=news_list post_design=library_item navigation_mockup=navigation]'),
(318, 'pages', 'content', 9, 3, '[package=posts controller=default action=getCategoryList category_name=library type=posts_all navigation=10 sub_category_page=library mockup=news_list post_design=library_item navigation_mockup=navigation]');

-- --------------------------------------------------------

--
-- Структура таблицы `translation_slug`
--

CREATE TABLE IF NOT EXISTS `translation_slug` (
  `id` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `translation` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `translation_slug`
--

INSERT INTO `translation_slug` (`id`, `language`, `slug`, `translation`) VALUES
(1, 1, 'feedback_success', 'Ваш отзыв успешно отправлен! Мы свяжемся с Вами в ближайшее время. Большое спасибо за предъявленный интерес к проекту.'),
(2, 2, 'feedback_success', 'Your feedback recieved successfully! We will reach you in near time. Thanks for interesting to our project.'),
(3, 3, 'feedback_success', 'Sizin ismarıcınız çatdırıldı! Biz sizinlə yaxın vaxtlarda əlaqə saxlayacayıq. Layıhə üçün maraq göstərdiyinizə görə minnətdərıq.'),
(4, 1, 'feedback_error', 'Извините, произошла ошибка!'),
(5, 2, 'feedback_error', 'Sorry, error occurred!'),
(6, 3, 'feedback_error', 'Bağışlayın. xəta baş verdi!');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `group_id`) VALUES
(1, 'admin', 'office@aliveliyev.com', '1d3c8e77d0b465adc4bda5f80040176f', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users_additional_fields`
--

CREATE TABLE IF NOT EXISTS `users_additional_fields` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `select_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users_additional_values`
--

CREATE TABLE IF NOT EXISTS `users_additional_values` (
  `id` int(11) NOT NULL,
  `field` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_groups`
--

INSERT INTO `users_groups` (`id`, `title`) VALUES
(1, 'Public'),
(2, 'Admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories_templates`
--
ALTER TABLE `categories_templates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `errors`
--
ALTER TABLE `errors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `form_fields`
--
ALTER TABLE `form_fields`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `form_selects`
--
ALTER TABLE `form_selects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `form_select_options`
--
ALTER TABLE `form_select_options`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `head`
--
ALTER TABLE `head`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `list_mockups`
--
ALTER TABLE `list_mockups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu_elements`
--
ALTER TABLE `menu_elements`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth`
--
ALTER TABLE `oauth`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages_templates`
--
ALTER TABLE `pages_templates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts_additional_fields`
--
ALTER TABLE `posts_additional_fields`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts_additional_values`
--
ALTER TABLE `posts_additional_values`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shortcodes`
--
ALTER TABLE `shortcodes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `studyprog_feedback`
--
ALTER TABLE `studyprog_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `translation_slug`
--
ALTER TABLE `translation_slug`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_additional_fields`
--
ALTER TABLE `users_additional_fields`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_additional_values`
--
ALTER TABLE `users_additional_values`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблицы `categories_templates`
--
ALTER TABLE `categories_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблицы `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `designs`
--
ALTER TABLE `designs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `errors`
--
ALTER TABLE `errors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `form_fields`
--
ALTER TABLE `form_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `form_selects`
--
ALTER TABLE `form_selects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `form_select_options`
--
ALTER TABLE `form_select_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `head`
--
ALTER TABLE `head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `list_mockups`
--
ALTER TABLE `list_mockups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `menu_elements`
--
ALTER TABLE `menu_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `oauth`
--
ALTER TABLE `oauth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `pages_templates`
--
ALTER TABLE `pages_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT для таблицы `posts_additional_fields`
--
ALTER TABLE `posts_additional_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `posts_additional_values`
--
ALTER TABLE `posts_additional_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT для таблицы `shortcodes`
--
ALTER TABLE `shortcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `studyprog_feedback`
--
ALTER TABLE `studyprog_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=319;
--
-- AUTO_INCREMENT для таблицы `translation_slug`
--
ALTER TABLE `translation_slug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users_additional_fields`
--
ALTER TABLE `users_additional_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users_additional_values`
--
ALTER TABLE `users_additional_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
