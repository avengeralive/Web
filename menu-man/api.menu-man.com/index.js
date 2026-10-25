var compression = require('compression');
var express = require('express');
var bodyParser = require('body-parser');
var crypto = require('crypto');
var multer = require('multer');
var randomstring = require("randomstring");
var nodemailer = require('nodemailer');
var SMTPServer = require('smtp-server').SMTPServer;
var fs = require('fs');

/*var Curl = require( 'node-libcurl' ).Curl;
var curl = new Curl();*/

var app = express();
app.use(compression());

var pgp = require("pg-promise")();
var db = pgp("postgres://root:halo354@localhost:5432/menumancom");

var upload = multer( { dest: 'temp/' } );

app.use(function (req, res, next) {
    res.setHeader('Access-Control-Allow-Origin', 'http://menu-man.com');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
    res.setHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Cache-Control");
    res.setHeader('Access-Control-Allow-Credentials', true);
    next();
});

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

app.post( '/upload', upload.single( 'file' ), function( req, res, next ) {
	var i = 0;
	var filename = req.file.originalname;
	while (fs.existsSync('../menu-man.com/uploads/' + filename)) { filename = i + '_' + req.file.originalname; i++; }
	fs.renameSync(req.file.path, '../menu-man.com/uploads/' + filename);
	req.file.originalname = filename;
	return res.status( 200 ).send( req.file );
});

