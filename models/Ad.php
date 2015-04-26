<?php

	require_once 'BaseModel.php';

	class Ad extends BaseModel
	{
		protected static $table = 'ads';


		// Find all records based on a user's id
	    public static function findAds($user_id)
	    {
	        $dbc = self::getDbConnect();

	        // @TODO: Create select statement using prepared statements
	        $stmt = $dbc->prepare("SELECT * FROM " . static::$table . " WHERE user_id = :user_id");
			$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


	        // The following code will create a new object instance of the Model class. 
	        // Its attributes array will contain the record of the found id
	        $instance = null;
	        if ($result)
	        {
	            $instance = new static;
	            $instance->attributes = $result;
	        }
	        // return $instance;
	        return $result;
	    }
	}

?>