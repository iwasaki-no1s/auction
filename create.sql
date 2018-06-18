DROP DATABASE  IF EXISTS auction;
CREATE DATABASE auction DEFAULT CHARACTER SET utf8;

USE auction;

DROP TABLE IF EXISTS users;
CREATE TABLE users(
	id int(11) not null auto_increment,
	e_mail varchar(255) not null,
	user_name varchar(255) not null,
	password varchar(255) not null,
	address varchar(255) not null,
	created datetime default null,
	modified datetime default null,
	PRIMARY KEY(id),
	UNIQUE KEY (e_mail)
);

DROP TABLE IF EXISTS products;
CREATE TABLE products(
	id int(11) not null auto_increment,
	product_name varchar(255) not null,
	category_id int(11) not null,
	user_id int(11) not null,
	detail text not null,
	start_price int(11) not null,
	max_price int(11) not null,
	sold int(11) not null,
	created datetime default null,
	modified datetime default null,
	end_date datetime default null,
	PRIMARY KEY(id)
);

DROP TABLE IF EXISTS bids;
CREATE TABLE bids(
	id int(11) not null auto_increment,
	product_id int(11) not null,
	price int(11) not null,
	user_id int(11) not null,
	PRIMARY KEY(id)
);

DROP TABLE IF EXISTS favorites;
CREATE TABLE favorites(
	id int(11) not null auto_increment,
	product_id int(11) not null,
	user_id int(11) not null,
	PRIMARY KEY(id)
);

DROP TABLE IF EXISTS categories;
CREATE TABLE categories(
	id int(11) not null auto_increment,
	name varchar(255) not null,
	PRIMARY KEY(id)
);

DROP TABLE IF EXISTS images;
CREATE TABLE images(
	id int(11) not null auto_increment,
	product_id int(11) not null,
	image_url varchar(255) not null,
	created datetime default null,
	modified datetime default null,
	PRIMARY KEY(id)
);
