<?php

	require_once 'Log.php';
	require_once '../models/User.php';


	class Auth
	{

		// create a logged-in session if user provides the correct username and password
		public static function attempt($username, $password)
		{
			$correctCredentials = User::verifyLogin($username, $password);

			if(!$correctCredentials){
				// log result to a log tracking file
				$logInFailure = new Log;
				$logInFailure->logError("User $username failed to log in!");
			} else {
				// clear session array of any data from previous sessions
				$_SESSION = array();
				// store user's username to pass to next page
				$_SESSION['LOGGED_IN_USER'] = $username;
				// log result to a log tracking file
				$loggedIn = new Log;
				$loggedIn->logInfo("User $username logged in successfully.");

				return true;
			}
		}

		// returns a boolean whether or not the user is logged in
		public static function check()
		{
			return isset($_SESSION['LOGGED_IN_USER']);

		}

		// returns the username of the logged in user
		public static function user()
		{
			return $_SESSION['LOGGED_IN_USER'];
		}

		public static function logout()
		{
			// Unset all of the session variables.
		    $_SESSION = array();

		    // If it's desired to kill the session, also delete the session cookie.
		    // Note: This will destroy the session, and not just the session data!
		    if (ini_get("session.use_cookies")) {
		        $params = session_get_cookie_params();
		        setcookie(session_name(), '', time() - 42000,
		            $params["path"], $params["domain"],
		            $params["secure"], $params["httponly"]
		        );
		    }

		    // Finally, destroy the session.
		    session_destroy();
		}
	}










?>