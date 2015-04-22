<?php
	
	require_once '../models/BaseModel.php';

	$migration = new BaseModel;
	$dbc = $migration->getDbConnect();

	// Ads table
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
				date_created DATE NOT NULL,
				PRIMARY KEY (id)
			)";

	$dbc->exec($query);

	// Users table
	$sql = "CREATE TABLE IF NOT EXISTS users (
				user_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
				username VARCHAR(25) NOT NULL,
				password VARCHAR(25) NOT NULL,
				contact_email VARCHAR(255) NOT NULL,
				date_created DATE NOT NULL,
				PRIMARY KEY (user_id)		
			)";

	$dbc->exec($sql);