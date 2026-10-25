--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.6
-- Dumped by pg_dump version 9.6.6

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: auth; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE auth (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    token character varying(256),
    create_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    expires timestamp with time zone DEFAULT (timezone('utc'::text, now()) + '1 day'::interval)
);


ALTER TABLE auth OWNER TO root;

--
-- Name: auth_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE auth_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE auth_id_seq OWNER TO root;

--
-- Name: auth_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE auth_id_seq OWNED BY auth.id;


--
-- Name: booking; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE booking (
    id bigint NOT NULL,
    user_id bigint,
    place_id bigint NOT NULL,
    create_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    place_number character varying(50),
    persons_number integer NOT NULL,
    code character varying(20),
    book_date timestamp with time zone NOT NULL,
    used boolean DEFAULT false,
    approved boolean DEFAULT false,
    phone character varying(30),
    name character varying(30),
    used_date timestamp with time zone
);


ALTER TABLE booking OWNER TO root;

--
-- Name: booking_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE booking_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE booking_id_seq OWNER TO root;

--
-- Name: booking_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE booking_id_seq OWNED BY booking.id;


--
-- Name: chat; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE chat (
    id bigint NOT NULL,
    place_id bigint NOT NULL,
    user_id bigint NOT NULL,
    side integer DEFAULT 0,
    message text,
    create_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    read_date timestamp with time zone
);


ALTER TABLE chat OWNER TO root;

--
-- Name: chat_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE chat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE chat_id_seq OWNER TO root;

--
-- Name: chat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE chat_id_seq OWNED BY chat.id;


--
-- Name: cities; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE cities (
    id bigint NOT NULL,
    country_id bigint NOT NULL,
    slug character varying(30) NOT NULL
);


ALTER TABLE cities OWNER TO root;

--
-- Name: cities_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE cities_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cities_id_seq OWNER TO root;

--
-- Name: cities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE cities_id_seq OWNED BY cities.id;


--
-- Name: countries; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE countries (
    id bigint NOT NULL,
    code character varying(30) NOT NULL
);


ALTER TABLE countries OWNER TO root;

--
-- Name: countries_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE countries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE countries_id_seq OWNER TO root;

--
-- Name: countries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE countries_id_seq OWNED BY countries.id;


--
-- Name: kitchen_types; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE kitchen_types (
    id bigint NOT NULL,
    slug character varying(256) NOT NULL,
    ordering integer DEFAULT 0,
    visibility boolean DEFAULT true
);


ALTER TABLE kitchen_types OWNER TO root;

--
-- Name: kitchen_types_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE kitchen_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE kitchen_types_id_seq OWNER TO root;

--
-- Name: kitchen_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE kitchen_types_id_seq OWNED BY kitchen_types.id;


--
-- Name: loyality_cards; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE loyality_cards (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    place_id bigint NOT NULL,
    fingerprint character varying(256) NOT NULL,
    create_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    activity boolean DEFAULT true
);


ALTER TABLE loyality_cards OWNER TO root;

--
-- Name: loyality_cards_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE loyality_cards_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE loyality_cards_id_seq OWNER TO root;

--
-- Name: loyality_cards_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE loyality_cards_id_seq OWNED BY loyality_cards.id;


--
-- Name: menu; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE menu (
    id bigint NOT NULL,
    name character varying(256) NOT NULL,
    place_id bigint NOT NULL,
    ordering integer DEFAULT 0,
    visibility boolean DEFAULT true
);


ALTER TABLE menu OWNER TO root;

--
-- Name: menu_goods; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE menu_goods (
    id bigint NOT NULL,
    group_id bigint NOT NULL,
    name character varying(256) NOT NULL,
    price character varying(50) NOT NULL,
    portion jsonb,
    composition text NOT NULL,
    photo character varying(256),
    ordering integer DEFAULT 0,
    visibility boolean DEFAULT true
);


ALTER TABLE menu_goods OWNER TO root;

--
-- Name: menu_goods_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE menu_goods_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE menu_goods_id_seq OWNER TO root;

--
-- Name: menu_goods_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE menu_goods_id_seq OWNED BY menu_goods.id;


--
-- Name: menu_groups; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE menu_groups (
    id bigint NOT NULL,
    menu_id bigint NOT NULL,
    group_id bigint DEFAULT 0,
    name character varying(256) NOT NULL,
    ordering integer DEFAULT 0,
    visibility boolean DEFAULT true
);


ALTER TABLE menu_groups OWNER TO root;

--
-- Name: menu_groups_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE menu_groups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE menu_groups_id_seq OWNER TO root;

--
-- Name: menu_groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE menu_groups_id_seq OWNED BY menu_groups.id;


--
-- Name: menu_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE menu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE menu_id_seq OWNER TO root;

--
-- Name: menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE menu_id_seq OWNED BY menu.id;


--
-- Name: network; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE network (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    name character varying(256) NOT NULL,
    logo character varying(256),
    create_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    verified boolean DEFAULT false
);


ALTER TABLE network OWNER TO root;

--
-- Name: network_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE network_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE network_id_seq OWNER TO root;

--
-- Name: network_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE network_id_seq OWNED BY network.id;


--
-- Name: news; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE news (
    id bigint NOT NULL,
    place_id bigint NOT NULL,
    title character varying(256) NOT NULL,
    content character varying(256) NOT NULL,
    cover_image character varying(256),
    images jsonb,
    create_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    modify_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    ordering integer DEFAULT 0,
    visibility boolean DEFAULT true
);


