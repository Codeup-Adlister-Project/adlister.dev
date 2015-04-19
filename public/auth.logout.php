<!-- Ends the user's session, is never displayed, and redirects the user back to the login page -->

<?php
	// Let these Classes do all the work, rather than the logout 'endSession()' function itself
	require_once '../utils/Auth.php';
	require_once '../utils/Input.php';

	// code for this function came directly from PHP docs:
	// http://php.net/session_destroy
	function endSession()
	{
	    Auth::logout();
	    header("Location: index.php");
	}

	endSession();

?>