<?php
	require_once 'utils/Auth.php';
	require_once 'utils/Input.php';
	require_once 'utils/Log.php';

	require_once 'models/Ad.php';
	require_once 'models/User.php';
	require_once 'models/BaseModel.php';

	// If a particular class cannot be found, try to reference it from the root directory, otherwise fail gracefully
	function __autoload($className) {
	    if (file_exists(__DIR__.'/utils/'.$className . '.php')) {
	        require_once '/utils/'.$className . '.php';
	        return true;
	    } else if (file_exists(__DIR__.'/models/'.$className . '.php')) {
	        require_once '/models/'.$className . '.php';
	        return true;
	    }
	    return false;
	}

	 // Start/resume current session
    if (!isset($_SESSION)) {
        session_start();
    }

    // If user is logged in, get their username, email, and user_id
    if(Auth::check()){
        $userArray = Auth::user();  //contains keys 'username', 'user_id', 'contact_email', and 'date_created'
    }
?>