ALTER TABLE news OWNER TO root;

--
-- Name: news_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE news_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE news_id_seq OWNER TO root;

--
-- Name: news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE news_id_seq OWNED BY news.id;


--
-- Name: place_types; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE place_types (
    id bigint NOT NULL,
    slug character varying(256) NOT NULL,
    ordering integer DEFAULT 0,
    visibility boolean DEFAULT true
);


ALTER TABLE place_types OWNER TO root;

--
-- Name: place_types_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE place_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE place_types_id_seq OWNER TO root;

--
-- Name: place_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE place_types_id_seq OWNED BY place_types.id;


--
-- Name: places; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE places (
    id bigint NOT NULL,
    owner_id bigint NOT NULL,
    slug character varying(50) DEFAULT NULL::character varying,
    name character varying(50) NOT NULL,
    city bigint NOT NULL,
    address character varying(256) NOT NULL,
    lat character varying(30),
    lng character varying(30),
    phone character varying(30),
    web character varying(30),
    about text,
    additional jsonb,
    middle integer,
    discount integer DEFAULT 0,
    discount_begins timestamp with time zone,
    discount_ends timestamp with time zone,
    planing jsonb,
    logo character varying(256),
    cover_image character varying(256),
    images jsonb,
    create_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    verified boolean DEFAULT false
);


ALTER TABLE places OWNER TO root;

--
-- Name: places_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE places_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE places_id_seq OWNER TO root;

--
-- Name: places_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE places_id_seq OWNED BY places.id;


--
-- Name: places_kitchen_types; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE places_kitchen_types (
    id bigint NOT NULL,
    place_id bigint NOT NULL,
    kitchen_type_id bigint NOT NULL
);


ALTER TABLE places_kitchen_types OWNER TO root;

--
-- Name: places_kitchen_types_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE places_kitchen_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE places_kitchen_types_id_seq OWNER TO root;

--
-- Name: places_kitchen_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE places_kitchen_types_id_seq OWNED BY places_kitchen_types.id;


--
-- Name: places_place_types; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE places_place_types (
    id bigint NOT NULL,
    place_id bigint NOT NULL,
    place_type_id bigint NOT NULL
);


ALTER TABLE places_place_types OWNER TO root;

--
-- Name: places_place_types_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE places_place_types_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE places_place_types_id_seq OWNER TO root;

--
-- Name: places_place_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE places_place_types_id_seq OWNED BY places_place_types.id;


--
-- Name: places_regions; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE places_regions (
    id bigint NOT NULL,
    place_id bigint NOT NULL,
    region_id bigint NOT NULL
);


ALTER TABLE places_regions OWNER TO root;

--
-- Name: places_regions_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE places_regions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE places_regions_id_seq OWNER TO root;

--
-- Name: places_regions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE places_regions_id_seq OWNED BY places_regions.id;


--
-- Name: places_subway_stations; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE places_subway_stations (
    id bigint NOT NULL,
    place_id bigint NOT NULL,
    subway_station_id bigint NOT NULL
);


ALTER TABLE places_subway_stations OWNER TO root;

--
-- Name: places_subway_stations_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE places_subway_stations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE places_subway_stations_id_seq OWNER TO root;

--
-- Name: places_subway_stations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE places_subway_stations_id_seq OWNED BY places_subway_stations.id;


--
-- Name: promocodes; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE promocodes (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    place_id bigint NOT NULL,
    code character varying(20) NOT NULL,
    used boolean DEFAULT false,
    create_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    used_date timestamp with time zone
);


ALTER TABLE promocodes OWNER TO root;

--
-- Name: promocodes_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE promocodes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE promocodes_id_seq OWNER TO root;

--
-- Name: promocodes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE promocodes_id_seq OWNED BY promocodes.id;


--
-- Name: promotions; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE promotions (
    id bigint NOT NULL,
    place_id bigint NOT NULL,
    title character varying(256) NOT NULL,
    content character varying(256) NOT NULL,
    cover_image character varying(256),
    images jsonb,
    create_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    modify_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    starts timestamp with time zone NOT NULL,
    ends timestamp with time zone NOT NULL,
    only_clients boolean DEFAULT false,
    ordering integer DEFAULT 0,
    visibility boolean DEFAULT true
);


ALTER TABLE promotions OWNER TO root;

--
-- Name: promotions_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE promotions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE promotions_id_seq OWNER TO root;

--
-- Name: promotions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE promotions_id_seq OWNED BY promotions.id;


--
-- Name: ratings; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE ratings (
    id bigint NOT NULL,
    place_id bigint NOT NULL,
    user_id bigint NOT NULL,
    kitchen integer DEFAULT 0,
    place integer DEFAULT 0,
    service integer DEFAULT 0,
    total double precision DEFAULT 0
);


ALTER TABLE ratings OWNER TO root;

--
-- Name: ratings_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE ratings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ratings_id_seq OWNER TO root;

--
-- Name: ratings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE ratings_id_seq OWNED BY ratings.id;


--
-- Name: regions; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE regions (
    id bigint NOT NULL,
    city_id bigint NOT NULL,
    slug character varying(30) NOT NULL
);


ALTER TABLE regions OWNER TO root;

--
-- Name: regions_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE regions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE regions_id_seq OWNER TO root;

--
-- Name: regions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE regions_id_seq OWNED BY regions.id;


