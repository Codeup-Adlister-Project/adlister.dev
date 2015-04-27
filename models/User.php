<?php
	require_once 'BaseModel.php';
	require_once '../utils/Auth.php';



	class User extends BaseModel
	{
		protected static $table = 'users';


		// Does a passed username exist in the table?
		public static function checkUser($username)
		{
			$dbc = self::getDbConnect();

			// See if username exists in the database
			$userFound = $dbc->query("SELECT username FROM " . static::$table . " WHERE username = '" . $username . "'")->fetchColumn();

			return !empty($userFound) ? true : false;
		}

		// If a username exists in the table, retrieve its password
		public static function getPassword($username)
		{
			$dbc = self::getDbConnect();

			// See if username exists in the database
			$userExists = self::checkUser($username);

			if(!$userExists){
				throw new Exception ("Username does not exist.");
			}

			return $password = $dbc->query("SELECT password FROM " . static::$table . " WHERE username = '" . $username . "'")->fetchColumn();
	    }


	    // Check if passed password matches password stored in table
	    public static function verifyLogin($username, $inputPassword)
	    {
    		// If username exists, get their hashed password from table
    		$realPassword = self::getPassword($username);

    		if(password_verify($inputPassword, $realPassword)) {
    			return true;
    		} else {
    			return false;
    		}
	    }

	    // If a username exists in the table, retrieve its email and user_id
		public static function getUserInfo($username)
		{
			$dbc = self::getDbConnect();

			// See if username exists in the database
			$userExists = self::checkUser($username);

			if(!$userExists){
				throw new Exception ("Username does not exist.");
			}

			$stmt = $dbc->prepare("SELECT user_id, contact_email, date_created FROM " . static::$table . " WHERE username = :username");
			$stmt->bindValue(':username', $username, PDO::PARAM_STR);
			$stmt->execute();
			$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			$userInfo['username'] = $username;

			return $userInfo;	//is an array that contains user_id, contact_email, date_created and username.
	    }

	}

?>