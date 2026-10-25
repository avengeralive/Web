DROP TABLE menu;
DROP TABLE menu_groups;
DROP TABLE menu_goods;

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