--
-- Name: reviews; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE reviews (
    id bigint NOT NULL,
    place_id bigint NOT NULL,
    user_id bigint NOT NULL,
    review text NOT NULL,
    answer text,
    create_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    answer_date timestamp with time zone,
    published boolean DEFAULT true
);


ALTER TABLE reviews OWNER TO root;

--
-- Name: reviews_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE reviews_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reviews_id_seq OWNER TO root;

--
-- Name: reviews_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE reviews_id_seq OWNED BY reviews.id;


--
-- Name: subway_stations; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE subway_stations (
    id bigint NOT NULL,
    station_name character varying(256) NOT NULL,
    city_id bigint NOT NULL,
    ordering integer DEFAULT 0,
    visibility boolean DEFAULT true
);


ALTER TABLE subway_stations OWNER TO root;

--
-- Name: subway_stations_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE subway_stations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE subway_stations_id_seq OWNER TO root;

--
-- Name: subway_stations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE subway_stations_id_seq OWNED BY subway_stations.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE users (
    id bigint NOT NULL,
    email character varying(50) NOT NULL,
    password character varying(256) NOT NULL,
    user_type character varying(10),
    first_name character varying(50),
    last_name character varying(50),
    phone character varying(30),
    balance integer DEFAULT 0,
    registration_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    agree boolean DEFAULT false
);


ALTER TABLE users OWNER TO root;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO root;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: visitors; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE visitors (
    id bigint NOT NULL,
    place_id bigint NOT NULL,
    user_id bigint NOT NULL
);


ALTER TABLE visitors OWNER TO root;

--
-- Name: visitors_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE visitors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE visitors_id_seq OWNER TO root;

--
-- Name: visitors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE visitors_id_seq OWNED BY visitors.id;


--
-- Name: worker_reviews; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE worker_reviews (
    id bigint NOT NULL,
    worker_id bigint NOT NULL,
    user_id bigint NOT NULL,
    review text NOT NULL,
    answer text,
    rating integer NOT NULL,
    create_date timestamp with time zone DEFAULT timezone('utc'::text, now()),
    answer_date timestamp with time zone,
    published boolean DEFAULT true
);


ALTER TABLE worker_reviews OWNER TO root;

--
-- Name: worker_reviews_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE worker_reviews_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE worker_reviews_id_seq OWNER TO root;

--
-- Name: worker_reviews_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE worker_reviews_id_seq OWNED BY worker_reviews.id;


--
-- Name: workers; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE workers (
    id bigint NOT NULL,
    place_id bigint NOT NULL,
    user_id bigint,
    first_name character varying(50),
    last_name character varying(50),
    "position" character varying(50),
    photo character varying(50),
    visibility boolean DEFAULT true
);


ALTER TABLE workers OWNER TO root;

--
-- Name: workers_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE workers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE workers_id_seq OWNER TO root;

--
-- Name: workers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE workers_id_seq OWNED BY workers.id;


--
-- Name: auth id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY auth ALTER COLUMN id SET DEFAULT nextval('auth_id_seq'::regclass);


--
-- Name: booking id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY booking ALTER COLUMN id SET DEFAULT nextval('booking_id_seq'::regclass);


--
-- Name: chat id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY chat ALTER COLUMN id SET DEFAULT nextval('chat_id_seq'::regclass);


--
-- Name: cities id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY cities ALTER COLUMN id SET DEFAULT nextval('cities_id_seq'::regclass);


--
-- Name: countries id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY countries ALTER COLUMN id SET DEFAULT nextval('countries_id_seq'::regclass);


--
-- Name: kitchen_types id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY kitchen_types ALTER COLUMN id SET DEFAULT nextval('kitchen_types_id_seq'::regclass);


--
-- Name: loyality_cards id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY loyality_cards ALTER COLUMN id SET DEFAULT nextval('loyality_cards_id_seq'::regclass);


--
-- Name: menu id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY menu ALTER COLUMN id SET DEFAULT nextval('menu_id_seq'::regclass);


--
-- Name: menu_goods id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY menu_goods ALTER COLUMN id SET DEFAULT nextval('menu_goods_id_seq'::regclass);


--
-- Name: menu_groups id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY menu_groups ALTER COLUMN id SET DEFAULT nextval('menu_groups_id_seq'::regclass);


--
-- Name: network id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY network ALTER COLUMN id SET DEFAULT nextval('network_id_seq'::regclass);


--
-- Name: news id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY news ALTER COLUMN id SET DEFAULT nextval('news_id_seq'::regclass);


--
-- Name: place_types id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY place_types ALTER COLUMN id SET DEFAULT nextval('place_types_id_seq'::regclass);


--
-- Name: places id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY places ALTER COLUMN id SET DEFAULT nextval('places_id_seq'::regclass);


--
-- Name: places_kitchen_types id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY places_kitchen_types ALTER COLUMN id SET DEFAULT nextval('places_kitchen_types_id_seq'::regclass);


--
-- Name: places_place_types id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY places_place_types ALTER COLUMN id SET DEFAULT nextval('places_place_types_id_seq'::regclass);


--
-- Name: places_regions id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY places_regions ALTER COLUMN id SET DEFAULT nextval('places_regions_id_seq'::regclass);


--
-- Name: places_subway_stations id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY places_subway_stations ALTER COLUMN id SET DEFAULT nextval('places_subway_stations_id_seq'::regclass);


