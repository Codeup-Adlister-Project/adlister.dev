<?php
	
	require_once '../models/BaseModel.php';

	$seeder = new BaseModel;
	$dbc = $seeder->getDbConnect();

	$emptyTable = 'TRUNCATE TABLE ads';
	$dbc->exec($emptyTable);


	$ads = [
		[
			'user_id'		=>	100, 
			'contact_name'	=>	'Joe', 
			'contact_email'	=>	'email@gmail.com', 
			'contact_phone'	=>	'555-555-5555', 
			'title'			=>	'2005 Chrysler Sebring', 
			'description'	=>	'Good condition, minor body work, no mechanical problems.', 
			'price'			=>	2500, 
			'image_url'		=>	'/img/myVehicle.jpg'
		],
		[
			'user_id'		=>	200, 
			'contact_name'	=>	'Bob', 
			'contact_email'	=>	'email@gmail.com', 
			'contact_phone'	=>	'555-555-5555', 
			'title'			=>	'2010 Chrysler Sebring', 
			'description'	=>	'Good condition, minor body work, no mechanical problems.', 
			'price'			=>	3800, 
			'image_url'		=>	'/img/myVehicle.jpg'
		],
		[
			'user_id'		=>	300, 
			'contact_name'	=>	'Kevin', 
			'contact_email'	=>	'email@gmail.com', 
			'contact_phone'	=>	'555-555-5555', 
			'title'			=>	'2015 Chrysler Sebring', 
			'description'	=>	'Good condition, minor body work, no mechanical problems.', 
			'price'			=>	6500, 
			'image_url'		=>	'/img/myVehicle.jpg'
		]
	];


	$query = "INSERT INTO ads (user_id, contact_name, contact_email, contact_phone, title, description, price, image_url)
		VALUES (:user_id, :contact_name, :contact_email, :contact_phone, :title, :description, :price, :image_url)";

	$stmt = $dbc->prepare($query);

	foreach ($ads as $ad) {	
		$stmt->bindValue(':user_id', $ad['user_id'], PDO::PARAM_INT);
		$stmt->bindValue(':contact_name', $ad['contact_name'], PDO::PARAM_STR);
		$stmt->bindValue(':contact_email', $ad['contact_email'], PDO::PARAM_STR);
		$stmt->bindValue(':contact_phone', $ad['contact_phone'], PDO::PARAM_STR);
		$stmt->bindValue(':title', $ad['title'], PDO::PARAM_STR);
		$stmt->bindValue(':description', $ad['description'], PDO::PARAM_STR);
		$stmt->bindValue(':price', $ad['price'], PDO::PARAM_INT);
		$stmt->bindValue(':image_url', $ad['image_url'], PDO::PARAM_STR);
		$stmt->execute();

		echo "Inserted ID: ".$dbc->lastInsertId().PHP_EOL;
	}