app.get('/places/get', function (req, res) {	
	//	req.query = { 'city', 'order [rating/middle/discount/visitors]', 'direction [ASC/DESC]', 'limit [12]', 'offset [0/12/24/...]' }
	req.query.subway_stations = JSON.parse(req.query.subway_stations);
	req.query.place_types = JSON.parse(req.query.place_types);
	req.query.kitchen_types = JSON.parse(req.query.kitchen_types);
	req.query.place_types_count = req.query.place_types.length;
	req.query.kitchen_types_count = req.query.kitchen_types.length;
	//console.log(req.query);
	var where = '';
	if (req.query.order == 'discount') where = "p.discount_begins <= now() AND p.discount_ends >= (now() - INTERVAL '1 day') AND"
	if (req.query.subway_stations.length)
	{
		if (req.query.place_types_count)
		{
			if (req.query.kitchen_types_count)
			{
				db.any("SELECT p.ID, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT DISTINCT p1.* FROM (SELECT p6.* FROM places p6, (SELECT p5.* FROM (SELECT p4.ID, COUNT(p4.ID) as t4 FROM (SELECT p3.ID FROM (SELECT p2.ID, COUNT(p2.ID) as t2 FROM places p2, places_place_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.place_type_ID IN (${place_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${place_types_count}) p4, places_kitchen_types pkt4 WHERE pkt4.place_ID = p4.ID AND pkt4.kitchen_type_ID IN (${kitchen_types:csv}) GROUP BY p4.ID) p5 WHERE p5.t4 = ${kitchen_types_count}) p7 WHERE p6.ID = p7.ID) p1, places_subway_stations pss1 WHERE p1.ID = pss1.place_ID AND pss1.subway_station_ID IN (${subway_stations:csv})) p WHERE " + where + " p.city = ${city:value} AND lower(p.name) LIKE '%${search:value}%' ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
					res.json(data);
				}).catch(function (error) {
					res.json(error);
				});
			}
			else
			{		
				db.any("SELECT p.ID, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT DISTINCT p1.* FROM (SELECT p3.* FROM (SELECT p2.*, COUNT(p2.ID) as t2 FROM places p2, places_place_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.place_type_ID IN (${place_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${place_types_count}) p1, places_subway_stations pss1 WHERE p1.ID = pss1.place_ID AND pss1.subway_station_ID IN (${subway_stations:csv})) p WHERE " + where + " p.city = ${city:value} AND lower(p.name) LIKE '%${search:value}%'  ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
					res.json(data);
				}).catch(function (error) {
					res.json(error);
				});
			}
		}
		else if (req.query.kitchen_types_count)
		{
			db.any("SELECT p.ID, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT DISTINCT p1.* FROM (SELECT p3.* FROM (SELECT p2.*, COUNT(p2.ID) as t2 FROM places p2, places_kitchen_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.kitchen_type_ID IN (${kitchen_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${kitchen_types_count}) p1, places_subway_stations pss1 WHERE p1.ID = pss1.place_ID AND pss1.subway_station_ID IN (${subway_stations:csv})) p WHERE " + where + " p.city = ${city:value} AND lower(p.name) LIKE '%${search:value}%'  ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
		else
		{
			db.any("SELECT p.ID, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT p1.* FROM places p1, places_subway_stations pss1 WHERE p1.ID = pss1.place_ID AND pss1.subway_station_ID IN (${subway_stations:csv}) GROUP BY p1.ID) p WHERE " + where + " p.city = ${city:value} AND lower(p.name) LIKE '%${search:value}%' ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
	}
	else
	{
		if (req.query.place_types_count)
		{
			if (req.query.kitchen_types_count)
			{
				db.any("SELECT p.ID, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT p6.* FROM places p6, (SELECT p5.* FROM (SELECT p4.ID, COUNT(p4.ID) as t4 FROM (SELECT p3.ID FROM (SELECT p2.ID, COUNT(p2.ID) as t2 FROM places p2, places_place_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.place_type_ID IN (${place_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${place_types_count}) p4, places_kitchen_types pkt4 WHERE pkt4.place_ID = p4.ID AND pkt4.kitchen_type_ID IN (${kitchen_types:csv}) GROUP BY p4.ID) p5 WHERE p5.t4 = ${kitchen_types_count}) p7 WHERE p6.ID = p7.ID) p WHERE " + where + " p.city = ${city:value} AND lower(p.name) LIKE '%${search:value}%' ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
					res.json(data);
				}).catch(function (error) {
					res.json(error);
				});
			}
			else
			{		
				db.any("SELECT p.ID, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT p3.* FROM (SELECT p2.*, COUNT(p2.ID) as t2 FROM places p2, places_place_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.place_type_ID IN (${place_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${place_types_count}) p WHERE " + where + " p.city = ${city:value} AND lower(p.name) LIKE '%${search:value}%'  ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
					res.json(data);
				}).catch(function (error) {
					res.json(error);
				});
			}
		}
		else if (req.query.kitchen_types_count)
		{
			db.any("SELECT p.ID, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT p3.* FROM (SELECT p2.*, COUNT(p2.ID) as t2 FROM places p2, places_kitchen_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.kitchen_type_ID IN (${kitchen_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${kitchen_types_count}) p WHERE " + where + " p.city = ${city:value} AND lower(p.name) LIKE '%${search:value}%'  ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
		else
		{
			db.any("SELECT p.ID, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM places p WHERE " + where + " p.city = ${city:value} AND lower(p.name) LIKE '%${search:value}%' ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
	}
});

app.get('/places/getByLocation', function (req, res) {	
	//	req.query = { 'city', 'order [rating/middle/discount/visitors]', 'direction [ASC/DESC]', 'limit [12]', 'offset [0/12/24/...]' }
	req.query.subway_stations = JSON.parse(req.query.subway_stations);
	req.query.place_types = JSON.parse(req.query.place_types);
	req.query.kitchen_types = JSON.parse(req.query.kitchen_types);
	req.query.place_types_count = req.query.place_types.length;
	req.query.kitchen_types_count = req.query.kitchen_types.length;
	//console.log(req.query);
	var where = '';
	if (req.query.order == 'discount') where = "p.discount_begins <= now() AND p.discount_ends >= (now() - INTERVAL '1 day') AND"
	if (req.query.subway_stations.length)
	{
		if (req.query.place_types_count)
		{
			if (req.query.kitchen_types_count)
			{
				db.any("SELECT p.ID, ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 as dist, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT DISTINCT p1.* FROM (SELECT p6.* FROM places p6, (SELECT p5.* FROM (SELECT p4.ID, COUNT(p4.ID) as t4 FROM (SELECT p3.ID FROM (SELECT p2.ID, COUNT(p2.ID) as t2 FROM places p2, places_place_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.place_type_ID IN (${place_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${place_types_count}) p4, places_kitchen_types pkt4 WHERE pkt4.place_ID = p4.ID AND pkt4.kitchen_type_ID IN (${kitchen_types:csv}) GROUP BY p4.ID) p5 WHERE p5.t4 = ${kitchen_types_count}) p7 WHERE p6.ID = p7.ID) p1, places_subway_stations pss1 WHERE p1.ID = pss1.place_ID AND pss1.subway_station_ID IN (${subway_stations:csv})) p WHERE " + where + " p.city = ${city:value} AND ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 <= CAST(${radius:value} AS DOUBLE PRECISION) ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
					res.json(data);
				}).catch(function (error) {
					res.json(error);
				});
			}
			else
			{		
				db.any("SELECT p.ID, ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 as dist, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT DISTINCT p1.* FROM (SELECT p3.* FROM (SELECT p2.*, COUNT(p2.ID) as t2 FROM places p2, places_place_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.place_type_ID IN (${place_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${place_types_count}) p1, places_subway_stations pss1 WHERE p1.ID = pss1.place_ID AND pss1.subway_station_ID IN (${subway_stations:csv})) p WHERE " + where + " p.city = ${city:value} AND ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 <= CAST(${radius:value} AS DOUBLE PRECISION)  ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
					res.json(data);
				}).catch(function (error) {
					res.json(error);
				});
			}
		}
		else if (req.query.kitchen_types_count)
		{
			db.any("SELECT p.ID, ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 as dist, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT DISTINCT p1.* FROM (SELECT p3.* FROM (SELECT p2.*, COUNT(p2.ID) as t2 FROM places p2, places_kitchen_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.kitchen_type_ID IN (${kitchen_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${kitchen_types_count}) p1, places_subway_stations pss1 WHERE p1.ID = pss1.place_ID AND pss1.subway_station_ID IN (${subway_stations:csv})) p WHERE " + where + " p.city = ${city:value} AND ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 <= CAST(${radius:value} AS DOUBLE PRECISION)  ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
		else
		{
			db.any("SELECT p.ID, ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 as dist, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT p1.* FROM places p1, places_subway_stations pss1 WHERE p1.ID = pss1.place_ID AND pss1.subway_station_ID IN (${subway_stations:csv}) GROUP BY p1.ID) p WHERE " + where + " p.city = ${city:value} AND ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 <= CAST(${radius:value} AS DOUBLE PRECISION) ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
	}
	else
	{
		if (req.query.place_types_count)
		{
			if (req.query.kitchen_types_count)
			{
				db.any("SELECT p.ID, ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 as dist, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT p6.* FROM places p6, (SELECT p5.* FROM (SELECT p4.ID, COUNT(p4.ID) as t4 FROM (SELECT p3.ID FROM (SELECT p2.ID, COUNT(p2.ID) as t2 FROM places p2, places_place_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.place_type_ID IN (${place_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${place_types_count}) p4, places_kitchen_types pkt4 WHERE pkt4.place_ID = p4.ID AND pkt4.kitchen_type_ID IN (${kitchen_types:csv}) GROUP BY p4.ID) p5 WHERE p5.t4 = ${kitchen_types_count}) p7 WHERE p6.ID = p7.ID) p WHERE " + where + " p.city = ${city:value} AND ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 <= CAST(${radius:value} AS DOUBLE PRECISION) ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
					res.json(data);
				}).catch(function (error) {
					res.json(error);
				});
			}
			else
			{		
				db.any("SELECT p.ID, ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 as dist, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT p3.* FROM (SELECT p2.*, COUNT(p2.ID) as t2 FROM places p2, places_place_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.place_type_ID IN (${place_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${place_types_count}) p WHERE " + where + " p.city = ${city:value} AND ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 <= CAST(${radius:value} AS DOUBLE PRECISION)  ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
					res.json(data);
				}).catch(function (error) {
					res.json(error);
				});
			}
		}
		else if (req.query.kitchen_types_count)
		{
			db.any("SELECT p.ID, ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 as dist, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT p3.* FROM (SELECT p2.*, COUNT(p2.ID) as t2 FROM places p2, places_kitchen_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.kitchen_type_ID IN (${kitchen_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${kitchen_types_count}) p WHERE " + where + " p.city = ${city:value} AND ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 <= CAST(${radius:value} AS DOUBLE PRECISION)  ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
		else
		{
			db.any("SELECT p.ID, ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 as dist, p.network_ID, p.slug, p.name, p.address, p.middle, p.lat, p.lng, p.cover_image, p.discount, p.discount_begins, p.discount_ends, (SELECT json_agg(pp.*) FROM places pp WHERE pp.network_ID = p.network_ID) as network_places, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM places p WHERE " + where + " p.city = ${city:value} AND ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 <= CAST(${radius:value} AS DOUBLE PRECISION) ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
	}
});

app.get('/goods/get', function (req, res) {	
	//	req.query = { 'city', 'order [rating/middle/discount/visitors]', 'direction [ASC/DESC]', 'limit [12]', 'offset [0/12/24/...]' }
	req.query.subway_stations = JSON.parse(req.query.subway_stations);
	req.query.place_types = JSON.parse(req.query.place_types);
	req.query.kitchen_types = JSON.parse(req.query.kitchen_types);
	req.query.place_types_count = req.query.place_types.length;
	req.query.kitchen_types_count = req.query.kitchen_types.length;
	//console.log(req.query);
	if (req.query.subway_stations.length)
	{
		if (req.query.place_types_count)
		{
			if (req.query.kitchen_types_count)
			{
				db.any("SELECT mg.*, p.name as place_name, p.slug, p.lat, p.lng, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT DISTINCT p1.* FROM (SELECT p6.* FROM places p6, (SELECT p5.* FROM (SELECT p4.ID, COUNT(p4.ID) as t4 FROM (SELECT p3.ID FROM (SELECT p2.ID, COUNT(p2.ID) as t2 FROM places p2, places_place_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.place_type_ID IN (${place_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${place_types_count}) p4, places_kitchen_types pkt4 WHERE pkt4.place_ID = p4.ID AND pkt4.kitchen_type_ID IN (${kitchen_types:csv}) GROUP BY p4.ID) p5 WHERE p5.t4 = ${kitchen_types_count}) p7 WHERE p6.ID = p7.ID) p1, places_subway_stations pss1 WHERE p1.ID = pss1.place_ID AND pss1.subway_station_ID IN (${subway_stations:csv})) p, menu_goods mg, menu_groups mgr, menu m WHERE mg.group_ID = mgr.ID AND mgr.menu_ID = m.ID AND mgr.visibility IS TRUE AND mg.visibility IS TRUE AND m.visibility IS TRUE AND m.place_ID = p.ID AND p.city = ${city:value} AND (lower(mg.name) LIKE '%${search:value}%' OR lower(mgr.name) LIKE '%${search:value}%') ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
					res.json(data);
				}).catch(function (error) {
					res.json(error);
				});
			}
			else
			{		
				db.any("SELECT mg.*, p.name as place_name, p.slug, p.lat, p.lng, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT DISTINCT p1.* FROM (SELECT p3.* FROM (SELECT p2.*, COUNT(p2.ID) as t2 FROM places p2, places_place_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.place_type_ID IN (${place_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${place_types_count}) p1, places_subway_stations pss1 WHERE p1.ID = pss1.place_ID AND pss1.subway_station_ID IN (${subway_stations:csv})) p, menu_goods mg, menu_groups mgr, menu m WHERE mg.group_ID = mgr.ID AND mgr.visibility IS TRUE AND m.visibility IS TRUE AND mg.visibility IS TRUE AND mgr.menu_ID = m.ID AND m.place_ID = p.ID AND p.city = ${city:value} AND (lower(mg.name) LIKE '%${search:value}%' OR lower(mgr.name) LIKE '%${search:value}%') ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
					res.json(data);
				}).catch(function (error) {
					res.json(error);
				});
			}
		}
		else if (req.query.kitchen_types_count)
		{
			db.any("SELECT mg.*, p.name as place_name, p.slug, p.lat, p.lng, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT DISTINCT p1.* FROM (SELECT p3.* FROM (SELECT p2.*, COUNT(p2.ID) as t2 FROM places p2, places_kitchen_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.kitchen_type_ID IN (${kitchen_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${kitchen_types_count}) p1, places_subway_stations pss1 WHERE p1.ID = pss1.place_ID AND pss1.subway_station_ID IN (${subway_stations:csv})) p, menu_goods mg, menu_groups mgr, menu m WHERE mg.group_ID = mgr.ID AND mgr.visibility IS TRUE AND m.visibility IS TRUE AND mg.visibility IS TRUE AND mgr.menu_ID = m.ID AND m.place_ID = p.ID AND p.city = ${city:value} AND (lower(mg.name) LIKE '%${search:value}%' OR lower(mgr.name) LIKE '%${search:value}%') ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
		else
		{
			db.any("SELECT mg.*, p.name as place_name, p.slug, p.lat, p.lng, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT p1.* FROM places p1, places_subway_stations pss1 WHERE p1.ID = pss1.place_ID AND pss1.subway_station_ID IN (${subway_stations:csv}) GROUP BY p1.ID) p, menu_goods mg, menu_groups mgr, menu m WHERE mg.group_ID = mgr.ID AND mgr.menu_ID = m.ID AND mgr.visibility IS TRUE AND mg.visibility IS TRUE AND m.visibility IS TRUE AND m.place_ID = p.ID AND p.city = ${city:value} AND (lower(mg.name) LIKE '%${search:value}%' OR lower(mgr.name) LIKE '%${search:value}%') ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
	}
	else
	{
		if (req.query.place_types_count)
		{
			if (req.query.kitchen_types_count)
			{
				db.any("SELECT mg.*, p.name as place_name, p.slug, p.lat, p.lng, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT p6.* FROM places p6, (SELECT p5.* FROM (SELECT p4.ID, COUNT(p4.ID) as t4 FROM (SELECT p3.ID FROM (SELECT p2.ID, COUNT(p2.ID) as t2 FROM places p2, places_place_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.place_type_ID IN (${place_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${place_types_count}) p4, places_kitchen_types pkt4 WHERE pkt4.place_ID = p4.ID AND pkt4.kitchen_type_ID IN (${kitchen_types:csv}) GROUP BY p4.ID) p5 WHERE p5.t4 = ${kitchen_types_count}) p7 WHERE p6.ID = p7.ID) p, menu_goods mg, menu_groups mgr, menu m WHERE mg.group_ID = mgr.ID AND mgr.visibility IS TRUE AND mg.visibility IS TRUE AND m.visibility IS TRUE AND mgr.menu_ID = m.ID AND m.place_ID = p.ID AND p.city = ${city:value} AND (lower(mg.name) LIKE '%${search:value}%' OR lower(mgr.name) LIKE '%${search:value}%') ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
					res.json(data);
				}).catch(function (error) {
					res.json(error);
				});
			}
			else
			{		
				db.any("SELECT mg.*, p.name as place_name, p.slug, p.lat, p.lng, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT p3.* FROM (SELECT p2.*, COUNT(p2.ID) as t2 FROM places p2, places_place_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.place_type_ID IN (${place_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${place_types_count}) p, menu_goods mg, menu_groups mgr, menu m WHERE mg.group_ID = mgr.ID AND mgr.visibility IS TRUE AND m.visibility IS TRUE AND mg.visibility IS TRUE AND mgr.menu_ID = m.ID AND m.place_ID = p.ID AND p.city = ${city:value} AND (lower(mg.name) LIKE '%${search:value}%' OR lower(mgr.name) LIKE '%${search:value}%') ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
					res.json(data);
				}).catch(function (error) {
					res.json(error);
				});
			}
		}
		else if (req.query.kitchen_types_count)
		{
			db.any("SELECT mg.*, p.name as place_name, p.slug, p.lat, p.lng, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM (SELECT p3.* FROM (SELECT p2.*, COUNT(p2.ID) as t2 FROM places p2, places_kitchen_types ppt2 WHERE ppt2.place_ID = p2.ID AND ppt2.kitchen_type_ID IN (${kitchen_types:csv}) GROUP BY p2.ID) p3 WHERE p3.t2 = ${kitchen_types_count}) p, menu_goods mg, menu_groups mgr, menu m WHERE mg.group_ID = mgr.ID AND mgr.visibility IS TRUE AND m.visibility IS TRUE AND mg.visibility IS TRUE AND mgr.menu_ID = m.ID AND m.place_ID = p.ID AND p.city = ${city:value} AND (lower(mg.name) LIKE '%${search:value}%' OR lower(mgr.name) LIKE '%${search:value}%') ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
		else
		{
			db.any("SELECT mg.*, p.name as place_name, p.slug, p.lat, p.lng, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM places p, menu_goods mg, menu_groups mgr, menu m WHERE mg.group_ID = mgr.ID AND mgr.visibility IS TRUE AND mg.visibility IS TRUE AND m.visibility IS TRUE AND mgr.menu_ID = m.ID AND m.place_ID = p.ID AND p.city = ${city:value} AND (lower(mg.name) LIKE '%${search:value}%' OR lower(mgr.name) LIKE '%${search:value}%') ORDER BY ${order:name} ${direction:value} LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
	}
});

app.put('/auth/register', function (req, res) {
	req.body.password = randomstring.generate(5);
	db.none("SELECT a.ID FROM users a WHERE a.email = ${email}", req.body).then(function (data) {
		db.one("INSERT INTO users(email, password, user_type, agree) VALUES (${email}, MD5(${password}), ${user_type}, TRUE) RETURNING ID", req.body).then(function (data) {
			/*var transporter = nodemailer.createTransport({
				sendmail: true,
				newline: 'unix',
				path: '/usr/sbin/sendmail'
			});

			var mailOptions = {
				to: req.body.email,
				subject: 'Регистрация на сайте Menuman',
				text: 'Спасибо за регистрацию! Ваш пароль: ' + req.body.password
			};

			transporter.sendMail(mailOptions, function(error, info){
				if (error) {
					console.log(error);
				} else {
					console.log('Email sent: ' + info.response);
				}
			});*/  
		      /*curl.setOpt( 'URL', 'https://menuman.ru/mail.php?to=' + req.body.email + '&login=' + req.body.email + '&password=' + req.body.password );
curl.setOpt( 'FOLLOWLOCATION', true );

curl.on( 'end', function( statusCode, body, headers ) {

    console.info( statusCode );
    console.info( '---' );
    console.info( body.length );
    console.info( '---' );
    console.info( this.getInfo( 'TOTAL_TIME' ) );

    this.close();
});

curl.on( 'error', curl.close.bind( curl ) );
curl.perform();
		      */
		      
		      
			res.json(data);
		}).catch(function (error) {
			res.json(error);
		});
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/auth/login', function (req, res) {
	// req.query = { 'email', 'password'  }
	var result = {};
	db.one("SELECT ID, email, user_type FROM users WHERE email = ${email} AND password = MD5(${password})", req.query).then(function (data) {
		if (data.id) {
			result.access = true;
			result.user = data;
			var dateTime = require('node-datetime');
			var dt = dateTime.create();
			var formatted = dt.format('Y-m-d H:M:S');
			var hash = req.email + "#" + req.password + "#menuman" + formatted;
			result.token = crypto.createHash('md5').update(hash).digest("hex");
			db.none("INSERT INTO auth(user_ID, token) VALUES (${user_ID}, ${token})", { "user_ID" : data.id, "token" : result.token });
		}
		else
		{
			result.access = false;
		}
		res.json(result);
    }).catch(function (error) {
		result.access = false;
		result.error = error;
		res.json(result);
    });
});

app.get('/auth/token', function (req, res) {
	var result = {};
	db.one("SELECT user_ID FROM auth WHERE token = ${token} AND expires > now()", req.query).then(function (data) {
		if (data.user_id) {
			db.one("SELECT ID, email, user_type FROM users WHERE ID = ${ID}", { "ID" : data.user_id }).then(function (data) {
				result.access = true;
				result.user = data;
				res.json(result);
			}).catch(function (error) {
				result.access = false;
				result.error = error;
				res.json(result);
			});
		}
		else
		{
			result.access = false;
			res.json(result);
		}
    }).catch(function (error) {
		result.access = false;
		result.error = error;
		res.json(result);
    });
});

app.get('/assets/subwayStations', function (req, res) {
	// req.query = { 'city_ID' }
	db.any("SELECT ID, station_name FROM subway_stations WHERE city_ID = ${city_ID} ORDER BY station_name", req.query).then(function (data) {
		res.json(data);
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/assets/placeTypes', function (req, res) {
	db.any("SELECT * FROM place_types").then(function (data) {
		res.json(data);
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/assets/kitchenTypes', function (req, res) {
	db.any("SELECT * FROM kitchen_types").then(function (data) {
		res.json(data);
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/assets/cities', function (req, res) {
	db.any("SELECT * FROM cities WHERE country_ID = ${country_ID}", { country_ID: req.query.country_ID }).then(function (data) {
		res.json(data);
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/dashboard/places', function (req, res) {
	// req.query = { 'token'  }
	db.one("SELECT user_ID FROM auth WHERE token = ${token} AND expires > now()", req.query).then(function (data) {
		if (data.user_id) {
			db.any("SELECT *, (SELECT COUNT(v.*) FROM page_visitors v WHERE v.place_ID = p.ID) as visitors FROM places p WHERE owner_ID = ${owner_ID}", { "owner_ID" : data.user_id }).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/place', function (req, res) {
	// req.query = { 'token'  }
	db.one("SELECT p.*, (SELECT json_agg(pp.*) FROM places pp, network nn WHERE nn.ID = pp.network_ID AND pp.network_ID = p.network_ID AND (pp.ID > p.ID OR pp.ID < p.ID)) as network_places, (SELECT json_agg(n.*) FROM network n WHERE n.ID = p.network_ID) as current_network, (SELECT json_agg(ss.station_name) FROM places_subway_stations pss, subway_stations ss WHERE pss.place_ID = p.ID AND ss.ID = pss.subway_station_ID) as subway_stations, (SELECT json_agg(pt.slug) FROM places_place_types ppt, place_types pt WHERE ppt.place_ID = p.ID AND pt.ID = ppt.place_type_ID) as place_types, (SELECT json_agg(kt.slug) FROM places_kitchen_types pkt, kitchen_types kt WHERE pkt.place_ID = p.ID AND kt.ID = pkt.kitchen_type_ID) as kitchen_types, (SELECT SUM(r.total)/COUNT(r.total) FROM ratings r WHERE r.place_ID = p.ID) as rating, (SELECT SUM(r.kitchen)/COUNT(r.kitchen) FROM ratings r WHERE r.place_ID = p.ID) as rating_kitchen, (SELECT SUM(r.service)/COUNT(r.service) FROM ratings r WHERE r.place_ID = p.ID) as rating_service, (SELECT SUM(r.place)/COUNT(r.place) FROM ratings r WHERE r.place_ID = p.ID) as rating_place, ((SELECT COUNT(pc.ID) FROM promocodes pc WHERE pc.place_ID = p.ID) + (SELECT COUNT(v.ID) FROM visitors v WHERE v.place_ID = p.ID) + (SELECT COUNT(b.ID) FROM booking b WHERE b.place_ID = p.ID)) as visitors FROM places p WHERE p.slug = ${slug}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/reviews', function (req, res) {
	// req.query = { 'place_ID'  }
	db.any("SELECT r.*, u.first_name, u.last_name, u.email FROM reviews r, users u WHERE r.place_ID = ${place_id} AND r.published IS TRUE AND u.ID = r.user_ID ORDER BY r.create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/myreviews', function (req, res) {
	// req.query = { 'place_ID'  }
	db.one("SELECT user_ID FROM auth WHERE token = ${token} AND expires > now()", req.query).then(function (data) {
	    if (data.user_id) {
		req.query.user_id = data.user_id;
		db.any("SELECT r.*, p.name, p.slug FROM reviews r, places p WHERE r.place_ID = p.ID AND r.user_ID = ${user_id} ORDER BY r.create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		    res.json(data);
		}).catch(function (error) {
		    res.json(error);
		});
	    }
	}).catch(function (error) {
		res.json(error);
    });
	
});

app.get('/reviews/answered', function (req, res) {
	// req.query = { 'place_ID'  }
	db.any("SELECT r.*, u.first_name, u.last_name, u.email FROM reviews r, users u WHERE r.place_ID = ${place_id} AND r.answer_date IS NOT NULL AND u.ID = r.user_ID ORDER BY r.create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/reviews/notanswered', function (req, res) {
	// req.query = { 'place_ID'  }
	db.any("SELECT r.*, u.first_name, u.last_name, u.email FROM reviews r, users u WHERE r.place_ID = ${place_id} AND r.answer_date IS NULL AND u.ID = r.user_ID ORDER BY r.create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/news', function (req, res) {
	// req.query = { 'place_ID'  }
	db.any("SELECT * FROM news WHERE place_ID = ${place_id} AND visibility IS TRUE ORDER BY create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/promotions', function (req, res) {
	// req.query = { 'place_ID'  }
	db.any("SELECT * FROM promotions WHERE place_ID = ${place_id} AND visibility IS TRUE AND starts <= now() AND ends >= now() ORDER BY create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/promotion', function (req, res) {
	// req.query = { 'place_ID'  }
	db.any("SELECT pr.*, p.slug, p.name as place_name FROM promotions pr, places p WHERE pr.ID = ${id} AND pr.place_ID = p.ID", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/new', function (req, res) {
	// req.query = { 'place_ID'  }
	db.any("SELECT * FROM news WHERE ID = ${id}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/place', function (req, res) {
	// req.query = { 'token' , 'ID' }
	db.one("SELECT user_ID FROM auth WHERE token = ${token} AND expires > now()", req.query).then(function (data) {
		if (data.user_id) {
			db.any("SELECT * FROM places WHERE owner_ID = ${owner_ID} AND ID = {$ID}", { "owner_ID" : data.user_id, "ID" : req.query.ID }).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/dashboard/goods', function (req, res) {
	// req.query = { 'token' , 'ID' }
	db.any("SELECT mgd.* FROM menu_goods mgd, menu_groups mg, menu m WHERE m.place_ID = ${place_id} AND mg.menu_ID = m.ID AND mgd.group_ID = mg.ID ORDER BY mgd.name", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/reviews', function (req, res) {
	// req.query = { 'token' , 'place_ID' }
	db.any("SELECT r.*, u.first_name, u.last_name, u.email FROM reviews r, users u WHERE r.place_ID = ${place_id} AND u.ID = r.user_ID ORDER BY r.create_date DESC", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/futureBooks', function (req, res) {
	// req.query = { 'token' , 'place_ID' }
	db.any("SELECT * FROM booking WHERE book_date >= now() AND place_ID = ${place_id} ORDER BY book_date ASC", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/pastBooks', function (req, res) {
	// req.query = { 'token' , 'place_ID' }
	db.any("SELECT * FROM booking WHERE book_date < now() AND place_ID = ${place_id} ORDER BY book_date DESC LIMIT ${limit} OFFSET ${offset}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/checkPromo', function (req, res) {
	// req.query = { 'token' , 'place_ID' }
	db.one("SELECT a.user_ID FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id}", req.query).then(function (data) {
		if (data.user_id)
		{
			db.any("SELECT * FROM promocodes WHERE lower(code) = lower(${code}) AND place_ID = ${place_id} AND used IS FALSE AND create_date >= (now() - INTERVAL '1 day')", req.query).then(function (data) {
				if (data.length == 0) 
				{					
					res.json(false);
				}
				else 
				{
					db.none('UPDATE promocodes SET used = TRUE, used_date = now() WHERE ID = ${id}' , { 'id' : data[0].id });
					res.json(true);
				}
			}).catch(function (error) {
				res.json(error);
			});
		}	
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/checkBookingCode', function (req, res) {
	// req.query = { 'token' , 'place_ID' }
	db.one("SELECT a.user_ID FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id}", req.query).then(function (data) {
		if (data.user_id)
		{
			db.any("SELECT * FROM booking WHERE lower(code) = lower(${code}) AND place_ID = ${place_id} AND used IS FALSE AND approved IS TRUE AND reject IS FALSE", req.query).then(function (data) {
				if (data.length == 0) 
				{					
					res.json(false);
				}
				else 
				{
					db.none('UPDATE booking SET used = TRUE, used_date = now() WHERE ID = ${id}' , { 'id' : data[0].id });
					res.json(true);
				}
			}).catch(function (error) {
				res.json(error);
			});
		}	
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/usedPromos', function (req, res) {
	// req.query = { 'token' , 'place_ID' }
	db.one("SELECT a.user_ID FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id}", req.query).then(function (data) {
		if (data.user_id)
		{
			db.any("SELECT p.*, u.first_name, u.last_name, u.ID FROM promocodes p, users u WHERE u.ID = p.user_ID AND p.place_ID = ${place_id} AND p.used IS TRUE ORDER BY p.used_date DESC", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}	
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/placebyslug', function (req, res) {
	// req.query = { 'token' , 'slug' }
	db.one("SELECT user_ID FROM auth WHERE token = ${token} AND expires > now()", req.query).then(function (data) {
		if (data.user_id) {
			db.any("SELECT p.*, (SELECT json_agg(pss.subway_station_ID) FROM places_subway_stations pss WHERE pss.place_ID = p.ID) as subway_stations, (SELECT json_agg(ppt.place_type_ID) FROM places_place_types ppt WHERE ppt.place_ID = p.ID) as place_types, (SELECT json_agg(pkt.kitchen_type_ID) FROM places_kitchen_types pkt WHERE pkt.place_ID = p.ID) as kitchen_types FROM places p WHERE p.owner_ID = ${owner_ID} AND p.slug = ${slug}", { "owner_ID" : data.user_id, "slug" : req.query.slug }).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
    }).catch(function (error) {
		res.json(error);
    });
});

app.put('/places/add', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT user_ID FROM auth WHERE token = ${token} AND expires > now()", req.body).then(function (data) {
		console.log(data);
		if (data.user_id) {
			req.body.owner_ID = data.user_id;
			req.body.planing = JSON.stringify(req.body.planing);
			req.body.images = JSON.stringify(req.body.images);
			req.body.additional = JSON.stringify(req.body.additional);
			console.log(req.body);
			db.one("INSERT INTO places(owner_ID, name, city, address, lat, lng, phone, web, about, additional, middle, planing, logo, cover_image, images) VALUES (${owner_ID}, ${name}, ${city}, ${address}, ${lat}, ${lng}, ${phone}, ${web}, ${about}, ${additional}, ${middle}, ${planing}, ${logo}, ${cover_image}, ${images}) RETURNING ID", req.body).then(function (data) {
				console.log(data);
				var slug = "p" + data.id;
				db.none('UPDATE places SET slug = ${slug} WHERE ID = ${ID}' , { 'ID' : data.id, 'slug' : slug });
				for (i in req.body.subway_stations)
				{
					db.none('INSERT INTO places_subway_stations(place_ID, subway_station_ID) VALUES (${place_ID}, ${subway_station_ID})', { 'place_ID' : data.id, 'subway_station_ID' : req.body.subway_stations[i] });
				}
				for (i in req.body.place_types)
				{
					db.none('INSERT INTO places_place_types(place_ID, place_type_ID) VALUES (${place_ID}, ${place_type_ID})', { 'place_ID' : data.id, 'place_type_ID' : req.body.place_types[i] });
				}
				for (i in req.body.kitchen_types)
				{
					db.none('INSERT INTO places_kitchen_types(place_ID, kitchen_type_ID) VALUES (${place_ID}, ${kitchen_type_ID})', { 'place_ID' : data.id, 'kitchen_type_ID' : req.body.kitchen_types[i] });
				}
				res.json(data);
			}).catch(function (error) {
				console.log('124');
				console.log(error);
				console.log(er);
				res.json(error);
			});
		}
    }).catch(function (error) {
		res.json(error);
    });
});

app.post('/places/edit', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT user_ID FROM auth WHERE token = ${token} AND expires > now()", req.body).then(function (data) {
		if (data.user_id) {
			req.body.owner_ID = data.user_id;
			req.body.planing = JSON.stringify(req.body.planing);
			req.body.images = JSON.stringify(req.body.images);
			req.body.additional = JSON.stringify(req.body.additional);
			db.none("UPDATE places SET name = ${name}, city = ${city}, address = ${address}, lat = ${lat}, lng = ${lng}, phone = ${phone}, web = ${web}, about = ${about}, additional = ${additional}, middle = ${middle}, planing = ${planing}, logo = ${logo}, cover_image = ${cover_image}, images = ${images} WHERE slug = ${slug} AND owner_ID = ${owner_ID}", req.body).then(function (data) {
				req.body.subway_station = JSON.stringify(req.body.subway_station);
				db.none('DELETE FROM places_subway_stations WHERE subway_station_ID NOT IN (${subway_stations:csv})', req.body);
				db.none('DELETE FROM places_place_types WHERE place_type_ID NOT IN (${place_types:csv})', req.body);
				db.none('DELETE FROM places_kitchen_types WHERE kitchen_type_ID NOT IN (${kitchen_types:csv})', req.body);
				db.one('SELECT ID FROM places WHERE slug = ${slug}', req.body).then(function (data) {
					for (i in req.body.subway_stations)
					{
						db.none('INSERT INTO places_subway_stations(place_ID, subway_station_ID) SELECT ${place_ID}, ${subway_station_ID} WHERE NOT EXISTS (SELECT * FROM places_subway_stations WHERE place_ID = ${place_ID} AND subway_station_ID = ${subway_station_ID})', { 'place_ID' : data.id, 'subway_station_ID' : req.body.subway_stations[i] });	
					}
					for (i in req.body.place_types)
					{				
						db.none('INSERT INTO places_place_types(place_ID, place_type_ID) SELECT ${place_ID}, ${place_type_ID} WHERE NOT EXISTS (SELECT * FROM places_place_types WHERE place_ID = ${place_ID} AND place_type_ID = ${place_type_ID})', { 'place_ID' : data.id, 'place_type_ID' : req.body.place_types[i] });
					}
					for (i in req.body.kitchen_types)
					{
						db.none('INSERT INTO places_kitchen_types(place_ID, kitchen_type_ID) SELECT ${place_ID}, ${kitchen_type_ID} WHERE NOT EXISTS (SELECT * FROM places_kitchen_types WHERE place_ID = ${place_ID} AND kitchen_type_ID = ${kitchen_type_ID})', { 'place_ID' : data.id, 'kitchen_type_ID' : req.body.kitchen_types[i] });
					}
				});
				res.json(data);
			}).catch(function (error) {
				console.log(error);
				res.json(error);
			});
		}
    }).catch(function (error) {
		res.json(error);
    });
});

app.post('/dashboard/approveBooking', function (req, res) {
	// req.body = { 'token' / params }
	
	db.one("SELECT a.user_ID FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_id = a.user_id AND p.ID = ${place_id}", req.body).then(function (data) {
		console.log(data);
		if (data.user_id) {		
			db.none("UPDATE booking SET approved = TRUE WHERE ID = ${id}", req.body).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				console.log(error);
				res.json(error);
			});
		}
    }).catch(function (error) {
		res.json(error);
    });
});

app.post('/dashboard/rejectBooking', function (req, res) {
	// req.body = { 'token' / params }
	
	db.one("SELECT a.user_ID, p.owner_ID FROM auth a, places p, booking b WHERE a.token = ${token} AND a.expires > now() AND ((p.owner_ID = a.user_ID AND p.ID = ${place_id}) OR (b.user_ID = a.user_ID AND b.place_ID = p.ID)) AND b.ID = ${id}", req.body).then(function (data) {
		console.log(data);
		if (data.user_id) {		
			req.body.reject_user = data.user_id;
			req.body.owner_id = data.owner_id;
			db.one("UPDATE booking SET reject = TRUE, reject_user = ${reject_user} WHERE ID = ${id} RETURNING ${owner_id} as user_ID, place_ID", req.body).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				console.log(error);
				res.json(error);
			});
		}
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/menu', function (req, res) {
	//req.query = { 'place_id' }
	if (typeof(req.query.visibility) == 'undefined') {
	    db.any("SELECT m.*, (SELECT json_agg(x.*) FROM (SELECT mg.*, (SELECT json_agg(t.*) FROM (SELECT g1.* FROM menu_goods g1 WHERE g1.group_ID = mg.ID AND (lower(g1.name) LIKE '%${search:value}%' OR lower(mg.name) LIKE '%${search:value}%') ORDER BY g1.ordering ASC, g1.ID ASC) t) as goods, (SELECT json_agg(y.*) FROM (SELECT msg.*, (SELECT json_agg(z.*) FROM (SELECT g.* FROM menu_goods g, menu_groups msggg WHERE g.group_ID = msg.ID AND msg.group_ID = msggg.ID AND (lower(g.name) LIKE '%${search:value}%' OR lower(msg.name) LIKE '%${search:value}%' OR lower(msggg.name) LIKE '%${search:value}%') ORDER BY g.ordering ASC, g.ID ASC) z) as goods FROM menu_groups msg WHERE msg.menu_ID = m.ID AND msg.group_ID = mg.ID ORDER BY msg.ordering ASC, msg.ID ASC) y) as subgroups FROM menu_groups mg WHERE mg.menu_ID = m.ID AND mg.group_ID = 0 ORDER BY mg.ordering ASC, mg.ID ASC) x) as groups FROM menu m WHERE m.place_ID = ${place_id} ORDER BY m.ordering ASC, m.ID ASC", req.query).then(function(data) {
		    res.json(data);				
	    }).catch(function (error) {
		    res.json(error);
	    });
	}
	else {
	    db.any("SELECT m.*, (SELECT json_agg(x.*) FROM (SELECT mg.*, (SELECT json_agg(t.*) FROM (SELECT g1.* FROM menu_goods g1, menu mmmm WHERE g1.visibility IS TRUE AND g1.group_ID = mg.ID AND mg.menu_ID = mmmm.ID AND (lower(mmmm.name) LIKE '%${search:value}%' OR lower(g1.name) LIKE '%${search:value}%' OR lower(mg.name) LIKE '%${search:value}%') ORDER BY g1.ordering ASC, g1.ID ASC) t) as goods, (SELECT json_agg(y.*) FROM (SELECT msg.*, (SELECT json_agg(z.*) FROM (SELECT g.* FROM menu_goods g, menu_groups msggg, menu mmm WHERE g.visibility IS TRUE AND msggg.visibility IS TRUE AND g.group_ID = msg.ID AND msggg.menu_ID = mmm.ID AND msg.group_ID = msggg.ID AND (lower(mmm.name) LIKE '%${search:value}%' OR lower(g.name) LIKE '%${search:value}%' OR lower(msg.name) LIKE '%${search:value}%' OR lower(msggg.name) LIKE '%${search:value}%') ORDER BY g.ordering ASC, g.ID ASC) z) as goods FROM menu_groups msg WHERE msg.visibility IS TRUE AND msg.menu_ID = m.ID AND msg.group_ID = mg.ID ORDER BY msg.ordering ASC, msg.ID) y) as subgroups FROM menu_groups mg WHERE mg.menu_ID = m.ID AND mg.group_ID = 0 AND mg.visibility IS TRUE ORDER BY mg.ordering ASC, mg.ID ASC) x) as groups FROM menu m WHERE m.place_ID = ${place_id} AND m.visibility IS TRUE ORDER BY m.ordering ASC, m.ID ASC", req.query).then(function(data) {
		    res.json(data);				
	    }).catch(function (error) {
		    res.json(error);
	    });
	}
    });

app.post('/menu/save', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_id = a.user_id AND p.ID = ${place_id}", req.body).then(function (data) {
		if (data.user_id) {
			for (i in req.body.menu)
			{
				if (typeof(req.body.menu[i].id) == 'undefined')
				{
					db.one("INSERT INTO menu(name, place_ID, ordering, visibility) VALUES(${name}, ${place_id}, ${ordering}, ${visibility}) RETURNING ID, " + i + " as i", req.body.menu[i]).then(function (data) {
						for (j in req.body.menu[data.i].groups)
						{
							req.body.menu[data.i].groups[j].menu_id = data.id;
							db.one("INSERT INTO menu_groups(name, menu_ID, group_ID, ordering, visibility) VALUES(${name}, ${menu_id}, ${group_id}, ${ordering}, ${visibility}) RETURNING ID, " + data.i + " as i, " + j + " as j", req.body.menu[data.i].groups[j]).then(function (data) {
								for (k in req.body.menu[data.i].groups[data.j].subgroups)
								{
									req.body.menu[data.i].groups[data.j].subgroups[k].menu_id = req.body.menu[data.i].groups[j].menu_id;
									req.body.menu[data.i].groups[data.j].subgroups[k].group_id = data.id;
									db.one("INSERT INTO menu_groups(name, menu_ID, group_ID, ordering, visibility) VALUES(${name}, ${menu_id}, ${group_id}, ${ordering}, ${visibility}) RETURNING ID, " + data.i + " as i, " + data.j + " as j, " + k + " as k", req.body.menu[data.i].groups[data.j].subgroups[k]).then(function (data) {
										for (l in req.body.menu[data.i].groups[data.j].subgroups[data.k].goods)
										{
											req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].group_id = data.id;
											req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].portion = JSON.stringify(req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].portion);
											db.none("INSERT INTO menu_goods(name, group_ID, price, portion, composition, photo, ordering, visibility) VALUES(${name}, ${group_id}, ${price}, ${portion}, ${composition}, ${photo}, ${ordering}, ${visibility})", req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l]);	
										}
									}).catch(function (error) {
										console.log(error);
										res.json(error);
									});		
								}
								for (l in req.body.menu[data.i].groups[data.j].goods)
								{
									req.body.menu[data.i].groups[data.j].goods[l].group_id = data.id;
									req.body.menu[data.i].groups[data.j].goods[l].portion = JSON.stringify(req.body.menu[data.i].groups[data.j].goods[l].portion);
									db.none("INSERT INTO menu_goods(name, group_ID, price, portion, composition, photo, ordering, visibility) VALUES(${name}, ${group_id}, ${price}, ${portion}, ${composition}, ${photo}, ${ordering}, ${visibility})", req.body.menu[data.i].groups[data.j].goods[l]);
								}
							}).catch(function (error) {
								console.log(error);
								res.json(error);
							});
						}
					}).catch(function (error) {
						console.log(error);
						res.json(error);
					});
				}
				else
				{
					db.one("UPDATE menu SET place_ID = ${place_id}, name = ${name}, ordering = ${ordering}, visibility = ${visibility} WHERE ID = ${id} RETURNING ID, " + i + " as i", req.body.menu[i]).then(function (data) {
						for (j in req.body.menu[data.i].groups)
						{
							if (typeof(req.body.menu[data.i].groups[j].id) == 'undefined')
							{
								req.body.menu[data.i].groups[j].menu_id = req.body.menu[data.i].id;
								db.one("INSERT INTO menu_groups(name, menu_ID, group_ID, ordering, visibility) VALUES(${name}, ${menu_id}, ${group_id}, ${ordering}, ${visibility}) RETURNING ID, " + data.i + " as i, " + j + " as j", req.body.menu[data.i].groups[j]).then(function (data) {
									for (k in req.body.menu[data.i].groups[data.j].subgroups)
									{
										req.body.menu[data.i].groups[data.j].subgroups[k].menu_id = req.body.menu[data.i].groups[data.j].menu_id;
										req.body.menu[data.i].groups[data.j].subgroups[k].group_id = data.id;
										db.one("INSERT INTO menu_groups(name, menu_ID, group_ID, ordering, visibility) VALUES(${name}, ${menu_id}, ${group_id}, ${ordering}, ${visibility}) RETURNING ID, " + data.i + " as i, " + data.j + " as j, " + k + " as k", req.body.menu[data.i].groups[data.j].subgroups[k]).then(function (data) {
											for (l in req.body.menu[data.i].groups[data.j].subgroups[data.k].goods)
											{
												req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].group_id = data.id;
												req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].portion = JSON.stringify(req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].portion);
												db.none("INSERT INTO menu_goods(name, group_ID, price, portion, composition, photo, ordering, visibility) VALUES(${name}, ${group_id}, ${price}, ${portion}, ${composition}, ${photo}, ${ordering}, ${visibility})", req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l]);	
											}
										}).catch(function (error) {
											console.log(error);
											res.json(error);
										});		
									}
									for (l in req.body.menu[data.i].groups[data.j].goods)
									{
										req.body.menu[data.i].groups[data.j].goods[l].group_id = data.id;
										req.body.menu[data.i].groups[data.j].goods[l].portion = JSON.stringify(req.body.menu[data.i].groups[data.j].goods[l].portion);
										db.none("INSERT INTO menu_goods(name, group_ID, price, portion, composition, photo, ordering, visibility) VALUES(${name}, ${group_id}, ${price}, ${portion}, ${composition}, ${photo}, ${ordering}, ${visibility})", req.body.menu[data.i].groups[data.j].goods[l]);
									}
								}).catch(function (error) {
									console.log(error);
									res.json(error);
								});
							}
							else
							{
								db.one("UPDATE menu_groups SET name = ${name}, menu_ID = ${menu_id}, ordering = ${ordering}, visibility = ${visibility} WHERE ID = ${id} RETURNING " + data.i + " as i, " + j + " as j", req.body.menu[data.i].groups[j]).then(function (data) {
									for (k in req.body.menu[data.i].groups[data.j].subgroups)
									{
										if (typeof(req.body.menu[data.i].groups[data.j].subgroups[k].id) == 'undefined')
										{
											req.body.menu[data.i].groups[data.j].subgroups[k].menu_id = req.body.menu[data.i].groups[data.j].menu_id;
											req.body.menu[data.i].groups[data.j].subgroups[k].group_id = req.body.menu[data.i].groups[data.j].id;
											db.one("INSERT INTO menu_groups(name, menu_ID, group_ID, ordering, visibility) VALUES(${name}, ${menu_id}, ${group_id}, ${ordering}, ${visibility}) RETURNING ID, " + data.i + " as i, " + data.j + " as j, " + k + " as k", req.body.menu[data.i].groups[data.j].subgroups[k]).then(function (data) {
												for (l in req.body.menu[data.i].groups[data.j].subgroups[data.k].goods)
												{
													req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].group_id = data.id;
													req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].portion = JSON.stringify(req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].portion);
													db.none("INSERT INTO menu_goods(name, group_ID, price, portion, composition, photo, ordering, visibility) VALUES(${name}, ${group_id}, ${price}, ${portion}, ${composition}, ${photo}, ${ordering}, ${visibility})", req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l]);	
												}
											}).catch(function (error) {
												console.log(error);
												res.json(error);
											});
										}
										else
										{
											db.one("UPDATE menu_groups SET name = ${name}, menu_ID = ${menu_id}, ordering = ${ordering}, visibility = ${visibility} WHERE ID = ${id} RETURNING " + data.i + " as i, " + data.j + " as j, " + k + " as k", req.body.menu[data.i].groups[data.j].subgroups[k]).then(function (data) {
												for (l in req.body.menu[data.i].groups[data.j].subgroups[data.k].goods)
												{
													req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].portion = JSON.stringify(req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].portion);
													if (typeof(req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].id) == 'undefined')
													{
														req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l].group_id = req.body.menu[data.i].groups[data.j].subgroups[data.k].id;
														db.none("INSERT INTO menu_goods(name, group_ID, price, portion, composition, photo, ordering, visibility) VALUES(${name}, ${group_id}, ${price}, ${portion}, ${composition}, ${photo}, ${ordering}, ${visibility})", req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l]);	
													}
													else
													{
														db.none("UPDATE menu_goods SET name = ${name}, group_ID = ${group_id}, price = ${price}, portion = ${portion}, composition = ${composition}, photo = ${photo}, ordering = ${ordering}, visibility = ${visibility} WHERE ID = ${id}", req.body.menu[data.i].groups[data.j].subgroups[data.k].goods[l]);	
													}
												}
											}).catch(function (error) {
												console.log(error);
												res.json(error);
											});
										}
									}
									for (l in req.body.menu[data.i].groups[data.j].goods)
									{
										req.body.menu[data.i].groups[data.j].goods[l].portion = JSON.stringify(req.body.menu[data.i].groups[data.j].goods[l].portion);
										if (typeof(req.body.menu[data.i].groups[data.j].goods[l].id) == 'undefined')
										{
											req.body.menu[data.i].groups[data.j].goods[l].group_id = req.body.menu[data.i].groups[data.j].id;
											db.none("INSERT INTO menu_goods(name, group_ID, price, portion, composition, photo, ordering, visibility) VALUES(${name}, ${group_id}, ${price}, ${portion}, ${composition}, ${photo}, ${ordering}, ${visibility})", req.body.menu[data.i].groups[data.j].goods[l]);	
										}
										else
										{
											db.none("UPDATE menu_goods SET name = ${name}, group_ID = ${group_id}, price = ${price}, portion = ${portion}, composition = ${composition}, photo = ${photo}, ordering = ${ordering}, visibility = ${visibility} WHERE ID = ${id}", req.body.menu[data.i].groups[data.j].goods[l]);	
										}
									}
								}).catch(function (error) {
									console.log(error);
									res.json(error);
								});
							}
						}
					}).catch(function (error) {
						console.log(error);
						res.json(error);
					});
				}					
			}
			result.status = true;
		}
		else result.status = false;
		res.json(result);
    }).catch(function (error) {
		res.json(error);
    });
});

app.post('/reviews/unpublish', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID FROM auth a, places p, reviews r WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id} AND r.place_ID = p.ID AND r.ID = ${id}", req.body).then(function (data) {
		if (data.user_id) {
			db.none("DELETE FROM reviews WHERE ID = ${id}", req.body);
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.post('/reviews/publish', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID FROM auth a, places p, reviews r WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id} AND r.place_ID = p.ID AND r.ID = ${id}", req.body).then(function (data) {
		if (data.user_id) {
			db.none("UPDATE reviews SET published = TRUE WHERE ID = ${id}", req.body);
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.post('/reviews/saveanswer', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID FROM auth a, places p, reviews r WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id} AND r.place_ID = p.ID AND r.ID = ${id}", req.body).then(function (data) {
		if (data.user_id) {
			db.none('UPDATE reviews SET answer = ${answer}, answer_date = now() WHERE ID = ${id}', req.body);
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.post('/places/savediscount', function (req, res) {
	// req.body = { 'token' / params }
	var data = {};
	data.id = req.body.place.id;
	data.token = req.body.token;
	db.one("SELECT a.user_ID FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${id}", data).then(function (data) {
		if (data.user_id) {
			db.none('UPDATE places SET discount = ${discount}, discount_begins = ${discount_begins}, discount_ends = ${discount_ends} WHERE ID = ${id}', req.body.place);
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});


app.post('/menu/images', function (req, res) {
	for (i in req.body)
	{
		db.none("UPDATE menu_goods SET photo = ${photo} WHERE ID = ${id}", req.body[i]);
	}
	res.json(true);
});

app.put('/place/addBook', function (req, res) {
	req.body.code = randomstring.generate(5);
	db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token}", req.body).then(function (data) {
		if (data.user_id) req.body.user_id = data.user_id;
		else req.body.user_id = 0;
		db.one("INSERT INTO booking(user_ID, place_ID, persons_number, code, book_date, phone, name, comment) VALUES (${user_id}, ${place_id}, ${persons_number}, ${code}, ${book_date}, ${phone}, ${name}, ${comment}) RETURNING ID", req.body).then(function (data) {
			data.code = req.body.code;
			res.json(data);
		}).catch(function (error) {
			res.json(error);
		});
    }).catch(function (error) {
		req.body.user_id = 0;
		db.one("INSERT INTO booking(user_ID, place_ID, persons_number, code, book_date, phone, name, comment) VALUES (${user_id}, ${place_id}, ${persons_number}, ${code}, ${book_date}, ${phone}, ${name}, ${comment}) RETURNING ID", req.body).then(function (data) {
			data.code = req.body.code;
			res.json(data);
		}).catch(function (error) {
			res.json(error);
		});
    });
	
});

app.put('/place/promocode', function (req, res) {
	db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token}", req.body).then(function (data) {
		if (data.user_id) {
			req.body.code = randomstring.generate(8);
			req.body.user_id = data.user_id;
			db.one("INSERT INTO promocodes(place_ID, user_ID, code) VALUES (${place_id}, ${user_id}, ${code}) RETURNING ID", req.body).then(function (data) {
				data.code = req.body.code;
				res.json(data);
			}).catch(function (error) {
				console.log(error);
				res.json(error);
			});
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
	
	
});

app.put('/place/addReview', function (req, res) {
	db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token}", req.body).then(function (data) {
		if (data.user_id) {
			req.body.user_id = data.user_id;
			db.one("INSERT INTO reviews(place_ID, user_ID, review) VALUES (${place_id}, ${user_id}, ${review}) RETURNING ID", req.body).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				console.log(error);
				res.json(error);
			});
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/place/getUserRate', function (req, res) {
	db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token}", req.query).then(function (data) {
		if (data.user_id) {
			req.query.user_id = data.user_id;
			db.any("SELECT * FROM ratings WHERE user_ID = ${user_id} AND place_ID = ${place_id}", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(false);
    });
});

app.get('/place/getUserPromo', function (req, res) {
	db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token}", req.query).then(function (data) {
		if (data.user_id) {
			req.query.user_id = data.user_id;
			db.any("SELECT * FROM promocodes WHERE user_ID = ${user_id} AND place_ID = ${place_id} AND create_date >= (now() - INTERVAL '1 day')", req.query).then(function (data) {
				res.json(data);
			}).catch(function (error) {
				res.json(error);
			});
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(false);
    });
});

app.post('/place/rate', function (req, res) {
	db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token}", req.body).then(function (data) {
		if (data.user_id) {
			req.body.user_id = data.user_id;
			db.any("SELECT * FROM ratings WHERE user_ID = ${user_id} AND place_ID = ${place_id}", req.body).then(function (data) {
				if (data.length != 0)
				{
					req.body.id = data[0].id;
					db.none('UPDATE ratings SET kitchen = ${kitchen}, place = ${place}, service = ${service} WHERE ID = ${id}', req.body).then(function (data) {
						res.json(data);
					}).catch(function (error) {
						console.log(error);
						res.json(error);
					});
				}
				else
				{
					db.one("INSERT INTO ratings(place_ID, user_ID, kitchen, place, service) VALUES (${place_id}, ${user_id}, ${kitchen}, ${place}, ${service}) RETURNING ID", req.body).then(function (data) {
						res.json(data);
					}).catch(function (error) {
						console.log(error);
						res.json(error);
					});
				}
			}).catch(function (error) {
				console.log(error);
				res.json(error);
			});
			
			
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/dashboard/news', function (req, res) {
	// req.query = { 'token' / params }
	db.one('SELECT n.* FROM news n, auth a, places p WHERE n.ID = ${id} AND n.place_ID = p.ID AND a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID', req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.post('/dashboard/news', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id}", req.body).then(function (data) {
		if (data.user_id) {
			req.body.images = JSON.stringify(req.body.images);
			db.none('UPDATE news SET title = ${title}, content = ${content}, cover_image = ${cover_image}, images = ${images}, modify_date = now(), visibility = ${visibility} WHERE ID = ${id}', req.body);
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.put('/dashboard/news', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id}", req.body).then(function (data) {
		if (data.user_id) {
			req.body.images = JSON.stringify(req.body.images);
			db.one("INSERT INTO news(place_ID, title, content, cover_image, images, visibility) VALUES (${place_id}, ${title}, ${content}, ${cover_image}, ${images}, ${visibility}) RETURNING ID", req.body).then(function (data) {
				console.log(data);
				res.json(data);
			}).catch(function (error) {
				console.log(error);
				res.json(error);
			});
		}
		else res.json(false);
    }).catch(function (error) {
		console.log(error);
		res.json(error);
    });
});

app.get('/dashboard/promotions', function (req, res) {
	// req.query = { 'token' / params }
	db.one('SELECT n.* FROM promotions n, auth a, places p WHERE n.ID = ${id} AND n.place_ID = p.ID AND a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID', req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.post('/dashboard/promotions', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID, p.name, p.slug FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id}", req.body).then(function (data) {
		if (data.user_id) {
			req.body.images = JSON.stringify(req.body.images);
		req.body.place_name = data.name;
		    req.body.place_slug = data.slug;
			db.none('UPDATE promotions SET title = ${title}, content = ${content}, cover_image = ${cover_image}, images = ${images}, modify_date = now(), visibility = ${visibility}, starts = ${starts}, ends = ${ends}, only_clients = ${only_clients}, availability = ${availability} WHERE ID = ${id}', req.body).then(function(data) {
			   //console.log(req.body.visibility);
			 //if (req.body.only_clients) {    console.log(req.body.visibility);
			    db.any("SELECT lcu.user_ID FROM promotions pr, loyality_cards lc, loyality_cards_users lcu, places p WHERE pr.starts <= now() AND pr.ends >= now() AND pr.ID = ${id} AND pr.place_ID = p.ID AND lc.place_ID = p.ID AND lcu.card_ID = lc.ID GROUP BY lcu.user_ID", req.body).then(function (data) {
				var allreq = [];
				for (i in data)
				{
				    allreq[i] = {};
				    allreq[i].user_id = data[i].user_id;
				    allreq[i].place_id = req.body.place_id;
				    allreq[i].id = req.body.id;
				    allreq[i].notification = 'Заведение "<a href="' + req.body.place_slug + '">'+ req.body.place_name + '</a>" внесло изменения в акцию "' + req.body.title + '"';
				    db.none("INSERT INTO notifications(user_ID, place_ID, target_ID, notification, not_table) VALUES (${user_id}, ${place_id}, ${id}, ${notification}, 'promotions')", allreq[i]);
				}
				}).catch(function (error) { console.log(error);
					res.json(error);
				});
			    //}
			    res.json(data);
			}).catch(function(error) {
			    
			});
			//res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.put('/dashboard/promotions', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID, p.name, p.slug FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id}", req.body).then(function (data) {
		if (data.user_id) {
		    req.body.place_name = data.name;
		    req.body.place_slug = data.slug;
			req.body.images = JSON.stringify(req.body.images);
			db.one("INSERT INTO promotions(place_ID, title, content, cover_image, images, starts, ends, only_clients, visibility, availability) VALUES (${place_id}, ${title}, ${content}, ${cover_image}, ${images}, ${starts}, ${ends}, ${only_clients}, ${visibility}, ${availability}) RETURNING ID", req.body).then(function (data) {
				//console.log(data);
				req.body.id = data.id;
			    //if (req.body.visibility) {
				db.any("SELECT lcu.user_ID FROM promotions pr, loyality_cards lc, loyality_cards_users lcu, places p WHERE pr.starts <= now() AND pr.ends >= now() AND pr.ID = ${id} AND pr.place_ID = p.ID AND lc.place_ID = p.ID AND lcu.card_ID = lc.ID GROUP BY lcu.user_ID", req.body).then(function (data) {
				/*var allreq = [];
				for (i in data)
				{
				    allreq[i] = {};
				    allreq[i].user_id = data[i].user_id;
				    allreq[i].place_id = req.body.place_id;
				    allreq[i].id = req.body.id;
				    allreq[i].notification = 'Заведением "<a href="' + req.body.place_slug + '">'+ req.body.place_name + '</a>" добавлена новая акция "' + req.body.title + '"';
				    db.none("INSERT INTO notifications(user_ID, place_ID, target_ID, notification, not_table) VALUES (${user_id}, ${place_id}, ${id}, ${notification}, 'promotions')", allreq[i]);
				}*/
				
				}).catch(function (error) { console.log(error);
					res.json(error);
				});
				
			    //}
				res.json(data);
			}).catch(function (error) {
				console.log(error);
				res.json(error);
			});
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.delete('/dashboard/promotions', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID, p.ID, pr.title FROM auth a, places p, promotions pr WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id} AND pr.place_ID = p.ID AND pr.ID = ${id} ", req.query).then(function (data) {
		if (data.user_id) {
			db.none('DELETE FROM promotions WHERE ID = ${id}', req.query);
			var mydata = {};
			mydata.place_id = data.id;
			mydata.target_id = req.query.id;
			mydata.notification = 'Акция "' + data.title + '" была удалена';
			mydata.autoremove = true;
			mydata.not_table = 'promotions';
			db.any('SELECT lcu.user_ID, l.place_ID, ${target_id} as target_ID, ${notification} as notification, ${not_table} as not_table FROM loyality_cards l, loyality_cards_users lcu WHERE l.place_ID = ${place_id} AND lcu.card_ID = l.ID', mydata).then(function (data) { 
			    /*for (i in data) {
				db.none('INSERT INTO notifications(user_ID, place_ID, target_ID, notification, not_table, autoremove) VALUES (${user_id}, ${place_id}, ${target_id}, ${notification}, ${not_table}, TRUE)', data[i]);
			    }*/
			});
			
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		console.log(error);
		res.json(error);
    });
});

app.put('/notifications', function (req, res) {
	// req.body = { 'token' / params }
	db.one("INSERT INTO notifications(user_ID, place_ID, target_ID, notification, not_table) VALUES (${user_id}, ${place_id}, ${target_id}, ${notification}, ${not_table}) RETURNING ID", req.body).then(function (data) {
		//console.log(data);
		res.json(data);
	}).catch(function (error) {
		console.log(error);
		res.json(error);
	});
});

app.post('/notifications', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token} AND a.expires > now()", req.body).then(function (data) {
		if (data.user_id) {
			req.body.user_id = data.user_id;
			db.none('UPDATE notifications SET viewed = TRUE WHERE user_ID = ${user_id} AND target_ID = ${target_id} AND not_table = ${not_table}', req.body);
			db.none('UPDATE notifications SET viewed = TRUE WHERE user_ID = ${user_id} AND place_ID = ${place_id} AND not_table = ${not_table}', req.body);
			//console.log(req.body);
			if (req.body.target_id == 0 && req.body.place_id == 0) db.none('UPDATE notifications SET viewed = TRUE WHERE user_ID = ${user_id} AND not_table = ${not_table}', req.body);
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/notifications', function (req, res) {
	// req.body = { 'token' / params }
	db.any("SELECT n.*, (SELECT json_agg(pr.*) FROM promotions pr WHERE pr.ID = n.target_ID) as promotions, (SELECT json_agg(lc.*) FROM loyality_cards lc WHERE lc.ID = n.target_ID) as loyality_cards FROM notifications n WHERE n.user_ID = ${user_id} AND n.viewed IS FALSE", req.query).then(function (data) {
		//console.log(data);
		res.json(data);
	}).catch(function (error) {
		console.log(error);
		res.json(error);
	});
});

app.get('/notifications/all', function (req, res) {
	// req.body = { 'token' / params }
	db.any("SELECT n.*, (SELECT json_agg(pr.*) FROM promotions pr WHERE pr.ID = n.target_ID) as promotions, (SELECT json_agg(lc.*) FROM loyality_cards lc WHERE lc.ID = n.target_ID) as loyality_cards FROM notifications n WHERE n.user_ID = ${user_id} ORDER BY n.ID DESC", req.query).then(function (data) {
		//console.log(data);
		res.json(data);
	}).catch(function (error) {
		console.log(error);
		res.json(error);
	});
});

app.delete('/notifications', function (req, res) {
	// req.body = { 'token' / params }
	if (req.query.id) {
		db.one("SELECT a.user_ID FROM auth a, notifications n WHERE a.token = ${token} AND a.expires > now() AND n.user_ID = a.user_ID AND n.ID = ${id} ", req.query).then(function (data) {			
			if (data.user_id) {
				db.none('DELETE FROM notifications WHERE ID = ${id}', req.query);
				res.json(true);
			}
			else res.json(false);
	    }).catch(function (error) {
			console.log(error);
			res.json(error);
	    });
	}
	else if (req.query.not_table) {
		db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token} AND a.expires > now()", req.query).then(function (data) {			
			if (data.user_id) {
				req.query.user_id = data.user_id;
				db.none('DELETE FROM notifications WHERE user_id = ${user_id} AND not_table = ${not_table}', req.query);
				res.json(true);
			}
			else res.json(false);
	    }).catch(function (error) {
			console.log(error);
			res.json(error);
	    });
	}
});


app.post('/dashboard/loyality', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID, p.name, p.slug FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id}", req.body).then(function (data) {
		if (data.user_id) {
		//db.any('SELECT * FROM loyality_cards WHERE (title != ${title} OR content != ${content} OR activity != ${activity}) AND ID = ${id}', req.body).then(function(data) {
		    //if (data[0].id) {
			//db.none('UPDATE loyality_cards SET title = ${title}, content = ${content}, activity = ${activity} WHERE ID = ${id}', req.body);
			//res.json(true);
			
			req.body.place_name = data.name;
		    req.body.place_slug = data.slug;
			db.none('UPDATE loyality_cards SET title = ${title}, content = ${content}, activity = ${activity} WHERE ID = ${id}', req.body).then(function(data) {
			   //console.log(req.body.visibility);
			 //if (req.body.only_clients) {    console.log(req.body.visibility);
			    db.any("SELECT lcu.user_ID FROM loyality_cards_users lcu WHERE lcu.card_ID = ${id}", req.body).then(function (data) {
				//console.log(data);
				var allreq = [];
				for (i in data)
				{
				    allreq[i] = {};
				    allreq[i].user_id = data[i].user_id;
				    allreq[i].place_id = req.body.place_id;
				    allreq[i].id = req.body.id;
				    allreq[i].notification = 'Заведение "<a href="' + req.body.place_slug + '">'+ req.body.place_name + '</a>" внесло изменения в карту лояльности "' + req.body.title + '"';
				    db.none("INSERT INTO notifications(user_ID, place_ID, target_ID, notification, not_table) VALUES (${user_id}, ${place_id}, ${id}, ${notification}, 'loyality')", allreq[i]);
				}
				}).catch(function (error) { console.log(error);
					res.json(error);
				});
			    //}
			    res.json(data);
			}).catch(function(error) {
			    
			});
		    //}
		    //else res.json(false);
		   // });
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.put('/dashboard/loyalityuser', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID, p.slug, p.name FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id}", req.body).then(function (data) {
		if (data.user_id) {
		    req.body.place_slug = data.slug;
		    req.body.place_name = data.name;
		    db.none("SELECT * FROM loyality_cards_users WHERE user_ID = ${user_id} AND card_ID = ${card_id}", req.body).then(function (data) {
			db.one("INSERT INTO loyality_cards_users(user_ID, card_ID, fingerprint) VALUES (${user_id}, ${card_id}, ${fingerprint}) RETURNING ID", req.body).then(function (data) {
				console.log(data);
				
				db.any("SELECT ID, title FROM promotions p WHERE p.place_ID = ${place_id}", req.body).then(function (data) {
				var allreq = [];
				var mydata = {};
				mydata.user_id = req.body.user_id;
				mydata.place_id = req.body.place_id;
				mydata.id = 0;
				if (data) {
				    for (i in data)
				    {
					allreq[i] = "<a href=\"/promotions/" + data[i].id + "\">" + data[i].title + "</a>";
				    }
				    var adr = allreq.join(', ');
				    mydata.notification = 'Заведение "<a href="' + req.body.place_slug + '">'+ req.body.place_name + '</a>" предоставило Вам акции ' + adr;
				    db.none("INSERT INTO notifications(user_ID, place_ID, target_ID, notification, not_table) VALUES (${user_id}, ${place_id}, ${id}, ${notification}, 'promotions')", mydata);
				}
				    }).catch(function (error) { console.log(error);
					    res.json(error);
				    }); 
				res.json(data);
			}).catch(function (error) {
				console.log(error);
				res.json(error);
			});
		    
				
		    }).catch(function (error) {
			console.log(error);
			res.json(error);
		    });
		    req.body.fingerprint = randomstring.generate(9);
			
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.delete('/dashboard/loyality', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID, p.slug, p.name, lc.title, p.ID FROM auth a, places p, loyality_cards lc WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND lc.place_ID = p.ID AND lc.ID = ${id} ", req.query).then(function (data) {
		if (data.user_id) {
		    req.query.place_name = data.name;
		    req.query.place_slug = data.slug;
		    req.query.title = data.title;
		    req.query.place_id = data.id;
		    req.query.user_id = data.user_id;
		    var mydata = {};
		    mydata.place_id = req.query.id;
		    mydata.target_id = 0;
		    mydata.not_table = "promotions";
			db.none('DELETE FROM loyality_cards WHERE ID = ${id}', req.query);
			db.any('SELECT * FROM promotions WHERE place_ID = ${place_id}', req.query).then(function (data) { 
			    var arr = [];
			    if (data) {
				for (j in data) {
				    arr[j] = "<a href=\"/promotions/" + data[j].id + "\">" + data[j].title + "</a>";
				}
				var act = arr.join(', ');
				mydata.notification = 'Заведение "<a href="' + req.query.place_slug + '">'+ req.query.place_name + '</a>" удалило акции ' + act + ' в связи с удалением карты лояльности';
			    }
			});
			db.any("SELECT lcu.user_ID FROM loyality_cards_users lcu WHERE lcu.card_ID = ${id}", req.query).then(function (data) {
				var allreq = [];
				for (i in data)
				{
				    allreq[i] = {};
				    allreq[i].user_id = data[i].user_id;
				    allreq[i].place_id = req.query.place_id;
				    allreq[i].id = req.query.id;
				    allreq[i].notification = 'Заведение "<a href="' + req.query.place_slug + '">'+ req.query.place_name + '</a>" удалило карту лояльности "' + req.query.title + '"';
				    //console.log(allreq[i]);
				    mydata.user_id = data[i].user_id;
				    db.none("INSERT INTO notifications(user_ID, place_ID, target_ID, notification, not_table, autoremove) VALUES (${user_id}, ${place_id}, ${id}, ${notification}, 'loyality', TRUE)", allreq[i]);	
				    db.none('INSERT INTO notifications(user_ID, place_ID, target_ID, notification, not_table, autoremove) VALUES (${user_id}, ${place_id}, ${target_id}, ${notification}, ${not_table}, TRUE)', mydata);
				}
				db.none('DELETE FROM loyality_cards_users WHERE card_ID = ${id}', req.query);
				}).catch(function (error) { console.log(error);
					res.json(error);
				});
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		console.log(error);
		res.json(error);
    });
});

app.delete('/dashboard/loyalityuser', function (req, res) {
	// req.body = { 'token' / params }
	//console.log(req.query);
	db.one("SELECT a.user_ID, p.ID, p.slug, p.name, lc.title FROM auth a, places p, loyality_cards lc WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND lc.place_ID = p.ID AND lc.ID = ${card_id} ", req.query).then(function (data) {
		if (data.user_id) {
		    req.query.place_name = data.name;
		    req.query.place_slug = data.slug;
		    req.query.title = data.title;
		    req.query.place_id = data.id;
		    var mydata = {};
		    mydata.place_id = data.id;
		    mydata.user_id = req.query.user_id;
		    mydata.target_id = 0;
		    mydata.autoremove = true;
		    mydata.not_table = "promotions";
		    db.any('SELECT * FROM promotions WHERE place_ID = ${place_id}', req.query).then(function (data) { 
			var arr = [];
			if (data) {
			    for (j in data) {
				arr[j] = "<a href=\"/promotions/" + data[j].id + "\">" + data[j].title + "</a>";
			    }
			    var act = arr.join(', ');
			    mydata.notification = 'Заведение "<a href="' + req.query.place_slug + '">'+ req.query.place_name + '</a>" удалило акции ' + act + ' в связи с тем, что отняло у Вас карту лояльности';
			    db.none('INSERT INTO notifications(user_ID, place_ID, target_ID, notification, not_table, autoremove) VALUES (${user_id}, ${place_id}, ${target_id}, ${notification}, ${not_table}, TRUE)', mydata);
			}
		    });
			db.none('DELETE FROM loyality_cards_users WHERE card_ID = ${card_id} AND user_ID = ${user_id}', req.query);
			var allreq = {};
			allreq.user_id = req.query.user_id;
			allreq.place_id = req.query.place_id;
			allreq.id = req.query.card_id;
			allreq.notification = 'Заведение "<a href="' + req.query.place_slug + '">'+ req.query.place_name + '</a>" отняло у Вас карту лояльности "' + req.query.title + '"';
			console.log(allreq);
			db.one("INSERT INTO notifications(user_ID, place_ID, target_ID, notification, not_table, autoremove) VALUES (${user_id}, ${place_id}, ${id}, ${notification}, 'loyality', TRUE) RETURNING ID", allreq);
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		console.log(error);
		res.json(error);
    });
});

app.delete('/dashboard/loyalityfromuser', function (req, res) {
	// req.body = { 'token' / params }
	//console.log(req.query);
	db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token} AND a.expires > now()", req.query).then(function (data) {
		if (data.user_id) {
			req.query.user_id = data.user_id;
			db.none('DELETE FROM loyality_cards_users WHERE card_ID = ${card_id} AND user_ID = ${user_id}', req.query);
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		console.log(error);
		res.json(error);
    });
});



app.put('/dashboard/loyality', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id}", req.body).then(function (data) {
		if (data.user_id) {
			db.one("INSERT INTO loyality_cards(place_ID, title, content, activity) VALUES (${place_id}, ${title}, ${content}, ${activity}) RETURNING ID", req.body).then(function (data) {
				console.log(data);
				res.json(data);
			}).catch(function (error) {
				console.log(error);
				res.json(error);
			});
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/dashboard/checkloyality', function (req, res) {
	// req.query = { 'place_ID'  }
	db.one("SELECT a.user_ID FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND p.owner_ID = a.user_ID AND p.ID = ${place_id}", req.query).then(function (data) {
		if (data.user_id) {
			db.one("SELECT u.first_name, u.last_name, u.email, u.phone FROM loyality_cards_users lc, loyality_cards l, places p, users u WHERE p.ID = ${place_id} AND l.place_ID = p.ID AND lc.card_ID = l.ID AND lc.fingerprint = ${code} AND u.ID = lc.user_ID", req.query).then(function (data) {
				console.log(data);
				res.json(data);
			}).catch(function (error) {
				console.log(error);
				res.json(false);
			});
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/allnews', function (req, res) {
	// req.query = { 'place_ID'  }
	db.any("SELECT * FROM news WHERE place_ID = ${place_id} ORDER BY create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/allpromotions', function (req, res) {
	// req.query = { 'place_ID'  }
	db.any("SELECT p.*, (SELECT COUNT(*) FROM article_visitors WHERE item_ID = p.ID) as visitors FROM promotions p WHERE place_ID = ${place_id} ORDER BY create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/promotions/get', function (req, res) {
	// req.query = { 'place_ID'  }
	if (req.query.a0 == 'true') req.query.availability = '[true,%,%,%,%,%,%]';
	else if (req.query.a1 == 'true') req.query.availability = '[%,true,%,%,%,%,%]';
	else if (req.query.a2 == 'true') req.query.availability = '[%,%,true,%,%,%,%]';
	else if (req.query.a3 == 'true') req.query.availability = '[%,%,%,true,%,%,%]';
	else if (req.query.a4 == 'true') req.query.availability = '[%,%,%,%,true,%,%]';
	else if (req.query.a5 == 'true') req.query.availability = '[%,%,%,%,%,true,%]';
	else if (req.query.a6 == 'true') req.query.availability = '[%,%,%,%,%,%,true]';
	else req.query.availability = '[%,%,%,%,%,%,%]';
	//console.log(req.query.availability);
	/*db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token} AND a.expires > now()", req.query).then(function (data) { 
		if (data.user_id) {
			db.any("SELECT pr.ID, pr.title, pr.cover_image, pr.content, p.slug, p.name as place_name, (SELECT json_agg(n.id) FROM notifications n WHERE n.target_ID = pr.ID AND n.user_ID = a.user_ID AND n.viewed IS FALSE AND not_table = 'promotions') as notify FROM auth a, (SELECT lc.place_ID, lu.user_ID FROM loyality_cards lc, loyality_cards_users lu WHERE lu.card_ID = lc.ID GROUP BY lc.place_ID, lu.user_ID) l, places p, promotions pr WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = l.user_ID AND l.place_ID = p.ID AND pr.starts <= now() AND pr.ends >= now() AND pr.place_ID = p.ID AND (lower(pr.title) LIKE '%${search:value}%' OR lower(pr.content) LIKE '%${search:value}%') ORDER BY pr.create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
		}
		else {*/
		    db.any("SELECT pr.*, p.slug, p.name as place_name FROM promotions pr, places p WHERE (lower(pr.title) LIKE '%${search:value}%' OR lower(pr.content) LIKE '%${search:value}%') AND pr.place_ID = p.ID AND starts <= now() AND ends >= now() AND availability LIKE '${availability:value}' ORDER BY pr.create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
		/*}
    }).catch(function (error) {
	db.any("SELECT pr.*, p.slug, p.name as place_name FROM promotions pr, places p WHERE (lower(pr.title) LIKE '%${search:value}%' OR lower(pr.content) LIKE '%${search:value}%') AND pr.place_ID = p.ID AND pr.only_clients IS FALSE AND starts <= now() AND ends >= now() AND availability LIKE '${availability:value}' ORDER BY pr.create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
    });*/
	
	
});

app.get('/promotions/getByLocation', function (req, res) {	
	if (req.query.a0 == 'true') req.query.availability = '[true,%,%,%,%,%,%]';
	else if (req.query.a1 == 'true') req.query.availability = '[%,true,%,%,%,%,%]';
	else if (req.query.a2 == 'true') req.query.availability = '[%,%,true,%,%,%,%]';
	else if (req.query.a3 == 'true') req.query.availability = '[%,%,%,true,%,%,%]';
	else if (req.query.a4 == 'true') req.query.availability = '[%,%,%,%,true,%,%]';
	else if (req.query.a5 == 'true') req.query.availability = '[%,%,%,%,%,true,%]';
	else if (req.query.a6 == 'true') req.query.availability = '[%,%,%,%,%,%,true]';
	else req.query.availability = '[%,%,%,%,%,%,%]';
	var where = '';
	where = "pr.availability LIKE '${availability:value}' AND";
	
	db.any("SELECT pr.*, p.*, p.name as place_name, ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 as dist FROM places p, promotions pr WHERE " + where + " pr.place_ID = p.ID AND p.city = ${city:value} AND ACOS(SIND(CAST(p.lat AS DOUBLE PRECISION)) * SIND(CAST(${lat:value} AS DOUBLE PRECISION)) + COSD(CAST(p.lat AS DOUBLE PRECISION)) * COSD(CAST(${lat:value} AS DOUBLE PRECISION)) * COSD(CAST(p.lng AS DOUBLE PRECISION) - CAST(${lng:value} AS DOUBLE PRECISION))) * 6371000 <= CAST(${radius:value} AS DOUBLE PRECISION) ORDER BY p.create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		console.log(error);
		res.json(error);
	});
});

app.get('/news/get', function (req, res) {
	// req.query = { 'place_ID'  }
	db.any("SELECT * FROM news ORDER BY create_date DESC LIMIT ${limit:value} OFFSET ${offset:value}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/loyality', function (req, res) {
	// req.query = { 'place_ID'  }
	db.any("SELECT l.* FROM loyality_cards l WHERE l.place_ID = ${place_id}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/loyalityitem', function (req, res) {
	// req.query = { 'place_ID'  }
	db.one("SELECT l.*, (SELECT json_agg(a.*) FROM (SELECT u.ID, u.first_name, u.last_name, u.email, u.phone FROM loyality_cards_users lc, users u WHERE lc.card_ID = l.ID AND u.ID = lc.user_ID) a) as card_users FROM loyality_cards l WHERE l.ID = ${id}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/userbyphone', function (req, res) {
	// req.query = { 'place_ID'  }
	db.any("SELECT u.ID, u.first_name, u.last_name, u.phone, u.email, (SELECT json_agg(lcu.*) FROM loyality_cards_users lcu WHERE lcu.user_ID = u.ID AND lcu.card_ID = ${card}) as exists FROM users u WHERE u.phone LIKE '%${phone:value}%' OR u.email LIKE '%${phone:value}%'", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

/* ====================== */
/* Настройки пользователя */
/* ====================== */

app.get('/dashboard/user', function (req, res) {
	// req.query = { 'place_ID'  }
	db.one("SELECT a.user_ID, u.first_name, u.last_name, u.phone, u.agree, u.ID FROM auth a, users u WHERE a.token = ${token} AND a.expires > now() AND u.ID = a.user_ID", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/user', function (req, res) {
	// req.query = { 'place_ID'  }
	db.one("SELECT u.first_name, u.last_name, u.registration_date, (SELECT COUNT(DISTINCT place_ID) FROM reviews WHERE user_ID = u.ID) as vis, (SELECT COUNT(*) FROM reviews WHERE user_ID = u.ID) as rev FROM users u WHERE u.ID = ${id}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.post('/dashboard/user', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = ${id}", req.body).then(function (data) {
		if (data.user_id) {
			db.none('UPDATE users SET first_name = ${first_name}, last_name = ${last_name}, agree = ${agree}, phone = ${phone} WHERE ID = ${id}', req.body);
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.get('/dashboard/password', function (req, res) {
	// req.query = { 'place_ID'  }
	db.one("SELECT a.user_ID FROM auth a, users u WHERE a.token = ${token} AND a.expires > now() AND u.ID = a.user_ID AND u.password = MD5(${password})", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.post('/dashboard/password', function (req, res) {
	// req.body = { 'token' / params }
	db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token} AND a.expires > now()", req.body).then(function (data) {
		console.log(data);
		if (data.user_id) {
			req.body.id = data.user_id;
			db.none('UPDATE users SET password = MD5(${new}) WHERE ID = ${id}', req.body);
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

/* ============== */
/* Сеть заведений */
/* ============== */

app.get('/dashboard/userplaces', function (req, res) {
	db.any("SELECT p.ID, p.name, p.address, p.network_ID FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = p.owner_ID AND p.network_ID = 0", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/userplacesall', function (req, res) {
	db.any("SELECT p.ID, p.name, p.address, p.network_ID FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = p.owner_ID AND (p.network_ID = 0 OR p.network_ID = ${id})", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/network', function (req, res) {
	db.any("SELECT n.*, (SELECT json_agg(p.*) FROM places p WHERE p.network_ID = n.ID) as places FROM auth a, network n WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = n.user_ID", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.delete('/dashboard/network', function (req, res) {
	db.one("SELECT a.user_ID FROM auth a, network n WHERE a.token = ${token} AND a.expires > now() AND n.user_ID = a.user_ID AND n.ID = ${id}", req.query).then(function (data) {
		if (data.user_id) {
			db.none('DELETE FROM network WHERE ID = ${id}', req.query);
			db.none("UPDATE places SET network_ID = 0 WHERE network_id = ${id}", req.query);
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		console.log(error);
		res.json(error);
    });
});

app.delete('/dashboard/place', function (req, res) {
	db.one("SELECT a.user_ID FROM auth a, network n WHERE a.token = ${token} AND a.expires > now() AND n.user_ID = a.user_ID AND n.ID = ${id}", req.query).then(function (data) {
		if (data.user_id) {
			db.none('DELETE FROM place WHERE ID = ${id}', req.query);
			res.json(true);
		}
		else res.json(false);
    }).catch(function (error) {
		console.log(error);
		res.json(error);
    });
});

app.get('/dashboard/networkbyid', function (req, res) {
	db.one("SELECT n.* FROM auth a, network n WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = n.user_ID AND n.ID = ${id}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/networkplaces', function (req, res) {
	db.any("SELECT p.* FROM auth a, places p WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = p.owner_ID AND p.network_ID = ${network_id}", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});


app.put('/dashboard/network', function (req, res) {
	db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token} AND a.expires > now()", req.body).then(function (data) {
		if (data.user_id) {
			req.body.user_id = data.user_id;
			db.one("INSERT INTO network(user_ID, name) VALUES (${user_id}, ${name}) RETURNING ID", req.body).then(function (data) {
				for (i in req.body.places)
				{
					db.none("UPDATE places SET network_ID = ${network_id} WHERE ID = ${id}", { network_id : data.id, id : req.body.places[i] });
				}
				res.json(true);
			}).catch(function (error) {
				console.log(error);
				res.json(error);
			});
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

app.post('/dashboard/network', function (req, res) {
	db.one("SELECT a.user_ID FROM auth a WHERE a.token = ${token} AND a.expires > now()", req.body).then(function (data) {
		if (data.user_id) {
			req.body.user_id = data.user_id;
			db.none("UPDATE network SET name = ${name} WHERE ID = ${id}", req.body).then(function (data) {
				db.none("UPDATE places SET network_ID = 0 WHERE network_ID = ${network_id}", { network_id : req.body.id });
				for (i in req.body.places)
				{
					console.log(req.body.places[i]);
					db.none("UPDATE places SET network_ID = ${network_id} WHERE ID = ${id}", { network_id : req.body.id, id : req.body.places[i] });
				}
				res.json(true);
			}).catch(function (error) {
				console.log(error);
				res.json(error);
			});
		}
		else res.json(false);
    }).catch(function (error) {
		res.json(error);
    });
});

/* =========================== */
/* Личный кабинет пользователя */
/* =========================== */

app.get('/dashboard/myloyality', function (req, res) {
	db.any("SELECT l.title, l.content, l.ID, lc.fingerprint, p.ID as place_id, p.owner_ID, p.name, p.slug, (SELECT json_agg(n.id) FROM notifications n WHERE n.target_ID = l.ID AND n.user_ID = a.user_ID AND n.viewed IS FALSE AND not_table = 'loyality') as notify FROM auth a, loyality_cards l, loyality_cards_users lc, places p WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = lc.user_ID AND l.place_ID = p.ID AND lc.card_ID = l.ID AND l.activity IS TRUE", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/mypromo', function (req, res) {
	db.any("SELECT l.*, p.name, p.slug FROM auth a, promocodes l, places p WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = l.user_ID AND l.place_ID = p.ID AND now() <= l.create_date + INTERVAL '1day' AND l.used IS FALSE", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/mypromoused', function (req, res) {
	db.any("SELECT l.*, p.name, p.slug FROM auth a, promocodes l, places p WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = l.user_ID AND l.place_ID = p.ID AND (l.used IS TRUE OR now() > l.create_date + INTERVAL '1day')", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/mybooks', function (req, res) {
	db.any("SELECT l.*, p.name, p.slug FROM auth a, booking l, places p WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = l.user_ID AND l.place_ID = p.ID AND now() <= l.book_date AND l.used IS FALSE ORDER BY l.book_date ASC", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/mypbooks', function (req, res) {
	db.any("SELECT l.*, p.name, p.slug FROM auth a, booking l, places p WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = l.user_ID AND l.place_ID = p.ID AND (now() > l.book_date OR l.used IS TRUE) ORDER BY l.create_date", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) {
		res.json(error);
	});
});

app.get('/dashboard/mypromotions', function (req, res) {
	db.any("SELECT pr.ID, pr.title, pr.cover_image, pr.content, p.slug, p.name as place_name, (SELECT json_agg(n.id) FROM notifications n WHERE n.target_ID = pr.ID AND n.user_ID = a.user_ID AND n.viewed IS FALSE AND not_table = 'promotions') as notify FROM auth a, (SELECT lc.place_ID, lu.user_ID FROM loyality_cards lc, loyality_cards_users lu WHERE lu.card_ID = lc.ID GROUP BY lc.place_ID, lu.user_ID) l, places p, promotions pr WHERE a.token = ${token} AND a.expires > now() AND a.user_ID = l.user_ID AND l.place_ID = p.ID AND pr.starts <= now() AND pr.ends >= now() AND pr.place_ID = p.ID AND (lower(pr.title) LIKE '%${search:value}%' OR lower(pr.content) LIKE '%${search:value}%')", req.query).then(function (data) {
		res.json(data);
	}).catch(function (error) { console.log(error);
		res.json(error);
	});
});


app.post('/visitors/page', function (req, res) {
	db.one("INSERT INTO page_visitors(place_ID) VALUES (${place_id}) RETURNING ID", req.body).then(function (data) {
	    res.json(data);
	}).catch(function (error) {
	    console.log(error);
	    res.json(error);
	});
});

app.post('/visitors/article', function (req, res) {
	db.one("INSERT INTO article_visitors(item_ID) VALUES (${item_id}) RETURNING ID", req.body).then(function (data) {
	    res.json(data);
	}).catch(function (error) {
	    console.log(error);
	    res.json(error);
	});
});



app.listen(83, function () {
  console.log('Example app listening on port 83!');
});