--
-- Name: promocodes id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY promocodes ALTER COLUMN id SET DEFAULT nextval('promocodes_id_seq'::regclass);


--
-- Name: promotions id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY promotions ALTER COLUMN id SET DEFAULT nextval('promotions_id_seq'::regclass);


--
-- Name: ratings id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY ratings ALTER COLUMN id SET DEFAULT nextval('ratings_id_seq'::regclass);


--
-- Name: regions id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY regions ALTER COLUMN id SET DEFAULT nextval('regions_id_seq'::regclass);


--
-- Name: reviews id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY reviews ALTER COLUMN id SET DEFAULT nextval('reviews_id_seq'::regclass);


--
-- Name: subway_stations id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY subway_stations ALTER COLUMN id SET DEFAULT nextval('subway_stations_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Name: visitors id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY visitors ALTER COLUMN id SET DEFAULT nextval('visitors_id_seq'::regclass);


--
-- Name: worker_reviews id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY worker_reviews ALTER COLUMN id SET DEFAULT nextval('worker_reviews_id_seq'::regclass);


--
-- Name: workers id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY workers ALTER COLUMN id SET DEFAULT nextval('workers_id_seq'::regclass);


--
-- Data for Name: auth; Type: TABLE DATA; Schema: public; Owner: root
--

COPY auth (id, user_id, token, create_date, expires) FROM stdin;
1	2	3286ab89c9a16d9c2a1071171fff0861	2017-12-27 00:36:47.857511+00	2017-12-28 00:36:47.857511+00
\.


--
-- Name: auth_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('auth_id_seq', 1, true);


--
-- Data for Name: booking; Type: TABLE DATA; Schema: public; Owner: root
--

COPY booking (id, user_id, place_id, create_date, place_number, persons_number, code, book_date, used, approved, phone, name, used_date) FROM stdin;
\.


--
-- Name: booking_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('booking_id_seq', 1, false);


--
-- Data for Name: chat; Type: TABLE DATA; Schema: public; Owner: root
--

COPY chat (id, place_id, user_id, side, message, create_date, read_date) FROM stdin;
\.


--
-- Name: chat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('chat_id_seq', 1, false);


--
-- Data for Name: cities; Type: TABLE DATA; Schema: public; Owner: root
--

COPY cities (id, country_id, slug) FROM stdin;
1	1	Москва
\.


--
-- Name: cities_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('cities_id_seq', 1, true);


--
-- Data for Name: countries; Type: TABLE DATA; Schema: public; Owner: root
--

COPY countries (id, code) FROM stdin;
1	RUS
\.


--
-- Name: countries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('countries_id_seq', 1, true);


--
-- Data for Name: kitchen_types; Type: TABLE DATA; Schema: public; Owner: root
--

COPY kitchen_types (id, slug, ordering, visibility) FROM stdin;
1	Fusion	0	t
2	Абхазская	0	t
3	Австрийская	0	t
4	Авторская	0	t
5	Азербайджанская	0	t
6	Азиатская	0	t
7	Азиатская	0	t
8	Американская	0	t
9	Английская	0	t
10	Арабская	0	t
11	Аргентинская	0	t
12	Армянская	0	t
13	Африканская	0	t
14	Баварская	0	t
15	Бельгийская	0	t
16	Бразильская	0	t
17	Британская	0	t
18	Бурятская	0	t
19	Венгерская	0	t
20	Восточная	0	t
21	Вьетнамская	0	t
22	Греческая	0	t
23	Гриль меню	0	t
24	Грузинская	0	t
25	Датская	0	t
26	Домашняя	0	t
27	Еврейская	0	t
28	Европейская	0	t
29	Индийская	0	t
30	Иранская	0	t
31	Ирландская	0	t
32	Испанская	0	t
33	Итальянская	0	t
34	Кавказская	0	t
35	Казахская	0	t
36	Китайская	0	t
37	Корейская	0	t
38	Кубинская	0	t
39	Латиноамериканская	0	t
40	Ливанская	0	t
41	Марокканская	0	t
42	Мексиканская	0	t
43	Молекулярная	0	t
44	Монгольская	0	t
45	Морепродукты	0	t
46	Морская	0	t
47	Немецкая	0	t
48	Осетинская	0	t
49	Пакистанская	0	t
50	Паназиатская	0	t
51	Перуанская	0	t
52	Португальская	0	t
53	Прибалтийская	0	t
54	Русская	0	t
55	Сербская	0	t
56	Сингапурская	0	t
57	Скандинавская	0	t
58	Смешанная	0	t
59	Средиземноморская	0	t
60	Тайская	0	t
61	Татарская	0	t
62	Тибетская	0	t
63	Турецкая	0	t
64	Узбекская	0	t
65	Уйгурская	0	t
66	Украинская	0	t
67	Фаст-фуд	0	t
68	Французская	0	t
69	фьюжен	0	t
70	Халяльная	0	t
71	Черноморская	0	t
72	Чешская	0	t
73	Шведская	0	t
74	Швейцарская	0	t
75	Шотландская	0	t
76	Японская	0	t
\.


--
-- Name: kitchen_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('kitchen_types_id_seq', 76, true);


--
-- Data for Name: loyality_cards; Type: TABLE DATA; Schema: public; Owner: root
--

COPY loyality_cards (id, user_id, place_id, fingerprint, create_date, activity) FROM stdin;
\.


--
-- Name: loyality_cards_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('loyality_cards_id_seq', 1, false);


--
-- Data for Name: menu; Type: TABLE DATA; Schema: public; Owner: root
--

COPY menu (id, name, place_id, ordering, visibility) FROM stdin;
\.


--
-- Data for Name: menu_goods; Type: TABLE DATA; Schema: public; Owner: root
--

COPY menu_goods (id, group_id, name, price, portion, composition, photo, ordering, visibility) FROM stdin;
\.


--
-- Name: menu_goods_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('menu_goods_id_seq', 1, false);


--
-- Data for Name: menu_groups; Type: TABLE DATA; Schema: public; Owner: root
--

COPY menu_groups (id, menu_id, group_id, name, ordering, visibility) FROM stdin;
\.


--
-- Name: menu_groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('menu_groups_id_seq', 1, false);


--
-- Name: menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('menu_id_seq', 1, false);


--
-- Data for Name: network; Type: TABLE DATA; Schema: public; Owner: root
--

COPY network (id, user_id, name, logo, create_date, verified) FROM stdin;
\.


--
-- Name: network_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('network_id_seq', 1, false);


--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: root
--

COPY news (id, place_id, title, content, cover_image, images, create_date, modify_date, ordering, visibility) FROM stdin;
\.


--
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('news_id_seq', 1, false);


--
-- Data for Name: place_types; Type: TABLE DATA; Schema: public; Owner: root
--

COPY place_types (id, slug, ordering, visibility) FROM stdin;
1	Event-агентство	0	t
2	Антикафе	0	t
3	Банкетный зал	0	t
4	Бар	0	t
5	Бильярдный клуб	0	t
6	Боулинг	0	t
7	Быстрое питание	0	t
8	Винный ресторан/бар	0	t
9	Гриль-бар	0	t
10	Детский клуб	0	t
11	Загородные	0	t
12	Караоке клуб	0	t
13	Кафе	0	t
14	Кафе-пекарня	0	t
15	Кейтеринг (выездное обслуживание)	0	t
16	Клуб	0	t
17	Кондитерская	0	t
18	Кофейня	0	t
19	Летнее кафе	0	t
20	На воде	0	t
21	Паб	0	t
22	Пивной ресторан	0	t
23	Пиццерия	0	t
24	При гостинице	0	t
25	Развлекательный комплекс	0	t
26	Ресторан	0	t
27	Спорт-бар	0	t
28	Стейк-хаус	0	t
29	Стриптиз клуб	0	t
30	Стрит-фуд	0	t
31	Суши-бар	0	t
32	Чайная	0	t
33	Чайный клуб	0	t
\.


--
-- Name: place_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('place_types_id_seq', 33, true);


--
-- Data for Name: places; Type: TABLE DATA; Schema: public; Owner: root
--

COPY places (id, owner_id, slug, name, city, address, lat, lng, phone, web, about, additional, middle, discount, discount_begins, discount_ends, planing, logo, cover_image, images, create_date, verified) FROM stdin;
1	2	bakinskiy.dvorik	Бакинский дворик	1	ул. Русаковская, д. 23	\N	\N	+74957779197	http://www.bakinsky-dvorik.ru/	Ресторан "Бакинский Дворик" приглашает вас вкусно покушать и приятно провести время в компании друзей и знакомых. Здесь вы всегда сможете отметить любое торжество! Атмосфера в ресторане очень гостеприимная и радушная. Официанты, облаченные в национальные костюмы, помогут вам не потеряться среди разнообразия горячих блюд и закусок и предложат оценить блюда, способные удивить даже самого искушенного гурмана. Каждый вечер, певцы ресторана радуют своим разнообразным репертуаром. Мы работаем 24 часа.	["Бесплатный Wi-Fi", "Есть парковка"]	1500	0	\N	\N	null	\N	\N	null	2017-12-27 00:32:34.967897+00	f
\.


--
-- Name: places_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('places_id_seq', 1, true);


--
-- Data for Name: places_kitchen_types; Type: TABLE DATA; Schema: public; Owner: root
--

COPY places_kitchen_types (id, place_id, kitchen_type_id) FROM stdin;
1	1	5
2	1	27
4	1	76
5	1	54
\.


--
-- Name: places_kitchen_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('places_kitchen_types_id_seq', 5, true);


--
-- Data for Name: places_place_types; Type: TABLE DATA; Schema: public; Owner: root
--

COPY places_place_types (id, place_id, place_type_id) FROM stdin;
1	1	3
2	1	26
\.


--
-- Name: places_place_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('places_place_types_id_seq', 2, true);


--
-- Data for Name: places_regions; Type: TABLE DATA; Schema: public; Owner: root
--

COPY places_regions (id, place_id, region_id) FROM stdin;
\.


--
-- Name: places_regions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('places_regions_id_seq', 1, false);


--
-- Data for Name: places_subway_stations; Type: TABLE DATA; Schema: public; Owner: root
--

COPY places_subway_stations (id, place_id, subway_station_id) FROM stdin;
1	1	4
\.


--
-- Name: places_subway_stations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('places_subway_stations_id_seq', 1, true);


--
-- Data for Name: promocodes; Type: TABLE DATA; Schema: public; Owner: root
--

COPY promocodes (id, user_id, place_id, code, used, create_date, used_date) FROM stdin;
\.


--
-- Name: promocodes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('promocodes_id_seq', 1, false);


--
-- Data for Name: promotions; Type: TABLE DATA; Schema: public; Owner: root
--

COPY promotions (id, place_id, title, content, cover_image, images, create_date, modify_date, starts, ends, only_clients, ordering, visibility) FROM stdin;
\.


--
-- Name: promotions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('promotions_id_seq', 1, false);


--
-- Data for Name: ratings; Type: TABLE DATA; Schema: public; Owner: root
--

COPY ratings (id, place_id, user_id, kitchen, place, service, total) FROM stdin;
1	1	3	10	10	10	10
\.


--
-- Name: ratings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('ratings_id_seq', 1, true);


--
-- Data for Name: regions; Type: TABLE DATA; Schema: public; Owner: root
--

COPY regions (id, city_id, slug) FROM stdin;
\.


--
-- Name: regions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('regions_id_seq', 1, false);


--
-- Data for Name: reviews; Type: TABLE DATA; Schema: public; Owner: root
--

COPY reviews (id, place_id, user_id, review, answer, create_date, answer_date, published) FROM stdin;
1	1	3	Отзыв 1	\N	2017-12-27 00:32:34.981149+00	\N	t
2	1	3	Отзыв 2	\N	2017-12-27 00:32:34.982642+00	\N	t
3	1	3	Отзыв 4	\N	2017-12-27 00:32:34.983476+00	\N	t
4	1	3	Отзыв	\N	2017-12-27 00:32:34.984251+00	\N	t
5	1	3	Отзыв	\N	2017-12-27 00:32:34.985075+00	\N	t
6	1	3	Отзыв	\N	2017-12-27 00:32:34.986216+00	\N	t
7	1	3	Отзыв	\N	2017-12-27 00:32:34.987108+00	\N	t
8	1	3	Отзыв	\N	2017-12-27 00:32:34.987901+00	\N	t
9	1	3	Отзыв	\N	2017-12-27 00:32:34.988696+00	\N	t
10	1	3	Отзыв	\N	2017-12-27 00:32:34.989683+00	\N	t
11	1	3	Отзыв	\N	2017-12-27 00:32:34.990415+00	\N	t
12	1	3	Отзыв	\N	2017-12-27 00:32:34.991091+00	\N	t
13	1	3	Отзыв	\N	2017-12-27 00:32:34.992163+00	\N	t
14	1	3	Отзыв	\N	2017-12-27 00:32:34.992913+00	\N	t
15	1	3	Отзыв	\N	2017-12-27 00:32:34.993856+00	\N	t
\.


--
-- Name: reviews_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('reviews_id_seq', 15, true);


--
-- Data for Name: subway_stations; Type: TABLE DATA; Schema: public; Owner: root
--

COPY subway_stations (id, station_name, city_id, ordering, visibility) FROM stdin;
1	Бульвар Рокоссовского	1	0	t
2	Черкизовская	1	0	t
3	Преображенская площадь	1	0	t
4	Сокольники	1	0	t
5	Красносельская	1	0	t
6	Комсомольская	1	0	t
7	Красные ворота	1	0	t
8	Чистые пруды	1	0	t
9	Лубянка	1	0	t
10	Охотный ряд	1	0	t
11	Библиотека им. Ленина	1	0	t
12	Кропоткинская	1	0	t
13	Парк Культуры	1	0	t
14	Фрунзенская	1	0	t
15	Спортивная	1	0	t
16	Воробьёвы горы	1	0	t
17	Университет	1	0	t
18	Проспект Вернадского	1	0	t
19	Юго-Западная	1	0	t
20	Красногвардейская	1	0	t
21	Домодедовская	1	0	t
22	Орехово	1	0	t
23	Царицыно	1	0	t
24	Кантемировская	1	0	t
25	Каширская	1	0	t
26	Каховская	1	0	t
27	Варшавская	1	0	t
28	Коломенская	1	0	t
29	Автозаводская	1	0	t
30	Павелецкая	1	0	t
31	Новокузнецкая	1	0	t
32	Театральная	1	0	t
33	Тверская	1	0	t
34	Маяковская	1	0	t
35	Белорусская	1	0	t
36	Динамо	1	0	t
37	Аэропорт	1	0	t
38	Сокол	1	0	t
39	Войковская	1	0	t
40	Водный стадион	1	0	t
41	Речной вокзал	1	0	t
42	Киевская	1	0	t
43	Смоленская	1	0	t
44	Арбатская	1	0	t
45	Площадь Революции	1	0	t
46	Курская	1	0	t
47	Бауманская	1	0	t
48	Электрозаводская	1	0	t
49	Семеновская	1	0	t
50	Партизанская	1	0	t
51	Измайловская	1	0	t
52	Первомайская	1	0	t
53	Щелковская	1	0	t
54	Александровский сад	1	0	t
55	Студенческая	1	0	t
56	Кутузовская	1	0	t
57	Фили	1	0	t
58	Багратионовская	1	0	t
59	Филевский парк	1	0	t
60	Пионерская	1	0	t
61	Кунцевская	1	0	t
62	Молодежная	1	0	t
63	Крылатское	1	0	t
64	Новослободская	1	0	t
65	Таганская	1	0	t
66	Добрынинская	1	0	t
67	Краснопресненская	1	0	t
68	Новогиреево	1	0	t
69	Перово	1	0	t
70	Шоссе Энтузиастов	1	0	t
71	Авиамоторная	1	0	t
72	Площадь Ильича	1	0	t
73	Марксистская	1	0	t
74	Третьяковская	1	0	t
75	Медведково	1	0	t
76	Бабушкинская	1	0	t
77	Свиблово	1	0	t
78	Ботанический сад	1	0	t
79	ВДНХ	1	0	t
80	Алексеевская	1	0	t
81	Рижская	1	0	t
82	Проспект Мира	1	0	t
83	Сухаревская	1	0	t
84	Тургеневская	1	0	t
85	Китай-город	1	0	t
86	Октябрьская	1	0	t
87	Шаболовская	1	0	t
88	Ленинский проспект	1	0	t
89	Академическая	1	0	t
90	Профсоюзная	1	0	t
91	Новые Черемушки	1	0	t
92	Калужская	1	0	t
93	Беляево	1	0	t
94	Коньково	1	0	t
95	Теплый Стан	1	0	t
96	Ясенево	1	0	t
97	Новоясеневская	1	0	t
98	Выхино	1	0	t
99	Рязанский проспект	1	0	t
100	Кузьминки	1	0	t
101	Текстильщики	1	0	t
102	Волгоградский проспект	1	0	t
103	Пролетарская	1	0	t
104	Кузнецкий мост	1	0	t
105	Пушкинская	1	0	t
106	Баррикадная	1	0	t
107	Улица 1905 года	1	0	t
108	Беговая	1	0	t
109	Полежаевская	1	0	t
110	Октябрьское поле	1	0	t
111	Щукинская	1	0	t
112	Тушинская	1	0	t
113	Сходненская	1	0	t
114	Планерная	1	0	t
115	Алтуфьево	1	0	t
116	Бибирево	1	0	t
117	Отрадное	1	0	t
118	Владыкино	1	0	t
119	Петровско-Разумовская	1	0	t
120	Тимирязевская	1	0	t
121	Дмитровская	1	0	t
122	Савеловская	1	0	t
123	Менделеевская	1	0	t
124	Цветной бульвар	1	0	t
125	Чеховская	1	0	t
126	Боровицкая	1	0	t
127	Полянка	1	0	t
128	Серпуховская	1	0	t
129	Тульская	1	0	t
130	Нагатинская	1	0	t
131	Нагорная	1	0	t
132	Нахимовский проспект	1	0	t
133	Севастопольская	1	0	t
134	Чертановская	1	0	t
135	Южная	1	0	t
136	Пражская	1	0	t
137	Чкаловская	1	0	t
138	Римская	1	0	t
139	Крестьянская застава	1	0	t
140	Кожуховская	1	0	t
141	Печатники	1	0	t
142	Волжская	1	0	t
143	Люблино	1	0	t
144	Братиславская	1	0	t
145	Марьино	1	0	t
146	Дубровка	1	0	t
147	Улица Академика Янгеля	1	0	t
148	Аннино	1	0	t
149	Бульвар Дмитрия Донского	1	0	t
150	Парк Победы	1	0	t
151	Улица Старокачаловская	1	0	t
152	Улица Скобелевская	1	0	t
153	Бульвар адмирала Ушакова	1	0	t
154	Улица Горчакова	1	0	t
155	Бунинская аллея	1	0	t
156	Международная	1	0	t
157	Выставочная	1	0	t
158	Строгино	1	0	t
159	Сретенский бульвар	1	0	t
160	Трубная	1	0	t
161	Славянский бульвар	1	0	t
162	Улица Милашенкова	1	0	t
163	Телецентр	1	0	t
164	Улица Академика Королева	1	0	t
165	Выставочный центр	1	0	t
166	Улица Сергея Эйзенштейна	1	0	t
167	Мякинино	1	0	t
168	Волоколамская	1	0	t
169	Митино	1	0	t
170	Достоевская	1	0	t
171	Марьина роща	1	0	t
172	Зябликово	1	0	t
173	Шипиловская	1	0	t
174	Борисово	1	0	t
175	Алма-Атинская	1	0	t
176	Пятницкое Шоссе	1	0	t
177	Новокосино	1	0	t
178	Лермонтовский проспект	1	0	t
179	Жулебино	1	0	t
180	Битцевский парк	1	0	t
181	Лесопарковая	1	0	t
182	Спартак	1	0	t
183	Деловой центр	1	0	t
184	Тропарево	1	0	t
185	Котельники	1	0	t
186	Румянцево	1	0	t
187	Технопарк	1	0	t
188	Саларьево	1	0	t
189	Минская	1	0	t
190	Ломоносовский проспект	1	0	t
191	Раменки	1	0	t
192	Бутырская	1	0	t
193	Фонвизинская	1	0	t
194	Хорошёвская	1	0	t
195	ЦСКА	1	0	t
196	Петровский парк	1	0	t
197	Окружная	1	0	t
198	Ростокино	1	0	t
199	Белокаменная	1	0	t
200	Локомотив	1	0	t
201	Измайлово	1	0	t
202	Соколиная Гора	1	0	t
203	Андроновка	1	0	t
204	Нижегородская	1	0	t
205	Новохохловская	1	0	t
206	Угрешская	1	0	t
207	ЗИЛ	1	0	t
208	Верхние Котлы	1	0	t
209	Крымская	1	0	t
210	Площадь Гагарина	1	0	t
211	Лужники	1	0	t
212	Деловой центр (МЦК)	1	0	t
213	Шелепиха	1	0	t
214	Хорошёво	1	0	t
215	Зорге	1	0	t
216	Панфиловская	1	0	t
217	Стрешнево	1	0	t
218	Балтийская	1	0	t
219	Коптево	1	0	t
220	Лихоборы	1	0	t
\.


--
-- Name: subway_stations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('subway_stations_id_seq', 220, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: root
--

COPY users (id, email, password, user_type, first_name, last_name, phone, balance, registration_date, agree) FROM stdin;
1	office@aliveliyev.com	21232f297a57a5a743894a0e4a801fc3	admin	\N	\N	\N	0	2017-12-27 00:32:34.962697+00	f
2	restoran-bdk@yandex.ru	21232f297a57a5a743894a0e4a801fc3	company	\N	\N	\N	0	2017-12-27 00:32:34.966249+00	f
3	menuman.global@gmail.com	21232f297a57a5a743894a0e4a801fc3	client	Али	Велиев	\N	0	2017-12-27 00:32:34.967063+00	f
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('users_id_seq', 3, true);


--
-- Data for Name: visitors; Type: TABLE DATA; Schema: public; Owner: root
--

COPY visitors (id, place_id, user_id) FROM stdin;
1	1	3
\.


--
-- Name: visitors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('visitors_id_seq', 1, true);


--
-- Data for Name: worker_reviews; Type: TABLE DATA; Schema: public; Owner: root
--

COPY worker_reviews (id, worker_id, user_id, review, answer, rating, create_date, answer_date, published) FROM stdin;
\.


--
-- Name: worker_reviews_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('worker_reviews_id_seq', 1, false);


--
-- Data for Name: workers; Type: TABLE DATA; Schema: public; Owner: root
--

COPY workers (id, place_id, user_id, first_name, last_name, "position", photo, visibility) FROM stdin;
\.


--
-- Name: workers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('workers_id_seq', 1, false);


--
-- Name: auth auth_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY auth
    ADD CONSTRAINT auth_pkey PRIMARY KEY (id);


--
-- Name: booking booking_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY booking
    ADD CONSTRAINT booking_pkey PRIMARY KEY (id);


--
-- Name: chat chat_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY chat
    ADD CONSTRAINT chat_pkey PRIMARY KEY (id);


--
-- Name: cities cities_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY cities
    ADD CONSTRAINT cities_pkey PRIMARY KEY (id);


--
-- Name: countries countries_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY countries
    ADD CONSTRAINT countries_pkey PRIMARY KEY (id);


--
-- Name: kitchen_types kitchen_types_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY kitchen_types
    ADD CONSTRAINT kitchen_types_pkey PRIMARY KEY (id);


--
-- Name: loyality_cards loyality_cards_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY loyality_cards
    ADD CONSTRAINT loyality_cards_pkey PRIMARY KEY (id);


--
-- Name: menu_goods menu_goods_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY menu_goods
    ADD CONSTRAINT menu_goods_pkey PRIMARY KEY (id);


--
-- Name: menu_groups menu_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY menu_groups
    ADD CONSTRAINT menu_groups_pkey PRIMARY KEY (id);


--
-- Name: menu menu_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY menu
    ADD CONSTRAINT menu_pkey PRIMARY KEY (id);


--
-- Name: network network_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY network
    ADD CONSTRAINT network_pkey PRIMARY KEY (id);


--
-- Name: news news_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


--
-- Name: place_types place_types_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY place_types
    ADD CONSTRAINT place_types_pkey PRIMARY KEY (id);


--
-- Name: places_kitchen_types places_kitchen_types_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY places_kitchen_types
    ADD CONSTRAINT places_kitchen_types_pkey PRIMARY KEY (id);


--
-- Name: places places_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY places
    ADD CONSTRAINT places_pkey PRIMARY KEY (id);


--
-- Name: places_place_types places_place_types_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY places_place_types
    ADD CONSTRAINT places_place_types_pkey PRIMARY KEY (id);


--
-- Name: places_regions places_regions_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY places_regions
    ADD CONSTRAINT places_regions_pkey PRIMARY KEY (id);


--
-- Name: places_subway_stations places_subway_stations_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY places_subway_stations
    ADD CONSTRAINT places_subway_stations_pkey PRIMARY KEY (id);


--
-- Name: promocodes promocodes_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY promocodes
    ADD CONSTRAINT promocodes_pkey PRIMARY KEY (id);


--
-- Name: promotions promotions_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY promotions
    ADD CONSTRAINT promotions_pkey PRIMARY KEY (id);


--
-- Name: ratings ratings_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY ratings
    ADD CONSTRAINT ratings_pkey PRIMARY KEY (id);


--
-- Name: regions regions_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY regions
    ADD CONSTRAINT regions_pkey PRIMARY KEY (id);


--
-- Name: reviews reviews_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY reviews
    ADD CONSTRAINT reviews_pkey PRIMARY KEY (id);


--
-- Name: subway_stations subway_stations_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY subway_stations
    ADD CONSTRAINT subway_stations_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: visitors visitors_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY visitors
    ADD CONSTRAINT visitors_pkey PRIMARY KEY (id);


--
-- Name: worker_reviews worker_reviews_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY worker_reviews
    ADD CONSTRAINT worker_reviews_pkey PRIMARY KEY (id);


--
-- Name: workers workers_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY workers
    ADD CONSTRAINT workers_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

