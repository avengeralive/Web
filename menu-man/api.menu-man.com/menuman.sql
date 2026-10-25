DROP TABLE users;
DROP TABLE places;
DROP TABLE menu;
DROP TABLE menu_groups;
DROP TABLE menu_goods;
DROP TABLE kitchen_types;
DROP TABLE place_types;
DROP TABLE countries;
DROP TABLE cities;
DROP TABLE regions;
DROP TABLE subway_stations;
DROP TABLE news;
DROP TABLE promotions;
DROP TABLE promocodes;
DROP TABLE loyality_cards;
DROP TABLE loyality_cards_users;
DROP TABLE booking;
DROP TABLE network;
DROP TABLE workers;
DROP TABLE worker_reviews;
DROP TABLE reviews;
DROP TABLE ratings;
DROP TABLE chat;
DROP TABLE places_kitchen_types;
DROP TABLE places_place_types;
DROP TABLE places_subway_stations;
DROP TABLE places_regions;
DROP TABLE visitors;
DROP TABLE page_visitors;
DROP TABLE article_visitors;
DROP TABLE auth;
DROP TABLE notifications;

CREATE TABLE IF NOT EXISTS users (
	ID bigserial PRIMARY KEY,
	email varchar (50) NOT NULL,
	password varchar (256) NOT NULL,
	user_type varchar (10),
	first_name varchar (50),
	last_name varchar (50),
	phone varchar(30),
	balance int DEFAULT 0,
	registration_date timestamp without time zone DEFAULT now(),
	avatar varchar(255),
	agree boolean DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS places (
	ID bigserial PRIMARY KEY,
	owner_ID bigint NOT NULL,
	network_ID bigint DEFAULT 0,
	slug varchar (50) DEFAULT NULL,
	name varchar (50) NOT NULL,
	city bigint NOT NULL,
	address varchar(256) NOT NULL,
	lat varchar (30),
	lng varchar (30),
	phone varchar (30),
	web varchar (30),
	about text,
	additional jsonb,
	middle int,
	discount int DEFAULT 0,
	discount_begins timestamp without time zone DEFAULT null,
	discount_ends timestamp without time zone DEFAULT null,
	planing jsonb,
	logo varchar (256),
	cover_image varchar (256),
	images jsonb,
	create_date timestamp without time zone DEFAULT now(),
	verified boolean DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS menu (
	ID bigserial PRIMARY KEY,
	name varchar (256) NOT NULL,
	place_ID bigint NOT NULL,
	ordering int DEFAULT 0,
	visibility boolean DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS menu_groups (
	ID bigserial PRIMARY KEY,
	menu_ID bigint NOT NULL,
	group_ID bigint DEFAULT 0,
	name varchar (256) NOT NULL,
	ordering int DEFAULT 0,
	visibility boolean DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS menu_goods (
	ID bigserial PRIMARY KEY,
	group_ID bigint NOT NULL,
	name varchar (256) NOT NULL,
	price varchar(50) NOT NULL,
	portion jsonb,
	composition text NOT NULL,
	photo varchar (256),
	ordering int DEFAULT 0,
	visibility boolean DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS kitchen_types (
	ID bigserial PRIMARY KEY,
	slug varchar (256) NOT NULL,
	ordering int DEFAULT 0,
	visibility boolean DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS place_types (
	ID bigserial PRIMARY KEY,
	slug varchar (256) NOT NULL,
	ordering int DEFAULT 0,
	visibility boolean DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS countries (
	ID bigserial PRIMARY KEY,
	code VARCHAR (30) NOT NULL
);

CREATE TABLE IF NOT EXISTS cities (
	ID bigserial PRIMARY KEY,
	country_ID bigint NOT NULL,
	slug VARCHAR (30) NOT NULL
);

CREATE TABLE IF NOT EXISTS regions (
	ID bigserial PRIMARY KEY,
	city_ID bigint NOT NULL,
	slug VARCHAR (30) NOT NULL
);

CREATE TABLE IF NOT EXISTS subway_stations (
	ID bigserial PRIMARY KEY,
	station_name varchar (256) NOT NULL,
	city_ID bigint NOT NULL,
	ordering int DEFAULT 0,
	visibility boolean DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS news (
	ID bigserial PRIMARY KEY,
	place_ID bigint NOT NULL,
	title varchar (256) NOT NULL,
	content text NOT NULL,
	cover_image varchar (256),
	images jsonb,
	create_date timestamp without time zone DEFAULT now(),
	modify_date timestamp without time zone DEFAULT now(),
	ordering int DEFAULT 0,
	visibility boolean DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS promotions (
	ID bigserial PRIMARY KEY,
	place_ID bigint NOT NULL,
	title varchar (256) NOT NULL,
	content text NOT NULL,
	cover_image varchar (256),
	images jsonb,
	create_date timestamp without time zone DEFAULT now(),
	modify_date timestamp without time zone DEFAULT now(),
	starts timestamp without time zone NOT NULL,
	ends timestamp without time zone NOT NULL,
	only_clients boolean DEFAULT FALSE,
	ordering int DEFAULT 0,
	availability varchar (256) NOT NULL,
	visibility boolean DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS promocodes (
	ID bigserial PRIMARY KEY,
	user_ID bigint NOT NULL,
	place_ID bigint NOT NULL,
	code varchar (20) NOT NULL,
	used boolean DEFAULT FALSE,
	create_date timestamp without time zone DEFAULT now(),
	used_date timestamp without time zone DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS loyality_cards (
	ID bigserial PRIMARY KEY,
	title varchar (20) NOT NULL,
	place_ID bigint NOT NULL,
	content text NOT NULL,
	create_date timestamp without time zone DEFAULT now(),
	activity boolean DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS loyality_cards_users (
	ID bigserial PRIMARY KEY,
	user_ID bigint NOT NULL,
	fingerprint varchar (256) NOT NULL,
	card_ID bigint NOT NULL
);

CREATE TABLE IF NOT EXISTS booking (
	ID bigserial PRIMARY KEY,
	user_ID bigint DEFAULT NULL,
	place_ID bigint NOT NULL,
	create_date timestamp without time zone DEFAULT now(),
	place_number VARCHAR (50),
	persons_number int NOT NULL,
	code varchar (20),
	book_date timestamp without time zone NOT NULL,
	used boolean DEFAULT FALSE,
	approved boolean DEFAULT FALSE,
	reject boolean DEFAULT FALSE,
	reject_user int DEFAULT 0,
	phone varchar (30),
	name varchar (30),
	comment text,
	used_date timestamp without time zone DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS network (
	ID bigserial PRIMARY KEY,
	user_ID bigint NOT NULL,
	name varchar (256) NOT NULL,
	logo varchar (256),
	create_date timestamp without time zone DEFAULT now(),
	verified boolean DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS workers (
	ID bigserial PRIMARY KEY,
	place_ID bigint NOT NULL,
	user_ID bigint DEFAULT NULL,
	first_name varchar (50),
	last_name varchar (50),
	position varchar (50),
	photo varchar (50),
	visibility boolean DEFAULT TRUE
);


CREATE TABLE IF NOT EXISTS worker_reviews (
	ID bigserial PRIMARY KEY,
	worker_ID bigint NOT NULL,
	user_ID bigint NOT NULL,
	review text NOT NULL,
	answer text DEFAULT NULL,
	rating int NOT NULL,
	create_date timestamp without time zone DEFAULT now(),
	answer_date timestamp without time zone DEFAULT NULL,
	published boolean DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS reviews (
	ID bigserial PRIMARY KEY,
	place_ID bigint NOT NULL,
	user_ID bigint NOT NULL,
	review text NOT NULL,
	answer text DEFAULT NULL,
	create_date timestamp without time zone DEFAULT now(),
	answer_date timestamp without time zone DEFAULT NULL,
	published boolean DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS ratings (
	ID bigserial PRIMARY KEY,
	place_ID bigint NOT NULL,
	user_ID bigint NOT NULL,
	kitchen int DEFAULT 0,
	place int DEFAULT 0,
	service int DEFAULT 0,
	total float DEFAULT 0
);

CREATE TABLE IF NOT EXISTS chat (
	ID bigserial PRIMARY KEY,
	place_ID bigint NOT NULL,
	user_ID bigint NOT NULL,
	side int DEFAULT 0,
	message text,
	create_date timestamp without time zone DEFAULT now(),
	read_date timestamp without time zone DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS places_kitchen_types
(
	ID bigserial PRIMARY KEY,
	place_ID bigint NOT NULL,
	kitchen_type_ID bigint NOT NULL
);

CREATE TABLE IF NOT EXISTS places_place_types
(
	ID bigserial PRIMARY KEY,
	place_ID bigint NOT NULL,
	place_type_ID bigint NOT NULL
);

CREATE TABLE IF NOT EXISTS places_subway_stations
(
	ID bigserial PRIMARY KEY,
	place_ID bigint NOT NULL,
	subway_station_ID bigint NOT NULL
);

CREATE TABLE IF NOT EXISTS places_regions
(
	ID bigserial PRIMARY KEY,
	place_ID bigint NOT NULL,
	region_ID bigint NOT NULL
);

CREATE TABLE IF NOT EXISTS visitors
(
	ID bigserial PRIMARY KEY,
	place_ID bigint NOT NULL,
	user_ID bigint NOT NULL
);

CREATE TABLE IF NOT EXISTS page_visitors
(
	ID bigserial PRIMARY KEY,
	place_ID bigint NOT NULL,
	ip varchar (256),
	visit_date timestamp without time zone DEFAULT now()
);

CREATE TABLE IF NOT EXISTS article_visitors
(
	ID bigserial PRIMARY KEY,
	item_ID bigint NOT NULL,
	ip varchar (256),
	visit_date timestamp without time zone DEFAULT now()
);

CREATE TABLE IF NOT EXISTS auth
(
	ID bigserial PRIMARY KEY,
	user_ID bigint NOT NULL,
	token varchar (256),
	create_date timestamp without time zone DEFAULT now(),
	expires timestamp without time zone DEFAULT (now() + INTERVAL '1 day')
);

CREATE TABLE IF NOT EXISTS notifications (
	ID bigserial PRIMARY KEY,
	user_ID bigint NOT NULL,
	place_ID bigint NOT NULL,
	target_ID bigint NOT NULL,
	notification text NOT NULL,
	not_table varchar (256) NOT NULL,
	create_date timestamp without time zone DEFAULT now(),
	viewed boolean DEFAULT FALSE,
	autoremove boolean DEFAULT FALSE
);

INSERT INTO countries(code) VALUES ('RUS');
INSERT INTO cities(country_ID, slug) VALUES (1, 'Москва');
INSERT INTO users (email, password, user_type, phone) VALUES ('office@aliveliyev.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', '+79850956582');
INSERT INTO users (email, password, user_type) VALUES ('restoran-bdk@yandex.ru', '21232f297a57a5a743894a0e4a801fc3', 'company');
INSERT INTO users (email, password, user_type, first_name, last_name) VALUES ('menuman.global@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'client', 'Али', 'Велиев');
INSERT INTO places (owner_id, slug, name, city, address, lat, lng, phone, web, about, additional, middle, discount, discount_begins, discount_ends, planing, logo, cover_image, images, create_date, verified) VALUES (2, 'bakinskiy.dvorik', 'Бакинский дворик', 1, 'ул. Русаковская, д. 23',	'55.752420', '37.623142', '+74957779197', 'http://www.bakinsky-dvorik.ru/', 'Ресторан "Бакинский Дворик" приглашает вас вкусно покушать и приятно провести время в компании друзей и знакомых. Здесь вы всегда сможете отметить любое торжество! Атмосфера в ресторане очень гостеприимная и радушная. Официанты, облаченные в национальные костюмы, помогут вам не потеряться среди разнообразия горячих блюд и закусок и предложат оценить блюда, способные удивить даже самого искушенного гурмана. Каждый вечер, певцы ресторана радуют своим разнообразным репертуаром. Мы работаем 24 часа.',	'["Бесплатный Wi-Fi", "Есть парковка"]', 2400, 0, null, null, null, '', 'И2.jpg', '["И2.jpg", "И6.jpg"]',	'2017-12-27 00:32:34.967897+00', true);
INSERT INTO places (owner_id, slug, name, city, address, lat, lng, phone, web, about, additional, middle, discount, discount_begins, discount_ends, planing, logo, cover_image, images, create_date, verified) VALUES (2, 'bakinskiy.dvorik2', 'Бакинский дворик 2', 1, 'ул. Русаковская, д. 23',	'55.752420', '37.623142', '+74957779197', 'http://www.bakinsky-dvorik.ru/', 'Ресторан "Бакинский Дворик" приглашает вас вкусно покушать и приятно провести время в компании друзей и знакомых. Здесь вы всегда сможете отметить любое торжество! Атмосфера в ресторане очень гостеприимная и радушная. Официанты, облаченные в национальные костюмы, помогут вам не потеряться среди разнообразия горячих блюд и закусок и предложат оценить блюда, способные удивить даже самого искушенного гурмана. Каждый вечер, певцы ресторана радуют своим разнообразным репертуаром. Мы работаем 24 часа.',	'["Бесплатный Wi-Fi", "Есть парковка"]', 1500, 0, null, null, null, '', 'И2.jpg', '["И2.jpg", "И6.jpg"]',	'2017-12-27 00:32:34.967897+00', true);
INSERT INTO places (owner_id, slug, name, city, address, lat, lng, phone, web, about, additional, middle, discount, discount_begins, discount_ends, planing, logo, cover_image, images, create_date, verified) VALUES (2, 'bakinskiy.dvorik3', 'Бакинский дворик 3', 1, 'ул. Русаковская, д. 23',	'55.752420', '37.623142', '+74957779197', 'http://www.bakinsky-dvorik.ru/', 'Ресторан "Бакинский Дворик" приглашает вас вкусно покушать и приятно провести время в компании друзей и знакомых. Здесь вы всегда сможете отметить любое торжество! Атмосфера в ресторане очень гостеприимная и радушная. Официанты, облаченные в национальные костюмы, помогут вам не потеряться среди разнообразия горячих блюд и закусок и предложат оценить блюда, способные удивить даже самого искушенного гурмана. Каждый вечер, певцы ресторана радуют своим разнообразным репертуаром. Мы работаем 24 часа.',	'["Бесплатный Wi-Fi", "Есть парковка"]', 4355, 0, null, null, null, '', 'И2.jpg', '["И2.jpg", "И6.jpg"]',	'2017-12-27 00:32:34.967897+00', true);
INSERT INTO places (owner_id, slug, name, city, address, lat, lng, phone, web, about, additional, middle, discount, discount_begins, discount_ends, planing, logo, cover_image, images, create_date, verified) VALUES (2, 'bakinskiy.dvorik4', 'Бакинский дворик 4', 1, 'ул. Русаковская, д. 23',	'55.752420', '37.623142', '+74957779197', 'http://www.bakinsky-dvorik.ru/', 'Ресторан "Бакинский Дворик" приглашает вас вкусно покушать и приятно провести время в компании друзей и знакомых. Здесь вы всегда сможете отметить любое торжество! Атмосфера в ресторане очень гостеприимная и радушная. Официанты, облаченные в национальные костюмы, помогут вам не потеряться среди разнообразия горячих блюд и закусок и предложат оценить блюда, способные удивить даже самого искушенного гурмана. Каждый вечер, певцы ресторана радуют своим разнообразным репертуаром. Мы работаем 24 часа.',	'["Бесплатный Wi-Fi", "Есть парковка"]', 5324, 0, null, null, null, '', 'И2.jpg', '["И2.jpg", "И6.jpg"]',	'2017-12-27 00:32:34.967897+00', true);
INSERT INTO places (owner_id, slug, name, city, address, lat, lng, phone, web, about, additional, middle, discount, discount_begins, discount_ends, planing, logo, cover_image, images, create_date, verified) VALUES (2, 'bakinskiy.dvorik5', 'Бакинский дворик 5', 1, 'ул. Русаковская, д. 23',	'55.752420', '37.623142', '+74957779197', 'http://www.bakinsky-dvorik.ru/', 'Ресторан "Бакинский Дворик" приглашает вас вкусно покушать и приятно провести время в компании друзей и знакомых. Здесь вы всегда сможете отметить любое торжество! Атмосфера в ресторане очень гостеприимная и радушная. Официанты, облаченные в национальные костюмы, помогут вам не потеряться среди разнообразия горячих блюд и закусок и предложат оценить блюда, способные удивить даже самого искушенного гурмана. Каждый вечер, певцы ресторана радуют своим разнообразным репертуаром. Мы работаем 24 часа.',	'["Бесплатный Wi-Fi", "Есть парковка"]', 1000, 0, null, null, null, '', 'И2.jpg', '["И2.jpg", "И6.jpg"]',	'2017-12-27 00:32:34.967897+00', true);
INSERT INTO places (owner_id, slug, name, city, address, lat, lng, phone, web, about, additional, middle, discount, discount_begins, discount_ends, planing, logo, cover_image, images, create_date, verified) VALUES (2, 'bakinskiy.dvorik6', 'Бакинский дворик 6', 1, 'ул. Русаковская, д. 23',	'55.752420', '37.623142', '+74957779197', 'http://www.bakinsky-dvorik.ru/', 'Ресторан "Бакинский Дворик" приглашает вас вкусно покушать и приятно провести время в компании друзей и знакомых. Здесь вы всегда сможете отметить любое торжество! Атмосфера в ресторане очень гостеприимная и радушная. Официанты, облаченные в национальные костюмы, помогут вам не потеряться среди разнообразия горячих блюд и закусок и предложат оценить блюда, способные удивить даже самого искушенного гурмана. Каждый вечер, певцы ресторана радуют своим разнообразным репертуаром. Мы работаем 24 часа.',	'["Бесплатный Wi-Fi", "Есть парковка"]', 1200, 0, null, null, null, '', 'И2.jpg', '["И2.jpg", "И6.jpg"]',	'2017-12-27 00:32:34.967897+00', true);
INSERT INTO places_subway_stations (place_ID, subway_station_ID) VALUES (1, 4);
INSERT INTO places_place_types (place_ID, place_type_ID) VALUES (1, 3);
INSERT INTO places_place_types (place_ID, place_type_ID) VALUES (1, 26);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (1, 5);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (1, 27);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (1, 53);

INSERT INTO places_subway_stations (place_ID, subway_station_ID) VALUES (2, 4);
INSERT INTO places_place_types (place_ID, place_type_ID) VALUES (2, 3);
INSERT INTO places_place_types (place_ID, place_type_ID) VALUES (2, 26);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (2, 5);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (2, 27);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (2, 53);

INSERT INTO places_subway_stations (place_ID, subway_station_ID) VALUES (3, 4);
INSERT INTO places_place_types (place_ID, place_type_ID) VALUES (3, 3);
INSERT INTO places_place_types (place_ID, place_type_ID) VALUES (3, 26);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (3, 5);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (3, 27);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (3, 53);

INSERT INTO places_subway_stations (place_ID, subway_station_ID) VALUES (4, 4);
INSERT INTO places_place_types (place_ID, place_type_ID) VALUES (4, 3);
INSERT INTO places_place_types (place_ID, place_type_ID) VALUES (4, 26);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (4, 5);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (4, 27);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (4, 53);

INSERT INTO places_subway_stations (place_ID, subway_station_ID) VALUES (5, 4);
INSERT INTO places_place_types (place_ID, place_type_ID) VALUES (5, 3);
INSERT INTO places_place_types (place_ID, place_type_ID) VALUES (5, 26);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (5, 5);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (5, 27);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (5, 53);

INSERT INTO places_subway_stations (place_ID, subway_station_ID) VALUES (6, 4);
INSERT INTO places_place_types (place_ID, place_type_ID) VALUES (6, 3);
INSERT INTO places_place_types (place_ID, place_type_ID) VALUES (6, 26);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (6, 5);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (6, 27);
INSERT INTO places_kitchen_types (place_ID, kitchen_type_ID) VALUES (6, 53);



INSERT INTO menu (name, place_ID) VALUES ('Основное меню', 1);
INSERT INTO menu (name, place_ID) VALUES ('Основное меню', 2);
INSERT INTO menu (name, place_ID) VALUES ('Основное меню', 3);
INSERT INTO menu (name, place_ID) VALUES ('Основное меню', 4);
INSERT INTO menu (name, place_ID) VALUES ('Основное меню', 5);
INSERT INTO menu (name, place_ID) VALUES ('Основное меню', 6);


INSERT INTO menu_groups (menu_ID, name) VALUES (1, 'Завтраки');
INSERT INTO menu_groups (menu_ID, name) VALUES (2, 'Завтраки');
INSERT INTO menu_groups (menu_ID, name) VALUES (3, 'Завтраки');
INSERT INTO menu_groups (menu_ID, name) VALUES (4, 'Завтраки');
INSERT INTO menu_groups (menu_ID, name) VALUES (5, 'Завтраки');
INSERT INTO menu_groups (menu_ID, name) VALUES (6, 'Завтраки');


INSERT INTO menu_goods (group_ID, name, price, portion, composition, photo) VALUES (1, 'Some name', '200', '{"value":"250","measure":"gr"}', 'some text', 'risovaya1.jpg');
INSERT INTO menu_goods (group_ID, name, price, portion, composition, photo) VALUES (2, 'Манная каша', '200', '{"value":"250","measure":"gr"}', 'some text', 'risovaya1.jpg');
INSERT INTO menu_goods (group_ID, name, price, portion, composition, photo) VALUES (3, 'Овсяная каша', '200', '{"value":"250","measure":"gr"}', 'some text', 'risovaya1.jpg');
INSERT INTO menu_goods (group_ID, name, price, portion, composition, photo) VALUES (4, 'Кукурузная каша', '200', '{"value":"250","measure":"gr"}', 'some text', 'risovaya1.jpg');
INSERT INTO menu_goods (group_ID, name, price, portion, composition, photo) VALUES (5, 'Белая каша', '200', '{"value":"250","measure":"gr"}', 'some text', 'risovaya1.jpg');
INSERT INTO menu_goods (group_ID, name, price, portion, composition, photo) VALUES (6, 'Красная каша', '200', '{"value":"250","measure":"gr"}', 'some text', 'risovaya1.jpg');


INSERT INTO promotions (place_ID, title, content, cover_image, images, starts, ends, availability) VALUES (1, 'test', 'test', 'И2.jpg', '["И2.jpg", "И6.jpg"]', '2017-12-27 00:32:34.967897+00', '2017-12-27 00:32:34.967897+00', '[%,%,%,%,%,%,%]');



INSERT INTO ratings (place_ID, user_ID, kitchen, place, service, total) VALUES (1, 3, 10, 10, 10, 10.0);
INSERT INTO visitors (place_ID, user_ID) VALUES (1, 3);
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв 1');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв 2');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв 4');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв');
INSERT INTO reviews (place_ID, user_ID, review) VALUES (1, 3, 'Отзыв');



/* Kitche types */
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Fusion', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Абхазская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Австрийская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Авторская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Азербайджанская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Азиатская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Азиатская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Американская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Английская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Арабская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Аргентинская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Армянская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Африканская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Баварская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Бельгийская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Бразильская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Британская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Бурятская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Венгерская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Восточная', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Вьетнамская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Греческая', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Гриль меню', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Грузинская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Датская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Домашняя', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Еврейская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Европейская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Индийская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Иранская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Ирландская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Испанская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Итальянская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Кавказская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Казахская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Китайская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Корейская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Кубинская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Латиноамериканская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Ливанская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Марокканская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Мексиканская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Молекулярная', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Монгольская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Морепродукты', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Морская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Немецкая', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Осетинская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Пакистанская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Паназиатская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Перуанская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Португальская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Прибалтийская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Русская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Сербская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Сингапурская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Скандинавская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Смешанная', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Средиземноморская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Тайская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Татарская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Тибетская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Турецкая', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Узбекская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Уйгурская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Украинская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Фаст-фуд', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Французская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('фьюжен', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Халяльная', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Черноморская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Чешская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Шведская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Швейцарская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Шотландская', 0, TRUE);
INSERT INTO kitchen_types (slug, ordering, visibility) VALUES ('Японская', 0, TRUE);
/* Place types */
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Event-агентство', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Антикафе', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Банкетный зал', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Бар', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Бильярдный клуб', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Боулинг', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Быстрое питание', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Винный ресторан/бар', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Гриль-бар', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Детский клуб', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Загородные', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Караоке клуб', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Кафе', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Кафе-пекарня', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Кейтеринг (выездное обслуживание)', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Клуб', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Кондитерская', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Кофейня', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Летнее кафе', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('На воде', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Паб', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Пивной ресторан', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Пиццерия', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('При гостинице', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Развлекательный комплекс', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Ресторан', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Спорт-бар', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Стейк-хаус', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Стриптиз клуб', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Стрит-фуд', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Суши-бар', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Чайная', 0, TRUE);
INSERT INTO place_types (slug, ordering, visibility) VALUES ('Чайный клуб', 0, TRUE);

INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Бульвар Рокоссовского', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Черкизовская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Преображенская площадь', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Сокольники', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Красносельская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Комсомольская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Красные ворота', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Чистые пруды', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Лубянка', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Охотный ряд', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Библиотека им. Ленина', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Кропоткинская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Парк Культуры', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Фрунзенская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Спортивная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Воробьёвы горы', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Университет', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Проспект Вернадского', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Юго-Западная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Красногвардейская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Домодедовская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Орехово', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Царицыно', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Кантемировская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Каширская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Каховская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Варшавская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Коломенская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Автозаводская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Павелецкая', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Новокузнецкая', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Театральная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Тверская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Маяковская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Белорусская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Динамо', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Аэропорт', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Сокол', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Войковская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Водный стадион', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Речной вокзал', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Киевская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Смоленская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Арбатская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Площадь Революции', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Курская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Бауманская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Электрозаводская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Семеновская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Партизанская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Измайловская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Первомайская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Щелковская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Александровский сад', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Студенческая', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Кутузовская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Фили', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Багратионовская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Филевский парк', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Пионерская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Кунцевская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Молодежная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Крылатское', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Новослободская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Таганская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Добрынинская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Краснопресненская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Новогиреево', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Перово', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Шоссе Энтузиастов', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Авиамоторная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Площадь Ильича', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Марксистская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Третьяковская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Медведково', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Бабушкинская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Свиблово', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Ботанический сад', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('ВДНХ', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Алексеевская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Рижская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Проспект Мира', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Сухаревская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Тургеневская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Китай-город', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Октябрьская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Шаболовская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Ленинский проспект', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Академическая', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Профсоюзная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Новые Черемушки', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Калужская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Беляево', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Коньково', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Теплый Стан', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Ясенево', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Новоясеневская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Выхино', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Рязанский проспект', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Кузьминки', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Текстильщики', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Волгоградский проспект', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Пролетарская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Кузнецкий мост', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Пушкинская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Баррикадная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Улица 1905 года', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Беговая', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Полежаевская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Октябрьское поле', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Щукинская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Тушинская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Сходненская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Планерная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Алтуфьево', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Бибирево', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Отрадное', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Владыкино', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Петровско-Разумовская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Тимирязевская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Дмитровская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Савеловская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Менделеевская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Цветной бульвар', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Чеховская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Боровицкая', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Полянка', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Серпуховская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Тульская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Нагатинская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Нагорная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Нахимовский проспект', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Севастопольская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Чертановская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Южная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Пражская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Чкаловская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Римская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Крестьянская застава', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Кожуховская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Печатники', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Волжская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Люблино', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Братиславская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Марьино', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Дубровка', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Улица Академика Янгеля', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Аннино', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Бульвар Дмитрия Донского', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Парк Победы', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Улица Старокачаловская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Улица Скобелевская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Бульвар адмирала Ушакова', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Улица Горчакова', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Бунинская аллея', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Международная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Выставочная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Строгино', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Сретенский бульвар', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Трубная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Славянский бульвар', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Улица Милашенкова', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Телецентр', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Улица Академика Королева', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Выставочный центр', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Улица Сергея Эйзенштейна', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Мякинино', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Волоколамская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Митино', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Достоевская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Марьина роща', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Зябликово', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Шипиловская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Борисово', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Алма-Атинская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Пятницкое Шоссе', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Новокосино', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Лермонтовский проспект', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Жулебино', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Битцевский парк', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Лесопарковая', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Спартак', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Деловой центр', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Тропарево', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Котельники', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Румянцево', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Технопарк', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Саларьево', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Минская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Ломоносовский проспект', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Раменки', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Бутырская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Фонвизинская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Хорошёвская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('ЦСКА', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Петровский парк', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Окружная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Ростокино', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Белокаменная', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Локомотив', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Измайлово', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Соколиная Гора', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Андроновка', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Нижегородская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Новохохловская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Угрешская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('ЗИЛ', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Верхние Котлы', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Крымская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Площадь Гагарина', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Лужники', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Деловой центр (МЦК)', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Шелепиха', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Хорошёво', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Зорге', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Панфиловская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Стрешнево', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Балтийская', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Коптево', 1, 0, TRUE);
INSERT INTO subway_stations (station_name, city_ID, ordering, visibility) VALUES ('Лихоборы', 1, 0, TRUE);