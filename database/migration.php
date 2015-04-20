<?php
	// Define constants to be used in the PDO call before the db_connect.php file is required
	define ('DB_HOST', '127.0.0.1');
	define ('DB_NAME', 'adlister_db');
	define ('DB_USER', 'adlister_user');
	define ('DB_PASS', 'password');

	require 'db_connect.php';

	$drop = 'DROP TABLE IF EXISTS ads';
	$dbc->exec($drop);


	$query = "CREATE TABLE ads (
			  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
			  user_id INT(10) UNSIGNED NOT NULL,
			  contact_name VARCHAR(255) NOT NULL,
			  contact_email VARCHAR(255) NOT NULL,
			  contact_phone VARCHAR(16) DEFAULT NULL,
			  title VARCHAR(255) NOT NULL,
			  description TEXT,
			  price FLOAT NOT NULL,
			  image_url BLOB,
			  PRIMARY KEY (id)
			)";

	$dbc->exec($query);