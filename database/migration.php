<?php
	
	require_once '../models/BaseModel.php';

	$migration = new BaseModel;
	$dbc = $migration->getDbConnect();

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