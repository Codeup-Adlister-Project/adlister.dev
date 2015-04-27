<?php

	require_once '../models/BaseModel.php';

	// Get PDO connection
	$dbc = BaseModel::getDbConnect();

	// Ads table
	$drop = 'DROP TABLE IF EXISTS ads';
	$dbc->exec($drop);

	$query = "CREATE TABLE IF NOT EXISTS ads (
				id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
				user_id INT(10) UNSIGNED NOT NULL,
				contact_name VARCHAR(255) NOT NULL,
				contact_email VARCHAR(255) NOT NULL,
				contact_phone VARCHAR(16) DEFAULT NULL,
				title VARCHAR(255) NOT NULL,
				description TEXT,
				price DECIMAL(10,2) NOT NULL,
				image_url BLOB,
				date_created VARCHAR(255) NOT NULL,
				PRIMARY KEY (id)
			)";						// Note: date_created as VARCHAR datatype is intentional;
									// it will be auto-entered by forms as a string

	$dbc->exec($query);


	// Users table
	$drop2 = 'DROP TABLE IF EXISTS users';
	$dbc->exec($drop2);

	$sql = "CREATE TABLE IF NOT EXISTS users (
				user_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
				username VARCHAR(255) NOT NULL,
				password VARCHAR(255) NOT NULL,
				contact_email VARCHAR(255) NOT NULL,
				date_created VARCHAR(255) NOT NULL,
				PRIMARY KEY (user_id)
			)";						// Note: date_created as VARCHAR datatype is intentional;
									// it will be auto-entered by forms as a string

	$dbc->exec($sql);