<?php
include_once("functions.php");

$link = connect();

$ct1 = 'CREATE TABLE countries(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    country VARCHAR(100) UNIQUE
) DEFAULT charset="utf8"';

$ct2 = 'CREATE TABLE cities(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    city VARCHAR(100),
    country_id INT,
    FOREIGN KEY(country_id) REFERENCES countries(id) ON DELETE CASCADE,
    u_city VARCHAR(100),
    UNIQUE INDEX u_city(city, country_id)
) DEFAULT charset="utf8"';

$ct3 = 'CREATE TABLE hotels(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hotel VARCHAR(100),
    city_id INT,
    FOREIGN KEY(city_id) REFERENCES cities(id) ON DELETE CASCADE,
    country_id INT,
    FOREIGN KEY(country_id) REFERENCES countries(id) ON DELETE CASCADE,
    stars INT,
    cost INT,
    info TEXT
) DEFAULT charset="utf8"';

$ct4 = 'CREATE TABLE images(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    image_path VARCHAR(250),
    hotel_id INT,
    FOREIGN KEY(hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
) DEFAULT charset="utf8"';

$ct5 = 'CREATE TABLE roles(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(100) UNIQUE
) DEFAULT charset="utf8"';

$ct6 = 'CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100) UNIQUE,
    password VARCHAR(100),
    email VARCHAR(100),
    discount INT,
    role_id INT,
    FOREIGN KEY(role_id) REFERENCES roles(id) ON DELETE CASCADE,
    avatar VARCHAR(250)
) DEFAULT charset="utf8"';


mysqli_query($link, $ct1);
mysqli_query($link, $ct2);
mysqli_query($link, $ct3);
mysqli_query($link, $ct4);
mysqli_query($link, $ct5);
mysqli_query($link, $ct6);

mysqli_query($link, "INSERT INTO roles (role) VALUES ('admin'), ('user')");
mysqli_query($link, "INSERT INTO users (login, password, email, role_id) 
    VALUES (admin, 21232f297a57a5a743894a0e4a801fc3, admin@admin.mail, 1)");
